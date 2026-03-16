<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ItineraryModel;
use App\Models\TripModel;

class ItineraryController extends BaseController
{
    protected $itineraryModel;
    protected $tripModel;

    public function __construct()
    {
        $this->itineraryModel = new ItineraryModel();
        $this->tripModel = new TripModel();
    }

    /*
    |--------------------------------------------------------------------------
    | LIST ITINERARY
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $db = \Config\Database::connect();

        $itinerary = $db->table('trip_itinerary')
            ->select('trip_itinerary.*, trips.title as trip_title')
            ->join('trips', 'trips.trip_id = trip_itinerary.trip_id')
            ->orderBy('trip_itinerary.time', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Kelola Itinerary',
            'itinerary' => $itinerary
        ];

        return view('admin/itinerary/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data = [
            'title' => 'Tambah Itinerary',
            'trips' => $this->tripModel->findAll()
        ];

        return view('admin/itinerary/create', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $this->itineraryModel->save([
            'trip_id' => $this->request->getPost('trip_id'),
            'time' => $this->request->getPost('time'),
            'activity' => $this->request->getPost('activity')
        ]);

        return redirect()->to('/admin/itinerary')
            ->with('success', 'Itinerary berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Itinerary',
            'itinerary' => $this->itineraryModel->find($id),
            'trips' => $this->tripModel->findAll()
        ];

        return view('admin/itinerary/edit', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $this->itineraryModel->update($id, [
            'trip_id' => $this->request->getPost('trip_id'),
            'time' => $this->request->getPost('time'),
            'activity' => $this->request->getPost('activity')
        ]);

        return redirect()->to('/admin/itinerary')
            ->with('success', 'Itinerary berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $this->itineraryModel->delete($id);

        return redirect()->to('/admin/itinerary')
            ->with('success', 'Itinerary berhasil dihapus');
    }
}