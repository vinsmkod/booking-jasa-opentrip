<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

<h3 class="mb-4">Kelola Jadwal Trip</h3>

<a href="/admin/schedules/create" class="btn btn-primary mb-3">
Tambah Jadwal
</a>

<table class="table table-bordered">

<thead class="table-dark">
<tr>
<th>No</th>
<th>Trip</th>
<th>Tanggal</th>
<th>Quota</th>
<th>Sisa</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php $no=1; foreach($schedules as $s): ?>

<tr>
<td><?= $no++ ?></td>
<td><?= esc($s['title']) ?></td>
<td><?= date('d M Y', strtotime($s['departure_date'])) ?></td>
<td><?= $s['quota'] ?></td>
<td><?= $s['available'] ?></td>

<td>
<a href="/admin/schedules/edit/<?= $s['schedule_id'] ?>" class="btn btn-warning btn-sm">Edit</a>

<a href="/admin/schedules/delete/<?= $s['schedule_id'] ?>"
onclick="return confirm('Hapus jadwal?')"
class="btn btn-danger btn-sm">Hapus</a>
</td>

</tr>

<?php endforeach; ?>

</tbody>
</table>

</div>

<?= $this->endSection() ?>