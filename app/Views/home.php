<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/home_.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- ══════════════════════════════════════════ HERO STATIC ══════════════════════════════════════════ -->
<section class="hero-slider hero-slide d-flex align-items-center" style="background-image:url('<?= base_url('assets/images/gunung4.jpeg') ?>');">
    <div class="container position-relative" style="z-index: 2;">
        <div class="hero-content text-white">
            <span class="badge bg-rust rounded-pill fw-semibold text-uppercase mb-3 px-4 py-2" style="letter-spacing:.3em;font-size:12px;">OPEN TRIP 2025</span>
            <h1 class="fw-bold mb-3 text-white">Explore The Mountains</h1>
            <p class="lead fw-light mb-4 opacity-90 text-white">Jelajahi keindahan alam Indonesia bersama open trip pendakian profesional.</p>
            <div class="d-flex gap-3 flex-wrap">
                <a href="#Trip" class="btn btn-success btn-lg fw-semibold px-4"><i class="fas fa-hiking me-2"></i>Lihat Trip</a>
                <a href="#about" class="btn btn-outline-light btn-lg fw-semibold px-4"><i class="fas fa-info-circle me-2"></i>Tentang Kami</a>
            </div> 
        </div>
    </div>
</section>

<div class="content-wrapper">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- HOW IT WORKS -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="800">
                <h2 class="fw-bold mt-5">Cara Melakukan Pendaftaran Trip</h2>
                <p class="text-muted">Dengan mengikuti langkah berikut untuk memulai petualangan Anda</p>
            </div>
            <div class="row g-4">
                <?php
                $steps = [
                    ['icon' => 'fa-mountain',      'title' => 'Pilih Trip',    'desc' => 'Lihat berbagai pilihan jadwal trip pendakian',   'no' => 1, 'delay' => 0],
                    ['icon' => 'fa-calendar-plus', 'title' => 'Booking Trip',  'desc' => 'Lakukan reservasi trip sesuai jadwal',           'no' => 2, 'delay' => 100],
                    ['icon' => 'fa-wallet',        'title' => 'Pembayaran',    'desc' => 'Lakukan pembayaran untuk mengamankan slot',      'no' => 3, 'delay' => 200],
                    ['icon' => 'fa-hiking',        'title' => 'Berangkat',     'desc' => 'Bertemu di meeting point dan mulai pendakian',   'no' => 4, 'delay' => 300],
                ];
                foreach ($steps as $s):
                ?>
                    <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="<?= $s['delay'] ?>">
                        <div class="text-center p-4 bg-white rounded-4 h-100 shadow-sm"
                            style="transition:all .3s;"
                            onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 25px -10px rgba(0,0,0,.1)'"
                            onmouseout="this.style.transform='';this.style.boxShadow=''">
                            <div class="d-flex align-items-center justify-content-center mx-auto mb-3 bg-success rounded-circle" style="width:80px;height:80px;">
                                <i class="fas <?= $s['icon'] ?> fa-2x text-white"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2"><?= $s['title'] ?></h5>
                            <p class="text-secondary small mb-3"><?= $s['desc'] ?></p>
                            <div class="d-flex align-items-center justify-content-center mx-auto bg-success rounded-circle text-white fw-bold"
                                style="width:30px;height:30px;font-size:.8rem;"><?= $s['no'] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- OPEN TRIP SECTION -->
    <section id="Trip" class="py-5">
        <div class="container">

            <div class="text-center mb-3" data-aos="fade-up">
                <span class="badge rounded-pill fw-semibold text-uppercase px-3 py-2 mb-3"
                    style="font-size:11px;letter-spacing:.2em;background-color:rgba(196,96,58,.1);color:var(--rust);">TRIP</span>
                <h2 class="fw-bold" style="font-family:'Playfair Display',serif;">Trip Tersedia</h2>
                <p class="text-muted">Pilih destinasi pendakian favorit Anda dan mulai petualangan</p>
            </div>

            <!-- Search -->
            <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="100">
                <div class="col-md-8 col-lg-6">
                    <form action="<?= base_url('/#Trip') ?>" method="get">
                        <div class="input-group rounded-pill overflow-hidden shadow-sm border border-2"
                            style="border-color:transparent!important;"
                            onfocusin="this.style.borderColor='var(--rust)';"
                            onfocusout="this.style.borderColor='transparent';">
                            <span class="input-group-text bg-white border-0 ps-3">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control bg-white border-0 py-3"
                                name="search"
                                placeholder="Cari trip berdasarkan nama atau lokasi..."
                                value="<?= esc($keyword ?? '') ?>"
                                autocomplete="off">
                            <button class="btn btn-rust px-4 fw-semibold rounded-0 rounded-end-pill" type="submit">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                        <?php if (!empty($keyword)): ?>
                            <div class="text-center mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-search me-1"></i>
                                    Menampilkan hasil untuk: <strong>"<?= esc($keyword) ?>"</strong>
                                    <a href="<?= base_url('/#Trip') ?>" class="text-decoration-none ms-2" style="color:var(--rust);">
                                        <i class="fas fa-times-circle"></i> Hapus filter
                                    </a>
                                </small>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <!-- Trip Cards -->
            <div class="row g-4">
                <?php if (!empty($trips)): ?>
                    <?php foreach ($trips as $i => $trip): ?>
                        <?php
                        $quota     = $trip['quota'] ?? 0;
                        $available = $trip['available'] ?? 0;
                        $booked    = $quota - $available;
                        $percent   = $quota > 0 ? ($booked / $quota) * 100 : 0;
                        $formattedDate = $day = $monthName = '';
                        if (!empty($trip['departure_date'])) {
                            $dateObj    = new DateTime($trip['departure_date']);
                            $monthNames = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Ags', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];
                            $monthName  = $monthNames[(int)$dateObj->format('n')];
                            $day        = $dateObj->format('d');
                            $formattedDate = $dateObj->format('d M Y');
                        }

                        // Badge tipe trip
                        $tripType = $trip['type'] ?? 'open_trip';
                        $typeConfig = [
                            'open_trip'    => ['label' => 'Open Trip',    'icon' => 'fa-users', 'bg' => '#2d6a4f'],
                            'private_trip' => ['label' => 'Private Trip', 'icon' => 'fa-lock',  'bg' => '#7b3f00'],
                            'one_day_trip' => ['label' => 'One Day Trip', 'icon' => 'fa-sun',   'bg' => '#0a4f7a'],
                        ];
                        $tc = $typeConfig[$tripType] ?? $typeConfig['open_trip'];
                        ?>
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                            <div class="card border-0 rounded-3 overflow-hidden h-100 shadow-sm trip-card"
                                style="transition:all .3s;"
                                onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 4px 12px rgba(0,0,0,.1)'"
                                onmouseout="this.style.transform='';this.style.boxShadow=''">

                                <div class="trip-image-wrapper position-relative">
                                    <?php if (!empty($trip['image'])): ?>
                                        <img src="<?= base_url('uploads/trips/' . $trip['image']) ?>" class="trip-image" alt="<?= esc($trip['title']) ?>">
                                    <?php endif; ?>

                                    <!-- Badge Tipe Trip (kiri atas) -->
                                    <span class="badge position-absolute top-0 start-0 m-3 rounded-pill px-3 py-2 shadow-sm"
                                        style="z-index:2;background-color:<?= $tc['bg'] ?>;color:#fff;font-size:11px;">
                                        <i class="fas <?= $tc['icon'] ?> me-1"></i><?= $tc['label'] ?>
                                    </span>

                                    <!-- Badge Ketersediaan (kanan atas) -->
                                    <span class="badge position-absolute top-0 end-0 m-3 rounded-pill px-3 py-2 shadow-sm"
                                        style="z-index:2;background-color:<?= $available > 0 ? '#2d6a4f' : '#6c757d' ?>;color:#fff;font-size:11px;">
                                        <i class="fas <?= $available > 0 ? 'fa-check-circle' : 'fa-ban' ?> me-1"></i>
                                        <?= $available > 0 ? 'Tersedia' : 'Full' ?>
                                    </span>

                                    <div class="trip-overlay">
                                        <p class="text-white fs-5 fw-bold mb-0">Rp <?= number_format($trip['price'], 0, ',', '.') ?></p>
                                    </div>
                                </div>

                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-3" style="font-family:'Playfair Display',serif;"><?= esc($trip['title']) ?></h5>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-map-marker-alt me-2" style="width:20px;color:var(--rust);"></i><?= esc($trip['location']) ?>
                                    </p>
                                    <p class="text-muted small mb-3">
                                        <i class="fas fa-calendar-alt me-2" style="width:20px;color:var(--rust);"></i>
                                        <?php if (!empty($trip['departure_date'])): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success me-2">
                                                <i class="fas fa-calendar-week me-1"></i><?= $day . ' ' . $monthName ?>
                                            </span>
                                            <span class="text-muted"><?= $formattedDate ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">Jadwal belum tersedia</span>
                                        <?php endif; ?>
                                    </p>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span>Pendaftar</span>
                                            <span><?= $booked ?> / <?= $quota ?></span>
                                        </div>
                                        <div class="progress" style="height:6px;">
                                            <div class="progress-bar" style="width:<?= $percent ?>%;background-color:var(--rust);"></div>
                                        </div>
                                    </div>
                                    <?php if ($available == 0): ?>
                                        <button class="btn btn-secondary w-100" disabled><i class="fas fa-ban me-2"></i>Trip Full</button>
                                    <?php elseif (session()->get('isLoggedIn')): ?>
                                        <a href="<?= base_url('trips/detail/' . $trip['schedule_id']) ?>" class="btn btn-success w-100">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= base_url('login') ?>" class="btn btn-warning w-100">
                                            <i class="fas fa-sign-in-alt me-2"></i>Login untuk Booking
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-mountain fa-3x text-muted mb-3"></i>
                        <?php if (!empty($keyword)): ?>
                            <p class="text-muted">Tidak ada trip dengan kata kunci "<strong><?= esc($keyword) ?>"</strong>"</p>
                            <a href="<?= base_url('/#Trip') ?>" class="btn btn-outline-success mt-3">
                                <i class="fas fa-arrow-left me-2"></i>Lihat Semua Trip
                            </a>
                        <?php else: ?>
                            <p class="text-muted">Belum ada trip tersedia.</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div><!-- /row trip cards -->

        </div><!-- /container -->
    </section><!-- /section#Trip -->

</div><!-- /content-wrapper -->


<!-- ══════════════════════════════════════════
     GALLERY — full width 
══════════════════════════════════════════ -->
<section class="py-5" style="background:var(--sand);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge rounded-pill fw-semibold text-uppercase px-3 py-2 mb-3"
                style="font-size:11px;letter-spacing:.2em;background-color:rgba(196,96,58,.1);color:var(--rust);">DOKUMENTASI</span>
            <h2 class="fw-bold" style="font-family:'Playfair Display',serif;">Momen Perjalanan</h2>
            <p class="text-muted">Dokumentasi perjalanan pendakian bersama peserta trip</p>
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
                                style="background-image:url('<?= base_url('uploads/gallery/' . $photo['image']) ?>');"
                                onclick="openHomeLightbox(<?= $index ?>)">
                                <div class="gallery-caption text-white text-center">
                                    <h4><?= esc($photo['title'] ?? 'Dokumentasi Perjalanan') ?></h4>
                                    <p class="small opacity-90 mb-0"><?= esc($photo['album'] ?? 'Momen tak terlupakan bersama BLNTRK OUTDOOR') ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span>
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


<!-- ══════════════════════════════════════════
     TESTIMONI + FORM — kembali pakai wrapper
══════════════════════════════════════════ -->
<div class="content-wrapper">

    <!-- TESTIMONI -->
    <section class="py-12">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge rounded-pill fw-semibold text-uppercase px-3 py-2 mb-3"
                    style="font-size:11px;letter-spacing:.2em;background-color:rgba(196,96,58,.1);color:var(--rust);">TESTIMONI</span>
                <h2 class="fw-bold" style="font-family:'Playfair Display',serif;">Apa Kata Mereka?</h2>
                <p class="text-muted">Pengalaman peserta yang telah bergabung bersama kami</p>
            </div>

            <div class="row g-4">
                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $i => $c): ?>
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                            <div class="card border-0 rounded-3 p-4 shadow-sm h-100"
                                style="transition:all .3s;"
                                onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 4px 12px rgba(0,0,0,.1)'"
                                onmouseout="this.style.transform='';this.style.boxShadow=''">
                                <i class="fas fa-quote-left fa-2x mb-3" style="color:var(--rust);opacity:.3;"></i>
                                <p class="small lh-lg text-dark mb-4"><?= esc($c['comment']) ?></p>
                                <div class="d-flex align-items-center gap-3 mt-auto">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white overflow-hidden flex-shrink-0"
                                        style="width:45px;height:45px;background:linear-gradient(135deg,var(--rust),var(--rust-light));font-size:1.1rem;">
                                        <?php if (!empty($c['avatar'])): ?>
                                            <img src="<?= base_url('uploads/avatars/' . $c['avatar']) ?>" alt="<?= esc($c['name']) ?>" style="width:100%;height:100%;object-fit:cover;">
                                        <?php else: ?>
                                            <?= strtoupper(substr($c['name'], 0, 1)) ?>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark"><?= esc($c['name']) ?></h6>
                                        <small class="text-muted"><?= date('d M Y', strtotime($c['created_at'])) ?></small>
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


    <!-- KOMENTAR FORM -->
    <section class="py-5 bg-light rounded-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="card border-0 rounded-3 p-4 p-md-5 shadow-sm">
                        <div class="text-center mb-4">
                            <i class="fas fa-pen-alt fa-2x text-success mb-3"></i>
                            <h3 class="fw-bold" style="font-family:'Playfair Display',serif;">Bagikan Pengalaman Trip Anda</h3>
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
                                    <textarea name="comment" class="form-control" rows="5" placeholder="Ceritakan pengalaman Anda..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Komentar
                                </button>
                            </form>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-lock fa-2x text-muted mb-3"></i>
                                <p class="mb-3">Silakan login terlebih dahulu untuk memberikan komentar.</p>
                                <a href="<?= base_url('login') ?>" class="btn btn-success fw-semibold px-4">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login Sekarang
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div><!-- /content-wrapper -->


<!-- ══════════════════════════════════════════
     HOME LIGHTBOX
══════════════════════════════════════════ -->
<div class="home-lightbox" id="homeLightbox" onclick="closeHomeLightbox(event)">
    <div class="home-lightbox-inner">
        <button class="home-lb-close" onclick="closeHomeLightbox()">&times;</button>
        <button class="home-lb-nav home-lb-prev" onclick="shiftHomePhoto(-1)">&#8592;</button>
        <img id="homeLbImg" src="" alt="">
        <button class="home-lb-nav home-lb-next" onclick="shiftHomePhoto(1)">&#8594;</button>
        <div class="lightbox-meta mt-4 text-center">
            <div class="lt" id="homeLbTitle"></div>
            <div class="la" id="homeLbAlbum"></div>
        </div>
    </div>
</div>


<script>
    let homePhotos = [],
        homeCurrent = 0;

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

    function openHomeLightbox(i) {
        homeCurrent = i;
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

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (this.closest('.carousel') || this.hasAttribute('data-bs-slide') || this.hasAttribute('data-bs-slide-to') || href === '#') return;
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });

    if (typeof AOS !== 'undefined') AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
</script>

<?= $this->endSection() ?>