<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
.metrics {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 20px;
}

.search-bar {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 14px 18px;
    margin-bottom: 16px;
    display: flex;
    gap: 10px;
    align-items: center;
}

.search-input-wrap {
    flex: 1;
    position: relative;
}

.search-input-wrap i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--txt3);
    font-size: 13px;
}

.search-input {
    width: 100%;
    padding: 8px 12px 8px 36px;
    border: 1px solid var(--border);
    border-radius: 6px;
    font-size: 13px;
    background: var(--bg);
    color: var(--txt);
    outline: none;
}

.search-input:focus {
    border-color: var(--border2);
    background: var(--surface);
}

.btn-search {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 18px;
    border-radius: 6px;
    background: var(--accent);
    color: #fff;
    border: none;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
}

.tbl {
    min-width: 700px;
}

.img-thumb {
    width: 56px;
    height: 56px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid var(--border);
    display: block;
    transition: transform 0.15s;
}

.img-thumb:hover {
    transform: scale(1.08);
}

.album-tag {
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
}

.pagination-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 18px;
    border-top: 1px solid var(--border);
    background: var(--surface2);
}

.pagination-info {
    font-size: 12px;
    color: var(--txt3);
    font-family: var(--mono);
}

@media (max-width: 768px) {
    .metrics {
        grid-template-columns: 1fr 1fr;
    }
}

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
        <h1>Kelola Galeri</h1>
        <p>Kelola foto dan album galeri trip</p>
    </div>
    <div class="page-header-right">
        <a href="<?= base_url('admin/gallery/albums') ?>" class="btn-outline-sm"><i class="fas fa-folder-open"></i> Lihat Album</a>
        <a href="<?= base_url('admin/gallery/create') ?>" class="btn-primary-sm"><i class="fas fa-plus"></i> Tambah Foto</a>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
    <button class="alert-close" onclick="this.parentElement.remove()">×</button>
</div>
<?php endif; ?>

<div class="metrics">
    <div class="metric">
        <div class="metric-icon-wrap" style="background:#eff6ff;"><i class="fas fa-images" style="color:#1d4ed8;"></i></div>
        <div class="metric-body">
            <div class="metric-label">Total Foto</div>
            <div class="metric-value"><?= $totalPhotos ?? 0 ?></div>
            <div class="metric-sub">Seluruh foto</div>
        </div>
    </div>
    <div class="metric">
        <div class="metric-icon-wrap" style="background:#f0fdf4;"><i class="fas fa-folder-open" style="color:#16a34a;"></i></div>
        <div class="metric-body">
            <div class="metric-label">Total Album</div>
            <div class="metric-value"><?= $totalAlbums ?? 0 ?></div>
            <div class="metric-sub">Album tersedia</div>
        </div>
    </div>
    <div class="metric">
        <div class="metric-icon-wrap" style="background:#fefce8;"><i class="fas fa-camera" style="color:#b45309;"></i></div>
        <div class="metric-body">
            <div class="metric-label">Halaman Ini</div>
            <div class="metric-value"><?= count($galleries ?? []) ?></div>
        </div>
    </div>
</div>

<form method="get">
    <div class="search-bar">
        <div class="search-input-wrap">
            <i class="fas fa-search"></i>
            <input type="text" name="keyword" class="search-input" placeholder="Cari judul foto..." value="<?= esc($keyword ?? '') ?>">
        </div>
        <?php if (!empty($keyword)): ?>
            <a href="<?= base_url('admin/gallery') ?>" style="font-size:12px;color:var(--txt3);text-decoration:none;">
                <i class="fas fa-times-circle"></i> Reset
            </a>
        <?php endif; ?>
        <button type="submit" class="btn-search"><i class="fas fa-search"></i> Cari</button>
    </div>
</form>

<div class="panel">
    <div class="panel-header">
        <span class="panel-title"><i class="fas fa-images"></i> Daftar Foto</span>
        <span style="font-size:12px;color:var(--txt3);font-family:var(--mono);"><?= count($galleries ?? []) ?> foto</span>
    </div>
    <div class="table-wrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Judul</th>
                    <th>Album</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if (!empty($galleries)): 
                    $currentPage = isset($pager) ? $pager->getCurrentPage() : 1;
                    $no = 1 + (12 * ($currentPage - 1));
                    foreach ($galleries as $g): 
                ?>
                <tr>
                    <td class="td-no"><?= $no++ ?></td>
                    <td><img src="<?= base_url('uploads/gallery/' . $g['image']) ?>" alt="<?= esc($g['title']) ?>" class="img-thumb"></td>
                    <td><div class="td-name"><?= esc($g['title']) ?></div></td>
                    <td><span class="album-tag"><i class="fas fa-folder" style="font-size:9px;"></i> <?= esc($g['album'] ?? 'Tanpa Album') ?></span></td>
                    <td class="td-date"><?= date('d M Y', strtotime($g['created_at'])) ?></td>
                    <td>
                        <div class="btn-row">
                            <a href="<?= base_url('admin/gallery/edit/'.$g['gallery_id']) ?>" class="btn-sm btn-edit"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <a href="<?= base_url('admin/gallery/delete/'.$g['gallery_id']) ?>" onclick="return confirm('Hapus foto ini?')" class="btn-sm btn-delete"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="6">
                        <div class="empty-state"><i class="fas fa-images"></i><p>Belum ada foto</p></div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($galleries) && isset($pager)): ?>
    <div class="pagination-wrap">
        <div class="pagination-info">Menampilkan <?= count($galleries) ?> dari <?= $pager->getTotal() ?> foto</div>
        <div><?= $pager->links('default', 'default_full') ?></div>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
