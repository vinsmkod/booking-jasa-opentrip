<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
    /* Page Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 32px;
        padding-bottom: 24px;
        border-bottom: 2px solid #e5e7eb;
        gap: 24px;
    }

    .page-header-left {
        flex: 1;
    }

    .page-header-left h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .page-header-left p {
        font-size: 14px;
        color: #6b7280;
    }

    .page-header-right {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background: #1a1a2e;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(26, 26, 46, 0.15);
        white-space: nowrap;
    }

    .btn-primary:hover {
        background: #2d2d4e;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(26, 26, 46, 0.25);
        color: white;
        text-decoration: none;
    }

    .btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(26, 26, 46, 0.15);
    }

    .btn-primary i {
        font-size: 14px;
    }

    /* Table Styles */
    .tbl {
        min-width: 800px;
    }

    .activity-text {
        font-size: 13px;
        color: var(--txt2);
        line-height: 1.6;
        max-width: 300px;
    }

    .trip-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 500;
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
        padding: 3px 9px;
        border-radius: 4px;
        max-width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .time-badge {
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
        padding: 4px 10px;
        border-radius: 4px;
    }

    .tbl td {
        vertical-align: top;
    }

    .btn-row {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .btn-sm {
        font-size: 12px;
        padding: 5px 12px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
        border-radius: 4px;
        transition: all .2s ease;
    }

    .btn-edit {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fcd34d;
    }

    .btn-edit:hover {
        background: #fde68a;
        color: #78350f;
    }

    .btn-delete {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
    }

    .btn-delete:hover {
        background: #fecaca;
        color: #7f1d1d;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-header-right {
            width: 100%;
        }

        .btn-primary {
            flex: 1;
            justify-content: center;
        }
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="page-header-left">
        <h1>Kelola Itinerary Trip</h1>
        <p>Mengatur jadwal kegiatan dalam trip</p>
    </div>
    <div class="page-header-right">
        <a href="<?= base_url('admin/itinerary/create') ?>" class="btn-primary">
            <i class="fas fa-plus"></i> Tambah Itinerary
        </a>
    </div>
</div>

<div class="panel">
    <div class="panel-header">
        <span class="panel-title"><i class="fas fa-list-ul"></i> Daftar Itinerary</span>
        <span style="font-size:12px;color:var(--txt3);font-family:var(--mono);"><?= count($itinerary ?? []) ?> total</span>
    </div>
    <div class="table-wrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Trip</th>
                    <th>Waktu</th>
                    <th>Kegiatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($itinerary)): $no = 1;
                    foreach ($itinerary as $item): ?>
                        <tr>
                            <td class="td-no"><?= $no++ ?></td>
                            <td>
                                <span class="trip-tag">
                                    <i class="fas fa-mountain" style="font-size:9px;"></i> <?= esc($item['trip_title']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="time-badge">
                                    <i class="fas fa-clock" style="font-size:9px;"></i> <?= esc($item['time']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="activity-text"><?= esc($item['activity']) ?></div>
                            </td>
                            <td>
                                <div class="btn-row">
                                    <a href="<?= base_url('admin/itinerary/edit/' . $item['itinerary_id']) ?>" class="btn-sm btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?= base_url('admin/itinerary/delete/' . $item['itinerary_id']) ?>" onclick="return confirm('Hapus itinerary ini?')" class="btn-sm btn-delete"><i class="fas fa-trash"></i> Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;
                else: ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada itinerary</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>