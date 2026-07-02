<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table      = 'documents';
    protected $primaryKey = 'document_id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'booking_id',
        'name',
        'wa_number',
        'birthdate',
        'gender',
        'ktp',
        'health',
        'parent_permission',
        'type',
        'file',
        'status'
    ];

    protected $useTimestamps = false;
}
