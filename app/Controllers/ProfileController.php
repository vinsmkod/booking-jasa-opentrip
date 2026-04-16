<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function edit()
    {
        $userId = session()->get('user_id');
        if (!$userId) return redirect()->to('/login');

        $user = $this->userModel->find($userId);

        return view('profile/edit', [
            'user' => $user
        ]);
    }

    public function update()
    {
        $userId = session()->get('user_id');
        if (!$userId) return redirect()->to('/login');

        // Extremely defensive data preparation to avoid CI4 core trim(null) issues on PHP 8.1+
        $nameValue = $this->request->getPost('name') ?? '';
        $phoneValue = $this->request->getPost('phone') ?? '';

        $postData = [
            'name'  => (string) $nameValue,
            'phone' => (string) $phoneValue,
        ];

        $rules = [
            'name' => 'required|min_length[3]',
        ];

        // Only add rules for phone if it's not empty to avoid 'permit_empty' core issues
        if ($postData['phone'] !== '') {
            $rules['phone'] = 'numeric|min_length[10]';
        }

        $validation = \Config\Services::validation();

        if (!$validation->setRules($rules)->run($postData)) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $user = $this->userModel->find($userId);

        // Handle Avatar Validation & Upload
        $avatar = $this->request->getFile('avatar');
        $avatarName = $user['avatar'] ?? null;

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $avatarRules = [
                'avatar' => 'is_image[avatar]|max_size[avatar,2048]|mime_in[avatar,image/jpg,image/jpeg,image/png]'
            ];

            if (!$validation->setRules($avatarRules)->run([])) {
                return redirect()->back()->withInput()->with('error', $validation->listErrors());
            }

            // Delete old avatar if exists
            if (!empty($user['avatar'])) {
                $oldPath = FCPATH . 'uploads/avatars/' . $user['avatar'];
                if (file_exists($oldPath)) @unlink($oldPath);
            }

            $avatarName = $avatar->getRandomName();
            $avatar->move(FCPATH . 'uploads/avatars/', $avatarName);
            
            // Sync session
            session()->set('avatar', $avatarName);
        }

        $data = [
            'name'   => $postData['name'],
            'phone'  => $postData['phone'],
            'avatar' => $avatarName
        ];

        if ($this->userModel->update($userId, $data)) {
            // Sync session name
            session()->set('name', $data['name']);
            
            return redirect()->to('/profile/edit')->with('success', 'Profil berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui profil.');
    }
}
