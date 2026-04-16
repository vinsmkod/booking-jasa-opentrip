<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/about.css') ?>">
<?= $this->endSection() ?>
 
<?= $this->section('content') ?>


<!-- HERO SECTION -->
<section class="hero-about"
    style="background:url('<?= base_url('assets/images/gunung4.jpeg') ?>') center/cover no-repeat;">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="display-4 fw-bold">Trip Pendakian Gunung</h1>
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

            <!-- IMAGE -->
            <div class="col-md-6" data-aos="fade-right" data-aos-duration="1000">
                <div class="about-image-wrapper">

                    <div class="about-image-main">
                        <img src="<?= base_url('assets/images/gunung1.jpg') ?>"
                            alt="Pendakian Gunung">
                    </div>

                    <div class="about-image-small">
                        <img src="<?= base_url('assets/images/pendaki1.jpeg') ?>"
                            alt="Open Trip">
                    </div>

                </div>
            </div>

            <!-- TEXT -->
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

<!-- CTA SECTION -->
<section class="cta-section">
    <div class="container" data-aos="zoom-in" data-aos-duration="1000">
        <h2 class="text-white">Siap Memulai Petualangan?</h2>
        <p class="text-white">Temukan jadwal open trip pendakian gunung dan bergabunglah bersama kami.</p>
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