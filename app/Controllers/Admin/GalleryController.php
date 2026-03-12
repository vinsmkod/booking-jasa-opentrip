<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GalleryModel;

class GalleryController extends BaseController
{
    protected $galleryModel;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
    }

    // Index: daftar foto + filter + pagination
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $query = $this->galleryModel;
        if($keyword){
            $query = $query->like('title', $keyword);
        }

        $data = [
            'galleries' => $query->orderBy('created_at','DESC')->paginate(6), // 6 per page
            'pager'     => $this->galleryModel->pager,
            'keyword'   => $keyword
        ];

        return view('admin/gallery/index', $data);
    }

    // Create: form upload
    public function create()
    {
        return view('admin/gallery/create');
    }

    // Store: multiple upload
    public function store()
    {
        $files = $this->request->getFiles();
        $album = $this->request->getPost('album');
        $title = $this->request->getPost('title');

        foreach($files['images'] as $file){
            if($file->isValid() && !$file->hasMoved()){
                $fileName = $file->getRandomName();
                $file->move(WRITEPATH.'uploads/gallery', $fileName);

                $this->galleryModel->save([
                    'title' => $title,
                    'album' => $album,
                    'image' => $fileName
                ]);
            }
        }

        return redirect()->to('/admin/gallery')->with('success','Foto berhasil diupload');
    }

    // Edit foto
    public function edit($id)
    {
        $data['gallery'] = $this->galleryModel->find($id);
        return view('admin/gallery/edit', $data);
    }

    // Update foto
    public function update($id)
    {
        $gallery = $this->galleryModel->find($id);
        $file = $this->request->getFile('image');

        if($file && $file->isValid() && !$file->hasMoved()){
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH.'uploads/gallery', $fileName);

            if(file_exists(WRITEPATH.'uploads/gallery/'.$gallery['image'])){
                unlink(WRITEPATH.'uploads/gallery/'.$gallery['image']);
            }
        } else {
            $fileName = $gallery['image'];
        }

        $this->galleryModel->update($id, [
            'title' => $this->request->getPost('title'),
            'album' => $this->request->getPost('album'),
            'image' => $fileName
        ]);

        return redirect()->to('/admin/gallery')->with('success','Foto berhasil diupdate');
    }

    // Delete foto
    public function delete($id)
    {
        $gallery = $this->galleryModel->find($id);

        if($gallery){
            if(file_exists(WRITEPATH.'uploads/gallery/'.$gallery['image'])){
                unlink(WRITEPATH.'uploads/gallery/'.$gallery['image']);
            }
            $this->galleryModel->delete($id);
        }

        return redirect()->to('/admin/gallery')->with('success','Foto berhasil dihapus');
    }

    // Menampilkan semua album unik
    public function albums()
    {
        $albums = $this->galleryModel->select('album')
                                      ->groupBy('album')
                                      ->orderBy('album', 'ASC')
                                      ->findAll();

        return view('admin/gallery/albums', ['albums' => $albums]);
    }

    // Menampilkan semua foto dalam album tertentu
    public function album($albumName)
    {
        $photos = $this->galleryModel
                       ->where('album', $albumName)
                       ->orderBy('created_at','DESC')
                       ->paginate(12);

        $pager = $this->galleryModel->pager;

        return view('admin/gallery/album_photos', [
            'albumName' => $albumName,
            'photos'    => $photos,
            'pager'     => $pager
        ]);
    }
}