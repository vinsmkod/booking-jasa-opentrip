<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow-sm border-0">

<div class="card-body">

<h4 class="mb-4">Edit Paket Include</h4>

<form action="<?= base_url('admin/includes/update/'.$include['include_id']) ?>" method="post">

<div class="mb-3">

<label class="form-label">Trip</label>

<select name="trip_id" class="form-control">

<?php foreach($trips as $trip): ?>

<option value="<?= $trip['trip_id'] ?>"
<?= $trip['trip_id']==$include['trip_id']?'selected':'' ?>>

<?= esc($trip['title']) ?>

</option>

<?php endforeach ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">Nama Include</label>

<input type="text" 
name="title"
value="<?= esc($include['title']) ?>"
class="form-control">

</div>

<button class="btn btn-success w-100">

Update Include

</button>

</form>

</div>

</div>

</div>

</div>

<?= $this->endSection() ?>