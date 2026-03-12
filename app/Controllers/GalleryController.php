<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GalleryModel;

class GalleryController extends BaseController
{
    public function index()
    {
        $model = new GalleryModel();

        $data['galleryPhotos'] = $model->findAll();

        return view('gallery/index',$data);
    }
}