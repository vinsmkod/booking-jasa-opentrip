<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- HERO SLIDER -->
<section class="hero-slider mb-5">

<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

<div class="carousel-indicators">
<button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
<button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
<button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
</div>

<div class="carousel-inner">

<div class="carousel-item active">
<img src="<?= base_url('assets/images/gunung1.jpg') ?>" class="d-block w-100 hero-img">

<div class="carousel-caption">

<h1 class="fw-bold">Explore The Mountains</h1>

<p>Jelajahi keindahan alam Indonesia bersama open trip pendakian.</p>

<a href="#openTrip" class="btn btn-success btn-lg">
Lihat Trip
</a>

</div>
</div>


<div class="carousel-item">
<img src="<?= base_url('assets/images/gunung2.jpg') ?>" class="d-block w-100 hero-img">

<div class="carousel-caption">

<h1 class="fw-bold">Adventure Awaits</h1>

<p>Temukan pengalaman pendakian yang aman dan berkesan.</p>

<a href="#openTrip" class="btn btn-success btn-lg">
Booking Sekarang
</a>

</div>
</div>


<div class="carousel-item">
<img src="<?= base_url('assets/images/gunung3.jpeg') ?>" class="d-block w-100 hero-img">

<div class="carousel-caption">

<h1 class="fw-bold">Join Our Open Trip</h1>

<p>Bergabunglah dengan komunitas pendaki dari seluruh Indonesia.</p>

<a href="#openTrip" class="btn btn-success btn-lg">
Mulai Petualangan
</a>

</div>
</div>

</div>

<button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
<span class="carousel-control-prev-icon"></span>
</button>

<button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
<span class="carousel-control-next-icon"></span>
</button>

</div>

</section>



<!-- OPEN TRIP -->
<section id="openTrip" class="container mb-5">

<h3 class="mb-4 text-center" data-aos="fade-up">
Open Trip Tersedia
</h3>

<div class="row g-4">

<?php if(!empty($trips)): ?>
<?php foreach($trips as $i => $trip): ?>

<?php
$quota = $trip['quota'] ?? 0;
$available = $trip['available'] ?? 0;
$booked = $quota - $available;
$percent = $quota > 0 ? ($booked / $quota) * 100 : 0;
?>

<div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $i*100 ?>">

<div class="card shadow-sm card-trip h-100">

<?php if(!empty($trip['image'])): ?>

<img src="<?= base_url('uploads/trips/'.$trip['image']) ?>"
class="card-img-top"
style="height:200px;object-fit:cover">

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

<p class="fw-bold text-success">
Rp <?= number_format($trip['price'],0,',','.') ?>
</p>

<p class="text-muted mb-1">
Peserta: <?= $booked ?> / <?= $quota ?>
</p>

<div class="progress mb-2" style="height:8px;">
<div class="progress-bar bg-success" style="width:<?= $percent ?>%"></div>
</div>

<?php if($available == 0): ?>

<p class="text-danger fw-bold">
Trip Full
</p>

<?php else: ?>

<p class="text-muted">
Kuota tersisa: <?= $available ?> orang
</p>

<?php endif; ?>


<?php if(session()->get('isLoggedIn')): ?>

<a href="<?= base_url('trips/detail/'.$trip['schedule_id']) ?>"
class="btn btn-warning mt-auto w-100">
Lihat Detail
</a>

<?php else: ?>

<a href="<?= base_url('login') ?>"
class="btn btn-warning mt-auto w-100">
Login untuk Booking
</a>

<?php endif; ?>

</div>
</div>
</div>

<?php endforeach; ?>
<?php else: ?>

<p class="text-center text-muted">
Belum ada trip tersedia.
</p>

<?php endif; ?>

</div>

</section>



<!-- DOKUMENTASI GUNUNG -->
<section class="py-5 bg-light">

<div class="container">

<h3 class="text-center mb-4" data-aos="fade-up">
Dokumentasi Gunung
</h3>

<div id="carouselGallery"
class="carousel slide"
data-bs-ride="carousel"
data-aos="zoom-in">

<div class="carousel-inner">

<?php if(!empty($galleryPhotos)): ?>
<?php foreach($galleryPhotos as $index => $photo): ?>

<div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">

<img src="<?= base_url('uploads/mountains/'.$photo['image']) ?>"
class="d-block w-100"
style="height:400px;object-fit:cover">

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



<!-- TESTIMONI -->
<section class="py-5">

<div class="container">

<h3 class="text-center mb-4" data-aos="fade-up">
Testimoni Peserta Trip
</h3>

<div class="row g-4">

<?php if(!empty($comments)): ?>
<?php foreach($comments as $i => $c): ?>

<div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $i*100 ?>">

<div class="card shadow-sm border-0 h-100">

<div class="card-body">

<h6 class="fw-bold">
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



<!-- FORM KOMENTAR -->
<section class="py-5 bg-light">

<div class="container">

<h4 class="text-center mb-4" data-aos="fade-up">
Bagikan Pengalaman Trip Anda
</h4>

<?php if(session()->get('isLoggedIn')): ?>

<form action="<?= base_url('comment/create') ?>" method="post" data-aos="fade-up">

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



<style>

.hero-img{
height:80vh;
object-fit:cover;
}

.carousel-caption{
background:rgba(0,0,0,0.45);
padding:30px;
border-radius:10px;
}

.carousel-caption h1{
font-size:48px;
}

.carousel-caption p{
font-size:18px;
}

.card-trip{
border-radius:12px;
transition:transform .3s ease, box-shadow .3s ease;
}

.card-trip:hover{
transform:translateY(-6px);
box-shadow:0 12px 24px rgba(0,0,0,.2);
}

</style>

<!-- SCRIPT SMOOTH SCROLL -->
<script>
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e){
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if(target){
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});
</script>

<?= $this->endSection() ?>