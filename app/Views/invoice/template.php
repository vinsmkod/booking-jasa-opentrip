<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Invoice Booking</title>

<style>
body{
    font-family: "DejaVu Sans", Arial, sans-serif;
    font-size:14px;
    color:#333;
    line-height:1.5;
    margin:0;
    padding:0 20px;
}

/* HEADER */
.header{
    width:100%;
    margin-bottom:30px;
}

.header .logo{
    font-size:28px;
    font-weight:bold;
    color:#2E86C1;
}

.header .company-info{
    text-align:right;
    font-size:12px;
    color:#555;
}

/* TITLE */
.title{
    margin-top:20px;
    margin-bottom:20px;
}

.title h2{
    margin:0;
    color:#2E86C1;
    border-bottom:2px solid #2E86C1;
    display:inline-block;
    padding-bottom:5px;
}

.invoice-info{
    margin-top:10px;
    font-size:13px;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th, td{
    padding:10px;
}

th{
    background:#2E86C1;
    color:white;
    text-align:left;
}

td{
    border-bottom:1px solid #ddd;
}

td.total{
    font-weight:bold;
    font-size:15px;
}

/* STATUS */
.status{
    padding:5px 10px;
    border-radius:4px;
    font-size:12px;
    font-weight:bold;
    display:inline-block;
}

.status.pending{
    background:#fff3cd;
    color:#856404;
}

.status.confirmed{
    background:#d4edda;
    color:#155724;
}

.status.cancelled{
    background:#f8d7da;
    color:#721c24;
}

/* FOOTER */
.footer{
    margin-top:40px;
    font-size:12px;
    color:#777;
    border-top:1px solid #ddd;
    padding-top:10px;
}
</style>
</head>

<body>

<!-- HEADER -->
<table class="header">
<tr>
<td>
<div class="logo">BLNTRK OPEN TRIP</div>
</td>

<td class="company-info">
BLNTRK Adventure Travel<br>
Bandung, Indonesia<br>
Email: support@blntrk.com<br>
Telepon: +62 812 3456 7890
</td>
</tr>
</table>

<!-- JUDUL -->
<div class="title">
<h2>INVOICE</h2>
<div class="invoice-info">
<strong>Nomor Invoice:</strong> <?= isset($booking['booking_code']) ? esc($booking['booking_code']) : '-' ?><br>
<strong>Tanggal:</strong> <?= isset($booking['created_at']) ? date('d M Y', strtotime($booking['created_at'])) : '-' ?>
</div>
</div>

<!-- INFO PELANGGAN -->
<table>
<tr>
<th width="30%">Nama Pelanggan</th>
<td><?= isset($booking['name']) ? esc($booking['name']) : '-' ?></td>
</tr>

<tr>
<th>Email</th>
<td><?= isset($booking['email']) && !empty($booking['email']) ? esc($booking['email']) : '-' ?></td>
</tr>

<tr>
<th>Meeting Point</th>
<td><?= isset($booking['meeting_point']) && !empty($booking['meeting_point']) ? esc($booking['meeting_point']) : '-' ?></td>
</tr>
</table>

<!-- DETAIL TRIP -->
<table>
<thead>
<tr>
<th>Trip</th>
<th>Lokasi</th>
<th>Tanggal</th>
<th>Peserta</th>
<th>Harga</th>
<th>Total</th>
</tr>
</thead>

<tbody>
<tr>
<td><?= isset($booking['title']) ? esc($booking['title']) : '-' ?></td>
<td><?= isset($booking['location']) ? esc($booking['location']) : '-' ?></td>
<td><?= isset($booking['departure_date']) ? date('d M Y', strtotime($booking['departure_date'])) : '-' ?></td>
<td><?= isset($booking['participant']) ? esc($booking['participant']) : '-' ?></td>
<td>Rp <?= isset($booking['price']) ? number_format($booking['price'],0,',','.') : '-' ?></td>
<td class="total">Rp <?= isset($booking['total_price']) ? number_format($booking['total_price'],0,',','.') : '-' ?></td>
</tr>
</tbody>
</table>

<!-- STATUS PEMBAYARAN -->
<table>
<tr>
<th width="30%">Status Pembayaran</th>
<td>
<?php 
$status = isset($booking['status']) ? $booking['status'] : 'pending';

if($status == 'pending'): ?>
<span class="status pending">Menunggu Pembayaran</span>
<?php elseif($status == 'confirmed'): ?>
<span class="status confirmed">Pembayaran Dikonfirmasi</span>
<?php else: ?>
<span class="status cancelled">Dibatalkan</span>
<?php endif; ?>
</td>
</tr>
</table>

<!-- FOOTER -->
<div class="footer">
<p>Terima kasih telah melakukan pemesanan di <strong>BLNTRK Open Trip</strong>.</p>
<p>Silakan bawa invoice ini dan identitas Anda saat mengikuti trip.</p>
<p>Invoice ini dibuat secara otomatis oleh sistem.</p>
</div>

</body>
</html>