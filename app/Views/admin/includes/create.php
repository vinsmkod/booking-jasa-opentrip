<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<style>
.form-container {
    max-width: 700px;
    margin: 0 auto;
}

.panel-body {
    padding: 24px;
}

.form-group-row {
    margin-bottom: 24px;
}

.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 8px;
    display: block;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control {
    width: 100%;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 10px 14px;
    font-size: 13px;
    transition: all 0.2s ease;
    background: white;
    font-family: inherit;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #2d7d3a;
    box-shadow: 0 0 0 3px rgba(45, 125, 58, 0.1);
    outline: none;
}

.form-control::placeholder {
    color: #9ca3af;
    font-size: 12px;
}

/* Include Items */
.include-list {
    background: #f9fafb;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 24px;
    border: 1px solid #e5e7eb;
}

.include-item {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 16px;
    margin-bottom: 12px;
    display: flex;
    gap: 12px;
    align-items: flex-end;
}

.include-item:last-child {
    margin-bottom: 0;
}

.include-item > div {
    flex: 1;
}

.include-item label {
    font-size: 12px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    margin-bottom: 4px;
    display: block;
}

.include-item input {
    margin: 0;
}

.btn-remove {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
    padding: 8px 14px;
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
    text-decoration: none;
    white-space: nowrap;
}

.btn-remove:hover {
    background: #fecaca;
    color: #7f1d1d;
}

.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 30px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-submit {
    background: linear-gradient(135deg, #2d7d3a, #1f5a29);
    color: white;
    padding: 10px 32px;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(45, 125, 58, 0.3);
    color: white;
}

.btn-cancel {
    background: #f3f4f6;
    color: #4b5563;
    padding: 10px 32px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-cancel:hover {
    background: #e5e7eb;
    color: #1f2937;
}

.btn-add-row {
    background: #dbeafe;
    color: #1d4ed8;
    border: 1px solid #93c5fd;
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
}

.btn-add-row:hover {
    background: #bfdbfe;
    color: #1e40af;
}

.help-text {
    font-size: 12px;
    color: #6b7280;
    margin-top: 6px;
}

.empty-state {
    text-align: center;
    color: #9ca3af;
    padding: 20px;
    font-size: 13px;
}
</style>

<div class="page-header">
    <div class="page-header-left">
        <h1>Tambah Paket Include</h1>
        <p>Tambahkan banyak paket include untuk satu trip</p>
    </div>
</div>

<div class="form-container">
    <div class="panel">
        <div class="panel-header">
            <span class="panel-title"><i class="fas fa-plus-circle"></i> Form Tambah Include</span>
        </div>

        <div class="panel-body">
            <form action="<?= base_url('admin/includes/store-batch') ?>" method="post" class="form">
                <?= csrf_field() ?>

                <!-- Trip Selection -->
                <div class="form-group-row">
                    <label class="form-label">
                        <i class="fas fa-mountain" style="margin-right:6px;color:#2d7d3a;"></i>Pilih Trip
                    </label>
                    <select name="trip_id" id="tripSelect" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Trip --</option>
                        <?php foreach($trips as $trip): ?>
                        <option value="<?= $trip['trip_id'] ?>">
                            <?= esc($trip['title']) ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                    <div class="help-text">Pilih trip yang akan ditambahkan paket includenya</div>
                </div>

                <!-- Include Items -->
                <div class="form-group-row">
                    <label class="form-label">
                        <i class="fas fa-box" style="margin-right:6px;color:#2d7d3a;"></i>Paket Include
                    </label>
                    
                    <div class="include-list" id="includeContainer">
                        <div class="empty-state" id="emptyState">
                            Klik "Tambah Baris" untuk menambahkan paket include
                        </div>
                    </div>

                    <button type="button" class="btn-add-row" onclick="addIncludeRow()">
                        <i class="fas fa-plus"></i> Tambah Baris
                    </button>
                    <div class="help-text">Tambahkan satu atau lebih paket include untuk trip ini</div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Simpan Semua Include
                    </button>
                    <a href="<?= base_url('admin/includes') ?>" class="btn-cancel">
                        <i class="fas fa-chevron-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let rowCount = 0;

function addIncludeRow() {
    const container = document.getElementById('includeContainer');
    const emptyState = document.getElementById('emptyState');
    
    if (emptyState) {
        emptyState.remove();
    }
    
    const row = document.createElement('div');
    row.className = 'include-item';
    row.id = `row-${rowCount}`;
    row.innerHTML = `
        <div>
            <label>Nama Include</label>
            <input type="text" 
                name="title[]" 
                class="form-control" 
                placeholder="Contoh: Transport PP"
                required>
        </div>
        <button type="button" class="btn-remove" onclick="removeIncludeRow('row-${rowCount}')">
            <i class="fas fa-trash"></i> Hapus
        </button>
    `;
    
    container.appendChild(row);
    rowCount++;
}

function removeIncludeRow(rowId) {
    const row = document.getElementById(rowId);
    if (row) {
        row.remove();
    }
    
    // Show empty state if no rows
    const container = document.getElementById('includeContainer');
    if (container.children.length === 0) {
        const emptyState = document.createElement('div');
        emptyState.className = 'empty-state';
        emptyState.id = 'emptyState';
        emptyState.textContent = 'Klik "Tambah Baris" untuk menambahkan paket include';
        container.appendChild(emptyState);
    }
}

// Initialize with one empty row
document.addEventListener('DOMContentLoaded', function() {
    addIncludeRow();
});
</script>

<?= $this->endSection() ?>