<?php

namespace App\Models;

use CodeIgniter\Model;

class TripModel extends Model
{
    protected $table      = 'trips';
    protected $primaryKey = 'trip_id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'title',
        'location',
        'description',
        'price',
        'image',
        'status',
        'type'
    ];
}