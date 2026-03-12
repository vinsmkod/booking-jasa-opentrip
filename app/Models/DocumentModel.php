<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table      = 'documents';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'booking_id',
        'user_id',
        'file_path',
        'status'
    ];
}