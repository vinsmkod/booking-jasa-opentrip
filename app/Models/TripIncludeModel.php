<?php

namespace App\Models;

use CodeIgniter\Model;

class TripIncludeModel extends Model
{
    protected $table = 'trip_includes';
    protected $primaryKey = 'include_id';

    protected $allowedFields = [
        'trip_id',
        'title'
    ];
}