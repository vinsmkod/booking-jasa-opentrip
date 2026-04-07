<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white rounded-top-4">
            <h4 class="mb-0">✏️ Edit Trip</h4>
        </div>

        <div class="card-body p-4">
            <form action="/admin/trips/update/<?= $trip['trip_id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Judul -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Trip</label>
                    <input type="text" name="title" class="form-control"
                           value="<?= esc($trip['title']); ?>" required>
                </div>

                <!-- Lokasi -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Lokasi</label>
                    <input type="text" name="location" class="form-control"
                           value="<?= esc($trip['location']); ?>" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control" required><?= esc($trip['description']); ?></textarea>
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control"
                           value="<?= esc($trip['price']); ?>" required>
                </div>

                <!-- Tanggal Keberangkatan -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Keberangkatan</label>
                    <input type="date" name="departure_date" class="form-control"
                           value="<?= esc($schedule['departure_date'] ?? ''); ?>">
                </div>

                <!-- Kuota Peserta -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kuota Peserta</label>
                    <input type="number" name="quota" class="form-control"
                           value="<?= esc($schedule['quota'] ?? ''); ?>">
                </div>


                <!-- ===============================
                     LINK WHATSAPP GROUP (BARU)
                     =============================== -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Link Grup WhatsApp</label>
                    <input type="text"
                           name="whatsapp_group"
                           class="form-control"
                           value="<?= esc($trip['whatsapp_group'] ?? '') ?>"
                           placeholder="https://chat.whatsapp.com/xxxxx">

                    <div class="small text-muted">
                        Link grup akan muncul setelah booking dikonfirmasi
                    </div>
                </div>


                <!-- Kategori Trip -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Kategori Trip</label>
                    <div class="row">
                        <?php $types = ['one_day_trip'=>'One Day Trip','open_trip'=>'Open Trip','private_trip'=>'Private Trip']; ?>
                        <?php foreach($types as $key=>$label): ?>
                            <div class="col-md-4">
                                <div class="form-check border rounded-3 p-3">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="type"
                                           value="<?= $key ?>"
                                           <?= $trip['type'] == $key ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-semibold"><?= $label ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status Trip</label>
                    <select name="status" class="form-select">
                        <option value="active" <?= $trip['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="full" <?= $trip['status'] == 'full' ? 'selected' : '' ?>>Full</option>
                        <option value="cancelled" <?= $trip['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                </div>

                <!-- Preview Gambar -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Saat Ini</label><br>
                    <?php if($trip['image']): ?>
                        <img src="/uploads/<?= $trip['image']; ?>" class="img-thumbnail rounded-3" style="max-width: 200px;">
                    <?php else: ?>
                        <div class="text-muted">Belum ada gambar</div>
                    <?php endif; ?>
                </div>

                <!-- Upload Gambar Baru -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Ganti Gambar</label>
                    <input type="file" name="image" class="form-control">
                    <div class="small text-muted">Kosongkan jika tidak ingin mengganti gambar</div>
                </div>

                <!-- Meeting Points -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Meeting Points</label>
                    <div id="meetingPointsContainer">
                        <?php if(!empty($meetingPoints)): ?>
                            <?php foreach($meetingPoints as $i => $mp): ?>
                                <div class="input-group mb-2">
                                    <input type="hidden" name="meeting_point_id[]" value="<?= esc($mp['meeting_point_id'] ?? ''); ?>">
                                    <input type="text"
                                           name="meeting_points[]"
                                           class="form-control"
                                           value="<?= esc($mp['name']); ?>"
                                           placeholder="Nama Titik Meeting">
                                    <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <button type="button" id="addMeetingPoint" class="btn btn-dark btn-sm mt-2">
                        + Tambah Titik Meeting
                    </button>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="/admin/trips" class="btn btn-secondary px-4">← Kembali</a>
                    <button type="submit" class="btn btn-dark px-4">💾 Update Trip</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Template -->
<template id="meetingPointTemplate">
    <div class="input-group mb-2">
        <input type="text" name="meeting_points[]" class="form-control" placeholder="Nama Titik Meeting">
        <button type="button" class="btn btn-danger btn-remove">Hapus</button>
    </div>
</template>

<script>

document.getElementById('addMeetingPoint').addEventListener('click', function() {
    const container = document.getElementById('meetingPointsContainer');
    const template = document.getElementById('meetingPointTemplate');
    const clone = template.content.cloneNode(true);
    container.appendChild(clone);
});

document.getElementById('meetingPointsContainer').addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('btn-remove')){
        e.target.closest('.input-group').remove();
    }
});

</script>

<?= $this->endSection() ?>