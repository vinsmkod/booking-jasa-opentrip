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

    return view('admin/dashboard', [
        'totalTrips'    => $tripModel->countAll(),
        'totalBookings' => $bookingModel->countAll(),
        'totalUsers'    => $userModel->countAll(),
        'totalRevenue'  => $bookingModel->selectSum('total_price')->get()->getRow()->total_price ?? 0
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