<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\UserModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $userModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->userModel    = new UserModel();
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
            ->join('users','users.user_id = bookings.user_id')
            ->join('schedules','schedules.schedule_id = bookings.schedule_id')
            ->join('trips','trips.trip_id = schedules.trip_id')
            ->join('payments','payments.booking_id = bookings.booking_id','left')
            ->orderBy('bookings.created_at','DESC')
            ->findAll();

        return view('admin/bookings/index', ['bookings' => $bookings]);
    }

    // ==============================
    // KONFIRMASI BOOKING + LOYALTY POINT
    // ==============================
    public function confirm($id)
    {
        $booking = $this->bookingModel->find($id);
        if (!$booking) return redirect()->back()->with('error','Booking tidak ditemukan');
        if ($booking['status'] == 'confirmed') return redirect()->back()->with('error','Booking sudah dikonfirmasi');

        // Update status
        $this->bookingModel->update($id, ['status' => 'confirmed']);

        // Tambah loyalty point
        $user = $this->userModel->find($booking['user_id']);
        if ($user) {
            $currentPoint = $user['points'] ?? 0;
            $this->userModel->update($booking['user_id'], ['points' => $currentPoint + 10]);
        }

        return redirect()->back()->with('success','Booking berhasil dikonfirmasi +10 point');
    }

    // ==============================
    // CANCEL BOOKING
    // ==============================
    public function cancel($id)
    {
        $booking = $this->bookingModel->find($id);
        if (!$booking) return redirect()->back()->with('error','Booking tidak ditemukan');

        $this->bookingModel->update($id, ['status' => 'cancelled']);

        return redirect()->back()->with('success','Booking berhasil dibatalkan');
    }
}