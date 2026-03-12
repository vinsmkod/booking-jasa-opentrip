<?php

namespace App\Controllers;

use App\Models\CommentModel;

class Comment extends BaseController
{

public function create()
{
    $commentModel = new CommentModel();

    $commentModel->save([
        'user_id' => session()->get('user_id'),
        'trip_id' => $this->request->getPost('trip_id'),
        'comment' => $this->request->getPost('comment'),
        'status' => 'pending'
    ]);

    return redirect()->to('/')->with('success','Komentar berhasil dikirim dan menunggu persetujuan admin');
}

}