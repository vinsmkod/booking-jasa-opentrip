<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="mb-4">Manage About Page</h1>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <h3><?= esc($about['title']) ?></h3>
            <p><?= esc($about['content']) ?></p>
            <a href="<?= base_url('admin/about/edit') ?>" class="btn btn-primary mt-3">Edit About</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>