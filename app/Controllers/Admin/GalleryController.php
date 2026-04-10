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

    /*
    ================================
    INDEX
    ================================
    */

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $query = $this->galleryModel
            ->orderBy('created_at', 'DESC');

        if ($keyword) {
            $query->like('title', $keyword);
        }

        $totalPhotos = $this->galleryModel->countAll();

        $totalAlbums = $this->galleryModel
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->countAllResults();

        return view('admin/gallery/index', [
            'galleries'   => $query->paginate(12),
            'pager'       => $this->galleryModel->pager,
            'keyword'     => $keyword,
            'totalPhotos' => $totalPhotos,
            'totalAlbums' => $totalAlbums
        ]);
    }

    /*
    ================================
    CREATE
    ================================
    */

    public function create()
    {
        $albums = $this->galleryModel
            ->select('album')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->findAll();

        return view('admin/gallery/create', [
            'albums' => $albums
        ]);
    }

    /*
    ================================
    STORE (UPLOAD + RESIZE)
    ================================
    */

    public function store()
    {
        $album = $this->request->getPost('album');
        $title = $this->request->getPost('title');

        $uploadPath = FCPATH . 'uploads/gallery/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        /*
        ====================
        MULTIPLE UPLOAD WITH RESIZE
        ====================
        */
        $files = $this->request->getFiles();

        if (!$files['images']) {
            return redirect()->back()
                ->with('error', 'Pilih foto terlebih dahulu');
        }

        $uploaded = 0;
        $errors = [];

        foreach ($files['images'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                // Validate file size (10 MB)
                if ($file->getSize() > 10485760) {
                    $errors[] = 'File ' . $file->getName() . ' terlalu besar! Maksimal 10 MB.';
                    continue;
                }

                // Validate file type
                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!in_array($file->getMimeType(), $allowedTypes)) {
                    $errors[] = 'File ' . $file->getName() . ' format tidak didukung! Gunakan JPG, PNG, atau WEBP.';
                    continue;
                }

                $tempPath = $uploadPath . 'temp_' . $file->getName();

                // Move file to temp location
                $file->move($uploadPath, 'temp_' . $file->getName());

                // Resize and optimize image
                $finalName = time() . '_' . uniqid() . '.jpg';
                $success = $this->resizeImage($tempPath, $uploadPath . $finalName, 1200, 1200, 85);

                if ($success) {
                    // Delete temp file
                    if (file_exists($tempPath)) {
                        unlink($tempPath);
                    }

                    $this->galleryModel->save([
                        'title' => $title,
                        'album' => $album,
                        'image' => $finalName,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);

                    $uploaded++;
                } else {
                    $errors[] = 'Gagal memproses file: ' . $file->getName();
                }
            }
        }

        if ($uploaded > 0) {
            return redirect()->to('/admin/gallery')
                ->with('success', $uploaded . ' foto berhasil diupload');
        } else {
            return redirect()->back()
                ->with('error', $errors ?: 'Gagal mengupload foto');
        }
    }

    /*
    ================================
    EDIT
    ================================
    */

    public function edit($id)
    {
        $gallery = $this->galleryModel->find($id);

        if (!$gallery) {
            return redirect()
                ->to('/admin/gallery')
                ->with('error', 'Foto tidak ditemukan');
        }

        return view('admin/gallery/edit', [
            'gallery' => $gallery
        ]);
    }

    /*
    ================================
    UPDATE
    ================================
    */

    public function update($id)
    {
        $gallery = $this->galleryModel->find($id);

        if (!$gallery) {
            return redirect()
                ->to('/admin/gallery')
                ->with('error', 'Foto tidak ditemukan');
        }

        $uploadPath = FCPATH . 'uploads/gallery/';
        
        // Pastikan director upload ada
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'album' => $this->request->getPost('album'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        /*
        ====================
        CROP IMAGE
        ====================
        */
        $crop = $this->request->getPost('cropped_image');

        if ($crop && !empty($crop) && $crop !== '') {
            try {
                // Remove data URI prefix
                if (strpos($crop, 'data:image/') === 0) {
                    $crop = preg_replace('#^data:image/[^;]+;base64,#', '', $crop);
                }

                // Decode base64 dengan strict mode
                $image = base64_decode($crop, true);

                // Validasi bahwa decode berhasil
                if ($image === false || empty($image)) {
                    return redirect()->back()
                        ->with('error', 'Gambar yang di-crop tidak valid. Silakan coba lagi.');
                }

                // Generate filename
                $fileName = time() . '_' . uniqid() . '.jpg';
                $tempPath = $uploadPath . 'temp_' . $fileName;
                $finalPath = $uploadPath . $fileName;

                // Tulis ke file temporary
                $bytesWritten = file_put_contents($tempPath, $image);

                // Validasi bahwa file berhasil ditulis
                if ($bytesWritten === false || $bytesWritten === 0) {
                    return redirect()->back()
                        ->with('error', 'Gagal menyimpan file. Pastikan folder uploads/gallery memiliki permission yang tepat.');
                }

                // Validasi bahwa file temporary ada
                if (!file_exists($tempPath)) {
                    return redirect()->back()
                        ->with('error', 'File temporary tidak dapat dibuat.');
                }

                // Resize image dan pindahkan ke final path
                $resizeSuccess = $this->resizeImage($tempPath, $finalPath, 1200, 900, 85);

                // Hapus temp file
                if (file_exists($tempPath)) {
                    @unlink($tempPath);
                }

                if (!$resizeSuccess || !file_exists($finalPath)) {
                    return redirect()->back()
                        ->with('error', 'Gagal memproses gambar. Silakan coba dengan gambar lain.');
                }

                // Hapus file lama
                if (!empty($gallery['image']) && file_exists($uploadPath . $gallery['image'])) {
                    @unlink($uploadPath . $gallery['image']);
                }

                $data['image'] = $fileName;
            } catch (\Exception $e) {
                log_message('error', 'Crop image error: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Terjadi kesalahan saat memproses gambar: ' . $e->getMessage());
            }
        }

        /*
        ====================
        NORMAL UPLOAD WITH RESIZE
        ====================
        */
        $file = $this->request->getFile('image');

        if ($file && $file->isValid() && $file->getName() !== '') {
            // Validate file size
            if ($file->getSize() > 10485760) {
                return redirect()->back()
                    ->with('error', 'Ukuran file terlalu besar! Maksimal 10 MB.');
            }

            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return redirect()->back()
                    ->with('error', 'Format file tidak didukung! Gunakan JPG, PNG, atau WEBP.');
            }

            $tempPath = $uploadPath . 'temp_' . $file->getName();

            // Move to temp
            $file->move($uploadPath, 'temp_' . $file->getName());

            // Resize and optimize
            $fileName = time() . '_' . uniqid() . '.jpg';
            $success = $this->resizeImage($tempPath, $uploadPath . $fileName, 1200, 900, 85);

            if ($success) {
                // Delete temp
                if (file_exists($tempPath)) {
                    @unlink($tempPath);
                }

                // Delete old file
                if (!empty($gallery['image']) && file_exists($uploadPath . $gallery['image'])) {
                    @unlink($uploadPath . $gallery['image']);
                }

                $data['image'] = $fileName;
            } else {
                return redirect()->back()
                    ->with('error', 'Gagal memproses gambar. Silakan coba lagi.');
            }
        }

        // Update database
        if (!$this->galleryModel->update($id, $data)) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan perubahan ke database.');
        }

        return redirect()
            ->to('/admin/gallery')
            ->with('success', 'Foto berhasil diperbarui');
    }

    /*
    ================================
    DELETE
    ================================
    */

    public function delete($id)
    {
        $gallery = $this->galleryModel->find($id);

        if ($gallery) {
            $file = FCPATH . 'uploads/gallery/' . $gallery['image'];

            if (file_exists($file)) {
                unlink($file);
            }

            $this->galleryModel->delete($id);

            return redirect()
                ->to('/admin/gallery')
                ->with('success', 'Foto berhasil dihapus');
        }

        return redirect()
            ->to('/admin/gallery')
            ->with('error', 'Foto tidak ditemukan');
    }

    /*
    ================================
    ALBUMS
    ================================
    */

    public function albums()
    {
        $db = \Config\Database::connect();

        $albums = $db->table('galleries')
            ->select('album, COUNT(*) as total, MAX(image) as cover')
            ->where('album IS NOT NULL')
            ->where('album !=', '')
            ->groupBy('album')
            ->orderBy('album', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/gallery/albums', [
            'albums' => $albums
        ]);
    }

    /*
    ================================
    ALBUM DETAIL
    ================================
    */

    public function album($album)
    {
        $photos = $this->galleryModel
            ->where('album', urldecode($album))
            ->paginate(12);

        return view('admin/gallery/albums_photos', [
            'photos' => $photos,
            'pager'  => $this->galleryModel->pager,
            'albumName' => urldecode($album)
        ]);
    }

    /*
    ================================
    BULK DELETE
    ================================
    */

    public function bulkDelete()
    {
        $ids = explode(',', $this->request->getPost('ids'));

        foreach ($ids as $id) {
            $gallery = $this->galleryModel->find($id);

            if ($gallery) {
                $file = FCPATH . 'uploads/gallery/' . $gallery['image'];

                if (file_exists($file)) {
                    unlink($file);
                }

                $this->galleryModel->delete($id);
            }
        }

        return redirect()
            ->to('/admin/gallery')
            ->with('success', 'Foto berhasil dihapus');
    }

    /*
    ================================
    EXPORT CSV
    ================================
    */

    public function export()
    {
        $data = $this->galleryModel->findAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=gallery_' . date('Y-m-d') . '.csv');

        $output = fopen('php://output', 'w');

        // Add BOM for UTF-8
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

        fputcsv($output, [
            'ID',
            'Judul',
            'Album',
            'Nama File',
            'Tanggal Upload'
        ]);

        foreach ($data as $row) {
            // Cast ID to integer to prevent leading zeros
            $galleryId = (int)$row['gallery_id'];
            
            fputcsv($output, [
                $galleryId,
                $row['title'] ?? '-',
                $row['album'] ?? '-',
                $row['image'] ?? '-',
                date('d-m-Y H:i:s', strtotime($row['created_at']))
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Resize and optimize image
     * 
     * @param string $source Source image path
     * @param string $destination Destination image path
     * @param int $maxWidth Maximum width
     * @param int $maxHeight Maximum height
     * @param int $quality JPEG quality (0-100)
     * @return bool Success or failure
     */
    private function resizeImage($source, $destination, $maxWidth = 1200, $maxHeight = 1200, $quality = 85)
    {
        try {
            // Check if source file exists
            if (!file_exists($source)) {
                return false;
            }

            // Check if GD library is installed
            if (!extension_loaded('gd')) {
                // If GD not available, just copy the file
                copy($source, $destination);
                return true;
            }

            // Get image info
            $imageInfo = getimagesize($source);
            if (!$imageInfo) {
                return false;
            }

            list($width, $height, $type) = $imageInfo;

            // Calculate new dimensions
            $ratio = min($maxWidth / $width, $maxHeight / $height);

            if ($ratio < 1) {
                $newWidth = round($width * $ratio);
                $newHeight = round($height * $ratio);
            } else {
                $newWidth = $width;
                $newHeight = $height;
            }

            // Create image resource based on type
            switch ($type) {
                case IMAGETYPE_JPEG:
                    $src = @imagecreatefromjpeg($source);
                    break;
                case IMAGETYPE_PNG:
                    $src = @imagecreatefrompng($source);
                    break;
                case IMAGETYPE_WEBP:
                    if (function_exists('imagecreatefromwebp')) {
                        $src = @imagecreatefromwebp($source);
                    } else {
                        copy($source, $destination);
                        return true;
                    }
                    break;
                default:
                    // Unsupported format, just copy original
                    copy($source, $destination);
                    return true;
            }

            if (!$src) {
                return false;
            }

            // Create new image
            $dst = imagecreatetruecolor($newWidth, $newHeight);

            // Handle PNG transparency
            if ($type == IMAGETYPE_PNG) {
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
                $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
                imagefilledrectangle($dst, 0, 0, $newWidth, $newHeight, $transparent);
            }

            // Resize
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Save image
            switch ($type) {
                case IMAGETYPE_JPEG:
                    imagejpeg($dst, $destination, $quality);
                    break;
                case IMAGETYPE_PNG:
                    imagepng($dst, $destination, 8);
                    break;
                case IMAGETYPE_WEBP:
                    if (function_exists('imagewebp')) {
                        imagewebp($dst, $destination, $quality);
                    } else {
                        imagejpeg($dst, $destination, $quality);
                    }
                    break;
                default:
                    imagejpeg($dst, $destination, $quality);
            }

            // Free memory
            imagedestroy($src);
            imagedestroy($dst);

            return true;
        } catch (\Exception $e) {
            log_message('error', 'Image resize failed: ' . $e->getMessage());
            // If resize fails, just copy original file
            copy($source, $destination);
            return true;
        }
    }
}
