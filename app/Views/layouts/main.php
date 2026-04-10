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

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Plugin -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <!-- Custom -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <!-- CSS per halaman -->
    <?= $this->renderSection('styles') ?>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        html, body { height:100%; }

        body {
            font-family:'Poppins', sans-serif;
            display:flex;
            flex-direction:column;
            min-height:100vh;
        }

        .main-content {
            flex:1;
            padding-bottom:100px;
        }

        .custom-wrapper {
            max-width:1600px;
            margin:auto;
            padding:50px;
        }

        .navbar {
            background:#fff;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        .hero-img {
            height:85vh;
            object-fit:cover;
        }

        .card {
            border:none;
            border-radius:14px;
            transition:.3s;
        }

        .card:hover {
            transform:translateY(-6px);
            box-shadow:0 12px 25px rgba(0,0,0,0.15);
        }

        .btn {
            border-radius:8px;
        }

        footer {
            background:#1a1a1a;
            color:#cbd5e1;
            padding:48px 20px 24px;
            margin-top:auto;
        }

        footer a {
            color:#a0a0a0;
            text-decoration:none;
        }

        footer a:hover {
            color:#fff;
        }
    </style>
</head>

<body class="bg-paper">

    <?= $this->include('layouts/navbar') ?>

    <main class="main-content">
        <div class="custom-wrapper">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <h5>BLNTRK OUTDOOR</h5>
                    <p>Platform open trip pendakian gunung di Indonesia.</p>
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

            <hr>

            <div class="text-center">
                <p>© <?= date('Y') ?> BLNTRK OUTDOOR</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({ duration:1000, once:true });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute("href")).scrollIntoView({
                    behavior:"smooth"
                });
            });
        });
    </script>

</body>
</html>
