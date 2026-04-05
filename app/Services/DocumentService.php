<?php

namespace App\Services;

use App\Models\DocumentModel;

class DocumentService
{
    protected $documentModel;

    // Path konsisten pakai FCPATH
    private const UPLOAD_PATH = 'uploads/documents';

    public function __construct()
    {
        $this->documentModel = new DocumentModel();
    }

    /*
    =====================================
    STORE PARTICIPANT DOCUMENTS (bulk, saat booking dibuat)
    =====================================
    */

    public function storeParticipantDocuments(int $booking_id, array $participants, array $ktpFiles, array $healthFiles): void
    {
        if (empty($participants) || !is_array($participants)) {
            return;
        }

        $this->ensureUploadDirExists();

        foreach ($participants as $i => $participant) {
            $ktpName    = $this->moveParticipantFile($ktpFiles[$i] ?? null);
            $healthName = $this->moveParticipantFile($healthFiles[$i] ?? null);

            $this->documentModel->insert([
                'booking_id' => $booking_id,
                'name'       => $participant['name'] ?? null,
                'email'      => $participant['email'] ?? null,
                'birthdate'  => $participant['birthdate'] ?? null,
                'gender'     => $participant['gender'] ?? null,
                'ktp'        => $ktpName,
                'health'     => $healthName,
                'status'     => 'pending'
            ]);
        }
    }

    /*
    =====================================
    UPLOAD SINGLE DOCUMENT (dari form upload terpisah)
    =====================================
    */

    public function uploadSingleDocument(int $booking_id, $file, string $type = 'ktp'): array
    {
        if (!$file || !$file->isValid()) {
            return ['success' => false, 'message' => 'File tidak valid'];
        }

        $validationError = $this->validateDocumentFile($file);
        if ($validationError) {
            return ['success' => false, 'message' => $validationError];
        }

        $this->ensureUploadDirExists();

        $newName = $file->getRandomName();
        $file->move(FCPATH . self::UPLOAD_PATH, $newName);

        $this->saveOrUpdateDocument($booking_id, $type, $newName);

        return ['success' => true];
    }

    /*
    =====================================
    PRIVATE HELPERS
    =====================================
    */

    private function validateDocumentFile($file): ?string
    {
        $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'application/pdf'];

        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return 'Format harus JPG, PNG, atau PDF';
        }

        if ($file->getSize() > 2097152) {
            return 'Ukuran maksimal 2MB';
        }

        return null;
    }

    private function saveOrUpdateDocument(int $booking_id, string $type, string $newName): void
    {
        $oldDoc = $this->documentModel
            ->where('booking_id', $booking_id)
            ->where('type', $type)
            ->first();

        if ($oldDoc) {
            // Hapus file lama jika ada
            $oldPath = FCPATH . self::UPLOAD_PATH . '/' . $oldDoc['file'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            $this->documentModel->update($oldDoc['document_id'], [
                'file'   => $newName,
                'status' => 'pending'
            ]);
        } else {
            $this->documentModel->insert([
                'booking_id' => $booking_id,
                'type'       => $type,
                'file'       => $newName,
                'status'     => 'pending'
            ]);
        }
    }

    private function moveParticipantFile($file): ?string
    {
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        $fileName = $file->getRandomName();
        $file->move(FCPATH . self::UPLOAD_PATH, $fileName);

        return $fileName;
    }

    private function ensureUploadDirExists(): void
    {
        $path = FCPATH . self::UPLOAD_PATH;

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }
}