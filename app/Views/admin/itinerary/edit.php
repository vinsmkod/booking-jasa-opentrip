<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<style>
.form-container {
    max-width: 900px;
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

.trip-info {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    border-radius: 6px;
    padding: 12px 16px;
    margin-bottom: 24px;
    font-size: 13px;
    color: #065f46;
}

.trip-info strong {
    color: #047857;
}
</style>

<div class="page-header">
    <div class="page-header-left">
        <h1>Edit Itinerary</h1>
        <p>Edit semua jadwal kegiatan dari trip yang dipilih</p>
    </div>
</div>

<div class="form-container">
    <div class="panel">
        <div class="panel-header">
            <span class="panel-title"><i class="fas fa-edit"></i> Edit Batch Itinerary</span>
        </div>

        <div class="panel-body">
            <?php if (!empty($tripId)): ?>
            <div class="trip-info">
                <i class="fas fa-info-circle me-2"></i>
                Editing <strong><?= count($allItineraries) ?></strong> jadwal kegiatan
            </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/itinerary/update-batch') ?>" method="post" class="form">
                <?= csrf_field() ?>
                <input type="hidden" name="trip_id" value="<?= $tripId ?? '' ?>">

                <!-- Itinerary Items -->
                <div class="form-group-row">
                    <label class="form-label">
                        <i class="fas fa-list-ul" style="margin-right:6px;color:#2d7d3a;"></i>Jadwal Kegiatan
                    </label>
                    
                    <div class="itinerary-list" id="itineraryContainer">
                        <?php if (!empty($allItineraries)): ?>
                            <?php foreach($allItineraries as $idx => $item): ?>
                            <div class="itinerary-item" id="row-<?= $idx ?>">
                                <div>
                                    <label>Waktu</label>
                                    <input type="text" 
                                        name="time[]" 
                                        class="form-control" 
                                        value="<?= esc($item['time']) ?>"
                                        required>
                                </div>
                                <div>
                                    <label>Kegiatan</label>
                                    <input type="text" 
                                        name="activity[]" 
                                        class="form-control" 
                                        value="<?= esc($item['activity']) ?>"
                                        required>
                                </div>
                                <button type="button" class="btn-remove" onclick="removeItineraryRow('row-<?= $idx ?>')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                                <input type="hidden" name="itinerary_id[]" value="<?= $item['itinerary_id'] ?>">
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div style="text-align:center;color:#9ca3af;padding:20px;">
                                Tidak ada itinerary untuk trip ini
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="button" class="btn-add-row" onclick="addItineraryRow()">
                        <i class="fas fa-plus"></i> Tambah Baris
                    </button>
                    <div class="help-text">Ubah jadwal sesuai kebutuhan dan klik Simpan</div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Simpan Perubahan
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
let rowCount = <?= count($allItineraries ?? []) ?>;

function addItineraryRow() {
    const container = document.getElementById('itineraryContainer');
    
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
        <input type="hidden" name="itinerary_id[]" value="">
    `;
    
    container.appendChild(row);
    rowCount++;
}

function removeItineraryRow(rowId) {
    const row = document.getElementById(rowId);
    if (row) {
        row.remove();
    }
}
</script>

<?= $this->endSection() ?>