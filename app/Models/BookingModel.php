<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table      = 'bookings';
    protected $primaryKey = 'booking_id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'booking_code',
        'user_id',
        'schedule_id',
        'participant',
        'total_price',
        'status',
        'meeting_point_id',
        'document'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}