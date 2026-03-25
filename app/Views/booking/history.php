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
        background: #f8fafc;
    }

    .history-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* Breadcrumb */
    .breadcrumb-modern {
        background: transparent;
        padding: 0;
        margin-bottom: 30px;
    }

    .breadcrumb-modern .breadcrumb-item a {
        color: #64748b;
        text-decoration: none;
        font-size: 0.85rem;
        transition: color 0.2s;
    }

    .breadcrumb-modern .breadcrumb-item a:hover {
        color: #c4603a;
    }

    .breadcrumb-modern .breadcrumb-item.active {
        color: #1e293b;
        font-weight: 500;
    }

    /* Header */
    .page-header {
        margin-bottom: 30px;
    }

    .page-header h3 {
        font-size: 1.8rem;
        font-weight: 800;
        color: #0f172a;
        position: relative;
        display: inline-block;
        margin-bottom: 10px;
    }

    .page-header h3:after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(135deg, #c4603a, #b5532c);
        border-radius: 2px;
    }

    .page-header p {
        color: #64748b;
        margin-top: 15px;
        font-size: 0.9rem;
    }

    /* Stats Summary */
    .stats-summary {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }

    .stat-summary-card {
        background: white;
        border-radius: 16px;
        padding: 15px 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        flex: 1;
        min-width: 150px;
    }

    .stat-summary-card .stat-label {
        font-size: 0.75rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .stat-summary-card .stat-number {
        font-size: 1.5rem;
        font-weight: 800;
        color: #c4603a;
    }

    /* Table */
    .table-wrapper {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #1a2a1c, #2c3e2f);
        color: white;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 15px;
        border: none;
    }

    .table tbody tr {
        transition: all 0.2s;
        border-bottom: 1px solid #e2e8f0;
    }

    .table tbody tr:hover {
        background: #f8fafc;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        color: #334155;
        font-size: 0.9rem;
    }

    /* Badge Status */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-pending {
        background: #fef3c7;
        color: #d97706;
    }

    .badge-paid {
        background: #d1fae5;
        color: #059669;
    }

    .badge-confirmed {
        background: #c4603a10;
        color: #c4603a;
    }

    .badge-cancelled {
        background: #fee2e2;
        color: #dc2626;
    }

    .badge-default {
        background: #f1f5f9;
        color: #64748b;
    }

    /* Button */
    .btn-detail {
        background: transparent;
        border: 1px solid #c4603a;
        color: #c4603a;
        padding: 6px 15px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-detail:hover {
        background: #c4603a;
        color: white;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }

    .empty-state h4 {
        font-size: 1.3rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #64748b;
        margin-bottom: 20px;
    }

    .empty-state .btn-primary-custom {
        background: linear-gradient(135deg, #c4603a, #b5532c);
        color: white;
        padding: 10px 25px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .empty-state .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(196, 96, 58, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .history-container {
            padding: 20px;
        }

        .page-header h3 {
            font-size: 1.4rem;
        }

        .stats-summary {
            flex-direction: column;
        }

        .stat-summary-card {
            text-align: center;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .table {
            min-width: 600px;
        }

        .btn-detail {
            padding: 5px 12px;
            font-size: 0.75rem;
        }
    }
</style>

<div class="history-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-modern">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active">Riwayat Booking</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h3><i class="fas fa-history me-2" style="color: #c4603a;"></i> Riwayat Booking Saya</h3>
        <p>Lihat dan kelola semua pemesanan trip yang telah Anda lakukan</p>
    </div>

    <?php if (empty($bookings)): ?>
        <!-- Empty State -->
        <div class="empty-state">
            <i class="fas fa-calendar-alt"></i>
            <h4>Belum Ada Booking</h4>
            <p>Anda belum melakukan pemesanan trip apapun. Yuk, mulai petualanganmu sekarang!</p>
            <a href="<?= base_url('trips') ?>" class="btn-primary-custom">
                <i class="fas fa-mountain"></i> Lihat Trip Tersedia
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
            <div class="stat-summary-card">
                <div class="stat-label">Total Booking</div>
                <div class="stat-number"><?= $totalBooking ?></div>
            </div>
            <div class="stat-summary-card">
                <div class="stat-label">Total Pengeluaran</div>
                <div class="stat-number">Rp <?= number_format($totalSpent, 0, ',', '.') ?></div>
            </div>
            <div class="stat-summary-card">
                <div class="stat-label">Menunggu Konfirmasi</div>
                <div class="stat-number"><?= $pendingCount ?></div>
            </div>
            <div class="stat-summary-card">
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
                            <th class="text-center">Kode Booking</th>
                            <th>Trip</th>
                            <th class="text-center">Tanggal Keberangkatan</th>
                            <th class="text-center">Jumlah Peserta</th>
                            <th class="text-center">Total Harga</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $b): ?>
                            <tr>
                                <td class="text-center">
                                    <span class="fw-bold" style="color: #c4603a;"><?= esc($b['booking_code'] ?? $b['booking_id']) ?></span>
                                </td>
                                <td>
                                    <strong><?= esc($b['trip_title'] ?? '-') ?></strong>
                                </td>
                                <td class="text-center">
                                    <?= !empty($b['departure_date'])
                                        ? '<i class="far fa-calendar-alt me-1 text-muted"></i> ' . date('d M Y', strtotime($b['departure_date']))
                                        : '-' ?>
                                </td>
                                <td class="text-center">
                                    <i class="fas fa-user-friends me-1 text-muted"></i> <?= esc($b['participant'] ?? 0) ?>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bold" style="color: #c4603a;">
                                        Rp <?= number_format($b['total_price'] ?? 0, 0, ',', '.') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php
                                    switch ($b['status'] ?? '') {
                                        case 'pending':
                                            $badge = 'badge-pending';
                                            $icon = 'fas fa-clock';
                                            $text = 'Pending';
                                            break;
                                        case 'paid':
                                            $badge = 'badge-paid';
                                            $icon = 'fas fa-check-circle';
                                            $text = 'Paid';
                                            break;
                                        case 'confirmed':
                                            $badge = 'badge-confirmed';
                                            $icon = 'fas fa-check-double';
                                            $text = 'Confirmed';
                                            break;
                                        case 'cancelled':
                                            $badge = 'badge-cancelled';
                                            $icon = 'fas fa-times-circle';
                                            $text = 'Cancelled';
                                            break;
                                        default:
                                            $badge = 'badge-default';
                                            $icon = 'fas fa-question-circle';
                                            $text = esc($b['status'] ?? 'Unknown');
                                    }
                                    ?>
                                    <span class="badge-status <?= $badge ?>">
                                        <i class="<?= $icon ?>"></i> <?= $text ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('booking/detail/' . $b['booking_id']) ?>"
                                        class="btn-detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Info Note -->
        <div class="text-center mt-4">
            <small class="text-muted">
                <i class="fas fa-info-circle me-1"></i>
                Untuk informasi lebih lanjut tentang booking, klik tombol Detail
            </small>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>