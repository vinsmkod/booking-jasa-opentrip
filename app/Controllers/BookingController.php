<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\ScheduleModel;
use App\Models\TripModel;
use App\Models\PaymentModel;
use App\Models\DocumentModel;
use App\Models\MeetingPointModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $scheduleModel;
    protected $tripModel;
    protected $paymentModel;
    protected $documentModel;
    protected $meetingPointModel;

    public function __construct()
    {
        $this->bookingModel      = new BookingModel();
        $this->scheduleModel     = new ScheduleModel();
        $this->tripModel         = new TripModel();
        $this->paymentModel      = new PaymentModel();
        $this->documentModel     = new DocumentModel();
        $this->meetingPointModel = new MeetingPointModel();
    }

    // ==============================
    // HALAMAN BOOKING
    // ==============================
    public function create($schedule_id)
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $schedule = $this->scheduleModel
            ->select('schedules.*, trips.trip_id, trips.title, trips.location, trips.price')
            ->join('trips','trips.trip_id = schedules.trip_id')
            ->where('schedule_id', $schedule_id)
            ->first();

        if (!$schedule) {
            return redirect()->to('/')
                ->with('error','Jadwal tidak ditemukan');
        }

        $meetingPoints = $this->meetingPointModel
            ->where('trip_id', $schedule['trip_id'])
            ->findAll();

        return view('booking/create', [
            'schedule' => $schedule,
            'meetingPoints' => $meetingPoints
        ]);
    }


    // ==============================
    // SIMPAN BOOKING
    // ==============================
    public function store()
    {
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login');
        }

        $schedule_id      = $this->request->getPost('schedule_id');
        $participantCount = (int)$this->request->getPost('participant');
        $method           = $this->request->getPost('payment_method');
        $meeting_point_id = $this->request->getPost('meeting_point_id');

        if (!$schedule_id || $participantCount <= 0) {
            return redirect()->back()
                ->with('error', 'Jumlah peserta tidak valid');
        }

        $schedule = $this->scheduleModel->find($schedule_id);
        if (!$schedule) {
            return redirect()->back()
                ->with('error', 'Jadwal tidak ditemukan');
        }

        if ($schedule['available'] < $participantCount) {
            return redirect()->back()
                ->with('error', 'Kuota tidak cukup');
        }

        $trip = $this->tripModel->find($schedule['trip_id']);
        if (!$trip) {
            return redirect()->back()
                ->with('error', 'Trip tidak ditemukan');
        }

        $total_price  = $trip['price'] * $participantCount;
        $booking_code = 'TRIP-' . date('YmdHis') . rand(100,999);

        $db = \Config\Database::connect();
        $db->transStart();

        // INSERT BOOKING
        $this->bookingModel->insert([
            'booking_code'     => $booking_code,
            'user_id'          => $user_id,
            'schedule_id'      => $schedule_id,
            'participant'      => $participantCount,
            'total_price'      => $total_price,
            'status'           => 'pending',
            'meeting_point_id' => $meeting_point_id
        ]);

        $booking_id = $this->bookingModel->insertID();

        // UPDATE KUOTA
        $this->scheduleModel->update($schedule_id, [
            'available' => $schedule['available'] - $participantCount
        ]);

        // =================
        // UPLOAD DOKUMEN
        // =================
        $participants = $this->request->getPost('participants');
        $files = $this->request->getFiles();

        $ktpFiles    = $files['ktp'] ?? [];
        $healthFiles = $files['health'] ?? [];

        foreach ($participants as $i => $p) {

            $ktpName = null;
            $healthName = null;

            if (isset($ktpFiles[$i]) && $ktpFiles[$i]->isValid()) {

                $ktpName = $ktpFiles[$i]->getRandomName();
                $ktpFiles[$i]->move('uploads/documents', $ktpName);

                $this->documentModel->insert([
                    'booking_id' => $booking_id,
                    'type' => 'ktp',
                    'file' => $ktpName,
                    'status' => 'pending'
                ]);
            }

            if (isset($healthFiles[$i]) && $healthFiles[$i]->isValid()) {

                $healthName = $healthFiles[$i]->getRandomName();
                $healthFiles[$i]->move('uploads/documents', $healthName);

                $this->documentModel->insert([
                    'booking_id' => $booking_id,
                    'type' => 'health',
                    'file' => $healthName,
                    'status' => 'pending'
                ]);
            }
        }

        // =================
        // UPLOAD BUKTI BAYAR
        // =================
        $proofFile = $this->request->getFile('payment_proof');
        $proofName = null;

        if ($proofFile && $proofFile->isValid()) {
            $proofName = $proofFile->getRandomName();
            $proofFile->move('uploads/payments', $proofName);
        }

        // INSERT PAYMENT
        $this->paymentModel->insert([
            'booking_id' => $booking_id,
            'method'     => $method,
            'amount'     => $total_price,
            'proof'      => $proofName,
            'status'     => 'waiting',
            'paid_at'    => date('Y-m-d H:i:s')
        ]);

        $db->transComplete();

        return redirect()->to('/booking/detail/' . $booking_id)
            ->with('success', 'Booking berhasil dibuat');
    }


    // ==============================
    // DETAIL BOOKING
    // ==============================
    public function detail($booking_id)
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        $booking = $this->bookingModel
            ->where('booking_id', $booking_id)
            ->where('user_id', $user_id)
            ->first();

        if (!$booking) {
            return redirect()->to('/dashboard')
                ->with('error', 'Booking tidak ditemukan');
        }

        $schedule  = $this->scheduleModel->find($booking['schedule_id']);
        $trip      = $this->tripModel->find($schedule['trip_id']);
        $payment   = $this->paymentModel
            ->where('booking_id', $booking_id)
            ->first();

        $documents = $this->documentModel
            ->where('booking_id', $booking_id)
            ->findAll();

        return view('booking/detail', [
            'booking'   => $booking,
            'schedule'  => $schedule,
            'trip'      => $trip,
            'payment'   => $payment,
            'documents' => $documents
        ]);
    }


    // ==============================
    // HISTORY BOOKING CUSTOMER
    // ==============================
    public function history()
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        $bookings = $this->bookingModel
            ->select('bookings.*, schedules.departure_date, trips.title as trip_title')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->where('bookings.user_id', $user_id)
            ->orderBy('bookings.created_at', 'DESC')
            ->findAll();

        return view('booking/history', [
            'bookings' => $bookings
        ]);
    }


    // ==============================
    // EXPORT BOOKING EXCEL
    // ==============================
    public function exportExcel()
    {

        $bookings = $this->bookingModel
            ->select('bookings.*, users.name as customer_name, trips.title as trip_title, meeting_points.name as meeting_point_name')
            ->join('users', 'users.user_id = bookings.user_id')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->join('meeting_points', 'meeting_points.meeting_point_id = bookings.meeting_point_id', 'left')
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1','Booking ID')
              ->setCellValue('B1','Booking Code')
              ->setCellValue('C1','Customer')
              ->setCellValue('D1','Trip')
              ->setCellValue('E1','Participant')
              ->setCellValue('F1','Total Price')
              ->setCellValue('G1','Meeting Point')
              ->setCellValue('H1','Status');

        $row = 2;

        foreach ($bookings as $b) {

            $sheet->setCellValue('A'.$row,$b['booking_id'])
                  ->setCellValue('B'.$row,$b['booking_code'])
                  ->setCellValue('C'.$row,$b['customer_name'])
                  ->setCellValue('D'.$row,$b['trip_title'])
                  ->setCellValue('E'.$row,$b['participant'])
                  ->setCellValue('F'.$row,$b['total_price'])
                  ->setCellValue('G'.$row,$b['meeting_point_name'] ?? '-')
                  ->setCellValue('H'.$row,$b['status']);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        $fileName = 'bookings_' . date('YmdHis') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');

        $writer->save('php://output');
        exit;
    }
}