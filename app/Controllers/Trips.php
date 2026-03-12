<?php

namespace App\Controllers;

use App\Models\TripModel;
use App\Models\GalleryModel;
use App\Models\ScheduleModel;

class Trips extends BaseController
{
    protected $tripModel;
    protected $galleryModel;
    protected $scheduleModel;

    public function __construct()
    {
        $this->tripModel     = new TripModel();
        $this->galleryModel  = new GalleryModel();
        $this->scheduleModel = new ScheduleModel();
    }

    // Halaman semua trip + gallery
    public function index()
    {

        $trips = $this->tripModel
            ->where('status', 'active')
            ->orderBy('trip_id', 'DESC')
            ->findAll();

        // ambil schedule untuk setiap trip
        foreach ($trips as &$trip) {

            $schedule = $this->scheduleModel
                ->where('trip_id', $trip['trip_id'])
                ->orderBy('departure_date', 'ASC')
                ->first();

            if ($schedule) {
                $trip['schedule_id']   = $schedule['schedule_id'];
                $trip['departure_date'] = $schedule['departure_date'];
                $trip['quota']          = $schedule['quota'];
                $trip['available']      = $schedule['available'];
            } else {
                $trip['schedule_id']   = null;
                $trip['departure_date'] = null;
                $trip['quota']          = null;
                $trip['available']      = null;
            }
        }

        $data = [
            'trips' => $trips,

            'galleryPhotos' => $this->galleryModel
                ->orderBy('created_at', 'DESC')
                ->findAll(),
        ];

        return view('trips/gallery', $data);
    }


    // Menampilkan trip berdasarkan kategori
    public function byType($type)
    {
        $allowedTypes = ['one_day_trip', 'open_trip', 'private_trip'];

        if (!in_array($type, $allowedTypes)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $trips = $this->tripModel
            ->where('type', $type)
            ->where('status', 'active')
            ->orderBy('trip_id', 'DESC')
            ->findAll();

        foreach ($trips as &$trip) {

            $schedule = $this->scheduleModel
                ->where('trip_id', $trip['trip_id'])
                ->orderBy('departure_date', 'ASC')
                ->first();

            if ($schedule) {
                $trip['schedule_id']   = $schedule['schedule_id'];
                $trip['departure_date'] = $schedule['departure_date'];
                $trip['quota']          = $schedule['quota'];
                $trip['available']      = $schedule['available'];
            } else {
                $trip['schedule_id']   = null;
                $trip['departure_date'] = null;
                $trip['quota']          = null;
                $trip['available']      = null;
            }
        }

        $data = [
            'trips' => $trips,
            'type'  => $type
        ];

        return view('trips/list', $data);
    }
}