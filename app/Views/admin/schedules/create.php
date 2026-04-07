<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container py-5">

<h3 class="mb-4">Tambah Jadwal Trip</h3>

<form action="/admin/schedules/store" method="post">

<div class="mb-3">
<label>Trip</label>

<select name="trip_id" class="form-control" required>

<?php foreach($trips as $t): ?>

<option value="<?= $t['trip_id'] ?>">
<?= esc($t['title']) ?>
</option>

<?php endforeach; ?>

</select>
</div>

<div class="mb-3">
<label>Tanggal Berangkat</label>
<input type="date" name="departure_date" class="form-control" required>
</div>

<div class="mb-3">
<label>Quota</label>
<input type="number" name="quota" class="form-control" required>
</div>

<button class="btn btn-primary">
Simpan Jadwal
</button>

</form>

</div>

<?= $this->endSection() ?>