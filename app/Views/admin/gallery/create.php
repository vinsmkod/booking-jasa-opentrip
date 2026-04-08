<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<style>
    :root {
        --color-primary: #2d7d3a;
        --color-primary-dark: #1f5a29;
        --color-accent: #c4603a;
        --color-success: #10b981;
        --color-danger: #ef4444;
        --color-info: #3b82f6;
        --txt-primary: #1f2937;
        --txt-secondary: #4b5563;
        --txt-light: #9ca3af;
        --border-color: #e5e7eb;
        --bg-light: #f9fafb;
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border-color);
    }

    .page-header-content h1 {
        font-size: 28px;
        font-weight: 700;
        color: var(--txt-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header-content h1 i {
        color: var(--color-primary);
        font-size: 28px;
    }

    .page-header-content p {
        margin: 4px 0 0 0;
        color: var(--txt-secondary);
        font-size: 14px;
    }

    .btn-header-back {
        background: var(--bg-light);
        color: var(--txt-primary);
        padding: 10px 16px;
        border: 1.5px solid var(--border-color);
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-header-back:hover {
        background: white;
        border-color: var(--txt-primary);
        color: var(--txt-primary);
    }

    .alert-custom {
        border-radius: 12px;
        border: none;
        margin-bottom: 24px;
    }

    .alert-error {
        background: #fef2f2;
        color: #7f1d1d;
    }

    .alert-error .btn-close {
        filter: invert(0.5);
    }

    .info-card {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-radius: 12px;
        border: 1.5px solid #93c5fd;
        padding: 20px;
        margin-bottom: 32px;
    }

    .info-card-icon {
        color: var(--color-info);
        font-size: 24px;
        margin-right: 16px;
        flex-shrink: 0;
    }

    .info-card-content {
        flex: 1;
    }

    .info-card-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--txt-primary);
        margin-bottom: 8px;
        display: block;
    }

    .info-card-text {
        font-size: 13px;
        color: var(--txt-secondary);
        margin-bottom: 8px;
    }

    .info-card ul {
        margin: 8px 0 0 0;
        padding-left: 20px;
        font-size: 13px;
        color: var(--txt-secondary);
    }

    .info-card li {
        margin-bottom: 4px;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        padding: 32px;
    }

    .form-section {
        margin-bottom: 28px;
    }

    .form-section:last-of-type {
        margin-bottom: 0;
    }

    .form-section-title {
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--txt-secondary);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: flex;
        align-items: center;
        font-size: 13px;
        font-weight: 600;
        color: var(--txt-primary);
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .form-group label i {
        color: var(--color-primary);
        margin-right: 8px;
        font-size: 14px;
    }

    .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-control, .form-label {
        border: 1.5px solid var(--border-color);
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        color: var(--txt-primary);
    }

    .form-text {
        font-size: 12px;
        color: var(--txt-light);
        margin-top: 6px;
        display: block;
    }

    .form-text i {
        color: var(--color-info);
        margin-right: 4px;
    }

    .drop-zone {
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: var(--bg-light);
        position: relative;
    }

    .drop-zone:hover {
        background: rgba(45, 125, 58, 0.03);
        border-color: var(--color-primary);
        transform: translateY(-2px);
    }

    .drop-zone.dragging {
        background: rgba(45, 125, 58, 0.1);
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(45, 125, 58, 0.1);
    }

    .drop-zone-icon {
        font-size: 40px;
        color: var(--color-primary);
        margin-bottom: 16px;
        display: block;
    }

    .drop-zone-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--txt-primary);
        margin-bottom: 8px;
    }

    .drop-zone-subtitle {
        font-size: 13px;
        color: var(--txt-secondary);
        margin-bottom: 4px;
    }

    .drop-zone-hint {
        font-size: 12px;
        color: var(--txt-light);
        margin-bottom: 16px;
    }

    .btn-select-files {
        background: linear-gradient(135deg, var(--color-primary), #1f5a29);
        color: white;
        padding: 12px 28px;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 16px;
        box-shadow: 0 4px 12px rgba(45, 125, 58, 0.3);
        letter-spacing: 0.3px;
        position: relative;
        overflow: hidden;
    }

    .btn-select-files::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.15);
        transition: left 0.3s ease;
        z-index: 0;
    }

    .btn-select-files:hover::before {
        left: 100%;
    }

    .btn-select-files > * {
        position: relative;
        z-index: 1;
    }

    .btn-select-files:hover {
        background: linear-gradient(135deg, #1f5a29, #0f3a1a);
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(45, 125, 58, 0.35);
        color: white;
        text-decoration: none;
    }

    .btn-select-files:active {
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(45, 125, 58, 0.25);
    }

    #preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 16px;
        margin-top: 20px;
    }

    .preview-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        background: white;
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
    }

    .preview-item:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .preview-item img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        display: block;
    }

    .preview-item .file-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.4));
        color: white;
        padding: 12px 10px;
        font-size: 11px;
        text-align: center;
    }

    .preview-item .file-info strong {
        display: block;
        font-size: 12px;
        margin-bottom: 3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .preview-item .file-info .text-warning {
        color: #fbbf24;
        font-weight: 500;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--border-color);
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--color-primary), #1f5a29);
        color: white;
        padding: 14px 32px;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(45, 125, 58, 0.3);
        letter-spacing: 0.3px;
        position: relative;
        overflow: hidden;
    }

    .btn-primary-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.15);
        transition: left 0.3s ease;
        z-index: 0;
    }

    .btn-primary-custom:hover::before {
        left: 100%;
    }

    .btn-primary-custom > * {
        position: relative;
        z-index: 1;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #1f5a29, #0f3a1a);
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(45, 125, 58, 0.35);
        color: white;
    }

    .btn-primary-custom:active {
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(45, 125, 58, 0.25);
    }

    .btn-primary-custom:disabled {
        background: linear-gradient(135deg, var(--txt-light), #6b7280);
        cursor: not-allowed;
        transform: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        opacity: 0.6;
    }

    .btn-primary-custom i {
        font-size: 15px;
    }

    .btn-secondary-custom {
        background: var(--bg-light);
        color: var(--txt-primary);
        padding: 14px 32px;
        border: 1.5px solid var(--border-color);
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        letter-spacing: 0.2px;
    }

    .btn-secondary-custom:hover {
        background: white;
        border-color: var(--color-primary);
        color: var(--color-primary);
        box-shadow: 0 4px 12px rgba(45, 125, 58, 0.15);
        transform: translateY(-2px);
    }

    .btn-secondary-custom:active {
        transform: translateY(0);
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        color: white;
        flex-direction: column;
        backdrop-filter: blur(3px);
    }

    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid #fff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 20px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    .hr-custom {
        border: none;
        border-bottom: 1px solid var(--border-color);
        margin: 28px 0;
    }
</style>

<div style="padding: 40px 60px;">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1>
                <i class="fas fa-image"></i>
                Upload Foto Galeri
            </h1>
            <p>Kelola dan upload foto baru ke galeri aplikasi</p>
        </div>
        <a href="<?= base_url('admin/gallery') ?>" class="btn-header-back">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- Notifikasi Error -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-custom alert-error" role="alert">
            <div style="display: flex; align-items: flex-start;">
                <i class="fas fa-exclamation-circle" style="margin-right: 12px; margin-top: 2px; flex-shrink: 0;"></i>
                <div style="flex: 1;">
                    <?php
                    $error = session()->getFlashdata('error');
                    if (is_array($error)) {
                        foreach ($error as $err) {
                            echo '<div>' . esc($err) . '</div>';
                        }
                    } else {
                        echo esc($error);
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Info Card: Optimasi Gambar -->
    <div class="info-card" style="display: flex; align-items: flex-start;">
        <div class="info-card-icon">
            <i class="fas fa-sparkles"></i>
        </div>
        <div class="info-card-content">
            <strong class="info-card-title">Optimasi Gambar Otomatis</strong>
            <p class="info-card-text">Semua gambar akan dioptimalkan secara otomatis dengan standar berikut:</p>
            <ul>
                <li>Ukuran maksimal: <strong>1200 x 1200 piksel</strong> (mempertahankan rasio aspek)</li>
                <li>Kualitas kompresi: <strong>85%</strong> (optimal untuk web)</li>
                <li>Format didukung: <strong>JPG, PNG, WEBP</strong></li>
                <li>Maksimal ukuran file: <strong>10 MB per file</strong></li>
            </ul>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="<?= base_url('admin/gallery/store') ?>"
            method="post"
            enctype="multipart/form-data"
            id="uploadForm">
            <?= csrf_field() ?>

            <!-- Section: Informasi Foto -->
            <div class="form-section">
                <div class="form-section-title">Informasi Foto</div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-folder"></i>
                        Nama Album
                        <span class="required">*</span>
                    </label>
                    <input type="text"
                        name="album"
                        class="form-control"
                        list="album-list"
                        placeholder="Contoh: Gunung Merbabu, Trip Rinjani 2025"
                        value="<?= old('album') ?>"
                        required>
                    <span class="form-text">
                        <i class="fas fa-info-circle"></i>
                        Ketik nama baru atau pilih dari album yang sudah ada
                    </span>
                    <datalist id="album-list">
                        <?php if (!empty($albums)): 
                            foreach ($albums as $a): ?>
                                <option value="<?= esc($a['album']) ?>">
                            <?php endforeach; 
                        endif; ?>
                    </datalist>
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-heading"></i>
                        Judul Foto
                        <span class="required">*</span>
                    </label>
                    <input type="text"
                        name="title"
                        class="form-control"
                        placeholder="Masukkan judul foto"
                        value="<?= old('title') ?>"
                        required>
                    <span class="form-text">
                        <i class="fas fa-info-circle"></i>
                        Satu judul akan berlaku untuk semua foto yang diupload
                    </span>
                </div>
            </div>

            <hr class="hr-custom">

            <!-- Section: Upload Foto -->
            <div class="form-section">
                <div class="form-section-title">Upload Foto</div>

                <div class="form-group">
                    <div class="drop-zone" id="mainDrop">
                        <input type="file" name="images[]" accept="image/*" multiple
                            onchange="previewMultiple(this)"
                            style="display: none;">
                        <div class="drop-zone-content">
                            <span class="drop-zone-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </span>
                            <div class="drop-zone-title">Klik atau drag & drop foto di sini</div>
                            <div class="drop-zone-subtitle">JPG, PNG, WEBP · dapat memilih beberapa foto sekaligus</div>
                            <div class="drop-zone-hint">Maksimal ukuran per file 10 MB · akan dioptimalkan ke 1200px</div>
                            <button type="button" class="btn-select-files"
                                onclick="document.querySelector('#mainDrop input').click()">
                                <i class="fas fa-folder-open"></i>
                                Pilih Foto
                            </button>
                        </div>
                    </div>
                    <div id="preview-grid"></div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-primary-custom" id="submitBtn">
                    <i class="fas fa-upload"></i>
                    Upload & Optimasi Foto
                </button>
                <a href="<?= base_url('admin/gallery') ?>" class="btn-secondary-custom">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>

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
                                ${(file.size / 1024).toFixed(1)} KB · ${dimensions}<br>
                                <span class="text-warning">→ ${newDimensions.width} x ${newDimensions.height}</span>
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
                <div class="loading-spinner"></div>
                <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 8px;">Memproses dan Mengoptimasi Gambar...</h5>
                <p style="margin-bottom: 4px; opacity: 0.9;">Mohon tunggu, proses ini membutuhkan waktu</p>
                <small style="opacity: 0.8;">Gambar sedang dioptimalkan ke ukuran 1200px</small>
            </div>
        `;
        document.body.appendChild(loadingDiv);

        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Upload & Optimasi...';
        submitBtn.disabled = true;
    });
</script>

<?= $this->endSection() ?>