<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>BLNTRK OUTDOOR</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

@media (min-width: 992px) {
.navbar-nav .dropdown:hover .dropdown-menu{
display:block;
margin-top:0;
opacity:1;
transform:translateY(0);
}
}

.navbar-nav .dropdown .dropdown-menu{
transition:all 0.3s ease;
opacity:0;
transform:translateY(10px);
}

.navbar-dark .dropdown-menu .dropdown-item:hover{
background:#198754;
color:#fff;
}

.badge-status{
font-size:10px;
}

/* NAVBAR */
.navbar-custom{
background-color:rgba(66, 112, 79, 0.57);
backdrop-filter:blur(12px);
-webkit-backdrop-filter:blur(12px);
}

.navbar-custom .nav-link,
.navbar-custom .navbar-brand{
color: white;
}

.navbar-custom .nav-link:hover{
color:#146c43;
}

.navbar-custom .nav-link.active{
font-weight:600;
color:#198754;
border-bottom:2px solid #198754;
}

/* FOOTER */
.main-footer {
background-color: #000;
color: #ccc;
text-align: center;
padding: 18px 10px;
font-size: 14px;
border-top: 1px solid #222;
margin-top: 40px;
}

.main-footer .footer-content {
max-width: 1200px;
margin: 0 auto;
letter-spacing: 0.5px;
}

.main-footer:hover {
color: #fff;
transition: 0.3s;
}

</style>

</head>

<body>

<!-- NAVBAR -->
<?php if(session()->get('role') != 'admin'): ?>

<nav class="navbar navbar-expand-lg navbar-custom shadow-sm sticky-top">

<div class="container">

<a class="navbar-brand fw-bold" href="/">
<i class="bi bi-tree-fill me-1"></i> BLNTRK OUTDOOR
</a>

<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<i class="bi bi-list fs-4 text-success"></i>
</button>

<div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav me-auto">

<li class="nav-item">
<a class="nav-link <?= uri_string()==''?'active':'' ?>" href="/">
Home
</a>
</li>

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle <?= strpos(uri_string(),'trips')!==false?'active':'' ?>"
href="#" data-bs-toggle="dropdown">
Trip
</a>

<ul class="dropdown-menu">
<li><a class="dropdown-item" href="/trips/one_day_trip">One Day Trip</a></li>
<li><a class="dropdown-item" href="/trips/open_trip">Open Trip</a></li>
<li><a class="dropdown-item" href="/trips/private_trip">Private Trip</a></li>
</ul>
</li>

<li class="nav-item">
<a class="nav-link <?= uri_string()=='gallery'?'active':'' ?>" href="/gallery">
Gallery
</a>
</li>

<li class="nav-item">
<a class="nav-link <?= uri_string()=='about'?'active':'' ?>" href="/about">
About
</a>
</li>

</ul>

<ul class="navbar-nav ms-auto align-items-center">

<?php if(session()->get('isLoggedIn')): ?>

    <?php if(session()->get('role')=='customer'): ?>


        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <?= esc(session()->get('name')) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="/booking/history">My Booking</a></li>
                <li><a class="dropdown-item" href="/loyalty">Loyalty Points</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
            </ul>
        </li>

    <?php elseif(session()->get('role')=='admin'): ?>

        <li class="nav-item">
            <a href="/logout" class="btn btn-danger btn-sm px-3">
                Logout
            </a>
        </li>

    <?php endif; ?>

<?php else: ?>

    <li class="nav-item me-2">
        <a href="/login" class="btn btn-success btn-sm px-3">
            Login
        </a>
    </li>

<?php endif; ?>

</ul>

</div>
</div>
</nav>

<?php endif; ?>


<!-- CONTENT -->
<div class="container mt-4">
    <?= $this->renderSection('content') ?>
</div>


<!-- FOOTER -->
<?php if(session()->get('role') != 'admin'): ?>

<footer class="main-footer"> 
    <div class="footer-content">
        © <?= date('Y'); ?> BLNTRK OUTDOOR — Explore Beyond Limits
    </div>
</footer>

<?php endif; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>