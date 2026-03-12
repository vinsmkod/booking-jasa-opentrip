<?php

namespace App\Models;

use CodeIgniter\Model;

class LoyaltyModel extends Model
{
    protected $table      = 'loyalty_points';
    protected $primaryKey = 'loyalty_id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'user_id',
        'booking_id',
        'points',
        'description'
    ];

    // Gunakan created_at saja (karena di DB tidak ada updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;
}