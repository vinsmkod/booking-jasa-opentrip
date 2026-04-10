<?= $this->extend('layouts/main') ?> 

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/trip.css') ?>">
<?= $this->endSection() ?>
 
<?= $this->section('content') ?>


<div class="container py-3 mt-3">
    <div class="text-center mb-5" data-aos="fade-up">
        <span class="badge rounded-pill fw-semibold text-uppercase px-3 py-2 mb-3"
            style="font-size:11px;letter-spacing:.2em;background-color:rgba(196,96,58,.1);color:var(--rust);">EXPLORE</span>
        <h2 class="fw-bold" style="font-family:'Playfair Display',serif;"><?= esc($type ?? 'Semua Trip') ?></h2>
        <p class="text-muted">Temukan petualangan seru bersama BLNTRK OUTDOOR</p>
    </div>

    <div class="row g-4">
        <?php if (!empty($trips)): ?>
            <?php foreach ($trips as $i => $trip): ?>
                <?php
                $quota     = $trip['quota'] ?? 0;
                $available = $trip['available'] ?? 0;
                $booked    = $quota - $available;
                $percent   = $quota > 0 ? ($booked / $quota) * 100 : 0;

                $formattedDate = $day = $monthName = '';
                if (!empty($trip['departure_date'])) {
                    $dateObj    = new DateTime($trip['departure_date']);
                    $monthNames = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Ags',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'];
                    $monthName  = $monthNames[(int)$dateObj->format('n')];
                    $day        = $dateObj->format('d');
                    $formattedDate = $dateObj->format('d M Y');
                }

                // === TYPE TRIP (AMBIL DARI HOME) ===
                $tripType = $trip['type'] ?? 'open_trip';
                $typeConfig = [
                    'open_trip'    => ['label'=>'Open Trip',    'icon'=>'fa-users', 'bg'=>'#2d6a4f'],
                    'private_trip' => ['label'=>'Private Trip', 'icon'=>'fa-lock',  'bg'=>'#7b3f00'],
                    'one_day_trip' => ['label'=>'One Day Trip', 'icon'=>'fa-sun',   'bg'=>'#0a4f7a'],
                ];
                $tc = $typeConfig[$tripType] ?? $typeConfig['open_trip'];
                ?>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                    <div class="card border-0 rounded-3 overflow-hidden h-100 shadow-sm trip-card"
                        style="transition:all .3s;"
                        onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 4px 12px rgba(0,0,0,.1)'"
                        onmouseout="this.style.transform='';this.style.boxShadow=''">

                        <!-- IMAGE -->
                        <div class="trip-image-wrapper position-relative">
                            <?php if (!empty($trip['image'])): ?>
                                <img src="<?= base_url('uploads/trips/' . $trip['image']) ?>" class="trip-image" alt="<?= esc($trip['title']) ?>">
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/no-image.jpg') ?>" class="trip-image">
                            <?php endif; ?>

                            <!-- BADGE TYPE -->
                            <span class="badge position-absolute top-0 start-0 m-3 rounded-pill px-3 py-2 shadow-sm"
                                style="z-index:2;background-color:<?= $tc['bg'] ?>;color:#fff;font-size:11px;">
                                <i class="fas <?= $tc['icon'] ?> me-1"></i><?= $tc['label'] ?>
                            </span>

                            <!-- BADGE STATUS -->
                            <span class="badge position-absolute top-0 end-0 m-3 rounded-pill px-3 py-2 shadow-sm"
                                style="z-index:2;background-color:<?= $available > 0 ? '#2d6a4f' : '#6c757d' ?>;color:#fff;font-size:11px;">
                                <i class="fas <?= $available > 0 ? 'fa-check-circle' : 'fa-ban' ?> me-1"></i>
                                <?= $available > 0 ? 'Tersedia' : 'Full' ?>
                            </span>

                            <!-- PRICE -->
                            <div class="position-absolute bottom-0 start-0 w-100 p-3"
                                style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                                <p class="text-white fs-5 fw-bold mb-0">
                                    Rp <?= number_format($trip['price'], 0, ',', '.') ?>
                                </p>
                            </div>
                        </div>

                        <!-- BODY -->
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="fw-bold mb-3" style="font-family:'Playfair Display',serif;">
                                <?= esc($trip['title']) ?>
                            </h5>

                            <p class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt me-2" style="width:20px;color:var(--rust);"></i>
                                <?= esc($trip['location']) ?>
                            </p>

                            <p class="text-muted small mb-3">
                                <i class="fas fa-calendar-alt me-2" style="width:20px;color:var(--rust);"></i>
                                <?php if (!empty($trip['departure_date'])): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success me-2">
                                        <?= $day . ' ' . $monthName ?>
                                    </span>
                                    <span><?= $formattedDate ?></span>
                                <?php else: ?>
                                    <span>Jadwal belum tersedia</span>
                                <?php endif; ?>
                            </p>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span>Pendaftar</span>
                                    <span><?= $booked ?> / <?= $quota ?></span>
                                </div>
                                <div class="progress" style="height:6px;">
                                    <div class="progress-bar" style="width:<?= $percent ?>%;background-color:var(--rust);"></div>
                                </div>
                            </div>

                            <!-- BUTTON -->
                            <div class="mt-auto">
                                <?php if ($available == 0): ?>
                                    <button class="btn btn-secondary w-100" disabled>
                                        <i class="fas fa-ban me-2"></i>Trip Full
                                    </button>
                                <?php elseif (session()->get('isLoggedIn')): ?>
                                    <a href="<?= base_url('trips/detail/' . $trip['schedule_id']) ?>" class="btn btn-success w-100">
                                        <i class="fas fa-eye me-2"></i>Lihat Detail
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('login') ?>" class="btn btn-warning w-100">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login untuk Booking
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-mountain fa-3x text-muted mb-3"></i>
                <p class="text-muted">Tidak ada trip tersedia.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
