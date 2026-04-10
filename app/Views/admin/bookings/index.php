<?= $this->extend('layouts/admin') ?>

<?= $this->section('breadcrumb') ?><span class="crumb-active">Booking</span><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
.tabs { display:flex; gap:4px; border-bottom:1px solid var(--border); margin-bottom:20px; }
.tab-btn {
    padding:8px 16px; font-size:13px; font-weight:500; color:var(--txt3);
    background:none; border:none; border-bottom:2px solid transparent;
    margin-bottom:-1px; cursor:pointer; display:flex; align-items:center; gap:6px;
}
.tab-btn:hover { color:var(--txt2); }
.tab-btn.active { color:var(--accent); border-bottom-color:var(--accent); }
.tab-count { font-size:10px; font-family:var(--mono); background:var(--surface2); color:var(--txt3); padding:1px 6px; border-radius:8px; }
.tab-btn.active .tab-count { background:#eef2ff; color:#4338ca; }
.tab-pane { display:none; }
.tab-pane.active { display:block; }

/* DOC & PESERTA CARDS */
.bk-card { border:1px solid var(--border); border-radius:var(--radius); overflow:hidden; margin-bottom:10px; }
.bk-card-head { display:flex; align-items:center; justify-content:space-between; padding:9px 14px; background:var(--surface2); border-bottom:1px solid var(--border); font-size:12px; }
.bk-card-code { font-family:var(--mono); font-size:11.5px; font-weight:600; color:var(--accent); }
.bk-card-body { padding:10px 14px; display:flex; flex-direction:column; gap:8px; }

.doc-row { display:flex; align-items:center; gap:10px; padding:8px; border-radius:6px; border:1px solid var(--border); background:var(--bg); flex-wrap:wrap; }
.avatar-sm { width:30px; height:30px; border-radius:50%; background:#eef2ff; color:#4338ca; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:600; flex-shrink:0; }
.doc-info { flex:1; min-width:0; }
.doc-name { font-size:12.5px; font-weight:600; color:var(--txt); }
.doc-meta { font-size:11px; color:var(--txt3); margin-top:1px; }
.doc-files { display:flex; gap:5px; flex-wrap:wrap; }
.doc-btn { font-size:11px; padding:4px 9px; border:1px solid var(--border); border-radius:4px; background:var(--surface); color:var(--txt2); cursor:pointer; display:flex; align-items:center; gap:4px; }
.doc-btn.ktp   { border-color:#bfdbfe; color:#1d4ed8; background:#eff6ff; }
.doc-btn.sehat { border-color:#bbf7d0; color:#15803d; background:#f0fdf4; }
.doc-missing { font-size:11px; color:var(--txt3); font-style:italic; }

.peserta-item { display:flex; align-items:center; gap:9px; padding:7px 0; border-bottom:1px solid rgba(0,0,0,.04); }
.peserta-item:last-child { border-bottom:none; }
.peserta-num { width:20px; height:20px; border-radius:50%; background:#eef2ff; color:#4338ca; font-size:10px; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }

/* MODAL */
.img-modal { display:none; position:fixed; inset:0; background:rgba(0,0,0,.75); z-index:9999; align-items:center; justify-content:center; padding:20px; }
.img-modal.open { display:flex; }
.img-modal-box { background:#fff; border-radius:10px; padding:18px; max-width:820px; width:100%; display:flex; flex-direction:column; gap:12px; max-height:90vh; overflow:hidden; }
.img-modal-head { display:flex; align-items:center; justify-content:space-between; }
.img-modal-head span { font-size:14px; font-weight:500; color:var(--txt); }
.img-modal-close { width:28px; height:28px; border-radius:6px; border:1px solid var(--border); background:var(--bg); cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:12px; color:var(--txt2); }
.img-modal-close:hover { background:#fee2e2; color:#b91c1c; }
.img-modal-body { overflow:auto; display:flex; align-items:center; justify-content:center; }
.img-modal-body img { max-width:100%; max-height:68vh; object-fit:contain; border-radius:6px; display:block; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1>Verifikasi Booking</h1>
        <p>Kelola booking, dokumen, dan peserta trip</p>
    </div>
    <a href="<?= base_url('admin/payments') ?>" class="panel-action">
        <i class="fas fa-credit-card"></i> Semua Pembayaran
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        <button class="alert-close" onclick="this.parentElement.remove()">×</button>
    </div>
<?php endif; ?>

<!-- TABS -->
<div class="tabs">
    <button class="tab-btn active" onclick="switchTab('booking', this)">
        <i class="fas fa-list-ul"></i> Daftar Booking
        <span class="tab-count"><?= count($bookings ?? []) ?></span>
    </button>
    <button class="tab-btn" onclick="switchTab('dokumen', this)">
        <i class="fas fa-id-card"></i> Dokumen
        <span class="tab-count"><?= count($documents ?? []) ?></span>
    </button>
    <button class="tab-btn" onclick="switchTab('peserta', this)">
        <i class="fas fa-users"></i> Peserta
        <span class="tab-count"><?= count($bookings ?? []) ?></span>
    </button>
</div>

<!-- TAB: BOOKING -->
<div class="tab-pane active" id="tab-booking">
    <div class="panel">
        <div class="table-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>User</th>
                        <th>Trip</th>
                        <th>Peserta</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Bukti</th>
                        <th>Status Booking</th>
                        <th>Status Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $b): ?>
                        <tr>
                            <td class="td-code"><?= esc($b['booking_code'] ?? '-') ?></td>
                            <td>
                                <div class="td-name"><?= esc($b['username'] ?? '-') ?></div>
                                <div class="td-small"><?= esc($b['user_email'] ?? '-') ?></div>
                            </td>
                            <td>
                                <div class="td-name"><?= esc($b['trip_title'] ?? '-') ?></div>
                                <div class="td-small"><?= date('d M Y', strtotime($b['departure_date'] ?? 'now')) ?></div>
                            </td>
                            <td><?= $b['participant'] ?? 0 ?> orang</td>
                            <td class="td-price">Rp <?= number_format($b['total_price'] ?? 0, 0, ',', '.') ?></td>
                            <td>
                                <?php if (!empty($b['method'])): ?>
                                    <span class="pill pill-info"><?= esc($b['method']) ?></span>
                                <?php else: ?>
                                    <span style="color:var(--txt3);">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($b['proof'])): ?>
                                    <a href="<?= base_url('uploads/payments/' . $b['proof']) ?>" target="_blank" class="btn-sm btn-view">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                <?php else: ?>
                                    <span style="color:var(--txt3);font-size:12px;">Belum</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php $s = $b['status'] ?? ''; ?>
                                <?php if ($s === 'pending'): ?>
                                    <span class="pill pill-warning">Pending</span>
                                <?php elseif ($s === 'confirmed'): ?>
                                    <span class="pill pill-success">Confirmed</span>
                                <?php elseif ($s === 'cancelled'): ?>
                                    <span class="pill pill-danger">Cancelled</span>
                                <?php else: ?>
                                    <span class="pill pill-secondary">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php $ps = $b['payment_status'] ?? ''; ?>
                                <?php if ($ps === 'pending'): ?>
                                    <span class="pill pill-warning">Menunggu</span>
                                <?php elseif ($ps === 'verified'): ?>
                                    <span class="pill pill-success">Terverifikasi</span>
                                <?php elseif ($ps === 'rejected'): ?>
                                    <span class="pill pill-danger">Ditolak</span>
                                <?php else: ?>
                                    <span class="pill pill-secondary">Belum Ada</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($s === 'pending'): ?>
                                    <div class="btn-row">
                                        <a href="<?= base_url('admin/bookings/confirm/' . $b['booking_id']) ?>"
                                           class="btn-sm btn-confirm"
                                           onclick="return confirm('Confirm booking ini?')">
                                            <i class="fas fa-check"></i> Confirm
                                        </a>
                                        <a href="<?= base_url('admin/bookings/cancel/' . $b['booking_id']) ?>"
                                           class="btn-sm btn-cancel"
                                           onclick="return confirm('Cancel booking ini?')">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                    </div>
                                <?php elseif ($s === 'confirmed'): ?>
                                    <span style="color:#15803d;font-size:12px;"><i class="fas fa-check-circle"></i> Dikonfirmasi</span>
                                <?php elseif ($s === 'cancelled'): ?>
                                    <span style="color:var(--txt3);font-size:12px;"><i class="fas fa-ban"></i> Dibatalkan</span>
                                <?php else: ?>
                                    <span style="color:var(--txt3);">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="10">
                            <div class="empty-state">
                                <i class="fas fa-ticket-alt"></i>
                                <p>Belum ada data booking</p>
                            </div>
                        </td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- TAB: DOKUMEN -->
<div class="tab-pane" id="tab-dokumen">
    <?php if (!empty($documents)): ?>
        <?php
        $docsByBooking = [];
        foreach ($documents as $doc) {
            $bid = $doc['booking_id'];
            $docsByBooking[$bid]['booking_code'] = $doc['booking_code'] ?? '-';
            $docsByBooking[$bid]['docs'][] = $doc;
        }
        ?>
        <?php foreach ($docsByBooking as $group): ?>
        <div class="bk-card">
            <div class="bk-card-head">
                <span class="bk-card-code"><?= esc($group['booking_code']) ?></span>
                <span style="color:var(--txt3);"><?= count($group['docs']) ?> peserta</span>
            </div>
            <div class="bk-card-body">
                <?php foreach ($group['docs'] as $doc): ?>
                <div class="doc-row">
                    <div class="avatar-sm"><?= strtoupper(substr($doc['name'] ?? '-', 0, 2)) ?></div>
                    <div class="doc-info">
                        <div class="doc-name"><?= esc($doc['name']) ?></div>
                        <div class="doc-meta">
                            <?= esc($doc['gender']) ?>
                            <?php if (!empty($doc['email'])): ?>&middot; <?= esc($doc['email']) ?><?php endif; ?>
                            <?php if (!empty($doc['birthdate']) && $doc['birthdate'] !== '0000-00-00'): ?>&middot; <?= date('d M Y', strtotime($doc['birthdate'])) ?><?php endif; ?>
                        </div>
                    </div>
                    <div class="doc-files">
                        <?php if (!empty($doc['ktp'])): ?>
                            <button class="doc-btn ktp" onclick="openModal('<?= base_url('uploads/documents/' . $doc['ktp']) ?>', 'KTP — <?= esc($doc['name']) ?>')">
                                <i class="fas fa-id-card"></i> KTP
                            </button>
                        <?php else: ?>
                            <span class="doc-missing">KTP belum</span>
                        <?php endif; ?>
                        <?php if (!empty($doc['health'])): ?>
                            <button class="doc-btn sehat" onclick="openModal('<?= base_url('uploads/documents/' . $doc['health']) ?>', 'Surat Sehat — <?= esc($doc['name']) ?>')">
                                <i class="fas fa-file-medical"></i> Surat Sehat
                            </button>
                        <?php else: ?>
                            <span class="doc-missing">Surat sehat belum</span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="panel"><div style="padding:40px;">
            <div class="empty-state"><i class="fas fa-folder-open"></i><p>Belum ada dokumen.</p></div>
        </div></div>
    <?php endif; ?>
</div>

<!-- TAB: PESERTA -->
<div class="tab-pane" id="tab-peserta">
    <?php if (!empty($bookingPeserta)): ?>
        <?php foreach ($bookingPeserta as $bk): ?>
        <div class="bk-card">
            <div class="bk-card-head">
                <div>
                    <span class="bk-card-code"><?= esc($bk['booking_code']) ?></span>
                    <span style="color:var(--txt3);margin-left:8px;font-size:11px;"><?= esc($bk['trip_title'] ?? '') ?></span>
                </div>
                <div style="display:flex;align-items:center;gap:8px;">
                    <span style="color:var(--txt3);font-size:11px;"><?= count($bk['peserta']) ?> peserta</span>
                    <?php $s = $bk['status'] ?? ''; ?>
                    <span class="pill <?= $s === 'confirmed' ? 'pill-success' : ($s === 'pending' ? 'pill-warning' : 'pill-danger') ?>">
                        <?= ucfirst($s) ?>
                    </span>
                </div>
            </div>
            <div style="padding:6px 14px;">
                <?php if (!empty($bk['peserta'])): ?>
                    <?php foreach ($bk['peserta'] as $i => $p): ?>
                    <div class="peserta-item">
                        <div class="peserta-num"><?= $i + 1 ?></div>
                        <div>
                            <div style="font-size:12.5px;font-weight:600;color:var(--txt);"><?= esc($p['name']) ?></div>
                            <div style="font-size:11px;color:var(--txt3);">
                                <?= esc($p['gender']) ?>
                                <?php if (!empty($p['email'])): ?>&middot; <?= esc($p['email']) ?><?php endif; ?>
                                <?php if (!empty($p['birthdate']) && $p['birthdate'] !== '0000-00-00'): ?>&middot; <?= date('d M Y', strtotime($p['birthdate'])) ?><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="font-size:12px;color:var(--txt3);padding:10px 0;">Belum ada data peserta.</div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="panel"><div style="padding:40px;">
            <div class="empty-state"><i class="fas fa-users"></i><p>Belum ada data peserta.</p></div>
        </div></div>
    <?php endif; ?>
</div>

<!-- Modal Preview -->
<div class="img-modal" id="imgModal" onclick="closeModalOutside(event)">
    <div class="img-modal-box">
        <div class="img-modal-head">
            <span id="imgModalTitle">Dokumen</span>
            <button class="img-modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="img-modal-body">
            <img id="imgModalImg" src="" alt="Dokumen"
                 onerror="this.style.display='none';document.getElementById('imgModalErr').style.display='block'">
            <div id="imgModalErr" style="display:none;color:var(--txt3);font-size:13px;padding:40px;text-align:center;">
                Gambar tidak dapat ditampilkan.
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function switchTab(name, btn) {
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}
function openModal(src, title) {
    document.getElementById('imgModalImg').style.display = 'block';
    document.getElementById('imgModalErr').style.display = 'none';
    document.getElementById('imgModalImg').src = src;
    document.getElementById('imgModalTitle').textContent = title;
    document.getElementById('imgModal').classList.add('open');
}
function closeModal() {
    document.getElementById('imgModal').classList.remove('open');
    document.getElementById('imgModalImg').src = '';
}
function closeModalOutside(e) { if (e.target === document.getElementById('imgModal')) closeModal(); }
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
<?= $this->endSection() ?>