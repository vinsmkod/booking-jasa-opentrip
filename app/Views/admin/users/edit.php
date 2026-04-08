<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --color-primary: #2d7d3a;
        --color-primary-dark: #1f5a29;
        --color-accent: #c4603a;
        --txt-primary: #1f2937;
        --txt-secondary: #4b5563;
        --txt-light: #9ca3af;
        --border-color: #e5e7eb;
        --bg-light: #f9fafb;
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border-color);
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--txt-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-title i {
        color: var(--color-primary);
        font-size: 28px;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        padding: 32px;
        max-width: 700px;
    }

    .form-section {
        margin-bottom: 28px;
    }

    .form-section-title {
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--txt-secondary);
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--txt-primary);
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .form-group label .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-control, .form-select {
        border: 1.5px solid var(--border-color);
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        color: var(--txt-primary);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(45, 125, 58, 0.1);
        outline: none;
    }

    .form-text {
        font-size: 12px;
        color: var(--txt-light);
        margin-top: 4px;
        display: block;
    }

    .avatar-wrapper {
        padding: 16px;
        background: var(--bg-light);
        border-radius: 8px;
        border: 1.5px dashed var(--border-color);
        margin-top: 8px;
        transition: all 0.3s ease;
    }

    .avatar-wrapper:hover {
        border-color: var(--color-primary);
        background: rgba(45, 125, 58, 0.03);
    }

    .avatar-preview {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-top: 12px;
    }

    .avatar-image {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid var(--border-color);
    }

    .avatar-info {
        font-size: 13px;
        color: var(--txt-secondary);
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--border-color);
    }

    .btn-primary-custom {
        background: var(--color-primary);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary-custom:hover {
        background: var(--color-primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 12px rgba(45, 125, 58, 0.25);
        color: white;
    }

    .btn-secondary-custom {
        background: var(--bg-light);
        color: var(--txt-primary);
        padding: 10px 20px;
        border: 1.5px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-secondary-custom:hover {
        background: white;
        border-color: var(--txt-primary);
        color: var(--txt-primary);
    }
</style>

<div style="padding: 40px 60px;">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-user-edit"></i>
            Edit Pengguna
        </h1>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="/admin/users/update/<?= $user['user_id'] ?>" method="post" enctype="multipart/form-data" novalidate>

            <!-- Section: Informasi Dasar -->
            <div class="form-section">
                <div class="form-section-title">Informasi Dasar</div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-user" style="color: var(--color-primary); margin-right: 6px;"></i>
                        Nama Lengkap
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-envelope" style="color: var(--color-primary); margin-right: 6px;"></i>
                        Email
                        <span class="required">*</span>
                    </label>
                    <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" placeholder="nama@contoh.com" required>
                    <span class="form-text">Email akan digunakan untuk login</span>
                </div>
            </div>

            <!-- Section: Keamanan -->
            <div class="form-section">
                <div class="form-section-title">Keamanan</div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-lock" style="color: var(--color-primary); margin-right: 6px;"></i>
                        Password
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Biarkan kosong jika tidak mengubah">
                    <span class="form-text">Kosongkan untuk mempertahankan password saat ini</span>
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-shield-alt" style="color: var(--color-primary); margin-right: 6px;"></i>
                        Role / Hak Akses
                        <span class="required">*</span>
                    </label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="customer" <?= $user['role'] == 'customer' ? 'selected' : '' ?>>Customer</option>
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>
            </div>

            <!-- Section: Avatar & Profil -->
            <div class="form-section">
                <div class="form-section-title">Avatar & Profil</div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-image" style="color: var(--color-primary); margin-right: 6px;"></i>
                        Foto Profil
                    </label>
                    <div class="avatar-wrapper">
                        <input type="file" name="avatar" class="form-control" accept="image/*">
                        <span class="form-text">Format: JPG, PNG. Ukuran maksimal: 2MB</span>
                    </div>

                    <?php if (!empty($user['avatar'])): ?>
                        <div class="avatar-preview">
                            <img src="<?= base_url('writable/uploads/' . esc($user['avatar'])) ?>" alt="Avatar" class="avatar-image">
                            <div class="avatar-info">
                                <strong>Foto Profil Saat Ini</strong><br>
                                <small><?= esc($user['avatar']) ?></small>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
                <a href="/admin/users" class="btn-secondary-custom">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>