<?php

namespace App\Models;

use CodeIgniter\Model;

class ItineraryModel extends Model
{
    protected $table = 'trip_itinerary';
    protected $primaryKey = 'itinerary_id';

    protected $allowedFields = [
        'trip_id',
        'time',
        'activity'
    ];

    protected $useTimestamps = false;
}