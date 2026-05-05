<?php

namespace App\Controllers;

class AboutController extends BaseController
{
    // =========================================================
    // PUBLIK — Halaman About untuk Pelanggan
    // =========================================================

    public function index()
    {
        return view('about/index');
    }
}
