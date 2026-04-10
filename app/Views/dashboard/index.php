<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
    .dashboard-card {
        border-radius: 20px;
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
    .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
    .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); color: #ffc107; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="fw-bold">Halo, <?= esc(session()->get('name')) ?>! 👋</h2>
            <p class="text-muted">Selamat datang di dashboard petualangan Anda.</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Total Booking -->
        <div class="col-md-4">
            <div class="card dashboard-card shadow-sm p-4 h-100">
                <div class="stat-icon bg-soft-primary">
                    <i class="fas fa-calendar-check fa-2x"></i>
                </div>
                <h6 class="text-muted fw-semibold mb-1">Total Perjalanan</h6>
                <h3 class="fw-bold mb-0"><?= $totalBooking ?? 0 ?></h3>
                <small class="text-muted mt-2 d-block">Trip yang telah Anda pesan</small>
            </div>
        </div>

        <!-- Akun Status -->
        <div class="col-md-4">
            <div class="card dashboard-card shadow-sm p-4 h-100">
                <div class="stat-icon bg-soft-success">
                    <i class="fas fa-user-circle fa-2x"></i>
                </div>
                <h6 class="text-muted fw-semibold mb-1">Status Akun</h6>
                <h3 class="fw-bold mb-0">Verified</h3>
                <small class="text-muted mt-2 d-block">Identitas Anda telah terverifikasi</small>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 bg-light p-4 rounded-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h5 class="fw-bold mb-1">Ingin Petualangan Baru?</h5>
                        <p class="text-muted mb-0 small">Temukan jadwal trip pendakian gunung terbaru kami.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('trips') ?>" class="btn btn-success px-4 fw-semibold">
                            <i class="fas fa-search me-2"></i>Cari Trip
                        </a>
                        <a href="<?= base_url('booking/history') ?>" class="btn btn-outline-dark px-4 fw-semibold">
                            <i class="fas fa-history me-2"></i>Riwayat Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>