<?php

namespace App\Services;

use App\Models\PaymentModel;
use App\Models\BookingModel;

class PaymentService
{
    protected $paymentModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
        $this->bookingModel = new BookingModel();
    }

    /*
    =====================================
    CREATE PAYMENT RECORD (saat booking dibuat)
    =====================================
    */

    public function createPaymentRecord(int $booking_id, string $method, float $amount, $paymentFile = null): void
    {
        $data = [
            'booking_id' => $booking_id,
            'method'     => $method,
            'amount'     => $amount,
            'status'     => 'pending',
            'paid_at'    => null,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $proofName = $this->moveUploadedFile($paymentFile);
        if ($proofName) {
            $data['proof'] = $proofName;
        }

        $this->paymentModel->insert($data);
    }

    /*
    =====================================
    UPLOAD PROOF (dari form upload terpisah)
    =====================================
    */

    public function uploadProof(int $booking_id, int $user_id, $paymentFile, ?string $payment_method): array
    {
        $booking = $this->bookingModel
            ->where('booking_id', $booking_id)
            ->where('user_id', $user_id)
            ->first();

        if (!$booking) {
            return ['success' => false, 'message' => 'Booking tidak ditemukan'];
        }

        if (!$paymentFile || !$paymentFile->isValid()) {
            return ['success' => false, 'message' => 'File bukti pembayaran tidak valid'];
        }

        $validationError = $this->validatePaymentFile($paymentFile);
        if ($validationError) {
            return ['success' => false, 'message' => $validationError];
        }

        $proofName = $this->moveUploadedFile($paymentFile);

        if (!$proofName) {
            return ['success' => false, 'message' => 'Gagal menyimpan file'];
        }

        $this->saveOrUpdateProof($booking_id, $booking, $proofName, $payment_method);

        return ['success' => true];
    }

    /*
    =====================================
    PRIVATE HELPERS
    =====================================
    */

    private function validatePaymentFile($file): ?string
    {
        $maxSize = 5 * 1024 * 1024;
        if ($file->getSize() > $maxSize) {
            return 'Ukuran file maksimal 5MB';
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return 'Format file harus JPG, PNG, atau PDF';
        }

        return null;
    }

    private function moveUploadedFile($file): ?string
    {
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        $uploadPath = FCPATH . 'uploads/payments';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $fileName = $file->getRandomName();
        $file->move($uploadPath, $fileName);

        return $fileName;
    }

    private function saveOrUpdateProof(int $booking_id, array $booking, string $proofName, ?string $payment_method): void
    {
        $existing = $this->paymentModel->where('booking_id', $booking_id)->first();

        if ($existing) {
            // Hapus file lama jika ada
            if (!empty($existing['proof'])) {
                $oldFile = FCPATH . 'uploads/payments/' . $existing['proof'];
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $this->paymentModel->update($existing['payment_id'], [
                'proof'      => $proofName,
                'status'     => 'pending',
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $this->paymentModel->insert([
                'booking_id' => $booking_id,
                'proof'      => $proofName,
                'method'     => $payment_method,
                'amount'     => $booking['total_price'],
                'status'     => 'pending',
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}