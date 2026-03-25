<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: #f5f2ed;
    }

    /* Container */
    .detail-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* Breadcrumb */
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 30px;
    }

    .breadcrumb-item a {
        color: #8c8780;
        text-decoration: none;
        font-size: 0.85rem;
    }

    .breadcrumb-item a:hover {
        color: #c4603a;
    }

    .breadcrumb-item.active {
        color: #0f0e0d;
    }

    /* Trip Image */
    .trip-image {
        width: 100%;
        border-radius: 12px;
        margin-bottom: 25px;
    }

    /* Trip Title */
    .trip-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0f0e0d;
        margin-bottom: 8px;
    }

    .trip-location {
        color: #8c8780;
        margin-bottom: 25px;
        font-size: 0.9rem;
    }

    /* Section */
    .section {
        margin-bottom: 35px;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0f0e0d;
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e8e2d9;
    }

    .section-title i {
        color: #c4603a;
        margin-right: 8px;
    }

    .description-text {
        color: #5a5a5a;
        line-height: 1.7;
        font-size: 0.9rem;
    }

    /* Include List */
    .include-list {
        list-style: none;
        padding: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .include-list li {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: #5a5a5a;
    }

    .include-list li i {
        color: #c4603a;
        font-size: 0.8rem;
    }

    /* Itinerary */
    .itinerary-list {
        list-style: none;
        padding: 0;
    }

    .itinerary-item {
        display: flex;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #e8e2d9;
    }

    .itinerary-item:last-child {
        border-bottom: none;
    }

    .itinerary-time {
        min-width: 80px;
        font-weight: 600;
        color: #c4603a;
        font-size: 0.85rem;
    }

    .itinerary-activity {
        color: #5a5a5a;
        font-size: 0.85rem;
    }

    /* Meeting Points */
    .meeting-list {
        list-style: none;
        padding: 0;
    }

    .meeting-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        font-size: 0.85rem;
        color: #5a5a5a;
        border-bottom: 1px solid #e8e2d9;
    }

    .meeting-list li:last-child {
        border-bottom: none;
    }

    .meeting-list li i {
        color: #c4603a;
        width: 20px;
    }

    /* Booking Card */
    .booking-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 20px;
    }

    .booking-card h5 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e8e2d9;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 0.85rem;
    }

    .info-label {
        color: #8c8780;
    }

    .info-value {
        font-weight: 500;
        color: #0f0e0d;
    }

    .price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #c4603a;
    }

    .progress {
        height: 6px;
        background: #e8e2d9;
        border-radius: 3px;
        margin: 8px 0;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: #c4603a;
        border-radius: 3px;
    }

    .btn-book {
        display: block;
        width: 100%;
        background: #c4603a;
        color: white;
        text-align: center;
        padding: 12px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        margin-top: 15px;
        transition: background 0.2s;
    }

    .btn-book:hover {
        background: #b5532c;
    }

    .btn-book-disabled {
        background: #d4c8bc;
        cursor: not-allowed;
    }

    .btn-outline {
        display: block;
        width: 100%;
        background: transparent;
        border: 1px solid #c4603a;
        color: #c4603a;
        text-align: center;
        padding: 12px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        margin-top: 15px;
    }

    .btn-outline:hover {
        background: #c4603a;
        color: white;
    }

    .text-muted {
        color: #8c8780 !important;
    }

    .small {
        font-size: 0.75rem;
    }

    .mt-3 {
        margin-top: 15px;
    }

    .mb-2 {
        margin-bottom: 8px;
    }

    .mb-4 {
        margin-bottom: 20px;
    }

    hr {
        margin: 20px 0;
        border-color: #e8e2d9;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-container {
            padding: 20px;
        }

        .trip-title {
            font-size: 1.4rem;
        }

        .include-list {
            grid-template-columns: 1fr;
        }

        .booking-card {
            position: relative;
            top: 0;
            margin-top: 30px;
        }

        .itinerary-item {
            flex-direction: column;
            gap: 5px;
        }

        .itinerary-time {
            min-width: auto;
        }
    }
</style>

<div class="detail-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>#Trip">Trip</a></li>
            <li class="breadcrumb-item active"><?= esc($schedule['title']) ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-7">
            <!-- Trip Image -->
            <?php if (!empty($schedule['image'])): ?>
                <img src="<?= base_url('uploads/trips/' . $schedule['image']) ?>"
                    class="trip-image"
                    alt="<?= esc($schedule['title']) ?>">
            <?php endif; ?>

            <!-- Title -->
            <h1 class="trip-title"><?= esc($schedule['title']) ?></h1>
            <p class="trip-location">
                <i class="fas fa-map-marker-alt"></i> <?= esc($schedule['location']) ?>
            </p>

            <!-- Description -->
            <div class="section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i> Deskripsi Trip
                </div>
                <div class="description-text">
                    <?= nl2br(esc($schedule['description'])) ?>
                </div>
            </div>

            <!-- Include -->
            <div class="section">
                <div class="section-title">
                    <i class="fas fa-check-circle"></i> Termasuk dalam Paket
                </div>
                <?php if (!empty($includes)): ?>
                    <ul class="include-list">
                        <?php foreach ($includes as $inc): ?>
                            <li><i class="fas fa-check"></i> <?= esc($inc['title']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">Belum ada data paket include</p>
                <?php endif; ?>
            </div>

            <!-- Itinerary -->
            <div class="section">
                <div class="section-title">
                    <i class="fas fa-clock"></i> Itinerary Perjalanan
                </div>
                <?php if (!empty($itinerary)): ?>
                    <ul class="itinerary-list">
                        <?php foreach ($itinerary as $item): ?>
                            <li class="itinerary-item">
                                <div class="itinerary-time"><?= esc($item['time']) ?></div>
                                <div class="itinerary-activity"><?= esc($item['activity']) ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">Belum ada itinerary</p>
                <?php endif; ?>
            </div>

            <!-- Meeting Points -->
            <?php if (!empty($meetingPoints)): ?>
                <div class="section">
                    <div class="section-title">
                        <i class="fas fa-map-pin"></i> Meeting Point
                    </div>
                    <ul class="meeting-list">
                        <?php foreach ($meetingPoints as $point): ?>
                            <li><i class="fas fa-location-dot"></i> <?= esc($point['name']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Column - Booking Card -->
        <div class="col-lg-5">
            <div class="booking-card">
                <h5>Informasi Trip</h5>

                <div class="info-row">
                    <span class="info-label">Tanggal Berangkat</span>
                    <span class="info-value"><?= date('d M Y', strtotime($schedule['departure_date'])) ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Harga per Peserta</span>
                    <span class="info-value price">Rp <?= number_format($schedule['price'], 0, ',', '.') ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Kuota Tersedia</span>
                    <span class="info-value"><?= esc($schedule['available']) ?> / <?= esc($schedule['quota']) ?> orang</span>
                </div>

                <?php
                $quota = $schedule['quota'] ?? 0;
                $available = $schedule['available'] ?? 0;
                $booked = $quota - $available;
                $percent = $quota > 0 ? ($booked / $quota) * 100 : 0;
                ?>
                <div class="progress">
                    <div class="progress-bar" style="width: <?= $percent ?>%"></div>
                </div>
                <div class="text-muted small mt-1"><?= $booked ?> orang telah bergabung</div>

                <hr>

                <?php if ($schedule['available'] > 0): ?>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('booking/create/' . $schedule['schedule_id']) ?>" class="btn-book">
                            <i class="fas fa-calendar-check"></i> Booking Sekarang
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="btn-book">
                            <i class="fas fa-sign-in-alt"></i> Login untuk Booking
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="#" class="btn-book btn-book-disabled" disabled>
                        <i class="fas fa-ban"></i> Trip Full
                    </a>
                <?php endif; ?>

                <div class="text-muted small text-center mt-3">
                    <i class="fas fa-shield-alt"></i> Booking aman dan terpercaya
                </div>
            </div>

            <!-- WhatsApp Group -->
            <?php if (!empty($schedule['whatsapp_group'])): ?>
                <div class="booking-card mt-3">
                    <div class="text-center">
                        <i class="fab fa-whatsapp fa-2x text-success mb-2"></i>
                        <h6 class="mb-1">Grup WhatsApp</h6>
                        <p class="text-muted small mb-2">Bergabung untuk info lebih lanjut</p>
                        <a href="<?= esc($schedule['whatsapp_group']) ?>" class="btn-outline" target="_blank">
                            <i class="fab fa-whatsapp"></i> Gabung Grup
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>