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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding-bottom: 100px;
        }

        .custom-wrapper {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
            padding: 50px;
        }


        /* NAVBAR */

        .navbar {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 12px 0;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* HERO SLIDER */

        .hero-img {
            height: 85vh;
            object-fit: cover;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.45);
            padding: 30px;
            border-radius: 10px;
        }

        .carousel-caption h1 {
            font-size: 48px;
        }

        .carousel-caption p {
            font-size: 18px;
        }

        /* CARD */

        .card {
            border: none;
            border-radius: 14px;
            transition: .3s;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        /* BUTTON */

        .btn {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
        }

        /* OPEN TRIP SCROLL TARGET */

        #openTrip {
            scroll-margin-top: 100px;
        }

        /* FOOTER */

        footer {
            background: #1a1a1a;
            color: #cbd5e1;
            padding: 48px 20px 24px;
            margin-top: auto;
            border-top: 1px solid #333;
            flex-shrink: 0;
            position: relative;
            z-index: 10;
        }

        footer h5 {
            font-weight: 600;
            margin-bottom: 15px;
            color: white;
        }

        footer a {
            color: #a0a0a0;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }
    </style>

</head>

<body>

    <!-- NAVBAR -->
    <?= $this->include('layouts/navbar') ?>

    <!-- CONTENT -->
    <main class="main-content">

        <div class="custom-wrapper">

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
                        <a href="https://www.instagram.com/blntrk.outdoor/"><i class="bi bi-instagram"></i> Instagram</a><br>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        /* SMOOTH SCROLL */

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {

            anchor.addEventListener("click", function(e) {

                e.preventDefault();

                document.querySelector(this.getAttribute("href")).scrollIntoView({
                    behavior: "smooth"
                });

            });

        });
    </script>

</body>

</html>