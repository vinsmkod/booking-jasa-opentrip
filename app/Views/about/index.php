<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    /* Hero Section */
    .hero-about {
        position: relative;
        height: 90vh;
        min-height: 600px;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        text-align: center;
        color: white;
    }

    .hero-about::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.4) 100%);
    }

    .hero-about .container {
        position: relative;
        z-index: 2;
    }

    .hero-about h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero-about p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto;
        opacity: 0.95;
    }

    .btn-hero {
        background: linear-gradient(135deg, #c4603a, #b5532c);
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        margin-top: 30px;
    }

    .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(196, 96, 58, 0.3);
        color: white;
    }

    /* Statistics Section */
    .stats-section {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 60px 0;
    }

    .stat-card {
        text-align: center;
        padding: 30px 20px;
        background: white;
        border-radius: 20px;
        transition: all 0.3s;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.1);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #c4603a, #b5532c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
        display: inline-block;
    }

    .stat-label {
        color: #64748b;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* About Section */
    .about-section {
        padding: 80px 0;
        background: white;
    }

    .about-image {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.1);
    }

    .about-image img {
        width: 100%;
        transition: transform 0.5s;
    }

    .about-image:hover img {
        transform: scale(1.05);
    }

    .about-content h2 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 20px;
    }

    .about-badge {
        display: inline-block;
        background: #c4603a10;
        color: #c4603a;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .about-content p {
        color: #475569;
        line-height: 1.7;
        margin-bottom: 15px;
    }

    /* How It Works */
    .howitworks-section {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
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
        background: linear-gradient(135deg, #c4603a, #b5532c);
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
        background: #c4603a;
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

    /* Why Choose Us */
    .whyus-section {
        padding: 80px 0;
        background: white;
    }

    .feature-card {
        text-align: center;
        padding: 30px 20px;
        background: #f8fafc;
        border-radius: 20px;
        transition: all 0.3s;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        background: white;
        box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        width: 70px;
        height: 70px;
        background: #c4603a10;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .feature-icon i {
        font-size: 2rem;
        color: #c4603a;
    }

    .feature-card h5 {
        font-weight: 700;
        margin-bottom: 10px;
        color: #0f172a;
    }

    .feature-card p {
        color: #64748b;
        font-size: 0.9rem;
    }

    /* Gallery Section */
    .gallery-section {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 80px 0;
    }

    .gallery-item {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
    }

    .gallery-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        padding: 20px;
        transform: translateY(100%);
        transition: transform 0.3s;
    }

    .gallery-item:hover .gallery-overlay {
        transform: translateY(0);
    }

    .gallery-overlay p {
        color: white;
        margin: 0;
        font-size: 0.85rem;
    }

    /* Testimonial Section */
    .testimonial-section {
        padding: 80px 0;
        background: white;
    }

    .testimonial-card {
        background: #f8fafc;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        transition: all 0.3s;
        height: 100%;
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.1);
    }

    .testimonial-card i {
        font-size: 2rem;
        color: #c4603a;
        opacity: 0.3;
        margin-bottom: 15px;
    }

    .testimonial-card p {
        color: #475569;
        font-style: italic;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .testimonial-card h6 {
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 5px;
    }

    .testimonial-card small {
        color: #64748b;
        font-size: 0.8rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #c4603a 0%, #b5532c 100%);
        padding: 80px 0;
        text-align: center;
        color: white;
    }

    .cta-section h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .cta-section p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto 30px;
    }

    .btn-cta {
        background: white;
        color: #c4603a;
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
    }

    .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        color: #c4603a;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-about h1 {
            font-size: 2rem;
        }

        .hero-about p {
            font-size: 1rem;
        }

        .about-content h2 {
            font-size: 1.6rem;
        }

        .cta-section h2 {
            font-size: 1.8rem;
        }

        .gallery-item img {
            height: 200px;
        }

        .stat-number {
            font-size: 2rem;
        }
    }
</style>

<!-- HERO SECTION -->
<section class="hero-about"
    style="background:url('<?= base_url('assets/images/gunung1.jpg') ?>') center/cover no-repeat fixed;">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="display-4 fw-bold">Open Trip Pendakian Gunung</h1>
        <p class="lead mt-3">
            Jelajahi keindahan alam Indonesia bersama komunitas pendaki dari berbagai daerah
        </p>
        <a href="<?= base_url('trips') ?>" class="btn btn-hero" data-aos="zoom-in" data-aos-delay="300">
            <i class="fas fa-mountain me-2"></i> Lihat Jadwal Trip
        </a>
    </div>
</section>

<!-- STATISTICS SECTION dengan Animasi Counter -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-duration="800">
                <div class="stat-card">
                    <div class="stat-number" data-target="1500" data-suffix="+">0</div>
                    <div class="stat-label">Pendaki Bergabung</div>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <div class="stat-card">
                    <div class="stat-number" data-target="80" data-suffix="+">0</div>
                    <div class="stat-label">Trip Pendakian</div>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <div class="stat-card">
                    <div class="stat-number" data-target="25" data-suffix="">0</div>
                    <div class="stat-label">Gunung Dijelajahi</div>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-number" data-target="5" data-suffix="">0</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                <div class="about-image">
                    <img src="<?= base_url('assets/images/hiking.jpg') ?>" class="img-fluid" alt="Hiking">
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000">
                <div class="about-content">
                    <div class="about-badge">
                        <i class="fas fa-flag-checkered me-1"></i> Tentang Kami
                    </div>
                    <h2>Tentang BLNTRK Outdoor</h2>
                    <p class="text-success fw-semibold">
                        Platform open trip pendakian gunung berbasis online
                    </p>
                    <p>
                        BLNTRK Outdoor merupakan platform layanan open trip pendakian gunung
                        yang dirancang untuk memudahkan para pecinta alam dalam merencanakan
                        perjalanan pendakian secara praktis, aman, dan terorganisir.
                    </p>
                    <p>
                        Melalui website ini pengguna dapat melihat jadwal trip,
                        melakukan reservasi online, melakukan pembayaran,
                        serta memperoleh informasi lengkap mengenai meeting point,
                        itinerary perjalanan, dan detail kegiatan pendakian.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS SECTION -->
<section class="howitworks-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="about-badge d-inline-block">
                <i class="fas fa-compass me-1"></i> Cara Bergabung
            </div>
            <h2 class="fw-bold mt-3">Cara Mengikuti Open Trip</h2>
            <p class="text-muted">Ikuti langkah mudah berikut untuk memulai petualangan</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="800">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h5>Pilih Trip</h5>
                    <p>Lihat berbagai pilihan jadwal trip pendakian</p>
                    <div class="step-number">1</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h5>Booking Trip</h5>
                    <p>Lakukan reservasi trip sesuai jadwal</p>
                    <div class="step-number">2</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="200">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h5>Pembayaran</h5>
                    <p>Lakukan pembayaran untuk mengamankan slot</p>
                    <div class="step-number">3</div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="300">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-people-arrows"></i>
                    </div>
                    <h5>Berangkat</h5>
                    <p>Bertemu di meeting point dan mulai pendakian</p>
                    <div class="step-number">4</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY CHOOSE US SECTION -->
<section class="whyus-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="about-badge d-inline-block">
                <i class="fas fa-star me-1"></i> Keunggulan
            </div>
            <h2 class="fw-bold mt-3">Why Choose BLNTRK Outdoor</h2>
            <p class="text-muted">Kami menghadirkan pengalaman pendakian yang aman dan profesional</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-duration="800">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-map"></i>
                    </div>
                    <h5>Trip Terorganisir</h5>
                    <p>Perjalanan memiliki itinerary yang jelas dan terstruktur</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Keamanan Terjamin</h5>
                    <p>Didampingi oleh guide berpengalaman dan profesional</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h5>Booking Online</h5>
                    <p>Reservasi trip dapat dilakukan secara online kapan saja</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GALLERY SECTION -->
<section class="gallery-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="about-badge d-inline-block">
                <i class="fas fa-camera me-1"></i> Galeri
            </div>
            <h2 class="fw-bold mt-3">Pengalaman Pendakian</h2>
            <p class="text-muted">Beberapa momen perjalanan bersama peserta open trip</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in" data-aos-duration="800">
                <div class="gallery-item">
                    <img src="<?= base_url('assets/images/gunung1.jpeg') ?>" class="img-fluid" alt="Gunung 1">
                    <div class="gallery-overlay">
                        <p><i class="fas fa-mountain"></i> Pendakian Gunung Rinjani</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
                <div class="gallery-item">
                    <img src="<?= base_url('assets/images/gunung2.jpeg') ?>" class="img-fluid" alt="Gunung 2">
                    <div class="gallery-overlay">
                        <p><i class="fas fa-mountain"></i> Puncak Gunung Semeru</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="200">
                <div class="gallery-item">
                    <img src="<?= base_url('assets/images/gunung3.jpeg') ?>" class="img-fluid" alt="Gunung 3">
                    <div class="gallery-overlay">
                        <p><i class="fas fa-mountain"></i> Sunrise di Gunung Bromo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIAL SECTION -->
<section class="testimonial-section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="about-badge d-inline-block">
                <i class="fas fa-comment-dots me-1"></i> Testimoni
            </div>
            <h2 class="fw-bold mt-3">Apa Kata Pendaki</h2>
            <p class="text-muted">Pengalaman nyata dari para peserta open trip</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-duration="800">
                <div class="testimonial-card">
                    <i class="fas fa-quote-left"></i>
                    <p>"Tripnya seru dan sangat terorganisir! Guide profesional dan pemandangan luar biasa."</p>
                    <h6>Rizky</h6>
                    <small>Jakarta - Rinjani 2025</small>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <div class="testimonial-card">
                    <i class="fas fa-quote-left"></i>
                    <p>"Guide profesional dan perjalanan aman. Pengalaman tak terlupakan bersama komunitas baru."</p>
                    <h6>Dewi</h6>
                    <small>Bandung - Semeru 2024</small>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <div class="testimonial-card">
                    <i class="fas fa-quote-left"></i>
                    <p>"Pengalaman pendakian terbaik bersama komunitas baru. Booking mudah, pelayanan ramah!"</p>
                    <h6>Andi</h6>
                    <small>Surabaya - Bromo 2025</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="cta-section">
    <div class="container" data-aos="zoom-in" data-aos-duration="1000">
        <h2>Siap Memulai Petualangan?</h2>
        <p>Temukan jadwal open trip pendakian gunung dan bergabunglah bersama kami.</p>
        <a href="<?= base_url('trips') ?>" class="btn btn-cta" data-aos="fade-up" data-aos-delay="300">
            <i class="fas fa-arrow-right me-2"></i> Lihat Trip Sekarang
        </a>
    </div>
</section>

<script>
    // Initialize AOS
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100,
                easing: 'ease-out-cubic'
            });
        }

        // =========================================
        // COUNTER ANIMATION FOR STATISTICS
        // =========================================

        // Fungsi untuk animasi counter
        function animateCounter(element, target, suffix, duration = 2000) {
            let start = 0;
            const startTime = performance.now();

            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);

                // Easing function untuk animasi yang lebih smooth
                const easeOutCubic = 1 - Math.pow(1 - progress, 3);
                const currentValue = Math.floor(easeOutCubic * target);

                if (progress < 1) {
                    element.textContent = currentValue.toLocaleString('id-ID') + suffix;
                    requestAnimationFrame(update);
                } else {
                    element.textContent = target.toLocaleString('id-ID') + suffix;
                }
            }

            requestAnimationFrame(update);
        }

        // Intersection Observer untuk trigger saat elemen masuk viewport
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    const suffix = entry.target.getAttribute('data-suffix') || '';

                    if (!isNaN(target)) {
                        animateCounter(entry.target, target, suffix);
                        entry.target.classList.add('animated');
                    }
                }
            });
        }, observerOptions);

        // Observe semua elemen dengan class stat-number
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            observer.observe(stat);
        });
    });
</script>

<?= $this->endSection() ?>