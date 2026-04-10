<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    .auth-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 50%, #f0fdf4 100%);
        padding: 20px;
        position: relative;
        overflow: hidden;
    }

    /* Decorative circles background */
    .auth-section::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, rgba(45, 125, 58, 0.1) 0%, rgba(45, 125, 58, 0) 100%);
        border-radius: 50%;
        top: -100px;
        right: -100px;
        z-index: 0;
    }

    .auth-section::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, rgba(45, 125, 58, 0.08) 0%, rgba(45, 125, 58, 0) 100%);
        border-radius: 50%;
        bottom: -100px;
        left: -100px;
        z-index: 0;
    }

    .auth-card {
        position: relative;
        z-index: 1;
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
        width: 100%;
        max-width: 480px;
    }

    .auth-header {
        margin-bottom: 32px;
    }

    .auth-header h2 {
        font-size: 1.8rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .auth-header p {
        font-size: 0.9rem;
        color: #64748b;
        margin: 0;
    }

    /* Alert Messages */
    .alert {
        padding: 14px 16px;
        border-radius: 10px;
        font-size: 0.85rem;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border: none;
    }

    .alert i {
        font-size: 1rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #7f1d1d;
    }

    .alert-danger i {
        color: #dc2626;
    }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
    }

    .alert-success i {
        color: #059669;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .form-grid.full {
        grid-template-columns: 1fr;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 12px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        color: #0f172a;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #2d7d3a;
        box-shadow: 0 0 0 3px rgba(45, 125, 58, 0.1);
        background: white;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    /* Button */
    .btn-submit {
        width: 100%;
        padding: 14px 16px;
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 24px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(45, 125, 58, 0.3);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Divider */
    .divider {
        position: relative;
        margin: 28px 0;
        text-align: center;
        color: #94a3b8;
        font-size: 0.8rem;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e2e8f0;
    }

    .divider span {
        position: relative;
        background: white;
        padding: 0 8px;
    }

    /* Register Link */
    .auth-footer {
        text-align: center;
        margin-top: 24px;
        font-size: 0.85rem;
        color: #475569;
    }

    .auth-footer a {
        color: #2d7d3a;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .auth-footer a:hover {
        color: #1f5428;
        text-decoration: underline;
    }

    /* Password Requirements */
    .password-requirements {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px;
        font-size: 0.8rem;
        color: #475569;
        margin-top: 12px;
        line-height: 1.6;
    }

    .password-requirements strong {
        color: #0f172a;
        display: block;
        margin-bottom: 6px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .auth-card {
            padding: 28px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .auth-header h2 {
            font-size: 1.4rem;
        }

        .auth-section {
            padding: 16px;
        }
    }
</style>

<section class="auth-section">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Buat Akun Baru</h2>
            <p>Daftar untuk memulai perjalanan adventure-mu bersama OpenTrip</p>
        </div>

        <!-- Flash message -->
        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                <?php
                foreach(session()->getFlashdata('error') as $e) {
                    echo '<span style="display: block;">' . esc($e) . '</span>';
                }
                ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span><?= esc(session()->getFlashdata('success')) ?></span>
        </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('register') ?>">
            <?= csrf_field() ?>

            <!-- Full Name -->
            <div class="form-group form-grid full">
                <div>
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text"
                        name="name"
                        class="form-control"
                        value="<?= old('name') ?>"
                        placeholder="Masukkan nama lengkap"
                        required
                        autocomplete="name">
                </div>
            </div>

            <!-- Email -->
            <div class="form-group form-grid full">
                <div>
                    <label class="form-label">Email</label>
                    <input type="email"
                        name="email"
                        class="form-control"
                        value="<?= old('email') ?>"
                        placeholder="nama@email.com"
                        required
                        autocomplete="email">
                </div>
            </div>

            <!-- Password -->
            <div class="form-group form-grid full">
                <div>
                    <label class="form-label">Password</label>
                    <input type="password"
                        name="password"
                        class="form-control"
                        placeholder="Minimal 8 karakter"
                        required
                        autocomplete="new-password">
                    <div class="password-requirements">
                        <strong>Persyaratan password:</strong>
                        • Minimal 8 karakter<br>
                        • Kombinasi huruf dan angka<br>
                        • Karakter spesial (!@#$%^&*)
                    </div>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group form-grid full">
                <div>
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password"
                        name="password_confirm"
                        class="form-control"
                        placeholder="Ulangi password"
                        required
                        autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-user-plus"></i> Buat Akun
            </button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="auth-footer">
            Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk di sini</a>
        </div>
    </div>
</section>

<style>
.auth-section {
    min-height: 100vh;
    background: #ffffff; /* putih polos */
}

.auth-card {
    background: #fff;
    padding: 40px;
    border-radius: 15px;
    width: 100%;
    max-width: 480px;
    border: none;
}

.btn-auth {
    background: linear-gradient(90deg, #6a5af9, #7b2ff7);
    color: #fff;
    font-weight: 500;
    border: none;
}

.btn-auth:hover {
    opacity: 0.9;
}
</style>

<?= $this->endSection() ?>