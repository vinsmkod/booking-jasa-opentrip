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
        'payment_status',   // tambah sesuai DB
        'created_at'        // opsional, bisa diisi otomatis DB
    ];

    // Jika mau auto-manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; // bisa ditambahkan di DB kalau mau
}