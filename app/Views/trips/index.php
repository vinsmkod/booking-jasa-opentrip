<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .trips-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 60px 24px;
    }

    /* Header Section */
    .header-section {
        margin-bottom: 60px;
    }

    .header-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .header-subtitle {
        font-size: 1rem;
        color: #64748b;
        line-height: 1.6;
    }

    /* Trip Card */
    .trip-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #f1f5f9;
    }

    .trip-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        border-color: #e0e7ff;
    }

    /* Image Section */
    .image-section {
        position: relative;
        overflow: hidden;
        height: 240px;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    }

    .image-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .trip-card:hover .image-section img {
        transform: scale(1.06);
    }

    /* Badge */
    .trip-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        background: rgba(45, 125, 58, 0.95);
        color: white;
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Card Body */
    .card-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 14px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 16px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #475569;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .info-item i {
        width: 18px;
        min-width: 18px;
        color: #2d7d3a;
        font-size: 0.95rem;
    }

    /* Price Section */
    .price-section {
        border-top: 1px solid #f1f5f9;
        padding-top: 14px;
        margin-bottom: 16px;
    }

    .price-label {
        font-size: 0.75rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .price {
        font-size: 1.4rem;
        font-weight: 800;
        color: #2d7d3a;
    }

    /* Button */
    .btn-detail {
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        color: white;
        border: none;
        padding: 12px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(45, 125, 58, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-disabled {
        background: #f1f5f9;
        color: #94a3b8;
        border: 1px dashed #cbd5e1;
        padding: 12px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: not-allowed;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
    }

    /* Empty State */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px 40px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
        display: block;
    }

    .empty-state h3 {
        font-size: 1.3rem;
        color: #0f172a;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .empty-state p {
        color: #64748b;
        font-size: 1rem;
        margin: 0;
    }

    /* Grid */
    .trips-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 28px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .trips-container {
            padding: 40px 16px;
        }

        .header-title {
            font-size: 1.8rem;
        }

        .trips-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .image-section {
            height: 200px;
        }

        .card-title {
            font-size: 1.1rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .trips-container {
            padding: 30px 12px;
        }

        .header-title {
            font-size: 1.5rem;
        }

        .card-content {
            padding: 16px;
        }

        .info-item {
            font-size: 0.8rem;
        }
    }
</style>

<div class="trips-container">
    <!-- Header -->
    <div class="header-section">
        <h2 class="header-title"><?= esc($type ?? 'Jelajahi Trip') ?></h2>
        <p class="header-subtitle">Pilih petualangan yang sesuai dengan keinginan Anda</p>
    </div>

    <!-- Trips Grid -->
    <div class="trips-grid">
        <?php if (!empty($trips)): ?>
            <?php foreach ($trips as $trip): 
                $isAvailable = !empty($trip['schedule_id']);
            ?>
                <div class="trip-card">
                    <!-- Image Section -->
                    <div class="image-section">
                        <?php if (!empty($trip['image'])): ?>
                            <img src="<?= base_url('uploads/trips/' . $trip['image']) ?>"
                                alt="<?= esc($trip['title']) ?>"
                                loading="lazy">
                        <?php else: ?>
                            <img src="<?= base_url('assets/images/no-image.jpg') ?>"
                                alt="No Image"
                                loading="lazy">
                        <?php endif; ?>

                        <?php if ($isAvailable): ?>
                            <div class="trip-badge">
                                <i class="fas fa-check-circle"></i> Tersedia
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Card Content -->
                    <div class="card-content">
                        <h3 class="card-title"><?= esc($trip['title']) ?></h3>

                        <div class="info-grid">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?= esc($trip['location']) ?></span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>
                                    <?= !empty($trip['departure_date'])
                                        ? date('d M Y', strtotime($trip['departure_date']))
                                        : 'Belum tersedia' ?>
                                </span>
                            </div>
                        </div>

                        <div class="info-grid">
                            <div class="info-item">
                                <i class="fas fa-users"></i>
                                <span><?= !empty($trip['quota']) ? $trip['quota'] . ' orang' : '-' ?></span>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="price-section">
                            <div class="price-label">Harga Mulai Dari</div>
                            <div class="price">Rp <?= number_format($trip['price'], 0, ',', '.') ?></div>
                        </div>

                        <!-- Button -->
                        <div class="mt-auto">
                            <?php if ($isAvailable): ?>
                                <a href="<?= base_url('trips/detail/' . $trip['schedule_id']) ?>"
                                    class="btn-detail">
                                    <i class="fas fa-arrow-right"></i> Lihat Detail
                                </a>
                            <?php else: ?>
                                <div class="btn-disabled">
                                    <i class="fas fa-clock"></i> Jadwal Belum Tersedia
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-mountain"></i>
                <h3>Tidak Ada Trip Tersedia</h3>
                <p>Silakan cek kembali nanti untuk melihat koleksi petualangan kami.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>