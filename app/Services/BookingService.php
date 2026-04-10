<?php

namespace App\Services;

use App\Models\BookingModel;
use App\Models\ScheduleModel;
use App\Models\TripModel;
use App\Models\UserModel;
use App\Models\PaymentModel;
use App\Models\DocumentModel;
use App\Models\MeetingPointModel;
use App\Services\DocumentService;
use App\Services\PaymentService;

class BookingService
{
    protected $bookingModel;
    protected $scheduleModel;
    protected $tripModel;
    protected $userModel;
    protected $paymentModel;
    protected $documentModel;
    protected $meetingPointModel;
    protected $documentService;
    protected $paymentService;

    public function __construct(
        PaymentService $paymentService = null,
        DocumentService $documentService = null
    ) {
        $this->bookingModel      = new BookingModel();
        $this->scheduleModel     = new ScheduleModel();
        $this->tripModel         = new TripModel();
        $this->userModel         = new UserModel();
        $this->paymentModel      = new PaymentModel();
        $this->documentModel     = new DocumentModel();
        $this->meetingPointModel = new MeetingPointModel();
        $this->paymentService    = $paymentService ?? new PaymentService();
        $this->documentService   = $documentService ?? new DocumentService();
    }

    /*
    =====================================
    GET DATA UNTUK FORM CREATE BOOKING
    =====================================
    */

    public function getCreateFormData(int $schedule_id): ?array
    {
        $schedule = $this->scheduleModel
            ->select('schedules.*, trips.title, trips.location, trips.price, trips.image')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->where('schedule_id', $schedule_id)
            ->first();

        if (!$schedule) {
            return null;
        }

        $meetingPoints = $this->meetingPointModel
            ->where('trip_id', $schedule['trip_id'])
            ->findAll();

        return [
            'schedule'      => $schedule,
            'meetingPoints' => $meetingPoints,
        ];
    }

    /*
    =====================================
    CREATE BOOKING (Main Orchestrator)
    =====================================
    */

    public function createBooking(int $user_id, array $post, array $files): array
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $schedule_id      = $post['schedule_id'];
            $participant      = (int) $post['participant'];
            $meeting_point_id = $post['meeting_point_id'] ?? null;
            $redeem_point     = (int) ($post['redeem_point'] ?? 0);
            $payment_method   = $post['payment_method'];

            $schedule = $this->scheduleModel->find($schedule_id);
            if (!$schedule) {
                throw new \Exception('Schedule tidak ditemukan');
            }

            $trip = $this->tripModel->find($schedule['trip_id']);
            if (!$trip) {
                throw new \Exception('Trip tidak ditemukan');
            }

            if ($schedule['available'] < $participant) {
                throw new \Exception('Kuota tidak mencukupi');
            }

            $final_price = $this->calculateFinalPrice($trip['price'], $participant, $redeem_point);

            $booking_id = $this->bookingModel->insert([
                'booking_code'     => $this->generateBookingCode(),
                'user_id'          => $user_id,
                'schedule_id'      => $schedule_id,
                'meeting_point_id' => $meeting_point_id ?: null,
                'participant'      => $participant,
                'total_price'      => $final_price,
                'status'           => 'pending',
                'created_at'       => date('Y-m-d H:i:s')
            ]);

            if (!$booking_id) {
                throw new \Exception('Gagal membuat booking');
            }

            $this->documentService->storeParticipantDocuments(
                $booking_id,
                $post['participants'] ?? [],
                $files['ktp'] ?? [],
                $files['health'] ?? []
            );

            $this->paymentService->createPaymentRecord(
                $booking_id,
                $payment_method,
                $final_price,
                $files['payment_proof'] ?? null
            );

            // Quota reduction moved to Admin confirmation stage
            // $this->reduceScheduleQuota($schedule, $schedule_id, $participant);

            if ($redeem_point > 0) {
                $this->deductUserPoints($user_id, $redeem_point);
            }

            $db->transCommit();

            return ['success' => true, 'booking_id' => $booking_id];
        } catch (\Exception $e) {
            $db->transRollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /*
    =====================================
    GET BOOKING DETAIL (siap pakai untuk view)
    =====================================
    */

    public function getBookingDetail(int $booking_id, int $user_id): ?array
    {
        // 1 query JOIN — sudah include schedule, trip, meeting_point
        $booking = $this->bookingModel->getBookingWithDetail($booking_id, $user_id);

        if (!$booking) {
            return null;
        }

        return [
            'booking'   => $booking,
            'payment'   => $this->paymentModel->where('booking_id', $booking_id)->first(),
            'documents' => $this->documentModel->where('booking_id', $booking_id)->findAll(),
        ];
    }

    /*
    =====================================
    GET BOOKING HISTORY
    =====================================
    */

    public function getBookingHistory(int $user_id): array
    {
        return $this->bookingModel
            ->select('
                bookings.*,
                trips.title as trip_title,
                schedules.departure_date,
                payments.status as payment_status,
                payments.proof
            ')
            ->join('schedules', 'schedules.schedule_id = bookings.schedule_id')
            ->join('trips', 'trips.trip_id = schedules.trip_id')
            ->join('payments', 'payments.booking_id = bookings.booking_id', 'left')
            ->where('bookings.user_id', $user_id)
            ->orderBy('bookings.created_at', 'DESC')
            ->findAll();
    }

    /*
    =====================================
    PRIVATE HELPERS
    =====================================
    */

    private function generateBookingCode(): string
    {
        $prefix = 'TRIP';
        $date   = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 5));

        return $prefix . '-' . $date . '-' . $random;
    }

    private function calculateFinalPrice(float $price_per_person, int $participant, int $redeem_point): float
    {
        $subtotal = $price_per_person * $participant;
        $discount = ($redeem_point / 100) * 5000;
        $final    = $subtotal - $discount;

        return max(0, $final);
    }

    private function reduceScheduleQuota(array $schedule, int $schedule_id, int $participant): void
    {
        $available = max(0, ($schedule['available'] ?? 0) - $participant);

        $this->scheduleModel->update($schedule_id, [
            'available'  => $available,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        if ($available === 0) {
            $this->tripModel->update($schedule['trip_id'], [
                'status' => 'full'
            ]);
        }
    }

    private function deductUserPoints(int $user_id, int $redeem_point): void
    {
        $user          = $this->userModel->find($user_id);
        $currentPoints = $user['points'] ?? 0;
        $newPoints     = max(0, $currentPoints - $redeem_point);

        $this->userModel->update($user_id, ['points' => $newPoints]);
        session()->set('points', $newPoints);
    }
}