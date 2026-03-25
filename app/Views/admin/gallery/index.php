<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Kelola Galeri</h3>
            <p class="text-muted mb-0">Kelola foto dan album galeri</p>
        </div>
        <div>
            <a href="<?= base_url('admin/gallery/create') ?>" class="btn btn-primary me-2">
                <i class="fas fa-plus-circle"></i> Tambah Foto
            </a>
            <a href="<?= base_url('admin/gallery/albums') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-folder-open"></i> Lihat Album
            </a>
        </div>
    </div>

    <!-- Notifikasi -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 bg-primary bg-opacity-10">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-primary mb-1">Total Foto</h6>
                            <h2 class="fw-bold mb-0"><?= $totalPhotos ?? 0 ?></h2>
                            <small class="text-muted">Seluruh foto dalam database</small>
                        </div>
                        <i class="fas fa-images fa-3x text-primary opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 bg-success bg-opacity-10">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-success mb-1">Total Album</h6>
                            <h2 class="fw-bold mb-0"><?= $totalAlbums ?? 0 ?></h2>
                            <small class="text-muted">Album unik yang tersedia</small>
                        </div>
                        <i class="fas fa-folder-tree fa-3x text-success opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 bg-info bg-opacity-10">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-info mb-1">Foto Halaman Ini</h6>
                            <h2 class="fw-bold mb-0"><?= count($galleries) ?></h2>
                            <small class="text-muted">Dari <?= $pager->getTotal() ?? count($galleries) ?> total</small>
                        </div>
                        <i class="fas fa-camera fa-3x text-info opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="get" class="row g-3">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text"
                            name="keyword"
                            class="form-control border-start-0 ps-0"
                            placeholder="Cari berdasarkan judul foto..."
                            value="<?= esc($keyword ?? '') ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
                <?php if (!empty($keyword)): ?>
                    <div class="col-12">
                        <a href="<?= base_url('admin/gallery') ?>" class="text-decoration-none small">
                            <i class="fas fa-times-circle"></i> Reset pencarian
                        </a>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Tabel Foto -->
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="60">No</th>
                        <th width="80">Foto</th>
                        <th>Judul</th>
                        <th>Album</th>
                        <th width="120">Tanggal Upload</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($galleries)): ?>

                        <?php
                        $perPage = $pager->getPerPage();
                        $currentPage = $pager->getCurrentPage();
                        $no = ($currentPage - 1) * $perPage + 1;
                        ?>

                        <?php foreach ($galleries as $gallery): ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <img src="<?= base_url('uploads/gallery/' . $gallery['image']) ?>"
                                        alt="<?= esc($gallery['title']) ?>"
                                        style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;"
                                        class="shadow-sm">
                                </td>
                                <td>
                                    <strong><?= esc($gallery['title']) ?></strong>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <i class="fas fa-folder-open"></i> <?= esc($gallery['album'] ?? 'Tanpa Album') ?>
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="far fa-calendar-alt"></i> <?= date('d M Y', strtotime($gallery['created_at'])) ?>
                                    </small>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/gallery/edit/' . $gallery['gallery_id']) ?>"
                                        class="btn btn-sm btn-warning me-1"
                                        data-bs-toggle="tooltip"
                                        title="Edit Foto">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('admin/gallery/delete/' . $gallery['gallery_id']) ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus foto ini?')"
                                        data-bs-toggle="tooltip"
                                        title="Hapus Foto">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="fas fa-images fa-3x mb-3 d-block text-secondary"></i>
                                <?= !empty($keyword) ? "Tidak ada foto untuk pencarian \"" . esc($keyword) . "\"" : "Belum ada foto dalam galeri" ?>
                                <br>
                                <a href="<?= base_url('admin/gallery/create') ?>" class="btn btn-sm btn-primary mt-3">
                                    <i class="fas fa-plus-circle"></i> Tambah Foto Sekarang
                                </a>
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

            <!-- Pagination -->
            <?php if (!empty($galleries) && isset($pager)): ?>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted small">
                        <i class="fas fa-info-circle"></i> Menampilkan <?= count($galleries) ?> dari <?= $pager->getTotal() ?> foto
                    </div>
                    <div>
                        <?= $pager->links('default', 'bootstrap') ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>

<script>
    // Tooltip initialization
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<?= $this->endSection() ?>