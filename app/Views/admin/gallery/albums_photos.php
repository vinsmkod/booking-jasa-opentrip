<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">
                <i class="fas fa-folder-open text-primary me-2"></i>
                Album: <?= esc($albumName) ?>
            </h3>
            <p class="text-muted mb-0">
                <i class="fas fa-image me-1"></i> <?= count($photos) ?> foto dalam album ini
            </p>
        </div>
        <div>
            <a href="<?= base_url('admin/gallery/albums') ?>" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Album
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

    <?php if (!empty($photos)): ?>
        <div class="row">
            <?php foreach ($photos as $photo): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm border-0 h-100 transition">
                        <div class="position-relative" style="height: 200px; overflow: hidden;">
                            <img src="<?= base_url('uploads/gallery/' . $photo['image']) ?>"
                                alt="<?= esc($photo['title']) ?>"
                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;"
                                class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title fw-bold mb-2">
                                <?= esc($photo['title']) ?>
                            </h6>
                            <p class="card-text text-muted small mb-3">
                                <i class="far fa-calendar-alt"></i>
                                <?= date('d M Y, H:i', strtotime($photo['created_at'])) ?>
                            </p>
                            <div class="d-flex gap-2">
                                <a href="<?= base_url('admin/gallery/edit/' . $photo['gallery_id']) ?>"
                                    class="btn btn-sm btn-warning flex-grow-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/gallery/delete/' . $photo['gallery_id']) ?>"
                                    class="btn btn-sm btn-danger flex-grow-1"
                                    onclick="return confirm('Yakin ingin menghapus foto ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if (isset($pager) && $pager->getTotal() > $pager->getPerPage()): ?>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    <i class="fas fa-info-circle"></i> Menampilkan <?= count($photos) ?> dari <?= $pager->getTotal() ?> foto
                </div>
                <div>
                    <?= $pager->links('default', 'bootstrap') ?>
                </div>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="fas fa-images fa-4x text-muted mb-3 d-block"></i>
                <h5 class="text-muted">Belum ada foto dalam album ini</h5>
                <p class="text-muted">Tambahkan foto ke album <?= esc($albumName) ?></p>
                <a href="<?= base_url('admin/gallery/create') ?>" class="btn btn-primary mt-2">
                    <i class="fas fa-plus-circle"></i> Tambah Foto
                </a>
            </div>
        </div>
    <?php endif; ?>

</div>

<style>
    .transition {
        transition: all 0.3s ease;
    }

    .transition:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .card-img-top:hover {
        transform: scale(1.05);
    }
</style>

<?= $this->endSection() ?>