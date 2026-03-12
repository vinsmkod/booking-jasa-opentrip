<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">
    <h2 class="fw-bold mb-4">Tambah Foto Galeri</h2>
    <a href="<?= base_url('admin/gallery') ?>" class="btn btn-secondary mb-3">Kembali</a>

    <form action="<?= base_url('admin/gallery/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Album</label>
            <input type="text" name="album" class="form-control" placeholder="Contoh: Dokumentasi Gunung Merbabu" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Foto</label>
            <input type="text" name="title" class="form-control" placeholder="Judul foto" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Foto (bisa multiple)</label>
            <input type="file" name="images[]" class="form-control" multiple required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

<?= $this->endSection() ?>