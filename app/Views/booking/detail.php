<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

<h3 class="mb-4 fw-bold">Detail Booking</h3>

<div class="card shadow border-0">
<div class="card-body">

<h5 class="fw-bold"><?= esc($trip['title'] ?? '-') ?></h5>

<hr>

<div class="row">

<div class="col-md-6">

<p>
<strong>Tanggal Trip :</strong><br>
<?= isset($schedule['departure_date']) 
? date('d M Y', strtotime($schedule['departure_date'])) 
: '-' ?>
</p>

<p>
<strong>Jumlah Peserta :</strong><br>
<?= esc($booking['participant'] ?? 0) ?> Orang
</p>

<p>
<strong>Status Booking :</strong><br>

<?php if(($booking['status'] ?? '') == 'pending'): ?>
<span class="badge bg-warning">Pending</span>

<?php elseif(($booking['status'] ?? '') == 'confirmed'): ?>
<span class="badge bg-success">Confirmed</span>

<?php elseif(($booking['status'] ?? '') == 'cancelled'): ?>
<span class="badge bg-danger">Cancelled</span>

<?php else: ?>
<span class="badge bg-secondary">Unknown</span>
<?php endif; ?>

</p>

</div>


<div class="col-md-6">

<p>
<strong>Harga / Orang :</strong><br>
Rp <?= number_format($trip['price'] ?? 0,0,',','.') ?>
</p>

<p>
<strong>Total Harga :</strong><br>

<?php
$total = $booking['total_price'] ?? 0;

if($total == 0 && isset($trip['price']) && isset($booking['participant'])){
    $total = $trip['price'] * $booking['participant'];
}
?>

Rp <?= number_format($total,0,',','.') ?>
</p>

<p>
<strong>Status Pembayaran :</strong><br>

<?php if(!empty($payment)): ?>

<?php if($payment['status'] == 'pending'): ?>
<span class="badge bg-warning">Menunggu Verifikasi</span>

<?php elseif($payment['status'] == 'verified'): ?>
<span class="badge bg-success">Pembayaran Disetujui</span>

<?php elseif($payment['status'] == 'rejected'): ?>
<span class="badge bg-danger">Pembayaran Ditolak</span>

<?php else: ?>
<span class="badge bg-secondary">Belum Ada Pembayaran</span>
<?php endif; ?>

<?php else: ?>

<span class="badge bg-secondary">Belum Upload Pembayaran</span>

<?php endif; ?>

</p>

</div>

</div>

<hr>

<!-- ALERT CONFIRMED -->
<?php if (($booking['status'] ?? '') === 'confirmed'): ?>

<div class="alert alert-success">
Booking Anda sudah dikonfirmasi. Silahkan download tiket dan gabung grup WhatsApp
</div>

<?php endif; ?>


<div class="mt-3">

<a href="<?= base_url('booking/invoice/'.$booking['booking_id']) ?>"
class="btn btn-primary">
Download Invoice
</a>


<?php if(($booking['status'] ?? '') == 'confirmed'): ?>

<a href="<?= base_url('booking/ticket/'.$booking['booking_id']) ?>"
class="btn btn-dark">
QR Ticket
</a>

<?php endif; ?>


<?php if (($booking['status'] ?? '') === 'confirmed' && !empty($trip['whatsapp_group'])): ?>

<a href="<?= esc($trip['whatsapp_group']) ?>"
target="_blank"
class="btn btn-success">
Gabung Grup WhatsApp
</a>

<?php endif; ?>


</div>

</div>
</div>


<hr>

<h5 class="mt-4 fw-bold">Dokumen Peserta</h5>

<div class="row">

<?php if(!empty($documents)): ?>

<?php foreach($documents as $doc): ?>

<div class="col-md-3">

<div class="card mb-3 shadow-sm border-0">
<div class="card-body text-center">

<h6><?= esc($doc['name'] ?? '-') ?></h6>

<?php if(!empty($doc['ktp'])): ?>

<img src="<?= base_url('uploads/documents/'.$doc['ktp']) ?>"
class="img-fluid mb-2"
style="max-height:200px;object-fit:cover;">

<a href="<?= base_url('uploads/documents/'.$doc['ktp']) ?>"
target="_blank"
class="btn btn-sm btn-outline-primary mb-2">
KTP
</a>

<?php endif; ?>


<?php if(!empty($doc['health'])): ?>

<img src="<?= base_url('uploads/documents/'.$doc['health']) ?>"
class="img-fluid mb-2"
style="max-height:200px;object-fit:cover;">

<a href="<?= base_url('uploads/documents/'.$doc['health']) ?>"
target="_blank"
class="btn btn-sm btn-outline-success">
Surat Sehat
</a>

<?php endif; ?>


<?php if(empty($doc['ktp']) && empty($doc['health'])): ?>

<div class="text-muted">
Dokumen belum diupload
</div>

<?php endif; ?>


</div>
</div>

</div>

<?php endforeach; ?>

<?php else: ?>

<div class="col-md-12">
<div class="alert alert-secondary text-center">
Belum ada dokumen peserta
</div>
</div>

<?php endif; ?>

</div>

</div>

<?= $this->endSection() ?>