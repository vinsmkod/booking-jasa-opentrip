<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Galeri Foto</h2>
        <a href="<?= base_url('admin/gallery/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Foto
        </a>
    </div>

    <form method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Cari judul foto..." value="<?= esc($keyword) ?>">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </div>
    </form>

    <div class="row g-4">
        <?php if(!empty($galleries)): ?>
            <?php foreach($galleries as $gallery): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="overflow-hidden">
                            <img src="<?= base_url('uploads/gallery/'.$gallery['image']) ?>" 
                                 class="card-img-top"
                                 style="height:220px; object-fit:cover;"
                                 alt="<?= esc($gallery['title']) ?>">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= esc($gallery['title']) ?></h5>
                            <small class="text-muted"><?= esc($gallery['album']) ?></small>
                            <div class="mt-2">
                                <a href="<?= base_url('admin/gallery/edit/'.$gallery['gallery_id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= base_url('admin/gallery/delete/'.$gallery['gallery_id']) ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin hapus foto ini?')">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada foto.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-4">
        <?= $pager->links() ?>
    </div>
</div>

<?= $this->endSection() ?>