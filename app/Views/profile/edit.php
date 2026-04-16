<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .profile-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
        overflow: hidden;
        border: 1px solid #f1f5f9;
    }
    .profile-header {
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        height: 120px;
        position: relative;
    }
    .avatar-wrapper {
        position: absolute;
        bottom: -50px;
        left: 50%;
        transform: translateX(-50%);
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid white;
        background: #f8fafc;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .avatar-upload-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.5);
        color: white;
        text-align: center;
        padding: 5px 0;
        font-size: 10px;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .avatar-wrapper:hover .avatar-upload-label {
        opacity: 1;
    }
    .form-section {
        padding: 70px 40px 40px;
    }
    .form-label {
        font-weight: 600;
        color: #475569;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    .form-control {
        border-radius: 12px;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: #2d7d3a;
        box-shadow: 0 0 0 4px rgba(45, 125, 58, 0.1);
    }
    .btn-update {
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        color: white;
        border: none;
        padding: 14px;
        border-radius: 12px;
        font-weight: 600;
        width: 100%;
        margin-top: 20px;
        transition: transform 0.2s;
    }
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(45, 125, 58, 0.2);
    }
</style>

<div class="row justify-content-center py-5">
    <div class="col-md-6">
        <div class="profile-card">
            <div class="profile-header">
                <div class="avatar-wrapper">
                    <?php 
                        $avatarUrl = !empty($user['avatar']) 
                            ? base_url('uploads/avatars/'.$user['avatar']) 
                            : 'https://ui-avatars.com/api/?name='.urlencode($user['name']).'&background=2d7d3a&color=fff&size=200';
                    ?>
                    <img src="<?= $avatarUrl ?>" id="avatarPreview" class="avatar-img" alt="Avatar">
                    <label for="avatarInput" class="avatar-upload-label">
                        <i class="fas fa-camera"></i> Ganti Foto
                    </label>
                </div>
            </div>

            <div class="form-section">
                <h3 class="text-center fw-bold mb-4"><?= esc($user['name']) ?></h3>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger mb-4"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success mb-4 text-center"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="file" id="avatarInput" name="avatar" style="display:none;" accept="image/*">

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email (Tidak bisa diubah)</label>
                        <input type="email" class="form-control bg-light" value="<?= esc($user['email']) ?>" readonly disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="phone" class="form-control" value="<?= esc($user['phone'] ?? '') ?>" placeholder="08xxxxxxxxx">
                    </div>

                    <button type="submit" class="btn-update">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                    
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-link w-100 mt-2 text-decoration-none text-muted small">
                        Kembali ke Dashboard
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>

<?= $this->endSection() ?>
