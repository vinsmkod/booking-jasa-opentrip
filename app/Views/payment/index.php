<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Pilih Metode Pembayaran</h4>

                <!-- Info Booking -->
                <p><strong>Kode Booking:</strong> <?= esc($booking['booking_code']) ?></p>
                <p><strong>Trip:</strong> <?= esc($trip['title']) ?> (<?= esc($trip['location']) ?>)</p>
                <p><strong>Total Harga:</strong> Rp <?= number_format($booking['total_price'],0,',','.') ?></p>

                <form method="post" action="/payment/process">
                    <?= csrf_field() ?>
                    <input type="hidden" name="booking_id" value="<?= esc($booking['booking_id']) ?>">

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="metode" class="form-control" required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="qris">QRIS</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="cod">COD</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Bayar Sekarang
                    </button>
                </form>

                <div class="mt-3 text-center">
                    <a href="/booking/detail/<?= esc($booking['booking_id']) ?>" class="text-decoration-none">
                        Kembali ke Detail Booking
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>