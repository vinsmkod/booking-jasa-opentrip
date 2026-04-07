<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>BLNTRK OUTDOOR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Hover dropdown on desktop — tidak ada padanan Bootstrap */
        @media (min-width: 992px) {
            .navbar-nav .dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0;
            }
        }

        /* Dropdown slide-in animation — tidak ada padanan Bootstrap */
        .navbar-nav .dropdown .dropdown-menu {
            transition: opacity .3s ease, transform .3s ease;
            opacity: 0;
            transform: translateY(10px);
        }

        .navbar-nav .dropdown:hover .dropdown-menu,
        .navbar-nav .dropdown .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Navbar blur transparan — tidak ada padanan Bootstrap */
        .navbar-custom {
            background-color: rgba(66, 112, 79, 0.57);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Active underline — tidak ada padanan Bootstrap */
        .navbar-custom .nav-link.active {
            font-weight: 600;
            color: #198754 !important;
            border-bottom: 2px solid #198754;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm sticky-top">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand fw-bold text-white" href="/">
                <i class="bi bi-tree-fill me-1"></i> BLNTRK OUTDOOR
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-4 text-success"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- LEFT MENU -->
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link text-white <?= uri_string() == '' ? 'active' : '' ?>" href="/">
                            <i class="bi bi-house-door me-1"></i> Home
                        </a>
                    </li>

                    <!-- TRIP DROPDOWN -->
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle <?= strpos(uri_string(), 'trips') !== false ? 'active' : '' ?>"
                            href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-map me-1"></i> Trip
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="/trips/one_day_trip">
                                    <i class="bi bi-sun me-2"></i> One Day Trip
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/trips/open_trip">
                                    <i class="bi bi-people me-2"></i> Open Trip
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/trips/private_trip">
                                    <i class="bi bi-person me-2"></i> Private Trip
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white <?= uri_string() == 'gallery' ? 'active' : '' ?>" href="/gallery">
                            <i class="bi bi-images me-1"></i> Gallery
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white <?= uri_string() == 'about' ? 'active' : '' ?>" href="/about">
                            <i class="bi bi-info-circle me-1"></i> About
                        </a>
                    </li>

                </ul>

                <!-- RIGHT MENU -->
                <ul class="navbar-nav ms-auto align-items-center">

                    <?php if (session()->get('isLoggedIn')): ?>

                        <?php if (session()->get('role') == 'customer'): ?>

                    

                            <!-- Customer dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-1"></i>
                                    <?= esc(session()->get('name')) ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="/booking/history">
                                            <i class="bi bi-receipt me-2"></i> My Booking
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/loyalty">
                                            <i class="bi bi-gift me-2"></i> Loyalty Points
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="/logout">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        <?php elseif (session()->get('role') == 'admin'): ?>

                            <!-- Admin label -->
                            <li class="nav-item text-success d-flex align-items-center me-3">
                                <i class="bi bi-person-badge me-1"></i>
                                <?= esc(session()->get('name')) ?>
                            </li>

                            <li class="nav-item">
                                <a href="/logout" class="btn btn-danger btn-sm px-3">
                                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                                </a>
                            </li>

                        <?php endif; ?>

                    <?php else: ?>

                        <li class="nav-item">
                            <a href="/login" class="btn btn-success btn-sm px-3 fw-semibold">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>

            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>