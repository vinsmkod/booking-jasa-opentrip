<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $title ?? 'BLNTRK OUTDOOR' ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
font-family:Segoe UI, sans-serif;
background-image:url("<?= base_url('/assets/upload/image/1_2.jpg') ?>");
background-size:cover;
background-position:center;
background-attachment:fixed;
background-repeat:no-repeat;
}

/* overlay supaya teks jelas */

body::before{
content:"";
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.5);
z-index:-1;
}

/* navbar */

.navbar{
box-shadow:0 2px 8px rgba(0,0,0,0.2);
}

.navbar-brand{
font-weight:600;
letter-spacing:1px;
font-size:20px;
}

/* container utama */

.main-container{
background:white;
border-radius:12px;
padding:30px;
margin-top:30px;
margin-bottom:40px;
box-shadow:0 4px 20px rgba(0,0,0,0.1);
}

/* card */

.card{
border:none;
border-radius:12px;
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

/* footer */

.footer{
margin-top:60px;
padding:20px;
background:#111;
color:#aaa;
text-align:center;
font-size:14px;
}

/* responsive */

@media (max-width:768px){

.navbar-brand{
font-size:18px;
}

.main-container{
padding:20px;
}

}

@media (max-width:576px){

.navbar-brand{
font-size:16px;
}

.main-container{
padding:15px;
}

}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand" href="/trips">
BLNTRK OUTDOOR
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav ms-auto align-items-lg-center">

<?php if(session()->get('user_id')): ?>

<?php if(session()->get('role') == 'admin'): ?>
<li class="nav-item">
<a href="/admin/dashboard" class="nav-link">
Dashboard
</a>
</li>
<?php endif; ?>

<li class="nav-item">
<span class="nav-link text-light">
Hi, <?= esc(session()->get('name')) ?>
</span>
</li>

<li class="nav-item">
<a href="/logout" class="btn btn-outline-light btn-sm ms-lg-2 mt-2 mt-lg-0">
Logout
</a>
</li>

<?php else: ?>

<li class="nav-item">
<a href="/login" class="btn btn-warning btn-sm mt-2 mt-lg-0">
Login
</a>
</li>

<?php endif; ?>

</ul>

</div>
</div>

</nav>

<div class="container">

<div class="main-container">

<?= $this->renderSection('content') ?>

</div>

</div>

<div class="footer">

© <?= date('Y') ?> BLNTRK OUTDOOR  
Explore Beyond Limits

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
