<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table = 'galleries';
    protected $primaryKey = 'gallery_id';
    protected $allowedFields = ['trip_id', 'title', 'album', 'image', 'created_at', 'updated_at'];
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;

    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'album' => 'permit_empty|min_length[2]|max_length[255]',
        'image' => 'required|min_length[3]'
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Judul foto harus diisi',
            'min_length' => 'Judul minimal 3 karakter',
            'max_length' => 'Judul maksimal 255 karakter'
        ],
        'album' => [
            'min_length' => 'Nama album minimal 2 karakter',
            'max_length' => 'Nama album maksimal 255 karakter'
        ],
        'image' => [
            'required' => 'Foto harus diupload',
            'min_length' => 'Nama file tidak valid'
        ]
    ];

    protected $returnType = 'array';

    // Get photos by album
    public function getByAlbum($album)
    {
        return $this->where('album', $album)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    // Get all unique albums with photo count
    public function getAlbumsWithCount()
    {
        $db = \Config\Database::connect();

        return $db->table('galleries')
            ->select('album, COUNT(*) as total, MAX(image) as cover')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->get()
            ->getResultArray();
    }

    // Search photos by title
    public function search($keyword)
    {
        return $this->like('title', $keyword)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    // Get recent photos
    public function getRecent($limit = 6)
    {
        return $this->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    // Get random photos
    public function getRandom($limit = 4)
    {
        return $this->orderBy('RAND()')
            ->limit($limit)
            ->findAll();
    }
}
