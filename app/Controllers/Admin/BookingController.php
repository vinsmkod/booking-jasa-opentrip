<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\UserModel;
use App\Models\PaymentModel;
use App\Models\ScheduleModel;
use App\Models\TripModel;
use App\Models\LoyaltyModel;
use App\Models\DocumentModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $userModel;
    protected $paymentModel;
    protected $scheduleModel;
    protected $tripModel;
    protected $loyaltyModel;
    protected $documentModel;

    public function __construct()
    {
        $this->bookingModel  = new BookingModel();
        $this->userModel     = new UserModel();
        $this->paymentModel  = new PaymentModel();
        $this->scheduleModel = new ScheduleModel();
        $this->tripModel     = new TripModel();
        $this->loyaltyModel  = new LoyaltyModel();
        $this->documentModel = new DocumentModel();
    }

    /**
     * List all bookings for admin verification
     */
    public function index()
    {
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

        return view('admin/bookings/index', ['bookings' => $bookings]);
    }

    /**
     * Confirm booking with payment verification
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
            // GET OR CREATE PAYMENT RECORD
            // ======================
            $payment = $this->paymentModel
                ->where('booking_id', $id)
                ->first();

            // If payment record doesn't exist, create one
            if (!$payment) {
                $paymentData = [
                    'booking_id' => $id,
                    'method' => 'Manual Verification',
                    'amount' => $booking['total_price'],
                    'status' => 'verified',
                    'paid_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->paymentModel->insert($paymentData);
            } else {
                // Update existing payment
                $this->paymentModel->update($payment['payment_id'], [
                    'status' => 'verified',
                    'paid_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            // ======================
            // UPDATE BOOKING
            // ======================
            $this->bookingModel->update($id, [
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

            // Jika kuota habis, set trip jadi full
            if ($newAvailable === 0) {
                $this->tripModel->update($schedule['trip_id'], [
                    'status' => 'full'
                ]);
            }

            // ======================
            // LOYALTY POINT (10 points)
            // ======================
            $pointsReward = 10;

            // Check if loyalty point already given
            $existingLoyalty = $this->loyaltyModel
                ->where('booking_id', $booking['booking_id'])
                ->first();

            if (!$existingLoyalty) {
                $this->loyaltyModel->insert([
                    'user_id'     => $booking['user_id'],
                    'booking_id'  => $booking['booking_id'],
                    'points'      => $pointsReward,
                    'description' => 'Reward booking trip - ' . date('d M Y'),
                    'created_at'  => date('Y-m-d H:i:s')
                ]);

                $user = $this->userModel->find($booking['user_id']);

                if ($user) {
                    $newPoints = ($user['points'] ?? 0) + $pointsReward;

                    $this->userModel->update($booking['user_id'], [
                        'points' => $newPoints,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                    // Sync session jika admin login sebagai user tersebut
                    if (session()->get('user_id') == $booking['user_id']) {
                        session()->set('points', $newPoints);
                    }
                }
            }

            $db->transCommit();

            return redirect()->back()->with('success', 'Booking dikonfirmasi, pembayaran disetujui & poin diberikan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal mengkonfirmasi booking: ' . $e->getMessage());
        }
    }

    /**
     * Cancel booking
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

            // Check if already cancelled
            if ($booking['status'] === 'cancelled') {
                throw new \Exception('Booking sudah dibatalkan');
            }

            // Update booking status
            $this->bookingModel->update($id, [
                'status' => 'cancelled',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Update payment if exists and not verified
            $payment = $this->paymentModel
                ->where('booking_id', $id)
                ->first();

            if ($payment && $payment['status'] != 'verified') {
                $this->paymentModel->update($payment['payment_id'], [
                    'status' => 'rejected',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            // Restore quota if booking was confirmed
            if ($booking['status'] === 'confirmed') {
                $schedule = $this->scheduleModel->find($booking['schedule_id']);
                if ($schedule) {
                    $newAvailable = $schedule['available'] + $booking['participant'];
                    $this->scheduleModel->update($schedule['schedule_id'], [
                        'available' => $newAvailable,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                    // Update trip status back to active if it was full
                    $trip = $this->tripModel->find($schedule['trip_id']);
                    if ($trip && $trip['status'] == 'full') {
                        $this->tripModel->update($schedule['trip_id'], [
                            'status' => 'active'
                        ]);
                    }
                }
            }

            $db->transCommit();

            return redirect()->back()->with('success', 'Booking berhasil dibatalkan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal membatalkan booking: ' . $e->getMessage());
        }
    }

    /**
     * View booking detail
     */
    public function detail($id)
    {
        $booking = $this->bookingModel
            ->select('
                bookings.*,
                users.name as username,
                users.email as user_email,
                users.phone as user_phone,
                trips.title as trip_title,
                trips.location as trip_location,
                trips.description as trip_description,
                schedules.departure_date,
                schedules.quota,
                schedules.available as schedule_available,
                payments.payment_id,
                payments.method,
                payments.proof,
                payments.status as payment_status,
                payments.amount as payment_amount,
                payments.paid_at
            ')
            ->join('users', 'users.user_id = bookings.user_id')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->join('payments', 'payments.booking_id = bookings.booking_id', 'left')
            ->where('bookings.booking_id', $id)
            ->first();

        if (!$booking) {
            return redirect()->to('/admin/bookings')->with('error', 'Booking tidak ditemukan');
        }

        // Get participant documents
        $documents = $this->documentModel
            ->where('booking_id', $id)
            ->findAll();

        return view('admin/bookings/detail', [
            'booking' => $booking,
            'documents' => $documents
        ]);
    }

    /**
     * View booking invoice
     */
    public function invoice($id)
    {
        $booking = $this->bookingModel
            ->select('
                bookings.*,
                users.name as username,
                users.email as user_email,
                trips.title as trip_title,
                trips.location as trip_location,
                schedules.departure_date,
                payments.method,
                payments.status as payment_status,
                payments.paid_at
            ')
            ->join('users', 'users.user_id = bookings.user_id')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->join('payments', 'payments.booking_id = bookings.booking_id', 'left')
            ->where('bookings.booking_id', $id)
            ->first();

        if (!$booking) {
            return redirect()->to('/admin/bookings')->with('error', 'Booking tidak ditemukan');
        }

        return view('admin/bookings/invoice', ['booking' => $booking]);
    }
}
