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

    public function approve($payment_id)
    {
        $payment = $this->paymentModel->find($payment_id);

        if(!$payment){
            return redirect()->back()->with('error','Payment tidak ditemukan');
        }

        $booking = $this->bookingModel->find($payment['booking_id']);

        if(!$booking){
            return redirect()->back()->with('error','Booking tidak ditemukan');
        }

        $schedule = $this->scheduleModel->find($booking['schedule_id']);

        if(!$schedule){
            return redirect()->back()->with('error','Schedule tidak ditemukan');
        }

        // ======================
        // UPDATE PAYMENT
        // ======================

        $this->paymentModel->update($payment_id, [
            'status' => 'paid'
        ]);

        // ======================
        // UPDATE BOOKING
        // ======================

        $this->bookingModel->update($booking['booking_id'], [
            'status' => 'confirmed'
        ]);

        // ======================
        // UPDATE KUOTA
        // ======================

        $newAvailable = $schedule['available'] - $booking['participant'];

        if($newAvailable < 0){
            $newAvailable = 0;
        }

        $this->scheduleModel->update($schedule['schedule_id'], [
            'available' => $newAvailable
        ]);

        // Jika kuota habis
        if($newAvailable == 0){
            $this->tripModel->update($schedule['trip_id'], [
                'status' => 'full'
            ]);
        }

        // ======================
        // TAMBAH LOYALTY POINT
        // ======================

        $pointsReward = 10;

        // Simpan riwayat poin
        $this->loyaltyModel->insert([
            'user_id' => $booking['user_id'],
            'booking_id' => $booking['booking_id'],
            'points' => $pointsReward,
            'description' => 'Reward booking trip'
        ]);

        // Ambil user
        $user = $this->userModel->find($booking['user_id']);

        if($user){

            $currentPoints = $user['points'] ?? 0;

            $newPoints = $currentPoints + $pointsReward;

            // Update database
            $this->userModel->update($booking['user_id'], [
                'points' => $newPoints
            ]);

            // ======================
            // UPDATE SESSION
            // ======================

            if(session()->get('user_id') == $booking['user_id']){
                session()->set('points', $newPoints);
            }

        }

        return redirect()->back()->with('success','Pembayaran berhasil diverifikasi & poin diberikan');
    }
}