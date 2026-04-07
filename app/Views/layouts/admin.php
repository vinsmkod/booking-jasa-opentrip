<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Admin - BLNTRK OUTDOOR') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Admin Shared CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">


    <!-- CSS tambahan dari tiap view (opsional) -->
    <?= $this->renderSection('styles') ?>
</head>

<body>

<?php
    // ── Session user (tersedia di semua halaman) ──
    $sessionName  = session()->get('name') ?? 'Admin';
    $initials     = strtoupper(substr($sessionName, 0, 2));

    // ── Deteksi active nav otomatis ──
    $uri      = service('uri')->getPath();
    $isActive = fn(string $path) => str_contains($uri, trim($path, '/')) ? 'active' : '';

    // ── Badge pending booking ──
    $pendingCount = session()->get('pending_booking_count') ?? 0;
?>

<div class="layout">

    <!-- ═══════════════════ SIDEBAR ═══════════════════ -->
    <aside class="sidebar" id="sidebar">

        <a href="/admin" class="sidebar-brand">
            <div class="brand-icon"><i class="fas fa-globe"></i></div>
            <div class="brand-text">
                <span class="brand-title">OpenTrip</span>
                <span class="brand-sub">Admin Console</span>
            </div>
        </a>

        <div class="sidebar-user">
            <div class="user-avatar"><?= esc($initials) ?></div>
            <div class="user-info">
                <div class="user-name"><?= esc($sessionName) ?></div>
                <div class="user-status">
                    <div class="status-dot"></div>
                    <span class="status-txt">Online</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Overview</div>
            <a href="/admin" class="nav-link <?= ($uri === 'admin' || $uri === 'admin/') ? 'active' : '' ?>">
                <i class="fas fa-th-large nav-icon"></i>
                <span class="nav-label">Dashboard</span>
            </a>

            <div class="nav-section-label">Manajemen</div>
            <a href="/admin/trips" class="nav-link <?= $isActive('admin/trips') ?>">
                <i class="fas fa-map-marked-alt nav-icon"></i>
                <span class="nav-label">Kelola Trip</span>
            </a>
            <a href="/admin/bookings" class="nav-link <?= $isActive('admin/bookings') ?>">
                <i class="fas fa-calendar-check nav-icon"></i>
                <span class="nav-label">Booking</span>
                <?php if ($pendingCount > 0): ?>
                    <span class="nav-badge"><?= $pendingCount ?></span>
                <?php endif; ?>
            </a>
            <a href="/admin/users" class="nav-link <?= $isActive('admin/users') ?>">
                <i class="fas fa-users nav-icon"></i>
                <span class="nav-label">Pengguna</span>
            </a>
            <a href="/admin/comments" class="nav-link <?= $isActive('admin/comments') ?>">
                <i class="fas fa-comments nav-icon"></i>
                <span class="nav-label">Komentar</span>
            </a>

            <div class="nav-section-label">Konten</div>
            <a href="/admin/gallery" class="nav-link <?= $isActive('admin/gallery') ?>">
                <i class="fas fa-images nav-icon"></i>
                <span class="nav-label">Galeri</span>
            </a>
            <a href="/admin/itinerary" class="nav-link <?= $isActive('admin/itinerary') ?>">
                <i class="fas fa-route nav-icon"></i>
                <span class="nav-label">Itinerary</span>
            </a>
            <a href="/admin/includes" class="nav-link <?= $isActive('admin/includes') ?>">
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

    <!-- ═══════════════════ TOPBAR ═══════════════════ -->
    <header class="topbar">
        <button class="topbar-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
            <i class="fas fa-bars"></i>
        </button>

        <div class="topbar-breadcrumb">
            admin
            <i class="fas fa-chevron-right"></i>
            <?= $this->renderSection('breadcrumb') ?>
        </div>

        <div class="topbar-right">
            <span class="date-chip">
                <i class="far fa-calendar-alt" style="margin-right:5px;opacity:.6;"></i>
                <?= date('d M Y') ?>
            </span>
            <div class="topbar-divider"></div>
            <a href="/admin/bookings" class="topbar-btn" title="Notifikasi Booking">
                <i class="fas fa-bell"></i>
                <?php if ($pendingCount > 0): ?>
                    <span class="topbar-notif-dot"></span>
                <?php endif; ?>
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

    <!-- ═══════════════════ MAIN CONTENT ═══════════════════ -->
    <div class="main-wrapper">
        <div class="main-content">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

</div><!-- /layout -->

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}
</script>

<!-- JS tambahan dari tiap view (opsional) -->
<?= $this->renderSection('scripts') ?>

</body>
</html>