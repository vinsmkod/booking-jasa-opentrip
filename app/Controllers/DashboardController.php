<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BookingModel;
use App\Models\TripModel;

class DashboardController extends BaseController
{
    // =========================================================
    // PUBLIK — Dashboard Pelanggan
    // =========================================================

    public function index()
    {
        $userId = session()->get('user_id');

        $userModel    = new UserModel();
        $bookingModel = new BookingModel();

        $user = $userModel->find($userId);

        $totalBooking = $bookingModel
            ->where('user_id', $userId)
            ->where('status', 'confirmed')
            ->countAllResults();

        $points = $user['points'] ?? 0;

        return view('dashboard/index', [
            'totalBooking' => $totalBooking,
            'points'       => $points
        ]);
    }

    // =========================================================
    // ADMIN — Dashboard Admin
    // =========================================================

    public function adminIndex()
    {
        $tripModel    = new TripModel();
        $bookingModel = new BookingModel();
        $userModel    = new UserModel();

        // Hitung total trip
        $totalTrips = $tripModel->countAll();

        // Hitung total booking
        $totalBookings = $bookingModel->countAll();

        // Hitung total user customer
        $totalUsers = $userModel
            ->where('role', 'customer')
            ->countAllResults();

        // Hitung total revenue
        $revenue = $bookingModel
            ->selectSum('total_price')
            ->where('status', 'confirmed')
            ->first();

        $totalRevenue = $revenue['total_price'] ?? 0;

        // Booking terbaru (8 terakhir)
        $recentBookings = $bookingModel
            ->select('bookings.booking_id as id, users.name as nama, trips.title as nama_trip, bookings.status, bookings.total_price, bookings.created_at')
            ->join('users', 'users.user_id = bookings.user_id', 'left')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id', 'left')
            ->join('trips', 'trips.trip_id = schedules.trip_id', 'left')
            ->orderBy('bookings.created_at', 'DESC')
            ->limit(8)
            ->findAll();

        // Trip terpopuler (top 5 berdasarkan jumlah booking)
        $popularTrips = $bookingModel
            ->select('trips.title as nama_trip, COUNT(bookings.booking_id) as total_booking')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id', 'left')
            ->join('trips', 'trips.trip_id = schedules.trip_id', 'left')
            ->groupBy('trips.trip_id')
            ->orderBy('total_booking', 'DESC')
            ->limit(5)
            ->findAll();

        return view('admin/dashboard', [
            'totalTrips'     => $totalTrips,
            'totalBookings'  => $totalBookings,
            'totalUsers'     => $totalUsers,
            'totalRevenue'   => $totalRevenue,
            'recentBookings' => $recentBookings,
            'popularTrips'   => $popularTrips,
        ]);
    }
}
