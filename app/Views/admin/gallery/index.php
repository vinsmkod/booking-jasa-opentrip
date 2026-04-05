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
    position: fixed; top: 0; left: 0; height: 100vh;
    overflow-y: auto; overflow-x: hidden; z-index: 100;
}
.sidebar::-webkit-scrollbar { width: 4px; }
.sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }

.sidebar-brand {
    display: flex; align-items: center; gap: 12px;
    padding: 0 18px; height: var(--top-h);
    background: var(--sb-bg2);
    border-bottom: 1px solid rgba(255,255,255,.06);
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
.user-name { font-size: 12.5px; font-weight: 600; color: #fff; }
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
    font-size: 13px; border-left: 3px solid transparent;
    transition: all .15s; margin: 1px 0;
}
.nav-link:hover { background: var(--sb-hover-bg); color: #fff; text-decoration: none; }
.nav-link.active { background: var(--sb-active-bg); color: #fff; font-weight: 500; border-left-color: var(--sb-accent); }
.nav-icon { width: 20px; text-align: center; font-size: 14px; flex-shrink: 0; opacity: .8; }
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
    display: flex; align-items: center; padding: 0 24px; gap: 16px;
    z-index: 50; box-shadow: 0 1px 3px rgba(0,0,0,.05);
}
.topbar-toggle {
    width: 32px; height: 32px; border: 1px solid var(--border); border-radius: 6px;
    background: transparent; cursor: pointer; color: var(--txt2);
    display: flex; align-items: center; justify-content: center; transition: all .15s;
}
.topbar-toggle:hover { background: var(--bg); color: var(--txt); }
.topbar-breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12.5px; color: var(--txt3); font-family: var(--mono); }
.topbar-breadcrumb .crumb-active { color: var(--txt); }
.topbar-breadcrumb i { font-size: 9px; }
.topbar-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }
.topbar-btn {
    width: 34px; height: 34px; border: 1px solid var(--border); border-radius: 6px;
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
    background: var(--bg); border: 1px solid var(--border); padding: 5px 12px; border-radius: 5px;
}
.topbar-user {
    display: flex; align-items: center; gap: 8px;
    padding: 4px 10px 4px 4px; border: 1px solid var(--border);
    border-radius: 20px; cursor: pointer; transition: all .15s;
}
.topbar-user:hover { background: var(--bg); }
.topbar-avatar {
    width: 26px; height: 26px; border-radius: 50%; background: var(--accent);
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 600; color: #fff;
}
.topbar-username { font-size: 12px; font-weight: 500; color: var(--txt); }

/* ── MAIN ── */
.main-wrapper { margin-left: var(--sb-w); margin-top: var(--top-h); flex: 1; min-width: 0; }
.main-content { padding: 24px; }

/* ── PAGE HEADER ── */
.page-header { margin-bottom: 22px; display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
.page-header-left h1 { font-size: 20px; font-weight: 600; color: var(--txt); margin-bottom: 4px; }
.page-header-left p  { font-size: 13px; color: var(--txt2); }
.page-header-right { display: flex; gap: 8px; flex-wrap: wrap; }

/* ── ALERT ── */
.alert {
    padding: 12px 16px; border-radius: var(--radius); margin-bottom: 16px;
    font-size: 13px; display: flex; align-items: center; gap: 10px; border: 1px solid transparent;
}
.alert-success { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
.alert-danger  { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
.alert-close { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; opacity: .5; padding: 0 4px; }
.alert-close:hover { opacity: 1; }

/* ── METRICS ── */
.metrics { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 20px; }
.metric {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 16px 18px;
    display: flex; align-items: center; gap: 14px;
    transition: box-shadow .15s;
}
.metric:hover { box-shadow: 0 4px 16px rgba(0,0,0,.07); }
.metric-icon-wrap {
    width: 44px; height: 44px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 18px;
}
.metric-label { font-size: 10.5px; font-weight: 500; letter-spacing: .07em; text-transform: uppercase; color: var(--txt3); margin-bottom: 3px; }
.metric-value { font-size: 22px; font-weight: 600; color: var(--txt); font-family: var(--mono); line-height: 1; }
.metric-sub   { font-size: 11px; color: var(--txt3); margin-top: 4px; }

/* ── SEARCH BAR ── */
.search-bar {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius); padding: 14px 18px;
    margin-bottom: 16px; display: flex; gap: 10px; align-items: center;
}
.search-input-wrap { flex: 1; position: relative; }
.search-input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--txt3); font-size: 13px; }
.search-input {
    width: 100%; padding: 8px 12px 8px 36px;
    border: 1px solid var(--border); border-radius: 6px;
    font-size: 13px; font-family: var(--font);
    background: var(--bg); color: var(--txt);
    outline: none; transition: border-color .15s;
}
.search-input:focus { border-color: var(--border2); background: var(--surface); }
.search-reset { font-size: 12px; color: var(--txt3); text-decoration: none; white-space: nowrap; display: flex; align-items: center; gap: 4px; }
.search-reset:hover { color: var(--sb-accent); text-decoration: none; }

/* ── PANEL ── */
.panel { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }
.panel-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 18px; border-bottom: 1px solid var(--border); background: var(--surface2);
}
.panel-title { font-size: 13px; font-weight: 600; color: var(--txt); display: flex; align-items: center; gap: 8px; }
.panel-title i { color: var(--txt3); font-size: 12px; }

/* ── TABLE ── */
.table-wrap { overflow-x: auto; }
.tbl { width: 100%; border-collapse: collapse; min-width: 700px; }
.tbl thead tr { background: var(--surface2); }
.tbl th {
    font-size: 10.5px; letter-spacing: .07em; text-transform: uppercase;
    color: var(--txt3); font-weight: 600;
    padding: 10px 14px; text-align: left;
    border-bottom: 1px solid var(--border); white-space: nowrap;
}
.tbl td {
    font-size: 13px; color: var(--txt);
    padding: 10px 14px; border-bottom: 1px solid rgba(0,0,0,.05); vertical-align: middle;
}
.tbl tbody tr:hover td { background: #fafafa; }
.tbl tbody tr:last-child td { border-bottom: none; }

.td-no   { font-family: var(--mono); font-size: 11.5px; color: var(--txt3); width: 48px; }
.td-name { font-weight: 500; color: var(--txt); }
.td-date { font-family: var(--mono); font-size: 11.5px; color: var(--txt3); white-space: nowrap; }

/* Thumbnail */
.img-thumb {
    width: 56px; height: 56px; object-fit: cover;
    border-radius: 6px; border: 1px solid var(--border);
    display: block; transition: transform .15s;
}
.img-thumb:hover { transform: scale(1.08); }

/* Album tag */
.album-tag {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 11px; font-weight: 500;
    background: #eff6ff; color: #1d4ed8;
    border: 1px solid #bfdbfe;
    padding: 3px 9px; border-radius: 4px;
}

/* Buttons */
.btn-row { display: flex; gap: 6px; }
.btn-sm {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 11.5px; font-weight: 500;
    padding: 5px 11px; border-radius: 5px;
    border: 1px solid transparent; text-decoration: none;
    cursor: pointer; white-space: nowrap; transition: all .15s;
}
.btn-edit   { background: #fffbeb; color: #b45309; border-color: #fde68a; }
.btn-edit:hover   { background: #fef9c3; text-decoration: none; color: #b45309; }
.btn-delete { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
.btn-delete:hover { background: #fee2e2; text-decoration: none; color: #b91c1c; }
.btn-primary-sm {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: 13px; font-weight: 500;
    padding: 8px 16px; border-radius: var(--radius);
    background: var(--accent); color: #fff; border: none;
    text-decoration: none; transition: all .15s; cursor: pointer;
}
.btn-primary-sm:hover { background: #2d2d4e; text-decoration: none; color: #fff; }
.btn-outline-sm {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: 13px; font-weight: 500;
    padding: 8px 16px; border-radius: var(--radius);
    background: var(--surface); color: var(--txt2);
    border: 1px solid var(--border2);
    text-decoration: none; transition: all .15s; cursor: pointer;
}
.btn-outline-sm:hover { background: var(--bg); text-decoration: none; color: var(--txt); }

/* Pagination */
.pagination-wrap {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 18px; border-top: 1px solid var(--border);
    background: var(--surface2);
}
.pagination-info { font-size: 12px; color: var(--txt3); font-family: var(--mono); }
.pagination-links { display: flex; gap: 4px; }
.pagination-links a, .pagination-links span {
    display: inline-flex; align-items: center; justify-content: center;
    width: 30px; height: 30px; border-radius: 5px; font-size: 12px;
    border: 1px solid var(--border); text-decoration: none; color: var(--txt2);
    transition: all .12s;
}
.pagination-links a:hover { background: var(--bg); color: var(--txt); }
.pagination-links .active { background: var(--accent); color: #fff; border-color: var(--accent); }

.empty-state { text-align: center; padding: 48px 20px; color: var(--txt3); }
.empty-state i { font-size: 36px; margin-bottom: 12px; display: block; opacity: .4; }
.empty-state p { font-size: 13px; margin-bottom: 14px; }

/* Search button */
.btn-search {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 18px; border-radius: 6px;
    background: var(--accent); color: #fff; border: none;
    font-size: 13px; font-weight: 500; cursor: pointer;
    white-space: nowrap; transition: all .15s;
}
.btn-search:hover { background: #2d2d4e; }

/* ── RESPONSIVE ── */
@media (max-width: 1024px) { .metrics { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 768px) {
    .sidebar { transform: translateX(-100%); }
    .sidebar.open { transform: translateX(0); }
    .topbar { left: 0; }
    .main-wrapper { margin-left: 0; }
    .metrics { grid-template-columns: 1fr 1fr; }
    .page-header { flex-direction: column; }
}
</style>

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
            <div class="user-avatar">AD</div>
            <div>
                <div class="user-name">Administrator</div>
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
            <a href="/admin/bookings" class="nav-link">
                <i class="fas fa-calendar-check nav-icon"></i>
                <span class="nav-label">Booking</span>
                <span class="nav-badge">3</span>
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
            <a href="/admin/gallery" class="nav-link active">
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
            konten <i class="fas fa-chevron-right"></i>
            <span class="crumb-active">galeri</span>
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
                <div class="topbar-avatar">AD</div>
                <span class="topbar-username">Admin</span>
                <i class="fas fa-chevron-down" style="font-size:9px;color:var(--txt3);"></i>
            </div>
        </div>
    </header>

    <!-- ═══ MAIN ═══ -->
    <div class="main-wrapper">
        <div class="main-content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>Kelola Galeri</h1>
                    <p>Kelola foto dan album galeri trip</p>
                </div>
                <div class="page-header-right">
                    <a href="<?= base_url('admin/gallery/albums') ?>" class="btn-outline-sm">
                        <i class="fas fa-folder-open"></i> Lihat Album
                    </a>
                    <a href="<?= base_url('admin/gallery/create') ?>" class="btn-primary-sm">
                        <i class="fas fa-plus"></i> Tambah Foto
                    </a>
                </div>
            </div>

            <!-- Alerts -->
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

            <!-- Metrics -->
            <div class="metrics">
                <div class="metric">
                    <div class="metric-icon-wrap" style="background:#eff6ff;">
                        <i class="fas fa-images" style="color:#1d4ed8;"></i>
                    </div>
                    <div>
                        <div class="metric-label">Total Foto</div>
                        <div class="metric-value"><?= $totalPhotos ?? 0 ?></div>
                        <div class="metric-sub">Seluruh foto</div>
                    </div>
                </div>
                <div class="metric">
                    <div class="metric-icon-wrap" style="background:#f0fdf4;">
                        <i class="fas fa-folder-open" style="color:#16a34a;"></i>
                    </div>
                    <div>
                        <div class="metric-label">Total Album</div>
                        <div class="metric-value"><?= $totalAlbums ?? 0 ?></div>
                        <div class="metric-sub">Album tersedia</div>
                    </div>
                </div>
                <div class="metric">
                    <div class="metric-icon-wrap" style="background:#fefce8;">
                        <i class="fas fa-camera" style="color:#b45309;"></i>
                    </div>
                    <div>
                        <div class="metric-label">Halaman Ini</div>
                        <div class="metric-value"><?= count($galleries ?? []) ?></div>
                        <div class="metric-sub">dari <?= isset($pager) ? $pager->getTotal() : count($galleries ?? []) ?> total</div>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <form method="get">
                <div class="search-bar">
                    <div class="search-input-wrap">
                        <i class="fas fa-search"></i>
                        <input type="text" name="keyword" class="search-input"
                               placeholder="Cari berdasarkan judul foto..."
                               value="<?= esc($keyword ?? '') ?>">
                    </div>
                    <?php if (!empty($keyword)): ?>
                        <a href="<?= base_url('admin/gallery') ?>" class="search-reset">
                            <i class="fas fa-times-circle"></i> Reset
                        </a>
                    <?php endif; ?>
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>

            <!-- Table Panel -->
            <div class="panel">
                <div class="panel-header">
                    <span class="panel-title">
                        <i class="fas fa-images"></i> Daftar Foto
                        <?php if (!empty($keyword)): ?>
                            <span style="font-size:11px;color:var(--txt3);font-weight:400;">
                                — hasil pencarian "<?= esc($keyword) ?>"
                            </span>
                        <?php endif; ?>
                    </span>
                    <span style="font-size:12px;color:var(--txt3);font-family:var(--mono);">
                        <?= isset($pager) ? $pager->getTotal() : count($galleries ?? []) ?> foto
                    </span>
                </div>

                <div class="table-wrap">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Judul</th>
                                <th>Album</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($galleries)): ?>
                                <?php
                                    $perPage     = isset($pager) ? $pager->getPerPage() : count($galleries);
                                    $currentPage = isset($pager) ? $pager->getCurrentPage() : 1;
                                    $no          = ($currentPage - 1) * $perPage + 1;
                                ?>
                                <?php foreach ($galleries as $gallery): ?>
                                <tr>
                                    <td class="td-no"><?= $no++ ?></td>
                                    <td>
                                        <img src="<?= base_url('uploads/gallery/' . $gallery['image']) ?>"
                                             alt="<?= esc($gallery['title']) ?>"
                                             class="img-thumb">
                                    </td>
                                    <td>
                                        <div class="td-name"><?= esc($gallery['title']) ?></div>
                                    </td>
                                    <td>
                                        <span class="album-tag">
                                            <i class="fas fa-folder" style="font-size:9px;"></i>
                                            <?= esc($gallery['album'] ?? 'Tanpa Album') ?>
                                        </span>
                                    </td>
                                    <td class="td-date">
                                        <i class="far fa-calendar-alt" style="margin-right:4px;opacity:.5;"></i>
                                        <?= date('d M Y', strtotime($gallery['created_at'])) ?>
                                    </td>
                                    <td>
                                        <div class="btn-row">
                                            <a href="<?= base_url('admin/gallery/edit/' . $gallery['gallery_id']) ?>" class="btn-sm btn-edit">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/gallery/delete/' . $gallery['gallery_id']) ?>"
                                               onclick="return confirm('Yakin ingin menghapus foto ini?')"
                                               class="btn-sm btn-delete">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fas fa-images"></i>
                                            <p><?= !empty($keyword) ? 'Tidak ada foto untuk pencarian "' . esc($keyword) . '"' : 'Belum ada foto dalam galeri' ?></p>
                                            <a href="<?= base_url('admin/gallery/create') ?>" class="btn-primary-sm" style="display:inline-flex;">
                                                <i class="fas fa-plus"></i> Tambah Foto Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if (!empty($galleries) && isset($pager)): ?>
                <div class="pagination-wrap">
                    <div class="pagination-info">
                        Menampilkan <?= count($galleries) ?> dari <?= $pager->getTotal() ?> foto
                    </div>
                    <div>
                        <?= $pager->links('default', 'bootstrap') ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>