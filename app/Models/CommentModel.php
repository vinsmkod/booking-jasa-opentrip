<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';

    protected $allowedFields = [
        'user_id',
        'trip_id',
        'comment',
        'status',
        'created_at'
    ];

    protected $useTimestamps = false;
}