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
                'email'      => $user['email'],
                'phone'      => $user['phone'] ?? null,
                'avatar'     => $user['avatar'] ?? null,
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
    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD
    |--------------------------------------------------------------------------
    */
    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function processForgotPassword()
    {
        $email = $this->request->getPost('email');
        $user  = $this->userModel->where('email', $email)->first();

        if ($user) {
            // Generate token
            $token   = bin2hex(random_bytes(20));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $this->userModel->update($user['user_id'], [
                'reset_token'   => $token,
                'reset_expires' => $expires
            ]);

            // Kirim email (Simulasi)
            $resetLink = base_url("reset-password/{$token}");
            
            // CodeIgniter Email Service
            $emailService = \Config\Services::email();
            $emailService->setTo($email);
            $emailService->setSubject('Reset Password - BLNTRK OUTDOOR');
            $emailService->setMessage("Halo {$user['name']},\n\nKlik link berikut untuk reset password Anda (berlaku 1 jam):\n\n{$resetLink}\n\nJika Anda tidak merasa meminta reset password, abaikan email ini.");

            try {
                if ($emailService->send()) {
                    return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda.');
                } else {
                    // Jika gagal kirim email (biasanya karena SMTP belum disetup di local)
                    // Tampilkan link reset di flash message untuk mempermudah testing di XAMPP
                    return redirect()->back()->with('success', 'Link reset password (DEMO): <a href="'.$resetLink.'">Klik di sini untuk reset</a>');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('success', 'Link reset password (DEMO): <a href="'.$resetLink.'">Klik di sini untuk reset</a>');
            }
        }

        return redirect()->back()->with('error', 'Email tidak ditemukan.');
    }

    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD
    |--------------------------------------------------------------------------
    */
    public function resetPassword($token)
    {
        $user = $this->userModel->where('reset_token', $token)
            ->where('reset_expires >=', date('Y-m-d H:i:s'))
            ->first();

        if (!$user) {
            return redirect()->to('/forgot-password')->with('error', 'Link reset tidak valid atau sudah kadaluarsa.');
        }

        return view('auth/reset_password', ['token' => $token]);
    }

    public function processResetPassword()
    {
        $token    = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('reset_token', $token)
            ->where('reset_expires >=', date('Y-m-d H:i:s'))
            ->first();

        if (!$user) {
            return redirect()->to('/forgot-password')->with('error', 'Proses reset gagal, link sudah kadaluarsa.');
        }

        $this->userModel->update($user['user_id'], [
            'password'      => password_hash($password, PASSWORD_DEFAULT),
            'reset_token'   => null,
            'reset_expires' => null
        ]);

        return redirect()->to('/login')->with('success', 'Password berhasil direset, silakan login kembali.');
    }
}