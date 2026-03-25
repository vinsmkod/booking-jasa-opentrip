<!DOCTYPE html>
<html>
<head>

<style>

body{
font-family: DejaVu Sans;
}

.header{
text-align:center;
margin-bottom:30px;
}

.table{
width:100%;
border-collapse:collapse;
}

.table td{
padding:8px;
border-bottom:1px solid #ddd;
}

.total{
font-size:18px;
font-weight:bold;
}

</style>

</head>

<body>

<div class="header">
<h2>INVOICE OPEN TRIP</h2>
<p>Kode Booking : <?= $booking['booking_code'] ?></p>
</div>

<table class="table">

<tr>
<td>Nama</td>
<td><?= $booking['name'] ?></td>
</tr>

<tr>
<td>Email</td>
<td><?= $booking['email'] ?></td>
</tr>

<tr>
<td>Trip</td>
<td><?= $booking['title'] ?></td>
</tr>

<tr>
<td>Lokasi</td>
<td><?= $booking['location'] ?></td>
</tr>

<tr>
<td>Tanggal Berangkat</td>
<td><?= date('d M Y',strtotime($booking['departure_date'])) ?></td>
</tr>

<tr>
<td>Jumlah Peserta</td>
<td><?= $booking['participant'] ?></td>
</tr>

<tr>
<td>Total</td>
<td class="total">
Rp <?= number_format($booking['total_price'],0,',','.') ?>
</td>
</tr>

<tr>
<td>Status</td>
<td><?= strtoupper($booking['status']) ?></td>
</tr>

</table>

<br><br>

<p>Terima kasih telah menggunakan Open Trip Indonesia</p>

</body>
</html>