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
                        <div class="text-danger small mt-1" id="paymentProofError" style="display:none;"></div>
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
                <label class="form-label">No. WA Aktif</label>
                <input type="tel" class="form-control email-input" placeholder="08xxxxxxxxxx" required>
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
                <label class="form-label label-ktp"><i class="fas fa-id-card"></i> Upload KTP</label>
                <input type="file" class="form-control ktp-input" accept="image/*,application/pdf" required>
                <div class="text-muted small mt-1">JPG, PNG, atau PDF</div>
                <div class="text-danger small mt-1 ktp-error" style="display:none;"></div>
            </div>
            <div class="parent-permission-container d-none">
                <label class="form-label"><i class="fas fa-file-signature"></i> Upload Surat Izin Orang Tua</label>
                <input type="file" class="form-control parent-permission-input" accept="image/*,application/pdf">
                <div class="text-muted small mt-1">JPG, PNG, atau PDF</div>
                <div class="text-danger small mt-1 parent-permission-error" style="display:none;"></div>
            </div>
            <div>
                <label class="form-label"><i class="fas fa-certificate"></i> Upload Surat Sehat</label>
                <input type="file" class="form-control health-input" accept="image/*,application/pdf" required>
                <div class="text-muted small mt-1">JPG, PNG, atau PDF</div>
                <div class="text-danger small mt-1 health-error" style="display:none;"></div>
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

    function setupFileValidation(inputEl, errorEl, maxMb = 2) {
        inputEl.addEventListener("change", function() {
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            if (this.files.length > 0) {
                const file = this.files[0];
                if (!allowedExtensions.exec(file.name)) {
                    errorEl.textContent = "Format file tidak valid. Harap upload file JPG, JPEG, PNG, atau PDF.";
                    errorEl.style.display = "block";
                    this.value = ""; // clear selected file
                    return;
                }
                if (file.size > maxMb * 1024 * 1024) {
                    errorEl.textContent = `Ukuran file terlalu besar. Maksimal ${maxMb}MB.`;
                    errorEl.style.display = "block";
                    this.value = ""; // clear selected file
                    return;
                }
            }
            errorEl.style.display = "none";
            errorEl.textContent = "";
        });
    }

    function generateForms(count) {
        container.innerHTML = "";
        for (let i = 0; i < count; i++) {
            const clone = template.content.cloneNode(true);
            clone.querySelector(".peserta-title").innerText = "👤 Peserta " + (i + 1);
            clone.querySelector(".name-input").setAttribute("name", `participants[${i}][name]`);
            clone.querySelector(".email-input").setAttribute("name", `participants[${i}][wa_number]`);
            
            const birthdateInput = clone.querySelector(".birthdate-input");
            birthdateInput.setAttribute("name", `participants[${i}][birthdate]`);
            
            clone.querySelector(".gender-input").setAttribute("name", `participants[${i}][gender]`);
            clone.querySelector(".ktp-input").setAttribute("name", `ktp[${i}]`);
            clone.querySelector(".health-input").setAttribute("name", `health[${i}]`);
            clone.querySelector(".parent-permission-input").setAttribute("name", `parent_permission[${i}]`);

            // Setup file inputs validation
            const ktpInput = clone.querySelector(".ktp-input");
            const healthInput = clone.querySelector(".health-input");
            const parentInput = clone.querySelector(".parent-permission-input");

            const ktpError = clone.querySelector(".ktp-error");
            const healthError = clone.querySelector(".health-error");
            const parentError = clone.querySelector(".parent-permission-error");

            setupFileValidation(ktpInput, ktpError, 2);
            setupFileValidation(healthInput, healthError, 2);
            setupFileValidation(parentInput, parentError, 2);

            // Dynamically manage fields based on birthdate
            const ktpLabel = clone.querySelector(".label-ktp");
            const parentContainer = clone.querySelector(".parent-permission-container");

            birthdateInput.addEventListener("change", function() {
                if (!this.value) {
                    ktpLabel.innerHTML = '<i class="fas fa-id-card"></i> Upload KTP';
                    parentContainer.classList.add("d-none");
                    parentInput.required = false;
                    parentInput.value = "";
                    parentError.style.display = "none";
                    parentError.textContent = "";
                    return;
                }
                const birthDate = new Date(this.value);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                if (age < 18) {
                    ktpLabel.innerHTML = '<i class="fas fa-id-card"></i> Upload Kartu Pelajar';
                    parentContainer.classList.remove("d-none");
                    parentInput.required = true;
                } else {
                    ktpLabel.innerHTML = '<i class="fas fa-id-card"></i> Upload KTP';
                    parentContainer.classList.add("d-none");
                    parentInput.required = false;
                    parentInput.value = "";
                    parentError.style.display = "none";
                    parentError.textContent = "";
                }
            });

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

    const paymentProof = document.getElementById("paymentProof");
    const paymentProofError = document.getElementById("paymentProofError");

    paymentProof.addEventListener("change", function() {
        const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
        if (this.files.length > 0) {
            const file = this.files[0];
            if (!allowedExtensions.exec(file.name)) {
                paymentProofError.textContent = "Format file tidak valid. Harap upload file JPG, JPEG, PNG, atau PDF.";
                paymentProofError.style.display = "block";
                this.value = "";
                return;
            }
            if (file.size > 5 * 1024 * 1024) { // 5MB limit
                paymentProofError.textContent = "Ukuran file terlalu besar. Maksimal 5MB.";
                paymentProofError.style.display = "block";
                this.value = "";
                return;
            }
        }
        paymentProofError.style.display = "none";
        paymentProofError.textContent = "";
    });

    paymentSelect.addEventListener("change", function() {
        proofUpload.classList.add("d-none");
        paymentDetail.classList.add("d-none");
        if (this.value === "Transfer Bank") {
            paymentDetail.innerHTML = '<i class="fas fa-university"></i> <strong>Transfer Bank BCA</strong><br>Nomor: 1234567890 a.n OpenTrip Indonesia<br><small>Setelah transfer, upload bukti di bawah</small>';
            paymentDetail.classList.remove("d-none");
            proofUpload.classList.remove("d-none");
            paymentProof.required = true;
        } else if (this.value === "E-Wallet") {
            paymentDetail.innerHTML = '<i class="fas fa-mobile-alt"></i> <strong>E-Wallet</strong><br>DANA / OVO / GoPay ke 081234567890<br><small>Setelah pembayaran, upload bukti di bawah</small>';
            paymentDetail.classList.remove("d-none");
            proofUpload.classList.remove("d-none");
            paymentProof.required = true;
        } else {
            paymentDetail.classList.add("d-none");
            paymentProof.required = false;
        }
    });

    generateForms(participantInput.value);
</script>

<?= $this->endSection() ?>