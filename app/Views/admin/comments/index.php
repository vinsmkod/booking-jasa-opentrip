<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Kelola Komentar</h3>
            <small class="text-muted">Moderasi komentar dari pengguna</small>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Trip</th>
                            <th>Komentar</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($comments)): ?>
                            <?php $no=1; foreach($comments as $c): ?>

                            <tr>
                                <td><?= $no++ ?></td>

                                <td>
                                    <strong><?= esc($c['name']) ?></strong><br>
                                    <small class="text-muted"><?= esc($c['email']) ?></small>
                                </td>

                                <td>
                                    <span class="badge bg-info">
                                        <?= esc($c['title']) ?>
                                    </span>
                                </td>

                                <td style="max-width:300px">
                                    <?= esc($c['comment']) ?>
                                </td>

                                <td>
                                    <?php if($c['status']=='approved'): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php elseif($c['status']=='rejected'): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?= date('d M Y', strtotime($c['created_at'])) ?>
                                </td>

                                <td>

                                    <?php if($c['status']=='pending'): ?>

                                        <a href="/admin/comments/approve/<?= $c['comment_id'] ?>" 
                                           class="btn btn-success btn-sm">
                                            Approve
                                        </a>

                                        <a href="/admin/comments/reject/<?= $c['comment_id'] ?>" 
                                           class="btn btn-warning btn-sm">
                                            Reject
                                        </a>

                                    <?php endif; ?>

                                    <a href="/admin/comments/delete/<?= $c['comment_id'] ?>" 
                                       onclick="return confirm('Hapus komentar ini?')"
                                       class="btn btn-danger btn-sm">
                                        Hapus
                                    </a>

                                </td>
                            </tr>

                            <?php endforeach; ?>
                        <?php else: ?>

                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Belum ada komentar
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>