<?php

namespace App\Models;

use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table      = 'trips';
    protected $primaryKey = 'trip_id';

    protected $allowedFields = [
        'title',
        'image',
        'type',
        'location',
        'description',
        'price',
        'status',
        'quota',
        'whatsapp_group'
    ];

    protected $useTimestamps = false;
}