<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoyaltyController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Pastikan user login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $user_id = session()->get('user_id');

        // Ambil data user dari database
        $user = $this->userModel->find($user_id);

        $points = $user['points'] ?? 0;

        return view('loyalty', [
            'points' => $points
        ]);
    }
}