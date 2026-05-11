<?php

namespace App\Controllers;

use App\Models\TripModel;
use App\Models\GalleryModel;
use App\Models\ScheduleModel;
use App\Models\MeetingPointModel;
use App\Models\TripIncludeModel;
use App\Models\ItineraryModel;

class TripController extends BaseController
{
    protected $tripModel;
    protected $galleryModel;
    protected $scheduleModel;
    protected $meetingPointModel;
    protected $includeModel;
    protected $itineraryModel;

    public function __construct()
    {
        $this->tripModel         = new TripModel();
        $this->galleryModel      = new GalleryModel();
        $this->scheduleModel     = new ScheduleModel();
        $this->meetingPointModel = new MeetingPointModel();
        $this->includeModel      = new TripIncludeModel();
        $this->itineraryModel    = new ItineraryModel();
    }

    // =========================================================
    // PUBLIK — Untuk Pelanggan
    // =========================================================

    public function index()
    {
        $search = $this->request->getGet('search');

        $this->tripModel
            ->where('status', 'active')
            ->orderBy('trip_id', 'DESC');

        if (!empty($search)) {
            $this->tripModel->groupStart()
                ->like('title', $search)
                ->orLike('location', $search)
                ->groupEnd();
        }

        $trips = $this->tripModel->findAll();

        foreach ($trips as &$trip) {
            $schedule = $this->scheduleModel
                ->where('trip_id', $trip['trip_id'])
                ->orderBy('departure_date', 'ASC')
                ->first();

            if ($schedule) {
                $trip['schedule_id']    = $schedule['schedule_id'];
                $trip['departure_date'] = $schedule['departure_date'];
                $trip['quota']          = $schedule['quota'];
                $trip['available']      = $schedule['available'];
            } else {
                $trip['schedule_id']    = null;
                $trip['departure_date'] = null;
                $trip['quota']          = null;
                $trip['available']      = null;
            }
        }

        $data = [
            'trips'  => $trips,
            'type'   => 'Semua Trip',
            'search' => $search
        ];

        return view('trips/index', $data);
    }

    public function byType($type)
    {
        $search = $this->request->getGet('search');

        $this->tripModel
            ->where('type', $type)
            ->where('status', 'active');

        if (!empty($search)) {
            $this->tripModel->groupStart()
                ->like('title', $search)
                ->orLike('location', $search)
                ->groupEnd();
        }

        $trips = $this->tripModel->findAll();

        foreach ($trips as &$trip) {
            $schedule = $this->scheduleModel
                ->where('trip_id', $trip['trip_id'])
                ->orderBy('departure_date', 'ASC')
                ->first();

            if ($schedule) {
                $trip['schedule_id']    = $schedule['schedule_id'];
                $trip['departure_date'] = $schedule['departure_date'];
                $trip['quota']          = $schedule['quota'];
                $trip['available']      = $schedule['available'];
            } else {
                $trip['schedule_id']    = null;
                $trip['departure_date'] = null;
                $trip['quota']          = null;
                $trip['available']      = null;
            }
        }

        $data = [
            'trips'  => $trips,
            'type'   => $type,
            'search' => $search
        ];

        return view('trips/list', $data);
    }

    public function detail($schedule_id)
    {
        $db = \Config\Database::connect();

        $schedule = $db->table('schedules')
            ->select('
                schedules.*,
                trips.trip_id,
                trips.title,
                trips.location,
                trips.description,
                trips.price,
                trips.image,
                trips.whatsapp_group
            ')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->where('schedule_id', $schedule_id)
            ->get()
            ->getRowArray();

        if (!$schedule) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $includes = $db->table('trip_includes')
            ->where('trip_id', $schedule['trip_id'])
            ->get()
            ->getResultArray();

        $itinerary = $db->table('trip_itinerary')
            ->where('trip_id', $schedule['trip_id'])
            ->orderBy('time', 'ASC')
            ->get()
            ->getResultArray();

        $meetingPoints = $this->meetingPointModel
            ->where('trip_id', $schedule['trip_id'])
            ->findAll();

        $data = [
            'schedule'      => $schedule,
            'includes'      => $includes,
            'itinerary'     => $itinerary,
            'meetingPoints' => $meetingPoints
        ];

        return view('trips/detail', $data);
    }

    // =========================================================
    // ADMIN — Manajemen Trip
    // =========================================================

    public function adminIndex()
    {
        $search = $this->request->getGet('search');

        $this->tripModel->orderBy('trip_id', 'DESC');

        if (!empty($search)) {
            $this->tripModel->groupStart()
                ->like('title', $search)
                ->orLike('location', $search)
                ->orLike('type', $search)
                ->groupEnd();
        }

        $data['trips'] = $this->tripModel->paginate(10, 'trips');
        $data['pager'] = $this->tripModel->pager;
        $data['search'] = $search;

        return view('admin/trips/index', $data);
    }

    public function create()
    {
        return view('admin/trips/create');
    }

    /*
    =====================================
    STORE TRIP
    =====================================
    */

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
            'title'           => $this->request->getPost('title'),
            'image'           => $imageName,
            'type'            => $this->request->getPost('type'),
            'location'        => $this->request->getPost('location'),
            'description'     => $this->request->getPost('description'),
            'price'           => (int)$this->request->getPost('price'),
            'status'          => $this->request->getPost('status'),
            'quota'           => $this->request->getPost('quota'),
            'whatsapp_group'  => $this->request->getPost('whatsapp_group')
        ];

        $this->tripModel->insert($tripData);
        $trip_id = $this->tripModel->getInsertID();

        // Simpan Schedule
        $this->scheduleModel->insert([
            'trip_id'        => $trip_id,
            'departure_date' => $this->request->getPost('departure_date'),
            'quota'          => $this->request->getPost('quota'),
            'available'      => $this->request->getPost('quota')
        ]);

        // Simpan Data Relasi
        $this->handleMeetingPoints($trip_id);
        $this->handleIncludes($trip_id);
        $this->handleItinerary($trip_id);

        return redirect()->to('/admin/trips')
            ->with('success', 'Trip, schedule, meeting points, includes & itinerary berhasil ditambahkan');
    }

    /*
    =====================================
    EDIT TRIP
    =====================================
    */

    public function edit($id)
    {
        $trip = $this->tripModel->find($id);

        if (!$trip) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $schedule = $this->scheduleModel->where('trip_id', $id)->first();
        $meetingPoints = $this->meetingPointModel->where('trip_id', $id)->findAll();
        $includes = $this->includeModel->where('trip_id', $id)->findAll();
        $itineraries = $this->itineraryModel->where('trip_id', $id)->orderBy('time', 'ASC')->findAll();

        return view('admin/trips/edit', [
            'trip'          => $trip,
            'schedule'      => $schedule,
            'meetingPoints' => $meetingPoints,
            'includes'      => $includes,
            'itineraries'   => $itineraries
        ]);
    }

    /*
    =====================================
    UPDATE TRIP
    =====================================
    */

    public function update($id)
    {
        // Upload Gambar
        $image = $this->request->getFile('image');

        $data = [
            'title'          => $this->request->getPost('title'),
            'type'           => $this->request->getPost('type'),
            'location'       => $this->request->getPost('location'),
            'description'    => $this->request->getPost('description'),
            'price'          => (int)$this->request->getPost('price'),
            'status'         => $this->request->getPost('status'),
            'quota'          => $this->request->getPost('quota'),
            'whatsapp_group' => $this->request->getPost('whatsapp_group')
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

        // Update Data Relasi
        $this->handleMeetingPoints($id);
        $this->handleIncludes($id);
        $this->handleItinerary($id);

        return redirect()->to('/admin/trips')
            ->with('success', 'Trip berhasil diperbarui beserta meeting points, includes & itinerary');
    }

    /*
    =====================================
    DELETE TRIP
    =====================================
    */

    public function delete($id)
    {
        $this->tripModel->delete($id);

        return redirect()->to('/admin/trips')
            ->with('success', 'Trip berhasil dihapus beserta schedule & meeting points');
    }

    /*
    =====================================
    HELPER METHODS UNTUK RELASI
    =====================================
    */

    protected function handleMeetingPoints($tripId)
    {
        $this->meetingPointModel->where('trip_id', $tripId)->delete();
        $meetingPoints = $this->request->getPost('meeting_points');
        $meetingAddresses = $this->request->getPost('meeting_addresses');

        if (!empty($meetingPoints)) {
            foreach ($meetingPoints as $key => $name) {
                if ($name) {
                    $this->meetingPointModel->insert([
                        'trip_id' => $tripId,
                        'name'    => $name,
                        'address' => $meetingAddresses[$key] ?? ''
                    ]);
                }
            }
        }
    }

    protected function handleIncludes($tripId)
    {
        $this->includeModel->where('trip_id', $tripId)->delete();
        $includes = $this->request->getPost('includes');

        if (!empty($includes)) {
            $includeData = [];
            foreach ($includes as $name) {
                if (!empty($name)) {
                    $includeData[] = [
                        'trip_id' => $tripId,
                        'name'    => $name
                    ];
                }
            }
            if (!empty($includeData)) {
                $this->includeModel->insertBatch($includeData);
            }
        }
    }

    protected function handleItinerary($tripId)
    {
        $this->itineraryModel->where('trip_id', $tripId)->delete();
        $itineraryTimes = $this->request->getPost('itinerary_time');
        $itineraryActivities = $this->request->getPost('itinerary_activity');

        if (!empty($itineraryTimes)) {
            $itineraryData = [];
            foreach ($itineraryTimes as $key => $time) {
                if (!empty($time) && !empty($itineraryActivities[$key])) {
                    $itineraryData[] = [
                        'trip_id'  => $tripId,
                        'time'     => $time,
                        'activity' => $itineraryActivities[$key]
                    ];
                }
            }
            if (!empty($itineraryData)) {
                $this->itineraryModel->insertBatch($itineraryData);
            }
        }
    }
}
