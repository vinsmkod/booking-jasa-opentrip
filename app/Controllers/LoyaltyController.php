<?php

namespace App\Controllers;

class LoyaltyController extends BaseController
{
    public function index()
    {
        // Pastikan user login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $points = session()->get('points') ?? 0;

        return view('loyalty', [
            'points' => $points
        ]);
    }
}