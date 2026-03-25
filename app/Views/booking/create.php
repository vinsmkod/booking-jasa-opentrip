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

    .booking-container {
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

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
    }

    .summary-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        position: sticky;
        top: 20px;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0f0e0d;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e8e2d9;
    }

    .section-title i {
        color: #c4603a;
        margin-right: 8px;
    }

    /* Form Elements */
    .form-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #0f0e0d;
        margin-bottom: 6px;
        display: block;
    }

    .form-control,
    .form-select {
        background: white;
        border: 1px solid #e8e2d9;
        border-radius: 8px;
        padding: 10px 12px;
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        width: 100%;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #c4603a;
        outline: none;
    }

    /* Participant Card */
    .participant-card {
        background: #faf8f5;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        border: 1px solid #e8e2d9;
    }

    .participant-title {
        font-weight: 600;
        color: #c4603a;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #e8e2d9;
    }

    /* Participant Counter */
    .participant-counter {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .participant-counter .form-control {
        width: 80px;
        text-align: center;
    }

    /* Trip Info */
    .trip-info {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e8e2d9;
    }

    .trip-title {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 5px;
        color: #0f0e0d;
    }

    .trip-location,
    .trip-date {
        font-size: 0.8rem;
        color: #8c8780;
    }

    .trip-location i,
    .trip-date i {
        margin-right: 5px;
        color: #c4603a;
    }

    /* Price Rows */
    .price-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 0.85rem;
    }

    .price-label {
        color: #8c8780;
    }

    .price-value {
        font-weight: 500;
        color: #0f0e0d;
    }

    .total-price {
        font-size: 0.9rem;
        font-weight: 700;
        color: #c4603a;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #e8e2d9;
    }

    .final-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #c4603a;
    }

    /* Button */
    .btn-submit {
        width: 100%;
        padding: 12px;
        background: #c4603a;
        border: none;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        margin-top: 20px;
    }

    .btn-submit:hover {
        background: #b5532c;
    }

    /* Alert */
    .alert-info {
        background: #faf8f5;
        border-left: 3px solid #c4603a;
        padding: 12px 15px;
        margin: 15px 0;
        font-size: 0.8rem;
        color: #5a5a5a;
    }

    .text-muted {
        color: #8c8780 !important;
    }

    .small {
        font-size: 0.7rem;
    }

    .mt-3 {
        margin-top: 15px;
    }

    .mb-3 {
        margin-bottom: 15px;
    }

    .mb-4 {
        margin-bottom: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .booking-container {
            padding: 20px;
        }

        .summary-card {
            position: relative;
            top: 0;
            margin-top: 20px;
        }

        .form-card {
            padding: 20px;
        }

        .participant-card {
            padding: 12px;
        }
    }
</style>

<div class="booking-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>#Trip">Trip</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('trips/detail/' . $schedule['schedule_id']) ?>"><?= esc($schedule['title']) ?></a></li>
            <li class="breadcrumb-item active">Booking</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Left Column - Form -->
        <div class="col-lg-7">
            <div class="form-card">
                <div class="section-title">
                    <i class="fas fa-pencil-alt"></i> Detail Pemesanan
                </div>

                <form method="post" action="<?= base_url('booking/store') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="schedule_id" value="<?= esc($schedule['schedule_id']) ?>">
                    <input type="hidden" name="final_price" id="finalPriceInput" value="<?= esc($schedule['price']) ?>">

                    <!-- Meeting Point -->
                    <div class="mb-4">
                        <label class="form-label">Meeting Point</label>
                        <select name="meeting_point_id" class="form-select" required>
                            <option value="">-- Pilih Meeting Point --</option>
                            <?php foreach ($meetingPoints as $mp): ?>
                                <option value="<?= $mp['meeting_point_id'] ?>">
                                    <?= esc($mp['name']) ?> - <?= esc($mp['address']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Jumlah Peserta -->
                    <div class="mb-4">
                        <label class="form-label">Jumlah Peserta</label>
                        <div class="participant-counter">
                            <input type="number"
                                id="participantCount"
                                name="participant"
                                class="form-control"
                                min="1"
                                max="<?= esc($schedule['available']) ?>"
                                value="1"
                                required>
                            <span class="text-muted small">Maksimal <?= esc($schedule['available']) ?> orang</span>
                        </div>
                    </div>

                    <!-- Participants Container -->
                    <div id="participantsContainer"></div>

                    <!-- Metode Pembayaran -->
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="payment_method" id="paymentMethod" class="form-select" required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="E-Wallet">E-Wallet (DANA/OVO/GoPay)</option>
                        </select>
                    </div>

                    <!-- Payment Detail -->
                    <div id="paymentDetail" class="alert-info d-none"></div>

                    <!-- Upload Bukti -->
                    <div id="proofUpload" class="mt-3 d-none">
                        <label class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" id="paymentProof" class="form-control" accept="image/*,application/pdf">
                        <div class="text-muted small mt-1">Format: JPG, PNG, PDF (Max 5MB)</div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-check-circle"></i> Konfirmasi Pesanan
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column - Summary -->
        <div class="col-lg-5">
            <div class="summary-card">
                <div class="section-title">
                    <i class="fas fa-receipt"></i> Ringkasan Trip
                </div>

                <div class="trip-info">
                    <div class="trip-title"><?= esc($schedule['title']) ?></div>
                    <div class="trip-location">
                        <i class="fas fa-map-marker-alt"></i> <?= esc($schedule['location']) ?>
                    </div>
                    <div class="trip-date">
                        <i class="fas fa-calendar-alt"></i> <?= date('d F Y', strtotime($schedule['departure_date'])) ?>
                    </div>
                </div>

                <div class="price-row">
                    <span class="price-label">Harga per Peserta</span>
                    <span class="price-value">Rp <?= number_format($schedule['price'], 0, ',', '.') ?></span>
                </div>

                <div class="price-row">
                    <span class="price-label">Jumlah Peserta</span>
                    <span class="price-value" id="displayParticipant">1 Orang</span>
                </div>

                <div class="price-row total-price">
                    <span class="price-label">Total Harga</span>
                    <span class="price-value" id="totalPrice">Rp <?= number_format($schedule['price'], 0, ',', '.') ?></span>
                </div>

                <?php
                $userPoints = session()->get('points') ?? 0;
                $maxRedeem = floor($userPoints / 100);
                ?>

                <?php if ($maxRedeem > 0): ?>
                    <div class="mt-3 mb-3">
                        <label class="form-label">Gunakan Loyalty Point</label>
                        <select id="redeemPoint" name="redeem_point" class="form-select">
                            <option value="0">Tidak digunakan</option>
                            <?php for ($i = 1; $i <= $maxRedeem; $i++): ?>
                                <option value="<?= $i * 100 ?>">
                                    <?= $i * 100 ?> poin (Potongan Rp <?= number_format($i * 5000, 0, ',', '.') ?>)
                                </option>
                            <?php endfor; ?>
                        </select>
                        <div class="text-muted small mt-1">Anda memiliki <?= $userPoints ?> poin</div>
                    </div>

                    <div class="price-row">
                        <span class="price-label">Potongan Harga</span>
                        <span class="price-value" id="discountPrice">Rp 0</span>
                    </div>
                <?php endif; ?>

                <div class="price-row mt-2 pt-2">
                    <span class="price-label">Total Bayar</span>
                    <span class="price-value final-price" id="finalPrice">Rp <?= number_format($schedule['price'], 0, ',', '.') ?></span>
                </div>
            </div>

            <div class="alert-info mt-3">
                <i class="fas fa-info-circle"></i>
                <strong>Petunjuk:</strong><br>
                1. Isi data peserta lengkap<br>
                2. Pilih metode pembayaran<br>
                3. Upload bukti pembayaran<br>
                4. Klik Konfirmasi Pesanan
            </div>
        </div>
    </div>
</div>

<!-- Participant Template -->
<template id="participantTemplate">
    <div class="participant-card">
        <div class="participant-title peserta-title"></div>
        <div class="row g-2">
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control name-input" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control email-input" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control birthdate-input">
            </div>
            <div class="col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-select gender-input">
                    <option value="">Pilih</option>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Upload KTP</label>
                <input type="file" class="form-control ktp-input" accept="image/*,application/pdf" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Upload Surat Sehat</label>
                <input type="file" class="form-control health-input" accept="image/*,application/pdf" required>
            </div>
        </div>
    </div>
</template>

<script>
    const participantInput = document.getElementById("participantCount");
    const container = document.getElementById("participantsContainer");
    const template = document.getElementById("participantTemplate");
    const pricePerPerson = <?= $schedule['price'] ?>;
    const totalPriceEl = document.getElementById("totalPrice");
    const discountEl = document.getElementById("discountPrice");
    const finalPriceEl = document.getElementById("finalPrice");
    const finalPriceInput = document.getElementById("finalPriceInput");
    const redeemSelect = document.getElementById("redeemPoint");
    const paymentSelect = document.getElementById("paymentMethod");
    const paymentDetail = document.getElementById("paymentDetail");
    const proofUpload = document.getElementById("proofUpload");
    const displayParticipant = document.getElementById("displayParticipant");

    function formatRupiah(number) {
        return "Rp " + number.toLocaleString("id-ID");
    }

    function generateForms(count) {
        container.innerHTML = "";
        for (let i = 0; i < count; i++) {
            const clone = template.content.cloneNode(true);
            clone.querySelector(".peserta-title").innerText = "Peserta " + (i + 1);
            clone.querySelector(".name-input").setAttribute("name", `participants[${i}][name]`);
            clone.querySelector(".email-input").setAttribute("name", `participants[${i}][email]`);
            clone.querySelector(".birthdate-input").setAttribute("name", `participants[${i}][birthdate]`);
            clone.querySelector(".gender-input").setAttribute("name", `participants[${i}][gender]`);
            clone.querySelector(".ktp-input").setAttribute("name", "ktp[]");
            clone.querySelector(".health-input").setAttribute("name", "health[]");
            container.appendChild(clone);
        }
        updatePrice();
    }

    function updatePrice() {
        let participants = parseInt(participantInput.value) || 1;
        let total = pricePerPerson * participants;
        let redeem = redeemSelect ? parseInt(redeemSelect.value) || 0 : 0;
        let discount = (redeem / 100) * 5000;
        let final = total - discount;
        if (final < 0) final = 0;

        totalPriceEl.innerText = formatRupiah(total);
        displayParticipant.innerText = participants + " Orang";
        if (discountEl) discountEl.innerText = formatRupiah(discount);
        finalPriceEl.innerText = formatRupiah(final);
        finalPriceInput.value = final;
    }

    participantInput.addEventListener("input", function() {
        generateForms(this.value);
    });

    if (redeemSelect) {
        redeemSelect.addEventListener("change", updatePrice);
    }

    paymentSelect.addEventListener("change", function() {
        proofUpload.classList.add("d-none");
        if (this.value === "Transfer Bank") {
            paymentDetail.innerHTML = '<i class="fas fa-university"></i> Transfer Bank BCA - 1234567890 a.n OpenTrip Indonesia<br><small>Setelah transfer, upload bukti</small>';
            paymentDetail.classList.remove("d-none");
            proofUpload.classList.remove("d-none");
            document.getElementById("paymentProof").required = true;
        } else if (this.value === "E-Wallet") {
            paymentDetail.innerHTML = '<i class="fas fa-mobile-alt"></i> DANA / OVO / GoPay - 081234567890<br><small>Setelah pembayaran, upload bukti</small>';
            paymentDetail.classList.remove("d-none");
            proofUpload.classList.remove("d-none");
            document.getElementById("paymentProof").required = true;
        } else {
            paymentDetail.classList.add("d-none");
            document.getElementById("paymentProof").required = false;
        }
    });

    generateForms(participantInput.value);
</script>

<?= $this->endSection() ?>