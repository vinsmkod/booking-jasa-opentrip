<?= $this->extend('layouts/admin') ?>

<?= $this->section('breadcrumb') ?>
<a href="<?= base_url('admin/users') ?>">Pengguna</a>
<span>/</span>
<span class="crumb-active">Tambah User</span>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
.form-group {
    margin-bottom: 24px;
}
.form-label {
    display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px;
    color: var(--txt); text-transform: uppercase; letter-spacing: 0.3px;
}
.form-input, .form-select, .form-textarea {
    width: 100%; padding: 10px 12px; font-size: 13px;
    border: 1px solid var(--border); border-radius: 6px;
    background: var(--surface); color: var(--txt);
    font-family: var(--font); outline: none; transition: all 0.2s;
}
.form-input:focus, .form-select:focus, .form-textarea:focus {
    border-color: #4338ca; box-shadow: 0 0 0 3px #eef2ff;
}
.form-help {
    font-size: 11px; color: var(--txt3); margin-top: 4px;
}
.form-submit {
    display: flex; gap: 8px; justify-content: flex-end; margin-top: 32px; padding-top: 24px;
    border-top: 1px solid var(--border);
}
.avatar-preview {
    width: 80px; height: 80px; border-radius: 8px;
    background: #eef2ff; display: flex; align-items: center; justify-content: center;
    font-size: 32px; color: #4338ca; overflow: hidden;
}
.avatar-preview img {
    width: 100%; height: 100%; object-fit: cover;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1>Tambah User Baru</h1>
        <p>Buat akun pengguna baru untuk sistem</p>
    </div>
    <a href="<?= base_url('admin/users') ?>" class="btn-sm btn-cancel">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
<?php endif; ?>

<div class="panel">
    <div class="panel-header">
        <span class="panel-title"><i class="fas fa-user-plus"></i> Form Input Data Pengguna</span>
    </div>
    
    <form action="/admin/users/store" method="post" enctype="multipart/form-data" style="padding: 24px;">
        
        <!-- Nama -->
        <div class="form-group">
            <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap</label>
            <input type="text" name="name" class="form-input" placeholder="Masukkan nama lengkap" required>
            <div class="form-help">Gunakan nama lengkap sesuai identitas resmi</div>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" class="form-input" placeholder="nama@email.com" required>
            <div class="form-help">Email akan digunakan untuk login dan komunikasi</div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label class="form-label"><i class="fas fa-lock"></i> Password</label>
            <input type="password" name="password" class="form-input" id="password" placeholder="Minimal 8 karakter" minlength="8" required>
            <div class="form-help">Gunakan password yang kuat dengan kombinasi huruf, angka, dan simbol</div>
        </div>

        <!-- Role -->
        <div class="form-group">
            <label class="form-label"><i class="fas fa-shield-alt"></i> Role</label>
            <select name="role" class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
            </select>
            <div class="form-help">Role admin memiliki akses penuh, customer memiliki akses terbatas</div>
        </div>

        <!-- Avatar -->
        <div class="form-group">
            <label class="form-label"><i class="fas fa-image"></i> Avatar (Opsional)</label>
            <div style="display: flex; gap: 16px; align-items: flex-start;">
                <div>
                    <input type="file" name="avatar" class="form-input" id="avatar" accept="image/*" style="cursor: pointer;">
                    <div class="form-help">Format: JPG, PNG (Max 2MB)</div>
                </div>
                <div class="avatar-preview" id="avatarPreview">
                    <i class="fas fa-image"></i>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="form-submit">
            <a href="<?= base_url('admin/users') ?>" class="btn-sm btn-cancel">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="btn-sm btn-confirm">
                <i class="fas fa-save"></i> Simpan User
            </button>
        </div>

    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('avatar')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('avatarPreview');
    
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.innerHTML = '<img src="' + event.target.result + '" alt="avatar">';
        };
        reader.readAsDataURL(file);
    }
});
</script>
<?= $this->endSection() ?>