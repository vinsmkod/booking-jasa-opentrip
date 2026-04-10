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

    .auth-container {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        max-width: 1000px;
        width: 100%;
        align-items: center;
    }

    /* Left Side - Branding */
    .auth-branding {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .brand-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        margin-bottom: 24px;
        box-shadow: 0 8px 24px rgba(45, 125, 58, 0.2);
    }

    .brand-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .brand-subtitle {
        font-size: 1rem;
        color: #64748b;
        margin-bottom: 24px;
        line-height: 1.6;
    }

    .brand-features {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .feature-icon {
        color: #2d7d3a;
        font-size: 1.2rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .feature-text {
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.5;
    }

    /* Right Side - Form Card */
    .auth-card {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
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

    /* Form Group */
    .form-group {
        margin-bottom: 20px;
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

    /* Responsive */
    @media (max-width: 768px) {
        .auth-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .auth-branding {
            display: none;
        }

        .auth-card {
            padding: 28px;
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        .brand-title {
            font-size: 1.5rem;
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
    <div class="auth-container">
        <!-- Left Side - Branding -->
        <div class="auth-branding">
            <div class="brand-icon">
                <i class="fas fa-compass"></i>
            </div>
            <h1 class="brand-title">Jelajahi Petualangan Baru</h1>
            <p class="brand-subtitle">Bergabunglah dengan ribuan traveler yang telah menemukan destinasi impian mereka bersama Komunitas Trip BLNTRK OUTDOOR.</p>
            <div class="brand-features">
                <div class="feature-item">
                    <i class="fas fa-check-circle feature-icon"></i>
                    <span class="feature-text">Paket wisata dengan harga terjangkau</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle feature-icon"></i>
                    <span class="feature-text">Pemandu lokal berpengalaman</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle feature-icon"></i>
                    <span class="feature-text">Kenangan indah yang tak terlupakan</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="auth-card">
            <div class="auth-header">
                <h2>Login</h2>
                <p>Masuk untuk melanjutkan perjalananmu</p>
            </div>

            <!-- Flash message -->
            <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= esc(session()->getFlashdata('error')) ?></span>
            </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?= esc(session()->getFlashdata('success')) ?></span>
            </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('login') ?>">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="masukkan@email.com" 
                        required
                        autocomplete="email">
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="Masukkan password" 
                        required
                        autocomplete="current-password">
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>

            <div class="divider">
                <span>atau</span>
            </div>

            <div class="auth-footer">
                Belum punya akun? <a href="<?= base_url('register') ?>">Buat akun sekarang</a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>