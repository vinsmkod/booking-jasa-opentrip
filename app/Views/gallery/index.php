<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/galery.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- ══════════════════════════════════════════
     HERO SECTION
══════════════════════════════════════════ -->
<section class="hero-gallery" style="background:url('<?= base_url('assets/images/gunung1.jpg') ?>') center/cover no-repeat;">
    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="display-4 fw-bold">Trip Pendakian Gunung</h1>
        <p class="lead mt-3 opacity-95">Jelajahi keindahan alam Indonesia bersama komunitas pendaki dari berbagai daerah</p>
        <a href="<?= base_url('trips') ?>" class="btn rounded-pill fw-semibold px-4 py-3 mt-4 text-white" style="background:linear-gradient(135deg,#2d7d3a,#1f5a29);border:none;transition:all .3s;" data-aos="zoom-in" data-aos-delay="300"
            onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 10px 25px rgba(45,125,58,.3)'"
            onmouseout="this.style.transform='';this.style.boxShadow=''">            
            <i class="fas fa-mountain me-2"></i>Lihat Jadwal Trip
        </a>
    </div>
</section>


<!-- ══════════════════════════════════════════
     LIGHTBOX
══════════════════════════════════════════ -->
<div class="lightbox-backdrop" id="lightbox" onclick="closeLightbox(event)">
    <div class="lightbox-inner">
        <button class="lb-close" onclick="closeLightbox()">&times;</button>
        <button class="lb-nav lb-prev" onclick="shiftPhoto(-1)">&#8592;</button>
        <img id="lb-img" src="" alt="">
        <button class="lb-nav lb-next" onclick="shiftPhoto(1)">&#8594;</button>
        <div class="lightbox-meta mt-4 text-center">
            <div class="lt" id="lb-title"></div>
            <div class="la" id="lb-album"></div>
        </div>
    </div>
</div>


<!-- ══════════════════════════════════════════
     TRIP FILTER
══════════════════════════════════════════ -->
<?php if (!empty($trips)): ?>
    <div class="bg-white rounded-4 p-4 mb-4 shadow-sm">
        <div class="d-flex align-items-center gap-2 fw-semibold small mb-3">
            <i class="fas fa-mountain" style="color:var(--rust);"></i> Filter Berdasarkan Trip
        </div>
        <div class="d-flex flex-wrap gap-3">
            <a href="<?= base_url('gallery') ?>" class="trip-filter-btn <?= empty($activeTrip) ? 'active' : '' ?>">
                <i class="fas fa-globe"></i> Semua Trip
            </a>
            <?php foreach ($trips as $trip): ?>
                <a href="<?= base_url('gallery/trip/' . $trip['trip_id']) ?>"
                    class="trip-filter-btn <?= ($activeTrip == $trip['trip_id']) ? 'active' : '' ?>">
                    <i class="fas fa-hiking"></i> <?= esc($trip['title']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>


<!-- ══════════════════════════════════════════
     ACTIVE TRIP INFO
══════════════════════════════════════════ -->
<?php if (!empty($selectedTrip)): ?>
    <div class="trip-info-card">
        <div>
            <h3><i class="fas fa-flag-checkered me-2"></i><?= esc($selectedTrip['title']) ?></h3>
            <p>
                <i class="fas fa-map-marker-alt me-1"></i><?= esc($selectedTrip['location']) ?>
                &nbsp;|&nbsp;<i class="fas fa-calendar me-1"></i>Dokumentasi Perjalanan
            </p>
        </div>
        <a href="<?= base_url('gallery') ?>" class="btn-clear">
            <i class="fas fa-times me-1"></i>Tampilkan Semua
        </a>
    </div>
<?php endif; ?>


<!-- ══════════════════════════════════════════
     ALBUM TABS
══════════════════════════════════════════ -->
<?php if (!empty($albums)): ?>
    <div class="d-flex flex-wrap gap-2 pb-3 mb-4 border-bottom" style="border-color:var(--sand)!important;">
        <a href="<?= base_url('gallery') . ($activeTrip ? '?trip=' . $activeTrip : '') ?>"
            class="album-tab <?= !isset($activeAlbum) ? 'active' : '' ?>">
            <i class="fas fa-th-large me-1"></i>Semua Album
        </a>
        <?php foreach ($albums as $album): ?>
            <?php if (!empty($album['album'])): ?>
                <a href="<?= base_url('gallery?album=' . urlencode($album['album'])) . ($activeTrip ? '&trip=' . $activeTrip : '') ?>"
                    class="album-tab <?= (isset($activeAlbum) && $activeAlbum === $album['album']) ? 'active' : '' ?>">
                    <i class="fas fa-folder me-1"></i><?= esc($album['album']) ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<!-- ══════════════════════════════════════════
     STATS INFO
══════════════════════════════════════════ -->
<div class="bg-white rounded-3 shadow-sm text-center p-3 mb-4">
    <small class="text-muted">
        <i class="fas fa-images me-1" style="color:var(--rust);"></i>
        <?= count($galleryPhotos) ?> foto ditemukan
        <?php if (!empty($selectedTrip)): ?>
            dalam perjalanan <strong><?= esc($selectedTrip['title']) ?></strong>
        <?php elseif (!empty($activeAlbum)): ?>
            dalam album <strong><?= esc($activeAlbum) ?></strong>
        <?php else: ?>
            dalam galeri
        <?php endif; ?>
    </small>
</div>


<!-- ══════════════════════════════════════════
     MASONRY GRID
══════════════════════════════════════════ -->
<?php if (!empty($galleryPhotos)): ?>
    <div class="masonry-grid" id="photoGrid">
        <?php foreach ($galleryPhotos as $i => $photo): ?>
            <div class="photo-card"
                data-index="<?= $i ?>"
                data-src="<?= base_url('uploads/gallery/' . $photo['image']) ?>"
                data-title="<?= esc($photo['title']) ?>"
                data-album="<?= esc($photo['album'] ?? 'Tanpa Album') ?>"
                onclick="openLightbox(this)">
                <img src="<?= base_url('uploads/gallery/' . $photo['image']) ?>"
                    alt="<?= esc($photo['title']) ?>"
                    loading="lazy">
                <div class="overlay">
                    <div class="overlay-text">
                        <div class="title"><?= esc($photo['title']) ?></div>
                        <div class="album-tag"><?= esc($photo['album'] ?? 'Tanpa Album') ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-5 mb-4">
        <small class="text-muted"><i class="fas fa-camera me-1"></i>Klik foto untuk melihat lebih detail</small>
    </div>

<?php else: ?>

    <!-- EMPTY STATE -->
    <div class="text-center py-5 bg-white rounded-4">
        <div class="fs-1 mb-3 opacity-50">🏔️</div>
        <h4 class="fw-bold mb-2" style="font-family:'Playfair Display',serif;">Belum Ada Dokumentasi</h4>
        <p class="text-muted mb-4">
            <?php if (!empty($selectedTrip)): ?>
                Belum ada foto untuk perjalanan <strong><?= esc($selectedTrip['title']) ?></strong>.
            <?php elseif (!empty($activeAlbum)): ?>
                Belum ada foto dalam album <strong><?= esc($activeAlbum) ?></strong>.
            <?php else: ?>
                Belum ada foto dalam galeri. Ikuti perjalanan kami untuk melihat dokumentasi petualangan!
            <?php endif; ?>
        </p>
        <a href="<?= base_url('trips') ?>" class="btn btn-outline-primary">
            <i class="fas fa-hiking me-1"></i>Lihat Trip Tersedia
        </a>
    </div>

<?php endif; ?>

<div class="mb-5"></div>


<script>
    let photos = [], current = 0;

    document.querySelectorAll('.photo-card').forEach(card => {
        photos.push({ src: card.dataset.src, title: card.dataset.title, album: card.dataset.album });
    });

    function openLightbox(card) {
        current = parseInt(card.dataset.index);
        renderLightbox();
        document.getElementById('lightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(e) {
        if (e && e.target !== document.getElementById('lightbox') && !e.target.classList.contains('lb-close')) return;
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }

    function shiftPhoto(dir) {
        current = (current + dir + photos.length) % photos.length;
        renderLightbox();
        if (event) event.stopPropagation();
    }

    function renderLightbox() {
        const p = photos[current];
        document.getElementById('lb-img').src = p.src;
        document.getElementById('lb-title').textContent = p.title;
        document.getElementById('lb-album').textContent = p.album;
    }

    document.addEventListener('keydown', e => {
        const lb = document.getElementById('lightbox');
        if (!lb.classList.contains('open')) return;
        if (e.key === 'Escape') { lb.classList.remove('open'); document.body.style.overflow = ''; }
        if (e.key === 'ArrowLeft')  shiftPhoto(-1);
        if (e.key === 'ArrowRight') shiftPhoto(1);
    });

    /* Staggered reveal */
    document.querySelectorAll('.photo-card').forEach((c, i) => {
        c.style.opacity = 0;
        c.style.transform = 'translateY(20px)';
        c.style.transition = `opacity .5s ease ${i * 50}ms, transform .5s ease ${i * 50}ms`;
        setTimeout(() => { c.style.opacity = 1; c.style.transform = 'translateY(0)'; }, 100);
    });
</script>

<?= $this->endSection() ?>