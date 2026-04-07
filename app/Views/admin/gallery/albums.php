<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Kelola Album</h3>
            <p class="text-muted mb-0">Kumpulan album foto galeri</p>
        </div>
        <div>
            <a href="<?= base_url('admin/gallery') ?>" class="btn btn-outline-secondary me-2">
                <i class="fas fa-images"></i> Lihat Semua Foto
            </a>
            <a href="<?= base_url('admin/gallery/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Foto
            </a>
        </div>
    </div>

    <!-- Notifikasi -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($albums)): ?>
        <div class="row">
            <?php foreach ($albums as $album): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm border-0 h-100 overflow-hidden hover-shadow transition">
                        <a href="<?= base_url('admin/gallery/album/' . urlencode($album['album'])) ?>"
                            class="text-decoration-none">
                            <div class="position-relative" style="height: 200px; overflow: hidden;">
                                <?php if (!empty($album['cover'])): ?>
                                    <img src="<?= base_url('uploads/gallery/' . $album['cover']) ?>"
                                        alt="<?= esc($album['album']) ?>"
                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;"
                                        class="album-cover">
                                <?php else: ?>
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 100%;">
                                        <i class="fas fa-folder-open fa-4x text-secondary"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="position-absolute bottom-0 end-0 p-2">
                                    <span class="badge bg-dark">
                                        <i class="fas fa-image me-1"></i> <?= $album['total'] ?? 0 ?> foto
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-dark mb-2">
                                    <?= esc($album['album']) ?>
                                </h5>
                                <p class="card-text text-muted small mb-0">
                                    <i class="far fa-calendar-alt"></i>
                                    <?= isset($album['created_at']) ? date('d M Y', strtotime($album['created_at'])) : 'Baru saja' ?>
                                </p>
                                <div class="mt-2 text-primary small">
                                    Klik untuk lihat semua <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="fas fa-folder-open fa-4x text-muted mb-3 d-block"></i>
                <h5 class="text-muted">Belum ada album</h5>
                <p class="text-muted">Mulai dengan menambahkan foto ke galeri</p>
                <a href="<?= base_url('admin/gallery/create') ?>" class="btn btn-primary mt-2">
                    <i class="fas fa-plus-circle"></i> Tambah Foto Pertama
                </a>
            </div>
        </div>
    <?php endif; ?>

</div>

<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .album-cover:hover {
        transform: scale(1.05);
    }
</style>

<?= $this->endSection() ?>