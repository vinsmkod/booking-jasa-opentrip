<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <div class="mb-4">
        <h3 class="fw-bold">Tambah Trip</h3>
        <p class="text-muted">Tambahkan paket trip baru beserta titik meeting point</p>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-4">

            <form action="/admin/trips/store" method="post" enctype="multipart/form-data">

                <div class="row">

                    <!-- Judul -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Judul Trip</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <!-- Lokasi -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Lokasi</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>

                    <!-- Harga -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Harga</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <!-- Kategori Trip -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kategori Trip</label>
                        <select name="type" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="one_day_trip">One Day Trip</option>
                            <option value="open_trip">Open Trip</option>
                            <option value="private_trip">Private Trip</option>
                        </select>
                    </div>

                    <!-- Tanggal Keberangkatan -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Keberangkatan</label>
                        <input type="date" name="departure_date" class="form-control" required>
                    </div>

                    <!-- Kuota -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kuota Peserta</label>
                        <input type="number" name="quota" class="form-control" required>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="full">Full</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Gambar Trip</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="description" rows="5" class="form-control"></textarea>
                    </div>

                    <!-- ===========================
                         MEETING POINTS DINAMIS
                         =========================== -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-semibold">Meeting Points</label>
                        <div id="meetingPointsContainer">
                            <div class="input-group mb-2">
                                <input type="text" name="meeting_points[]" class="form-control" placeholder="Nama titik meeting point">
                                <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                            </div>
                        </div>
                        <button type="button" id="addMeetingPoint" class="btn btn-dark btn-sm mt-2">+ Tambah Titik Meeting</button>
                    </div>

                </div>

                <div class="mt-3">
                    <button class="btn btn-success">Simpan Trip</button>
                    <a href="/admin/trips" class="btn btn-secondary">Kembali</a>
                </div>

            </form>

        </div>
    </div>

</div>

<!-- Template -->
<template id="meetingPointTemplate">
    <div class="input-group mb-2">
        <input type="text" name="meeting_points[]" class="form-control" placeholder="Nama titik meeting point">
        <button type="button" class="btn btn-danger btn-remove">Hapus</button>
    </div>
</template>

<script>
// Tambah titik meeting point
document.getElementById('addMeetingPoint').addEventListener('click', function() {
    const container = document.getElementById('meetingPointsContainer');
    const template = document.getElementById('meetingPointTemplate');
    const clone = template.content.cloneNode(true);
    container.appendChild(clone);
});

// Hapus input meeting point
document.getElementById('meetingPointsContainer').addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('btn-remove')){
        e.target.closest('.input-group').remove();
    }
});
</script>

<?= $this->endSection() ?>