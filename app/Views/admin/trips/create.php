<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
.page-header {
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 2px solid #e5e7eb;
}

.page-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 4px;
}

.page-header p {
    font-size: 14px;
    color: #6b7280;
}

.form-container {
    max-width: 900px;
}

.panel {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.panel-header {
    background: linear-gradient(135deg, #f9fafb, #f3f4f6);
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
}

.panel-title {
    font-size: 16px;
    font-weight: 600;
    color: #1f2937;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.panel-title i {
    color: #2d7d3a;
    font-size: 18px;
}

.panel-body {
    padding: 32px;
}

.form-group {
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

.form-control, .form-select {
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

.form-control:focus, .form-select:focus {
    border-color: #2d7d3a;
    box-shadow: 0 0 0 3px rgba(45, 125, 58, 0.1);
    outline: none;
}

.form-control::placeholder {
    color: #9ca3af;
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.help-text {
    font-size: 12px;
    color: #6b7280;
    margin-top: 6px;
    display: block;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
    margin-bottom: 24px;
}

.form-row.full {
    grid-template-columns: 1fr;
}

.meeting-points-section {
    background: #f9fafb;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 24px;
    border: 1px solid #e5e7eb;
}

.meeting-points-section .form-label {
    margin-bottom: 16px;
}

.meeting-point-item {
    display: flex;
    gap: 12px;
    margin-bottom: 12px;
    align-items: flex-end;
}

.meeting-point-item input {
    flex: 1;
}

.btn-remove {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
    padding: 10px 16px;
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-remove:hover {
    background: #fecaca;
    color: #7f1d1d;
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

.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid #e5e7eb;
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
</style>

<div class="page-header">
    <h1>Tambah Trip Baru</h1>
    <p>Buat paket trip baru dengan deskripsi dan meeting point</p>
</div>

<div class="form-container">
    <div class="panel">
        <div class="panel-header">
            <h2 class="panel-title"><i class="fas fa-mountain"></i> Form Tambah Trip</h2>
        </div>

        <div class="panel-body">
            <form action="/admin/trips/store" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Row 1: Title & Location -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-heading" style="margin-right:6px;color:#2d7d3a;"></i>Nama Trip</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Gunung Semeru" required>
                        <span class="help-text">Nama trip yang akan ditampilkan ke peserta</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-map-marker-alt" style="margin-right:6px;color:#2d7d3a;"></i>Lokasi</label>
                        <input type="text" name="location" class="form-control" placeholder="Contoh: Malang, Jawa Timur" required>
                        <span class="help-text">Lokasi atau kota tujuan</span>
                    </div>
                </div>

                <!-- Row 2: Price & Type -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-tag" style="margin-right:6px;color:#2d7d3a;"></i>Harga per Peserta</label>
                        <input type="number" name="price" class="form-control" placeholder="0" required>
                        <span class="help-text">Harga dalam Rupiah</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-list" style="margin-right:6px;color:#2d7d3a;"></i>Kategori Trip</label>
                        <select name="type" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="one_day_trip">One Day Trip</option>
                            <option value="open_trip">Open Trip</option>
                            <option value="private_trip">Private Trip</option>
                        </select>
                        <span class="help-text">Tipe trip yang akan ditawarkan</span>
                    </div>
                </div>

                <!-- Row 3: Date & Quota -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-calendar" style="margin-right:6px;color:#2d7d3a;"></i>Tanggal Keberangkatan</label>
                        <input type="date" name="departure_date" class="form-control" required>
                        <span class="help-text">Tanggal pelaksanaan trip</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-users" style="margin-right:6px;color:#2d7d3a;"></i>Kuota Peserta</label>
                        <input type="number" name="quota" class="form-control" placeholder="0" required>
                        <span class="help-text">Jumlah peserta maksimal</span>
                    </div>
                </div>

                <!-- Row 4: Status & Image -->
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-info-circle" style="margin-right:6px;color:#2d7d3a;"></i>Status</label>
                        <select name="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="full">Full</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <span class="help-text">Status ketersediaan trip</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-image" style="margin-right:6px;color:#2d7d3a;"></i>Gambar Trip</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <span class="help-text">Format: JPG, PNG (Max 5MB)</span>
                    </div>
                </div>

                <!-- WhatsApp Group Link -->
                <div class="form-group">
                    <label class="form-label"><i class="fab fa-whatsapp" style="margin-right:6px;color:#2d7d3a;"></i>Link Grup WhatsApp</label>
                    <input type="text" name="whatsapp_group" class="form-control" placeholder="https://chat.whatsapp.com/xxxxx">
                    <span class="help-text">Link grup akan muncul setelah admin mengkonfirmasi booking</span>
                </div>

                <!-- Deskripsi -->
                <div class="form-group form-row full">
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-align-left" style="margin-right:6px;color:#2d7d3a;"></i>Deskripsi Trip</label>
                        <textarea name="description" class="form-control" placeholder="Jelaskan detail trip, apa yang perlu disiapkan, dll..."></textarea>
                        <span class="help-text">Deskripsi lengkap tentang trip ini</span>
                    </div>
                </div>

                <!-- Meeting Points -->
                <div class="form-group form-row full">
                    <div class="meeting-points-section">
                        <label class="form-label"><i class="fas fa-map-pin" style="margin-right:6px;color:#2d7d3a;"></i>Meeting Points</label>
                        
                        <div id="meetingPointsContainer">
                            <div class="meeting-point-item">
                                <input type="text" name="meeting_points[]" class="form-control" placeholder="Contoh: Stasiun Bandung" required>
                                <button type="button" class="btn-remove" onclick="removeMeetingPoint(this)">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>

                        <button type="button" class="btn-add-row" onclick="addMeetingPoint()">
                            <i class="fas fa-plus"></i> Tambah Titik Meeting
                        </button>
                        <span class="help-text" style="display:block;margin-top:12px;">Tambahkan semua titik pertemuan yang tersedia</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Simpan Trip
                    </button>
                    <a href="/admin/trips" class="btn-cancel">
                        <i class="fas fa-chevron-left"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function addMeetingPoint() {
    const container = document.getElementById('meetingPointsContainer');
    const newItem = document.createElement('div');
    newItem.className = 'meeting-point-item';
    newItem.innerHTML = `
        <input type="text" name="meeting_points[]" class="form-control" placeholder="Contoh: Stasiun Bandung" required>
        <button type="button" class="btn-remove" onclick="removeMeetingPoint(this)">
            <i class="fas fa-trash"></i> Hapus
        </button>
    `;
    container.appendChild(newItem);
}

function removeMeetingPoint(btn) {
    btn.closest('.meeting-point-item').remove();
}
</script>

<?= $this->endSection() ?>