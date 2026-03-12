<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table      = 'galleries';
    protected $primaryKey = 'gallery_id';
    protected $allowedFields = ['title', 'album', 'image', 'created_at'];
    protected $useTimestamps = true;
}