<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= esc($title ?? 'BLNTRK OUTDOOR') ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>

<!-- AOS Animation -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>

<!-- Custom CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

<style>

body{
font-family:'Poppins', sans-serif;
background:#f8f9fa;
display:flex;
flex-direction:column;
min-height:100vh;
}

/* MAIN CONTENT */

.main-content{
flex:1;
padding-top:30px;
}

/* NAVBAR */

.navbar{
background:#ffffff;
box-shadow:0 2px 10px rgba(0,0,0,0.05);
padding:12px 0;
}

.navbar-brand{
font-weight:700;
letter-spacing:1px;
}

/* CARD */

.card{
border:none;
border-radius:14px;
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

/* BUTTON */

.btn{
border-radius:8px;
padding:8px 20px;
font-weight:500;
}

/* TABLE */

.table-hover tbody tr:hover{
background:#f1f3f5;
}

/* FOOTER */

footer{
background:#212529;
color:#ccc;
padding:40px 0;
margin-top:auto;
}

footer h5{
font-weight:600;
margin-bottom:15px;
}

footer a{
color:#ccc;
text-decoration:none;
margin:0 8px;
}

footer a:hover{
color:#fff;
}

/* RESPONSIVE */

@media (max-width:768px){

.navbar-brand{
font-size:18px;
}

.main-content{
padding-top:20px;
}

}

</style>

</head>

<body>

<!-- NAVBAR -->
<?= $this->include('layouts/navbar') ?>


<!-- MAIN CONTENT -->
<main class="main-content">
<div class="container">

<?= $this->renderSection('content') ?>

</div>
</main>


<!-- FOOTER -->
<footer>

<div class="container">

<div class="row">

<div class="col-md-4">

<h5>BLNTRK OUTDOOR</h5>

<p>
Platform open trip pendakian gunung untuk para pecinta alam
yang ingin menjelajahi keindahan gunung di Indonesia
dengan pengalaman yang aman dan berkesan.
</p>

</div>


<div class="col-md-4">

<h5>Navigation</h5>

<p>
<a href="<?= base_url('/') ?>">Home</a><br>
<a href="<?= base_url('trip') ?>">Trip</a><br>
<a href="<?= base_url('about') ?>">About</a><br>
<a href="<?= base_url('contact') ?>">Contact</a>
</p>

</div>


<div class="col-md-4">

<h5>Follow Us</h5>

<p>

<a href="#"><i class="bi bi-instagram"></i> Instagram</a><br>

<a href="#"><i class="bi bi-facebook"></i> Facebook</a><br>

<a href="#"><i class="bi bi-whatsapp"></i> WhatsApp</a>

</p>

</div>

</div>


<hr style="border-color:#444">


<div class="text-center">

<p class="mb-0">
© <?= date('Y') ?> BLNTRK OUTDOOR. All rights reserved.
</p>

</div>

</div>

</footer>


<!-- JS -->

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>

/* INIT AOS */

AOS.init({
duration:1000,
once:true
});


/* HERO SLIDER */

new Swiper(".heroSlider", {

loop:true,

effect:"fade",

speed:1200,

autoplay:{
delay:4000,
disableOnInteraction:false
}

});

</script>

</body>
</html>