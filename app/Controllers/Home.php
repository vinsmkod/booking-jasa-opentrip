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

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
        $this->tripModel    = new TripModel();
        $this->commentModel = new CommentModel();
    }

    public function index()
    {
        $trips = $this->tripModel
            ->select('
                trips.trip_id,
                trips.title,
                trips.type,
                trips.location,
                trips.description,
                trips.price,
                trips.status,
                MIN(schedules.schedule_id) as schedule_id,
                MIN(schedules.departure_date) as departure_date,
                MIN(schedules.quota) as quota,
                MIN(schedules.available) as available
            ')
            ->join('schedules', 'schedules.trip_id = trips.trip_id', 'left')
            ->where('trips.status', 'active')
            ->groupBy('trips.trip_id')
            ->orderBy('trips.trip_id', 'DESC')
            ->findAll();

        $gallery = $this->galleryModel
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->findAll();

        $comments = $this->commentModel
            ->select('comments.*, users.name')
            ->join('users','users.user_id = comments.user_id')
            ->where('comments.status','approved')
            ->orderBy('comments.created_at','DESC')
            ->limit(6)
            ->findAll();

        $data = [
            'trips' => $trips,
            'galleryPhotos' => $gallery,
            'comments' => $comments
        ];

        return view('home', $data);
    }
}