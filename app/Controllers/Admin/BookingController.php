<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\UserModel;
use App\Models\PaymentModel;
use App\Models\ScheduleModel;
use App\Models\TripModel;
use App\Models\LoyaltyModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $userModel;
    protected $paymentModel;
    protected $scheduleModel;
    protected $tripModel;
    protected $loyaltyModel;

    public function __construct()
    {
        $this->bookingModel  = new BookingModel();
        $this->userModel     = new UserModel();
        $this->paymentModel  = new PaymentModel();
        $this->scheduleModel = new ScheduleModel();
        $this->tripModel     = new TripModel();
        $this->loyaltyModel  = new LoyaltyModel();
    }

    // ==============================
    // LIST SEMUA BOOKING
    // ==============================
    public function index()
    {
        $bookings = $this->bookingModel
            ->select('
                bookings.*,
                users.name as username,
                trips.title as trip_title,
                payments.method,
                payments.proof,
                payments.status as payment_status
            ')
            ->join('users',    'users.user_id = bookings.user_id')
            ->join('schedules','schedules.schedule_id = bookings.schedule_id')
            ->join('trips',    'trips.trip_id = schedules.trip_id')
            ->join('payments', 'payments.booking_id = bookings.booking_id', 'left')
            ->orderBy('bookings.created_at', 'DESC')
            ->findAll();

        return view('admin/bookings/index', ['bookings' => $bookings]);
    }

    // ==============================
    // KONFIRMASI BOOKING + APPROVE PAYMENT + KUOTA + LOYALTY
    // ==============================
    public function confirm($id)
    {
        $booking = $this->bookingModel->find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan');
        }
        if ($booking['status'] === 'confirmed') {
            return redirect()->back()->with('error', 'Booking sudah dikonfirmasi');
        }

        // ======================
        // 1. UPDATE BOOKING
        // ======================
        $this->bookingModel->update($id, ['status' => 'confirmed']);

        // ======================
        // 2. UPDATE PAYMENT (jika ada)
        // ======================
        $payment = $this->paymentModel
            ->where('booking_id', $id)
            ->first();

        if ($payment) {
            $this->paymentModel->update($payment['payment_id'], [
                'status' => 'verified'
            ]);
        }

        // ======================
        // 3. UPDATE KUOTA SCHEDULE
        // ======================
        $schedule = $this->scheduleModel->find($booking['schedule_id']);

        if ($schedule) {
            $newAvailable = max(0, $schedule['available'] - $booking['participant']);

            $this->scheduleModel->update($schedule['schedule_id'], [
                'available' => $newAvailable
            ]);

            // Jika kuota habis, set trip jadi full
            if ($newAvailable === 0) {
                $this->tripModel->update($schedule['trip_id'], [
                    'status' => 'full'
                ]);
            }
        }

        // ======================
        // 4. LOYALTY POINT
        // ======================
        $pointsReward = 10;

        $this->loyaltyModel->insert([
            'user_id'     => $booking['user_id'],
            'booking_id'  => $booking['booking_id'],
            'points'      => $pointsReward,
            'description' => 'Reward booking trip'
        ]);

        $user = $this->userModel->find($booking['user_id']);

        if ($user) {
            $newPoints = ($user['points'] ?? 0) + $pointsReward;

            $this->userModel->update($booking['user_id'], [
                'points' => $newPoints
            ]);

            // Sync session jika admin login sebagai user tersebut
            if (session()->get('user_id') == $booking['user_id']) {
                session()->set('points', $newPoints);
            }
        }

        return redirect()->back()->with('success', 'Booking dikonfirmasi, pembayaran disetujui & poin diberikan');
    }

    // ==============================
    // CANCEL BOOKING
    // ==============================
    public function cancel($id)
    {
        $booking = $this->bookingModel->find($id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan');
        }

        $this->bookingModel->update($id, ['status' => 'cancelled']);

        // Optional: kembalikan kuota jika sebelumnya confirmed
        // (uncomment jika diperlukan)
        // if ($booking['status'] === 'confirmed') {
        //     $schedule = $this->scheduleModel->find($booking['schedule_id']);
        //     if ($schedule) {
        //         $this->scheduleModel->update($schedule['schedule_id'], [
        //             'available' => $schedule['available'] + $booking['participant']
        //         ]);
        //     }
        // }

        return redirect()->back()->with('success', 'Booking berhasil dibatalkan');
    }
}