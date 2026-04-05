<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\BookingService;
use App\Services\PaymentService;
use App\Services\DocumentService;

class BookingController extends BaseController
{
    protected $bookingService;
    protected $paymentService;

    public function __construct()
    {
        $this->paymentService = new PaymentService();
        $this->bookingService = new BookingService(
            $this->paymentService,
            new DocumentService()
        );
    }

    /*
    =====================================
    CREATE BOOKING (Show Form)
    =====================================
    */

    public function create($schedule_id)
    {
        $data = $this->bookingService->getCreateFormData($schedule_id);

        if (!$data) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('booking/create', $data);
    }

    /*
    =====================================
    STORE BOOKING
    =====================================
    */

    public function store()
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        $result = $this->bookingService->createBooking(
            $user_id,
            $this->request->getPost(),
            $this->request->getFiles()
        );

        if (!$result['success']) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal membuat booking: ' . $result['message']);
        }

        return redirect()->to('/booking/detail/' . $result['booking_id'])
            ->with('success', 'Booking berhasil dibuat! Silakan upload bukti pembayaran untuk verifikasi.');
    }

    /*
    =====================================
    DETAIL BOOKING
    =====================================
    */

    public function detail($booking_id)
    {
        $user_id = session()->get('user_id');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        $data = $this->bookingService->getBookingDetail($booking_id, $user_id);

        if (!$data) {
            return redirect()->to('/dashboard');
        }

        return view('booking/detail', $data);
    }

    /*
    =====================================
    UPLOAD PAYMENT PROOF
    =====================================
    */

    public function uploadPayment($booking_id)
    {
        $user_id = session()->get('user_id');

        $result = $this->paymentService->uploadProof(
            $booking_id,
            $user_id,
            $this->request->getFile('payment_proof'),
            $this->request->getPost('payment_method')
        );

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->to('/booking/detail/' . $booking_id)
            ->with('success', 'Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.');
    }

    /*
    =====================================
    HISTORY BOOKING
    =====================================
    */

    public function history()
    {
        $user_id  = session()->get('user_id');
        $bookings = $this->bookingService->getBookingHistory($user_id);

        return view('booking/history', [
            'bookings' => $bookings
        ]);
    }
}