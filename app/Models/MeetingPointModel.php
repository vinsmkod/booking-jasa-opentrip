<?php

namespace App\Models;

use CodeIgniter\Model;

class MeetingPointModel extends Model
{
    protected $table      = 'meeting_points';
    protected $primaryKey = 'meeting_point_id';
    protected $allowedFields = ['trip_id', 'name', 'address', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;

    public function getByTrip($tripId)
    {
        return $this->where('trip_id', $tripId)->findAll();
    }
}