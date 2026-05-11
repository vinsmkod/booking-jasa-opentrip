<?= $this->extend('layouts/admin') ?>

<?= $this->section('breadcrumb') ?><span class="crumb-active">Kelola Laporan</span><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* ─── REPORT HEADER ─── */
    .report-hero {
        background: linear-gradient(135deg, #166534 0%, #15803d 60%, #16a34a 100%);
        border-radius: 14px;
        padding: 28px 32px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
        position: relative;
        overflow: hidden;
    }

    .report-hero::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
    }

    .report-hero::after {
        content: '';
        position: absolute;
        bottom: -60px;
        right: 80px;
        width: 160px;
        height: 160px;
        background: rgba(255, 255, 255, 0.04);
        border-radius: 50%;
    }

    .report-hero-left h1 {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        margin: 0 0 4px;
    }

    .report-hero-left p {
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.75);
        margin: 0;
    }

    .report-hero-right {
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
        z-index: 1;
    }

    /* ─── FILTER CARD ─── */
    .filter-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-end;
        gap: 14px;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
        min-width: 200px;
    }

    .filter-group label {
        font-size: 12px;
        font-weight: 600;
        color: var(--txt2);
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .filter-select,
    .filter-input {
        padding: 9px 12px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 13.5px;
        color: var(--txt);
        background: var(--bg);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
    }

    .filter-select:focus,
    .filter-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(22, 101, 52, 0.1);
    }

    .filter-actions {
        display: flex;
        gap: 8px;
        align-items: flex-end;
        padding-bottom: 0;
    }

    .btn-filter {
        padding: 9px 20px;
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: opacity 0.2s;
        white-space: nowrap;
    }

    .btn-filter:hover {
        opacity: 0.88;
    }

    .btn-reset {
        padding: 9px 14px;
        background: var(--surface2);
        color: var(--txt2);
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 13px;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: background 0.15s;
        white-space: nowrap;
    }

    .btn-reset:hover {
        background: #f1f5f9;
    }

    /* ─── EXPORT BTN ─── */
    .btn-export {
        padding: 9px 18px;
        background: #166534;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        transition: background 0.2s;
        white-space: nowrap;
    }

    .btn-export:hover {
        background: #14532d;
        color: #fff;
    }

    .btn-export-outline {
        padding: 9px 18px;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        border: 1.5px solid rgba(255, 255, 255, 0.4);
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        backdrop-filter: blur(4px);
        transition: background 0.2s;
        white-space: nowrap;
    }

    .btn-export-outline:hover {
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
    }

    /* ─── STAT CHIPS ─── */
    .stat-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .stat-chip {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        min-width: 160px;
    }

    .stat-chip-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .stat-chip-icon.green {
        background: #dcfce7;
        color: #166534;
    }

    .stat-chip-icon.blue {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .stat-chip-icon.amber {
        background: #fef3c7;
        color: #92400e;
    }

    .stat-chip-icon.red {
        background: #fee2e2;
        color: #b91c1c;
    }

    .stat-chip-label {
        font-size: 11px;
        color: var(--txt3);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .stat-chip-val {
        font-size: 20px;
        font-weight: 700;
        color: var(--txt);
        line-height: 1.1;
        font-family: var(--mono);
    }

    /* ─── TABLE ─── */
    .panel-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--txt2);
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 14px 20px 12px;
        border-bottom: 1px solid var(--border);
    }

    .panel-label i {
        color: var(--accent);
    }

    .tbl-report th {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: var(--txt3);
        background: var(--surface2);
        padding: 10px 14px;
        white-space: nowrap;
    }

    .tbl-report td {
        padding: 11px 14px;
        font-size: 13px;
        color: var(--txt);
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        vertical-align: middle;
    }

    .tbl-report tbody tr:hover {
        background: rgba(22, 101, 52, 0.03);
    }

    .tbl-report tbody tr:last-child td {
        border-bottom: none;
    }

    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 9px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
    }

    .badge-confirmed {
        background: #dcfce7;
        color: #166534;
    }

    .badge-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-cancelled {
        background: #fee2e2;
        color: #b91c1c;
    }

    .badge-verified {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-rejected {
        background: #fce7f3;
        color: #9d174d;
    }

    .badge-gray {
        background: var(--surface2);
        color: var(--txt3);
    }

    .no-filter-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        gap: 12px;
        color: var(--txt3);
    }

    .no-filter-state i {
        font-size: 40px;
        opacity: 0.35;
    }

    .no-filter-state p {
        font-size: 14px;
        margin: 0;
    }

    /* Print */
    @media print {

        .sidebar,
        .topbar,
        .filter-card,
        .report-hero,
        .stat-row,
        .btn-export,
        .btn-export-outline,
        .btn-filter,
        .btn-reset,
        .no-print {
            display: none !important;
        }

        .main-wrapper {
            margin: 0 !important;
        }

        .main-content {
            padding: 0 !important;
        }

        .panel {
            box-shadow: none;
            border: 1px solid #e5e7eb;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- HERO -->
<div class="report-hero">
    <div class="report-hero-left">
        <h1><i class="fas fa-chart-bar" style="margin-right:10px;opacity:0.9;"></i>Kelola Laporan</h1>
        <p>Filter data booking berdasarkan trip, lalu unduh atau cetak laporan</p>
    </div>
    <div class="report-hero-right no-print">
        <?php
        $exportUrl = base_url('admin/reports/export');
        $params    = [];
        if (!empty($selectedTrip)) $params[] = 'trip_id=' . (int)$selectedTrip;
        if (!empty($params)) $exportUrl .= '?' . implode('&', $params);
        ?>
        <a href="<?= $exportUrl ?>" class="btn-export-outline" id="btnExportHero">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
    </div>
</div>

<!-- FLASH MESSAGES -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
<?php endif; ?>

<!-- FILTER CARD -->
<div class="filter-card no-print">
    <form action="<?= base_url('admin/reports') ?>" method="get" style="display:contents;" id="filterForm">
        <div class="filter-group">
            <label><i class="fas fa-map-marked-alt" style="margin-right:4px;"></i> Pilih Trip</label>
            <select name="trip_id" class="filter-select" id="tripSelect">
                <option value="">— Semua Trip —</option>
                <?php foreach ($trips as $trip): ?>
                    <option value="<?= $trip['trip_id'] ?>"
                        <?= ((string)($selectedTrip ?? '') === (string)$trip['trip_id']) ? 'selected' : '' ?>>
                        <?= esc($trip['title']) ?> (<?= esc($trip['location']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn-filter">
                <i class="fas fa-filter"></i> Terapkan Filter
            </button>
            <?php if (!empty($selectedTrip)): ?>
                <a href="<?= base_url('admin/reports') ?>" class="btn-reset">
                    <i class="fas fa-times"></i> Reset
                </a>
            <?php endif; ?>
            <?php if (!empty($bookings)): ?>
                <a href="<?= $exportUrl ?>" class="btn-export" id="btnExportFilter">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
                <button type="button" class="btn-reset" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak
                </button>
            <?php endif; ?>
        </div>
    </form>
</div>

<?php if (!empty($bookings)): ?>

    <!-- STAT CHIPS -->
    <?php
    $totalPeserta   = array_sum(array_column($bookings, 'participant'));
    $confirmed      = count(array_filter($bookings, fn($b) => $b['status'] === 'confirmed'));
    $pending        = count(array_filter($bookings, fn($b) => $b['status'] === 'pending'));
    $cancelled      = count(array_filter($bookings, fn($b) => $b['status'] === 'cancelled'));
    $totalRevenue   = array_sum(array_column(
        array_filter($bookings, fn($b) => ($b['payment_status'] ?? '') === 'verified'),
        'total_price'
    ));
    ?>
    <div class="stat-row no-print">
        <div class="stat-chip">
            <div class="stat-chip-icon green"><i class="fas fa-ticket-alt"></i></div>
            <div>
                <div class="stat-chip-label">Total Booking</div>
                <div class="stat-chip-val"><?= count($bookings) ?></div>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon blue"><i class="fas fa-users"></i></div>
            <div>
                <div class="stat-chip-label">Total Peserta</div>
                <div class="stat-chip-val"><?= $totalPeserta ?></div>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon green"><i class="fas fa-check-circle"></i></div>
            <div>
                <div class="stat-chip-label">Confirmed</div>
                <div class="stat-chip-val"><?= $confirmed ?></div>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon amber"><i class="fas fa-clock"></i></div>
            <div>
                <div class="stat-chip-label">Pending</div>
                <div class="stat-chip-val"><?= $pending ?></div>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon red"><i class="fas fa-ban"></i></div>
            <div>
                <div class="stat-chip-label">Dibatalkan</div>
                <div class="stat-chip-val"><?= $cancelled ?></div>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="panel">
        <div class="panel-label">
            <i class="fas fa-table"></i>
            Data Booking<?= !empty($selectedTrip) ? ' — ' . esc($trips[array_search($selectedTrip, array_column($trips, 'trip_id'))]['title'] ?? '') : ' (Semua Trip)' ?>
            <span style="margin-left:auto;font-size:11px;color:var(--txt3);font-weight:400;"><?= count($bookings) ?> entri</span>
        </div>
        <div class="table-wrap">
            <table class="tbl tbl-report">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Booking</th>
                        <th>Nama Pemesan</th>
                        <th>Nama Trip</th>
                        <th>Tanggal Berangkat</th>
                        <th>Peserta</th>
                        <th>Total Harga</th>
                        <th>Meeting Point</th>
                        <th>Status Booking</th>
                        <th>Status Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $i => $b): ?>
                        <tr>
                            <td style="color:var(--txt3);font-size:12px;"><?= $i + 1 ?></td>
                            <td>
                                <span style="font-family:var(--mono);font-size:12px;font-weight:600;color:var(--accent);">
                                    <?= esc($b['booking_code'] ?? '-') ?>
                                </span>
                            </td>
                            <td>
                                <div style="font-weight:600;font-size:13px;"><?= esc($b['username'] ?? '-') ?></div>
                                <div style="font-size:11px;color:var(--txt3);"><?= esc($b['user_email'] ?? '') ?></div>
                            </td>
                            <td>
                                <div style="font-weight:500;"><?= esc($b['trip_title'] ?? '-') ?></div>
                                <div style="font-size:11px;color:var(--txt3);"><?= esc($b['trip_location'] ?? '') ?></div>
                            </td>
                            <td style="white-space:nowrap;">
                                <?= !empty($b['departure_date']) ? date('d M Y', strtotime($b['departure_date'])) : '-' ?>
                            </td>
                            <td style="text-align:center;font-weight:600;">
                                <?= (int)($b['participant'] ?? 0) ?>
                            </td>
                            <td style="font-weight:600;font-family:var(--mono);font-size:12.5px;">
                                Rp <?= number_format($b['total_price'] ?? 0, 0, ',', '.') ?>
                            </td>
                            <td style="font-size:12px;">
                                <?= esc($b['meeting_point'] ?? '-') ?>
                            </td>
                            <td>
                                <?php $s = $b['status'] ?? ''; ?>
                                <?php if ($s === 'confirmed'): ?>
                                    <span class="badge-status badge-confirmed"><i class="fas fa-check-circle"></i> Confirmed</span>
                                <?php elseif ($s === 'pending'): ?>
                                    <span class="badge-status badge-pending"><i class="fas fa-clock"></i> Pending</span>
                                <?php elseif ($s === 'cancelled'): ?>
                                    <span class="badge-status badge-cancelled"><i class="fas fa-ban"></i> Cancelled</span>
                                <?php else: ?>
                                    <span class="badge-status badge-gray">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php $ps = $b['payment_status'] ?? ''; ?>
                                <?php if ($ps === 'verified'): ?>
                                    <span class="badge-status badge-verified"><i class="fas fa-check"></i> Lunas</span>
                                <?php elseif ($ps === 'pending'): ?>
                                    <span class="badge-status badge-pending"><i class="fas fa-clock"></i> Menunggu</span>
                                <?php elseif ($ps === 'rejected'): ?>
                                    <span class="badge-status badge-rejected"><i class="fas fa-times"></i> Ditolak</span>
                                <?php else: ?>
                                    <span class="badge-status badge-gray">Belum Ada</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr style="background:var(--surface2);">
                        <td colspan="5" style="font-weight:700;font-size:12.5px;padding:10px 14px;color:var(--txt2);">TOTAL</td>
                        <td style="font-weight:700;text-align:center;font-family:var(--mono);"><?= $totalPeserta ?></td>
                        <td style="font-weight:700;font-family:var(--mono);font-size:12.5px;">
                            Rp <?= number_format(array_sum(array_column($bookings, 'total_price')), 0, ',', '.') ?>
                        </td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

<?php elseif (!empty($selectedTrip)): ?>
    <!-- Filter applied but no results -->
    <div class="panel">
        <div class="no-filter-state">
            <i class="fas fa-search"></i>
            <p>Tidak ada data booking untuk trip yang dipilih.</p>
        </div>
    </div>
<?php else: ?>
    <!-- No filter applied -->
    <div class="panel">
        <div class="no-filter-state">
            <i class="fas fa-filter"></i>
            <p>Pilih trip di atas untuk menampilkan data laporan, atau klik <strong>Terapkan Filter</strong> untuk melihat semua data.</p>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Update export URL secara real-time saat trip dipilih
    document.getElementById('tripSelect')?.addEventListener('change', function() {
        const val = this.value;
        const base = '<?= base_url('admin/reports/export') ?>';
        const url = val ? base + '?trip_id=' + val : base;

        const heroBtn = document.getElementById('btnExportHero');
        const filterBtn = document.getElementById('btnExportFilter');

        if (heroBtn) heroBtn.href = url;
        if (filterBtn) filterBtn.href = url;
    });
</script>
<?= $this->endSection() ?>