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

    // ── INDEX: daftar foto + search + pagination ──
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $query = $this->galleryModel->orderBy('created_at', 'DESC');

        if ($keyword) {
            $query->like('title', $keyword);
        }

        // Hitung total foto
        $totalPhotos = $this->galleryModel->countAll();

        // Hitung total album unik
        $totalAlbums = $this->galleryModel
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->countAllResults();

        $data = [
            'galleries'   => $query->paginate(12),
            'pager'       => $this->galleryModel->pager,
            'keyword'     => $keyword,
            'totalPhotos' => $totalPhotos,
            'totalAlbums' => $totalAlbums
        ];

        return view('admin/gallery/index', $data);
    }

    // ── CREATE: form upload ──
    public function create()
    {
        // Pass existing albums for datalist autocomplete
        $albums = $this->galleryModel
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->findAll();

        return view('admin/gallery/create', ['albums' => $albums]);
    }

    // ── STORE: multiple file upload ──
    public function store()
    {
        // Validation rules
        $rules = [
            'album' => 'required|min_length[2]',
            'title' => 'required|min_length[3]',
            'images' => 'uploaded[images]|max_size[images,10240]|is_image[images]'
        ];

        $messages = [
            'album' => [
                'required' => 'Nama album harus diisi',
                'min_length' => 'Nama album minimal 2 karakter'
            ],
            'title' => [
                'required' => 'Judul foto harus diisi',
                'min_length' => 'Judul foto minimal 3 karakter'
            ],
            'images' => [
                'uploaded' => 'Pilih minimal satu foto',
                'max_size' => 'Ukuran file maksimal 10 MB',
                'is_image' => 'File harus berupa gambar (JPG, PNG, WEBP)'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('error', $this->validator->getErrors());
        }

        $files = $this->request->getFiles();
        $album = trim($this->request->getPost('album'));
        $title = trim($this->request->getPost('title'));

        if (empty($files['images'])) {
            return redirect()->back()->with('error', 'Pilih minimal satu foto.');
        }

        $uploadPath = FCPATH . 'uploads/gallery/';

        // Create directory if not exists
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $uploaded = 0;
        $errors = [];

        foreach ($files['images'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                // Validate file size and type again
                if ($file->getSize() > 10485760) { // 10 MB
                    $errors[] = "File {$file->getName()} melebihi ukuran maksimal 10 MB";
                    continue;
                }

                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!in_array($file->getMimeType(), $allowedTypes)) {
                    $errors[] = "File {$file->getName()} bukan format gambar yang diizinkan (JPG, PNG, WEBP)";
                    continue;
                }

                $fileName = $file->getRandomName();
                $file->move($uploadPath, $fileName);

                $this->galleryModel->save([
                    'title' => $title,
                    'album' => $album,
                    'image' => $fileName,
                    'trip_id' => null,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                $uploaded++;
            }
        }

        if ($uploaded > 0) {
            $message = $uploaded . ' foto berhasil diupload ke album "' . $album . '".';
            if (!empty($errors)) {
                $message .= ' Namun ada ' . count($errors) . ' file yang gagal diupload.';
            }
            return redirect()->to('/admin/gallery')->with('success', $message);
        } else {
            $errorMessage = 'Gagal mengupload foto.';
            if (!empty($errors)) {
                $errorMessage .= ' ' . implode(', ', $errors);
            }
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    // ── EDIT: form ──
    public function edit($id)
    {
        $gallery = $this->galleryModel->find($id);
        if (!$gallery) {
            return redirect()->to('/admin/gallery')->with('error', 'Foto tidak ditemukan.');
        }

        $albums = $this->galleryModel
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->findAll();

        return view('admin/gallery/edit', [
            'gallery' => $gallery,
            'albums'  => $albums,
        ]);
    }

    // ── UPDATE: save edit ──
    public function update($id)
    {
        $gallery = $this->galleryModel->find($id);
        if (!$gallery) {
            return redirect()->to('/admin/gallery')->with('error', 'Foto tidak ditemukan.');
        }

        // Validation rules
        $rules = [
            'album' => 'required|min_length[2]',
            'title' => 'required|min_length[3]',
            'image' => 'if_exist|max_size[image,10240]|is_image[image]'
        ];

        $messages = [
            'album' => [
                'required' => 'Nama album harus diisi',
                'min_length' => 'Nama album minimal 2 karakter'
            ],
            'title' => [
                'required' => 'Judul foto harus diisi',
                'min_length' => 'Judul foto minimal 3 karakter'
            ],
            'image' => [
                'max_size' => 'Ukuran file maksimal 10 MB',
                'is_image' => 'File harus berupa gambar (JPG, PNG, WEBP)'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('error', $this->validator->getErrors());
        }

        $file = $this->request->getFile('image');
        $fileName = $gallery['image'];
        $uploadPath = FCPATH . 'uploads/gallery/';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validate new file
            if ($file->getSize() > 10485760) { // 10 MB
                return redirect()->back()->with('error', 'Ukuran file maksimal 10 MB');
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return redirect()->back()->with('error', 'Format file harus JPG, PNG, atau WEBP');
            }

            $fileName = $file->getRandomName();
            $file->move($uploadPath, $fileName);

            // Delete old file
            $oldPath = $uploadPath . $gallery['image'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $this->galleryModel->update($id, [
            'title' => trim($this->request->getPost('title')),
            'album' => trim($this->request->getPost('album')),
            'image' => $fileName,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin/gallery')->with('success', 'Foto berhasil diperbarui.');
    }

    // ── DELETE ──
    public function delete($id)
    {
        $gallery = $this->galleryModel->find($id);

        if ($gallery) {
            $filePath = FCPATH . 'uploads/gallery/' . $gallery['image'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $this->galleryModel->delete($id);
            return redirect()->to('/admin/gallery')->with('success', 'Foto berhasil dihapus.');
        }

        return redirect()->to('/admin/gallery')->with('error', 'Foto tidak ditemukan.');
    }

    // ── ALBUMS: daftar album unik + cover + jumlah foto ──
    public function albums()
    {
        $db = \Config\Database::connect();

        // Get album name, photo count, latest image as cover, and latest created date
        $albums = $db->table('galleries')
            ->select('album, COUNT(*) as total, MAX(image) as cover, MAX(created_at) as created_at')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/gallery/albums', ['albums' => $albums]);
    }

    // ── ALBUM PHOTOS: foto dalam album ──
    public function album($albumName)
    {
        $albumName = urldecode($albumName);

        $photos = $this->galleryModel
            ->where('album', $albumName)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        $pager = $this->galleryModel->pager;

        if (empty($photos) && !empty($albumName)) {
            return redirect()->to('/admin/gallery/albums')->with('error', 'Album tidak ditemukan.');
        }

        return view('admin/gallery/album_photos', [
            'albumName' => $albumName,
            'photos'    => $photos,
            'pager'     => $pager,
        ]);
    }

    // ── BULK DELETE: hapus multiple foto ──
    public function bulkDelete()
    {
        $ids = $this->request->getPost('ids');

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada foto yang dipilih.');
        }

        $ids = explode(',', $ids);
        $deleted = 0;

        foreach ($ids as $id) {
            $gallery = $this->galleryModel->find($id);
            if ($gallery) {
                $filePath = FCPATH . 'uploads/gallery/' . $gallery['image'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $this->galleryModel->delete($id);
                $deleted++;
            }
        }

        return redirect()->to('/admin/gallery')->with('success', $deleted . ' foto berhasil dihapus.');
    }

    // ── EXPORT DATA: export daftar foto ke CSV ──
    public function export()
    {
        $galleries = $this->galleryModel->orderBy('created_at', 'DESC')->findAll();

        $filename = 'gallery_export_' . date('Y-m-d_His') . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($output, ['ID', 'Judul', 'Album', 'File Name', 'Created At', 'Updated At']);

        // Add data rows
        foreach ($galleries as $gallery) {
            fputcsv($output, [
                $gallery['gallery_id'],
                $gallery['title'],
                $gallery['album'],
                $gallery['image'],
                $gallery['created_at'],
                $gallery['updated_at'] ?? ''
            ]);
        }

        fclose($output);
        exit();
    }
}
