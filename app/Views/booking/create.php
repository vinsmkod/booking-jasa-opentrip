<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5 mb-5">
<div class="row">

<!-- LEFT SIDE -->
<div class="col-md-8 mb-4">
<div class="card shadow-sm">
<div class="card-body">

<h5 class="fw-semibold mb-4">Detail Pemesanan</h5>

<form method="post"
action="<?= base_url('booking/store') ?>"
enctype="multipart/form-data">

<?= csrf_field() ?>

<input type="hidden"
name="schedule_id"
value="<?= esc($schedule['schedule_id']) ?>">

<!-- MEETING POINT -->
<div class="mb-4">
<label class="form-label">Meeting Point</label>

<select name="meeting_point_id"
class="form-control"
required>

<option value="">-- Pilih --</option>

<?php foreach($meetingPoints as $mp): ?>
<option value="<?= $mp['meeting_point_id'] ?>">
<?= esc($mp['name']) ?> - <?= esc($mp['address']) ?>
</option>
<?php endforeach; ?>

</select>
</div>

<!-- FORM PESERTA -->
<div id="participantsContainer"></div>

</div>
</div>
</div>


<!-- RIGHT SIDE -->
<div class="col-md-4">

<!-- JUMLAH PESERTA -->
<div class="card shadow-sm mb-3">
<div class="card-body">

<label class="form-label fw-semibold">Jumlah Peserta</label>

<input type="number"
id="participantCount"
name="participant"
class="form-control"
min="1"
max="<?= esc($schedule['available']) ?>"
value="1"
required>

</div>
</div>


<!-- RINGKASAN -->
<div class="card shadow-sm">
<div class="card-body">

<h6 class="fw-semibold mb-3">Ringkasan Trip</h6>

<p class="fw-semibold"><?= esc($schedule['title']) ?></p>
<p class="small text-muted"><?= esc($schedule['location']) ?></p>
<p class="small"><?= date('d M Y', strtotime($schedule['departure_date'])) ?></p>

<hr>

<p>Harga per Peserta<br>
<strong>Rp <?= number_format($schedule['price'],0,',','.') ?></strong>
</p>

<p>Total Harga<br>
<strong id="totalPrice">Rp <?= number_format($schedule['price'],0,',','.') ?></strong>
</p>

<hr>

<!-- LOYALTY POINT -->
<?php
$userPoints = session()->get('points') ?? 0;
$maxRedeem = floor($userPoints / 100);
?>

<?php if($maxRedeem > 0): ?>

<div class="mb-3">

<label class="form-label fw-semibold">Gunakan Loyalty Point</label>

<select id="redeemPoint" name="redeem_point" class="form-control">

<option value="0">Tidak digunakan</option>

<?php for($i=1;$i<=$maxRedeem;$i++): ?>

<option value="<?= $i*100 ?>">
<?= $i*100 ?> poin (Potongan Rp <?= number_format($i*5000,0,',','.') ?>)
</option>

<?php endfor; ?>

</select>

</div>

<?php endif; ?>


<p>Potongan Harga<br>
<strong id="discountPrice">Rp 0</strong>
</p>

<hr>

<p>Total Bayar<br>
<strong id="finalPrice" class="text-success">
Rp <?= number_format($schedule['price'],0,',','.') ?>
</strong>
</p>

<hr>


<!-- METODE PEMBAYARAN -->
<div class="mb-3">

<label class="form-label">Metode Pembayaran</label>

<select name="payment_method"
id="paymentMethod"
class="form-control"
required>

<option value="">-- Pilih Metode Pembayaran --</option>
<option value="Transfer Bank">Transfer Bank</option>
<option value="E-Wallet">E-Wallet</option>

</select>

</div>

<div id="paymentDetail"
class="alert alert-light d-none"></div>

<div id="proofUpload"
class="mb-3 d-none">

<label class="form-label">Upload Bukti Pembayaran</label>

<input type="file"
name="payment_proof"
class="form-control"
accept="image/*,application/pdf">

</div>


<button type="submit"
class="btn btn-dark w-100 mt-3">

Konfirmasi Pesanan

</button>

</form>

</div>
</div>

</div>
</div>
</div>



<!-- TEMPLATE PESERTA -->
<template id="participantTemplate">

<div class="card mb-3 p-3">

<h6 class="fw-semibold mb-3 peserta-title"></h6>

<div class="row">

<div class="col-md-6 mb-3">
<label>Nama Lengkap</label>
<input type="text" class="form-control name-input" required>
</div>

<div class="col-md-6 mb-3">
<label>Email</label>
<input type="email" class="form-control email-input" required>
</div>

<div class="col-md-6 mb-3">
<label>Tanggal Lahir</label>
<input type="date" class="form-control birthdate-input">
</div>

<div class="col-md-6 mb-3">
<label>Jenis Kelamin</label>
<select class="form-control gender-input">
<option value="">Pilih</option>
<option>Laki-laki</option>
<option>Perempuan</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Upload KTP</label>
<input type="file"
class="form-control ktp-input"
accept="image/*,application/pdf"
required>
</div>

<div class="col-md-6 mb-3">
<label>Upload Surat Kesehatan</label>
<input type="file"
class="form-control health-input"
accept="image/*,application/pdf"
required>
</div>

</div>

</div>

</template>


<style>
.card{border-radius:12px;}
.card input,.card select{border-radius:8px;}
</style>


<script>

const participantInput = document.getElementById("participantCount");
const container = document.getElementById("participantsContainer");
const template = document.getElementById("participantTemplate");

const pricePerPerson = <?= $schedule['price'] ?>;

const totalPriceEl = document.getElementById("totalPrice");
const discountEl = document.getElementById("discountPrice");
const finalPriceEl = document.getElementById("finalPrice");

const redeemSelect = document.getElementById("redeemPoint");

const paymentSelect = document.getElementById("paymentMethod");
const paymentDetail = document.getElementById("paymentDetail");
const proofUpload = document.getElementById("proofUpload");


function formatRupiah(number){
return "Rp " + number.toLocaleString("id-ID");
}


function generateForms(count){

container.innerHTML="";

for(let i=0;i<count;i++){

const clone = template.content.cloneNode(true);

clone.querySelector(".peserta-title").innerText="Peserta "+(i+1);

clone.querySelector(".name-input").setAttribute("name",`participants[${i}][name]`);
clone.querySelector(".email-input").setAttribute("name",`participants[${i}][email]`);
clone.querySelector(".birthdate-input").setAttribute("name",`participants[${i}][birthdate]`);
clone.querySelector(".gender-input").setAttribute("name",`participants[${i}][gender]`);
clone.querySelector(".ktp-input").setAttribute("name","ktp[]");
clone.querySelector(".health-input").setAttribute("name","health[]");

container.appendChild(clone);

}

updatePrice();

}


function updatePrice(){

let participants = participantInput.value;

let total = pricePerPerson * participants;

let redeem = 0;

if(redeemSelect){
redeem = parseInt(redeemSelect.value) || 0;
}

let discount = (redeem/100) * 5000;

let final = total - discount;

if(final < 0){
final = 0;
}

totalPriceEl.innerText = formatRupiah(total);
discountEl.innerText = formatRupiah(discount);
finalPriceEl.innerText = formatRupiah(final);

}


participantInput.addEventListener("input",function(){
generateForms(this.value);
});


if(redeemSelect){

redeemSelect.addEventListener("change",function(){
updatePrice();
});

}


paymentSelect.addEventListener("change",function(){

let content="";

proofUpload.classList.add("d-none");

if(this.value==="Transfer Bank"){
content="Transfer ke BCA - 1234567890 a.n OpenTrip Indonesia";
proofUpload.classList.remove("d-none");
}

if(this.value==="E-Wallet"){
content="DANA / OVO / GoPay - 081234567890";
proofUpload.classList.remove("d-none");
}

if(content!==""){
paymentDetail.classList.remove("d-none");
paymentDetail.innerHTML=content;
}else{
paymentDetail.classList.add("d-none");
}

});


generateForms(participantInput.value);

</script>

<?= $this->endSection() ?>