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
    | FORM EDIT INCLUDE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Include',
            'include' => $this->includeModel->find($id),
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