<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TripModel;
use App\Models\BookingModel;
use App\Models\DocumentModel;

class AdminController extends BaseController
{
    protected $tripModel;
    protected $bookingModel;
    protected $documentModel;

    public function __construct()
    {
        $this->tripModel = new TripModel();
        $this->bookingModel = new BookingModel();
        $this->documentModel = new DocumentModel();
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
        // Query booking dengan join trip, schedule, users, dan meeting_points
        $bookings = $this->bookingModel
            ->select('bookings.booking_id, bookings.booking_code, users.name as user_name, trips.title, trips.location, bookings.participant, meeting_points.name as meeting_point, trips.price, trips.type, schedules.departure_date, bookings.status as payment_status')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id', 'left')
            ->join('trips', 'trips.trip_id = schedules.trip_id', 'left')
            ->join('users', 'users.user_id = bookings.user_id', 'left')
            ->join('meeting_points', 'meeting_points.meeting_point_id = bookings.meeting_point_id', 'left')
            ->orderBy('bookings.booking_id', 'DESC')
            ->findAll();

        // Export sebagai CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=bookings_' . date('Y-m-d_His') . '.csv');

        // Output BOM untuk UTF-8
        echo "\xEF\xBB\xBF";

        // Header row
        $output = fopen('php://output', 'w');
        fputcsv($output, [
            'Kode Booking',
            'Nama Peserta',
            'Nama Trip',
            'Lokasi',
            'Jumlah Anggota',
            'Nama-Nama Peserta',
            'Meeting Point',
            'Price',
            'Jenis Trip',
            'Tanggal Keberangkatan',
            'Status Pembayaran'
        ]);

        // Data rows
        foreach ($bookings as $booking) {
            // Cast numeric fields to prevent leading zeros or incorrect formats
            $participant = ($booking['participant'] && $booking['participant'] !== '') ? (int)$booking['participant'] : '-';
            $price = ($booking['price'] && $booking['price'] !== '') ? (int)$booking['price'] : '-';
            
            // Get peserta names jika participant > 1
            $pesertaNames = '-';
            if ((int)$booking['participant'] > 1) {
                $documents = $this->documentModel
                    ->select('name')
                    ->where('booking_id', $booking['booking_id'])
                    ->findAll();
                
                if (!empty($documents)) {
                    $names = array_map(function($doc) {
                        return $doc['name'];
                    }, $documents);
                    $pesertaNames = implode(', ', $names);
                }
            }
            
            fputcsv($output, [
                $booking['booking_code'],
                $booking['user_name'] ?? '-',
                $booking['title'] ?? '-',
                $booking['location'] ?? '-',
                $participant,
                $pesertaNames,
                $booking['meeting_point'] ?? '-',
                $price,
                $booking['type'] ?? '-',
                $booking['departure_date'] ? date('d-m-Y', strtotime($booking['departure_date'])) : '-',
                $booking['payment_status'] ?? '-'
            ]);
        }

        fclose($output);
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