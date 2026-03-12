<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>BLNTRK OUTDOOR</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
background:#495057;
color:#fff;
}

.badge-status{
font-size:10px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

<div class="container">

<a class="navbar-brand fw-bold" href="/">
BLNTRK OUTDOOR
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarNav">

<!-- LEFT MENU -->
<ul class="navbar-nav me-auto">

<li class="nav-item">
<a class="nav-link <?= uri_string()==''?'active':'' ?>" href="/">
Home
</a>
</li>

<!-- TRIP DROPDOWN -->

<li class="nav-item dropdown">

<a class="nav-link dropdown-toggle <?= strpos(uri_string(),'trips')!==false?'active':'' ?>"
href="#" data-bs-toggle="dropdown">

Trip

</a>

<ul class="dropdown-menu">

<li>
<a class="dropdown-item" href="/trips/one_day_trip">
One Day Trip
</a>
</li>

<li>
<a class="dropdown-item" href="/trips/open_trip">
Open Trip
</a>
</li>

<li>
<a class="dropdown-item" href="/trips/private_trip">
Private Trip
</a>
</li>

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


<!-- RIGHT MENU -->

<ul class="navbar-nav ms-auto align-items-center">

<?php if(session()->get('isLoggedIn')): ?>

    <?php if(session()->get('role')=='customer'): ?>
        <!-- MENU PELANGGAN -->
        <li class="nav-item me-3 text-light">
            ⭐ Points
            <span class="badge bg-warning text-dark">
                <?= session()->get('points') ?? 0 ?>
            </span>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" data-bs-toggle="dropdown">
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
        <!-- NAVBAR ADMIN POLos -->
        <li class="nav-item text-light">
            <?= esc(session()->get('name')) ?> 
        </li>
        <li class="nav-item ms-3">
            <a href="/logout" class="btn btn-danger btn-sm px-3">Logout</a>
        </li>

    <?php endif; ?>

<?php else: ?>
    <!-- MENU TIDAK LOGIN -->
    <li class="nav-item me-2">
        <a href="/login" class="btn btn-warning btn-sm px-3 fw-semibold">Login</a>
    </li>
<?php endif; ?>

</ul>
</div>
</div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>