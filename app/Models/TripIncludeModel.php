<?php

namespace App\Models;

use CodeIgniter\Model;

class TripIncludeModel extends Model
{
    protected $table            = 'trip_includes';
    protected $primaryKey       = 'include_id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'trip_id',
        'name',
        'updated_at'
    ];

    protected $useTimestamps = false;
}
