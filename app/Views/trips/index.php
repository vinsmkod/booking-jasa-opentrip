<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <h2 class="mb-4 text-center"><?= esc($type) ?></h2>

    <div class="row g-4">

        <?php if (!empty($trips)): ?>
            <?php foreach ($trips as $trip): ?>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">

                        <?php if (!empty($trip['image'])): ?>
                            <img src="<?= base_url('uploads/trips/' . $trip['image']) ?>"
                                class="card-img-top"
                                alt="<?= esc($trip['title']) ?>"
                                style="height:200px;object-fit:cover;">
                        <?php else: ?>
                            <img src="<?= base_url('assets/images/no-image.jpg') ?>"
                                class="card-img-top"
                                style="height:200px;object-fit:cover;">
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title"><?= esc($trip['title']) ?></h5>

                            <p class="text-muted mb-1">
                                📍 <?= esc($trip['location']) ?>
                            </p>

                            <p class="mb-1">
                                📅 <?= !empty($trip['departure_date'])
                                        ? date('d M Y', strtotime($trip['departure_date']))
                                        : 'Jadwal belum tersedia' ?>
                            </p>

                            <p class="fw-bold text-success mb-1">
                                Rp <?= number_format($trip['price'], 0, ',', '.') ?>
                            </p>

                            <p class="text-muted mb-3">
                                Kuota: <?= !empty($trip['quota']) ? esc($trip['quota']) : '-' ?> orang
                            </p>

                            <div class="mt-auto">
                                <?php if (!empty($trip['schedule_id'])): ?>
                                    <a href="<?= base_url('trips/detail/' . $trip['schedule_id']) ?>"
                                        class="btn btn-success w-100">
                                        Lihat Detail
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-secondary w-100" disabled>
                                        Jadwal Belum Tersedia
                                    </button>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center text-muted">
                Belum ada trip tersedia.
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>