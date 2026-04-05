<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap');

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
    --sb-bg:       #1a1a2e;
    --sb-bg2:      #16213e;
    --sb-accent:   #e94560;
    --sb-txt:      rgba(255,255,255,.75);
    --sb-txt-mute: rgba(255,255,255,.40);
    --sb-hover-bg: rgba(255,255,255,.07);
    --sb-active-bg:rgba(233,69,96,.15);
    --sb-w:        260px;
    --top-h:       56px;
    --accent:      #1a1a2e;
    --radius:      8px;
    --font:        'IBM Plex Sans', sans-serif;
    --mono:        'IBM Plex Mono', monospace;
}

body { background: var(--bg); color: var(--txt); font-family: var(--font); font-size: 14px; }
.layout { display: flex; min-height: 100vh; }

/* ── SIDEBAR ── */
.sidebar {
    width: var(--sb-w); background: var(--sb-bg);
    display: flex; flex-direction: column;
    position: fixed; top: 0; left: 0;
    height: 100vh; overflow-y: auto; overflow-x: hidden;
    z-index: 100; flex-shrink: 0;
}
.sidebar::-webkit-scrollbar { width: 4px; }
.sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }
.sidebar-brand {
    display: flex; align-items: center; gap: 12px;
    padding: 0 18px; height: var(--top-h);
    background: var(--sb-bg2); border-bottom: 1px solid rgba(255,255,255,.06);
    text-decoration: none;
}
.sidebar-brand:hover { text-decoration: none; }
.brand-icon {
    width: 34px; height: 34px; background: var(--sb-accent);
    border-radius: 8px; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; box-shadow: 0 4px 12px rgba(233,69,96,.4);
}
.brand-icon i { color: #fff; font-size: 15px; }
.brand-title { font-size: 14px; font-weight: 600; color: #fff; letter-spacing: .03em; line-height: 1.2; }
.brand-sub   { font-size: 10px; color: var(--sb-txt-mute); letter-spacing: .1em; text-transform: uppercase; }
.sidebar-user {
    display: flex; align-items: center; gap: 10px;
    padding: 14px 18px; background: rgba(0,0,0,.15);
    border-bottom: 1px solid rgba(255,255,255,.06);
}
.user-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: var(--sb-accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600; color: #fff;
    flex-shrink: 0; border: 2px solid rgba(255,255,255,.15);
}
.user-name   { font-size: 12.5px; font-weight: 600; color: #fff; }
.user-status { display: flex; align-items: center; gap: 4px; margin-top: 2px; }
.status-dot  { width: 6px; height: 6px; border-radius: 50%; background: #22c55e; }
.status-txt  { font-size: 10px; color: #22c55e; }
.sidebar-nav { flex: 1; padding: 10px 0; }
.nav-section-label {
    font-size: 10px; letter-spacing: .12em; text-transform: uppercase;
    color: var(--sb-txt-mute); font-weight: 600;
    padding: 14px 18px 6px;
    display: flex; align-items: center; gap: 8px;
}
.nav-section-label::after { content: ''; flex: 1; height: 1px; background: rgba(255,255,255,.06); }
.nav-link {
    display: flex; align-items: center; gap: 12px;
    padding: 9px 18px; color: var(--sb-txt); text-decoration: none;
    font-size: 13px; font-weight: 400;
    border-left: 3px solid transparent; transition: all .15s ease; margin: 1px 0;
}
.nav-link:hover { background: var(--sb-hover-bg); color: #fff; text-decoration: none; }
.nav-link.active { background: var(--sb-active-bg); color: #fff; font-weight: 500; border-left-color: var(--sb-accent); }
.nav-link .nav-icon { width: 20px; text-align: center; font-size: 14px; flex-shrink: 0; opacity: .8; }
.nav-link.active .nav-icon { opacity: 1; color: var(--sb-accent); }
.nav-link:hover .nav-icon { opacity: 1; }
.nav-label { flex: 1; }
.nav-badge {
    font-size: 10px; font-family: var(--mono);
    background: var(--sb-accent); color: #fff;
    padding: 1px 7px; border-radius: 10px; font-weight: 600; line-height: 1.6;
}
.sidebar-footer { border-top: 1px solid rgba(255,255,255,.08); padding: 8px 0; }

/* ── TOPBAR ── */
.topbar {
    position: fixed; top: 0; left: var(--sb-w); right: 0;
    height: var(--top-h); background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center;
    padding: 0 24px; gap: 16px; z-index: 50;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
}
.topbar-toggle {
    width: 32px; height: 32px;
    border: 1px solid var(--border); border-radius: 6px;
    background: transparent; cursor: pointer; color: var(--txt2);
    display: flex; align-items: center; justify-content: center; transition: all .15s;
}
.topbar-toggle:hover { background: var(--bg); color: var(--txt); }
.topbar-breadcrumb {
    display: flex; align-items: center; gap: 6px;
    font-size: 12.5px; color: var(--txt3); font-family: var(--mono);
}
.topbar-breadcrumb .crumb-active { color: var(--txt); }
.topbar-breadcrumb i { font-size: 9px; }
.topbar-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }
.topbar-btn {
    width: 34px; height: 34px;
    border: 1px solid var(--border); border-radius: 6px;
    background: transparent; cursor: pointer; color: var(--txt2);
    display: flex; align-items: center; justify-content: center;
    position: relative; transition: all .15s; text-decoration: none;
}
.topbar-btn:hover { background: var(--bg); color: var(--txt); text-decoration: none; }
.topbar-notif-dot {
    position: absolute; top: 6px; right: 6px;
    width: 6px; height: 6px; border-radius: 50%;
    background: var(--sb-accent); border: 1px solid #fff;
}
.topbar-divider { width: 1px; height: 20px; background: var(--border); }
.date-chip {
    font-size: 11.5px; font-family: var(--mono); color: var(--txt3);
    background: var(--bg); border: 1px solid var(--border);
    padding: 5px 12px; border-radius: 5px;
}
.topbar-user {
    display: flex; align-items: center; gap: 8px;
    padding: 4px 10px 4px 4px;
    border: 1px solid var(--border); border-radius: 20px;
    cursor: pointer; transition: all .15s;
}
.topbar-user:hover { background: var(--bg); }
.topbar-avatar {
    width: 26px; height: 26px; border-radius: 50%;
    background: var(--accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 600; color: #fff;
}
.topbar-username { font-size: 12px; font-weight: 500; color: var(--txt); }

/* ── MAIN ── */
.main-wrapper { margin-left: var(--sb-w); margin-top: var(--top-h); flex: 1; min-width: 0; }
.main-content { padding: 24px; }

/* ── PAGE HEADER ── */
.page-header { margin-bottom: 22px; display: flex; align-items: flex-start; justify-content: space-between; }
.page-header-left h1 { font-size: 20px; font-weight: 600; color: var(--txt); margin-bottom: 4px; }
.page-header-left p  { font-size: 13px; color: var(--txt2); }

/* ── ALERT ── */
.alert {
    padding: 12px 16px; border-radius: var(--radius);
    margin-bottom: 16px; font-size: 13px;
    display: flex; align-items: center; gap: 10px;
    border: 1px solid transparent;
}
.alert-success { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
.alert-danger  { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
.alert-close { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; opacity: .5; padding: 0 4px; }
.alert-close:hover { opacity: 1; }

/* ── TABS ── */
.tabs {
    display: flex; gap: 4px;
    border-bottom: 2px solid var(--border);
    margin-bottom: 22px;
}
.tab-btn {
    padding: 9px 18px; font-size: 13px; font-weight: 500;
    color: var(--txt3); background: none; border: none;
    border-bottom: 2px solid transparent; margin-bottom: -2px;
    cursor: pointer; transition: all .15s; border-radius: 6px 6px 0 0;
    display: flex; align-items: center; gap: 7px;
}
.tab-btn:hover { color: var(--txt2); background: var(--surface2); }
.tab-btn.active { color: var(--accent); border-bottom-color: var(--accent); font-weight: 600; }
.tab-btn i { font-size: 12px; }
.tab-count {
    font-size: 10px; font-family: var(--mono);
    background: var(--bg); color: var(--txt3);
    padding: 1px 6px; border-radius: 8px; font-weight: 600;
}
.tab-btn.active .tab-count { background: #eef2ff; color: #4f46e5; }

.tab-pane { display: none; }
.tab-pane.active { display: block; }

/* ── PANEL ── */
.panel { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-bottom: 16px; }
.panel:last-child { margin-bottom: 0; }
.panel-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 18px; border-bottom: 1px solid var(--border);
    background: var(--surface2);
}
.panel-title { font-size: 13px; font-weight: 600; color: var(--txt); display: flex; align-items: center; gap: 8px; }
.panel-title i { color: var(--txt3); font-size: 12px; }
.panel-action {
    font-size: 11.5px; color: var(--txt2); text-decoration: none;
    border: 1px solid var(--border); padding: 5px 12px; border-radius: 5px;
    display: flex; align-items: center; gap: 6px; transition: all .12s;
}
.panel-action:hover { border-color: var(--border2); background: var(--bg); text-decoration: none; color: var(--txt); }

/* ── TABLE ── */
.table-wrap { overflow-x: auto; }
.tbl { width: 100%; border-collapse: collapse; min-width: 900px; }
.tbl thead tr { background: var(--surface2); }
.tbl th {
    font-size: 10.5px; letter-spacing: .07em; text-transform: uppercase;
    color: var(--txt3); font-weight: 600;
    padding: 10px 14px; text-align: left;
    border-bottom: 1px solid var(--border); white-space: nowrap;
}
.tbl td {
    font-size: 13px; color: var(--txt);
    padding: 11px 14px; border-bottom: 1px solid rgba(0,0,0,.05);
    vertical-align: middle;
}
.tbl tbody tr:hover td { background: #fafafa; }
.tbl tbody tr:last-child td { border-bottom: none; }
.td-code  { font-family: var(--mono); font-size: 12px; font-weight: 600; color: var(--accent); }
.td-name  { font-weight: 500; color: var(--txt); }
.td-small { font-size: 11.5px; color: var(--txt3); margin-top: 2px; }
.td-price { font-family: var(--mono); font-size: 13px; font-weight: 600; color: #16a34a; }

/* Pill */
.pill { display: inline-flex; align-items: center; gap: 4px; font-size: 10.5px; padding: 3px 9px; border-radius: 4px; font-weight: 500; white-space: nowrap; }
.pill-success   { background: #dcfce7; color: #15803d; }
.pill-warning   { background: #fef9c3; color: #a16207; }
.pill-danger    { background: #fee2e2; color: #b91c1c; }
.pill-info      { background: #dbeafe; color: #1d4ed8; }
.pill-secondary { background: #f1f5f9; color: #64748b; }

/* Buttons */
.btn-row { display: flex; gap: 6px; flex-wrap: wrap; }
.btn-sm {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 11.5px; font-weight: 500;
    padding: 5px 11px; border-radius: 5px;
    border: 1px solid transparent; text-decoration: none;
    cursor: pointer; white-space: nowrap; transition: all .15s;
}
.btn-confirm { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
.btn-confirm:hover { background: #dcfce7; text-decoration: none; color: #15803d; }
.btn-cancel  { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
.btn-cancel:hover  { background: #fee2e2; text-decoration: none; color: #b91c1c; }
.btn-view    { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
.btn-view:hover    { background: #dbeafe; text-decoration: none; color: #1d4ed8; }
.btn-doc     { background: #faf5ff; color: #7c3aed; border-color: #ddd6fe; }
.btn-doc:hover     { background: #ede9fe; text-decoration: none; color: #7c3aed; }

/* ── DOKUMEN ── */
.doc-card {
    border: 1px solid var(--border); border-radius: var(--radius);
    overflow: hidden; margin-bottom: 12px;
}
.doc-card:last-child { margin-bottom: 0; }
.doc-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 10px 16px; background: var(--surface2);
    border-bottom: 1px solid var(--border);
}
.doc-card-code { font-family: var(--mono); font-size: 11.5px; font-weight: 600; color: var(--accent); }
.doc-card-body { padding: 12px 16px; display: flex; flex-direction: column; gap: 10px; }

.doc-row {
    display: flex; align-items: center; gap: 12px;
    padding: 8px 10px; border-radius: 6px;
    border: 1px solid var(--border); background: var(--bg);
}
.doc-avatar {
    width: 34px; height: 34px; border-radius: 50%;
    background: #eef2ff; color: #4f46e5;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; flex-shrink: 0;
}
.doc-info { flex: 1; min-width: 0; }
.doc-name  { font-size: 12.5px; font-weight: 600; color: var(--txt); }
.doc-meta  { font-size: 11px; color: var(--txt3); margin-top: 2px; }
.doc-files { display: flex; gap: 6px; flex-shrink: 0; flex-wrap: wrap; }
.doc-btn {
    font-size: 10.5px; padding: 4px 10px;
    border: 1px solid var(--border); border-radius: 4px;
    background: var(--surface); color: var(--txt2);
    cursor: pointer; display: flex; align-items: center; gap: 5px;
    transition: all .12s; white-space: nowrap;
}
.doc-btn.ktp   { border-color: #bfdbfe; color: #1d4ed8; background: #eff6ff; }
.doc-btn.ktp:hover   { background: #dbeafe; }
.doc-btn.sehat { border-color: #bbf7d0; color: #15803d; background: #f0fdf4; }
.doc-btn.sehat:hover { background: #dcfce7; }
.doc-btn i { font-size: 10px; }
.doc-missing { font-size: 11px; color: var(--txt3); font-style: italic; }

/* ── PESERTA ── */
.peserta-card {
    border: 1px solid var(--border); border-radius: var(--radius);
    overflow: hidden; margin-bottom: 12px;
}
.peserta-card:last-child { margin-bottom: 0; }
.peserta-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 10px 16px; background: var(--surface2);
    border-bottom: 1px solid var(--border);
}
.peserta-card-code { font-family: var(--mono); font-size: 11.5px; font-weight: 600; color: var(--accent); }
.peserta-card-trip { font-size: 11px; color: var(--txt3); }
.peserta-list { padding: 8px 16px; }
.peserta-item {
    display: flex; align-items: center; gap: 10px;
    padding: 8px 0; border-bottom: 1px solid rgba(0,0,0,.04);
}
.peserta-item:last-child { border-bottom: none; }
.peserta-num {
    width: 22px; height: 22px; border-radius: 50%;
    background: #eef2ff; color: #4f46e5;
    font-size: 10px; font-weight: 700;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.peserta-info { flex: 1; }
.peserta-name   { font-size: 12.5px; font-weight: 600; color: var(--txt); }
.peserta-detail { font-size: 11px; color: var(--txt3); margin-top: 1px; }
.peserta-gender { font-size: 11px; }

/* ── MODAL ── */
.img-modal {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,.8); z-index: 9999;
    align-items: center; justify-content: center; padding: 20px;
}
.img-modal.open { display: flex; }
.img-modal-box {
    background: #fff; border-radius: 12px; padding: 20px;
    max-width: 860px; width: 100%;
    display: flex; flex-direction: column; gap: 14px;
    box-shadow: 0 24px 64px rgba(0,0,0,.4);
    max-height: 90vh; overflow: hidden;
}
.img-modal-header { display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-shrink: 0; }
.img-modal-title  { font-size: 14px; font-weight: 600; color: var(--txt); }
.img-modal-close  {
    width: 30px; height: 30px; border-radius: 6px;
    border: 1px solid var(--border); background: var(--bg);
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    font-size: 13px; color: var(--txt2); flex-shrink: 0;
}
.img-modal-close:hover { background: #fee2e2; color: #b91c1c; border-color: #fecaca; }
.img-modal-body  { overflow: auto; display: flex; align-items: center; justify-content: center; }
.img-modal-body img { max-width: 100%; max-height: 70vh; object-fit: contain; border-radius: 6px; display: block; }
.img-modal-body .img-error { color: var(--txt3); font-size: 13px; text-align: center; padding: 40px; }

/* Empty */
.empty-state { text-align: center; padding: 40px 20px; color: var(--txt3); }
.empty-state i { font-size: 32px; margin-bottom: 10px; display: block; opacity: .35; }
.empty-state p { font-size: 13px; }

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .sidebar { transform: translateX(-100%); }
    .sidebar.open { transform: translateX(0); }
    .topbar { left: 0; }
    .main-wrapper { margin-left: 0; }
    .doc-row { flex-wrap: wrap; }
    .doc-files { width: 100%; }
}
</style>

<?php
    $sessionName = session()->get('name') ?? 'Admin';
    $initials    = strtoupper(substr($sessionName, 0, 2));
?>

<div class="layout">

    <!-- ═══ SIDEBAR ═══ -->
    <aside class="sidebar" id="sidebar">
        <a href="/admin" class="sidebar-brand">
            <div class="brand-icon"><i class="fas fa-globe"></i></div>
            <div>
                <div class="brand-title">OpenTrip</div>
                <div class="brand-sub">Admin Console</div>
            </div>
        </a>

        <div class="sidebar-user">
            <div class="user-avatar"><?= esc($initials) ?></div>
            <div>
                <div class="user-name"><?= esc($sessionName) ?></div>
                <div class="user-status">
                    <div class="status-dot"></div>
                    <span class="status-txt">Online</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Overview</div>
            <a href="/admin" class="nav-link">
                <i class="fas fa-th-large nav-icon"></i>
                <span class="nav-label">Dashboard</span>
            </a>
            <div class="nav-section-label">Manajemen</div>
            <a href="/admin/trips" class="nav-link">
                <i class="fas fa-map-marked-alt nav-icon"></i>
                <span class="nav-label">Kelola Trip</span>
            </a>
            <a href="/admin/bookings" class="nav-link active">
                <i class="fas fa-calendar-check nav-icon"></i>
                <span class="nav-label">Booking</span>
                <span class="nav-badge"><?= count(array_filter($bookings ?? [], fn($b) => $b['status'] === 'pending')) ?></span>
            </a>
            <a href="/admin/users" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <span class="nav-label">Pengguna</span>
            </a>
            <a href="/admin/comments" class="nav-link">
                <i class="fas fa-comments nav-icon"></i>
                <span class="nav-label">Komentar</span>
            </a>
            <div class="nav-section-label">Konten</div>
            <a href="/admin/gallery" class="nav-link">
                <i class="fas fa-images nav-icon"></i>
                <span class="nav-label">Galeri</span>
            </a>
            <a href="/admin/itinerary" class="nav-link">
                <i class="fas fa-route nav-icon"></i>
                <span class="nav-label">Itinerary</span>
            </a>
            <a href="/admin/includes" class="nav-link">
                <i class="fas fa-box-open nav-icon"></i>
                <span class="nav-label">Paket Include</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="nav-section-label">Lainnya</div>
            <a href="<?= base_url('booking/exportExcel') ?>" class="nav-link">
                <i class="fas fa-file-excel nav-icon"></i>
                <span class="nav-label">Export Excel</span>
            </a>
            <a href="/logout" class="nav-link">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <span class="nav-label">Logout</span>
            </a>
        </div>
    </aside>

    <!-- ═══ TOPBAR ═══ -->
    <header class="topbar">
        <button class="topbar-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
            <i class="fas fa-bars"></i>
        </button>
        <div class="topbar-breadcrumb">
            admin <i class="fas fa-chevron-right"></i>
            <span class="crumb-active">booking</span>
        </div>
        <div class="topbar-right">
            <span class="date-chip">
                <i class="far fa-calendar-alt" style="margin-right:5px;opacity:.6;"></i>
                <?= date('d M Y') ?>
            </span>
            <div class="topbar-divider"></div>
            <a href="/admin/bookings" class="topbar-btn">
                <i class="fas fa-bell"></i>
                <span class="topbar-notif-dot"></span>
            </a>
            <a href="<?= base_url('booking/exportExcel') ?>" class="topbar-btn" title="Export Excel">
                <i class="fas fa-download"></i>
            </a>
            <div class="topbar-divider"></div>
            <div class="topbar-user">
                <div class="topbar-avatar"><?= esc($initials) ?></div>
                <span class="topbar-username"><?= esc($sessionName) ?></span>
                <i class="fas fa-chevron-down" style="font-size:9px;color:var(--txt3);"></i>
            </div>
        </div>
    </header>

    <!-- ═══ MAIN ═══ -->
    <div class="main-wrapper">
        <div class="main-content">

            <div class="page-header">
                <div class="page-header-left">
                    <h1>Verifikasi Booking</h1>
                    <p>Kelola booking, dokumen, dan peserta trip</p>
                </div>
                <a href="<?= base_url('admin/payments') ?>" class="panel-action">
                    <i class="fas fa-credit-card"></i> Lihat Semua Pembayaran
                </a>
            </div>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button class="alert-close" onclick="this.parentElement.remove()">×</button>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button class="alert-close" onclick="this.parentElement.remove()">×</button>
                </div>
            <?php endif; ?>

            <!-- ═══ TABS ═══ -->
            <div class="tabs">
                <button class="tab-btn active" onclick="switchTab('booking', this)">
                    <i class="fas fa-list-ul"></i> Daftar Booking
                    <span class="tab-count"><?= count($bookings ?? []) ?></span>
                </button>
                <button class="tab-btn" onclick="switchTab('dokumen', this)">
                    <i class="fas fa-id-card"></i> Dokumen KTP & Surat Sehat
                    <span class="tab-count"><?= count($documents ?? []) ?></span>
                </button>
                <button class="tab-btn" onclick="switchTab('peserta', this)">
                    <i class="fas fa-users"></i> Peserta Trip
                    <span class="tab-count"><?= count($bookings ?? []) ?></span>
                </button>
            </div>

            <!-- ═══ TAB: BOOKING ═══ -->
            <div class="tab-pane active" id="tab-booking">
                <div class="panel">
                    <div class="panel-header">
                        <span class="panel-title"><i class="fas fa-list-ul"></i> Daftar Booking</span>
                    </div>
                    <div class="table-wrap">
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>User</th>
                                    <th>Trip</th>
                                    <th>Peserta</th>
                                    <th>Total</th>
                                    <th>Metode</th>
                                    <th>Bukti</th>
                                    <th>Status Booking</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($bookings)): ?>
                                    <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td class="td-code"><?= esc($booking['booking_code'] ?? '-') ?></td>
                                        <td>
                                            <div class="td-name"><?= esc($booking['username'] ?? '-') ?></div>
                                            <div class="td-small"><?= esc($booking['user_email'] ?? '-') ?></div>
                                        </td>
                                        <td>
                                            <div class="td-name"><?= esc($booking['trip_title'] ?? '-') ?></div>
                                            <div class="td-small"><?= date('d M Y', strtotime($booking['departure_date'] ?? 'now')) ?></div>
                                        </td>
                                        <td><?= esc($booking['participant'] ?? 0) ?> orang</td>
                                        <td class="td-price">Rp <?= number_format($booking['total_price'] ?? 0, 0, ',', '.') ?></td>
                                        <td>
                                            <?php if (!empty($booking['method'])): ?>
                                                <span class="pill pill-info"><?= esc($booking['method']) ?></span>
                                            <?php else: ?>
                                                <span style="color:var(--txt3);font-size:12px;">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($booking['proof'])): ?>
                                                <a href="<?= base_url('uploads/payments/' . $booking['proof']) ?>" target="_blank" class="btn-sm btn-view">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            <?php else: ?>
                                                <span style="color:var(--txt3);font-size:12px;"><i class="fas fa-clock"></i> Belum</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php $s = $booking['status'] ?? ''; ?>
                                            <?php if ($s === 'pending'): ?>
                                                <span class="pill pill-warning"><i class="fas fa-clock"></i> Pending</span>
                                            <?php elseif ($s === 'confirmed'): ?>
                                                <span class="pill pill-success"><i class="fas fa-check"></i> Confirmed</span>
                                            <?php elseif ($s === 'cancelled'): ?>
                                                <span class="pill pill-danger"><i class="fas fa-times"></i> Cancelled</span>
                                            <?php else: ?>
                                                <span class="pill pill-secondary">Unknown</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php $ps = $booking['payment_status'] ?? ''; ?>
                                            <?php if ($ps === 'pending'): ?>
                                                <span class="pill pill-warning">Menunggu</span>
                                            <?php elseif ($ps === 'verified'): ?>
                                                <span class="pill pill-success">Terverifikasi</span>
                                            <?php elseif ($ps === 'rejected'): ?>
                                                <span class="pill pill-danger">Ditolak</span>
                                            <?php else: ?>
                                                <span class="pill pill-secondary">Belum Ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (($booking['status'] ?? '') === 'pending'): ?>
                                                <div class="btn-row">
                                                    <a href="<?= base_url('admin/bookings/confirm/' . $booking['booking_id']) ?>"
                                                       class="btn-sm btn-confirm"
                                                       onclick="return confirm('Confirm booking ini?')">
                                                        <i class="fas fa-check"></i> Confirm
                                                    </a>
                                                    <a href="<?= base_url('admin/bookings/cancel/' . $booking['booking_id']) ?>"
                                                       class="btn-sm btn-cancel"
                                                       onclick="return confirm('Cancel booking ini?')">
                                                        <i class="fas fa-times"></i> Cancel
                                                    </a>
                                                </div>
                                            <?php elseif (($booking['status'] ?? '') === 'confirmed'): ?>
                                                <span style="color:#15803d;font-size:12px;font-weight:500;">
                                                    <i class="fas fa-check-circle"></i> Dikonfirmasi
                                                </span>
                                            <?php elseif (($booking['status'] ?? '') === 'cancelled'): ?>
                                                <span style="color:var(--txt3);font-size:12px;">
                                                    <i class="fas fa-ban"></i> Dibatalkan
                                                </span>
                                            <?php else: ?>
                                                <span style="color:var(--txt3);">—</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="10">
                                        <div class="empty-state">
                                            <i class="fas fa-ticket-alt"></i>
                                            <p>Belum ada data booking</p>
                                        </div>
                                    </td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ═══ TAB: DOKUMEN ═══ -->
            <div class="tab-pane" id="tab-dokumen">
                <?php if (!empty($documents)): ?>
                    <?php
                    // Group dokumen by booking_id
                    $docsByBooking = [];
                    foreach ($documents as $doc) {
                        $docsByBooking[$doc['booking_id']]['booking_code'] = $doc['booking_code'] ?? '-';
                        $docsByBooking[$doc['booking_id']]['docs'][] = $doc;
                    }
                    ?>
                    <?php foreach ($docsByBooking as $bookingId => $group): ?>
                    <div class="doc-card">
                        <div class="doc-card-header">
                            <span class="doc-card-code">
                                <i class="fas fa-hashtag" style="font-size:9px;"></i>
                                <?= esc($group['booking_code']) ?>
                            </span>
                            <span style="font-size:11px;color:var(--txt3);"><?= count($group['docs']) ?> peserta</span>
                        </div>
                        <div class="doc-card-body">
                            <?php foreach ($group['docs'] as $doc): ?>
                            <div class="doc-row">
                                <div class="doc-avatar">
                                    <?= strtoupper(substr($doc['name'], 0, 2)) ?>
                                </div>
                                <div class="doc-info">
                                    <div class="doc-name"><?= esc($doc['name']) ?></div>
                                    <div class="doc-meta">
                                        <?= esc($doc['gender']) ?>
                                        <?php if (!empty($doc['email'])): ?>
                                            &middot; <?= esc($doc['email']) ?>
                                        <?php endif; ?>
                                        <?php if (!empty($doc['birthdate']) && $doc['birthdate'] !== '0000-00-00'): ?>
                                            &middot; <?= date('d M Y', strtotime($doc['birthdate'])) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="doc-files">
                                    <?php if (!empty($doc['ktp'])): ?>
                                        <button class="doc-btn ktp"
                                               onclick="openModal('<?= base_url('uploads/documents/' . $doc['ktp']) ?>', 'KTP — <?= esc($doc['name']) ?>')">
        <i class="fas fa-id-card"></i> Lihat KTP
                                        </button>
                                    <?php else: ?>
                                        <span class="doc-missing"><i class="fas fa-times-circle"></i> KTP belum</span>
                                    <?php endif; ?>

                                    <?php if (!empty($doc['health'])): ?>
                                        <button class="doc-btn sehat"
                                            onclick="openModal('<?= base_url('uploads/documents/' . $doc['health']) ?>', 'Surat Sehat — <?= esc($doc['name']) ?>')">
        <i class="fas fa-file-medical"></i> Lihat Surat Sehat
                                        </button>
                                    <?php else: ?>
                                        <span class="doc-missing"><i class="fas fa-times-circle"></i> Surat sehat belum</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="panel">
                        <div class="panel-body" style="padding:40px;">
                            <div class="empty-state">
                                <i class="fas fa-folder-open"></i>
                                <p>Belum ada dokumen yang diupload.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- ═══ TAB: PESERTA ═══ -->
            <div class="tab-pane" id="tab-peserta">
                <?php if (!empty($bookingPeserta)): ?>
                    <?php foreach ($bookingPeserta as $bk): ?>
                    <div class="peserta-card">
                        <div class="peserta-card-header">
                            <div>
                                <span class="peserta-card-code"><?= esc($bk['booking_code']) ?></span>
                                <span class="peserta-card-trip" style="margin-left:8px;"><?= esc($bk['trip_title'] ?? '') ?></span>
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <span style="font-size:11px;color:var(--txt3);"><?= count($bk['peserta']) ?> peserta</span>
                                <?php $s = $bk['status'] ?? ''; ?>
                                <span class="pill <?= $s === 'confirmed' ? 'pill-success' : ($s === 'pending' ? 'pill-warning' : 'pill-danger') ?>">
                                    <?= ucfirst($s) ?>
                                </span>
                            </div>
                        </div>
                        <div class="peserta-list">
                            <?php if (!empty($bk['peserta'])): ?>
                                <?php foreach ($bk['peserta'] as $i => $p): ?>
                                <div class="peserta-item">
                                    <div class="peserta-num"><?= $i + 1 ?></div>
                                    <div class="peserta-info">
                                        <div class="peserta-name"><?= esc($p['name']) ?></div>
                                        <div class="peserta-detail">
                                            <?= esc($p['gender']) ?>
                                            <?php if (!empty($p['email'])): ?>
                                                &middot; <?= esc($p['email']) ?>
                                            <?php endif; ?>
                                            <?php if (!empty($p['birthdate']) && $p['birthdate'] !== '0000-00-00'): ?>
                                                &middot; <?= date('d M Y', strtotime($p['birthdate'])) ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div style="font-size:12px;color:var(--txt3);padding:10px 0;">
                                    <i class="fas fa-info-circle"></i> Belum ada data peserta.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="panel">
                        <div class="panel-body" style="padding:40px;">
                            <div class="empty-state">
                                <i class="fas fa-users"></i>
                                <p>Belum ada data peserta.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

</div>

<!-- Modal Preview Dokumen -->
<div class="img-modal" id="imgModal" onclick="closeModalOutside(event)">
    <div class="img-modal-box">
        <div class="img-modal-header">
            <span class="img-modal-title" id="imgModalTitle">Dokumen</span>
            <button class="img-modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="img-modal-body">
            <img id="imgModalImg" src="" alt="Dokumen"
                 onerror="this.style.display='none';document.getElementById('imgModalErr').style.display='block'">
            <div id="imgModalErr" style="display:none;" class="img-error">
                <i class="fas fa-image" style="font-size:32px;display:block;margin-bottom:8px;opacity:.3;"></i>
                Gambar tidak dapat ditampilkan.
            </div>
        </div>
    </div>
</div>

<script>
// Tab switching
function switchTab(name, btn) {
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}

// Modal
function openModal(src, title) {
    const img = document.getElementById('imgModalImg');
    const err = document.getElementById('imgModalErr');
    img.style.display = 'block';
    err.style.display = 'none';
    img.src = src;
    document.getElementById('imgModalTitle').textContent = title;
    document.getElementById('imgModal').classList.add('open');
}
function closeModal() {
    document.getElementById('imgModal').classList.remove('open');
    document.getElementById('imgModalImg').src = '';
}
function closeModalOutside(e) {
    if (e.target === document.getElementById('imgModal')) closeModal();
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>

<?= $this->endSection() ?>
