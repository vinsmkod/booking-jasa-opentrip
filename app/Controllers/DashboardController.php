<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BookingModel;
use App\Models\TripModel;
class DashboardController extends BaseController
{
    public function index()
    {
        $role = session()->get('role');

        // Kalau admin
        if ($role === 'admin') {

    $tripModel    = new TripModel();
    $bookingModel = new BookingModel();
    $userModel    = new UserModel();

    $db = \Config\Database::connect();
    
    // Get recent bookings - simple query
    $recentBookings = [];
    try {
        $recentBookings = $db->query("
            SELECT 
                b.booking_id as id,
                COALESCE(u.name, 'Unknown') as nama,
                COALESCE(t.title, 'Unknown Trip') as nama_trip,
                COALESCE(b.status, 'pending') as status,
                COALESCE(b.total_price, 0) as total_price
            FROM bookings b
            LEFT JOIN users u ON u.user_id = b.user_id
            LEFT JOIN schedules s ON s.schedule_id = b.schedule_id
            LEFT JOIN trips t ON t.trip_id = s.trip_id
            ORDER BY b.booking_id DESC
            LIMIT 10
        ")->getResultArray();
    } catch (\Exception $e) {
        $recentBookings = [];
    }

    // Get popular trips - simple query
    $popularTrips = [];
    try {
        $popularTrips = $db->query("
            SELECT 
                t.trip_id as id,
                t.title as nama_trip,
                COUNT(DISTINCT b.booking_id) as total_booking
            FROM trips t
            LEFT JOIN schedules s ON s.trip_id = t.trip_id
            LEFT JOIN bookings b ON b.schedule_id = s.schedule_id AND b.status != 'batal'
            GROUP BY t.trip_id
            HAVING COUNT(b.booking_id) > 0
            ORDER BY total_booking DESC
            LIMIT 5
        ")->getResultArray();
    } catch (\Exception $e) {
        $popularTrips = [];
    }

    return view('admin/dashboard', [
        'totalTrips'     => $tripModel->countAll(),
        'totalBookings'  => $bookingModel->countAll(),
        'totalUsers'     => $userModel->countAll(),
        'totalRevenue'   => $bookingModel->selectSum('total_price')->get()->getRow()->total_price ?? 0,
        'popularTrips'   => $popularTrips,
        'recentBookings' => $recentBookings
    ]);
}

        // Kalau customer
        $userId = session()->get('user_id');

        $userModel    = new UserModel();
        $bookingModel = new BookingModel();

        $user = $userModel->find($userId);

        $totalBooking = $bookingModel
            ->where('user_id', $userId)
            ->countAllResults();

        $points = $user['points'] ?? 0;

        return view('dashboard/index', [
            'totalBooking' => $totalBooking,
            'points'       => $points
        ]);
    }
}