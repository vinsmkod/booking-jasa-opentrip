<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manajemen User</h2>
        <a href="/admin/users/create" class="btn btn-primary">Tambah User</a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Points</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user['user_id'] ?></td>
                    <td>
                        <?php if(!empty($user['avatar'])): ?>
                            <img src="<?= base_url('writable/uploads/'.$user['avatar']) ?>" width="40" class="rounded-circle">
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td><?= esc($user['name']) ?></td>
                    <td><?= esc($user['email']) ?></td>
                    <td><?= esc($user['role']) ?></td>
                    <td><?= esc($user['points']) ?></td>
                    <td>
                        <a href="/admin/users/edit/<?= $user['user_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="/admin/users/delete/<?= $user['user_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>