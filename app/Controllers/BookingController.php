<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\ScheduleModel;
use App\Models\TripModel;
use App\Models\PaymentModel;
use App\Models\DocumentModel;
use App\Models\MeetingPointModel;
use App\Models\UserModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $scheduleModel;
    protected $tripModel;
    protected $paymentModel;
    protected $documentModel;
    protected $meetingPointModel;
    protected $userModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->scheduleModel = new ScheduleModel();
        $this->tripModel = new TripModel();
        $this->paymentModel = new PaymentModel();
        $this->documentModel = new DocumentModel();
        $this->meetingPointModel = new MeetingPointModel();
        $this->userModel = new UserModel();
    }

    /*
    =====================================
    GENERATE BOOKING CODE
    =====================================
    */

    private function generateBookingCode()
    {
        $prefix = "TRIP";
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 5));

        return $prefix . '-' . $date . '-' . $random;
    }

    /*
    =====================================
    CREATE BOOKING
    =====================================
    */

    public function create($schedule_id)
    {
        $schedule = $this->scheduleModel
            ->select('schedules.*, trips.title, trips.location, trips.price, trips.image')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->where('schedule_id', $schedule_id)
            ->first();

        if (!$schedule) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $meetingPoints = $this->meetingPointModel
            ->where('trip_id', $schedule['trip_id'])
            ->findAll();

        return view('booking/create', [
            'schedule' => $schedule,
            'meetingPoints' => $meetingPoints
        ]);
    }

    /*
    =====================================
    STORE BOOKING
    =====================================
    */

    public function store()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $user_id = session()->get('user_id');

            if (!$user_id) {
                return redirect()->to('/login');
            }

            $schedule_id = $this->request->getPost('schedule_id');
            $participant = $this->request->getPost('participant');
            $meeting_point_id = $this->request->getPost('meeting_point_id');
            $redeem_point = $this->request->getPost('redeem_point') ?? 0;
            $payment_method = $this->request->getPost('payment_method');

            $schedule = $this->scheduleModel->find($schedule_id);

            if (!$schedule) {
                throw new \Exception('Schedule tidak ditemukan');
            }

            $trip = $this->tripModel->find($schedule['trip_id']);

            if (!$trip) {
                throw new \Exception('Trip tidak ditemukan');
            }

            if ($schedule['available'] < $participant) {
                throw new \Exception('Kuota tidak mencukupi');
            }

            $price = ($trip['price'] ?? 0) * ($participant ?? 1);
            $discount = ($redeem_point / 100) * 5000;
            $final_price = $price - $discount;

            if ($final_price < 0) {
                $final_price = 0;
            }

            $bookingCode = $this->generateBookingCode();

            $booking_id = $this->bookingModel->insert([
                'booking_code' => $bookingCode,
                'user_id' => $user_id,
                'schedule_id' => $schedule_id,
                'meeting_point_id' => $meeting_point_id ?: null, // Jika kosong, simpan null
                'participant' => $participant,
                'total_price' => $final_price,
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if (!$booking_id) {
                throw new \Exception('Gagal membuat booking');
            }

            // Upload dokumen peserta
            $participants = $this->request->getPost('participants');
            $ktpFiles = $this->request->getFiles()['ktp'] ?? [];
            $healthFiles = $this->request->getFiles()['health'] ?? [];

            if (!is_dir(FCPATH . 'uploads/documents')) {
                mkdir(FCPATH . 'uploads/documents', 0777, true);
            }

            if ($participants && is_array($participants)) {
                foreach ($participants as $i => $p) {
                    $ktpName = null;
                    $healthName = null;

                    if (isset($ktpFiles[$i]) && $ktpFiles[$i]->isValid() && !$ktpFiles[$i]->hasMoved()) {
                        $ktpName = $ktpFiles[$i]->getRandomName();
                        $ktpFiles[$i]->move(FCPATH . 'uploads/documents', $ktpName);
                    }

                    if (isset($healthFiles[$i]) && $healthFiles[$i]->isValid() && !$healthFiles[$i]->hasMoved()) {
                        $healthName = $healthFiles[$i]->getRandomName();
                        $healthFiles[$i]->move(FCPATH . 'uploads/documents', $healthName);
                    }

                    $this->documentModel->insert([
                        'booking_id' => $booking_id,
                        'name' => $p['name'] ?? null,
                        'email' => $p['email'] ?? null,
                        'birthdate' => $p['birthdate'] ?? null,
                        'gender' => $p['gender'] ?? null,
                        'ktp' => $ktpName,
                        'health' => $healthName,
                        'status' => 'pending'
                    ]);
                }
            }

            // Create payment record
            $paymentData = [
                'booking_id' => $booking_id,
                'method' => $payment_method,
                'amount' => $final_price,
                'status' => 'pending',
                'paid_at' => null,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $paymentFile = $this->request->getFile('payment_proof');
            if ($paymentFile && $paymentFile->isValid() && !$paymentFile->hasMoved()) {
                if (!is_dir(FCPATH . 'uploads/payments')) {
                    mkdir(FCPATH . 'uploads/payments', 0777, true);
                }

                $paymentName = $paymentFile->getRandomName();
                $paymentFile->move(FCPATH . 'uploads/payments', $paymentName);
                $paymentData['proof'] = $paymentName;
            }

            $this->paymentModel->insert($paymentData);

            // Kurangi kuota
            $available = ($schedule['available'] ?? 0) - $participant;

            if ($available < 0) {
                $available = 0;
            }

            $this->scheduleModel->update($schedule_id, [
                'available' => $available,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if ($available == 0) {
                $this->tripModel->update($schedule['trip_id'], [
                    'status' => 'full'
                ]);
            }

            // Potong poin jika ada
            if ($redeem_point > 0) {
                $user = $this->userModel->find($user_id);
                $currentPoints = $user['points'] ?? 0;
                $newPoints = $currentPoints - $redeem_point;

                if ($newPoints < 0) $newPoints = 0;

                $this->userModel->update($user_id, [
                    'points' => $newPoints
                ]);

                session()->set('points', $newPoints);
            }

            $db->transCommit();

            return redirect()->to('/booking/detail/' . $booking_id)
                ->with('success', 'Booking berhasil dibuat! Silakan upload bukti pembayaran untuk verifikasi.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal membuat booking: ' . $e->getMessage());
        }
    }

    /*
    =====================================
    DETAIL BOOKING - DIPERBAIKI
    =====================================
    */

    public function detail($booking_id)
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        // Gunakan method baru untuk mengambil booking dengan meeting point
        $booking = $this->bookingModel->getBookingWithMeetingPoint($booking_id, $user_id);

        if (!$booking) {
            return redirect()->to('/dashboard');
        }

        $schedule = $this->scheduleModel->find($booking['schedule_id']);
        $trip = $this->tripModel->find($schedule['trip_id']);

        $payment = $this->paymentModel
            ->where('booking_id', $booking_id)
            ->first();

        $documents = $this->documentModel
            ->where('booking_id', $booking_id)
            ->findAll();

        // Format meeting point display
        if (!empty($booking['meeting_point_name'])) {
            $meetingPointDisplay = $booking['meeting_point_name'];
            if (!empty($booking['meeting_point_address'])) {
                $meetingPointDisplay .= ' - ' . $booking['meeting_point_address'];
            }
        } else {
            $meetingPointDisplay = 'Meeting point akan diinformasikan setelah booking dikonfirmasi';
        }

        return view('booking/detail', [
            'booking' => $booking,
            'schedule' => $schedule,
            'trip' => $trip,
            'payment' => $payment,
            'documents' => $documents,
            'meetingPointDisplay' => $meetingPointDisplay
        ]);
    }

    /*
    =====================================
    UPLOAD PAYMENT PROOF
    =====================================
    */

    public function uploadPayment($booking_id)
    {
        $user_id = session()->get('user_id');

        $booking = $this->bookingModel
            ->where('booking_id', $booking_id)
            ->where('user_id', $user_id)
            ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan');
        }

        $paymentFile = $this->request->getFile('payment_proof');

        if (!$paymentFile || !$paymentFile->isValid()) {
            return redirect()->back()->with('error', 'File bukti pembayaran tidak valid');
        }

        $maxSize = 5 * 1024 * 1024;
        if ($paymentFile->getSize() > $maxSize) {
            return redirect()->back()->with('error', 'Ukuran file maksimal 5MB');
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
        if (!in_array($paymentFile->getMimeType(), $allowedTypes)) {
            return redirect()->back()->with('error', 'Format file harus JPG, PNG, atau PDF');
        }

        if (!is_dir(FCPATH . 'uploads/payments')) {
            mkdir(FCPATH . 'uploads/payments', 0777, true);
        }

        $paymentName = $paymentFile->getRandomName();
        $paymentFile->move(FCPATH . 'uploads/payments', $paymentName);

        $payment = $this->paymentModel
            ->where('booking_id', $booking_id)
            ->first();

        if ($payment) {
            if (!empty($payment['proof']) && file_exists(FCPATH . 'uploads/payments/' . $payment['proof'])) {
                unlink(FCPATH . 'uploads/payments/' . $payment['proof']);
            }

            $this->paymentModel->update($payment['payment_id'], [
                'proof' => $paymentName,
                'status' => 'pending',
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $this->paymentModel->insert([
                'booking_id' => $booking_id,
                'proof' => $paymentName,
                'method' => $this->request->getPost('payment_method'),
                'amount' => $booking['total_price'],
                'status' => 'pending',
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->to('/booking/detail/' . $booking_id)
            ->with('success', 'Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.');
    }

    /*
    =====================================
    HISTORY BOOKING
    =====================================
    */

    public function history()
    {
        $user_id = session()->get('user_id');

        $bookings = $this->bookingModel
            ->select('
                bookings.*,
                trips.title as trip_title,
                schedules.departure_date,
                payments.status as payment_status,
                payments.proof
            ')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->join('payments', 'payments.booking_id = bookings.booking_id', 'left')
            ->where('bookings.user_id', $user_id)
            ->orderBy('bookings.created_at', 'DESC')
            ->findAll();

        return view('booking/history', [
            'bookings' => $bookings
        ]);
    }
}
