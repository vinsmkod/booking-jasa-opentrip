<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - BLNTRK OUTDOOR</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #e9ecef;
            font-family: 'DejaVu Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        /* Professional card style */
        .invoice {
            max-width: 780px;
            width: 100%;
            background: #ffffff;
            border-radius: 4px;
            box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Simple border accent */
        .invoice-header {
            padding: 32px 36px 24px 36px;
            border-bottom: 1px solid #eaeef2;
        }

        .company-info {
            margin-bottom: 20px;
        }

        .company-name {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.3px;
            color: #1a3b2f;
            margin-bottom: 4px;
        }

        .company-tag {
            font-size: 12px;
            color: #6c7a8e;
        }

        .invoice-title-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 8px;
        }

        .invoice-badge {
            font-size: 26px;
            font-weight: 600;
            color: #1a2c3e;
            letter-spacing: -0.5px;
        }

        .booking-ref {
            text-align: right;
        }

        .booking-code {
            font-size: 14px;
            font-weight: 500;
            color: #2c6e5c;
            background: #f0f4f1;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-block;
        }

        .ref-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #6c7a8e;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        /* Two column layout for customer details */
        .customer-section {
            padding: 24px 36px 20px 36px;
            background: #fafcfd;
            border-bottom: 1px solid #eaeef2;
        }

        .row-2col {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            min-width: 180px;
        }

        .detail-item {
            margin-bottom: 14px;
        }

        .detail-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #6c7a8e;
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 15px;
            font-weight: 500;
            color: #1e2f3e;
        }

        .trip-title {
            font-weight: 700;
            color: #1a5d4a;
        }

        /* Table styling - clean and minimal */
        .trip-details {
            padding: 24px 36px 20px 36px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #4a627a;
            margin-bottom: 18px;
            border-left: 3px solid #2c6e5c;
            padding-left: 12px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table tr {
            border-bottom: 1px solid #edf1f5;
        }

        .info-table td {
            padding: 14px 0;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 38%;
            font-size: 13px;
            color: #4a5e75;
            font-weight: 500;
        }

        .info-table td:last-child {
            font-size: 15px;
            font-weight: 500;
            color: #1e2f3e;
        }

        .total-row td {
            padding-top: 18px;
            padding-bottom: 18px;
            border-top: 1px solid #e2e8f0;
            border-bottom: none;
        }

        .total-label {
            font-size: 16px;
            font-weight: 700;
            color: #1a2c3e;
        }

        .total-amount {
            font-size: 20px;
            font-weight: 700;
            color: #1f6e4a;
        }

        /* Status badge simple */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 30px;
            background: #f0f2f5;
            color: #2c3e50;
        }

        .status-paid {
            background: #e3f2ed;
            color: #1f6e4a;
        }

        .status-pending {
            background: #fff0e0;
            color: #c97e2a;
        }

        .status-unpaid {
            background: #fee9e6;
            color: #bc4e2c;
        }

        .status-cancelled {
            background: #f0f2f5;
            color: #6f7e95;
        }

        /* Footer professional */
        .invoice-footer {
            padding: 20px 36px 32px 36px;
            border-top: 1px solid #eaeef2;
            background: #ffffff;
            text-align: center;
        }

        .thankyou-text {
            font-size: 13px;
            color: #4f6f5e;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .bank-info {
            font-size: 11px;
            color: #6c7a8e;
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 6px;
            display: inline-block;
            width: auto;
            margin-top: 8px;
        }

        hr {
            margin: 16px 0;
            border: none;
            border-top: 1px solid #eef2f6;
        }

        /* Print ready */
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            .invoice {
                box-shadow: none;
                border-radius: 0;
            }
            .status-badge {
                border: 1px solid #ccc;
            }
        }

        @media (max-width: 560px) {
            .invoice-header, .customer-section, .trip-details, .invoice-footer {
                padding-left: 24px;
                padding-right: 24px;
            }
        }
    </style>
</head>
<body>
<div class="invoice">
    <!-- HEADER: company + booking code -->
    <div class="invoice-header">
        <div class="company-info">
            <div class="company-name">BLNTRK OUTDOOR</div>
            <div class="company-tag">Expedition • Adventure • Wilderness</div>
        </div>
        <div class="invoice-title-section">
            <div class="invoice-badge">INVOICE</div>
            <div class="booking-ref">
                <div class="ref-label">KODE BOOKING</div>
                <div class="booking-code"><?= htmlspecialchars($booking['booking_code']) ?></div>
            </div>
        </div>
    </div>

    <!-- CUSTOMER INFO: two columns clean -->
    <div class="customer-section">
        <div class="row-2col">
            <div class="col">
                <div class="detail-item">
                    <div class="detail-label">Nama Pelanggan</div>
                    <div class="detail-value"><?= htmlspecialchars($booking['name']) ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value"><?= htmlspecialchars($booking['email']) ?></div>
                </div>
            </div>
            <div class="col">
                <div class="detail-item">
                    <div class="detail-label">Paket Trip</div>
                    <div class="detail-value trip-title"><?= htmlspecialchars($booking['title']) ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Lokasi</div>
                    <div class="detail-value"><?= htmlspecialchars($booking['location']) ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- DETAIL TABLE: itinerary & payment -->
    <div class="trip-details">
        <div class="section-title">RINCIAN PERJALANAN</div>
        <table class="info-table">
            <tr>
                <td>Tanggal Keberangkatan</td>
                <td><?= date('d F Y', strtotime($booking['departure_date'])) ?></td>
            </tr>
            <tr>
                <td>Jumlah Peserta</td>
                <td><?= (int) $booking['participant'] ?> orang</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <?php 
                        $statusRaw = strtolower(trim($booking['status']));
                        $statusText = '';
                        $statusClass = 'status-pending';
                        if(in_array($statusRaw, ['paid', 'lunas', 'confirmed', 'settled'])) {
                            $statusText = 'LUNAS';
                            $statusClass = 'status-paid';
                        } elseif(in_array($statusRaw, ['pending', 'menunggu', 'waiting'])) {
                            $statusText = 'MENUNGGU PEMBAYARAN';
                            $statusClass = 'status-pending';
                        } elseif(in_array($statusRaw, ['unpaid', 'belum bayar'])) {
                            $statusText = 'BELUM LUNAS';
                            $statusClass = 'status-unpaid';
                        } elseif(in_array($statusRaw, ['cancelled', 'batal', 'cancel'])) {
                            $statusText = 'DIBATALKAN';
                            $statusClass = 'status-cancelled';
                        } else {
                            $statusText = strtoupper($booking['status']);
                        }
                    ?>
                    <span class="status-badge <?= $statusClass ?>"><?= $statusText ?></span>
                </td>
            </tr>
            <tr class="total-row">
                <td class="total-label">Total Tagihan</td>
                <td class="total-amount">Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>

    <!-- FOOTER: professional payment notes & thanks -->
    <div class="invoice-footer">
        <div class="thankyou-text">Terima kasih telah mempercayakan petualangan Anda bersama BLNTRK OUTDOOR</div>
        <div class="bank-info">
            💳 Transfer ke rekening: BCA / Mandiri / BRI<br>
            a.n BLNTRK OUTDOOR | Konfirmasi pembayaran ke +62 812 3456 7890
        </div>
        <hr>
        <div style="font-size: 10px; color: #8a99aa; margin-top: 8px;">
            Invoice ini dibuat secara digital dan berlaku sebagai bukti pemesanan resmi.
        </div>
    </div>
</div>
</body>
</html>