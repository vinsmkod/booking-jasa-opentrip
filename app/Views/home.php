<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap');

    :root {
        --ink: #0f0e0d;
        --paper: #bcccb9;
        --sand: #e8e2d9;
        --rust: #c4603a;
        --rust-light: #e8886a;
        --muted: #8c8780;
        --card-radius: 12px;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    body {
        background: var(--paper);
    }

    /* ── HERO SLIDER ── */
    .hero-slider {
        position: relative;
        height: 70vh;
        min-height: auto;
        overflow: hidden;
        border-radius: 20px 20px 70px 70px;
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .hero-slide {
        height: 70vh;
        min-height: auto;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
    }

    .hero-slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(26, 158, 90, 0.54) 0%, rgba(0, 0, 0, 0.7) 100%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 700px;
        animation: fadeInUp 1s ease;
    }

    .hero-badge {
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .3em;
        text-transform: uppercase;
        background: var(--rust);
        color: white;
        padding: 8px 20px;
        border-radius: 100px;
        display: inline-block;
        margin-bottom: 20px;
    }

    .hero-content h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 20px;
    }

    .hero-content .lead {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.1rem;
        font-weight: 300;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .hero-buttons .btn {
        padding: 12px 30px;
        font-weight: 600;
        transition: var(--transition);
    }

    .hero-buttons .btn:hover {
        transform: translateY(-3px);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 50px;
        height: 50px;
        background-color: rgba(196, 96, 58, 0.8);
        background-size: 60%;
        border-radius: 50%;
        transition: var(--transition);
    }

    .carousel-control-prev-icon:hover,
    .carousel-control-next-icon:hover {
        background-color: var(--rust);
        transform: scale(1.1);
    }

    .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin: 0 6px;
        background-color: var(--rust);
        opacity: 0.5;
    }

    .carousel-indicators button.active {
        opacity: 1;
        background-color: var(--rust);
        transform: scale(1.2);
    }

    /* How It Works */
    .howitworks-section {
        padding: 80px 0;
    }

    .step-card {
        text-align: center;
        padding: 30px 20px;
        background: white;
        border-radius: 20px;
        transition: all 0.3s;
        height: 100%;
    }

    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.1);
    }

    .step-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #198754, #198754);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .step-icon i {
        font-size: 2rem;
        color: white;
    }

    .step-number {
        width: 30px;
        height: 30px;
        background: #198754;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 15px auto 0;
        font-weight: 700;
        font-size: 0.8rem;
    }

    .step-card h5 {
        font-weight: 700;
        margin: 15px 0 10px;
        color: #0f172a;
    }

    .step-card p {
        color: #64748b;
        font-size: 0.9rem;
    }

    /* ── SEARCH FORM IN TRIP SECTION ── */
    .search-form {
        margin-bottom: 0;
    }

    .search-form .input-group {
        background: white;
        border-radius: 50px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 2px solid transparent;
    }

    .search-form .input-group:focus-within {
        border-color: var(--rust);
        box-shadow: 0 0 0 3px rgba(196, 96, 58, 0.1);
    }

    .search-form .input-group-text {
        background: white;
        border: none;
        padding-right: 0;
    }

    .search-form .form-control {
        background: white;
        border: none;
        padding: 12px 0;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.95rem;
    }

    .search-form .form-control:focus {
        box-shadow: none;
        background: white;
    }

    .search-form .form-control::placeholder {
        color: var(--muted);
        font-size: 0.9rem;
    }

    .search-form .btn-search {
        background: var(--rust);
        color: white;
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        transition: var(--transition);
        border-radius: 0 50px 50px 0;
    }

    .search-form .btn-search:hover {
        background: #b5532c;
        transform: scale(1.02);
    }

    .search-info {
        padding: 8px 15px;
        background: rgba(196, 96, 58, 0.1);
        border-radius: 50px;
        display: inline-block;
        margin-top: 12px;
    }

    .clear-search {
        color: var(--rust);
        text-decoration: none;
        font-size: 0.8rem;
        transition: var(--transition);
    }

    .clear-search:hover {
        color: #b5532c;
        text-decoration: underline;
    }

    /* ── SECTION HEADER ── */
    .section-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-badge {
        font-family: 'DM Sans', sans-serif;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .2em;
        text-transform: uppercase;
        color: var(--rust);
        background: rgba(196, 96, 58, 0.1);
        padding: 5px 15px;
        border-radius: 100px;
        display: inline-block;
        margin-bottom: 15px;
    }

    .section-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 10px;
    }

    .section-header p {
        color: var(--muted);
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* ── TRIP CARDS ── */
    .trip-card {
        background: white;
        border-radius: var(--card-radius);
        overflow: hidden;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
        height: 100%;
    }

    .trip-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-md);
    }

    .trip-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 220px;
    }

    .trip-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .trip-card:hover .trip-image {
        transform: scale(1.1);
    }

    .trip-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 5px 12px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 600;
        z-index: 2;
    }

    .trip-badge.available {
        background: var(--rust);
        color: white;
    }

    .trip-badge.full {
        background: #6c757d;
        color: white;
    }

    .trip-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
    }

    .trip-price {
        color: white;
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 0;
    }

    .trip-card .card-body {
        padding: 20px;
    }

    .trip-card .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--ink);
    }

    .trip-info {
        color: var(--muted);
        font-size: 0.85rem;
        margin-bottom: 8px;
    }

    .trip-info i {
        width: 20px;
        color: var(--rust);
        margin-right: 8px;
    }

    .progress {
        height: 6px;
        background: var(--sand);
        border-radius: 10px;
    }

    .progress-bar {
        background: var(--rust);
        border-radius: 10px;
    }

    /* ── GALLERY CAROUSEL ── */
    .gallery-carousel-section {
        background: var(--sand);
        padding: 60px 0;
        border-radius: 20px;
    }

    .gallery-slide {
        height: 500px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        border-radius: var(--card-radius);
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-slide:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-md);
    }

    .gallery-slide::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 50%);
        transition: background 0.3s ease;
    }

    .gallery-slide:hover::before {
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 40%);
    }

    .gallery-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 40px 30px 30px;
        color: white;
        text-align: center;
        z-index: 2;
        transform: translateY(0);
        transition: transform 0.3s ease;
    }

    .gallery-slide:hover .gallery-caption {
        transform: translateY(-10px);
    }

    .gallery-caption h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .gallery-caption p {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0;
    }

    /* ── TESTIMONI CARDS ── */
    .testimonial-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 25px;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
        height: 100%;
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }

    .testimonial-card i.fa-quote-left {
        color: var(--rust);
        opacity: 0.3;
        font-size: 2rem;
        margin-bottom: 15px;
    }

    .testimonial-text {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.95rem;
        line-height: 1.6;
        color: var(--ink);
        margin-bottom: 20px;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: auto;
    }

    .testimonial-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, var(--rust), var(--rust-light));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        color: white;
        overflow: hidden;
    }

    .testimonial-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .testimonial-info h6 {
        font-weight: 700;
        margin-bottom: 4px;
        color: var(--ink);
    }

    .testimonial-info small {
        color: var(--muted);
        font-size: 0.75rem;
    }

    /* ── COMMENT FORM ── */
    .comment-form-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 40px;
        box-shadow: var(--shadow-sm);
    }

    .comment-form-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .form-control,
    .form-select {
        background: var(--paper);
        border: 1px solid var(--sand);
        border-radius: 8px;
        padding: 12px 15px;
        font-family: 'DM Sans', sans-serif;
        transition: var(--transition);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--rust);
        box-shadow: 0 0 0 3px rgba(196, 96, 58, 0.1);
        background: white;
    }

    /* ── LIGHTBOX STYLES  ── */
    .home-lightbox {
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(0, 0, 0, .95);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity .3s ease;
    }

    .home-lightbox.open {
        opacity: 1;
        pointer-events: all;
    }

    .home-lightbox-inner {
        position: relative;
        max-width: min(90vw, 900px);
        max-height: 92vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        transform: scale(.96);
        transition: transform .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    .home-lightbox.open .home-lightbox-inner {
        transform: scale(1);
    }

    .home-lightbox-inner img {
        max-width: 100%;
        max-height: 78vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, .5);
    }

    .home-lb-close {
        position: absolute;
        top: -50px;
        right: 0;
        background: none;
        border: none;
        color: rgba(255, 255, 255, .6);
        font-size: 2rem;
        cursor: pointer;
        transition: color .2s;
        z-index: 1;
    }

    .home-lb-close:hover {
        color: #fff;
    }

    .home-lb-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, .1);
        border: none;
        color: #fff;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        font-size: 1.5rem;
        cursor: pointer;
        transition: background .2s;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    .home-lb-nav:hover {
        background: rgba(255, 255, 255, .2);
    }

    .home-lb-prev {
        left: -70px;
    }

    .home-lb-next {
        right: -70px;
    }

    .lightbox-meta {
        margin-top: 20px;
        text-align: center;
    }

    .lightbox-meta .lt {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        color: #fff;
        font-weight: 600;
    }

    .lightbox-meta .la {
        font-size: .85rem;
        color: rgba(255, 255, 255, .6);
        letter-spacing: .1em;
        text-transform: uppercase;
        margin-top: 6px;
    }

    @media (max-width: 768px) {
        .home-lb-prev {
            left: 10px;
        }

        .home-lb-next {
            right: 10px;
        }

        .home-lb-nav {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }

        .search-form .btn-search {
            padding: 10px 20px;
            font-size: 0.85rem;
        }

        .search-form .form-control {
            font-size: 0.85rem;
            padding: 10px 0;
        }

        .search-info {
            font-size: 0.75rem;
            padding: 6px 12px;
        }
    }

    /* ── ANIMATIONS ── */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {

        .hero-slider,
        .hero-slide {
            height: 70vh;
            min-height: 500px;
        }

        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-content .lead {
            font-size: 1rem;
        }

        .hero-buttons .btn {
            padding: 8px 20px;
            font-size: 0.9rem;
        }

        .gallery-slide {
            height: 350px;
        }

        .gallery-caption {
            padding: 20px;
        }

        .gallery-caption h4 {
            font-size: 1.2rem;
        }

        .comment-form-card {
            padding: 25px;
        }
    }

    @media (max-width: 576px) {

        .hero-slider,
        .hero-slide {
            height: 60vh;
            min-height: 450px;
        }

        .gallery-slide {
            height: 280px;
        }

        .testimonial-card {
            padding: 20px;
        }
    }
</style>

<section class="hero-slider">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner" style="height: 70vh;">
            <div class="carousel-item active hero-slide" style="background-image: url('<?= base_url('assets/images/gunung1.jpg') ?>');">
                <div class="container h-100 d-flex align-items-center">
                    <div class="hero-content text-white">
                        <div class="hero-badge">OPEN TRIP 2025</div>
                        <h1>Explore The Mountains</h1>
                        <p class="lead">Jelajahi keindahan alam Indonesia bersama open trip pendakian profesional.</p>
                        <div class="hero-buttons">
                            <a href="#Trip" class="btn btn-success btn-lg me-3"><i class="fas fa-hiking me-2"></i> Lihat Trip</a>
                            <a href="#about" class="btn btn-outline-light btn-lg"><i class="fas fa-info-circle me-2"></i> Tentang Kami</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item hero-slide" style="background-image: url('<?= base_url('assets/images/gunung2.jpg') ?>');">
                <div class="container h-100 d-flex align-items-center">
                    <div class="hero-content text-white">
                        <div class="hero-badge">OPEN TRIP 2025</div>
                        <h1>Taklukkan Puncak Tertinggi</h1>
                        <p class="lead">Rasakan pengalaman mendaki bersama guide berpengalaman dan tim yang solid.</p>
                        <div class="hero-buttons">
                            <a href="#Trip" class="btn btn-success btn-lg me-3"><i class="fas fa-hiking me-2"></i> Lihat Trip</a>
                            <a href="#about" class="btn btn-outline-light btn-lg"><i class="fas fa-info-circle me-2"></i> Tentang Kami</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item hero-slide" style="background-image: url('<?= base_url('assets/images/gunung2.jpg') ?>');">
                <div class="container h-100 d-flex align-items-center">
                    <div class="hero-content text-white">
                        <div class="hero-badge">OPEN TRIP 2025</div>
                        <h1>Alam Liar Menanti Kamu</h1>
                        <p class="lead">Bergabunglah bersama ratusan pendaki yang telah mempercayai perjalanan mereka kepada kami.</p>
                        <div class="hero-buttons">
                            <a href="#Trip" class="btn btn-success btn-lg me-3"><i class="fas fa-hiking me-2"></i> Lihat Trip</a>
                            <a href="#about" class="btn btn-outline-light btn-lg"><i class="fas fa-info-circle me-2"></i> Tentang Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- HOW IT WORKS SECTION -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<section class="howitworks-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <h2 class="fw-bold mt-3">Cara Melakukan Pendaftaran Open Trip</h2>
            <p class="text-muted">Dengan Mengikuti langkah berikut untuk memulai petualangan Anda</p>
        </div>
        <div class="row g-4">

            <!-- STEP 1 -->
            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="800">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-mountain"></i>
                    </div>
                    <h5>Pilih Trip</h5>
                    <p>Lihat berbagai pilihan jadwal trip pendakian</p>
                    <div class="step-number">1</div>
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <h5>Booking Trip</h5>
                    <p>Lakukan reservasi trip sesuai jadwal</p>
                    <div class="step-number">2</div>
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="200">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h5>Pembayaran</h5>
                    <p>Lakukan pembayaran untuk mengamankan slot</p>
                    <div class="step-number">3</div>
                </div>
            </div>

            <!-- STEP 4 -->
            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="300">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-hiking"></i>
                    </div>
                    <h5>Berangkat</h5>
                    <p>Bertemu di meeting point dan mulai pendakian</p>
                    <div class="step-number">4</div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- OPEN TRIP SECTION -->
<section id="Trip" class="py-5">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-badge">TRIP</div>
            <h2>Trip Tersedia</h2>
            <p>Pilih destinasi pendakian favorit Anda dan mulai petualangan</p>
        </div>

        <!-- SEARCH FORM - Ditempatkan di dalam section trip -->
        <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-8 col-lg-6">
                <form action="<?= base_url('/#Trip') ?>" method="get" class="search-form">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0 ps-3">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input
                            type="text"
                            class="form-control border-0 py-3"
                            name="search"
                            placeholder="Cari trip berdasarkan nama atau lokasi..."
                            value="<?= esc($keyword ?? '') ?>"
                            autocomplete="off">
                        <button class="btn btn-search" type="submit">
                            <i class="fas fa-search me-2"></i> Cari
                        </button>
                    </div>
                    <?php if (!empty($keyword)): ?>
                        <div class="search-info mt-2 text-center">
                            <small class="text-muted">
                                <i class="fas fa-search me-1"></i>
                                Menampilkan hasil untuk: <strong>"<?= esc($keyword) ?>"</strong>
                                <a href="<?= base_url('/#Trip') ?>" class="clear-search ms-2">
                                    <i class="fas fa-times-circle"></i> Hapus filter
                                </a>
                            </small>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="row g-4">
            <?php if (!empty($trips)): ?>
                <?php foreach ($trips as $i => $trip): ?>
                    <?php
                    $quota = $trip['quota'] ?? 0;
                    $available = $trip['available'] ?? 0;
                    $booked = $quota - $available;
                    $percent = $quota > 0 ? ($booked / $quota) * 100 : 0;

                    // Format tanggal untuk ditampilkan
                    $formattedDate = '';
                    $day = '';
                    $month = '';
                    $monthName = '';
                    if (!empty($trip['departure_date'])) {
                        $dateObj = new DateTime($trip['departure_date']);
                        $monthNames = [
                            1 => 'Jan',
                            2 => 'Feb',
                            3 => 'Mar',
                            4 => 'Apr',
                            5 => 'Mei',
                            6 => 'Jun',
                            7 => 'Jul',
                            8 => 'Ags',
                            9 => 'Sep',
                            10 => 'Okt',
                            11 => 'Nov',
                            12 => 'Des'
                        ];
                        $month = (int)$dateObj->format('n');
                        $monthName = $monthNames[$month];
                        $day = $dateObj->format('d');
                        $formattedDate = $dateObj->format('d M Y');
                    }
                    ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                        <div class="trip-card">
                            <div class="trip-image-wrapper">
                                <?php if (!empty($trip['image'])): ?>
                                    <img src="<?= base_url('uploads/trips/' . $trip['image']) ?>"
                                        class="trip-image"
                                        alt="<?= esc($trip['title']) ?>">
                                <?php endif; ?>
                                <span class="trip-badge <?= $available > 0 ? 'available' : 'full' ?>">
                                    <?= $available > 0 ? 'Tersedia' : 'Full' ?>
                                </span>
                                <div class="trip-overlay">
                                    <div class="trip-price">Rp <?= number_format($trip['price'], 0, ',', '.') ?></div>
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title"><?= esc($trip['title']) ?></h5>
                                <div class="trip-info">
                                    <i class="fas fa-map-marker-alt"></i> <?= esc($trip['location']) ?>
                                </div>
                                <div class="trip-info">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?php if (!empty($trip['departure_date'])): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success me-2">
                                            <i class="fas fa-calendar-week me-1"></i> <?= $day . ' ' . $monthName ?>
                                        </span>
                                        <span class="text-muted"><?= $formattedDate ?></span>
                                    <?php else: ?>
                                        <span class="text-muted">Jadwal belum tersedia</span>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3 mt-3">
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span>Kuota Terisi</span>
                                        <span><?= $booked ?> / <?= $quota ?></span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?= $percent ?>%"></div>
                                    </div>
                                    <small class="text-muted mt-1 d-block">Sisa kuota: <?= $available ?> orang</small>
                                </div>

                                <?php if ($available == 0): ?>
                                    <button class="btn btn-secondary w-100" disabled>
                                        <i class="fas fa-ban me-2"></i> Trip Full
                                    </button>
                                <?php else: ?>
                                    <?php if (session()->get('isLoggedIn')): ?>
                                        <a href="<?= base_url('trips/detail/' . $trip['schedule_id']) ?>"
                                            class="btn btn-success w-100">
                                            <i class="fas fa-eye me-2"></i> Lihat Detail
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= base_url('login') ?>" class="btn btn-warning w-100">
                                            <i class="fas fa-sign-in-alt me-2"></i> Login untuk Booking
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-mountain fa-3x text-muted mb-3"></i>
                    <?php if (!empty($keyword)): ?>
                        <p class="text-muted">Tidak ada trip dengan kata kunci "<strong><?= esc($keyword) ?></strong>"</p>
                        <a href="<?= base_url('/#Trip') ?>" class="btn btn-outline-success mt-3">
                            <i class="fas fa-arrow-left me-2"></i> Lihat Semua Trip
                        </a>
                    <?php else: ?>
                        <p class="text-muted">Belum ada trip tersedia.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- GALLERY SECTION - Dokumentasi Gunung dengan Lightbox -->
<section class="gallery-carousel-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-badge">DOKUMENTASI</div>
            <h2>Momen Perjalanan</h2>
            <p>Dokumentasi perjalanan pendakian bersama peserta trip</p>
        </div>

        <?php if (!empty($galleryPhotos)): ?>
            <div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php foreach ($galleryPhotos as $index => $photo): ?>
                        <button type="button" data-bs-target="#carouselGallery" data-bs-slide-to="<?= $index ?>"
                            class="<?= $index === 0 ? 'active' : '' ?>"></button>
                    <?php endforeach; ?>
                </div>

                <div class="carousel-inner">
                    <?php foreach ($galleryPhotos as $index => $photo): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="gallery-slide"
                                style="background-image: url('<?= base_url('uploads/gallery/' . $photo['image']) ?>');"
                                onclick="openHomeLightbox(<?= $index ?>)">
                                <div class="gallery-caption">
                                    <h4><?= esc($photo['title'] ?? 'Dokumentasi Perjalanan') ?></h4>
                                    <p><?= esc($photo['album'] ?? 'Momen tak terlupakan bersama BLNTRK OUTDOOR') ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        <?php else: ?>
            <div class="text-center py-5 bg-white rounded-4">
                <i class="fas fa-camera fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada dokumentasi foto.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- TESTIMONI SECTION dengan Avatar Images -->
<section class="py-5">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-badge">TESTIMONI</div>
            <h2>Apa Kata Mereka?</h2>
            <p>Pengalaman peserta yang telah bergabung bersama kami</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $i => $c): ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                        <div class="testimonial-card">
                            <i class="fas fa-quote-left"></i>
                            <p class="testimonial-text"><?= esc($c['comment']) ?></p>
                            <div class="testimonial-author">
                                <div class="testimonial-avatar">
                                    <?php if (!empty($c['profile_image'])): ?>
                                        <img src="<?= base_url('uploads/profiles/' . $c['profile_image']) ?>"
                                            alt="<?= esc($c['name']) ?>">
                                    <?php else: ?>
                                        <?= strtoupper(substr($c['name'], 0, 1)) ?>
                                    <?php endif; ?>
                                </div>
                                <div class="testimonial-info">
                                    <h6><?= esc($c['name']) ?></h6>
                                    <small><?= date('d M Y', strtotime($c['created_at'])) ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-comment fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada testimoni dari peserta trip.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- KOMENTAR FORM SECTION -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="comment-form-card">
                    <div class="text-center mb-4">
                        <i class="fas fa-pen-alt fa-2x text-success mb-3"></i>
                        <h3>Bagikan Pengalaman Trip Anda</h3>
                        <p class="text-muted">Ceritakan pengalaman seru Anda selama perjalanan bersama kami</p>
                    </div>

                    <?php if (session()->get('isLoggedIn')): ?>
                        <form action="<?= base_url('comment/create') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pilih Trip</label>
                                <select name="trip_id" class="form-select" required>
                                    <option value="">Pilih trip yang telah Anda ikuti</option>
                                    <?php foreach ($trips as $trip): ?>
                                        <option value="<?= $trip['trip_id'] ?>">
                                            <?= esc($trip['title']) ?> - <?= !empty($trip['departure_date']) ? date('d M Y', strtotime($trip['departure_date'])) : 'Jadwal belum tersedia' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Komentar / Testimoni</label>
                                <textarea name="comment" class="form-control" rows="5"
                                    placeholder="Ceritakan pengalaman Anda..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Komentar
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-lock fa-2x text-muted mb-3"></i>
                            <p class="mb-3">Silakan login terlebih dahulu untuk memberikan komentar.</p>
                            <a href="<?= base_url('login') ?>" class="btn btn-success">
                                <i class="fas fa-sign-in-alt me-2"></i> Login Sekarang
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Home Lightbox -->
<div class="home-lightbox" id="homeLightbox" onclick="closeHomeLightbox(event)">
    <div class="home-lightbox-inner">
        <button class="home-lb-close" onclick="closeHomeLightbox()">&times;</button>
        <button class="home-lb-nav home-lb-prev" onclick="shiftHomePhoto(-1)">&#8592;</button>
        <img id="homeLbImg" src="" alt="">
        <button class="home-lb-nav home-lb-next" onclick="shiftHomePhoto(1)">&#8594;</button>
        <div class="lightbox-meta">
            <div class="lt" id="homeLbTitle"></div>
            <div class="la" id="homeLbAlbum"></div>
        </div>
    </div>
</div>

<script>
    // Home Gallery Lightbox Data
    let homePhotos = [];
    let homeCurrent = 0;

    // Load gallery photos data
    <?php if (!empty($galleryPhotos)): ?>
        homePhotos = [
            <?php foreach ($galleryPhotos as $photo): ?> {
                    src: '<?= base_url('uploads/gallery/' . $photo['image']) ?>',
                    title: '<?= addslashes($photo['title'] ?? 'Dokumentasi Perjalanan') ?>',
                    album: '<?= addslashes($photo['album'] ?? 'Momen Tak Terlupakan') ?>'
                },
            <?php endforeach; ?>
        ];
    <?php endif; ?>

    function openHomeLightbox(index) {
        homeCurrent = index;
        renderHomeLightbox();
        document.getElementById('homeLightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeHomeLightbox(e) {
        if (e && e.target !== document.getElementById('homeLightbox') && !e.target.classList.contains('home-lb-close')) return;
        document.getElementById('homeLightbox').classList.remove('open');
        document.body.style.overflow = '';
    }

    function shiftHomePhoto(dir) {
        homeCurrent = (homeCurrent + dir + homePhotos.length) % homePhotos.length;
        renderHomeLightbox();
        if (event) event.stopPropagation();
    }

    function renderHomeLightbox() {
        const p = homePhotos[homeCurrent];
        document.getElementById('homeLbImg').src = p.src;
        document.getElementById('homeLbTitle').textContent = p.title;
        document.getElementById('homeLbAlbum').textContent = p.album;
    }

    // Keyboard navigation for home lightbox
    document.addEventListener('keydown', e => {
        const lb = document.getElementById('homeLightbox');
        if (!lb.classList.contains('open')) return;
        if (e.key === 'Escape') {
            lb.classList.remove('open');
            document.body.style.overflow = '';
        }
        if (e.key === 'ArrowLeft') shiftHomePhoto(-1);
        if (e.key === 'ArrowRight') shiftHomePhoto(1);
    });

    // Inisialisasi carousel manual
    document.addEventListener('DOMContentLoaded', function() {
        var carouselEl = document.getElementById('heroCarousel');
        if (carouselEl) {
            new bootstrap.Carousel(carouselEl, {
                interval: 5000,
                ride: 'carousel',
                wrap: true
            });
        }
    });

    // Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            // Lewati jika ini bagian dari carousel Bootstrap
            if (
                this.closest('.carousel') ||
                this.hasAttribute('data-bs-slide') ||
                this.hasAttribute('data-bs-slide-to') ||
                href === '#'
            ) return;

            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Initialize AOS if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    }
</script>

<?= $this->endSection() ?>