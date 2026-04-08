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

    .booking-container {
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
    }

    /* Cards */
    .form-card,
    .summary-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
    }

    .summary-card {
        position: sticky;
        top: 20px;
    }

    .section-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f1f5f9;
    }

    .section-title i {
        color: #2d7d3a;
        font-size: 1.25rem;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 8px;
        display: block;
    }

    .form-control,
    .form-select {
        background: white;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 14px;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        width: 100%;
        transition: all 0.2s;
        color: #0f172a;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2d7d3a;
        outline: none;
        box-shadow: 0 0 0 3px rgba(45, 125, 58, 0.1);
        background: white;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    /* Participant Card */
    .participant-card {
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        border: 1.5px solid #d1fae5;
    }

    .participant-title {
        font-weight: 700;
        color: #2d7d3a;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #d1fae5;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Participant Counter */
    .participant-counter {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .participant-counter .form-control {
        width: 100px;
        text-align: center;
        font-weight: 600;
    }

    .counter-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* Trip Info */
    .trip-info {
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .trip-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 8px;
        color: #0f172a;
    }

    .trip-meta {
        font-size: 0.85rem;
        color: #64748b;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .trip-meta i {
        color: #2d7d3a;
        width: 18px;
        margin-right: 8px;
    }

    /* Price Rows */
    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        font-size: 0.9rem;
        padding: 10px 0;
    }

    .price-label {
        color: #64748b;
        font-weight: 500;
    }

    .price-value {
        font-weight: 600;
        color: #0f172a;
    }

    .total-price {
        font-size: 0.95rem;
        font-weight: 700;
        color: #2d7d3a;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 2px solid #f1f5f9;
    }

    .final-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: #2d7d3a;
    }

    /* Button */
    .btn-submit {
        width: 100%;
        padding: 14px 16px;
        background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
        border: none;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        margin-top: 24px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(45, 125, 58, 0.3);
    }

    /* Alert */
    .alert-info {
        background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
        border-left: 4px solid #2d7d3a;
        border-radius: 8px;
        padding: 16px;
        margin: 20px 0;
        font-size: 0.85rem;
        color: #475569;
        line-height: 1.6;
    }

    .alert-info i {
        color: #2d7d3a;
        margin-right: 8px;
        font-weight: 700;
    }

    .alert-info strong {
        color: #0f172a;
        font-weight: 700;
    }

    .d-none {
        display: none;
    }

    .text-muted {
        color: #64748b !important;
    }

    .small {
        font-size: 0.8rem;
    }

    .mt-1 {
        margin-top: 4px;
    }

    .mt-3 {
        margin-top: 16px;
    }

    .mt-2 {
        margin-top: 8px;
    }

    .mb-3 {
        margin-bottom: 16px;
    }

    .mb-4 {
        margin-bottom: 20px;
    }

    .pt-2 {
        padding-top: 8px;
    }

    .row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .col-lg-5,
    .col-lg-7 {
        width: 100%;
    }

    .g-2 > * {
        margin-bottom: 0;
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        margin-bottom: 40px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }

        .summary-card {
            position: relative;
            top: 0;
            margin-top: 20px;
        }
    }

    @media (max-width: 768px) {
        .booking-container {
            padding: 20px 16px;
        }

        .form-card,
        .summary-card {
            padding: 20px;
        }

        .section-title {
            font-size: 1rem;
            margin-bottom: 16px;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .participant-card {
            padding: 16px;
        }

        .row {
            grid-template-columns: 1fr;
        }

        .alert-info {
            padding: 12px;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 480px) {
        .booking-container {
            padding: 16px 12px;
        }

        .form-card,
        .summary-card {
            padding: 16px;
        }

        .price-row {
            font-size: 0.85rem;
        }

        .final-price {
            font-size: 1.2rem;
        }
    }
</style>

<div class="booking-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <span class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></span>
        <span class="breadcrumb-item"><a href="<?= base_url('/trips') ?>">Trip</a></span>
        <span class="breadcrumb-item"><a href="<?= base_url('trips/detail/' . $schedule['schedule_id']) ?>"><?= esc($schedule['title']) ?></a></span>
        <span class="breadcrumb-item active">Booking</span>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Konfirmasi Pemesanan Trip</h1>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Left Column - Form -->
        <div>
            <!-- Detail Pemesanan -->
            <div class="form-card">
                <div class="section-title">
                    <i class="fas fa-edit"></i> Detail Pemesanan
                </div>

                <form method="post" action="<?= base_url('booking/store') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="schedule_id" value="<?= esc($schedule['schedule_id']) ?>">
                    <input type="hidden" name="final_price" id="finalPriceInput" value="<?= esc($schedule['price']) ?>">

                    <!-- Meeting Point -->
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Meeting Point</label>
                        <select name="meeting_point_id" class="form-select" required>
                            <option value="">Pilih Meeting Point</option>
                            <?php foreach ($meetingPoints as $mp): ?>
                                <option value="<?= $mp['meeting_point_id'] ?>">
                                    <?= esc($mp['name']) ?> - <?= esc($mp['address']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Jumlah Peserta -->
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-users"></i> Jumlah Peserta</label>
                        <div class="participant-counter">
                            <input type="number"
                                id="participantCount"
                                name="participant"
                                class="form-control"
                                min="1"
                                max="<?= esc($schedule['available']) ?>"
                                value="1"
                                required>
                            <span class="counter-label">Maks <?= esc($schedule['available']) ?> orang</span>
                        </div>
                    </div>

                    <!-- Participants Container -->
                    <div id="participantsContainer"></div>

                    <!-- Metode Pembayaran -->
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-credit-card"></i> Metode Pembayaran</label>
                        <select name="payment_method" id="paymentMethod" class="form-select" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="E-Wallet">E-Wallet (DANA/OVO/GoPay)</option>
                        </select>
                    </div>

                    <!-- Payment Detail -->
                    <div id="paymentDetail" class="alert-info d-none"></div>

                    <!-- Upload Bukti -->
                    <div id="proofUpload" class="form-group d-none">
                        <label class="form-label"><i class="fas fa-receipt"></i> Upload Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" id="paymentProof" class="form-control" accept="image/*,application/pdf">
                        <div class="text-muted small mt-1">📎 Format: JPG, PNG, PDF (Max 5MB)</div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-check-circle"></i> Konfirmasi Pesanan
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column - Summary -->
        <div>
            <!-- Ringkasan Trip -->
            <div class="summary-card">
                <div class="section-title">
                    <i class="fas fa-receipt"></i> Ringkasan Pesanan
                </div>

                <!-- Trip Info -->
                <div class="trip-info">
                    <div class="trip-title"><?= esc($schedule['title']) ?></div>
                    <div class="trip-meta">
                        <span><i class="fas fa-map-marker-alt"></i> <?= esc($schedule['location']) ?></span>
                        <span><i class="fas fa-calendar-alt"></i> <?= date('d F Y', strtotime($schedule['departure_date'])) ?></span>
                    </div>
                </div>

                <!-- Price Calculation -->
                <div class="price-row">
                    <span class="price-label">Harga/Peserta</span>
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

                <!-- Loyalty Points -->
                <?php
                $userPoints = session()->get('points') ?? 0;
                $maxRedeem = floor($userPoints / 100);
                ?>

                <?php if ($maxRedeem > 0): ?>
                    <div class="form-group mt-3">
                        <label class="form-label"><i class="fas fa-gift"></i> Gunakan Loyalty Point</label>
                        <select id="redeemPoint" name="redeem_point" class="form-select">
                            <option value="0">Tidak digunakan</option>
                            <?php for ($i = 1; $i <= $maxRedeem; $i++): ?>
                                <option value="<?= $i * 100 ?>">
                                    <?= $i * 100 ?> poin (Potongan Rp <?= number_format($i * 5000, 0, ',', '.') ?>)
                                </option>
                            <?php endfor; ?>
                        </select>
                        <div class="text-muted small mt-1">💰 Anda punya <?= $userPoints ?> poin</div>
                    </div>

                    <div class="price-row">
                        <span class="price-label">Potongan Harga</span>
                        <span class="price-value" id="discountPrice">Rp 0</span>
                    </div>
                <?php endif; ?>

                <!-- Final Price -->
                <div class="price-row mt-2 pt-2">
                    <span class="price-label">Total Pembayaran</span>
                    <span class="final-price" id="finalPrice">Rp <?= number_format($schedule['price'], 0, ',', '.') ?></span>
                </div>
            </div>

            <!-- Instructions -->
            <div class="alert-info mt-3">
                <strong><i class="fas fa-list-check"></i> Langkah-Langkah:</strong>
                <ol style="margin-top: 8px; padding-left: 20px;">
                    <li>Isi data peserta dengan lengkap</li>
                    <li>Pilih meeting point dan metode pembayaran</li>
                    <li>Upload bukti pembayaran</li>
                    <li>Klik "Konfirmasi Pesanan"</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Participant Template -->
<template id="participantTemplate">
    <div class="participant-card">
        <div class="participant-title peserta-title"></div>
        <div class="row">
            <div>
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control name-input" placeholder="Masukkan nama lengkap" required>
            </div>
            <div>
                <label class="form-label">Email</label>
                <input type="email" class="form-control email-input" placeholder="email@contoh.com" required>
            </div>
            <div>
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control birthdate-input" required>
            </div>
            <div>
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-select gender-input" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div>
                <label class="form-label"><i class="fas fa-id-card"></i> Upload KTP</label>
                <input type="file" class="form-control ktp-input" accept="image/*,application/pdf" required>
                <div class="text-muted small mt-1">JPG, PNG, atau PDF</div>
            </div>
            <div>
                <label class="form-label"><i class="fas fa-certificate"></i> Upload Surat Sehat</label>
                <input type="file" class="form-control health-input" accept="image/*,application/pdf" required>
                <div class="text-muted small mt-1">JPG, PNG, atau PDF</div>
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
            clone.querySelector(".peserta-title").innerText = "👤 Peserta " + (i + 1);
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
        paymentDetail.classList.add("d-none");
        if (this.value === "Transfer Bank") {
            paymentDetail.innerHTML = '<i class="fas fa-university"></i> <strong>Transfer Bank BCA</strong><br>Nomor: 1234567890 a.n OpenTrip Indonesia<br><small>Setelah transfer, upload bukti di bawah</small>';
            paymentDetail.classList.remove("d-none");
            proofUpload.classList.remove("d-none");
            document.getElementById("paymentProof").required = true;
        } else if (this.value === "E-Wallet") {
            paymentDetail.innerHTML = '<i class="fas fa-mobile-alt"></i> <strong>E-Wallet</strong><br>DANA / OVO / GoPay ke 081234567890<br><small>Setelah pembayaran, upload bukti di bawah</small>';
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