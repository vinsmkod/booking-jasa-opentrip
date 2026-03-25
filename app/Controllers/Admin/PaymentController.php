<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaymentModel;
use App\Models\BookingModel;
use App\Models\ScheduleModel;
use App\Models\TripModel;
use App\Models\LoyaltyModel;
use App\Models\UserModel;

class PaymentController extends BaseController
{
    protected $paymentModel;
    protected $bookingModel;
    protected $scheduleModel;
    protected $tripModel;
    protected $loyaltyModel;
    protected $userModel;

    public function __construct()
    {
        $this->paymentModel  = new PaymentModel();
        $this->bookingModel  = new BookingModel();
        $this->scheduleModel = new ScheduleModel();
        $this->tripModel     = new TripModel();
        $this->loyaltyModel  = new LoyaltyModel();
        $this->userModel     = new UserModel();
    }

    /**
     * List all payments
     */
    public function index()
    {
        $payments = $this->paymentModel
            ->select('
                payments.*,
                bookings.booking_code,
                users.name as user_name,
                trips.title as trip_title,
                schedules.departure_date
            ')
            ->join('bookings', 'bookings.booking_id = payments.booking_id')
            ->join('users', 'users.user_id = bookings.user_id')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->orderBy('payments.created_at', 'DESC')
            ->findAll();

        return view('admin/payments/index', ['payments' => $payments]);
    }

    /**
     * Approve payment and confirm booking
     */
    public function approve($payment_id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $payment = $this->paymentModel->find($payment_id);

            if (!$payment) {
                throw new \Exception('Payment tidak ditemukan');
            }

            // Check if already approved
            if ($payment['status'] == 'verified') {
                throw new \Exception('Pembayaran sudah diverifikasi');
            }

            $booking = $this->bookingModel->find($payment['booking_id']);

            if (!$booking) {
                throw new \Exception('Booking tidak ditemukan');
            }

            // Check if booking already confirmed
            if ($booking['status'] == 'confirmed') {
                throw new \Exception('Booking sudah dikonfirmasi');
            }

            $schedule = $this->scheduleModel->find($booking['schedule_id']);

            if (!$schedule) {
                throw new \Exception('Schedule tidak ditemukan');
            }

            // ======================
            // UPDATE PAYMENT
            // ======================
            $this->paymentModel->update($payment_id, [
                'status' => 'verified',
                'paid_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // ======================
            // UPDATE BOOKING
            // ======================
            $this->bookingModel->update($booking['booking_id'], [
                'status' => 'confirmed',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // ======================
            // UPDATE KUOTA SCHEDULE
            // ======================
            $newAvailable = $schedule['available'] - $booking['participant'];

            if ($newAvailable < 0) {
                $newAvailable = 0;
            }

            $this->scheduleModel->update($schedule['schedule_id'], [
                'available' => $newAvailable,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Jika kuota habis, set trip status jadi full
            if ($newAvailable == 0) {
                $this->tripModel->update($schedule['trip_id'], [
                    'status' => 'full'
                ]);
            }

            // ======================
            // TAMBAH LOYALTY POINT (10 points per booking)
            // ======================
            $pointsReward = 10;

            // Simpan riwayat poin
            $this->loyaltyModel->insert([
                'user_id'     => $booking['user_id'],
                'booking_id'  => $booking['booking_id'],
                'points'      => $pointsReward,
                'description' => 'Reward booking trip - ' . date('d M Y'),
                'created_at'  => date('Y-m-d H:i:s')
            ]);

            // Update user points
            $user = $this->userModel->find($booking['user_id']);

            if ($user) {
                $currentPoints = $user['points'] ?? 0;
                $newPoints = $currentPoints + $pointsReward;

                $this->userModel->update($booking['user_id'], [
                    'points' => $newPoints,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                // Update session jika user sedang login
                if (session()->get('user_id') == $booking['user_id']) {
                    session()->set('points', $newPoints);
                }
            }

            $db->transCommit();

            return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi, booking dikonfirmasi & poin loyalty diberikan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal memverifikasi pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Reject payment
     */
    public function reject($payment_id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $payment = $this->paymentModel->find($payment_id);

            if (!$payment) {
                throw new \Exception('Payment tidak ditemukan');
            }

            // Check if already approved
            if ($payment['status'] == 'verified') {
                throw new \Exception('Pembayaran sudah diverifikasi, tidak bisa ditolak');
            }

            // Update payment status
            $this->paymentModel->update($payment_id, [
                'status' => 'rejected',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Update booking status to cancelled
            $this->bookingModel->update($payment['booking_id'], [
                'status' => 'cancelled',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $db->transCommit();

            return redirect()->back()->with('success', 'Pembayaran ditolak dan booking dibatalkan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal menolak pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * View payment detail
     */
    public function detail($payment_id)
    {
        $payment = $this->paymentModel
            ->select('
                payments.*,
                bookings.booking_code,
                bookings.participant,
                bookings.total_price,
                bookings.created_at as booking_date,
                users.name as user_name,
                users.email as user_email,
                trips.title as trip_title,
                trips.location as trip_location,
                schedules.departure_date
            ')
            ->join('bookings', 'bookings.booking_id = payments.booking_id')
            ->join('users', 'users.user_id = bookings.user_id')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->where('payments.payment_id', $payment_id)
            ->first();

        if (!$payment) {
            return redirect()->to('/admin/payments')->with('error', 'Payment tidak ditemukan');
        }

        return view('admin/payments/detail', ['payment' => $payment]);
    }
}
