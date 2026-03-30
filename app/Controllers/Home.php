<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use App\Models\TripModel;
use App\Models\CommentModel;

class Home extends BaseController
{
    protected $galleryModel;
    protected $tripModel;
    protected $commentModel;
    protected $db;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
        $this->tripModel    = new TripModel();
        $this->commentModel = new CommentModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil parameter search dari query string
        $keyword = $this->request->getGet('search');

        // Ambil semua trip aktif dengan data jadwal dan booking
        $trips = $this->tripModel->getActiveTripsWithBookings();

        // Filter berdasarkan keyword jika ada
        if (!empty($keyword)) {
            $trips = array_filter($trips, function ($trip) use ($keyword) {
                return stripos($trip['title'], $keyword) !== false ||
                    stripos($trip['location'], $keyword) !== false ||
                    stripos($trip['description'], $keyword) !== false;
            });
            // Reindex array setelah filter
            $trips = array_values($trips);
        }

        // Urutkan trip berdasarkan departure_date terdekat
        usort($trips, function ($a, $b) {
            $dateA = strtotime($a['departure_date']);
            $dateB = strtotime($b['departure_date']);

            // Jika salah satu null, tempatkan di akhir
            if ($dateA === false) return 1;
            if ($dateB === false) return -1;

            return $dateA - $dateB;
        });

        $gallery = $this->galleryModel
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->findAll();

        $comments = $this->commentModel
            ->select('comments.*, users.name')
            ->join('users', 'users.user_id = comments.user_id')
            ->where('comments.status', 'approved')
            ->orderBy('comments.created_at', 'DESC')
            ->limit(6)
            ->findAll();

        $data = [
            'trips' => $trips,
            'galleryPhotos' => $gallery,
            'comments' => $comments,
            'keyword' => $keyword
        ];

        return view('home', $data);
    }
}
