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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding-bottom: 100px;
        }

        .custom-wrapper {
            max-width: 1600px;
            margin: auto;
            padding: 50px;
        }

        .navbar {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .hero-img {
            height: 85vh;
            object-fit: cover;
        }

        .card {
            border: none;
            border-radius: 14px;
            transition: .3s;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .btn {
            border-radius: 8px;
        }

        footer {
            background: #1a1a1a;
            color: #ffffff;
            padding: 48px 20px 24px;
            margin-top: auto;
        }

        footer a {
            color: #ffffff;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }

        /* Back to Top Button */
        #backToTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 48px;
            height: 48px;
            background-color: #2d7d3a;
            color: #fff;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.8);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
        }

        #backToTop.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        #backToTop:hover {
            background-color: #1f5428;
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 20px rgba(45, 125, 58, 0.4);
            color: #fff;
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

    <?= $this->include('layouts/footer') ?>

    <!-- Back to Top Button -->
    <button id="backToTop" title="Kembali ke atas">
        <i class="fas fa-chevron-up text-white fs-5"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener("click", function(e) {
                    const targetId = this.getAttribute("href");
                    if (targetId && targetId !== '#') {
                        try {
                            const element = document.querySelector(targetId);
                            if (element) {
                                e.preventDefault();
                                element.scrollIntoView({
                                    behavior: "smooth"
                                });
                            }
                        } catch (err) {
                            console.warn("Invalid selector: " + targetId);
                        }
                    }
                });
            });

            // Scroll to Top logic
            const backToTopBtn = document.getElementById('backToTop');
            if (backToTopBtn) {
                const toggleBtn = () => {
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
                    if (scrollTop > 300) {
                        backToTopBtn.classList.add('show');
                    } else {
                        backToTopBtn.classList.remove('show');
                    }
                };

                window.addEventListener('scroll', toggleBtn);
                window.addEventListener('resize', toggleBtn);
                toggleBtn(); // Run once

                backToTopBtn.addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>

</body>

</html>