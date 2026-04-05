<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Services\DocumentService;

class DocumentController extends BaseController
{
    protected $bookingModel;
    protected $documentService;

    public function __construct()
    {
        $this->bookingModel    = new BookingModel();
        $this->documentService = new DocumentService();
    }

    public function upload($bookingId)
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        $booking = $this->bookingModel
            ->where('booking_id', $bookingId)
            ->where('user_id', $user_id)
            ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan');
        }

        $result = $this->documentService->uploadSingleDocument(
            $bookingId,
            $this->request->getFile('document'),
            $this->request->getPost('type') ?? 'ktp'
        );

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->back()->with('success', 'Dokumen berhasil diupload');
    }
}