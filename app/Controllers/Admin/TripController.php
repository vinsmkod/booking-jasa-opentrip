<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TripModel;
use App\Models\ScheduleModel;
use App\Models\MeetingPointModel;

class TripController extends BaseController
{
    protected $tripModel;
    protected $scheduleModel;
    protected $meetingPointModel;

    public function __construct()
    {
        $this->tripModel          = new TripModel();
        $this->scheduleModel      = new ScheduleModel();
        $this->meetingPointModel  = new MeetingPointModel();
    }

    public function index()
    {
        $data['trips'] = $this->tripModel
            ->orderBy('trip_id','DESC')
            ->findAll();

        return view('admin/trips/index', $data);
    }

    public function create()
    {
        return view('admin/trips/create');
    }

    public function store()
    {
        // Upload Gambar
        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/trips', $imageName);
        }

        // Simpan Trip
        $tripData = [
            'title'       => $this->request->getPost('title'),
            'image'       => $imageName,
            'type'        => $this->request->getPost('type'),
            'location'    => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
            'price'       => (int)$this->request->getPost('price'),
            'status'      => $this->request->getPost('status'),
            'quota'       => $this->request->getPost('quota')
        ];

        $this->tripModel->insert($tripData);
        $trip_id = $this->tripModel->getInsertID();

        // Simpan Schedule
        $scheduleData = [
            'trip_id'        => $trip_id,
            'departure_date' => $this->request->getPost('departure_date'),
            'quota'          => $this->request->getPost('quota'),
            'available'      => $this->request->getPost('quota')
        ];
        $this->scheduleModel->insert($scheduleData);

        // Simpan Meeting Points
        $meetingPoints = $this->request->getPost('meeting_points');
        $meetingAddresses = $this->request->getPost('meeting_addresses');

        if (!empty($meetingPoints)) {
            foreach ($meetingPoints as $key => $name) {
                $address = $meetingAddresses[$key] ?? '';
                if ($name) {
                    $this->meetingPointModel->insert([
                        'trip_id' => $trip_id,
                        'name'    => $name,
                        'address' => $address
                    ]);
                }
            }
        }

        return redirect()->to('/admin/trips')
            ->with('success','Trip, schedule, dan meeting points berhasil ditambahkan');
    }

    public function edit($id)
    {
        $trip = $this->tripModel->find($id);

        if (!$trip) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $schedule = $this->scheduleModel->where('trip_id', $id)->first();
        $meetingPoints = $this->meetingPointModel->where('trip_id', $id)->findAll();

        return view('admin/trips/edit', [
            'trip'          => $trip,
            'schedule'      => $schedule,
            'meetingPoints' => $meetingPoints
        ]);
    }

    public function update($id)
    {
        // Upload Gambar
        $image = $this->request->getFile('image');
        $data = [
            'title'       => $this->request->getPost('title'),
            'type'        => $this->request->getPost('type'),
            'location'    => $this->request->getPost('location'),
            'description' => $this->request->getPost('description'),
            'price'       => (int)$this->request->getPost('price'),
            'status'      => $this->request->getPost('status'),
            'quota'       => $this->request->getPost('quota')
        ];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('uploads/trips', $imageName);
            $data['image'] = $imageName;
        }

        $this->tripModel->update($id, $data);

        // Update Schedule
        $schedule = $this->scheduleModel->where('trip_id', $id)->first();
        if ($schedule) {
            $this->scheduleModel->update($schedule['schedule_id'], [
                'departure_date' => $this->request->getPost('departure_date'),
                'quota'          => $this->request->getPost('quota'),
                'available'      => $this->request->getPost('quota')
            ]);
        }

        // Update Meeting Points
        $this->meetingPointModel->where('trip_id', $id)->delete();

        $meetingPoints = $this->request->getPost('meeting_points');
        $meetingAddresses = $this->request->getPost('meeting_addresses');

        if (!empty($meetingPoints)) {
            foreach ($meetingPoints as $key => $name) {
                $address = $meetingAddresses[$key] ?? '';
                if ($name) {
                    $this->meetingPointModel->insert([
                        'trip_id' => $id,
                        'name'    => $name,
                        'address' => $address
                    ]);
                }
            }
        }

        return redirect()->to('/admin/trips')
            ->with('success','Trip berhasil diperbarui beserta meeting points');
    }

    public function delete($id)
    {
        $this->tripModel->delete($id);
        // Meeting points dan schedule otomatis ikut terhapus karena foreign key cascade

        return redirect()->to('/admin/trips')
            ->with('success','Trip berhasil dihapus beserta schedule & meeting points');
    }
}