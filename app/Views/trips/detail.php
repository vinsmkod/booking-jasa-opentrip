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
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .detail-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 40px 24px;
    }

    /* Breadcrumb */
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 40px;
        display: flex;
        gap: 8px;
        font-size: 0.85rem;
    }

    .breadcrumb-item a {
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb-item a:hover {
        color: #2d7d3a;
    }

    .breadcrumb-item.active {
        color: #0f172a;
        font-weight: 600;
    }

    .breadcrumb-item::after {
        content: '/';
        margin-left: 8px;
        color: #cbd5e1;
    }

    .breadcrumb-item:last-child::after {
        content: '';
    }

    /* Hero Image */
    .trip-hero {
        position: relative;
        width: 100%;
        height: 420px;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
    }

    .trip-hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Title Section */
    .title-section {
        margin-bottom: 40px;
    }

    .trip-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .trip-meta {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .meta-item i {
        color: #2d7d3a;
        font-size: 1.1rem;
    }

    /* Main Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        margin-bottom: 40px;
    }

    /* Section */
    .section {
        margin-bottom: 40px;
        background: white;
        padding: 32px;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f1f5f9;
    }

    .section-title i {
        color: #2d7d3a;
        font-size: 1.3rem;
    }

    .description-text {
        color: #475569;
        line-height: 1.8;
        font-size: 0.95rem;
    }

    /* Include List */
    .include-list {
        list-style: none;
        padding: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .include-list li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.9rem;
        color: #475569;
    }

    .include-list li i {
        color: #10b981;
        font-size: 0.9rem;
        margin-top: 2px;
        flex-shrink: 0;
    }

    /* Itinerary */
    .itinerary-list {
        list-style: none;
        padding: 0;
    }

    .itinerary-item {
        display: grid;
        grid-template-columns: 140px 1fr;
        gap: 20px;
        padding: 20px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .itinerary-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .itinerary-time {
        font-weight: 700;
        color: #2d7d3a;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .itinerary-activity {
        color: #475569;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    /* Meeting Points */
    .meeting-list {
        list-style: none;
        padding: 0;
    }

    .meeting-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        font-size: 0.9rem;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
    }

    .meeting-list li:last-child {
        border-bottom: none;
    }

    .meeting-list li i {
        color: #2d7d3a;
        width: 20px;
        font-size: 1.1rem;
    }

    /* Booking Card */
    .booking-card {
        background: white;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
        position: sticky;
        top: 20px;
    }

    .booking-card h5 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 24px;
        color: #0f172a;
        padding-bottom: 14px;
        border-bottom: 2px solid #f1f5f9;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        font-size: 0.9rem;
    }

    .info-label {
        color: #64748b;
        font-weight: 500;
    }

    .info-value {
        font-weight: 600;
        color: #0f172a;
    }

    .price-section {
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        padding: 16px 0;
        margin: 20px 0;
        text-align: center;
    }

    .price-label {
        font-size: 0.8rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }

    .price {
        font-size: 1.8rem;
        font-weight: 800;
        color: #2d7d3a;
    }

    /* Quota Progress */
    .quota-info {
        margin: 20px 0;
    }

    .quota-bar {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
    }

    .quota-text {
        font-size: 0.85rem;
        color: #64748b;
        flex: 1;
    }

    .quota-number {
        font-weight: 600;
        color: #0f172a;
    }

    .progress {
        height: 8px;
        background: #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #2d7d3a 0%, #1f5428 100%);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    /* Buttons */
    .btn-book {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        color: white;
        text-align: center;
        padding: 14px 16px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        margin-top: 20px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-book:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(45, 125, 58, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-book-disabled {
        background: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
        pointer-events: none;
    }

    .btn-outline {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: white;
        border: 2px solid #10b981;
        color: #10b981;
        text-align: center;
        padding: 12px 16px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        margin-top: 12px;
        transition: all 0.2s;
    }

    .btn-outline:hover {
        background: #10b981;
        color: white;
        text-decoration: none;
    }

    .text-muted {
        color: #64748b !important;
    }

    .small {
        font-size: 0.8rem;
    }

    .text-center {
        text-align: center;
    }

    .mt-3 {
        margin-top: 16px;
    }

    .mb-2 {
        margin-bottom: 8px;
    }

    /* WhatsApp Card */
    .whatsapp-card {
        background: linear-gradient(135deg, #f0fdf4 0%, #e0f7ee 100%);
        border: 1px solid #86efac;
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        margin-top: 20px;
    }

    .whatsapp-icon {
        font-size: 2.5rem;
        color: #10b981;
        margin-bottom: 12px;
        display: block;
    }

    .whatsapp-card h6 {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .whatsapp-card p {
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 12px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }

        .booking-card {
            position: relative;
            top: 0;
        }
    }

    @media (max-width: 768px) {
        .detail-container {
            padding: 20px 16px;
        }

        .trip-hero {
            height: 280px;
            margin-bottom: 28px;
        }

        .trip-title {
            font-size: 1.6rem;
        }

        .trip-meta {
            gap: 16px;
        }

        .section {
            padding: 20px;
            margin-bottom: 24px;
        }

        .include-list {
            grid-template-columns: 1fr;
        }

        .itinerary-item {
            grid-template-columns: 100px 1fr;
            gap: 12px;
        }

        .section-title {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 480px) {
        .trip-title {
            font-size: 1.3rem;
        }

        .trip-meta {
            flex-direction: column;
            gap: 8px;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }

        .booking-card {
            padding: 20px;
        }
    }
</style>

<div class="detail-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <span class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></span>
        <span class="breadcrumb-item"><a href="<?= base_url('/trips') ?>">Trip</a></span>
        <span class="breadcrumb-item active"><?= esc($schedule['title']) ?></span>
    </div>

    <!-- Hero Image -->
    <?php if (!empty($schedule['image'])): ?>
        <div class="trip-hero">
            <img src="<?= base_url('uploads/trips/' . $schedule['image']) ?>"
                alt="<?= esc($schedule['title']) ?>"
                loading="lazy">
        </div>
    <?php endif; ?>

    <!-- Title Section -->
    <div class="title-section">
        <h1 class="trip-title"><?= esc($schedule['title']) ?></h1>
        <div class="trip-meta">
            <div class="meta-item">
                <i class="fas fa-map-marker-alt"></i>
                <span><?= esc($schedule['location']) ?></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-calendar-alt"></i>
                <span><?= date('d M Y', strtotime($schedule['departure_date'])) ?></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-users"></i>
                <span><?= esc($schedule['available']) ?> / <?= esc($schedule['quota']) ?> Quota</span>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Left Column -->
        <div>
            <!-- Description -->
            <div class="section">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i> Deskripsi Trip
                </div>
                <div class="description-text">
                    <?= nl2br(esc($schedule['description'])) ?>
                </div>
            </div>

            <!-- Includes -->
            <div class="section">
                <div class="section-title">
                    <i class="fas fa-check-circle"></i> Apa yang Termasuk
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
                    <i class="fas fa-route"></i> Itinerary Perjalanan
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
                        <i class="fas fa-map-pin"></i> Titik Perkumpulan
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
        <div>
            <div class="booking-card">
                <h5>Informasi Booking</h5>

                <!-- Price -->
                <div class="price-section">
                    <span class="price-label">Harga per Peserta</span>
                    <div class="price">Rp <?= number_format($schedule['price'], 0, ',', '.') ?></div>
                </div>

                <!-- Quota -->
                <div class="quota-info">
                    <div class="quota-bar">
                        <span class="quota-text">Kursi Tersedia</span>
                        <span class="quota-number"><?= esc($schedule['available']) ?> / <?= esc($schedule['quota']) ?></span>
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
                    <p class="text-muted small" style="margin-top: 8px;">
                        <i class="fas fa-info-circle"></i> <?= $booked ?> peserta telah mendaftar
                    </p>
                </div>

                <!-- Booking Button -->
                <?php if ($schedule['available'] > 0): ?>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('booking/create/' . $schedule['schedule_id']) ?>" class="btn-book">
                            <i class="fas fa-ticket-alt"></i> Pesan Sekarang
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="btn-book">
                            <i class="fas fa-sign-in-alt"></i> Login untuk Pesan
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="btn-book btn-book-disabled">
                        <i class="fas fa-ban"></i> Trip Full - Tidak Tersedia
                    </div>
                <?php endif; ?>

                <p class="text-muted small text-center mt-3">
                    <i class="fas fa-shield-alt"></i> Transaksi aman dan terpercaya
                </p>

                <!-- WhatsApp Group -->
                <?php if (!empty($schedule['whatsapp_group'])): ?>
                    <div class="whatsapp-card">
                        <i class="fab fa-whatsapp whatsapp-icon"></i>
                        <h6>Grup Whatsapp</h6>
                        <p>Bergabunglah untuk update dan informasi terbaru</p>
                        <a href="<?= esc($schedule['whatsapp_group']) ?>" class="btn-outline" target="_blank" rel="noopener">
                            <i class="fab fa-whatsapp"></i> Gabung Grup
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>