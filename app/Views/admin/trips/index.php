<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
<style>
    /* PAGINATION */
    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        margin: 0;
        gap: 5px;
    }

    .pagination li {
        margin: 0;
    }

    .pagination li a, .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 500;
        color: var(--txt2);
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.2s;
        min-width: 32px;
    }

    .pagination li a:hover {
        background-color: #f1f5f9;
        border-color: #cbd5e1;
        color: var(--txt);
    }

    .pagination li.active a, .pagination li.active span {
        background-color: var(--accent);
        color: white;
        border-color: var(--accent);
    }

    .pagination li.disabled a, .pagination li.disabled span {
        color: var(--txt3);
        background-color: var(--surface2);
        pointer-events: none;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h4 class="fw-bold mb-1">Kelola Trip</h4>
        <p class="text-muted small mb-0">Tambah, edit, atau hapus trip untuk platform BLNTRK OUTDOOR</p>
    </div>
    <div class="page-header-right" style="display:flex; gap:12px; align-items:center;">
        <form action="" method="get" style="display:flex; gap:8px;">
            <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Cari Trip, Lokasi..." style="padding:8px 12px; border:1px solid var(--border); border-radius:6px; font-size:13px; outline:none; min-width:250px;">
            <button type="submit" style="padding:8px 16px; background:var(--accent); color:#fff; border:none; border-radius:6px; cursor:pointer; font-size:13px;"><i class="fas fa-search"></i> Cari</button>
            <?php if (!empty($search)): ?>
                <a href="<?= base_url('admin/trips') ?>" style="padding:8px 16px; background:var(--surface2); color:var(--txt); border:1px solid var(--border); border-radius:6px; text-decoration:none; display:flex; align-items:center; font-size:13px;"><i class="fas fa-times"></i></a>
            <?php endif; ?>
        </form>
        <a href="<?= base_url('admin/trips/create') ?>" style="padding:8px 16px; background:var(--accent); color:#fff; border:none; border-radius:6px; text-decoration:none; display:flex; align-items:center; font-size:13px;"><i class="fas fa-plus" style="margin-right:8px;"></i> Tambah Trip</a>
    </div>
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
                        <?php 
                            $currentPage = isset($pager) ? $pager->getCurrentPage('trips') : 1;
                            $no = 1 + (10 * ($currentPage - 1)); 
                        ?>
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
    <?php if (isset($pager)): ?>
        <div class="card-footer bg-white d-flex justify-content-center pt-4 pb-3 border-top-0">
            <?= $pager->links('trips', 'default_full') ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>