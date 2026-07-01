<?= $this->extend('layouts/admin') ?>

<?= $this->section('breadcrumb') ?><span class="crumb-active">Pengguna</span><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
.avatar {
    width: 30px; height: 30px; border-radius: 50%;
    background: #eef2ff; color: #4338ca;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 500; flex-shrink: 0;
}
.pill { font-size: 11px; padding: 2px 8px; border-radius: 20px; font-weight: 500; }
.pill-admin { background: #eef2ff; color: #4338ca; }
.pill-user  { background: #f0fdf4; color: #15803d; }

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

<div class="page-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
    <div class="page-header-left">
        <h1>Manajemen Pengguna</h1>
        <p>Kelola akun dan hak akses pengguna</p>
    </div>
    <div class="page-header-right">
        <a href="<?= base_url('admin/users/create') ?>" class="btn-primary-sm">
            <i class="fas fa-plus" style="margin-right:8px;"></i> Tambah User
        </a>
    </div>
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

<input type="text" class="search-input"
       placeholder="Cari nama, email, atau role..."
       oninput="searchUsers(this.value)"
       style="width:100%;padding:8px 12px;font-size:13px;border:1px solid var(--border);border-radius:7px;outline:none;margin-bottom:16px;font-family:var(--font);color:var(--txt);background:var(--surface);">

<div class="panel">
    <div class="panel-header">
        <span class="panel-title"><i class="fas fa-users"></i> Daftar Pengguna</span>
        <span style="font-size:12px;color:var(--txt3);font-family:var(--mono);">
            <span id="user-count"><?= isset($pager) ? $pager->getTotal('users') : count($users ?? []) ?></span> user
        </span>
    </div>
    <div class="table-wrap">
        <table class="tbl" id="tbl-users">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pengguna</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Points</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)):
                    $currentPage = isset($pager) ? $pager->getCurrentPage('users') : 1;
                    $no = 1 + (5 * ($currentPage - 1));
                    foreach ($users as $u): ?>
                    <tr>
                        <td class="td-no"><?= $no++ ?></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:9px;">
                                <div class="avatar"><?= strtoupper(substr($u['name'] ?? 'U', 0, 1)) ?></div>
                                <?= esc($u['name']) ?>
                            </div>
                        </td>
                        <td style="font-size:12.5px;color:var(--txt2);"><?= esc($u['email']) ?></td>
                        <td>
                            <?php $role = strtolower($u['role'] ?? 'user'); ?>
                            <span class="pill <?= $role === 'admin' ? 'pill-admin' : 'pill-user' ?>">
                                <?= ucfirst($role) ?>
                            </span>
                        </td>
                        <td style="font-family:var(--mono);font-size:12px;color:var(--txt2);">
                            ★ <?= number_format($u['points'] ?? 0) ?>
                        </td>
                        <td style="font-size:12.5px;color:var(--txt2);">
                            <?= !empty($u['created_at']) ? date('d M Y', strtotime($u['created_at'])) : '—' ?>
                        </td>
                        <td>
                            <div class="btn-row">
                                <a href="<?= base_url('admin/users/edit/' . $u['user_id']) ?>" class="btn-sm btn-edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/users/delete/' . $u['user_id']) ?>"
                                   class="btn-sm btn-delete"
                                   onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-users-slash"></i>
                                <p>Belum ada data pengguna</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

    <!-- Pager Links -->
    <?php if (isset($pager)): ?>
        <div style="margin-top:20px; display:flex; justify-content:center;">
            <?= $pager->links('users', 'default_full') ?>
        </div>
    <?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Search disabled: pagination is now server-side
</script>
<?= $this->endSection() ?>