<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

<h3 class="fw-bold mb-4">Verifikasi Booking</h3>

<div class="card shadow-sm border-0">
<div class="card-body table-responsive">

<table class="table table-hover align-middle">

<thead class="table-dark">
<tr>
<th>Kode</th>
<th>User</th>
<th>Trip</th>
<th>Peserta</th>
<th>Total</th>
<th>Metode</th>
<th>Bukti</th>
<th>Status</th>
<th width="220">Aksi</th>
</tr>
</thead>

<tbody>

<?php foreach($bookings as $booking): ?>

<tr>

<td><?= esc($booking['booking_code']) ?></td>

<td><?= esc($booking['username']) ?></td>

<td><?= esc($booking['trip_title']) ?></td>

<td><?= $booking['participant'] ?></td>

<td>
Rp <?= number_format($booking['total_price'],0,',','.') ?>
</td>

<td>
<?= $booking['method'] ?? '-' ?>
</td>

<td>

<?php if(!empty($booking['proof'])): ?>

<a href="/uploads/payments/<?= $booking['proof'] ?>" 
target="_blank"
class="btn btn-sm btn-info">
Lihat Bukti
</a>

<?php else: ?>

<span class="text-muted small">Belum Upload</span>

<?php endif; ?>

</td>

<td>

<?php if($booking['status'] == 'pending'): ?>

<span class="badge bg-warning">Pending</span>

<?php elseif($booking['status'] == 'confirmed'): ?>

<span class="badge bg-success">Confirmed</span>

<?php else: ?>

<span class="badge bg-danger">Cancelled</span>

<?php endif; ?>

</td>

<td>

<?php if($booking['status'] == 'pending'): ?>

<a href="/admin/bookings/confirm/<?= $booking['booking_id'] ?>"
class="btn btn-sm btn-success">
Confirm
</a>

<a href="/admin/bookings/cancel/<?= $booking['booking_id'] ?>"
class="btn btn-sm btn-danger">
Cancel
</a>

<?php else: ?>

<span class="text-muted small">
Tidak ada aksi
</span>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>
</div>

</div>

<?= $this->endSection() ?>