<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Album Galeri</h2>
        <a href="<?= base_url('admin/gallery/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Foto
        </a>
    </div>

    <div class="row g-4">
        <?php if(!empty($albums)): ?>
            <?php foreach($albums as $album): ?>
                <div class="col-md-4">
                    <a href="<?= base_url('admin/gallery/album/'.$album['album']) ?>" class="text-decoration-none">
                        <div class="card shadow-sm border-0 h-100 text-center p-3">
                            <div class="fs-2 text-primary mb-2">
                                <i class="bi bi-folder"></i>
                            </div>
                            <h5 class="fw-bold"><?= esc($album['album']) ?></h5>
                            <small class="text-muted">Klik untuk lihat foto</small>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada album.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>