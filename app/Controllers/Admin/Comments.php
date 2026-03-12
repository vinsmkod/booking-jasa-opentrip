<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommentModel;

class Comments extends BaseController
{
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
    }

    public function index()
    {
        $comments = $this->commentModel
            ->select('comments.*, users.name, users.email, trips.title')
            ->join('users','users.user_id = comments.user_id')
            ->join('trips','trips.trip_id = comments.trip_id')
            ->orderBy('comments.created_at','DESC')
            ->findAll();

        return view('admin/comments/index',[
            'comments'=>$comments
        ]);
    }

    public function approve($id)
    {
        $this->commentModel->update($id,[
            'status'=>'approved'
        ]);

        return redirect()->to('/admin/comments');
    }

    public function reject($id)
    {
        $this->commentModel->update($id,[
            'status'=>'rejected'
        ]);

        return redirect()->to('/admin/comments');
    }

    public function delete($id)
    {
        $this->commentModel->delete($id);

        return redirect()->to('/admin/comments');
    }
}