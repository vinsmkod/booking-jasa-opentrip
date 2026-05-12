<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\UserModel;
use App\Models\PaymentModel;
use App\Models\ScheduleModel;
use App\Models\TripModel;
use App\Models\DocumentModel;
use App\Services\BookingService;
use App\Services\PaymentService;
use App\Services\DocumentService;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $userModel;
    protected $paymentModel;
    protected $scheduleModel;
    protected $tripModel;
    protected $documentModel;
    protected $bookingService;
    protected $paymentService;
    protected $documentService;

    public function __construct()
    {
        $this->bookingModel    = new BookingModel();
        $this->userModel       = new UserModel();
        $this->paymentModel    = new PaymentModel();
        $this->scheduleModel   = new ScheduleModel();
        $this->tripModel       = new TripModel();
        $this->documentModel   = new DocumentModel();
        $this->paymentService  = new PaymentService();
        $this->documentService = new DocumentService();
        $this->bookingService  = new BookingService(
            $this->paymentService,
            $this->documentService
        );
    }

    // =========================================================
    // CUSTOMER — Booking untuk Pelanggan
    // =========================================================

    /**
     * Tampilkan form buat booking baru
     */
    public function create($schedule_id)
    {
        $data = $this->bookingService->getCreateFormData($schedule_id);

        if (!$data) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('booking/create', $data);
    }

    /**
     * Simpan booking baru
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

    /**
     * Detail booking untuk customer
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

    /**
     * Upload bukti pembayaran
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

    /**
     * Riwayat booking customer
     */
    public function history()
    {
        $user_id  = session()->get('user_id');
        $bookings = $this->bookingService->getBookingHistory($user_id);

        return view('booking/history', [
            'bookings' => $bookings
        ]);
    }

    /**
     * Upload dokumen peserta
     */
    public function uploadDocument($bookingId)
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

    // =========================================================
    // ADMIN — Manajemen Booking
    // =========================================================

    /**
     * Daftar semua booking (admin)
     */
    public function adminIndex()
    {
        $search = $this->request->getGet('search');

        $this->bookingModel
            ->select('
                bookings.*,
                users.name as username,
                users.email as user_email,
                trips.title as trip_title,
                trips.location as trip_location,
                schedules.departure_date,
                payments.payment_id,
                payments.method,
                payments.proof,
                payments.status as payment_status,
                payments.amount as payment_amount
            ')
            ->join('users', 'users.user_id = bookings.user_id')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->join('payments', 'payments.booking_id = bookings.booking_id', 'left')
            ->orderBy('bookings.created_at', 'DESC');

        if (!empty($search)) {
            $this->bookingModel->groupStart()
                ->like('bookings.booking_code', $search)
                ->orLike('users.name', $search)
                ->orLike('users.email', $search)
                ->orLike('trips.title', $search)
                ->groupEnd();
        }

        $bookings = $this->bookingModel->paginate(10, 'bookings');
        $pager    = $this->bookingModel->pager;

        $documents      = [];
        $bookingPeserta = [];
        $docsByBooking  = [];

        $bookingIds = array_column($bookings, 'booking_id');

        if (!empty($bookingIds)) {
            $documents = $this->documentModel
                ->select('
                    documents.*,
                    bookings.booking_code
                ')
                ->join('bookings', 'bookings.booking_id = documents.booking_id')
                ->whereIn('documents.booking_id', $bookingIds)
                ->findAll();

            $bookingMap = [];
            foreach ($bookings as $b) {
                $bookingMap[$b['booking_id']] = $b;
            }

            foreach ($documents as $doc) {
                $bid = $doc['booking_id'];

                if (!isset($docsByBooking[$bid])) {
                    $docsByBooking[$bid] = [
                        'booking_code' => $doc['booking_code'] ?? '-',
                        'docs'         => []
                    ];
                }
                $docsByBooking[$bid]['docs'][] = $doc;

                if (!isset($bookingPeserta[$bid])) {
                    $bk = $bookingMap[$bid] ?? null;

                    $bookingPeserta[$bid] = [
                        'booking_code' => $doc['booking_code'] ?? '-',
                        'trip_title'   => $bk['trip_title'] ?? '-',
                        'status'       => $bk['status'] ?? 'pending',
                        'peserta'      => []
                    ];
                }

                $bookingPeserta[$bid]['peserta'][] = [
                    'name'      => $doc['name'],
                    'gender'    => $doc['gender'],
                    'email'     => $doc['email'],
                    'birthdate' => $doc['birthdate']
                ];
            }
        }

        return view('admin/bookings/index', [
            'bookings'       => $bookings,
            'pager'          => $pager,
            'search'         => $search,
            'documents'      => $documents,
            'docsByBooking'  => $docsByBooking,
            'bookingPeserta' => $bookingPeserta
        ]);
    }

    /**
     * Konfirmasi booking (admin)
     */
    public function confirm($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $booking = $this->bookingModel->find($id);

            if (!$booking) {
                throw new \Exception('Booking tidak ditemukan');
            }

            if ($booking['status'] === 'confirmed') {
                throw new \Exception('Booking sudah dikonfirmasi');
            }

            $schedule = $this->scheduleModel->find($booking['schedule_id']);

            if (!$schedule) {
                throw new \Exception('Schedule tidak ditemukan');
            }

            $payment = $this->paymentModel
                ->where('booking_id', $id)
                ->first();

            if (!$payment) {
                $this->paymentModel->insert([
                    'booking_id' => $id,
                    'method'     => 'Manual Verification',
                    'amount'     => $booking['total_price'],
                    'status'     => 'verified',
                    'paid_at'    => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                $this->paymentModel->update($payment['payment_id'], [
                    'status'     => 'verified',
                    'paid_at'    => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            $this->bookingModel->update($id, [
                'status'     => 'confirmed',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if ($schedule['available'] < $booking['participant']) {
                throw new \Exception('Gagal konfirmasi: Sisa kuota tidak mencukupi (' . $schedule['available'] . ' sisa)');
            }

            $newAvailable = $schedule['available'] - $booking['participant'];

            $this->scheduleModel->update($schedule['schedule_id'], [
                'available'  => $newAvailable,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if ($newAvailable === 0) {
                $this->tripModel->update($schedule['trip_id'], [
                    'status' => 'full'
                ]);
            }

            $db->transCommit();

            return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Batalkan booking (admin)
     */
    public function cancel($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $booking = $this->bookingModel->find($id);

            if (!$booking) {
                throw new \Exception('Booking tidak ditemukan');
            }

            if ($booking['status'] === 'cancelled') {
                throw new \Exception('Booking sudah dibatalkan');
            }

            $this->bookingModel->update($id, [
                'status' => 'cancelled'
            ]);

            $payment = $this->paymentModel
                ->where('booking_id', $id)
                ->first();

            if ($payment && $payment['status'] != 'verified') {
                $this->paymentModel->update($payment['payment_id'], [
                    'status' => 'rejected'
                ]);
            }

            // Restore quota jika booking sebelumnya confirmed
            if ($booking['status'] === 'confirmed') {
                $schedule = $this->scheduleModel->find($booking['schedule_id']);

                if ($schedule) {
                    $this->scheduleModel->update($schedule['schedule_id'], [
                        'available' => $schedule['available'] + $booking['participant']
                    ]);
                }
            }

            $db->transCommit();

            return redirect()->back()->with('success', 'Booking dibatalkan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
