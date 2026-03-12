<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="auth-section d-flex align-items-center justify-content-center">

    <div class="auth-card shadow">

        <div class="text-center mb-4">
            <h3 class="fw-bold">BLNTRK OUTDOOR</h3>
            <h5 class="mt-2">Buat Akun Baru</h5>
            <p class="text-muted small">Daftar untuk memulai perjalanan</p>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?php
            foreach(session()->getFlashdata('error') as $e)
            {
                echo $e . "<br>";
            }
            ?>
        </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
        <?php endif; ?>

        <form method="post" action="/register">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text"
                    name="name"
                    class="form-control"
                    value="<?= old('name') ?>"
                    placeholder="Masukan nama lengkap"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                    name="email"
                    class="form-control"
                    value="<?= old('email') ?>"
                    placeholder="Masukan alamat email"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukan Password"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password"
                    name="password_confirm"
                    class="form-control"
                    placeholder="Ulangi Password"
                    required>
            </div>

            <button type="submit" class="btn btn-auth w-100">
                Daftar Sekarang
            </button>

        </form>

        <div class="text-center mt-4 small">
            Sudah punya akun?
            <a href="/login" class="text-decoration-none fw-semibold">
                Masuk disini
            </a>
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