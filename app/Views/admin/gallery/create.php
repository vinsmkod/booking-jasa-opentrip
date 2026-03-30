<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Tambah Foto Baru</h3>
            <p class="text-muted mb-0">Upload satu atau beberapa foto sekaligus ke galeri</p>
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

    <!-- Informasi Optimasi Gambar -->
    <div class="alert alert-info mb-4">
        <div class="d-flex align-items-start">
            <i class="fas fa-image fa-2x me-3"></i>
            <div>
                <strong class="d-block mb-1">✨ Optimasi Gambar Otomatis</strong>
                <p class="mb-0 small">Semua gambar akan dioptimalkan secara otomatis:</p>
                <ul class="small mb-0 mt-1">
                    <li>Ukuran maksimal: <strong>1200 x 1200 piksel</strong> (mempertahankan rasio aspek)</li>
                    <li>Kualitas kompresi: <strong>85%</strong> (optimal untuk web)</li>
                    <li>Format didukung: <strong>JPG, PNG, WEBP</strong></li>
                    <li>Maksimal ukuran file: <strong>10 MB per file</strong></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="<?= base_url('admin/gallery/store') ?>"
                method="post"
                enctype="multipart/form-data"
                id="uploadForm">
                <?= csrf_field() ?>

                <!-- Album -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Nama Album <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                        name="album"
                        class="form-control"
                        list="album-list"
                        placeholder="Contoh: Dokumentasi Gunung Merbabu, Trip Rinjani 2025"
                        value="<?= old('album') ?>"
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
                        placeholder="Masukkan judul foto"
                        value="<?= old('title') ?>"
                        required>
                    <div class="form-text">
                        <i class="fas fa-info-circle"></i> Satu judul akan berlaku untuk semua foto yang diupload
                    </div>
                </div>

                <hr class="my-4">

                <!-- Upload Foto -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Pilih Foto <span class="text-danger">*</span>
                    </label>
                    <div class="drop-zone border rounded-3 p-5 text-center bg-light"
                        style="cursor: pointer; transition: all 0.3s; border: 2px dashed #dee2e6;"
                        id="mainDrop">
                        <input type="file" name="images[]" accept="image/*" multiple
                            onchange="previewMultiple(this)"
                            style="display: none;">
                        <div class="drop-zone-content">
                            <i class="fas fa-cloud-upload-alt fa-3x text-secondary mb-3 d-block"></i>
                            <h5 class="mb-2">Klik atau drag & drop foto di sini</h5>
                            <p class="text-muted mb-0">JPG, PNG, WEBP · dapat memilih beberapa foto sekaligus</p>
                            <p class="text-muted small mb-0">Maksimal ukuran per file 10 MB · akan dioptimalkan ke 1200px</p>
                            <button type="button" class="btn btn-primary mt-3"
                                onclick="document.querySelector('#mainDrop input').click()">
                                <i class="fas fa-folder-open"></i> Pilih Foto
                            </button>
                        </div>
                    </div>
                    <div id="preview-grid" class="mt-3"
                        style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 15px;">
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                        <i class="fas fa-upload"></i> Upload & Optimasi Foto
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
        background: #fff;
        transition: transform 0.2s;
    }

    .preview-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .preview-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .preview-item .file-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        color: white;
        padding: 8px;
        font-size: 11px;
        text-align: center;
    }

    .alert-info {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdef5 100%);
        border: none;
        border-radius: 12px;
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        color: white;
        flex-direction: column;
    }

    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid #fff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    let selectedFiles = [];

    function previewMultiple(input) {
        const grid = document.getElementById('preview-grid');
        grid.innerHTML = '';
        selectedFiles = [];

        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach((file, i) => {
                // Validate file size
                if (file.size > 10485760) { // 10 MB
                    alert(`File "${file.name}" terlalu besar! Maksimal 10 MB.`);
                    return;
                }

                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!allowedTypes.includes(file.type)) {
                    alert(`File "${file.name}" format tidak didukung! Gunakan JPG, PNG, atau WEBP.`);
                    return;
                }

                selectedFiles.push(file);

                const reader = new FileReader();
                reader.onload = e => {
                    const item = document.createElement('div');
                    item.className = 'preview-item';

                    // Create image element to get dimensions
                    const img = new Image();
                    img.onload = function() {
                        const dimensions = `${img.width} x ${img.height}`;
                        const newDimensions = getOptimizedDimensions(img.width, img.height);
                        item.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${i+1}">
                            <div class="file-info">
                                <strong>${file.name.substring(0, 20)}${file.name.length > 20 ? '...' : ''}</strong><br>
                                Ukuran: ${(file.size / 1024).toFixed(1)} KB<br>
                                Dimensi: ${dimensions}<br>
                                <span class="text-warning">→ Akan dioptimasi: ${newDimensions.width} x ${newDimensions.height}</span>
                            </div>
                        `;
                    };
                    img.src = e.target.result;
                    grid.appendChild(item);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    function getOptimizedDimensions(width, height, maxSize = 1200) {
        let newWidth = width;
        let newHeight = height;

        if (width > maxSize || height > maxSize) {
            const ratio = Math.min(maxSize / width, maxSize / height);
            newWidth = Math.round(width * ratio);
            newHeight = Math.round(height * ratio);
        }

        return {
            width: newWidth,
            height: newHeight
        };
    }

    // Drag & Drop functionality
    const dropZone = document.getElementById('mainDrop');
    const fileInput = dropZone.querySelector('input');

    dropZone.addEventListener('click', () => fileInput.click());

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragging');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragging');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragging');
        const files = e.dataTransfer.files;
        fileInput.files = files;
        previewMultiple(fileInput);
    });

    // Loading saat submit form
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const files = fileInput.files;

        if (files.length === 0) {
            e.preventDefault();
            alert('Pilih foto terlebih dahulu');
            return;
        }

        // Tampilkan loading overlay
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'loading-overlay';
        loadingDiv.innerHTML = `
            <div class="text-center">
                <div class="loading-spinner mb-3"></div>
                <h5>Memproses dan Mengoptimasi Gambar...</h5>
                <p class="mb-0">Mohon tunggu, proses ini membutuhkan waktu</p>
                <small>Gambar sedang dioptimalkan ke ukuran 1200px</small>
            </div>
        `;
        document.body.appendChild(loadingDiv);

        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Upload & Optimasi...';
        submitBtn.disabled = true;

        // Form akan submit, loading hanya untuk feedback visual
        // Note: Form akan tetap submit, loading akan hilang setelah redirect
    });
</script>

<?= $this->endSection() ?>