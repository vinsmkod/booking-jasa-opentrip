<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap');

    :root {
        --ink: #0f0e0d;
        --paper: #f5f2ed;
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
        height: 90vh;
        min-height: 600px;
        overflow: hidden;
    }

    .hero-slide {
        height: 90vh;
        min-height: 600px;
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
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.7) 100%);
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
        background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
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
    }

    .gallery-slide {
        height: 500px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        border-radius: var(--card-radius);
        overflow: hidden;
    }

    .gallery-slide::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 50%);
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
    }

    .gallery-caption h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 10px;
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

<!-- HERO SLIDER -->
<section class="hero-slider">
    <div id="heroCarousel" class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
                <div class="hero-slide" style="background-image: url('<?= base_url('assets/images/gunung1.jpg') ?>');">
                    <div class="container h-100 d-flex align-items-center">
                        <div class="hero-content text-white">
                            <div class="hero-badge">OPEN TRIP 2025</div>
                            <h1>Explore The Mountains</h1>
                            <p class="lead">Jelajahi keindahan alam Indonesia bersama open trip pendakian profesional.</p>
                            <div class="hero-buttons">
                                <a href="#Trip" class="btn btn-success btn-lg me-3">
                                    <i class="fas fa-hiking me-2"></i> Lihat Trip
                                </a>
                                <a href="#about" class="btn btn-outline-light btn-lg">
                                    <i class="fas fa-info-circle me-2"></i> Tentang Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item h-100">
                <div class="hero-slide" style="background-image: url('<?= base_url('assets/images/gunung2.jpg') ?>');">
                    <div class="container h-100 d-flex align-items-center">
                        <div class="hero-content text-white">
                            <div class="hero-badge">ADVENTURE AWAITS</div>
                            <h1>Adventure Awaits</h1>
                            <p class="lead">Temukan pengalaman pendakian yang aman, nyaman, dan berkesan bersama kami.</p>
                            <div class="hero-buttons">
                                <a href="#Trip" class="btn btn-success btn-lg me-3">
                                    <i class="fas fa-calendar-check me-2"></i> Booking Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item h-100">
                <div class="hero-slide" style="background-image: url('<?= base_url('assets/images/gunung3.jpeg') ?>');">
                    <div class="container h-100 d-flex align-items-center">
                        <div class="hero-content text-white">
                            <div class="hero-badge">JOIN THE COMMUNITY</div>
                            <h1>Join Our Open Trip</h1>
                            <p class="lead">Bergabunglah dengan komunitas pendaki dari seluruh Indonesia.</p>
                            <div class="hero-buttons">
                                <a href="#Trip" class="btn btn-success btn-lg me-3">
                                    <i class="fas fa-users me-2"></i> Mulai Petualangan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- OPEN TRIP SECTION -->
<section id="Trip" class="py-5">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-badge">OPEN TRIP</div>
            <h2>Trip Tersedia</h2>
            <p>Pilih destinasi pendakian favorit Anda dan mulai petualangan</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($trips)): ?>
                <?php foreach ($trips as $i => $trip): ?>
                    <?php
                    $quota = $trip['quota'] ?? 0;
                    $available = $trip['available'] ?? 0;
                    $booked = $quota - $available;
                    $percent = $quota > 0 ? ($booked / $quota) * 100 : 0;
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
                                    <?= !empty($trip['departure_date']) ? date('d M Y', strtotime($trip['departure_date'])) : 'Jadwal belum tersedia' ?>
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
                    <p class="text-muted">Belum ada trip tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- GALLERY SECTION - Dokumentasi Gunung -->
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
                            <div class="gallery-slide" style="background-image: url('<?= base_url('uploads/mountains/' . $photo['image']) ?>');">
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

<!-- TESTIMONI SECTION -->
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
                                    <?= strtoupper(substr($c['name'], 0, 1)) ?>
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

<script>
    // Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
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