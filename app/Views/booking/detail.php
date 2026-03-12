<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <h4 class="mb-4">Detail Booking</h4>

    <!-- ALERT -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- BOOKING INFO -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">

            <p>
                <strong>Kode Booking:</strong>
                <?= esc($booking['booking_code']) ?>
            </p>

            <p>
                <strong>Status:</strong>

                <?php if($booking['status'] === 'pending'): ?>

                    <span class="badge bg-warning text-dark">
                        Pending
                    </span>

                <?php elseif($booking['status'] === 'confirmed'): ?>

                    <span class="badge bg-success">
                        Confirmed
                    </span>

                <?php elseif($booking['status'] === 'cancelled'): ?>

                    <span class="badge bg-danger">
                        Cancelled
                    </span>

                <?php else: ?>

                    <span class="badge bg-secondary">
                        <?= esc($booking['status']) ?>
                    </span>

                <?php endif; ?>
            </p>

            <p>
                <strong>Jumlah Peserta:</strong>
                <?= esc($booking['participant']) ?>
            </p>

            <p>
                <strong>Total Harga:</strong>
                Rp <?= number_format($booking['total_price'],0,',','.') ?>
            </p>

            <p>
                <strong>Trip:</strong>

                <?= isset($trip['title']) ? esc($trip['title']) : '-' ?>
                (<?= isset($trip['location']) ? esc($trip['location']) : '-' ?>)

            </p>

            <p>
                <strong>Tanggal Keberangkatan:</strong>

                <?php if(isset($schedule['departure_date'])): ?>

                    <?= date('d M Y', strtotime($schedule['departure_date'])) ?>

                <?php else: ?>

                    -

                <?php endif; ?>

            </p>

            <p>
                <strong>Dokumen:</strong>

                <?php if(!empty($booking['document'])): ?>

                    <a href="<?= base_url('uploads/'.$booking['document']) ?>" target="_blank">
                        Lihat Dokumen
                    </a>

                <?php else: ?>

                    <span class="text-muted">Belum diupload</span>

                <?php endif; ?>

            </p>

        </div>
    </div>

    <!-- UPLOAD DOCUMENT -->
    <?php if ($booking['status'] === 'pending'): ?>


    <?php endif; ?>

    <hr>

    <!-- ACTION BUTTON -->
    <div class="d-flex gap-2 flex-wrap">

    <!-- INVOICE -->
    <a href="<?= base_url('invoice/'.$booking['booking_id']) ?>"
       class="btn btn-secondary">

       Download Invoice

    </a>

    <!-- QR TICKET -->
    <?php if ($booking['status'] === 'confirmed'): ?>

        <a href="<?= base_url('ticket/qr/'.$booking['booking_id']) ?>"
           class="btn btn-dark">

           QR Ticket

        </a>

    <?php endif; ?>

</div>

    </div>

</div>

<?= $this->endSection() ?>