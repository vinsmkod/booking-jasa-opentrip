<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DocumentModel;
use App\Models\BookingModel;

class DocumentController extends BaseController
{
    protected $documentModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->documentModel = new DocumentModel();
        $this->bookingModel  = new BookingModel();
    }

    public function upload($bookingId)
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        // cek booking
        $booking = $this->bookingModel
            ->where('booking_id', $bookingId)
            ->where('user_id', $user_id)
            ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan');
        }

        $file = $this->request->getFile('document');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid');
        }

        // validasi tipe file
        $allowedTypes = [
            'image/png',
            'image/jpg',
            'image/jpeg',
            'application/pdf'
        ];

        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return redirect()->back()->with('error', 'Format harus JPG, PNG, atau PDF');
        }

        // validasi size
        if ($file->getSize() > 2097152) {
            return redirect()->back()->with('error', 'Ukuran maksimal 2MB');
        }

        // pastikan folder ada
        $uploadPath = ROOTPATH . 'public/uploads/documents';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // nama file random
        $newName = $file->getRandomName();

        $file->move($uploadPath, $newName);

        // cek dokumen lama
        $oldDoc = $this->documentModel
            ->where('booking_id', $bookingId)
            ->first();

        if ($oldDoc) {

            // hapus file lama
            $oldPath = $uploadPath . '/' . $oldDoc['file'];

            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // update
            $this->documentModel->update($oldDoc['document_id'], [
                'file' => $newName,
                'status' => 'pending'
            ]);

        } else {

            // insert baru
            $this->documentModel->insert([
                'booking_id' => $bookingId,
                'type'       => 'ktp',
                'file'       => $newName,
                'status'     => 'pending'
            ]);
        }

        return redirect()->back()->with('success', 'Dokumen berhasil diupload');
    }
}