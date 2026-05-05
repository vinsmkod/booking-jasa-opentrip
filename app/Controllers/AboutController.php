<?php

namespace App\Controllers;

use App\Models\AboutModel;
use App\Models\TimelineModel;
use App\Models\TeamModel;

class AboutController extends BaseController
{
    protected $aboutModel;

    public function __construct()
    {
        $this->aboutModel = new AboutModel();
    }

    // =========================================================
    // PUBLIK — Halaman About untuk Pelanggan
    // =========================================================

    public function index()
    {
        $timelineModel = new TimelineModel();
        $teamModel     = new TeamModel();

        $about = $this->aboutModel->first() ?: [
            'title'   => 'About Us',
            'subtitle' => 'Learn more about us',
            'content' => 'Our company is committed to delivering the best services.',
        ];

        $timeline = $timelineModel->findAll();
        $team     = $teamModel->findAll();

        return view('about/index', compact('about', 'timeline', 'team'));
    }

    // =========================================================
    // ADMIN — Manajemen Konten About
    // =========================================================

    public function adminIndex()
    {
        $data['about'] = $this->aboutModel->first();
        return view('admin/about/index', $data);
    }

    public function edit()
    {
        $data['about'] = $this->aboutModel->first();
        return view('admin/about/edit', $data);
    }

    public function update()
    {
        $post  = $this->request->getPost();
        $about = $this->aboutModel->first();
        $this->aboutModel->update($about['id'], $post);

        return redirect()->to('/admin/about')->with('success', 'Konten About berhasil diperbarui');
    }
}
