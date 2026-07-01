<?= $this->extend('layouts/admin') ?>
<?= $this->section('styles') ?>
<style>
.tbl { min-width:800px; }
.comment-text {
    font-size:12.5px;
    color:var(--txt2);
    line-height:1.6;
    max-width:280px;
    display:-webkit-box;
    -webkit-line-clamp:3;
    -webkit-box-orient:vertical;
    overflow:hidden;
}
.trip-tag {
    display:inline-flex;
    align-items:center;
    gap:5px;
    font-size:11px;
    font-weight:500;
    background:#eff6ff;
    color:#1d4ed8;
    border:1px solid #bfdbfe;
    padding:3px 9px;
    border-radius:4px;
    max-width:180px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}
.tbl td { vertical-align:top; }

/* PAGINATION */
.pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
    margin: 0;
    gap: 5px;
}

.pagination li {
    margin: 0;
}

.pagination li a, .pagination li span {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 500;
    color: var(--txt2);
    background-color: var(--surface);
    border: 1px solid var(--border);
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s;
    min-width: 32px;
}

.pagination li a:hover {
    background-color: #f1f5f9;
    border-color: #cbd5e1;
    color: var(--txt);
}

.pagination li.active a, .pagination li.active span {
    background-color: var(--accent);
    color: white;
    border-color: var(--accent);
}

.pagination li.disabled a, .pagination li.disabled span {
    color: var(--txt3);
    background-color: var(--surface2);
    pointer-events: none;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="page-header-left">
        <h1>Moderasi Komentar</h1>
        <p>Review dan kelola komentar dari pengguna</p>
    </div>
</div>

<div class="panel">
    <div class="panel-header">
        <span class="panel-title"><i class="fas fa-comments"></i> Daftar Komentar</span>
        <span style="font-size:12px;color:var(--txt3);font-family:var(--mono);"><?= isset($pager) ? $pager->getTotal('comments') : count($comments ?? []) ?> total</span>
    </div>
    <div class="table-wrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Trip</th>
                    <th>Komentar</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($comments)):
                    $currentPage = isset($pager) ? $pager->getCurrentPage('comments') : 1;
                    $no = 1 + (5 * ($currentPage - 1));
                    foreach ($comments as $c): $s = $c['status'] ?? 'pending'; ?>
                <tr>
                    <td class="td-no"><?= $no++ ?></td>
                    <td>
                        <div class="td-name"><?= esc($c['name']) ?></div>
                        <div class="td-small"><?= esc($c['email']) ?></div>
                    </td>
                    <td>
                        <span class="trip-tag">
                            <i class="fas fa-map-pin" style="font-size:9px;"></i> <?= esc($c['title']) ?>
                        </span>
                    </td>
                    <td><div class="comment-text"><?= esc($c['comment']) ?></div></td>
                    <td>
                        <?php if ($s === 'approved'): ?>
                            <span class="pill pill-success"><i class="fas fa-check"></i> Approved</span>
                        <?php elseif ($s === 'rejected'): ?>
                            <span class="pill pill-danger"><i class="fas fa-times"></i> Rejected</span>
                        <?php else: ?>
                            <span class="pill pill-success"><i class="fas fa-clock"></i> Pending</span>
                        <?php endif; ?>
                    </td>
                    <td class="td-date"><?= date('d M Y', strtotime($c['created_at'])) ?></td>
                    <td>
                        <div class="btn-row">
                            <?php if ($s === 'pending'): ?>
                                <a href="/admin/comments/approve/<?= $c['comment_id'] ?>" class="btn-sm btn-approve"><i class="fas fa-check"></i> Approve</a>
                                <a href="/admin/comments/reject/<?= $c['comment_id'] ?>" class="btn-sm btn-reject"><i class="fas fa-ban"></i> Reject</a>
                            <?php endif; ?>
                            <a href="/admin/comments/delete/<?= $c['comment_id'] ?>" onclick="return confirm('Hapus?')" class="btn-sm btn-delete"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach;
else: ?>
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-comment-slash"></i>
                            <p>Belum ada komentar</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div></div>

    <!-- Pager Links -->
    <?php if (isset($pager)): ?>
        <div style="margin-top:20px; display:flex; justify-content:center;">
            <?= $pager->links('comments', 'default_full') ?>
        </div>
    <?php endif; ?>
<?= $this->endSection() ?>
