<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 2px solid #e5e7eb;
}

.page-header-left h1 {
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 4px;
}

.page-header-left p {
    font-size: 14px;
    color: #6b7280;
}

.btn-add {
    background: linear-gradient(135deg, #2d7d3a, #1f5a29);
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(45, 125, 58, 0.3);
    color: white;
}

.panel {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.panel-header {
    background: linear-gradient(135deg, #f9fafb, #f3f4f6);
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 12px;
}

.panel-title {
    font-size: 16px;
    font-weight: 600;
    color: #1f2937;
    display: flex;
    align-items: center;
    gap: 8px;
}

.panel-title i {
    color: #2d7d3a;
    font-size: 18px;
}

.panel-body {
    padding: 0;
}

.table-wrapper {
    overflow-x: auto;
}

.table {
    margin-bottom: 0;
}

.table thead {
    background: #f9fafb;
}

.table thead th {
    font-size: 12px;
    font-weight: 700;
    color: #1f2937;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 16px;
    border-bottom: 2px solid #e5e7eb;
}

.table tbody td {
    padding: 16px;
    border-bottom: 1px solid #f3f4f6;
    color: #4b5563;
}

.table tbody tr:hover {
    background: #f9fafb;
}

.trip-title {
    font-weight: 600;
    color: #1f2937;
}

.trip-location {
    font-size: 13px;
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 4px;
}

.price-value {
    font-weight: 700;
    color: #2d7d3a;
    font-size: 14px;
}

.status-badge {
    font-size: 12px;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 6px;
    display: inline-block;
}

.status-active {
    background: #dcfce7;
    color: #166534;
}

.status-full {
    background: #fef3c7;
    color: #92400e;
}

.status-cancelled {
    background: #fee2e2;
    color: #991b1b;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-action {
    padding: 8px 14px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.2s ease;
}

.btn-edit {
    background: #fef08a;
    color: #854d0e;
}

.btn-edit:hover {
    background: #fde047;
    color: #663c9e;
}

.btn-delete {
    background: #fee2e2;
    color: #991b1b;
}

.btn-delete:hover {
    background: #fecaca;
    color: #7f1d1d;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state i {
    font-size: 48px;
    color: #d1d5db;
    margin-bottom: 16px;
}

.empty-state p {
    color: #9ca3af;
    font-size: 14px;
}

.alert-custom {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #065f46;
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.alert-custom i {
    color: #059669;
    font-size: 18px;
}
</style>

<div class="page-header">
    <div class="page-header-left">
        <h1>Kelola Trip</h1>
        <p>Tambah, edit, atau hapus trip untuk platform BLNTRK OUTDOOR</p>
    </div>
    <a href="<?= base_url('admin/trips/create') ?>" class="btn-add">
        <i class="fas fa-plus"></i> Tambah Trip Baru
    </a>
</div>

<!-- Notifikasi -->
<?php if(session()->getFlashdata('success')): ?>
    <div class="alert-custom">
        <i class="fas fa-check-circle"></i>
        <span><?= session()->getFlashdata('success') ?></span>
    </div>
<?php endif; ?>

<div class="panel">
    <div class="panel-header">
        <span class="panel-title"><i class="fas fa-list"></i> Daftar Trip</span>
    </div>

    <div class="panel-body">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Trip</th>
                        <th>Lokasi</th>
                        <th width="150">Harga</th>
                        <th width="120">Status</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(!empty($trips)): ?>

                    <?php $no = 1; ?>

                    <?php foreach($trips as $trip): ?>

                    <tr>
                        <td><?= $no++ ?></td>

                        <td>
                            <div class="trip-title"><?= esc($trip['title']) ?></div>
                        </td>

                        <td>
                            <div class="trip-location">
                                <i class="fas fa-map-marker-alt" style="font-size:12px;"></i>
                                <?= esc($trip['location']) ?>
                            </div>
                        </td>

                        <td>
                            <div class="price-value">Rp <?= number_format($trip['price'],0,',','.') ?></div>
                        </td>

                        <td>
                            <?php if($trip['status'] == 'active'): ?>
                                <span class="status-badge status-active">
                                    <i class="fas fa-check-circle"></i> Active
                                </span>
                            <?php elseif($trip['status'] == 'full'): ?>
                                <span class="status-badge status-full">
                                    <i class="fas fa-exclamation-circle"></i> Full
                                </span>
                            <?php else: ?>
                                <span class="status-badge status-cancelled">
                                    <i class="fas fa-times-circle"></i> Cancelled
                                </span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('admin/trips/edit/'.$trip['trip_id']) ?>" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <a href="<?= base_url('admin/trips/delete/'.$trip['trip_id']) ?>" 
                                   class="btn-action btn-delete"
                                   onclick="return confirm('Yakin ingin menghapus trip ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </td>

                    </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada data trip</p>
                            </div>
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>