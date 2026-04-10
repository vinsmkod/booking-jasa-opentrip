<?php

namespace App\Controllers;

use App\Models\TripModel;
use App\Models\ScheduleModel; // ← tambahkan ini

class AdminTripController extends BaseController
{
    protected $tripModel;
    protected $scheduleModel; // ← tambahkan ini

    public function __construct()
    {
        $this->tripModel     = new TripModel();
        $this->scheduleModel = new ScheduleModel(); // ← tambahkan ini
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
        // 1. Simpan trip dulu, ambil ID-nya
        $tripId = $this->tripModel->insert([
            'title'          => $this->request->getPost('title'),
            'location'       => $this->request->getPost('location'),
            'description'    => $this->request->getPost('description'),
            'price'          => $this->request->getPost('price'),
            'status'         => $this->request->getPost('status') ?? 'active',
            'type'           => $this->request->getPost('type'),
            'whatsapp_group' => $this->request->getPost('whatsapp_group'),
            'image'          => $this->request->getFile('image') ? $this->uploadImage('image') : null,
        ]);

        // 2. Simpan schedule ke tabel schedules
        $quota = $this->request->getPost('quota');
        $this->scheduleModel->insert([
            'trip_id'        => $tripId,
            'departure_date' => $this->request->getPost('departure_date'),
            'quota'          => $quota,
            'available'      => $quota, // awal available = quota penuh
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

        // Ambil schedule yang ada untuk trip ini
        $schedule = $this->scheduleModel->where('trip_id', $trip_id)->first();

        return view('admin/trips/edit', [
            'trip'     => $trip,
            'schedule' => $schedule, // kirim ke view agar bisa pre-fill form
        ]);
    }

    // =============================
    // UPDATE
    // =============================
    public function update($trip_id)
    {
        $updateData = [
            'title'          => $this->request->getPost('title'),
            'location'       => $this->request->getPost('location'),
            'description'    => $this->request->getPost('description'),
            'price'          => $this->request->getPost('price'),
            'type'           => $this->request->getPost('type'),
            'whatsapp_group' => $this->request->getPost('whatsapp_group'),
        ];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $updateData['image'] = $this->uploadImage('image');
        }

        $this->tripModel->update($trip_id, $updateData);

        // Update atau buat schedule
        $quota    = $this->request->getPost('quota');
        $existing = $this->scheduleModel->where('trip_id', $trip_id)->first();

        if ($existing) {
            // Update schedule yang sudah ada
            $this->scheduleModel->update($existing['schedule_id'], [
                'departure_date' => $this->request->getPost('departure_date'),
                'quota'          => $quota,
                // available tidak diubah otomatis agar tidak override booking yang sudah ada
            ]);
        } else {
            // Trip lama yang belum punya schedule → buat baru
            $this->scheduleModel->insert([
                'trip_id'        => $trip_id,
                'departure_date' => $this->request->getPost('departure_date'),
                'quota'          => $quota,
                'available'      => $quota,
            ]);
        }

        return redirect()->to('/admin/trips')
            ->with('success', 'Trip berhasil diupdate');
    }

    // =============================
    // DELETE
    // =============================
    public function delete($trip_id)
    {
        // Hapus schedule terkait dulu sebelum hapus trip
        $this->scheduleModel->where('trip_id', $trip_id)->delete();

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