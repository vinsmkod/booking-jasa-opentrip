<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Admin - BLNTRK OUTDOOR') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/AdminCss/admin.css') ?>">

    <?= $this->renderSection('styles') ?>
</head>

<body>

    <?php
    $sessionName  = session()->get('name') ?? 'Admin';
    $initials     = strtoupper(substr($sessionName, 0, 2));
    $uri          = service('uri')->getPath();
    $isActive     = fn(string $path) => str_contains($uri, trim($path, '/')) ? 'active' : '';
    $pendingCount = session()->get('pending_booking_count') ?? 0;
    ?>

    <div class="layout">

        <!-- ═══════════════════ SIDEBAR ═══════════════════ -->
        <aside class="sidebar" id="sidebar">
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
                    <span class="nav-label">Verifikasi Booking</span>
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
            <button class="topbar-toggle" id="sidebarToggle" type="button" title="Toggle Sidebar">
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

                <!-- ── USER DROPDOWN ── -->
                <div class="topbar-user-wrap" id="topbarUserWrap">
                    <div class="topbar-user" id="topbarUser">
                        <div class="topbar-avatar"><?= esc($initials) ?></div>
                        <span class="topbar-username"><?= esc($sessionName) ?></span>
                        <i class="fas fa-chevron-down topbar-chevron" id="topbarChevron"></i>
                    </div>
                    <div class="topbar-dropdown" id="topbarDropdown">
                        <div class="topbar-dropdown-header">
                            <div class="topbar-avatar topbar-avatar-lg"><?= esc($initials) ?></div>
                            <div>
                                <div class="topbar-dropdown-name"><?= esc($sessionName) ?></div>
                                <div class="topbar-dropdown-role">Administrator</div>
                            </div>
                        </div>
                        <div class="topbar-dropdown-divider"></div>
                        <a href="/admin" class="topbar-dropdown-item">
                            <i class="fas fa-th-large"></i> Dashboard
                        </a>
                        <a href="<?= base_url('booking/exportExcel') ?>" class="topbar-dropdown-item">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                        <div class="topbar-dropdown-divider"></div>
                        <a href="/logout" class="topbar-dropdown-item topbar-dropdown-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>

            </div>
        </header>

        <!-- ═══════════════════ MAIN CONTENT ═══════════════════ -->
        <div class="main-wrapper">
            <div class="main-content">
                <?= $this->renderSection('content') ?>
            </div>
        </div>

        <!-- ═══════════════════ SIDEBAR OVERLAY ═══════════════════ -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

    </div><!-- /layout -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sb = document.getElementById('sidebar');
            const ov = document.getElementById('sidebarOverlay');
            const btn = document.getElementById('sidebarToggle');
            const layout = document.querySelector('.layout');

            if (!sb || !btn) return;

            // ── Sidebar Toggle ──
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (window.innerWidth <= 768) {
                    sb.classList.toggle('open');
                    if (ov) ov.classList.toggle('open');
                } else {
                    layout.classList.toggle('sidebar-collapsed');
                }
            });

            if (ov) {
                ov.addEventListener('click', function() {
                    sb.classList.remove('open');
                    ov.classList.remove('open');
                });
            }

            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sb.classList.remove('open');
                        if (ov) ov.classList.remove('open');
                    }
                });
            });

            // ── Topbar User Dropdown ──
            const topbarUser = document.getElementById('topbarUser');
            const topbarDropdown = document.getElementById('topbarDropdown');
            const topbarChevron = document.getElementById('topbarChevron');

            if (topbarUser && topbarDropdown) {
                topbarUser.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isOpen = topbarDropdown.classList.toggle('open');
                    topbarChevron.style.transform = isOpen ? 'rotate(180deg)' : 'rotate(0deg)';
                });

                document.addEventListener('click', function() {
                    topbarDropdown.classList.remove('open');
                    topbarChevron.style.transform = 'rotate(0deg)';
                });

                topbarDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });
    </script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>