<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    .auth-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 50%, #f0fdf4 100%);
        padding: 20px;
    }

    .auth-card {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
        max-width: 450px;
        width: 100%;
    }

    .auth-header {
        margin-bottom: 32px;
        text-align: center;
    }

    .auth-header h2 {
        font-size: 1.8rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .btn-submit {
        width: 100%;
        padding: 14px 16px;
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
    }

    .alert {
        padding: 14px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }
    .alert-danger { background: #fee2e2; color: #7f1d1d; }
</style>

<section class="auth-section">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Reset Password</h2>
            <p class="text-muted">Masukkan password baru untuk akun Anda</p>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('reset-password') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="token" value="<?= $token ?>">

            <div class="mb-3">
                <label class="form-label fw-bold small text-uppercase">Password Baru</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required minlength="6">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-uppercase">Konfirmasi Password</label>
                <input type="password" id="confirm_password" class="form-control" placeholder="••••••••" required minlength="6">
                <div id="passwordError" class="text-danger small mt-1" style="display:none;">Password tidak cocok</div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">Update Password</button>
        </form>
    </div>
</section>

<script>
    const password = document.getElementById('password');
    const confirm_password = document.getElementById('confirm_password');
    const error = document.getElementById('passwordError');
    const submitBtn = document.getElementById('submitBtn');

    function validate() {
        if(password.value !== confirm_password.value) {
            error.style.display = 'block';
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.5';
        } else {
            error.style.display = 'none';
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
        }
    }

    password.addEventListener('input', validate);
    confirm_password.addEventListener('input', validate);
</script>

<?= $this->endSection() ?>
