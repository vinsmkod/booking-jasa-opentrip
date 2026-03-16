<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- HERO CINEMATIC SLIDER -->
<section class="hero-about">

<div class="swiper heroSlider">

<div class="swiper-wrapper">

<!-- SLIDE 1 -->
<div class="swiper-slide hero-slide"
style="background-image:url('<?= base_url('assets/images/gunung1.jpeg') ?>')">

<div class="overlay">

<div class="container hero-text text-center">

<h1>Explore The Mountains</h1>

<p>Petualangan dimulai dari langkah pertama menuju puncak</p>

<a href="<?= base_url('trip') ?>" class="btn btn-success btn-lg mt-3">
Explore Trips
</a>

</div>

</div>

</div>

<!-- SLIDE 2 -->
<div class="swiper-slide hero-slide"
style="background-image:url('<?= base_url('assets/images/gunung2.jpeg') ?>')">

<div class="overlay">

<div class="container hero-text text-center">

<h1>Adventure Awaits</h1>

<p>Nikmati pengalaman pendakian yang aman dan berkesan</p>

</div>

</div>

</div>

<!-- SLIDE 3 -->
<div class="swiper-slide hero-slide"
style="background-image:url('<?= base_url('assets/images/gunung3.jpeg') ?>')">

<div class="overlay">

<div class="container hero-text text-center">

<h1>Join Our Open Trip</h1>

<p>Temukan teman baru dan taklukkan puncak bersama</p>

</div>

</div>

</div>

</div>

</div>

</section>



<!-- STATISTICS -->
<section class="stats bg-light">

<div class="container">

<div class="section-title">
<h2>Our Achievements</h2>
<p>Kepercayaan para pendaki yang telah bergabung bersama kami</p>
</div>

<div class="row text-center justify-content-center">

<div class="col-lg-3 col-md-6 mb-4">
<div class="stat-box">
<h2>1500+</h2>
<p>Pendaki Bergabung</p>
</div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
<div class="stat-box">
<h2>80+</h2>
<p>Trip Pendakian</p>
</div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
<div class="stat-box">
<h2>25</h2>
<p>Gunung Dijelajahi</p>
</div>
</div>

<div class="col-lg-3 col-md-6 mb-4">
<div class="stat-box">
<h2>5</h2>
<p>Tahun Pengalaman</p>
</div>
</div>

</div>

</div>

</section>



<!-- WHO WE ARE -->
<section class="py-5">

<div class="container">

<div class="row align-items-center">

<div class="col-md-6 mb-4 about-img">

<img src="<?= base_url('assets/images/hiking.jpg') ?>" class="img-fluid">

</div>

<div class="col-md-6 about-content">

<h2 class="fw-bold mb-3">Who We Are</h2>

<p class="text-success fw-semibold">
Platform open trip pendakian gunung terpercaya
</p>

<p>
BLNTRK OUTDOOR merupakan platform layanan open trip pendakian gunung
yang dirancang untuk memudahkan para pecinta alam dalam merencanakan
perjalanan pendakian secara praktis, aman, dan terorganisir.
</p>

<p>
Melalui website ini, pengguna dapat melihat berbagai pilihan trip
pendakian, melakukan reservasi secara online, serta memperoleh
informasi lengkap mengenai jadwal perjalanan, meeting point,
dan detail kegiatan selama pendakian.
</p>

<p>
Kami percaya bahwa setiap perjalanan pendakian bukan hanya
tentang mencapai puncak, tetapi juga tentang membangun pengalaman,
persahabatan, dan kecintaan terhadap alam.
</p>

</div>

</div>

</div>

</section>



<!-- VISION MISSION -->
<section class="py-5 bg-light">

<div class="container">

<div class="row text-center">

<div class="col-md-6">

<h4 class="fw-bold mb-3">Our Vision</h4>

<p>
Menjadi platform open trip pendakian gunung terpercaya
yang menghubungkan para pecinta alam untuk menjelajahi
keindahan alam Indonesia secara aman dan terorganisir.
</p>

</div>

<div class="col-md-6">

<h4 class="fw-bold mb-3">Our Mission</h4>

<p>
Menyediakan layanan perjalanan pendakian yang profesional,
membangun komunitas pendaki, serta meningkatkan kesadaran
untuk menjaga kelestarian alam.
</p>

</div>

</div>

</div>

</section>



<!-- WHY CHOOSE US -->
<section class="py-5">

<div class="container">

<div class="section-title">

<h2>Why Choose BLNTRK Outdoor</h2>

<p>Kami menghadirkan pengalaman pendakian yang aman dan profesional</p>

</div>

<div class="row text-center">

<div class="col-md-4 mb-4">

<div class="feature-box">

<i class="bi bi-map"></i>

<h5>Professional Trip Management</h5>

<p>
Perjalanan dirancang dengan itinerary yang jelas dan
dikelola oleh tim yang berpengalaman dalam kegiatan outdoor.
</p>

</div>

</div>


<div class="col-md-4 mb-4">

<div class="feature-box">

<i class="bi bi-people"></i>

<h5>Hiking Community</h5>

<p>
Bergabung dengan komunitas pendaki dari berbagai daerah
dan rasakan pengalaman petualangan bersama.
</p>

</div>

</div>


<div class="col-md-4 mb-4">

<div class="feature-box">

<i class="bi bi-phone"></i>

<h5>Easy Online Booking</h5>

<p>
Sistem pemesanan online memudahkan pengguna untuk memilih trip,
melakukan pembayaran, dan mendapatkan invoice otomatis.
</p>

</div>

</div>

</div>

</div>

</section>



<!-- CTA -->
<section class="cta">

<div class="container text-center">

<h2 class="fw-bold">
Ready For Your Next Adventure?
</h2>

<p class="mt-3">
Temukan pengalaman pendakian terbaik dan jelajahi
keindahan alam Indonesia bersama BLNTRK OUTDOOR.
</p>

<a href="<?= base_url('/') ?>" class="btn btn-light mt-3">
Explore Trips
</a>

</div>

</section>

<?= $this->endSection() ?>