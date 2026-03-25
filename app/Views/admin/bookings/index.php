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

<?php if(!empty($bookings)): ?>
<?php foreach($bookings as $booking): ?>

<tr>

<td><?= esc($booking['booking_code'] ?? '-') ?></td>

<td><?= esc($booking['username'] ?? '-') ?></td>

<td><?= esc($booking['trip_title'] ?? '-') ?></td>

<td><?= esc($booking['participant'] ?? 0) ?></td>

<td>
Rp <?= number_format($booking['total_price'] ?? 0,0,',','.') ?>
</td>

<td>
<?= esc($booking['method'] ?? '-') ?>
</td>

<td>

<?php if(!empty($booking['proof'])): ?>

<a href="<?= base_url('uploads/payment/'.$booking['proof']) ?>" 
target="_blank"
class="btn btn-sm btn-info">
Lihat Bukti
</a>

<?php else: ?>

<span class="text-muted small">Belum Upload</span>

<?php endif; ?>

</td>

<td>

<?php if(($booking['status'] ?? '') == 'pending'): ?>

<span class="badge bg-warning">Pending</span>

<?php elseif(($booking['status'] ?? '') == 'confirmed'): ?>

<span class="badge bg-success">Confirmed</span>

<?php elseif(($booking['status'] ?? '') == 'cancelled'): ?>

<span class="badge bg-danger">Cancelled</span>

<?php else: ?>

<span class="badge bg-secondary">Unknown</span>

<?php endif; ?>

</td>

<td>

<?php if(($booking['status'] ?? '') == 'pending'): ?>

<a href="<?= base_url('admin/bookings/confirm/'.$booking['booking_id']) ?>"
class="btn btn-sm btn-success"
onclick="return confirm('Confirm booking ini?')">
Confirm
</a>

<a href="<?= base_url('admin/bookings/cancel/'.$booking['booking_id']) ?>"
class="btn btn-sm btn-danger"
onclick="return confirm('Cancel booking ini?')">
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
<?php else: ?>

<tr>
<td colspan="9" class="text-center text-muted py-4">
Belum ada data booking
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>
</div>

</div>

<?= $this->endSection() ?>