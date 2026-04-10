<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/booking/detail.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>


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