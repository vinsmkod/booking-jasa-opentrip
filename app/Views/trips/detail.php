<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row mt-4">

    <div class="col-md-6">

        <?php if(!empty($trip['image'])): ?>

            <img src="<?= base_url('uploads/trips/'.$trip['image']) ?>" 
                 class="img-fluid rounded"
                 alt="<?= esc($trip['title']) ?>">

        <?php else: ?>

            <img src="<?= base_url('images/no-image.jpg') ?>" 
                 class="img-fluid rounded"
                 alt="No Image">

        <?php endif; ?>

    </div>

    <div class="col-md-6">

        <h3><?= esc($trip['title']) ?></h3>

        <p><strong>Lokasi:</strong> <?= esc($trip['location']) ?></p>

        <p><?= esc($trip['description']) ?></p>

        <p>
            <strong>Harga per Peserta:</strong> 
            Rp <?= number_format($trip['price'],0,',','.') ?>
        </p>

        <p><strong>Kuota:</strong> <?= esc($trip['quota']) ?></p>

        <p>
            <strong>Tanggal Keberangkatan:</strong> 
            <?= !empty($trip['departure_date']) 
                ? date('d M Y', strtotime($trip['departure_date'])) 
                : 'Jadwal belum tersedia'; ?>
        </p>

        <?php if($trip['status'] === 'active'): ?>

            <form method="post" action="<?= base_url('booking/create') ?>">
                <?= csrf_field() ?>

                <input type="hidden" name="trip_id" value="<?= esc($trip['trip_id']) ?>">

                <button type="submit" class="btn btn-dark mt-3 w-100">
                    Booking Sekarang
                </button>
            </form>

        <?php else: ?>

            <div class="alert alert-warning mt-3">
                Trip ini sedang tidak aktif.
            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>