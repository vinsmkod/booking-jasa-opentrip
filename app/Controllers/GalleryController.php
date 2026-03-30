<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use App\Models\TripModel;

class GalleryController extends BaseController
{
    protected $galleryModel;
    protected $tripModel;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
        $this->tripModel = new TripModel();
    }

    /**
     * Public gallery page
     */
    public function index()
    {
        $tripId = $this->request->getGet('trip');
        $album = $this->request->getGet('album');

        // Get all trips for filter
        $trips = $this->tripModel->findAll();

        // Get photos with filters
        $query = $this->galleryModel->orderBy('created_at', 'DESC');

        if ($tripId) {
            $query->where('trip_id', $tripId);
            $selectedTrip = $this->tripModel->find($tripId);
        } else {
            $selectedTrip = null;
        }

        if ($album) {
            $query->where('album', $album);
            $activeAlbum = $album;
        } else {
            $activeAlbum = null;
        }

        $galleryPhotos = $query->findAll();

        // Get unique albums for tabs
        $albums = $this->galleryModel
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->findAll();

        $data = [
            'galleryPhotos' => $galleryPhotos,
            'trips' => $trips,
            'albums' => $albums,
            'selectedTrip' => $selectedTrip,
            'activeTrip' => $tripId,
            'activeAlbum' => $activeAlbum
        ];

        return view('gallery/index', $data);
    }

    /**
     * Filter gallery by trip
     */
    public function filterByTrip($tripId)
    {
        $trips = $this->tripModel->findAll();
        $selectedTrip = $this->tripModel->find($tripId);

        $galleryPhotos = $this->galleryModel
            ->where('trip_id', $tripId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $albums = $this->galleryModel
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->where('trip_id', $tripId)
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->findAll();

        $data = [
            'galleryPhotos' => $galleryPhotos,
            'trips' => $trips,
            'albums' => $albums,
            'selectedTrip' => $selectedTrip,
            'activeTrip' => $tripId,
            'activeAlbum' => null
        ];

        return view('gallery/index', $data);
    }

    /**
     * Filter gallery by album
     */
    public function filterByAlbum($albumName)
    {
        $albumName = urldecode($albumName);
        $trips = $this->tripModel->findAll();

        $galleryPhotos = $this->galleryModel
            ->where('album', $albumName)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $albums = $this->galleryModel
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->findAll();

        $data = [
            'galleryPhotos' => $galleryPhotos,
            'trips' => $trips,
            'albums' => $albums,
            'selectedTrip' => null,
            'activeTrip' => null,
            'activeAlbum' => $albumName
        ];

        return view('gallery/index', $data);
    }
}
