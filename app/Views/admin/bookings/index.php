<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Verifikasi Booking</h3>
            <p class="text-muted mb-0">Kelola dan verifikasi booking peserta</p>
        </div>
        <div>
            <a href="<?= base_url('admin/payments') ?>" class="btn btn-outline-primary">
                <i class="fas fa-credit-card"></i> Lihat Semua Pembayaran
            </a>
        </div>
    </div>

    <!-- Notifikasi -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>User</th>
                        <th>Trip</th>
                        <th>Peserta</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Bukti</th>
                        <th>Status Booking</th>
                        <th>Status Pembayaran</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td>
                                    <span class="fw-bold"><?= esc($booking['booking_code'] ?? '-') ?></span>
                                </td>
                                <td>
                                    <strong><?= esc($booking['username'] ?? '-') ?></strong>
                                    <br>
                                    <small class="text-muted"><?= esc($booking['user_email'] ?? '-') ?></small>
                                </td>
                                <td>
                                    <strong><?= esc($booking['trip_title'] ?? '-') ?></strong>
                                    <br>
                                    <small class="text-muted"><?= date('d M Y', strtotime($booking['departure_date'] ?? 'now')) ?></small>
                                </td>
                                <td><?= esc($booking['participant'] ?? 0) ?> Orang</td>
                                <td class="text-success fw-bold">
                                    Rp <?= number_format($booking['total_price'] ?? 0, 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?php if (!empty($booking['method'])): ?>
                                        <span class="badge bg-info"><?= esc($booking['method']) ?></span>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($booking['proof'])): ?>
                                        <a href="<?= base_url('uploads/payments/' . $booking['proof']) ?>"
                                            target="_blank"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Lihat Bukti
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">
                                            <i class="fas fa-clock"></i> Belum Upload
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (($booking['status'] ?? '') == 'pending'): ?>
                                        <span class="badge bg-warning">Pending</span>
                                    <?php elseif (($booking['status'] ?? '') == 'confirmed'): ?>
                                        <span class="badge bg-success">Confirmed</span>
                                    <?php elseif (($booking['status'] ?? '') == 'cancelled'): ?>
                                        <span class="badge bg-danger">Cancelled</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Unknown</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (($booking['payment_status'] ?? '') == 'pending'): ?>
                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                    <?php elseif (($booking['payment_status'] ?? '') == 'verified'): ?>
                                        <span class="badge bg-success">Terverifikasi</span>
                                    <?php elseif (($booking['payment_status'] ?? '') == 'rejected'): ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Belum Ada</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (($booking['status'] ?? '') == 'pending'): ?>
                                        <div class="d-flex gap-1">
                                            <a href="<?= base_url('admin/bookings/confirm/' . $booking['booking_id']) ?>"
                                                class="btn btn-sm btn-success"
                                                onclick="return confirm('Confirm booking ini? Booking akan dikonfirmasi dan poin loyalty akan diberikan.')">
                                                <i class="fas fa-check"></i> Confirm
                                            </a>
                                            <a href="<?= base_url('admin/bookings/cancel/' . $booking['booking_id']) ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Cancel booking ini?')">
                                                <i class="fas fa-times"></i> Cancel
                                            </a>
                                        </div>
                                    <?php elseif (($booking['status'] ?? '') == 'confirmed'): ?>
                                        <span class="text-success fw-bold">
                                            <i class="fas fa-check-circle"></i> Telah Dikonfirmasi
                                        </span>
                                    <?php elseif (($booking['status'] ?? '') == 'cancelled'): ?>
                                        <span class="text-muted small">
                                            <i class="fas fa-ban"></i> Dibatalkan
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center text-muted py-5">
                                <i class="fas fa-ticket-alt fa-3x mb-3 d-block"></i>
                                Belum ada data booking
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?= $this->endSection() ?>