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
        'email',
        'birthdate',
        'gender',
        'ktp',
        'health',
        'type',
        'file',
        'status'
    ];

    protected $useTimestamps = false;
}