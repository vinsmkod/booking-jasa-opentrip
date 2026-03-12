<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

<h2 class="mb-4 text-center text-capitalize">
<?= esc($type) ?>
</h2>

<div class="row g-4">

<?php if(!empty($trips)): ?>
<?php foreach($trips as $trip): ?>

<div class="col-md-4">
<div class="card h-100 shadow-sm">

<?php if(!empty($trip['image'])): ?>

<img src="<?= base_url('uploads/trips/'.$trip['image']) ?>"
     class="card-img-top"
     alt="<?= esc($trip['title']) ?>"
     style="height:200px;object-fit:cover;">

<?php else: ?>

<img src="<?= base_url('images/no-image.jpg') ?>"
     class="card-img-top"
     style="height:200px;object-fit:cover;">

<?php endif; ?>

<div class="card-body d-flex flex-column">

<h5><?= esc($trip['title']) ?></h5>

<p class="text-muted mb-1">
📍 <?= esc($trip['location']) ?>
</p>

<p class="fw-bold text-success mb-3">
Rp <?= number_format($trip['price'],0,',','.') ?>
</p>

<a href="<?= base_url('trips/detail/'.$trip['trip_id']) ?>"
   class="btn btn-primary mt-auto">
Lihat Detail
</a>

</div>
</div>
</div>

<?php endforeach; ?>

<?php else: ?>

<div class="col-12">
<div class="alert alert-info text-center">
Tidak ada trip tersedia.
</div>
</div>

<?php endif; ?>

</div>
</div>

<?= $this->endSection() ?>