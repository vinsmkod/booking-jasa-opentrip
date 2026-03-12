<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h4>QR Ticket</h4>

<p>Kode Booking: <?= esc($booking['booking_code']) ?></p>
<p>Trip: <?= esc($trip['title']) ?></p>

<img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= urlencode($qr_data) ?>&size=200x200" alt="QR Code">

<a href="/booking/detail/<?= $booking['booking_id'] ?>" class="btn btn-dark mt-2">Kembali ke Detail</a>

<?= $this->endSection() ?>