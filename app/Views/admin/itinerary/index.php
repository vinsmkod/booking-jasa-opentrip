<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="row mb-4">

<div class="col-md-6">
<h3 class="fw-bold">Kelola Itinerary Trip</h3>
<p class="text-muted">Mengatur jadwal kegiatan dalam trip.</p>
</div>

<div class="col-md-6 text-end">

<a href="<?= base_url('admin/itinerary/create') ?>" 
class="btn btn-primary">

+ Tambah Itinerary

</a>

</div>

</div>


<div class="card shadow-sm border-0">

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-light">

<tr>

<th width="60">No</th>
<th>Trip</th>
<th>Waktu</th>
<th>Kegiatan</th>
<th width="150" class="text-center">Aksi</th>

</tr>

</thead>

<tbody>

<?php if(!empty($itinerary)): ?>
<?php $no=1; foreach($itinerary as $item): ?>

<tr>

<td><?= $no++ ?></td>

<td>

<span class="badge bg-info text-dark px-3 py-2">

<?= esc($item['trip_title']) ?>

</span>

</td>

<td>

<span class="badge bg-secondary">

<?= esc($item['time']) ?>

</span>

</td>

<td class="fw-semibold">

<?= esc($item['activity']) ?>

</td>

<td class="text-center">

<a href="<?= base_url('admin/itinerary/edit/'.$item['itinerary_id']) ?>" 
class="btn btn-sm btn-warning">

Edit

</a>

<a href="<?= base_url('admin/itinerary/delete/'.$item['itinerary_id']) ?>" 
class="btn btn-sm btn-danger"
onclick="return confirm('Hapus itinerary ini?')">

Hapus

</a>

</td>

</tr>

<?php endforeach ?>

<?php else: ?>

<tr>

<td colspan="5" class="text-center text-muted">

Belum ada data itinerary

</td>

</tr>

<?php endif ?>

</tbody>

</table>

</div>

</div>

</div>

<?= $this->endSection() ?>