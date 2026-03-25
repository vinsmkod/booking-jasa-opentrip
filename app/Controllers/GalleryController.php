<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GalleryModel;
use App\Models\TripModel;

class GalleryController extends BaseController
{
    public function index()
    {
        $model = new GalleryModel();
        $tripModel = new TripModel();
        $activeAlbum = $this->request->getGet('album');
        $activeTrip = $this->request->getGet('trip');

        // Build query untuk galeri
        $query = $model->orderBy('created_at', 'DESC');

        // Filter berdasarkan trip jika ada
        if ($activeTrip) {
            $query->where('trip_id', $activeTrip);
        }

        // Filter berdasarkan album jika ada
        if ($activeAlbum) {
            $query->where('album', $activeAlbum);
        }

        // Get all photos
        $galleryPhotos = $query->findAll();

        // Get all unique albums for tab navigation
        $albums = (new GalleryModel())
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->findAll();

        // Get all active trips for filter
        $trips = $tripModel
            ->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        // Get trip info if activeTrip is set
        $selectedTrip = null;
        if ($activeTrip) {
            $selectedTrip = $tripModel->find($activeTrip);
        }

        // Set meta tags for SEO
        $metaTitle = "Galeri Petualangan | BLNTRK OUTDOOR";
        if ($selectedTrip) {
            $metaTitle = "Galeri " . $selectedTrip['title'] . " | BLNTRK OUTDOOR";
        } elseif ($activeAlbum) {
            $metaTitle = "Galeri - $activeAlbum | BLNTRK OUTDOOR";
        }

        $metaDescription = "Kumpulan dokumentasi perjalanan dan kegiatan outdoor bersama BLNTRK OUTDOOR. " .
            ($selectedTrip ? "Lihat foto-foto perjalanan " . $selectedTrip['title'] . " ke " . $selectedTrip['location'] . "." : ($activeAlbum ? "Lihat foto-foto dalam album $activeAlbum." : "Lihat momen-momen terbaik kami."));

        $data = [
            'galleryPhotos' => $galleryPhotos,
            'albums'        => $albums,
            'trips'         => $trips,
            'selectedTrip'  => $selectedTrip,
            'activeAlbum'   => $activeAlbum,
            'activeTrip'    => $activeTrip,
            'title'         => $metaTitle,
            'metaDescription' => $metaDescription,
            'totalPhotos'   => count($galleryPhotos)
        ];

        return view('gallery/index', $data);
    }

    public function album($albumName)
    {
        $model = new GalleryModel();
        $tripModel = new TripModel();
        $albumName = urldecode($albumName);

        $galleryPhotos = $model
            ->where('album', $albumName)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        if (empty($galleryPhotos)) {
            return redirect()->to('/gallery')->with('error', 'Album tidak ditemukan.');
        }

        $albums = (new GalleryModel())
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->findAll();

        $trips = $tripModel
            ->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'galleryPhotos' => $galleryPhotos,
            'albums'        => $albums,
            'trips'         => $trips,
            'selectedTrip'  => null,
            'activeAlbum'   => $albumName,
            'activeTrip'    => null,
            'title'         => "Galeri - $albumName | BLNTRK OUTDOOR",
            'metaDescription' => "Kumpulan dokumentasi perjalanan dalam album $albumName bersama BLNTRK OUTDOOR.",
            'totalPhotos'   => count($galleryPhotos)
        ];

        return view('gallery/index', $data);
    }

    public function trip($tripId)
    {
        $model = new GalleryModel();
        $tripModel = new TripModel();

        $trip = $tripModel->find($tripId);
        if (!$trip) {
            return redirect()->to('/gallery')->with('error', 'Trip tidak ditemukan.');
        }

        $galleryPhotos = $model
            ->where('trip_id', $tripId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $albums = (new GalleryModel())
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->findAll();

        $trips = $tripModel
            ->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'galleryPhotos' => $galleryPhotos,
            'albums'        => $albums,
            'trips'         => $trips,
            'selectedTrip'  => $trip,
            'activeAlbum'   => null,
            'activeTrip'    => $tripId,
            'title'         => "Galeri " . $trip['title'] . " | BLNTRK OUTDOOR",
            'metaDescription' => "Dokumentasi perjalanan " . $trip['title'] . " ke " . $trip['location'] . " bersama BLNTRK OUTDOOR.",
            'totalPhotos'   => count($galleryPhotos)
        ];

        return view('gallery/index', $data);
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');
        $model = new GalleryModel();
        $tripModel = new TripModel();

        $galleryPhotos = [];
        if ($keyword) {
            $galleryPhotos = $model
                ->like('title', $keyword)
                ->orderBy('created_at', 'DESC')
                ->findAll();
        }

        $albums = (new GalleryModel())
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->findAll();

        $trips = $tripModel
            ->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'galleryPhotos' => $galleryPhotos,
            'albums'        => $albums,
            'trips'         => $trips,
            'selectedTrip'  => null,
            'activeAlbum'   => null,
            'activeTrip'    => null,
            'keyword'       => $keyword,
            'title'         => "Hasil Pencarian: $keyword | BLNTRK OUTDOOR",
            'metaDescription' => "Hasil pencarian foto dengan kata kunci '$keyword' di galeri BLNTRK OUTDOOR.",
            'totalPhotos'   => count($galleryPhotos)
        ];

        return view('gallery/index', $data);
    }
}
