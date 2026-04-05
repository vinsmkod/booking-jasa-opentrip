<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --bg:          #f4f6f9;
    --surface:     #ffffff;
    --surface2:    #f8f9fa;
    --border:      rgba(0,0,0,.08);
    --border2:     rgba(0,0,0,.15);
    --txt:         #212529;
    --txt2:        #6c757d;
    --txt3:        #adb5bd;

    /* Sidebar */
    --sb-bg:       #1a1a2e;
    --sb-bg2:      #16213e;
    --sb-accent:   #e94560;
    --sb-txt:      rgba(255,255,255,.75);
    --sb-txt-mute: rgba(255,255,255,.40);
    --sb-hover-bg: rgba(255,255,255,.07);
    --sb-active-bg:rgba(233,69,96,.15);
    --sb-w:        260px;

    /* Topbar */
    --top-h:       56px;

    --accent:      #1a1a2e;
    --radius:      8px;
    --font:        'IBM Plex Sans', sans-serif;
    --mono:        'IBM Plex Mono', monospace;
}

body {
    background: var(--bg);
    color: var(--txt);
    font-family: var(--font);
    font-size: 14px;
}

/* ── LAYOUT ──────────────────────────────────── */
.layout {
    display: flex;
    min-height: 100vh;
}

/* ── SIDEBAR ─────────────────────────────────── */
.sidebar {
    width: var(--sb-w);
    background: var(--sb-bg);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0;
    height: 100vh;
    overflow-y: auto;
    overflow-x: hidden;
    z-index: 100;
    flex-shrink: 0;
    transition: width .25s ease;
}
.sidebar::-webkit-scrollbar { width: 4px; }
.sidebar::-webkit-scrollbar-track { background: transparent; }
.sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }

/* Brand / Logo */
.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 18px;
    height: var(--top-h);
    background: var(--sb-bg2);
    border-bottom: 1px solid rgba(255,255,255,.06);
    text-decoration: none;
    flex-shrink: 0;
}
.sidebar-brand:hover { text-decoration: none; }
.brand-icon {
    width: 34px; height: 34px;
    background: var(--sb-accent);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(233,69,96,.4);
}
.brand-icon i { color: #fff; font-size: 15px; }
.brand-text { display: flex; flex-direction: column; }
.brand-title { font-size: 14px; font-weight: 600; color: #fff; letter-spacing: .03em; line-height: 1.2; }
.brand-sub   { font-size: 10px; color: var(--sb-txt-mute); letter-spacing: .1em; text-transform: uppercase; }

/* User panel */
.sidebar-user {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 18px;
    background: rgba(0,0,0,.15);
    border-bottom: 1px solid rgba(255,255,255,.06);
}
.user-avatar {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: var(--sb-accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600; color: #fff;
    flex-shrink: 0;
    border: 2px solid rgba(255,255,255,.15);
}
.user-info { flex: 1; min-width: 0; }
.user-name   { font-size: 12.5px; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.user-role   { font-size: 10.5px; color: var(--sb-txt-mute); }
.user-status { display: flex; align-items: center; gap: 4px; margin-top: 2px; }
.status-dot  { width: 6px; height: 6px; border-radius: 50%; background: #22c55e; }
.status-txt  { font-size: 10px; color: #22c55e; }

/* Nav */
.sidebar-nav { flex: 1; padding: 10px 0; }

.nav-section-label {
    font-size: 10px;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--sb-txt-mute);
    font-weight: 600;
    padding: 14px 18px 6px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.nav-section-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: rgba(255,255,255,.06);
}

.nav-item { position: relative; }

.nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 9px 18px;
    color: var(--sb-txt);
    text-decoration: none;
    font-size: 13px;
    font-weight: 400;
    border-radius: 0;
    transition: all .15s ease;
    position: relative;
    border-left: 3px solid transparent;
    margin: 1px 0;
}
.nav-link:hover {
    background: var(--sb-hover-bg);
    color: #fff;
    text-decoration: none;
}
.nav-link.active {
    background: var(--sb-active-bg);
    color: #fff;
    font-weight: 500;
    border-left-color: var(--sb-accent);
}
.nav-link .nav-icon {
    width: 20px;
    text-align: center;
    font-size: 14px;
    flex-shrink: 0;
    opacity: .8;
}
.nav-link.active .nav-icon { opacity: 1; color: var(--sb-accent); }
.nav-link:hover .nav-icon { opacity: 1; }

.nav-link .nav-label { flex: 1; }

.nav-badge {
    font-size: 10px;
    font-family: var(--mono);
    background: var(--sb-accent);
    color: #fff;
    padding: 1px 7px;
    border-radius: 10px;
    font-weight: 600;
    line-height: 1.6;
}

.nav-badge-warn {
    background: #f59e0b;
}

/* Sidebar footer */
.sidebar-footer {
    border-top: 1px solid rgba(255,255,255,.08);
    padding: 8px 0;
}

/* ── TOPBAR ──────────────────────────────────── */
.topbar {
    position: fixed;
    top: 0;
    left: var(--sb-w);
    right: 0;
    height: var(--top-h);
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    padding: 0 24px;
    gap: 16px;
    z-index: 50;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
}

.topbar-toggle {
    width: 32px; height: 32px;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: transparent;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--txt2);
    transition: all .15s;
}
.topbar-toggle:hover { background: var(--bg); color: var(--txt); }
.topbar-toggle i { font-size: 13px; }

.topbar-breadcrumb {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12.5px;
    color: var(--txt3);
    font-family: var(--mono);
}
.topbar-breadcrumb .crumb-active { color: var(--txt); }
.topbar-breadcrumb i { font-size: 9px; }

.topbar-right {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 8px;
}

.topbar-btn {
    width: 34px; height: 34px;
    border: 1px solid var(--border);
    border-radius: 6px;
    background: transparent;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--txt2);
    position: relative;
    transition: all .15s;
    text-decoration: none;
}
.topbar-btn:hover { background: var(--bg); color: var(--txt); text-decoration: none; }
.topbar-btn i { font-size: 13px; }
.topbar-notif-dot {
    position: absolute;
    top: 6px; right: 6px;
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--sb-accent);
    border: 1px solid #fff;
}

.topbar-divider {
    width: 1px; height: 20px;
    background: var(--border);
}

.date-chip {
    font-size: 11.5px;
    font-family: var(--mono);
    color: var(--txt3);
    background: var(--bg);
    border: 1px solid var(--border);
    padding: 5px 12px;
    border-radius: 5px;
}

.topbar-user {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 4px 10px 4px 4px;
    border: 1px solid var(--border);
    border-radius: 20px;
    cursor: pointer;
    transition: all .15s;
}
.topbar-user:hover { background: var(--bg); }
.topbar-avatar {
    width: 26px; height: 26px;
    border-radius: 50%;
    background: var(--accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 600; color: #fff;
}
.topbar-username { font-size: 12px; font-weight: 500; color: var(--txt); }

/* ── MAIN ────────────────────────────────────── */
.main-wrapper {
    margin-left: var(--sb-w);
    margin-top: var(--top-h);
    flex: 1;
    min-width: 0;
}
.main-content {
    padding: 24px;
}

/* ── PAGE HEADER ─────────────────────────────── */
.page-header {
    margin-bottom: 22px;
}
.page-header h1 {
    font-size: 20px;
    font-weight: 600;
    color: var(--txt);
    margin-bottom: 4px;
}
.page-header p {
    font-size: 13px;
    color: var(--txt2);
}

/* ── METRICS ─────────────────────────────────── */
.metrics { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 22px; }
.metric {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: box-shadow .15s;
}
.metric:hover { box-shadow: 0 4px 16px rgba(0,0,0,.07); }
.metric-icon-wrap {
    width: 48px; height: 48px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    font-size: 20px;
}
.metric-body { flex: 1; min-width: 0; }
.metric-label { font-size: 11px; font-weight: 500; letter-spacing: .07em; text-transform: uppercase; color: var(--txt3); margin-bottom: 4px; }
.metric-value { font-size: 22px; font-weight: 600; color: var(--txt); font-family: var(--mono); letter-spacing: -.02em; line-height: 1; }
.metric-value-sm { font-size: 16px; }
.metric-sub { font-size: 11px; color: var(--txt3); margin-top: 5px; }

/* ── CONTENT GRID ────────────────────────────── */
.content-grid { display: grid; grid-template-columns: 1fr 300px; gap: 14px; margin-bottom: 22px; }

/* ── PANEL ───────────────────────────────────── */
.panel { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }
.panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 18px;
    border-bottom: 1px solid var(--border);
    background: var(--surface2);
}
.panel-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--txt);
    display: flex;
    align-items: center;
    gap: 8px;
}
.panel-title i { color: var(--txt3); font-size: 12px; }
.panel-action {
    font-size: 11.5px;
    color: var(--txt3);
    text-decoration: none;
    border: 1px solid var(--border);
    padding: 4px 12px;
    border-radius: 5px;
    transition: all .12s;
}
.panel-action:hover { color: var(--txt2); border-color: var(--border2); background: var(--bg); text-decoration: none; }
.panel-body { padding: 18px; }

/* ── TABLE ───────────────────────────────────── */
.tbl { width: 100%; border-collapse: collapse; }
.tbl th {
    font-size: 10.5px; letter-spacing: .07em; text-transform: uppercase;
    color: var(--txt3); font-weight: 600;
    padding: 0 8px 10px; text-align: left;
}
.tbl th:first-child { padding-left: 0; }
.tbl td {
    font-size: 13px; color: var(--txt);
    padding: 9px 8px;
    border-top: 1px solid rgba(0,0,0,.055);
    vertical-align: middle;
}
.tbl td:first-child { padding-left: 0; }
.tbl tr:hover td { background: var(--bg); }
.td-mono  { font-family: var(--mono); font-size: 11px; color: var(--txt3); }
.td-muted { color: var(--txt2); font-size: 12.5px; max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.td-right { text-align: right; font-family: var(--mono); font-size: 12px; color: var(--txt2); }

.pill { display: inline-block; font-size: 10.5px; padding: 2px 9px; border-radius: 4px; font-weight: 500; }
.pill-success { background: #dcfce7; color: #15803d; }
.pill-warning { background: #fef9c3; color: #a16207; }
.pill-danger  { background: #fee2e2; color: #b91c1c; }
.pill-info    { background: #dbeafe; color: #1d4ed8; }

/* ── BAR CHART ───────────────────────────────── */
.bars { display: flex; flex-direction: column; gap: 14px; }
.bar-meta  { display: flex; justify-content: space-between; margin-bottom: 6px; align-items: center; }
.bar-name  { font-size: 12px; color: var(--txt2); }
.bar-count { font-size: 11px; font-family: var(--mono); color: var(--txt3); background: var(--bg); padding: 1px 7px; border-radius: 4px; }
.bar-track { height: 5px; background: var(--bg); border-radius: 3px; overflow: hidden; }
.bar-fill  { height: 100%; border-radius: 3px; background: linear-gradient(90deg, #1a1a2e, #e94560); }

/* ── RESPONSIVE ──────────────────────────────── */
@media (max-width: 1280px) {
    .metrics      { grid-template-columns: repeat(2, 1fr); }
    .content-grid { grid-template-columns: 1fr; }
}
@media (max-width: 1024px) { .actions-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 768px) {
    .sidebar       { transform: translateX(-100%); }
    .sidebar.open  { transform: translateX(0); }
    .topbar        { left: 0; }
    .main-wrapper  { margin-left: 0; }
    .metrics       { grid-template-columns: 1fr 1fr; }
    .actions-grid  { grid-template-columns: repeat(2, 1fr); }
}
</style>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<?php
    // ── Ambil data user dari session ──────────────────
    $sessionUsername = session()->get('name') ?? 'Admin';
    $sessionRole     = session()->get('role') ?? 'Administrator';
    // Buat inisial 2 huruf dari username (misal: "john doe" → "JO")
    $initials = strtoupper(substr($sessionUsername, 0, 2));
?>

<div class="layout">

    <!-- ═══════════════════ SIDEBAR ═══════════════════ -->
    <aside class="sidebar" id="sidebar">

        <!-- Brand -->
        <a href="/admin" class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-globe"></i>
            </div>
            <div class="brand-text">
                <span class="brand-title">OpenTrip</span>
                <span class="brand-sub">Admin BLNTRK OUTDOOR</span>
            </div>
        </a>

        <!-- User Panel — DINAMIS dari session -->
        <div class="sidebar-user">
            <div class="user-avatar"><?= esc($initials) ?></div>
            <div class="user-info">
                <div class="user-name"><?= esc($sessionUsername) ?></div>
                <div class="user-status">
                    <div class="status-dot"></div>
                    <span class="status-txt">Online</span>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav">

            <!-- Overview -->
            <div class="nav-section-label">Overview</div>

            <div class="nav-item">
                <a href="/admin" class="nav-link active">
                    <i class="fas fa-th-large nav-icon"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </div>

            <!-- Manajemen -->
            <div class="nav-section-label">Manajemen</div>

            <div class="nav-item">
                <a href="/admin/trips" class="nav-link">
                    <i class="fas fa-map-marked-alt nav-icon"></i>
                    <span class="nav-label">Kelola Trip</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="/admin/bookings" class="nav-link">
                    <i class="fas fa-calendar-check nav-icon"></i>
                    <span class="nav-label">Booking</span>
                    <span class="nav-badge">3</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="/admin/users" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <span class="nav-label">Pengguna</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="/admin/comments" class="nav-link">
                    <i class="fas fa-comments nav-icon"></i>
                    <span class="nav-label">Komentar</span>
                </a>
            </div>

            <!-- Konten -->
            <div class="nav-section-label">Konten</div>

            <div class="nav-item">
                <a href="/admin/gallery" class="nav-link">
                    <i class="fas fa-images nav-icon"></i>
                    <span class="nav-label">Galeri</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="/admin/itinerary" class="nav-link">
                    <i class="fas fa-route nav-icon"></i>
                    <span class="nav-label">Itinerary</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="/admin/includes" class="nav-link">
                    <i class="fas fa-box-open nav-icon"></i>
                    <span class="nav-label">Paket Include</span>
                </a>
            </div>

        </nav>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <div class="nav-section-label">Lainnya</div>
            <div class="nav-item">
                <a href="<?= base_url('booking/exportExcel') ?>" class="nav-link">
                    <i class="fas fa-file-excel nav-icon"></i>
                    <span class="nav-label">Export Excel</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="/logout" class="nav-link">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <span class="nav-label">Logout</span>
                </a>
            </div>
        </div>

    </aside>

    <!-- ═══════════════════ TOPBAR ═══════════════════ -->
    <header class="topbar">
        <button class="topbar-toggle" onclick="toggleSidebar()" title="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>

        <div class="topbar-breadcrumb">
            admin
            <i class="fas fa-chevron-right"></i>
            <span class="crumb-active">dashboard</span>
        </div>

        <div class="topbar-right">
            <span class="date-chip">
                <i class="far fa-calendar-alt" style="margin-right:5px;opacity:.6;"></i>
                <?= date('d M Y') ?>
            </span>

            <div class="topbar-divider"></div>

            <a href="/admin/bookings" class="topbar-btn" title="Booking Baru">
                <i class="fas fa-bell"></i>
                <span class="topbar-notif-dot"></span>
            </a>

            <a href="<?= base_url('booking/exportExcel') ?>" class="topbar-btn" title="Export Excel">
                <i class="fas fa-download"></i>
            </a>

            <div class="topbar-divider"></div>

            <!-- Topbar User — DINAMIS dari session -->
            <div class="topbar-user">
                <div class="topbar-avatar"><?= esc($initials) ?></div>
                <span class="topbar-username"><?= esc($sessionUsername) ?></span>
                <i class="fas fa-chevron-down" style="font-size:9px;color:var(--txt3);"></i>
            </div>
        </div>
    </header>

    <!-- ═══════════════════ MAIN ═══════════════════ -->
    <div class="main-wrapper">
        <div class="main-content">

            <!-- Page Header -->
            <div class="page-header">
                <h1>Dashboard</h1>
                <p>Selamat datang kembali, <strong><?= esc($sessionUsername) ?></strong>! Berikut ringkasan data terkini.</p>
            </div>

            <!-- Metrics -->
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
                        <div class="metric-value metric-value-sm">Rp <?= number_format($totalRevenue ?? 0, 0, ',', '.') ?></div>
                        <div class="metric-sub">Semua waktu</div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Booking Terbaru -->
                <div class="panel">
                    <div class="panel-header">
                        <span class="panel-title">
                            <i class="fas fa-list-ul"></i> Booking Terbaru
                        </span>
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
                                <?php if (!empty($recentBookings)): ?>
                                    <?php foreach ($recentBookings as $b): ?>
                                    <tr>
                                        <td class="td-mono">#BK-<?= str_pad($b['id'], 3, '0', STR_PAD_LEFT) ?></td>
                                        <td><?= esc($b['nama']) ?></td>
                                        <td class="td-muted"><?= esc($b['nama_trip']) ?></td>
                                        <td>
                                            <?php $pillClass = match($b['status'] ?? '') { 'lunas' => 'pill-success', 'pending' => 'pill-warning', 'batal' => 'pill-danger', default => 'pill-info' }; ?>
                                            <span class="pill <?= $pillClass ?>"><?= ucfirst($b['status']) ?></span>
                                        </td>
                                        <td class="td-right">Rp <?= number_format($b['total_harga'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" style="color:#bbb;font-size:12px;padding:24px 0;text-align:center;">
                                        <i class="fas fa-inbox" style="display:block;font-size:24px;margin-bottom:8px;"></i>
                                        Belum ada data booking.
                                    </td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Trip Terpopuler -->
                <div class="panel">
                    <div class="panel-header">
                        <span class="panel-title">
                            <i class="fas fa-fire"></i> Trip Terpopuler
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="bars">
                            <?php if (!empty($popularTrips)): ?>
                                <?php $max = max(array_column($popularTrips, 'total_booking')); foreach ($popularTrips as $t): $pct = $max > 0 ? round($t['total_booking'] / $max * 100) : 0; ?>
                                <div>
                                    <div class="bar-meta">
                                        <span class="bar-name"><?= esc($t['nama_trip']) ?></span>
                                        <span class="bar-count"><?= $t['total_booking'] ?> booking</span>
                                    </div>
                                    <div class="bar-track"><div class="bar-fill" style="width:<?= $pct ?>%;"></div></div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p style="font-size:12px;color:#bbb;text-align:center;padding:20px 0;">
                                    <i class="fas fa-chart-bar" style="display:block;font-size:22px;margin-bottom:8px;"></i>
                                    Belum ada data.
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- /main-wrapper -->

</div><!-- /layout -->

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}
</script>

<?= $this->endSection() ?>