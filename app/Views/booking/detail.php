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

    /* Main Card */
    .booking-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .booking-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e8e2d9;
    }

    .booking-header h5 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0f0e0d;
        margin-bottom: 5px;
    }

    .booking-code {
        font-family: monospace;
        font-size: 0.85rem;
        color: #c4603a;
        background: #faf8f5;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-block;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }

    .info-item {
        padding: 12px 0;
        border-bottom: 1px solid #e8e2d9;
    }

    .info-label {
        font-size: 0.75rem;
        color: #8c8780;
        margin-bottom: 4px;
    }

    .info-value {
        font-weight: 600;
        color: #0f0e0d;
        font-size: 0.9rem;
    }

    .price-value {
        color: #c4603a;
        font-size: 1rem;
    }

    /* Status Badge */
    .badge-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 500;
    }

    .badge-pending {
        background: #fef3c7;
        color: #d97706;
    }

    .badge-confirmed {
        background: #d1fae5;
        color: #059669;
    }

    .badge-cancelled {
        background: #fee2e2;
        color: #dc2626;
    }

    .badge-secondary {
        background: #f1f5f9;
        color: #64748b;
    }

    /* Alert */
    .alert-success {
        background: #d1fae5;
        border-left: 3px solid #059669;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 0.85rem;
    }

    /* Buttons */
    .btn-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 25px;
    }

    .btn-primary {
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
    }

    .btn-primary:hover {
        background: #b5532c;
    }

    .btn-success {
        background: #25D366;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-success:hover {
        background: #128C7E;
    }

    /* Documents Section */
    .documents-section {
        margin-top: 25px;
    }

    .section-title {
        font-size: 1rem;
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

    .documents-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .document-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 15px;
        background: #faf8f5;
        border-radius: 10px;
    }

    .document-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .document-avatar {
        width: 40px;
        height: 40px;
        background: #c4603a;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
    }

    .document-details h6 {
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 2px;
    }

    .document-details small {
        font-size: 0.7rem;
        color: #8c8780;
    }

    .document-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-doc {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.7rem;
        text-decoration: none;
        background: white;
        border: 1px solid #e8e2d9;
        color: #5a5a5a;
    }

    .btn-doc:hover {
        border-color: #c4603a;
        color: #c4603a;
    }

    .empty-state {
        text-align: center;
        padding: 30px;
        color: #8c8780;
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

    .mt-4 {
        margin-top: 20px;
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
        margin: 15px 0;
        border-color: #e8e2d9;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-container {
            padding: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .btn-group {
            flex-direction: column;
        }

        .document-item {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }

        .document-info {
            flex-direction: column;
        }
    }
</style>

<div class="detail-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Detail Booking</li>
        </ol>
    </nav>

    <!-- Booking Header -->
    <div class="booking-card">
        <div class="booking-header">
            <h5>
                <i class="fas fa-ticket-alt"></i> Detail Booking
            </h5>
            <div class="booking-code">
                <i class="fas fa-qrcode"></i> <?= esc($booking['booking_code'] ?? '-') ?>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <div>
                <div class="info-item">
                    <div class="info-label">Nama Trip</div>
                    <div class="info-value"><?= esc($booking['title'] ?? '-') ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Lokasi</div>
                    <div class="info-value"><?= esc($booking['location'] ?? '-') ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Trip</div>
                    <div class="info-value">
                        <?= isset($booking['departure_date']) ? date('d F Y', strtotime($booking['departure_date'])) : '-' ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Jumlah Peserta</div>
                    <div class="info-value"><?= esc($booking['participant'] ?? 0) ?> Orang</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Harga per Orang</div>
                    <div class="info-value">Rp <?= number_format($booking['price'] ?? 0, 0, ',', '.') ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Total Harga</div>
                    <div class="info-value price-value">
                        Rp <?= number_format($booking['total_price'] ?? 0, 0, ',', '.') ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Booking</div>
                    <div class="info-value"><?= date('d F Y H:i', strtotime($booking['created_at'] ?? 'now')) ?></div>
                </div>
            </div>

            <div>
                <div class="info-item">
                    <div class="info-label">Metode Pembayaran</div>
                    <div class="info-value"><?= esc($payment['method'] ?? '-') ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Status Pembayaran</div>
                    <div class="info-value">
                        <?php if (!empty($payment)): ?>
                            <?php if ($payment['status'] == 'pending'): ?>
                                <span class="badge-status badge-pending">Menunggu Verifikasi</span>
                            <?php elseif ($payment['status'] == 'verified'): ?>
                                <span class="badge-status badge-confirmed">Disetujui</span>
                            <?php elseif ($payment['status'] == 'rejected'): ?>
                                <span class="badge-status badge-cancelled">Ditolak</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="badge-status badge-secondary">Belum Upload</span>
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
                        <div class="info-value"><?= date('d F Y H:i', strtotime($payment['paid_at'])) ?></div>
                    </div>
                <?php endif; ?>
                <div class="info-item">
                    <div class="info-label">Status Booking</div>
                    <div class="info-value">
                        <?php if (($booking['status'] ?? '') == 'pending'): ?>
                            <span class="badge-status badge-pending">Menunggu Konfirmasi</span>
                        <?php elseif (($booking['status'] ?? '') == 'confirmed'): ?>
                            <span class="badge-status badge-confirmed">Terkonfirmasi</span>
                        <?php elseif (($booking['status'] ?? '') == 'cancelled'): ?>
                            <span class="badge-status badge-cancelled">Dibatalkan</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Meeting Point</div>
                    <div class="info-value">
                        <?php if (!empty($booking['meeting_point_name'])): ?>
                            <?= esc($booking['meeting_point_name']) ?>
                            <?php if (!empty($booking['meeting_point_address'])): ?>
                                <br><small class="text-muted"><?= esc($booking['meeting_point_address']) ?></small>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-muted">Akan diinformasikan setelah booking dikonfirmasi</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmed Alert -->
    <?php if (($booking['status'] ?? '') === 'confirmed'): ?>
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <strong>Booking Terkonfirmasi!</strong> Booking Anda sudah dikonfirmasi. Silahkan download tiket dan gabung grup WhatsApp.
        </div>
    <?php endif; ?>

    <!-- Action Buttons -->
    <div class="btn-group">
        <a href="<?= base_url('booking/invoice/' . $booking['booking_id']) ?>" class="btn-primary">
            <i class="fas fa-download"></i> Download Invoice
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
    </div>

    <!-- Contact Support -->
    <div class="text-center mt-4">
        <small class="text-muted">
            <i class="fas fa-headset"></i> Ada pertanyaan?
            <a href="https://wa.me/6281234567890" style="color: #c4603a;">Hubungi Customer Service</a>
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