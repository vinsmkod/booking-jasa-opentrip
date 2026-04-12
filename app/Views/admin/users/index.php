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
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-header" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
    <div class="page-header-left">
        <h1>Manajemen Pengguna</h1>
        <p>Kelola akun dan hak akses pengguna</p>
    </div>
    <div class="page-header-right">
        <a href="<?= base_url('admin/users/create') ?>" style="padding:8px 16px; background:var(--accent); color:#fff; border:none; border-radius:6px; text-decoration:none; display:flex; align-items:center; font-size:13px;">
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
            <span id="user-count"><?= count($users ?? []) ?></span> user
        </span>
    </div>
    <div class="table-wrap">
        <table class="tbl" id="tbl-users">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Points</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                    <tr>
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
                                <a href="<?= base_url('admin/users/edit/' . $u['user_id']) ?>" class="btn-sm btn-view">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/users/delete/' . $u['user_id']) ?>"
                                   class="btn-sm btn-cancel"
                                   onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">
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

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function searchUsers(q) {
    q = q.toLowerCase();
    const rows = document.querySelectorAll('#tbl-users tbody tr');
    let count = 0;
    rows.forEach(row => {
        const match = row.textContent.toLowerCase().includes(q);
        row.style.display = match ? '' : 'none';
        if (match) count++;
    });
    document.getElementById('user-count').textContent = count;
}
</script>
<?= $this->endSection() ?>