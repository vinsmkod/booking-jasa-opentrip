<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
<style>
.metrics {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 22px;
}
.content-grid {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 14px;
}
.bars { display:flex; flex-direction:column; gap:14px; }
.bar-meta { display:flex; justify-content:space-between; align-items:center; margin-bottom:6px; }
.bar-name  { font-size:12px; color:var(--txt2); }
.bar-count { font-size:11px; font-family:var(--mono); color:var(--txt3); background:var(--bg); padding:1px 7px; border-radius:4px; }
.bar-track { height:5px; background:var(--bg); border-radius:3px; overflow:hidden; }
.bar-fill  { height:100%; border-radius:3px; background:var(--accent); }

@media(max-width:1280px) {
    .metrics { grid-template-columns: repeat(2, 1fr); }
    .content-grid { grid-template-columns: 1fr; }
}
@media(max-width:768px) {
    .metrics { grid-template-columns: 1fr 1fr; }
}

.featured-trip {
    background: linear-gradient(135deg, var(--accent) 0%, #2563eb 100%);
    border-radius: 14px;
    padding: 28px;
    color: white;
    margin-bottom: 22px;
    box-shadow: 0 10px 25px rgba(79, 70, 229, 0.2);
    position: relative;
    overflow: hidden;
}

.featured-trip::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
}

.featured-trip::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 250px;
    height: 250px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}

.featured-trip-content {
    position: relative;
    z-index: 2;
}

.featured-trip-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.9;
    margin-bottom: 8px;
}

.featured-trip-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.featured-trip-title i {
    font-size: 32px;
}

.featured-trip-stats {
    display: flex;
    gap: 32px;
    margin-top: 20px;
}

.featured-trip-stat {
    flex: 1;
}

.featured-trip-stat-value {
    font-size: 24px;
    font-weight: 700;
    display: block;
    margin-bottom: 4px;
}

.featured-trip-stat-label {
    font-size: 12px;
    opacity: 0.9;
}

@media(max-width:1280px) {
    .featured-trip-title { font-size: 24px; }
    .featured-trip-stats { gap: 20px; }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1>Dashboard</h1>
        <p>Selamat datang kembali, <strong><?= esc(session()->get('name')) ?></strong>!</p>
    </div>
</div>

<div class="metrics">
    <div class="metric">
        <div class="metric-icon-wrap" style="background:#eef2ff;">
            <i class="fas fa-map-marked-alt" style="color:#4f46e5;"></i>
        </div>
        <div class="metric-body">
            <div class="metric-label">Total Trip</div>
            <div class="metric-value"><?= $totalTrips ?? 0 ?></div>
            <div class="metric-sub">Aktif di sistem</div>
        </div>
    </div>
    <div class="metric">
        <div class="metric-icon-wrap" style="background:#f0fdf4;">
            <i class="fas fa-calendar-check" style="color:#16a34a;"></i>
        </div>
        <div class="metric-body">
            <div class="metric-label">Total Booking</div>
            <div class="metric-value"><?= $totalBookings ?? 0 ?></div>
            <div class="metric-sub">Semua status</div>
        </div>
    </div>
    <div class="metric">
        <div class="metric-icon-wrap" style="background:#fffbeb;">
            <i class="fas fa-users" style="color:#b45309;"></i>
        </div>
        <div class="metric-body">
            <div class="metric-label">Total User</div>
            <div class="metric-value"><?= $totalUsers ?? 0 ?></div>
            <div class="metric-sub">Terdaftar</div>
        </div>
    </div>
    <div class="metric">
        <div class="metric-icon-wrap" style="background:#fef2f2;">
            <i class="fas fa-wallet" style="color:#dc2626;"></i>
        </div>
        <div class="metric-body">
            <div class="metric-label">Total Revenue</div>
            <div class="metric-value" style="font-size:16px;">
                Rp <?= number_format($totalRevenue ?? 0, 0, ',', '.') ?>
            </div>
            <div class="metric-sub">Semua waktu</div>
        </div>
    </div>
</div>

<!-- Featured Popular Trip -->
<?php if (!empty($popularTrips) && isset($popularTrips[0])): 
    $topTrip = $popularTrips[0];
?>
<div class="featured-trip">
    <div class="featured-trip-content">
        <div class="featured-trip-label">
            <i class="fas fa-crown"></i> Trip Paling Populer
        </div>
        <div class="featured-trip-title">
            <i class="fas fa-mountain"></i>
            <?= esc($topTrip['nama_trip']) ?>
        </div>
        <div class="featured-trip-stats">
            <div class="featured-trip-stat">
                <span class="featured-trip-stat-value"><?= $topTrip['total_booking'] ?></span>
                <span class="featured-trip-stat-label">Total Booking</span>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="content-grid">
    <div class="panel">
        <div class="panel-header">
            <span class="panel-title"><i class="fas fa-list-ul"></i> Booking Terbaru</span>
            <a href="/admin/bookings" class="panel-action">Lihat semua →</a>
        </div>
        <div class="panel-body">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Trip</th>
                        <th>Status</th>
                        <th style="text-align:right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recentBookings)): foreach ($recentBookings as $b):
                        $pill = match($b['status'] ?? '') {
                            'lunas'   => 'pill-success',
                            'pending' => 'pill-warning',
                            'batal'   => 'pill-danger',
                            default   => 'pill-info'
                        };
                    ?>
                    <tr>
                        <td class="td-mono">#BK-<?= str_pad($b['id'], 3, '0', STR_PAD_LEFT) ?></td>
                        <td><?= esc($b['nama']) ?></td>
                        <td class="td-muted"><?= esc($b['nama_trip']) ?></td>
                        <td><span class="pill <?= $pill ?>"><?= ucfirst($b['status']) ?></span></td>
                        <td class="td-right">Rp <?= number_format($b['total_price'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="5">
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>Belum ada data booking.</p>
                        </div>
                    </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <span class="panel-title"><i class="fas fa-fire"></i> Trip Terpopuler</span>
        </div>
        <div class="panel-body">
            <div class="bars">
                <?php if (!empty($popularTrips)):
                    $max = max(array_column($popularTrips, 'total_booking'));
                    foreach ($popularTrips as $t):
                        $pct = $max > 0 ? round($t['total_booking'] / $max * 100) : 0;
                ?>
                <div>
                    <div class="bar-meta">
                        <span class="bar-name"><?= esc($t['nama_trip']) ?></span>
                        <span class="bar-count"><?= $t['total_booking'] ?> booking</span>
                    </div>
                    <div class="bar-track">
                        <div class="bar-fill" style="width:<?= $pct ?>%;"></div>
                    </div>
                </div>
                <?php endforeach; else: ?>
                <div class="empty-state">
                    <i class="fas fa-chart-bar"></i>
                    <p>Belum ada data.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>