<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Open Trip Tersedia</h3>

<div class="row g-4">

<?php if(!empty($trips)): ?>

<?php foreach($trips as $trip): ?>

<!-- DEBUG -->
<div style="background:#f5f5f5;padding:10px;margin-bottom:10px;">
<b>Debug Data Trip:</b>
<pre><?php print_r($trip); ?></pre>

<p><b>Nama File Gambar:</b> <?= $trip['image'] ?? 'KOSONG' ?></p>

<p><b>URL Gambar:</b> <?= base_url('uploads/trips/'.$trip['image']) ?></p>
</div>
<!-- END DEBUG -->

<div class="col-md-4">

<div class="card card-trip shadow-sm h-100">

<?php if(!empty($trip['image'])): ?>
<img src="<?= base_url('uploads/trips/'.$trip['image']) ?>" 
     class="card-img-top" 
     alt="<?= esc($trip['title']) ?>">
<?php else: ?>
<p style="color:red">Gambar tidak ada</p>
<?php endif; ?>

<div class="card-body d-flex flex-column">

<h5 class="card-title"><?= esc($trip['title']) ?></h5>

<p class="text-muted mb-1">
📍 <?= esc($trip['location']) ?>
</p>

<p class="mb-1">
📅 
<?= !empty($trip['departure_date']) 
    ? date('d M Y', strtotime($trip['departure_date'])) 
    : 'Jadwal belum tersedia' ?>
</p>

<p class="fw-bold text-success mb-1">
Rp <?= number_format($trip['price'],0,',','.') ?>
</p>

<p class="text-muted mb-3">
Kuota: 
<?= !empty($trip['quota']) ? esc($trip['quota']) : '-' ?> orang
</p>

</div>
</div>
</div>

<?php endforeach; ?>

<?php else: ?>

<div class="col-12 text-center text-muted">
Belum ada trip tersedia.
</div>

<?php endif; ?>

</div>

<?= $this->endSection() ?>