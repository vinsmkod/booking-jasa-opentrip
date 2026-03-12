<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ScheduleModel;
use App\Models\TripModel;

class ScheduleController extends BaseController
{
    protected $scheduleModel;
    protected $tripModel;

    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
        $this->tripModel = new TripModel();
    }

    public function index()
    {
        $data['schedules'] = $this->scheduleModel
            ->select('schedules.*, trips.title')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->findAll();

        return view('admin/schedules/index', $data);
    }

    public function create()
    {
        $data['trips'] = $this->tripModel->findAll();
        return view('admin/schedules/create', $data);
    }

    public function store()
    {
        $quota = $this->request->getPost('quota');

        $this->scheduleModel->save([
            'trip_id' => $this->request->getPost('trip_id'),
            'departure_date' => $this->request->getPost('departure_date'),
            'quota' => $quota,
            'available' => $quota
        ]);

        return redirect()->to('/admin/schedules');
    }

    public function edit($id)
    {
        $data['schedule'] = $this->scheduleModel->find($id);
        $data['trips'] = $this->tripModel->findAll();

        return view('admin/schedules/edit', $data);
    }

    public function update($id)
    {
        $this->scheduleModel->update($id, [
            'trip_id' => $this->request->getPost('trip_id'),
            'departure_date' => $this->request->getPost('departure_date'),
            'quota' => $this->request->getPost('quota'),
            'available' => $this->request->getPost('available')
        ]);

        return redirect()->to('/admin/schedules');
    }

    public function delete($id)
    {
        $this->scheduleModel->delete($id);
        return redirect()->to('/admin/schedules');
    }
}