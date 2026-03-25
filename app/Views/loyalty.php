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

    .loyalty-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* Breadcrumb */
    .breadcrumb-custom {
        background: transparent;
        padding: 0;
        margin-bottom: 25px;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: #8c8780;
        text-decoration: none;
        font-size: 0.85rem;
    }

    .breadcrumb-custom .breadcrumb-item a:hover {
        color: #c4603a;
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: #0f0e0d;
        font-weight: 500;
    }

    /* Card */
    .card-loyalty {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* Header */
    .card-header {
        background: #f8f5f0;
        padding: 24px 28px;
        border-bottom: 1px solid #e8e2d9;
    }

    .card-header h4 {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0f0e0d;
        margin-bottom: 4px;
    }

    .card-header p {
        font-size: 0.85rem;
        color: #8c8780;
        margin-bottom: 0;
    }

    /* Body */
    .card-body {
        padding: 28px;
    }

    /* Greeting */
    .greeting {
        background: #faf8f5;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 28px;
        border-left: 3px solid #c4603a;
    }

    .greeting p {
        margin-bottom: 0;
        color: #5a5a5a;
        font-size: 0.9rem;
    }

    .greeting strong {
        color: #c4603a;
    }

    /* Points Display */
    .points-box {
        text-align: center;
        margin-bottom: 28px;
        padding: 20px;
        background: #faf8f5;
        border-radius: 16px;
    }

    .points-number {
        font-size: 3rem;
        font-weight: 700;
        color: #c4603a;
        line-height: 1;
        margin-bottom: 5px;
    }

    .points-label {
        font-size: 0.8rem;
        color: #8c8780;
    }

    .points-note {
        margin-top: 10px;
        font-size: 0.75rem;
        color: #8c8780;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 28px;
    }

    .info-item {
        background: #faf8f5;
        border-radius: 12px;
        padding: 16px;
    }

    .info-item .info-icon {
        margin-bottom: 12px;
    }

    .info-item .info-icon i {
        font-size: 1.3rem;
        color: #c4603a;
    }

    .info-item .info-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        color: #8c8780;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .info-item .info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0f0e0d;
    }

    .info-item .info-desc {
        font-size: 0.7rem;
        color: #8c8780;
        margin-top: 4px;
    }

    /* Discount Box */
    .discount-box {
        background: #faf8f5;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin-bottom: 28px;
        border: 1px solid #e8e2d9;
    }

    .discount-label {
        font-size: 0.75rem;
        color: #8c8780;
        margin-bottom: 6px;
    }

    .discount-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #c4603a;
    }

    .discount-note {
        font-size: 0.7rem;
        color: #8c8780;
        margin-top: 6px;
    }

    /* Rules */
    .rules-box {
        margin-bottom: 28px;
    }

    .rules-title {
        font-weight: 600;
        color: #0f0e0d;
        margin-bottom: 16px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rules-title i {
        color: #c4603a;
    }

    .rules-list {
        list-style: none;
        padding: 0;
    }

    .rules-list li {
        display: flex;
        gap: 10px;
        padding: 8px 0;
        font-size: 0.85rem;
        color: #5a5a5a;
        border-bottom: 1px solid #e8e2d9;
    }

    .rules-list li:last-child {
        border-bottom: none;
    }

    .rules-list li i {
        color: #c4603a;
        font-size: 0.8rem;
        margin-top: 2px;
    }

    .rules-list li strong {
        color: #c4603a;
        font-weight: 600;
    }

    /* Buttons */
    .button-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-primary-custom {
        background: #c4603a;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-primary-custom:hover {
        background: #b5532c;
        transform: translateY(-1px);
    }

    .btn-secondary-custom {
        background: transparent;
        border: 1px solid #e8e2d9;
        color: #5a5a5a;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-secondary-custom:hover {
        border-color: #c4603a;
        color: #c4603a;
        background: #fff;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .loyalty-container {
            padding: 20px;
        }

        .card-header {
            padding: 20px;
        }

        .card-header h4 {
            font-size: 1.2rem;
        }

        .card-body {
            padding: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .button-group {
            flex-direction: column;
        }

        .btn-primary-custom,
        .btn-secondary-custom {
            justify-content: center;
        }

        .points-number {
            font-size: 2.5rem;
        }
    }
</style>

<div class="loyalty-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-custom">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Loyalty Points</li>
        </ol>
    </nav>

    <!-- Main Card -->
    <div class="card-loyalty">
        <div class="card-header">
            <h4>Loyalty Points</h4>
            <p>Kumpulkan poin dari setiap perjalananmu</p>
        </div>

        <div class="card-body">
            <!-- Greeting -->
            <div class="greeting">
                <p>
                    <i class="fas fa-user-circle me-1"></i>
                    Halo, <strong><?= esc(session()->get('name')) ?></strong>.
                    Terima kasih telah menjadi bagian dari BLNTRK Outdoor.
                </p>
            </div>

            <!-- Points Display -->
            <div class="points-box">
                <div class="points-number"><?= esc($points ?? 0) ?></div>
                <div class="points-label">Total Poin Anda</div>
                <div class="points-note">
                    <i class="fas fa-info-circle me-1"></i> Setiap booking mendapat +10 poin
                </div>
            </div>

            <!-- Info Grid -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="info-label">Per Booking</div>
                    <div class="info-value">+10 Poin</div>
                    <div class="info-desc">Setelah booking dikonfirmasi</div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="info-label">Konversi Poin</div>
                    <div class="info-value">100 Poin = Rp 5.000</div>
                    <div class="info-desc">Potongan harga trip</div>
                </div>
            </div>

            <!-- Discount Box -->
            <div class="discount-box">
                <div class="discount-label">
                    <i class="fas fa-tag me-1"></i> Potongan yang Tersedia
                </div>
                <div class="discount-value">
                    Rp <?= number_format(floor(($points ?? 0) / 100) * 5000, 0, ',', '.') ?>
                </div>
                <div class="discount-note">
                    dari <?= floor(($points ?? 0) / 100) * 100 ?> poin yang bisa digunakan
                </div>
            </div>

            <!-- Rules -->
            <div class="rules-box">
                <div class="rules-title">
                    <i class="fas fa-info-circle"></i>
                    Informasi Poin
                </div>
                <ul class="rules-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span><strong>100 poin</strong> = potongan <strong>Rp 5.000</strong></span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Setiap booking mendapat <strong>+10 poin</strong> setelah dikonfirmasi</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Poin dapat digunakan untuk potongan harga di booking berikutnya</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Poin tidak dapat ditukar dengan uang tunai</span>
                    </li>
                </ul>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <a href="<?= base_url('booking/history') ?>" class="btn-primary-custom">
                    <i class="fas fa-history"></i> Lihat Riwayat Booking
                </a>
                <a href="<?= base_url('trips') ?>" class="btn-primary-custom">
                    <i class="fas fa-mountain"></i> Cari Trip
                </a>
                <a href="<?= base_url('/') ?>" class="btn-secondary-custom">
                    <i class="fas fa-home"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>