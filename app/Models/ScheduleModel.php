<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table      = 'schedules';
    protected $primaryKey = 'schedule_id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'trip_id',
        'departure_date',
        'quota',
        'available'
    ];
}