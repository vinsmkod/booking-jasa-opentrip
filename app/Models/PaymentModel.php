<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table      = 'payments';
    protected $primaryKey = 'payment_id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'booking_id',
        'method',
        'amount',
        'proof',
        'status',
        'paid_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'paid_at';
    protected $updatedField  = 'updated_at';
}