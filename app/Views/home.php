<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
bagian gambar slide
<!-- Section -->
Tentang Kami
<!-- Trip Cards Section -->
<h3 class="mb-4">Open Trip Tersedia</h3>

<div class="row g-4">

<?php if(!empty($trips)): ?>
<?php foreach($trips as $trip): ?>

<div class="col-md-4" data-aos="fade-up">

<div class="card shadow-sm card-trip h-100">

<?php if(!empty($trip['image'])): ?>

<img src="<?= base_url('uploads/trips/'.$trip['image']) ?>" 
     class="card-img-top" 
     alt="<?= esc($trip['title']) ?>" 
     style="height:200px;object-fit:cover;border-top-left-radius:12px;border-top-right-radius:12px;">

<?php endif; ?>

<div class="card-body d-flex flex-column">

<h5><?= esc($trip['title']) ?></h5>

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


<!-- Tombol Booking -->
<?php if(!empty($trip['schedule_id'])): ?>

    <?php if(session()->get('isLoggedIn')): ?>

    <form action="<?= base_url('booking/create'); ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="schedule_id" value="<?= esc($trip['schedule_id']); ?>">

        <button type="submit" class="btn btn-warning mt-auto w-100">
            Booking Sekarang
        </button>
    </form>

    <?php else: ?>

    <a href="<?= base_url('login') ?>" 
       class="btn btn-warning mt-auto w-100 text-center d-block">
        Booking Sekarang
    </a>

    <?php endif; ?>

<?php else: ?>

<button class="btn btn-secondary mt-auto w-100" disabled>
Jadwal Belum Tersedia
</button>

<?php endif; ?>

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


<!-- Dokumentasi Gunung Carousel -->
<section class="mt-5 py-5 bg-light">

<div class="container">

<h3 class="text-center mb-4">Dokumentasi Gunung</h3>

<div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">

<div class="carousel-inner">

<?php if(!empty($galleryPhotos)): ?>
<?php foreach($galleryPhotos as $index => $photo): ?>

<div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">

<img src="<?= base_url('uploads/mountains/'.$photo['image']) ?>" 
     class="d-block w-100" 
     alt="<?= esc($photo['title'] ?? 'Gunung') ?>" 
     style="height:400px;object-fit:cover;">

<?php if(!empty($photo['title'])): ?>

<div class="carousel-caption d-none d-md-block">
<h5><?= esc($photo['title']) ?></h5>
</div>

<?php endif; ?>

</div>

<?php endforeach; ?>
<?php endif; ?>

</div>

<button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
<span class="carousel-control-prev-icon"></span>
</button>

<button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
<span class="carousel-control-next-icon"></span>
</button>

</div>
</div>
</section>


<!-- Testimoni Pengguna -->
<section class="py-5">

<div class="container">

<h3 class="text-center mb-4">Testimoni Peserta Trip</h3>

<div class="row g-4">

<?php if(!empty($comments)): ?>
<?php foreach($comments as $c): ?>

<div class="col-md-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-body">

<h6 class="fw-bold mb-1">
<?= esc($c['name']) ?>
</h6>

<small class="text-muted">
<?= date('d M Y', strtotime($c['created_at'])) ?>
</small>

<p class="mt-2">
<?= esc($c['comment']) ?>
</p>

</div>
</div>
</div>

<?php endforeach; ?>

<?php else: ?>

<p class="text-center text-muted">
Belum ada komentar dari peserta trip.
</p>

<?php endif; ?>

</div>
</div>
</section>


<!-- Form Komentar -->
<section class="py-5 bg-light">

<div class="container">

<h4 class="mb-4 text-center">Bagikan Pengalaman Trip Anda</h4>

<?php if(session()->get('isLoggedIn')): ?>

<form action="<?= base_url('comment/create') ?>" method="post">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="mb-3">

<label class="form-label">Pilih Trip</label>

<select name="trip_id" class="form-control" required>

<?php foreach($trips as $trip): ?>

<option value="<?= $trip['trip_id'] ?>">
<?= esc($trip['title']) ?>
</option>

<?php endforeach; ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">Komentar</label>

<textarea name="comment" class="form-control" rows="4" required></textarea>

</div>

<button class="btn btn-primary w-100">
Kirim Komentar
</button>

</div>
</div>

</form>

<?php else: ?>

<p class="text-center">
Silakan <a href="<?= base_url('login') ?>">login</a> untuk memberikan komentar.
</p>

<?php endif; ?>

</div>
</section>


<!-- Kustom CSS -->
<style>

.card-trip{
border-radius:12px;
transition:transform .3s ease, box-shadow .3s ease;
}

.card-trip:hover{
transform:translateY(-5px);
box-shadow:0 10px 20px rgba(0,0,0,.2);
}

</style>


<!-- AOS Animation -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
AOS.init({
duration:800,
once:true
});
</script>

<?= $this->endSection() ?>