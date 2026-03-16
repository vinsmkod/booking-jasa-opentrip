<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row mb-4">

<div class="col-md-6">
<h3 class="fw-bold">Kelola Paket Include</h3>
<p class="text-muted">Fasilitas yang termasuk dalam paket trip.</p>
</div>

<div class="col-md-6 text-end">

<a href="<?= base_url('admin/includes/create') ?>" 
class="btn btn-primary">

+ Tambah Include

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
<th>Paket Include</th>
<th width="150" class="text-center">Aksi</th>

</tr>

</thead>

<tbody>

<?php if(!empty($includes)): ?>
<?php $no=1; foreach($includes as $inc): ?>

<tr>

<td><?= $no++ ?></td>

<td>
<span class="badge bg-info text-dark px-3 py-2">
<?= esc($inc['title']) ?>
</span>
</td>

<td class="fw-semibold">

<?= esc($inc['title']) ?>

</td>

<td class="text-center">

<a href="<?= base_url('admin/includes/edit/'.$inc['include_id']) ?>" 
class="btn btn-sm btn-warning">

Edit

</a>

<a href="<?= base_url('admin/includes/delete/'.$inc['include_id']) ?>" 
class="btn btn-sm btn-danger"
onclick="return confirm('Hapus include ini?')">

Hapus

</a>

</td>

</tr>

<?php endforeach ?>

<?php else: ?>

<tr>

<td colspan="4" class="text-center text-muted">

Belum ada data include

</td>

</tr>

<?php endif ?>

</tbody>

</table>

</div>

</div>

</div>

<?= $this->endSection() ?>