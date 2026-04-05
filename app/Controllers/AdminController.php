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

    public function store()
    {
        $this->tripModel->insert([
            'title'          => $this->request->getPost('title'),
            'location'       => $this->request->getPost('location'),
            'description'    => $this->request->getPost('description'),
            'price'          => $this->request->getPost('price'),
            'status'         => $this->request->getPost('status') ?? 'active',
            'type'           => $this->request->getPost('type'),
            'whatsapp_group' => $this->request->getPost('whatsapp_group') ?: null,
            'image'          => $this->uploadImage('image'),
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

    public function update($trip_id)
    {
        $updateData = [
            'title'          => $this->request->getPost('title'),
            'location'       => $this->request->getPost('location'),
            'description'    => $this->request->getPost('description'),
            'price'          => $this->request->getPost('price'),
            'type'           => $this->request->getPost('type'),
            'status'         => $this->request->getPost('status'),
            'whatsapp_group' => $this->request->getPost('whatsapp_group') ?: null,
            'image'          => $this->uploadImage('image'),
        ];

        // Hapus key image kalau tidak ada file baru supaya tidak overwrite dengan null
        if ($updateData['image'] === null) {
            unset($updateData['image']);
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

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=trips.xlsx');

        // Simple XML-based Excel (tidak perlu library eksternal)
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
                    xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">
              <Worksheet ss:Name="Trips">
              <Table>';

        // Header row
        echo '<Row>';
        foreach (['Trip ID', 'Title', 'Location', 'Price', 'Type', 'Status'] as $col) {
            echo '<Cell><Data ss:Type="String">' . htmlspecialchars($col) . '</Data></Cell>';
        }
        echo '</Row>';

        // Data rows
        foreach ($trips as $trip) {
            echo '<Row>';
            echo '<Cell><Data ss:Type="Number">' . $trip['trip_id']  . '</Data></Cell>';
            echo '<Cell><Data ss:Type="String">' . htmlspecialchars($trip['title'])    . '</Data></Cell>';
            echo '<Cell><Data ss:Type="String">' . htmlspecialchars($trip['location']) . '</Data></Cell>';
            echo '<Cell><Data ss:Type="Number">' . $trip['price']    . '</Data></Cell>';
            echo '<Cell><Data ss:Type="String">' . htmlspecialchars($trip['type'])     . '</Data></Cell>';
            echo '<Cell><Data ss:Type="String">' . htmlspecialchars($trip['status'])   . '</Data></Cell>';
            echo '</Row>';
        }

        echo '</Table></Worksheet></Workbook>';
        exit;
    }

    /*
    =====================================
    PRIVATE HELPERS
    =====================================
    */

    private function uploadImage(string $inputName): ?string
    {
        $file = $this->request->getFile($inputName);

        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        $newName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads/trips/', $newName);

        return $newName;
    }
}