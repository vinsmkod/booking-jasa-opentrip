<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow-sm border-0">

<div class="card-body">

<h4 class="mb-4">Tambah Paket Include</h4>

<form action="<?= base_url('admin/includes/store') ?>" method="post">

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

<label class="form-label">Nama Include</label>

<input type="text" 
name="title" 
class="form-control"
placeholder="Contoh: Transport PP">

</div>

<button class="btn btn-primary w-100">

Simpan Include

</button>

</form>

</div>

</div>

</div>

</div>

<?= $this->endSection() ?>