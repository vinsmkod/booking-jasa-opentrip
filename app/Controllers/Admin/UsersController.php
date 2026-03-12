<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UsersController extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->usersModel->orderBy('user_id','ASC')->findAll();
        return view('admin/users/index', $data);
    }

    public function create()
    {
        return view('admin/users/create');
    }

    public function store()
    {
        $post = $this->request->getPost();
        $post['password'] = password_hash($post['password'], PASSWORD_DEFAULT);

        $file = $this->request->getFile('avatar');
        if($file && $file->isValid() && !$file->hasMoved()){
            $newName = $file->getRandomName();
            $file->move(WRITEPATH.'uploads', $newName);
            $post['avatar'] = $newName;
        }

        $this->usersModel->insert($post);
        return redirect()->to('/admin/users')->with('success','User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['user'] = $this->usersModel->find($id);
        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $post = $this->request->getPost();

        if(!empty($post['password'])){
            $post['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        } else {
            unset($post['password']);
        }

        $file = $this->request->getFile('avatar');
        if($file && $file->isValid() && !$file->hasMoved()){
            $newName = $file->getRandomName();
            $file->move(WRITEPATH.'uploads', $newName);
            $post['avatar'] = $newName;
        }

        $this->usersModel->update($id, $post);
        return redirect()->to('/admin/users')->with('success','User berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->usersModel->delete($id);
        return redirect()->to('/admin/users')->with('success','User berhasil dihapus');
    }
}