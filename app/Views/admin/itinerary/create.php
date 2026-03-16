<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow-sm border-0">

<div class="card-body">

<h4 class="mb-4">Tambah Itinerary</h4>

<form action="<?= base_url('admin/itinerary/store') ?>" method="post">

<div class="mb-3">

<label class="form-label">Trip</label>

<select name="trip_id" class="form-control">

<?php foreach($trips as $trip): ?>

<option value="<?= $trip['trip_id'] ?>">

<?= esc($trip['title']) ?>

</option>

<?php endforeach ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">Waktu</label>

<input type="text"
name="time"
class="form-control"
placeholder="Contoh: 05:00">

</div>

<div class="mb-3">

<label class="form-label">Kegiatan</label>

<input type="text"
name="activity"
class="form-control"
placeholder="Contoh: Berkumpul di meeting point">

</div>

<button class="btn btn-primary w-100">

Simpan Itinerary

</button>

</form>

</div>

</div>

</div>

</div>

<?= $this->endSection() ?>