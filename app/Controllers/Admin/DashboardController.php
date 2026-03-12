<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TripModel;
use App\Models\BookingModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $tripModel = new TripModel();
        $bookingModel = new BookingModel();
        $userModel = new UserModel();

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

        return view('admin/dashboard', [
            'totalTrips' => $totalTrips,
            'totalBookings' => $totalBookings,
            'totalUsers' => $totalUsers,
            'totalRevenue' => $totalRevenue
        ]);
    }
}