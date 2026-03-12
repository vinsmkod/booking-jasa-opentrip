<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Kelola Trip</h3>

        <a href="<?= base_url('admin/trips/create') ?>" class="btn btn-primary">
            + Tambah Trip
        </a>
    </div>

    <!-- Notifikasi -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="60">No</th>
                        <th>Judul</th>
                        <th>Lokasi</th>
                        <th width="160">Harga</th>
                        <th width="120">Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php if(!empty($trips)): ?>

                    <?php $no = 1; ?>

                    <?php foreach($trips as $trip): ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td>
                            <strong><?= esc($trip['title']) ?></strong>
                        </td>

                        <td>
                            <?= esc($trip['location']) ?>
                        </td>

                        <td>
                            <span class="text-success fw-semibold">
                                Rp <?= number_format($trip['price'],0,',','.') ?>
                            </span>
                        </td>

                        <td>
                            <?php if($trip['status'] == 'active'): ?>

                                <span class="badge bg-success">
                                    Active
                                </span>

                            <?php elseif($trip['status'] == 'full'): ?>

                                <span class="badge bg-warning text-dark">
                                    Full
                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">
                                    Cancelled
                                </span>

                            <?php endif; ?>
                        </td>

                        <td>

                            <a href="<?= base_url('admin/trips/edit/'.$trip['trip_id']) ?>"
                               class="btn btn-sm btn-warning">
                               Edit
                            </a>

                            <a href="<?= base_url('admin/trips/delete/'.$trip['trip_id']) ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin menghapus trip ini?')">
                               Hapus
                            </a>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
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