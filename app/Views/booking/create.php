<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/booking/create.css') ?>">
<?= $this->endSection() ?>
 
<?= $this->section('content') ?>


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
    const finalPriceEl = document.getElementById("finalPrice");
    const finalPriceInput = document.getElementById("finalPriceInput");
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

        totalPriceEl.innerText = formatRupiah(total);
        displayParticipant.innerText = participants + " Orang";
        finalPriceEl.innerText = formatRupiah(total);
        finalPriceInput.value = total;
    }

    participantInput.addEventListener("input", function() {
        generateForms(this.value);
    });

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