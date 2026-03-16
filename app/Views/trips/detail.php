<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5 mb-5">

<div class="row">

<div class="col-md-7">

<?php if($schedule['image']): ?>

<img src="<?= base_url('uploads/trips/'.$schedule['image']) ?>"
class="img-fluid rounded shadow mb-4">

<?php endif; ?>

<h3><?= esc($schedule['title']) ?></h3>
<p class="text-muted"><?= esc($schedule['location']) ?></p>

<p>
<?= esc($schedule['description']) ?>
</p>

<hr>

<h5>Paket Include</h5>

<ul>

<?php if(!empty($includes)): ?>

<?php foreach($includes as $inc): ?>

<li><?= esc($inc['title']) ?></li>

<?php endforeach; ?>

<?php else: ?>

<li>Belum ada data</li>

<?php endif; ?>

</ul>

<hr>

<h5>Itinerary</h5>

<ul>

<?php if(!empty($itinerary)): ?>

<?php foreach($itinerary as $item): ?>

<li>
<?= esc($item['time']) ?> - <?= esc($item['activity']) ?>
</li>

<?php endforeach; ?>

<?php else: ?>

<li>Belum ada itinerary</li>

<?php endif; ?>

</ul>

</div>

<div class="col-md-5">

<div class="card shadow-sm">

<div class="card-body">

<h5>Informasi Trip</h5>

<p>
Tanggal Berangkat<br>
<strong>
<?= date('d M Y',strtotime($schedule['departure_date'])) ?>
</strong>
</p>

<p>
Harga<br>
<strong class="text-success">
Rp <?= number_format($schedule['price'],0,',','.') ?>
</strong>
</p>

<hr>

<?php if(session()->get('isLoggedIn')): ?>

<a href="<?= base_url('booking/create/'.$schedule['schedule_id']) ?>"
class="btn btn-warning w-100">
Booking Sekarang
</a>

<?php else: ?>

<a href="<?= base_url('login') ?>"
class="btn btn-warning w-100">
Login untuk Booking
</a>

<?php endif; ?>

</div>

</div>

</div>

</div>
</div>

<?= $this->endSection() ?>