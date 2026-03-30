<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap');

    :root {
        --ink: #0f0e0d;
        --paper: #bcccb9;
        --sand: #e8e2d9;
        --rust: #c4603a;
        --rust-light: #e8886a;
        --muted: #000000ff;
        --card-radius: 12px;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    * {
        box-sizing: border-box;
    }

    body {
        background: var(--paper);
    }

    /* Hero Section */
    .hero-gallery {
        position: relative;
        padding: 60px 0 80px;
        border-radius: 10px 10px 50px 50px;
        margin-bottom: 50px;
        overflow: hidden;
    }

    .hero-gallery::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(26, 158, 90, 0.54) 0%, rgba(0, 0, 0, 0.4) 100%);
    }

    .hero-gallery .container {
        position: relative;
        z-index: 2;
    }

    .hero-gallery h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: var(--rust);

        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero-gallery p {
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

    /* ── FILTER SECTION ── */
    .filter-section {
        background: white;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: var(--shadow-sm);
    }

    .filter-title {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-title i {
        color: var(--rust);
    }

    .trip-filters {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .trip-filter-btn {
        padding: 8px 20px;
        border: 2px solid var(--sand);
        border-radius: 100px;
        background: white;
        color: var(--muted);
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .trip-filter-btn i {
        font-size: 14px;
    }

    .trip-filter-btn:hover,
    .trip-filter-btn.active {
        background: var(--rust);
        border-color: var(--rust);
        color: white;
        transform: translateY(-2px);
    }

    /* ── ALBUM TABS ── */
    .album-tabs {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        padding: 0 0 20px;
        border-bottom: 2px solid var(--sand);
        margin-bottom: 30px;
    }

    .album-tab {
        padding: 8px 20px;
        border: none;
        border-radius: 100px;
        background: transparent;
        color: var(--muted);
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: inline-block;
    }

    .album-tab:hover,
    .album-tab.active {
        background: var(--rust);
        color: white;
        transform: translateY(-2px);
    }

    /* ── TRIP INFO CARD ── */
    .trip-info-card {
        background: linear-gradient(135deg, var(--rust) 0%, var(--rust-light) 100%);
        border-radius: 16px;
        padding: 20px 25px;
        margin-bottom: 30px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .trip-info-card h3 {
        margin: 0;
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
    }

    .trip-info-card p {
        margin: 5px 0 0;
        opacity: 0.9;
    }

    .trip-info-card .btn-clear {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        padding: 8px 20px;
        border-radius: 100px;
        text-decoration: none;
        transition: var(--transition);
    }

    .trip-info-card .btn-clear:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    /* ── MASONRY GRID ── */
    .masonry-grid {
        columns: 3 320px;
        column-gap: 25px;
    }

    @media(max-width: 992px) {
        .masonry-grid {
            columns: 2 280px;
            column-gap: 20px;
        }
    }

    @media(max-width: 576px) {
        .masonry-grid {
            columns: 1 280px;
        }
    }

    .photo-card {
        break-inside: avoid;
        margin-bottom: 25px;
        position: relative;
        border-radius: var(--card-radius);
        overflow: hidden;
        cursor: pointer;
        background: white;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .photo-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-md);
    }

    .photo-card img {
        display: block;
        width: 100%;
        transition: transform .5s cubic-bezier(.25, .46, .45, .94);
    }

    .photo-card:hover img {
        transform: scale(1.05);
    }

    .photo-card .overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 60%);
        opacity: 0;
        transition: opacity .3s ease;
        display: flex;
        align-items: flex-end;
        padding: 20px;
    }

    .photo-card:hover .overlay {
        opacity: 1;
    }

    .overlay-text .title {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        color: #fff;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .overlay-text .album-tag {
        font-size: .75rem;
        color: rgba(255, 255, 255, .8);
        letter-spacing: .08em;
        text-transform: uppercase;
        display: inline-block;
        background: rgba(196, 96, 58, 0.8);
        padding: 2px 8px;
        border-radius: 20px;
    }

    /* ── LIGHTBOX ── */
    .lightbox-backdrop {
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

    .lightbox-backdrop.open {
        opacity: 1;
        pointer-events: all;
    }

    .lightbox-inner {
        position: relative;
        max-width: min(90vw, 900px);
        max-height: 92vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        transform: scale(.96);
        transition: transform .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    .lightbox-backdrop.open .lightbox-inner {
        transform: scale(1);
    }

    .lightbox-inner img {
        max-width: 100%;
        max-height: 78vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, .5);
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

    .lb-close {
        position: absolute;
        top: -50px;
        right: 0;
        background: none;
        border: none;
        color: rgba(255, 255, 255, .6);
        font-size: 2rem;
        cursor: pointer;
        transition: color .2s;
    }

    .lb-close:hover {
        color: #fff;
    }

    .lb-nav {
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
    }

    .lb-nav:hover {
        background: rgba(255, 255, 255, .2);
    }

    .lb-prev {
        left: -70px;
    }

    .lb-next {
        right: -70px;
    }

    @media (max-width: 768px) {
        .lb-prev {
            left: 10px;
        }

        .lb-next {
            right: 10px;
        }

        .lb-nav {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }
    }

    /* ── EMPTY STATE ── */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 20px;
        color: var(--muted);
    }

    .empty-state .icon {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: .5;
    }

    .empty-state h4 {
        font-family: 'Playfair Display', serif;
        margin-bottom: 10px;
        color: var(--ink);
    }

    .empty-state p {
        font-size: 1rem;
        margin-bottom: 20px;
    }

    /* ── STATS ── */
    .stats-info {
        text-align: center;
        margin: 30px 0;
        padding: 15px;
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
    }

    .stats-info small {
        color: var(--muted);
        font-size: 0.85rem;
    }

    .stats-info i {
        color: var(--rust);
        margin-right: 6px;
    }

    /* ── DIVIDER ── */
    .divider {
        height: 2px;
        background: var(--sand);
        margin: 0 0 30px;
    }
</style>
<!-- HERO SECTION -->
<section class="hero-gallery"
    style="background:url('<?= base_url('assets/images/gunung1.jpg') ?>') center/cover no-repeat;">
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

<!-- LIGHTBOX BACKDROP -->
<div class="lightbox-backdrop" id="lightbox" onclick="closeLightbox(event)">
    <div class="lightbox-inner">
        <button class="lb-close" onclick="closeLightbox()">&times;</button>
        <button class="lb-nav lb-prev" onclick="shiftPhoto(-1)">&#8592;</button>
        <img id="lb-img" src="" alt="">
        <button class="lb-nav lb-next" onclick="shiftPhoto(1)">&#8594;</button>
        <div class="lightbox-meta">
            <div class="lt" id="lb-title"></div>
            <div class="la" id="lb-album"></div>
        </div>
    </div>
</div>

<!-- TRIP FILTER SECTION -->
<?php if (!empty($trips)): ?>
    <div class="filter-section">
        <div class="filter-title">
            <i class="fas fa-mountain"></i> Filter Berdasarkan Trip
        </div>
        <div class="trip-filters">
            <a href="<?= base_url('gallery') ?>"
                class="trip-filter-btn <?= empty($activeTrip) ? 'active' : '' ?>">
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

<!-- ACTIVE TRIP INFO -->
<?php if (!empty($selectedTrip)): ?>
    <div class="trip-info-card">
        <div>
            <h3><i class="fas fa-flag-checkered"></i> <?= esc($selectedTrip['title']) ?></h3>
            <p><i class="fas fa-map-marker-alt"></i> <?= esc($selectedTrip['location']) ?> |
                <i class="fas fa-calendar"></i> Dokumentasi Perjalanan
            </p>
        </div>
        <a href="<?= base_url('gallery') ?>" class="btn-clear">
            <i class="fas fa-times"></i> Tampilkan Semua
        </a>
    </div>
<?php endif; ?>

<!-- ALBUM TABS -->
<?php if (!empty($albums)): ?>
    <div class="album-tabs">
        <a href="<?= base_url('gallery') . ($activeTrip ? '?trip=' . $activeTrip : '') ?>"
            class="album-tab <?= !isset($activeAlbum) ? 'active' : '' ?>">
            <i class="fas fa-th-large"></i> Semua Album
        </a>
        <?php foreach ($albums as $album): ?>
            <?php if (!empty($album['album'])): ?>
                <a href="<?= base_url('gallery?album=' . urlencode($album['album'])) . ($activeTrip ? '&trip=' . $activeTrip : '') ?>"
                    class="album-tab <?= (isset($activeAlbum) && $activeAlbum === $album['album']) ? 'active' : '' ?>">
                    <i class="fas fa-folder"></i> <?= esc($album['album']) ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- STATS INFO -->
<div class="stats-info">
    <small>
        <i class="fas fa-images"></i>
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

<!-- MASONRY GRID -->
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

    <!-- Additional Info -->
    <div class="text-center mt-5 mb-4">
        <small class="text-muted">
            <i class="fas fa-camera"></i> Klik foto untuk melihat lebih detail
        </small>
    </div>
<?php else: ?>
    <div class="empty-state">
        <div class="icon">🏔️</div>
        <h4>Belum Ada Dokumentasi</h4>
        <p>
            <?php if (!empty($selectedTrip)): ?>
                Belum ada foto untuk perjalanan <strong><?= esc($selectedTrip['title']) ?></strong>.
            <?php elseif (!empty($activeAlbum)): ?>
                Belum ada foto dalam album <strong><?= esc($activeAlbum) ?></strong>.
            <?php else: ?>
                Belum ada foto dalam galeri. Ikuti perjalanan kami untuk melihat dokumentasi petualangan!
            <?php endif; ?>
        </p>
        <a href="<?= base_url('trips') ?>" class="btn btn-outline-primary mt-2">
            <i class="fas fa-hiking"></i> Lihat Trip Tersedia
        </a>
    </div>
<?php endif; ?>

<div style="height: 40px"></div>
</div>

<script>
    let photos = [];
    let current = 0;

    document.querySelectorAll('.photo-card').forEach(card => {
        photos.push({
            src: card.dataset.src,
            title: card.dataset.title,
            album: card.dataset.album,
        });
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
        if (e.key === 'Escape') {
            lb.classList.remove('open');
            document.body.style.overflow = '';
        }
        if (e.key === 'ArrowLeft') shiftPhoto(-1);
        if (e.key === 'ArrowRight') shiftPhoto(1);
    });

    /* Staggered reveal animation */
    const cards = document.querySelectorAll('.photo-card');
    cards.forEach((c, i) => {
        c.style.opacity = 0;
        c.style.transform = 'translateY(20px)';
        c.style.transition = `opacity 0.5s ease ${i*50}ms, transform 0.5s ease ${i*50}ms`;
        setTimeout(() => {
            c.style.opacity = 1;
            c.style.transform = 'translateY(0)';
        }, 100);
    });
</script>

<?= $this->endSection() ?>