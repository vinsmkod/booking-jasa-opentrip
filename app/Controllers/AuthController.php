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

            // Cek apakah ada redirect URL tersimpan (misal dari halaman booking)
            $redirectUrl = session()->get('redirect_url');
            session()->remove('redirect_url');

            // Redirect sesuai role
            return $this->redirectByRole($user['role'], $redirectUrl);
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
        $rules = [
            'name'             => 'required',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[8]|regex_match[/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*]).+$/]',
            'password_confirm' => 'required|matches[password]'
        ];

        $errors = [
            'name' => [
                'required' => 'Nama lengkap wajib diisi.'
            ],
            'email' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah terdaftar.'
            ],
            'password' => [
                'required'    => 'Password wajib diisi.',
                'min_length'  => 'Password minimal 8 karakter.',
                'regex_match' => 'Password harus mengandung kombinasi huruf, angka, dan karakter spesial (!@#$%^&*).'
            ],
            'password_confirm' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches'  => 'Konfirmasi password tidak sesuai.'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

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
    private function redirectByRole($role, $redirectUrl = null)
    {
        if ($role === 'admin') {
            return redirect()->to('/admin/dashboard');
        } elseif ($role === 'customer') {
            // Jika ada URL yang disimpan sebelum login (misal halaman booking), arahkan ke sana
            if (!empty($redirectUrl)) {
                return redirect()->to($redirectUrl);
            }
            return redirect()->to('/');
        } else {
            return redirect()->to('/');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD (VIEW)
    |--------------------------------------------------------------------------
    */
    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESS FORGOT PASSWORD (PERBAIKAN: KIRIM EMAIL NYATA, TANPA DEMO)
    |--------------------------------------------------------------------------
    */
    public function processForgotPassword()
    {
        $email = $this->request->getPost('email');
        $user  = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }

        // Generate token dan set kadaluarsa 1 jam
        $token   = bin2hex(random_bytes(20));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->userModel->update($user['user_id'], [
            'reset_token'   => $token,
            'reset_expires' => $expires
        ]);

        $resetLink = base_url("reset-password/{$token}");

        // Siapkan email dengan template HTML
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password - BLNTRK OUTDOOR');

        $message = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .button { display: inline-block; background: #2d7d3a; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
                    .footer { margin-top: 20px; font-size: 12px; color: #777; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h3>Halo {$user['name']},</h3>
                    <p>Kami menerima permintaan reset password untuk akun Anda.</p>
                    <p>Klik tombol di bawah untuk membuat password baru (link berlaku 1 jam):</p>
                    <p><a href='{$resetLink}' class='button'>Reset Password</a></p>
                    <p>Atau salin link berikut ke browser Anda:<br>
                    <a href='{$resetLink}'>{$resetLink}</a></p>
                    <p>Jika Anda tidak merasa meminta reset password, abaikan email ini.</p>
                    <div class='footer'>
                        <p>Tim BLNTRK OUTDOOR</p>
                    </div>
                </div>
            </body>
            </html>
        ";

        $emailService->setMessage($message);

        // Kirim email, jika gagal tampilkan pesan error (tidak menampilkan demo link)
        if ($emailService->send()) {
            return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda. Cek inbox atau folder spam.');
        } else {
            // Catat error ke log untuk debugging (opsional)
            log_message('error', 'Gagal kirim reset password ke ' . $email . ': ' . print_r($emailService->printDebugger(['headers']), true));
            return redirect()->back()->with('error', 'Gagal mengirim email. Silakan coba lagi atau hubungi admin.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD (VIEW)
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

    /*
    |--------------------------------------------------------------------------
    | PROCESS RESET PASSWORD
    |--------------------------------------------------------------------------
    */
    public function processResetPassword()
    {
        $token    = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $rules = [
            'password'         => 'required|min_length[8]|regex_match[/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*]).+$/]',
            'password_confirm' => 'required|matches[password]'
        ];

        $errors = [
            'password' => [
                'required'    => 'Password baru wajib diisi.',
                'min_length'  => 'Password minimal 8 karakter.',
                'regex_match' => 'Password harus mengandung kombinasi huruf, angka, dan karakter spesial (!@#$%^&*).'
            ],
            'password_confirm' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches'  => 'Konfirmasi password tidak sesuai.'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            return redirect()->back()->with('error', $this->validator->getErrors());
        }

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
