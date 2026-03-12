<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <h3 class="mb-4 fw-bold">Riwayat Booking Saya</h3>

    <?php if(empty($bookings)): ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> Belum ada booking yang dilakukan.
        </div>
    <?php else: ?>
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>Kode Booking</th>
                        <th>Trip</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Jumlah Peserta</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bookings as $b): ?>
                        <tr class="align-middle text-center">
                            <td><?= esc($b['booking_code']) ?></td>
                            <td><?= esc($b['trip_title']) ?></td>
                            <td><?= date('d M Y', strtotime($b['departure_date'])) ?></td>
                            <td><?= esc($b['participant']) ?></td>
                            <td>Rp <?= number_format($b['total_price'],0,',','.') ?></td>
                            <td>
                                <?php
                                    switch($b['status']){
                                        case 'pending':
                                            $badge = 'warning text-dark';
                                            $text  = 'Pending';
                                            break;
                                        case 'paid':
                                            $badge = 'success';
                                            $text  = 'Paid';
                                            break;
                                        case 'confirmed':
                                            $badge = 'primary';
                                            $text  = 'Confirmed';
                                            break;
                                        case 'cancelled':
                                            $badge = 'danger';
                                            $text  = 'Cancelled';
                                            break;
                                        default:
                                            $badge = 'secondary';
                                            $text  = esc($b['status']);
                                    }
                                ?>
                                <span class="badge bg-<?= $badge ?>"><?= $text ?></span>
                            </td>
                            <td class="d-flex justify-content-center gap-1">
                                <a href="/booking/detail/<?= esc($b['booking_id']) ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <?php if($b['status'] === 'pending'): ?>
                                    <a href="/payment/<?= esc($b['booking_id']) ?>" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-cash-stack"></i> Bayar
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>