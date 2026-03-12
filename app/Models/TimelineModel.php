<?php

namespace App\Models;

use CodeIgniter\Model;

class TimelineModel extends Model
{
    protected $table = 'timeline'; // sesuaikan nama tabel di database
    protected $primaryKey = 'id';   // sesuaikan primary key
    protected $returnType = 'array';
    protected $allowedFields = [
        'year', 
        'event'
    ];
}