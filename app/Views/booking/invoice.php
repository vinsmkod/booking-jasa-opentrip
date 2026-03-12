<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="mb-3">Invoice Booking</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>Kode Booking</th>
                    <td><?= esc($booking['booking_code']) ?></td>
                </tr>
                <tr>
                    <th>Trip</th>
                    <td><?= esc($trip['title']) ?></td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td><?= esc($trip['location']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Keberangkatan</th>
                    <td><?= date('d M Y', strtotime($schedule['date'])) ?></td>
                </tr>
                <tr>
                    <th>Jumlah Peserta</th>
                    <td><?= esc($booking['participant']) ?></td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td>
                        <?php if($booking['payment_status'] === 'pending'): ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php elseif($booking['payment_status'] === 'paid'): ?>
                            <span class="badge bg-success">Paid</span>
                        <?php else: ?>
                            <span class="badge bg-secondary"><?= esc($booking['payment_status']) ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <a href="/booking/detail/<?= $booking['booking_id'] ?>" class="btn btn-dark mt-3">Kembali ke Detail</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>