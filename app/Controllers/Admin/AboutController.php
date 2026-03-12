<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AboutModel;

class AboutController extends BaseController
{
    protected $aboutModel;

    public function __construct()
    {
        $this->aboutModel = new AboutModel();
    }

    public function index()
    {
        $data['about'] = $this->aboutModel->first(); // Ambil data About pertama
        return view('admin/about/index', $data);
    }

    public function edit()
    {
        $data['about'] = $this->aboutModel->first();
        return view('admin/about/edit', $data);
    }

    public function update()
    {
        $post = $this->request->getPost();
        $about = $this->aboutModel->first();
        $this->aboutModel->update($about['id'], $post);

        return redirect()->to('/admin/about')->with('success','Konten About berhasil diperbarui');
    }
}