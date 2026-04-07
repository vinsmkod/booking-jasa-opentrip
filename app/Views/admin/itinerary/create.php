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

.help-text {
    font-size: 12px;
    color: #6b7280;
    margin-top: 6px;
}

/* Itinerary Items */
.itinerary-list {
    background: #f9fafb;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 24px;
    border: 1px solid #e5e7eb;
}

.itinerary-item {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 16px;
    margin-bottom: 12px;
    display: grid;
    grid-template-columns: 100px 1fr auto;
    gap: 12px;
    align-items: flex-end;
}

.itinerary-item:last-child {
    margin-bottom: 0;
}

.itinerary-item.empty-state {
    text-align: center;
    color: #9ca3af;
    font-size: 13px;
    grid-template-columns: 1fr;
}

.itinerary-item label {
    font-size: 12px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    margin-bottom: 4px;
    display: block;
}

.itinerary-item input {
    margin: 0;
}

.btn-remove {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
    padding: 8px 16px;
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
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="page-header-left">
        <h1>Tambah Itinerary</h1>
        <p>Tambahkan banyak jadwal kegiatan untuk satu trip</p>
    </div>
</div>

<div class="form-container">
    <div class="panel">
        <div class="panel-header">
            <span class="panel-title"><i class="fas fa-plus-circle"></i> Form Tambah Itinerary</span>
        </div>

        <div class="panel-body">
            <form action="<?= base_url('admin/itinerary/store-batch') ?>" method="post" class="form">
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
                    <div class="help-text">Pilih trip yang akan ditambahkan itinerarynya</div>
                </div>

                <!-- Itinerary Items -->
                <div class="form-group-row">
                    <label class="form-label">
                        <i class="fas fa-list-ul" style="margin-right:6px;color:#2d7d3a;"></i>Jadwal Kegiatan
                    </label>
                    
                    <div class="itinerary-list" id="itineraryContainer">
                        <div class="itinerary-item empty-state" id="emptyState">
                            Klik "Tambah Baris" untuk menambahkan jadwal kegiatan
                        </div>
                    </div>

                    <button type="button" class="btn-add-row" onclick="addItineraryRow()">
                        <i class="fas fa-plus"></i> Tambah Baris
                    </button>
                    <div class="help-text">Tambahkan satu atau lebih jadwal kegiatan untuk trip ini</div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Simpan Semua Itinerary
                    </button>
                    <a href="<?= base_url('admin/itinerary') ?>" class="btn-cancel">
                        <i class="fas fa-chevron-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let rowCount = 0;

function addItineraryRow() {
    const container = document.getElementById('itineraryContainer');
    const emptyState = document.getElementById('emptyState');
    
    if (emptyState) {
        emptyState.remove();
    }
    
    const row = document.createElement('div');
    row.className = 'itinerary-item';
    row.id = `row-${rowCount}`;
    row.innerHTML = `
        <div>
            <label>Waktu</label>
            <input type="text" 
                name="time[]" 
                class="form-control" 
                placeholder="05:00"
                required>
        </div>
        <div>
            <label>Kegiatan</label>
            <input type="text" 
                name="activity[]" 
                class="form-control" 
                placeholder="Berkumpul di meeting point"
                required>
        </div>
        <button type="button" class="btn-remove" onclick="removeItineraryRow('row-${rowCount}')">
            <i class="fas fa-trash"></i> Hapus
        </button>
    `;
    
    container.appendChild(row);
    rowCount++;
}

function removeItineraryRow(rowId) {
    const row = document.getElementById(rowId);
    if (row) {
        row.remove();
    }
    
    // Show empty state if no rows
    const container = document.getElementById('itineraryContainer');
    if (container.children.length === 0) {
        const emptyState = document.createElement('div');
        emptyState.className = 'itinerary-item empty-state';
        emptyState.id = 'emptyState';
        emptyState.textContent = 'Klik "Tambah Baris" untuk menambahkan jadwal kegiatan';
        container.appendChild(emptyState);
    }
}

// Initialize with one empty row
document.addEventListener('DOMContentLoaded', function() {
    addItineraryRow();
});
</script>

<?= $this->endSection() ?>