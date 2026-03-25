<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TripModel;

class AdminTripController extends BaseController
{
    protected $tripModel;

    public function __construct()
    {
        $this->tripModel = new TripModel();
    }

    public function index()
    {
        $data['trips'] = $this->tripModel
            ->orderBy('trip_id', 'DESC')
            ->findAll();

        return view('admin/trips/index', $data);
    }

    public function create()
    {
        return view('admin/trips/create');
    }

    // =============================
    // STORE — FIX: simpan whatsapp_group
    // =============================
    public function store()
    {
        $imageFile = $this->request->getFile('image');
        $imageName = null;

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $this->uploadImage('image');
        }

        $this->tripModel->insert([
            'title'          => $this->request->getPost('title'),
            'location'       => $this->request->getPost('location'),
            'description'    => $this->request->getPost('description'),
            'price'          => $this->request->getPost('price'),
            'status'         => $this->request->getPost('status') ?? 'active',
            'type'           => $this->request->getPost('type'),
            'whatsapp_group' => $this->request->getPost('whatsapp_group') ?: null, // FIX
            'image'          => $imageName,
        ]);

        return redirect()->to('/admin/trips')
            ->with('success', 'Trip berhasil ditambahkan');
    }

    public function edit($trip_id)
    {
        $trip = $this->tripModel->find($trip_id);

        if (!$trip) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view('admin/trips/edit', [
            'trip' => $trip
        ]);
    }

    // =============================
    // UPDATE — FIX: simpan whatsapp_group & status
    // =============================
    public function update($trip_id)
    {
        $updateData = [
            'title'          => $this->request->getPost('title'),
            'location'       => $this->request->getPost('location'),
            'description'    => $this->request->getPost('description'),
            'price'          => $this->request->getPost('price'),
            'type'           => $this->request->getPost('type'),
            'status'         => $this->request->getPost('status'),
            'whatsapp_group' => $this->request->getPost('whatsapp_group') ?: null, // FIX
        ];

        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $updateData['image'] = $this->uploadImage('image');
        }

        $this->tripModel->update($trip_id, $updateData);

        return redirect()->to('/admin/trips')
            ->with('success', 'Trip berhasil diupdate');
    }

    public function delete($trip_id)
    {
        $this->tripModel->delete($trip_id);

        return redirect()->to('/admin/trips')
            ->with('success', 'Trip berhasil dihapus');
    }

    public function exportExcel()
    {
        $trips = $this->tripModel->findAll();

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=trips.xls");

        echo "Trip ID\tTitle\tLocation\tPrice\tType\tStatus\n";

        foreach ($trips as $trip) {
            echo $trip['trip_id']  . "\t";
            echo $trip['title']    . "\t";
            echo $trip['location'] . "\t";
            echo $trip['price']    . "\t";
            echo $trip['type']     . "\t";
            echo $trip['status']   . "\n";
        }

        exit;
    }

    private function uploadImage($inputName)
    {
        $file = $this->request->getFile($inputName);
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/trips/', $newName);
            return $newName;
        }
        return null;
    }
}