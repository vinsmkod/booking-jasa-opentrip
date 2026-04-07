<?= $this->extend('layouts/admin') ?>
<?= view('layouts/admin'); ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <h2 class="fw-bold mb-4">Edit User</h2>

    <form action="/admin/users/update/<?= $user['user_id'] ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Password (kosongkan jika tidak ingin diganti)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select" required>
                <option value="customer" <?= $user['role']=='customer'?'selected':'' ?>>Customer</option>
                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Avatar</label>
            <input type="file" name="avatar" class="form-control">
            <?php if(!empty($user['avatar'])): ?>
                <img src="<?= base_url('writable/uploads/'.$user['avatar']) ?>" width="50" class="mt-2 rounded-circle">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/admin/users" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection() ?>