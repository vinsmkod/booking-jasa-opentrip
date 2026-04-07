<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <h2 class="fw-bold mb-4">Tambah User Baru</h2>

    <form action="/admin/users/store" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select" required>
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Avatar</label>
            <input type="file" name="avatar" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/admin/users" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection() ?>