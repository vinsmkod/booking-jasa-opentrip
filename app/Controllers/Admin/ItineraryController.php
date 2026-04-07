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
    | SIMPAN DATA BATCH (MULTIPLE)
    |--------------------------------------------------------------------------
    */

    public function storeBatch()
    {
        $tripId = $this->request->getPost('trip_id');
        $times = $this->request->getPost('time');
        $activities = $this->request->getPost('activity');

        if (!$tripId || !is_array($times) || !is_array($activities)) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        $data = [];
        foreach ($times as $key => $time) {
            if (!empty($time) && !empty($activities[$key] ?? null)) {
                $data[] = [
                    'trip_id' => $tripId,
                    'time' => $time,
                    'activity' => $activities[$key]
                ];
            }
        }

        if (!empty($data)) {
            $this->itineraryModel->insertBatch($data);
        }

        return redirect()->to('/admin/itinerary')
            ->with('success', count($data) . ' Itinerary berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $db = \Config\Database::connect();
        
        $itinerary = $this->itineraryModel->find($id);
        $tripId = $itinerary['trip_id'] ?? null;
        
        // Get all itineraries for this trip
        $allItineraries = $db->table('trip_itinerary')
            ->where('trip_id', $tripId)
            ->orderBy('time', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Edit Itinerary',
            'tripId' => $tripId,
            'allItineraries' => $allItineraries,
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

    public function updateBatch()
    {
        $tripId = $this->request->getPost('trip_id');
        $times = $this->request->getPost('time');
        $activities = $this->request->getPost('activity');
        $itineraryIds = $this->request->getPost('itinerary_id');

        if (!$tripId || !is_array($times) || !is_array($activities)) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('trip_itinerary');
        
        foreach ($times as $key => $time) {
            if (!empty($time) && !empty($activities[$key] ?? null)) {
                $itineraryId = $itineraryIds[$key] ?? null;
                
                if ($itineraryId) {
                    // Update existing
                    $db->table('trip_itinerary')
                        ->where('itinerary_id', $itineraryId)
                        ->update([
                            'time' => $time,
                            'activity' => $activities[$key]
                        ]);
                } else {
                    // Insert new
                    $db->table('trip_itinerary')->insert([
                        'trip_id' => $tripId,
                        'time' => $time,
                        'activity' => $activities[$key]
                    ]);
                }
            }
        }

        return redirect()->to('/admin/itinerary')
            ->with('success', 'Itinerary berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->itineraryModel->delete($id);

        return redirect()->to('/admin/itinerary')
            ->with('success', 'Itinerary berhasil dihapus');
    }
}