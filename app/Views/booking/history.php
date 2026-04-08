<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .history-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 40px 24px;
    }

    /* Breadcrumb */
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 40px;
        display: flex;
        gap: 8px;
        font-size: 0.85rem;
    }

    .breadcrumb-item a {
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb-item a:hover {
        color: #2d7d3a;
    }

    .breadcrumb-item.active {
        color: #0f172a;
        font-weight: 600;
    }

    .breadcrumb-item::after {
        content: '/';
        margin-left: 8px;
        color: #cbd5e1;
    }

    .breadcrumb-item:last-child::after {
        content: '';
    }

    /* Page Header */
    .page-header {
        margin-bottom: 40px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-title i {
        color: #2d7d3a;
        font-size: 2.2rem;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* Stats Summary */
    .stats-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
        transition: all 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        border-color: #e0e7ff;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 800;
        color: #2d7d3a;
        line-height: 1.2;
    }

    .stat-card.stat-accent {
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        border-color: #d1fae5;
    }

    /* Table Wrapper */
    .table-wrapper {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
        margin-bottom: 28px;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        border-bottom: 2px solid #d1fae5;
        color: #2d7d3a;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px;
        text-align: left;
    }

    .table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.2s;
    }

    .table tbody tr:hover {
        background: #f8fafc;
    }

    .table tbody tr:last-child {
        border-bottom: none;
    }

    .table tbody td {
        padding: 16px;
        color: #0f172a;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    .booking-code {
        font-weight: 700;
        color: #2d7d3a;
        font-family: 'Monaco', 'Courier New', monospace;
        font-size: 0.9rem;
    }

    .trip-name {
        font-weight: 600;
        color: #0f172a;
    }

    .price-amount {
        font-weight: 700;
        color: #2d7d3a;
        font-size: 0.95rem;
    }

    .text-icon {
        margin-right: 6px;
        color: #64748b;
    }

    /* Badge Status */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-pending {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
    }

    .badge-confirmed {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
    }

    .badge-paid {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
    }

    .badge-cancelled {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #7f1d1d;
    }

    .badge-default {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        color: #475569;
    }

    /* Button */
    .btn-detail {
        background: white;
        border: 1.5px solid #e2e8f0;
        color: #0f172a;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }

    .btn-detail:hover {
        border-color: #2d7d3a;
        color: #2d7d3a;
        background: #f0fdf4;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 40px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h4 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .empty-state p {
        color: #64748b;
        margin-bottom: 28px;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .btn-explore {
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        color: white;
        padding: 12px 28px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .btn-explore:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(45, 125, 58, 0.3);
    }

    /* Info Note */
    .info-note {
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        border: 1.5px solid #d1fae5;
        border-radius: 10px;
        padding: 16px;
        text-align: center;
        font-size: 0.85rem;
        color: #475569;
    }

    .info-note i {
        color: #2d7d3a;
        margin-right: 8px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-summary {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .history-container {
            padding: 20px 16px;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .stats-summary {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .stat-card {
            padding: 16px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .table {
            min-width: 700px;
            font-size: 0.85rem;
        }

        .table tbody td {
            padding: 12px;
        }

        .table thead th {
            padding: 12px;
            font-size: 0.75rem;
        }

        .btn-detail {
            padding: 6px 10px;
            font-size: 0.75rem;
        }

        .empty-state {
            padding: 40px 20px;
        }

        .empty-state h4 {
            font-size: 1.2rem;
        }

        .empty-state-icon {
            font-size: 3rem;
        }
    }

    @media (max-width: 480px) {
        .history-container {
            padding: 16px 12px;
        }

        .page-title {
            font-size: 1.25rem;
        }

        .stat-number {
            font-size: 1.4rem;
        }
    }
</style>

<div class="history-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <span class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></span>
        <span class="breadcrumb-item active">Riwayat Booking</span>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-history"></i> Riwayat Booking Saya
        </h1>
        <p class="page-subtitle">Lihat dan kelola semua pemesanan trip yang telah Anda lakukan</p>
    </div>

    <?php if (empty($bookings)): ?>
        <!-- Empty State -->
        <div class="empty-state">
            <i class="fas fa-calendar-alt empty-state-icon"></i>
            <h4>Belum Ada Booking</h4>
            <p>Anda belum melakukan pemesanan trip apapun. Yuk, mulai petualanganmu sekarang dan jelajahi destinasi impianmu bersama OpenTrip!</p>
            <a href="<?= base_url('trips') ?>" class="btn-explore">
                <i class="fas fa-compass"></i> Jelajahi Trip Tersedia
            </a>
        </div>
    <?php else: ?>
        <!-- Stats Summary -->
        <?php
        $totalBooking = count($bookings);
        $totalSpent = array_sum(array_column($bookings, 'total_price'));
        $pendingCount = count(array_filter($bookings, function ($b) {
            return ($b['status'] ?? '') == 'pending';
        }));
        $confirmedCount = count(array_filter($bookings, function ($b) {
            return ($b['status'] ?? '') == 'confirmed';
        }));
        ?>

        <div class="stats-summary">
            <div class="stat-card">
                <div class="stat-label">Total Booking</div>
                <div class="stat-number"><?= $totalBooking ?></div>
            </div>
            <div class="stat-card stat-accent">
                <div class="stat-label">Total Pengeluaran</div>
                <div class="stat-number">Rp <?= number_format($totalSpent, 0, ',', '.') ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Menunggu Konfirmasi</div>
                <div class="stat-number"><?= $pendingCount ?></div>
            </div>
            <div class="stat-card stat-accent">
                <div class="stat-label">Terkonfirmasi</div>
                <div class="stat-number"><?= $confirmedCount ?></div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode Booking</th>
                            <th>Trip</th>
                            <th>Tanggal Keberangkatan</th>
                            <th>Peserta</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $b): ?>
                            <tr>
                                <td>
                                    <span class="booking-code"><?= esc($b['booking_code'] ?? $b['booking_id']) ?></span>
                                </td>
                                <td>
                                    <span class="trip-name"><?= esc($b['trip_title'] ?? '-') ?></span>
                                </td>
                                <td>
                                    <i class="far fa-calendar-alt text-icon"></i>
                                    <?= !empty($b['departure_date'])
                                        ? date('d M Y', strtotime($b['departure_date']))
                                        : '-' ?>
                                </td>
                                <td>
                                    <i class="fas fa-users text-icon"></i> <?= esc($b['participant'] ?? 0) ? esc($b['participant']) . ' Orang' : '-' ?>
                                </td>
                                <td>
                                    <span class="price-amount">Rp <?= number_format($b['total_price'] ?? 0, 0, ',', '.') ?></span>
                                </td>
                                <td>
                                    <?php
                                    switch ($b['status'] ?? '') {
                                        case 'pending':
                                            $badge = 'badge-pending';
                                            $icon = 'fas fa-hourglass-half';
                                            $text = 'Pending';
                                            break;
                                        case 'paid':
                                            $badge = 'badge-paid';
                                            $icon = 'fas fa-check-circle';
                                            $text = 'Dibayar';
                                            break;
                                        case 'confirmed':
                                            $badge = 'badge-confirmed';
                                            $icon = 'fas fa-check-double';
                                            $text = 'Terkonfirmasi';
                                            break;
                                        case 'cancelled':
                                            $badge = 'badge-cancelled';
                                            $icon = 'fas fa-ban';
                                            $text = 'Dibatalkan';
                                            break;
                                        default:
                                            $badge = 'badge-default';
                                            $icon = 'fas fa-info-circle';
                                            $text = esc($b['status'] ?? 'Unknown');
                                    }
                                    ?>
                                    <span class="badge-status <?= $badge ?>">
                                        <i class="<?= $icon ?>"></i> <?= $text ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('booking/detail/' . $b['booking_id']) ?>"
                                        class="btn-detail">
                                        <i class="fas fa-arrow-right"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Info Note -->
        <div class="info-note">
            <i class="fas fa-info-circle"></i>
            <span>Klik tombol Detail untuk melihat informasi lengkap dan mengelola booking Anda</span>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>