<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Edit Foto</h3>
            <p class="text-muted mb-0">Ubah informasi foto galeri</p>
        </div>
        <a href="<?= base_url('admin/gallery') ?>" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Notifikasi Error -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?php
            $error = session()->getFlashdata('error');
            if (is_array($error)) {
                foreach ($error as $err) {
                    echo $err . '<br>';
                }
            } else {
                echo $error;
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="<?= base_url('admin/gallery/update/' . $gallery['gallery_id']) ?>"
                method="post"
                enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">

                <!-- Album -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Nama Album <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                        name="album"
                        class="form-control"
                        list="album-list"
                        value="<?= esc($gallery['album']) ?>"
                        placeholder="Contoh: Dokumentasi Gunung Merbabu"
                        required>
                    <div class="form-text">
                        <i class="fas fa-info-circle"></i> Ketik nama baru atau pilih dari album yang sudah ada
                    </div>
                    <datalist id="album-list">
                        <?php if (!empty($albums)): foreach ($albums as $a): ?>
                                <option value="<?= esc($a['album']) ?>">
                            <?php endforeach;
                        endif; ?>
                    </datalist>
                </div>

                <!-- Judul -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Judul Foto <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                        name="title"
                        class="form-control"
                        value="<?= esc($gallery['title']) ?>"
                        placeholder="Masukkan judul foto"
                        required>
                </div>

                <!-- Foto Saat Ini -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                    <div class="border rounded-3 p-3 bg-light text-center">
                        <img src="<?= base_url('uploads/gallery/' . $gallery['image']) ?>"
                            alt="<?= esc($gallery['title']) ?>"
                            style="max-width: 100%; max-height: 300px; object-fit: contain; border-radius: 8px;">
                        <p class="text-muted mt-2 mb-0">
                            <i class="fas fa-info-circle"></i> Biarkan kosong jika tidak ingin mengganti foto
                        </p>
                    </div>
                </div>

                <!-- Ganti Foto -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Ganti Foto (Opsional)</label>
                    <div class="drop-zone border rounded-3 p-4 text-center bg-light"
                        style="cursor: pointer; transition: all 0.3s; border: 2px dashed #dee2e6;"
                        id="editDrop">
                        <input type="file" name="image" accept="image/*"
                            onchange="previewSingle(this)"
                            style="display: none;">
                        <div class="drop-zone-content">
                            <i class="fas fa-exchange-alt fa-2x text-secondary mb-2 d-block"></i>
                            <p class="mb-0"><strong>Klik atau drag & drop</strong> foto baru di sini</p>
                            <small class="text-muted">JPG, PNG, WEBP · maks 10 MB</small>
                            <button type="button" class="btn btn-outline-primary btn-sm mt-2"
                                onclick="document.querySelector('#editDrop input').click()">
                                <i class="fas fa-folder-open"></i> Pilih Foto
                            </button>
                        </div>
                    </div>
                    <div id="edit-preview" class="mt-3"></div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('admin/gallery') ?>" class="btn btn-outline-secondary px-4">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>

</div>

<style>
    .drop-zone {
        transition: all 0.3s;
    }

    .drop-zone:hover {
        background: #f8f9fa !important;
        border-color: #0d6efd !important;
    }

    .drop-zone.dragging {
        background: #e7f1ff !important;
        border-color: #0d6efd !important;
    }

    .preview-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        max-width: 200px;
    }

    .preview-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }
</style>

<script>
    function previewSingle(input) {
        const container = document.getElementById('edit-preview');
        container.innerHTML = '';

        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Validate file size
            if (file.size > 10485760) { // 10 MB
                alert('Ukuran file terlalu besar! Maksimal 10 MB.');
                input.value = '';
                return;
            }

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung! Gunakan JPG, PNG, atau WEBP.');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = e => {
                container.innerHTML = `
                <div class="preview-item">
                    <img src="${e.target.result}" alt="Preview">
                    <div class="position-absolute top-0 end-0 p-2">
                        <span class="badge bg-primary">Preview</span>
                    </div>
                </div>
            `;
            };
            reader.readAsDataURL(file);
        }
    }

    // Drag & Drop functionality
    const editDrop = document.getElementById('editDrop');
    const editFileInput = editDrop.querySelector('input');

    editDrop.addEventListener('click', () => editFileInput.click());

    editDrop.addEventListener('dragover', (e) => {
        e.preventDefault();
        editDrop.classList.add('dragging');
    });

    editDrop.addEventListener('dragleave', () => {
        editDrop.classList.remove('dragging');
    });

    editDrop.addEventListener('drop', (e) => {
        e.preventDefault();
        editDrop.classList.remove('dragging');
        const files = e.dataTransfer.files;
        editFileInput.files = files;
        previewSingle(editFileInput);
    });
</script>

<?= $this->endSection() ?>