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

    .invoice-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 24px;
    }

    /* Print Styles */
    @media print {
        body {
            background: white;
        }
        .invoice-container {
            margin: 0;
            padding: 0;
        }
        .print-actions {
            display: none;
        }
    }

    /* Invoice Wrapper */
    .invoice-wrapper {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
        overflow: hidden;
    }

    /* Invoice Header */
    .invoice-header {
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        color: white;
        padding: 40px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: flex-start;
    }

    .company-info h3 {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .company-info p {
        font-size: 0.85rem;
        opacity: 0.9;
        margin-bottom: 4px;
        line-height: 1.6;
    }

    .invoice-meta {
        text-align: right;
    }

    .invoice-meta .meta-label {
        font-size: 0.8rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .invoice-meta .meta-value {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 16px;
    }

    /* Invoice Body */
    .invoice-body {
        padding: 40px;
    }

    /* Section Title */
    .section-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #2d7d3a;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
        margin-top: 28px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f1f5f9;
    }

    .section-title:first-of-type {
        margin-top: 0;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        margin-bottom: 32px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.8rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 0.95rem;
        color: #0f172a;
        font-weight: 600;
    }

    /* Details Table */
    .details-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 32px;
    }

    .details-table thead {
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        border-bottom: 2px solid #d1fae5;
    }

    .details-table th {
        padding: 14px;
        text-align: left;
        font-size: 0.85rem;
        font-weight: 700;
        color: #2d7d3a;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .details-table td {
        padding: 16px 14px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        color: #0f172a;
    }

    .details-table tr:last-child td {
        border-bottom: none;
    }

    /* Summary Section */
    .summary-section {
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        border: 1.5px solid #d1fae5;
        border-radius: 10px;
        padding: 24px;
        margin-bottom: 28px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        font-size: 0.9rem;
    }

    .summary-row:last-child {
        padding-top: 16px;
        border-top: 2px solid #d1fae5;
        font-weight: 700;
        font-size: 1rem;
        color: #2d7d3a;
    }

    .summary-label {
        color: #475569;
        font-weight: 500;
    }

    .summary-value {
        font-weight: 600;
        color: #0f172a;
    }

    /* Badge */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-confirmed {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-paid {
        background: #d1fae5;
        color: #065f46;
    }

    /* Footer */
    .invoice-footer {
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
        padding: 28px 40px;
        text-align: center;
        font-size: 0.8rem;
        color: #64748b;
        line-height: 1.6;
    }

    .invoice-footer a {
        color: #2d7d3a;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .invoice-footer a:hover {
        color: #1f5428;
    }

    /* Actions */
    .print-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 28px;
    }

    .btn-action {
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }

    .btn-print {
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        color: white;
    }

    .btn-print:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(45, 125, 58, 0.3);
    }

    .btn-back {
        background: white;
        color: #0f172a;
        border: 1.5px solid #e2e8f0;
    }

    .btn-back:hover {
        border-color: #2d7d3a;
        color: #2d7d3a;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .invoice-container {
            margin: 20px;
            padding: 12px;
        }

        .invoice-header {
            grid-template-columns: 1fr;
            padding: 24px;
            gap: 24px;
        }

        .invoice-meta {
            text-align: left;
        }

        .invoice-body {
            padding: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .summary-section {
            padding: 16px;
        }

        .invoice-footer {
            padding: 20px;
        }

        .print-actions {
            flex-direction: column;
        }

        .btn-action {
            justify-content: center;
            width: 100%;
        }
    }
</style>

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