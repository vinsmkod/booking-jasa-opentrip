<?php

namespace App\Models;

use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table      = 'trips';
    protected $primaryKey = 'trip_id';

    protected $allowedFields = [
        'title',
        'location',
        'description',
        'price',
        'image',
        'status',
        'type',
        'quota',
        'whatsapp_group', // FIX: pastikan ini ada
    ];
}