<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="auth-section d-flex align-items-center justify-content-center">

    <div class="auth-card shadow">

        <div class="text-center mb-4">
            <h3 class="fw-bold">BLNTRK OUTDOOR</h3>
            <h5 class="mt-2">Login</h5>
            <p class="text-muted small">Masuk untuk melanjutkan perjalananmu</p>
        </div>

        <!-- Flash message -->
        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
        <?php endif; ?>

        <form method="post" action="/login">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-auth w-100">
                Login
            </button>
        </form>

        <p class="text-center mt-3 mb-0 small">
            Belum punya akun? 
            <a href="/register" class="text-decoration-none fw-semibold">Register</a>
        </p>

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
    max-width: 400px;
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