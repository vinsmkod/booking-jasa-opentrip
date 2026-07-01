<?php

namespace App\Controllers;

use App\Models\CommentModel;

class Comment extends BaseController
{
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    // =========================================================
    // PUBLIK — Untuk Pelanggan
    // =========================================================

    public function create()
    {
        $this->commentModel->save([
            'user_id' => session()->get('user_id'),
            'trip_id' => $this->request->getPost('trip_id'),
            'comment' => $this->request->getPost('comment'),
            'status'  => 'pending'
        ]);

        return redirect()->to('/')->with('success', 'Komentar berhasil dikirim dan menunggu persetujuan admin');
    }

    // =========================================================
    // ADMIN — Manajemen Komentar
    // =========================================================

    public function adminIndex()
    {
        $this->commentModel
            ->select('comments.*, users.name, users.email, trips.title')
            ->join('users', 'users.user_id = comments.user_id')
            ->join('trips', 'trips.trip_id = comments.trip_id')
            ->orderBy('comments.created_at', 'DESC');

        $comments = $this->commentModel->paginate(5, 'comments');
        $pager    = $this->commentModel->pager;

        return view('admin/comments/index', [
            'comments' => $comments,
            'pager'    => $pager
        ]);
    }

    public function approve($id)
    {
        $this->commentModel->update($id, [
            'status' => 'approved'
        ]);

        return redirect()->to('/admin/comments');
    }

    public function reject($id)
    {
        $this->commentModel->update($id, [
            'status' => 'rejected'
        ]);

        return redirect()->to('/admin/comments');
    }

    public function delete($id)
    {
        $this->commentModel->delete($id);

        return redirect()->to('/admin/comments');
    }
}
