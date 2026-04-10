<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Kelola Trip</h4>
        <p class="text-muted small mb-0">Tambah, edit, atau hapus trip untuk platform BLNTRK OUTDOOR</p>
    </div>
    <a href="<?= base_url('admin/trips/create') ?>" class="btn btn-success">
        <i class="fas fa-plus me-2"></i>Tambah Trip Baru
    </a>
</div>

<!-- Notifikasi -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Tabel -->
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">
        <i class="fas fa-list me-2 text-success"></i>Daftar Trip
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Trip</th>
                        <th>Lokasi</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($trips)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($trips as $trip): ?>
                            <tr>
                                <td class="text-muted"><?= $no++ ?></td>
                                <td class="fw-semibold"><?= esc($trip['title']) ?></td>
                                <td class="text-muted small">
                                    <i class="fas fa-map-marker-alt me-1 text-danger"></i><?= esc($trip['location']) ?>
                                </td>
                                <td class="fw-semibold text-success">
                                    Rp <?= number_format($trip['price'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?php if ($trip['status'] == 'active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php elseif ($trip['status'] == 'full'): ?>
                                        <span class="badge bg-warning text-dark">Full</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Cancelled</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/trips/edit/' . $trip['trip_id']) ?>" class="btn btn-warning btn-sm me-1">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <a href="<?= base_url('admin/trips/delete/' . $trip['trip_id']) ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Yakin ingin menghapus trip ini?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Belum ada data trip
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>