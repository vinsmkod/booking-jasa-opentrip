<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/booking/invoice.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="invoice-container">
    <div class="invoice-wrapper">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="company-info">
                <h3>OpenTrip</h3>
                <p>📍 Adventures & Experiences</p>
                <p>Jl. Contoh No. 123, Kota</p>
                <p>📞 +62 812 3456 7890</p>
                <p>✉️ info@opentrip.com</p>
            </div>
            <div class="invoice-meta">
                <div class="meta-label">Invoice Number</div>
                <div class="meta-value"><?= esc($booking['booking_code']) ?></div>
                <div class="meta-label">Invoice Date</div>
                <div class="meta-value"><?= date('d M Y') ?></div>
            </div>
        </div>

        <!-- Invoice Body -->
        <div class="invoice-body">
            <!-- Trip Information -->
            <div class="section-title">📍 Trip Information</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Trip Name</div>
                    <div class="info-value"><?= esc($trip['title']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Location</div>
                    <div class="info-value"><?= esc($trip['location']) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Departure Date</div>
                    <div class="info-value"><?= date('d F Y', strtotime($schedule['departure_date'] ?? date('Y-m-d'))) ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Number of Participants</div>
                    <div class="info-value"><?= esc($booking['participant']) ?> Orang</div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="section-title">📋 Order Details</div>
            <table class="details-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align: right;">Unit Price</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Trip: <?= esc($trip['title']) ?></td>
                        <td style="text-align: right;">Rp <?= number_format($booking['price'] ?? 0, 0, ',', '.') ?></td>
                        <td style="text-align: center;"><?= esc($booking['participant']) ?></td>
                        <td style="text-align: right;">Rp <?= number_format($booking['total_price'] ?? 0, 0, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- Summary Section -->
            <div class="summary-section">
                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value">Rp <?= number_format($booking['total_price'] ?? 0, 0, ',', '.') ?></span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Tax (0%)</span>
                    <span class="summary-value">Rp 0</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Total Amount Due</span>
                    <span class="summary-value">Rp <?= number_format($booking['total_price'] ?? 0, 0, ',', '.') ?></span>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="section-title">✅ Payment Status</div>
            <div style="margin-bottom: 28px;">
                <?php if(($booking['payment_status'] ?? '') === 'pending'): ?>
                    <span class="badge-status badge-pending">
                        <i class="fas fa-hourglass-half"></i> Menunggu Pembayaran
                    </span>
                <?php elseif(($booking['payment_status'] ?? '') === 'verified' || ($booking['payment_status'] ?? '') === 'paid'): ?>
                    <span class="badge-status badge-confirmed">
                        <i class="fas fa-check-circle"></i> Pembayaran Diterima
                    </span>
                <?php else: ?>
                    <span class="badge-status badge-pending">
                        <i class="fas fa-info-circle"></i> <?= esc($booking['payment_status'] ?? 'Pending') ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Terms -->
            <div style="background: #f8fafc; padding: 16px; border-radius: 8px; font-size: 0.8rem; color: #64748b; line-height: 1.6;">
                <strong style="color: #0f172a;">Catatan Penting:</strong><br>
                • Invoice ini adalah bukti pemesanan Anda<br>
                • Simpan invoice ini untuk proses check-in<br>
                • Hubungi customer service jika ada pertanyaan<br>
                • Terima kasih telah mempercayai OpenTrip
            </div>
        </div>

        <!-- Invoice Footer -->
        <div class="invoice-footer">
            <p>
                <strong>BLNTRK OUTDOOR</strong><br>
                Jl. Contoh No. 123, Kota | 📞 +62 812 3456 7890<br>
                📧 info@opentrip.com | 🌐 www.opentrip.com<br>
                <br>
                <em>Terima kasih telah menjadi bagian dari petualangan kami!</em>
            </p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="print-actions">
        <button onclick="window.print()" class="btn-action btn-print">
            <i class="fas fa-print"></i> Print Invoice
        </button>
        <a href="<?= base_url('booking/detail/' . $booking['booking_id']) ?>" class="btn-action btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Detail
        </a>
    </div>
</div>

<?= $this->endSection() ?>