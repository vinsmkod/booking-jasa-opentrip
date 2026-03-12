<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <h2 class="fw-bold mb-4">Album: <?= esc($albumName) ?></h2>
    <a href="<?= base_url('admin/gallery/albums') ?>" class="btn btn-secondary mb-3">Kembali ke Album</a>

    <div class="row g-4">
        <?php if(!empty($photos)): ?>
            <?php foreach($photos as $photo): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="overflow-hidden">
                            <img src="<?= base_url('uploads/gallery/'.$photo['image']) ?>" 
                                 class="card-img-top"
                                 style="height:220px; object-fit:cover;"
                                 alt="<?= esc($photo['title']) ?>">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= esc($photo['title']) ?></h5>
                            <small class="text-muted"><?= date('d M Y', strtotime($photo['created_at'])) ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada foto di album ini.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-4">
        <?= $pager->links() ?>
    </div>
</div>

<?= $this->endSection() ?>