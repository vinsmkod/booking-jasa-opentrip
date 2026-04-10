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

    /* Page Header */
    .page-header {
        margin-bottom: 40px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* Main Card */
    .booking-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
    }

    .booking-header {
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
    }

    .booking-header h5 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .booking-header h5 i {
        color: #2d7d3a;
        font-size: 1.4rem;
    }

    .booking-code {
        font-family: 'Monaco', 'Courier New', monospace;
        font-size: 0.9rem;
        font-weight: 600;
        color: #2d7d3a;
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        padding: 10px 16px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #d1fae5;
    }

    .booking-code i {
        font-size: 1.1rem;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        margin-bottom: 24px;
    }

    .info-column {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .info-item {
        padding: 16px 0;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-weight: 600;
        color: #0f172a;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .price-value {
        color: #2d7d3a;
        font-size: 1.3rem;
        font-weight: 800;
    }

    /* Status Badge */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        width: fit-content;
    }

    .badge-pending {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
    }

    .badge-confirmed {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
    }

    .badge-cancelled {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #7f1d1d;
    }

    .badge-secondary {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        color: #475569;
    }

    .badge-status i {
        font-size: 0.9rem;
    }

    /* Alert */
    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border-left: 4px solid #059669;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 24px;
        font-size: 0.9rem;
        color: #065f46;
        line-height: 1.6;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .alert-success i {
        font-size: 1.2rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .alert-success strong {
        font-weight: 700;
        color: #065f46;
    }

    /* Buttons */
    .btn-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 28px;
    }

    .btn-primary,
    .btn-success,
    .btn-secondary {
        padding: 12px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(45, 125, 58, 0.3);
    }

    .btn-success {
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: white;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.3);
    }

    .btn-secondary {
        background: white;
        color: #0f172a;
        border: 1.5px solid #e2e8f0;
    }

    .btn-secondary:hover {
        border-color: #2d7d3a;
        color: #2d7d3a;
    }

    /* Documents Section */
    .documents-section {
        margin-top: 28px;
    }

    .section-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #2d7d3a;
        font-size: 1.25rem;
    }

    .documents-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .document-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        background: white;
        border-radius: 12px;
        border: 1.5px solid #f1f5f9;
        transition: all 0.2s;
    }

    .document-item:hover {
        border-color: #d1fae5;
        box-shadow: 0 4px 12px rgba(45, 125, 58, 0.1);
    }

    .document-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .document-avatar {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .document-details h6 {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 4px;
        color: #0f172a;
    }

    .document-details small {
        font-size: 0.8rem;
        color: #64748b;
    }

    .document-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-doc {
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        text-decoration: none;
        background: white;
        border: 1.5px solid #e2e8f0;
        color: #0f172a;
        font-weight: 600;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-doc:hover {
        border-color: #2d7d3a;
        color: #2d7d3a;
        background: #f0fdf4;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #64748b;
    }

    .empty-state i {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 16px;
    }

    .text-muted {
        color: #64748b !important;
    }

    .small {
        font-size: 0.8rem;
    }

    .mt-3 {
        margin-top: 20px;
    }

    .mt-4 {
        margin-top: 28px;
    }

    .mb-2 {
        margin-bottom: 8px;
    }

    .mb-4 {
        margin-bottom: 20px;
    }

    .text-center {
        text-align: center;
    }

    hr {
        margin: 20px 0;
        border: none;
        border-top: 1px solid #f1f5f9;
    }

    /* Support Section */
    .support-section {
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        border: 1.5px solid #d1fae5;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        margin-top: 32px;
    }

    .support-section small {
        color: #475569;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .support-section a {
        color: #2d7d3a;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }

    .support-section a:hover {
        color: #1f5428;
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .info-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .booking-header {
            flex-direction: column;
        }
    }

    @media (max-width: 768px) {
        .detail-container {
            padding: 20px 16px;
        }

        .booking-card {
            padding: 20px;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .booking-header {
            margin-bottom: 20px;
        }

        .btn-group {
            flex-direction: column;
        }

        .btn-primary,
        .btn-success,
        .btn-secondary {
            width: 100%;
            justify-content: center;
        }

        .document-item {
            flex-direction: column;
            text-align: center;
            gap: 12px;
        }

        .document-info {
            flex-direction: column;
            width: 100%;
        }

        .document-buttons {
            width: 100%;
            justify-content: center;
        }

        .info-grid {
            gap: 16px;
        }
    }

    @media (max-width: 480px) {
        .detail-container {
            padding: 16px 12px;
        }

        .booking-card {
            padding: 16px;
        }

        .page-title {
            font-size: 1.25rem;
        }

        .price-value {
            font-size: 1.1rem;
        }
    }
</style>

<div class="detail-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <span class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></span>
        <span class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></span>
        <span class="breadcrumb-item active">Detail Booking</span>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Detail Pemesanan Trip</h1>
        <p class="page-subtitle">Lihat detail lengkap pemesanan dan status pembayaran Anda</p>
    </div>

    <!-- Confirmed Alert -->
    <?php if (($booking['status'] ?? '') === 'confirmed'): ?>
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>✓ Booking Terkonfirmasi!</strong> Pemesanan Anda sudah dikonfirmasi. Silahkan download tiket dan gabung grup WhatsApp untuk informasi lebih lanjut.
            </div>
        </div>
    <?php endif; ?>

    <!-- Booking Header -->
    <div class="booking-card">
        <div class="booking-header">
            <div>
                <h5><i class="fas fa-ticket-alt"></i> Ringkasan Pemesanan</h5>
            </div>
            <div class="booking-code">
                <i class="fas fa-qrcode"></i> <?= esc($booking['booking_code'] ?? '-') ?>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <!-- Left Column -->
            <div class="info-column">
                <div class="info-item">
                    <div class="info-label">Nama Trip</div>
                    <div class="info-value"><?= esc($booking['title'] ?? '-') ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Lokasi</div>
                    <div class="info-value"><?= esc($booking['location'] ?? '-') ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Keberangkatan</div>
                    <div class="info-value">
                        📅 <?= isset($booking['departure_date']) ? date('d F Y', strtotime($booking['departure_date'])) : '-' ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Jumlah Peserta</div>
                    <div class="info-value">👥 <?= esc($booking['participant'] ?? 0) ?> Orang</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Harga per Orang</div>
                    <div class="info-value">Rp <?= number_format($booking['price'] ?? 0, 0, ',', '.') ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Total Harga</div>
                    <div class="price-value">Rp <?= number_format($booking['total_price'] ?? 0, 0, ',', '.') ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Pemesanan</div>
                    <div class="info-value"><?= date('d F Y • H:i', strtotime($booking['created_at'] ?? 'now')) ?></div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="info-column">
                <div class="info-item">
                    <div class="info-label">Metode Pembayaran</div>
                    <div class="info-value">
                        💳 <?= esc($payment['method'] ?? 'Belum dipilih') ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Status Pembayaran</div>
                    <div class="info-value">
                        <?php if (!empty($payment)): ?>
                            <?php if ($payment['status'] == 'pending'): ?>
                                <span class="badge-status badge-pending">
                                    <i class="fas fa-hourglass-half"></i> Menunggu Verifikasi
                                </span>
                            <?php elseif ($payment['status'] == 'verified'): ?>
                                <span class="badge-status badge-confirmed">
                                    <i class="fas fa-check"></i> Disetujui
                                </span>
                            <?php elseif ($payment['status'] == 'rejected'): ?>
                                <span class="badge-status badge-cancelled">
                                    <i class="fas fa-times"></i> Ditolak
                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="badge-status badge-secondary">
                                <i class="fas fa-exclamation-circle"></i> Belum Upload
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($payment['proof'])): ?>
                    <div class="info-item">
                        <div class="info-label">Bukti Pembayaran</div>
                        <div class="info-value">
                            <a href="<?= base_url('uploads/payments/' . $payment['proof']) ?>"
                                target="_blank"
                                class="btn-doc">
                                <i class="fas fa-eye"></i> Lihat Bukti
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($payment['paid_at'])): ?>
                    <div class="info-item">
                        <div class="info-label">Tanggal Verifikasi</div>
                        <div class="info-value">✓ <?= date('d F Y • H:i', strtotime($payment['paid_at'])) ?></div>
                    </div>
                <?php endif; ?>
                <div class="info-item">
                    <div class="info-label">Status Booking</div>
                    <div class="info-value">
                        <?php if (($booking['status'] ?? '') == 'pending'): ?>
                            <span class="badge-status badge-pending">
                                <i class="fas fa-hourglass-half"></i> Menunggu Konfirmasi
                            </span>
                        <?php elseif (($booking['status'] ?? '') == 'confirmed'): ?>
                            <span class="badge-status badge-confirmed">
                                <i class="fas fa-check-circle"></i> Terkonfirmasi
                            </span>
                        <?php elseif (($booking['status'] ?? '') == 'cancelled'): ?>
                            <span class="badge-status badge-cancelled">
                                <i class="fas fa-ban"></i> Dibatalkan
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Meeting Point</div>
                    <div class="info-value">
                        <?php if (!empty($booking['meeting_point_name'])): ?>
                            📍 <?= esc($booking['meeting_point_name']) ?>
                            <?php if (!empty($booking['meeting_point_address'])): ?>
                                <br><small class="text-muted" style="margin-top: 4px; display: block;"><?= esc($booking['meeting_point_address']) ?></small>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-muted" style="font-style: italic;">Akan diinformasikan setelah booking dikonfirmasi</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="btn-group">
        <a href="<?= base_url('booking/invoice/' . $booking['booking_id']) ?>" class="btn-primary">
            <i class="fas fa-file-pdf"></i> Unduh Invoice
        </a>

        <?php if (($booking['status'] ?? '') === 'confirmed' && !empty($booking['whatsapp_group'])): ?>
            <a href="<?= esc($booking['whatsapp_group']) ?>" target="_blank" class="btn-success">
                <i class="fab fa-whatsapp"></i> Gabung Grup WhatsApp
            </a>
        <?php endif; ?>

        <?php if (($booking['status'] ?? '') === 'pending' && empty($payment['proof'])): ?>
            <a href="<?= base_url('booking/upload-payment/' . $booking['booking_id']) ?>" class="btn-primary">
                <i class="fas fa-upload"></i> Upload Bukti Pembayaran
            </a>
        <?php endif; ?>

        <a href="<?= base_url('dashboard') ?>" class="btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Contact Support -->
    <div class="support-section">
        <small>
            <i class="fas fa-headset"></i>
            <span>Ada pertanyaan atau butuh bantuan? <a href="https://wa.me/6281234567890" target="_blank">Hubungi Customer Service</a></span>
        </small>
    </div>
</div>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>

<?= $this->endSection() ?>