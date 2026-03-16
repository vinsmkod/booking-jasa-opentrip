<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Admin Dashboard</h2>
            <small class="text-muted">Overview sistem OpenTrip</small>
        </div>
        <div>
            <span class="badge bg-dark p-2"><?= date('d M Y') ?></span>
        </div>
    </div>
    <!-- Statistik Ringkas -->
    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
        <div class="col">
            <div class="card shadow-sm border-0 text-center p-4 h-100">
                <div class="mb-2 fs-2 text-primary"><i class="bi bi-map"></i></div>
                <h5 class="fw-bold"><?= $totalTrips ?? 0 ?></h5>
                <small class="text-muted">Total Trip</small>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-0 text-center p-4 h-100">
                <div class="mb-2 fs-2 text-success"><i class="bi bi-journal-check"></i></div>
                <h5 class="fw-bold"><?= $totalBookings ?? 0 ?></h5>
                <small class="text-muted">Total Booking</small>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-0 text-center p-4 h-100">
                <div class="mb-2 fs-2 text-warning"><i class="bi bi-people"></i></div>
                <h5 class="fw-bold"><?= $totalUsers ?? 0 ?></h5>
                <small class="text-muted">Total User</small>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-sm border-0 text-center p-4 h-100">
                <div class="mb-2 fs-2 text-danger"><i class="bi bi-cash-stack"></i></div>
                <h5 class="fw-bold">Rp <?= number_format($totalRevenue ?? 0,0,',','.') ?></h5>
                <small class="text-muted">Total Revenue</small>
            </div>
        </div>
    </div>
    <!-- Menu Management -->
    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
        <div class="col">
            <div class="card shadow border-0 h-100 text-center p-4">
                <h5 class="fw-bold mb-2">Kelola Trip</h5>
                <p class="text-muted small">Tambah, edit, hapus trip dan atur jadwal.</p>
                <a href="/admin/trips" class="btn btn-primary w-100">Kelola Trip</a>
            </div>
        </div>

        <div class="col">
            <div class="card shadow border-0 h-100 text-center p-4">
                <h5 class="fw-bold mb-2">Verifikasi</h5>
                <p class="text-muted small">Verifikasi booking & pembayaran.</p>
                <a href="/admin/bookings" class="btn btn-success w-100">Verifikasi</a>
            </div>
        </div>

        <div class="col">
            <div class="card shadow border-0 h-100 text-center p-4">
                <h5 class="fw-bold mb-2">Manajemen User</h5>
                <p class="text-muted small">Lihat & kelola akun pengguna.</p>
                <a href="/admin/users" class="btn btn-warning w-100">Kelola User</a>
            </div>
        </div>

        <!-- Row baru untuk menu tambahan -->
        <div class="col">
            <div class="card shadow border-0 h-100 text-center p-4">
                <h5 class="fw-bold mb-2">Kelola Komentar</h5>
                <p class="text-muted small">Moderasi komentar pengguna.</p>
                <a href="/admin/comments" class="btn btn-secondary w-100">Kelola Komentar</a>
            </div>
        </div>

        <div class="col">
            <div class="card shadow border-0 h-100 text-center p-4">
                <h5 class="fw-bold mb-2">Kelola Galeri</h5>
                <p class="text-muted small">Tambah dan hapus foto galeri trip.</p>
                <a href="/admin/gallery" class="btn btn-dark w-100">Kelola Galeri</a>
            </div>
        </div>
        <div class="col">
            <div class="card shadow border-0 h-100 text-center p-4">
                <h5 class="fw-bold mb-2">Kelola Itinerary</h5>
                <p class="text-muted small">Atur itinerary trip.</p>
                <a href="/admin/itinerary" class="btn btn-info w-100">
                Kelola Itinerary
                </a>
            </div>
        </div>
<div class="col">
<div class="card shadow border-0 h-100 text-center p-4">
<h5 class="fw-bold mb-2">Kelola Include</h5>
<p class="text-muted small">Atur paket include trip.</p>
<a href="/admin/includes" class="btn btn-primary w-100">
Kelola Include
</a>
</div>
</div>
          <div class="col">
            <div class="card shadow border-0 h-100 text-center p-4">
                <h5 class="fw-bold mb-2">Export Data</h5>
                <p class="text-muted small">Ekspor data booking ke format Excel.</p>
                <a href="<?= base_url('booking/exportExcel') ?>" class="btn btn-success">Export Excel</a>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>