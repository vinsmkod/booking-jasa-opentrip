<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/booking/history.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>



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