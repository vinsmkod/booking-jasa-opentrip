<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */
    public function login()
    {
        // Jika sudah login, redirect sesuai role
        if (session()->get('isLoggedIn')) {
            return $this->redirectByRole(session()->get('role'));
        }

        return view('auth/login');
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESS LOGIN
    |--------------------------------------------------------------------------
    */
    public function processLogin()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Ambil user berdasarkan email
        $user = $this->userModel->where('email', $email)->first();

        // Cek apakah user ada dan password cocok
        if ($user && password_verify($password, $user['password'])) {

            // Set session
            session()->set([
                'user_id'    => $user['user_id'],
                'name'       => $user['name'],
                'role'       => $user['role'],
                'points'     => $user['points'] ?? 0,
                'isLoggedIn' => true
            ]);

            // Redirect sesuai role
            return $this->redirectByRole($user['role']);
        }

        return redirect()->back()->with('error', 'Login gagal, email atau password salah');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE
    |--------------------------------------------------------------------------
    */
    public function register()
    {
        return view('auth/register');
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESS REGISTER
    |--------------------------------------------------------------------------
    */
    public function processRegister()
    {
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'phone'    => $this->request->getPost('phone'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'customer',
            'points'   => 0
        ];

        $this->userModel->save($data);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    /*
    |--------------------------------------------------------------------------
    | REDIRECT BY ROLE (FIX 404 ADMIN)
    |--------------------------------------------------------------------------
    */
    private function redirectByRole($role)
    {
        if ($role === 'admin') {
            return redirect()->to('/admin/dashboard'); // FIX DI SINI
        } elseif ($role === 'customer') {
            return redirect()->to('/');
        } else {
            return redirect()->to('/');
        }
    }
}