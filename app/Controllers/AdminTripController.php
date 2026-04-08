<?php

namespace App\Controllers;

use App\Models\TripModel;

class AdminTripController extends BaseController
{
    protected $tripModel;

    public function __construct()
    {
        $this->tripModel = new TripModel();
    }

    // =============================
    // LIST
    // =============================
    public function index()
    {
        $data['trips'] = $this->tripModel
            ->orderBy('trip_id', 'DESC')
            ->findAll();

        return view('admin/trips/index', $data);
    }

    // =============================
    // CREATE PAGE
    // =============================
    public function create()
    {
        return view('admin/trips/create');
    }

    // =============================
    // STORE
    // =============================
    public function store()
    {
        $this->tripModel->insert([
            'title'       => $this->request->getPost('title'),
            'location'    => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'status'      => 'active',
            'type'        => $this->request->getPost('type'), // from form select
            'image'       => $this->request->getFile('image') ? $this->uploadImage('image') : null,
        ]);

        return redirect()->to('/admin/trips')
            ->with('success', 'Trip berhasil ditambahkan');
    }

    // =============================
    // EDIT PAGE
    // =============================
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
    // UPDATE
    // =============================
    public function update($trip_id)
    {
        $updateData = [
            'title'       => $this->request->getPost('title'),
            'location'    => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'type'        => $this->request->getPost('type'),
        ];

        if ($this->request->getFile('image')) {
            $updateData['image'] = $this->uploadImage('image');
        }

        $this->tripModel->update($trip_id, $updateData);

        return redirect()->to('/admin/trips')
            ->with('success', 'Trip berhasil diupdate');
    }

    // =============================
    // DELETE
    // =============================
    public function delete($trip_id)
    {
        $this->tripModel->delete($trip_id);

        return redirect()->to('/admin/trips')
            ->with('success', 'Trip berhasil dihapus');
    }

    // =============================
    // EXPORT EXCEL
    // =============================
    public function exportExcel()
    {
        $trips = $this->tripModel->findAll();

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=trips_" . date('Y-m-d_His') . ".xls");

        echo "Trip ID\tTitle\tLocation\tPrice\tType\tStatus\n";

        foreach ($trips as $trip) {
            // Cast numeric fields to remove leading zeros
            $tripId = (int)$trip['trip_id'];
            $price = ($trip['price'] && $trip['price'] !== '') ? (int)$trip['price'] : '0';
            
            echo $tripId . "\t";
            echo ($trip['title'] ?? '-') . "\t";
            echo ($trip['location'] ?? '-') . "\t";
            echo $price . "\t";
            echo ($trip['type'] ?? '-') . "\t";
            echo ($trip['status'] ?? '-') . "\n";
        }

        exit;
    }

    // =============================
    // FUNCTION UPLOAD IMAGE
    // =============================
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