<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\TripModel;
use App\Models\DocumentModel;

class LaporanController extends BaseController
{
    protected $bookingModel;
    protected $tripModel;
    protected $documentModel;

    public function __construct()
    {
        $this->bookingModel  = new BookingModel();
        $this->tripModel     = new TripModel();
        $this->documentModel = new DocumentModel();
    }

    // =========================================================
    // ADMIN — Halaman Kelola Laporan
    // =========================================================

    /**
     * Tampilkan halaman laporan dengan filter trip
     */
    public function index()
    {
        $tripId = $this->request->getGet('trip_id');

        $trips = $this->tripModel
            ->select('trip_id, title, location')
            ->orderBy('title', 'ASC')
            ->findAll();

        // 1. Get statistics and totals using the full query
        $allBookings = $this->buildReportQuery($tripId)->findAll();
        
        $stats = [
            'totalBookings' => count($allBookings),
            'totalPeserta'  => array_sum(array_column($allBookings, 'participant')),
            'confirmed'     => count(array_filter($allBookings, fn($b) => $b['status'] === 'confirmed')),
            'pending'       => count(array_filter($allBookings, fn($b) => $b['status'] === 'pending')),
            'cancelled'     => count(array_filter($allBookings, fn($b) => $b['status'] === 'cancelled')),
            'totalPriceAll' => array_sum(array_column($allBookings, 'total_price')),
        ];

        // 2. Get paginated bookings for current page
        $bookings = $this->buildReportQuery($tripId)->paginate(10, 'bookings');
        $pager = $this->bookingModel->pager;

        return view('admin/reports/index', [
            'title'        => 'Kelola Laporan',
            'trips'        => $trips,
            'bookings'     => $bookings,
            'selectedTrip' => $tripId,
            'pager'        => $pager,
            'stats'        => $stats,
        ]);
    }

    private function buildReportQuery($tripId = null)
    {
        $query = $this->bookingModel
            ->select('
                bookings.*,
                users.name     as username,
                users.email    as user_email,
                trips.title    as trip_title,
                trips.location as trip_location,
                schedules.departure_date,
                payments.status as payment_status,
                meeting_points.name as meeting_point
            ')
            ->join('users',          'users.user_id = bookings.user_id')
            ->join('schedules',      'schedules.schedule_id = bookings.schedule_id')
            ->join('trips',          'trips.trip_id = schedules.trip_id')
            ->join('payments',       'payments.booking_id = bookings.booking_id', 'left')
            ->join('meeting_points', 'meeting_points.meeting_point_id = bookings.meeting_point_id', 'left')
            ->orderBy('bookings.created_at', 'DESC');

        if (!empty($tripId)) {
            $query->where('trips.trip_id', (int)$tripId);
        }

        return $query;
    }

    /**
     * Export laporan booking ke CSV dengan filter trip
     */
    public function exportExcel()
    {
        $tripId = $this->request->getGet('trip_id');

        $query = $this->bookingModel
            ->select('bookings.booking_id, bookings.booking_code, users.name as user_name, trips.title, trips.location, bookings.participant, meeting_points.name as meeting_point, trips.price, trips.type, schedules.departure_date, payments.status as payment_status, bookings.total_price, bookings.status as booking_status')
            ->join('schedules',      'schedules.schedule_id = bookings.schedule_id', 'left')
            ->join('trips',          'trips.trip_id = schedules.trip_id', 'left')
            ->join('users',          'users.user_id = bookings.user_id', 'left')
            ->join('meeting_points', 'meeting_points.meeting_point_id = bookings.meeting_point_id', 'left')
            ->join('payments',       'payments.booking_id = bookings.booking_id', 'left')
            ->orderBy('bookings.booking_id', 'DESC');

        if (!empty($tripId)) {
            $query->where('trips.trip_id', (int)$tripId);
        }

        $bookings = $query->findAll();

        // Tentukan nama file
        $tripName = '';
        if (!empty($tripId)) {
            $trip     = $this->tripModel->find((int)$tripId);
            $tripName = $trip ? '_' . preg_replace('/[^a-zA-Z0-9_]/', '', str_replace(' ', '_', $trip['title'])) : '';
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=laporan_booking' . $tripName . '_' . date('Y-m-d_His') . '.csv');

        echo "\xEF\xBB\xBF";

        $output = fopen('php://output', 'w');
        fputcsv($output, [
            'No',
            'Kode Booking',
            'Nama Pemesan',
            'Nama Trip',
            'Lokasi',
            'Jenis Trip',
            'Tanggal Keberangkatan',
            'Jumlah Peserta',
            'Nama-Nama Peserta',
            'Meeting Point',
            'Harga/Orang',
            'Total Harga',
            'Status Booking',
            'Status Pembayaran',
        ]);

        foreach ($bookings as $no => $booking) {
            $participant = ($booking['participant'] && $booking['participant'] !== '') ? (int)$booking['participant'] : 0;
            $price       = ($booking['price'] && $booking['price'] !== '') ? (int)$booking['price'] : 0;
            $totalHarga  = ($booking['total_price'] && $booking['total_price'] !== '') ? (int)$booking['total_price'] : 0;

            $pesertaNames = '-';
            if ($participant >= 1) {
                $documents = $this->documentModel
                    ->select('name')
                    ->where('booking_id', $booking['booking_id'])
                    ->findAll();

                if (!empty($documents)) {
                    $names        = array_map(fn($doc) => $doc['name'], $documents);
                    $pesertaNames = implode(', ', $names);
                }
            }

            fputcsv($output, [
                $no + 1,
                $booking['booking_code'],
                $booking['user_name']     ?? '-',
                $booking['title']         ?? '-',
                $booking['location']      ?? '-',
                $booking['type']          ?? '-',
                $booking['departure_date'] ? date('d-m-Y', strtotime($booking['departure_date'])) : '-',
                $participant,
                $pesertaNames,
                $booking['meeting_point'] ?? '-',
                $price,
                $totalHarga,
                ucfirst($booking['booking_status'] ?? '-'),
                ucfirst($booking['payment_status'] ?? '-'),
            ]);
        }

        fclose($output);
        exit;
    }
}
