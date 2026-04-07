<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TripIncludeModel;
use App\Models\TripModel;

class Includes extends BaseController
{
    protected $includeModel;
    protected $tripModel;

    public function __construct()
    {
        $this->includeModel = new TripIncludeModel();
        $this->tripModel = new TripModel();
    }

    /*
    |--------------------------------------------------------------------------
    | LIST INCLUDE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $db = \Config\Database::connect();

        $includes = $db->table('trip_includes')
            ->select('trip_includes.*, trips.title as trip_title')
            ->join('trips', 'trips.trip_id = trip_includes.trip_id')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Kelola Paket Include',
            'includes' => $includes
        ];

        return view('admin/includes/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH INCLUDE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data = [
            'title' => 'Tambah Include',
            'trips' => $this->tripModel->findAll()
        ];

        return view('admin/includes/create', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN INCLUDE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $this->includeModel->save([
            'trip_id' => $this->request->getPost('trip_id'),
            'title' => $this->request->getPost('title')
        ]);

        return redirect()->to('/admin/includes')
            ->with('success', 'Include berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN INCLUDE BATCH (MULTIPLE)
    |--------------------------------------------------------------------------
    */

    public function storeBatch()
    {
        $tripId = $this->request->getPost('trip_id');
        $titles = $this->request->getPost('title');

        if (!$tripId || !is_array($titles)) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        $data = [];
        foreach ($titles as $title) {
            if (!empty($title)) {
                $data[] = [
                    'trip_id' => $tripId,
                    'title' => $title
                ];
            }
        }

        if (!empty($data)) {
            $this->includeModel->insertBatch($data);
        }

        return redirect()->to('/admin/includes')
            ->with('success', count($data) . ' Include berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT INCLUDE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $db = \Config\Database::connect();
        
        // Get single include to find trip_id
        $include = $this->includeModel->find($id);
        
        if (!$include) {
            return redirect()->to('/admin/includes')->with('error', 'Include tidak ditemukan');
        }
        
        $tripId = $include['trip_id'];
        
        // Get all includes for this trip
        $allIncludes = $db->table('trip_includes')
            ->where('trip_id', $tripId)
            ->orderBy('include_id', 'ASC')
            ->get()
            ->getResultArray();
        
        $data = [
            'title' => 'Edit Include Batch',
            'tripId' => $tripId,
            'allIncludes' => $allIncludes,
            'trips' => $this->tripModel->findAll()
        ];

        return view('admin/includes/edit', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE INCLUDE
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $this->includeModel->update($id, [
            'trip_id' => $this->request->getPost('trip_id'),
            'title' => $this->request->getPost('title')
        ]);

        return redirect()->to('/admin/includes')
            ->with('success', 'Include berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE INCLUDE BATCH (MULTIPLE)
    |--------------------------------------------------------------------------
    */

    public function updateBatch()
    {
        $tripId = $this->request->getPost('trip_id');
        $titles = $this->request->getPost('title');
        $includeIds = $this->request->getPost('include_id');

        if (!$tripId || !is_array($titles)) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        $db = \Config\Database::connect();
        $updateCount = 0;
        $insertCount = 0;

        // Update existing and insert new includes
        foreach ($titles as $idx => $title) {
            if (empty($title)) {
                continue;
            }

            $includeId = isset($includeIds[$idx]) ? $includeIds[$idx] : null;

            if (!empty($includeId)) {
                // Update existing
                $this->includeModel->update($includeId, [
                    'trip_id' => $tripId,
                    'title' => $title
                ]);
                $updateCount++;
            } else {
                // Insert new
                $this->includeModel->insert([
                    'trip_id' => $tripId,
                    'title' => $title
                ]);
                $insertCount++;
            }
        }

        $message = '';
        if ($updateCount > 0) {
            $message .= $updateCount . ' include diupdate';
        }
        if ($insertCount > 0) {
            if ($message) $message .= ', ';
            $message .= $insertCount . ' include ditambahkan';
        }
        if (!$message) {
            $message = 'Tidak ada perubahan';
        }

        return redirect()->to('/admin/includes')
            ->with('success', $message);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE INCLUDE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $this->includeModel->delete($id);

        return redirect()->to('/admin/includes')
            ->with('success', 'Include berhasil dihapus');
    }
}