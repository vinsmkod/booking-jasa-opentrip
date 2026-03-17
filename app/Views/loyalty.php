<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Loyalty Points</h4>
                </div>
                <div class="card-body">

                    <p>Halo <strong><?= esc(session()->get('name')) ?></strong>, berikut informasi loyalty points Anda:</p>

                    <div class="d-flex align-items-center mb-4">
                        <h1 class="display-4 me-3"><?= esc($points ?? 0) ?></h1>
                        <span class="badge bg-warning text-dark fs-6">Points</span>
                    </div>

                    <p class="mb-3">
                        <strong>Keterangan:</strong>
                    </p>
                    <ul>
                        <li>Setiap <strong>100 poin</strong> dapat potongan harga trip sebesar <strong>Rp 5.000</strong>.</li>
                        <li>Setiap booking trip yang berhasil menambah <strong>100 poin</strong> ke akun Anda.</li>
                        <li>Poin akan otomatis ditambahkan setelah booking dikonfirmasi.</li>
                        <li>Poin dapat digunakan untuk potongan harga di booking berikutnya sesuai jumlah poin Anda.</li>
                        <li>
                            Potongan yang tersedia saat ini:
                            <strong>
                                Rp <?= number_format(floor(($points ?? 0)/100)*5000,0,',','.') ?>
                            </strong>
                        </li>
                    </ul>

                    <div class="mt-4">
                        <a href="/booking/history" class="btn btn-primary me-2">
                            Lihat Riwayat Booking
                        </a>
                        <a href="/" class="btn btn-secondary">
                            Kembali ke Home
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>