<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\UserModel;
use App\Models\PaymentModel;
use App\Models\ScheduleModel;
use App\Models\TripModel;
use App\Models\DocumentModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $userModel;
    protected $paymentModel;
    protected $scheduleModel;
    protected $tripModel;
    protected $documentModel;

    public function __construct()
    {
        $this->bookingModel  = new BookingModel();
        $this->userModel     = new UserModel();
        $this->paymentModel  = new PaymentModel();
        $this->scheduleModel = new ScheduleModel();
        $this->tripModel     = new TripModel();
        $this->documentModel = new DocumentModel();
    }

    /**
     * ✅ INDEX (SUDAH FULL FIX)
     */
    public function index()
    {
        // ======================
        // BOOKING DATA
        // ======================
        $bookings = $this->bookingModel
            ->select('
                bookings.*,
                users.name as username,
                users.email as user_email,
                trips.title as trip_title,
                trips.location as trip_location,
                schedules.departure_date,
                payments.payment_id,
                payments.method,
                payments.proof,
                payments.status as payment_status,
                payments.amount as payment_amount
            ')
            ->join('users', 'users.user_id = bookings.user_id')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->join('payments', 'payments.booking_id = bookings.booking_id', 'left')
            ->orderBy('bookings.created_at', 'DESC')
            ->findAll();

        // ======================
        // DOCUMENT DATA
        // ======================
        $documents = $this->documentModel
            ->select('
                documents.*,
                bookings.booking_code
            ')
            ->join('bookings', 'bookings.booking_id = documents.booking_id')
            ->findAll();

        // ======================
        // OPTIMASI: MAP BOOKING
        // ======================
        $bookingMap = [];
        foreach ($bookings as $b) {
            $bookingMap[$b['booking_id']] = $b;
        }

        // ======================
        // FORMAT PESERTA
        // ======================
        $bookingPeserta = [];

        foreach ($documents as $doc) {
            $bid = $doc['booking_id'];

            if (!isset($bookingPeserta[$bid])) {
                $bk = $bookingMap[$bid] ?? null;

                $bookingPeserta[$bid] = [
                    'booking_code' => $doc['booking_code'] ?? '-',
                    'trip_title'   => $bk['trip_title'] ?? '-',
                    'status'       => $bk['status'] ?? 'pending',
                    'peserta'      => []
                ];
            }

            $bookingPeserta[$bid]['peserta'][] = [
                'name'      => $doc['name'],
                'gender'    => $doc['gender'],
                'email'     => $doc['email'],
                'birthdate' => $doc['birthdate']
            ];
        }

        return view('admin/bookings/index', [
            'bookings'       => $bookings,
            'documents'      => $documents,
            'bookingPeserta' => $bookingPeserta
        ]);
    }

    /**
     * ✅ CONFIRM BOOKING
     */
    public function confirm($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $booking = $this->bookingModel->find($id);

            if (!$booking) {
                throw new \Exception('Booking tidak ditemukan');
            }

            if ($booking['status'] === 'confirmed') {
                throw new \Exception('Booking sudah dikonfirmasi');
            }

            $schedule = $this->scheduleModel->find($booking['schedule_id']);

            if (!$schedule) {
                throw new \Exception('Schedule tidak ditemukan');
            }

            // ======================
            // PAYMENT
            // ======================
            $payment = $this->paymentModel
                ->where('booking_id', $id)
                ->first();

            if (!$payment) {
                $this->paymentModel->insert([
                    'booking_id' => $id,
                    'method'     => 'Manual Verification',
                    'amount'     => $booking['total_price'],
                    'status'     => 'verified',
                    'paid_at'    => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                $this->paymentModel->update($payment['payment_id'], [
                    'status'     => 'verified',
                    'paid_at'    => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            // ======================
            // BOOKING STATUS
            // ======================
            $this->bookingModel->update($id, [
                'status'     => 'confirmed',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // ======================
            // UPDATE KUOTA
            // ======================
            if ($schedule['available'] < $booking['participant']) {
                throw new \Exception('Gagal konfirmasi: Sisa kuota tidak mencukupi (' . $schedule['available'] . ' sisa)');
            }

            $newAvailable = $schedule['available'] - $booking['participant'];

            $this->scheduleModel->update($schedule['schedule_id'], [
                'available'  => $newAvailable,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if ($newAvailable === 0) {
                $this->tripModel->update($schedule['trip_id'], [
                    'status' => 'full'
                ]);
            }


            $db->transCommit();

            return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * ✅ CANCEL BOOKING
     */
    public function cancel($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $booking = $this->bookingModel->find($id);

            if (!$booking) {
                throw new \Exception('Booking tidak ditemukan');
            }

            if ($booking['status'] === 'cancelled') {
                throw new \Exception('Booking sudah dibatalkan');
            }

            $this->bookingModel->update($id, [
                'status' => 'cancelled'
            ]);

            $payment = $this->paymentModel
                ->where('booking_id', $id)
                ->first();

            if ($payment && $payment['status'] != 'verified') {
                $this->paymentModel->update($payment['payment_id'], [
                    'status' => 'rejected'
                ]);
            }

            // restore quota
            if ($booking['status'] === 'confirmed') {
                $schedule = $this->scheduleModel->find($booking['schedule_id']);

                if ($schedule) {
                    $this->scheduleModel->update($schedule['schedule_id'], [
                        'available' => $schedule['available'] + $booking['participant']
                    ]);
                }
            }

            $db->transCommit();

            return redirect()->back()->with('success', 'Booking dibatalkan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}