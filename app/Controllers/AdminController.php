<?php

namespace App\Controllers;

use App\Models\TripModel;
use App\Models\UserModel;
use App\Models\BookingModel;
use App\Models\GalleryModel;

class AdminController extends BaseController
{
    protected $tripModel;
    protected $userModel;
    protected $bookingModel;
    protected $galleryModel;

    public function __construct()
    {
        $this->tripModel = new TripModel();
        $this->userModel = new UserModel();
        $this->bookingModel = new BookingModel();
        $this->galleryModel = new GalleryModel();
    }

    public function dashboard()
    {
        // Proteksi jika belum login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Proteksi jika bukan admin
        if (session()->get('role') != 'admin') {
            return redirect()->to('/');
        }

        // Ambil data summary untuk dashboard
        $data = [
            'totalTrips'     => $this->tripModel->countAllResults(),
            'totalUsers'     => $this->userModel->countAllResults(),
            'totalBookings'  => $this->bookingModel->countAllResults(),
            'totalGallery'   => $this->galleryModel->countAllResults()
        ];

        return view('admin/dashboard', $data);
    }
}