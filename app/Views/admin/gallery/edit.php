<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet">

<style>
    :root {
        --color-primary: #2d7d3a;
        --color-primary-dark: #1f5a29;
        --color-success: #10b981;
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
        border-color: var(--color-primary);
        color: var(--color-primary);
    }

    .info-card {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-radius: 12px;
        border: 1.5px solid #93c5fd;
        padding: 20px;
        margin-bottom: 32px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .info-card-icon {
        color: #3b82f6;
        font-size: 20px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .info-card-content {
        flex: 1;
    }

    .info-card-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--txt-primary);
        margin-bottom: 4px;
        display: block;
    }

    .info-card-text {
        font-size: 13px;
        color: var(--txt-secondary);
        margin: 0;
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

    .form-control {
        display: block;
        width: 100%;
        border: 1.5px solid var(--border-color);
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        color: var(--txt-primary);
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(45, 125, 58, 0.1);
        outline: none;
    }

    .form-text {
        font-size: 12px;
        color: var(--txt-light);
        margin-top: 6px;
        display: block;
    }

    .hr-custom {
        border: none;
        border-bottom: 1px solid var(--border-color);
        margin: 28px 0;
    }

    .current-photo {
        text-align: center;
        padding: 20px;
        background: var(--bg-light);
        border-radius: 12px;
    }

    .current-photo img {
        max-width: 100%;
        height: 300px;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
    }

    .crop-section {
        margin-top: 24px;
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 24px;
    }

    .crop-area {
        background: var(--bg-light);
        border-radius: 12px;
        padding: 20px;
        border: 1px solid var(--border-color);
    }

    .crop-area-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--txt-primary);
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .crop-container {
        width: 100%;
        height: 400px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .crop-container img {
        max-width: 100%;
        max-height: 100%;
    }

    .crop-sidebar {
        background: white;
        padding: 20px;
        border-radius: 10px;
        border: 1.5px solid var(--border-color);
        height: fit-content;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .preview-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--txt-primary);
    }

    .preview-box {
        width: 100%;
        height: 200px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        overflow: hidden;
        background: var(--bg-light);
    }

    .preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Buttons */
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
    }

    .btn-primary-custom:active {
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(45, 125, 58, 0.25);
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

    .btn-crop {
        background: linear-gradient(135deg, var(--color-success), #059669);
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-crop::before {
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

    .btn-crop:hover::before {
        left: 100%;
    }

    .btn-crop > * {
        position: relative;
        z-index: 1;
    }

    .btn-crop:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(16, 185, 129, 0.35);
    }

    .btn-crop:disabled {
        background: var(--txt-light);
        cursor: not-allowed;
        transform: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        opacity: 0.6;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--border-color);
    }

    .hidden {
        display: none;
    }
</style>

<div style="padding: 40px 60px;">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1>
                <i class="fas fa-edit"></i>
                Edit Foto Galeri
            </h1>
            <p>Ubah informasi dan layout foto galeri</p>
        </div>
        <a href="<?= base_url('admin/gallery') ?>" class="btn-header-back">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">

        <!-- Info Card -->
        <div class="info-card">
            <div class="info-card-icon">
                <i class="fas fa-sparkles"></i>
            </div>
            <div class="info-card-content">
                <strong class="info-card-title">Optimasi Gambar Otomatis</strong>
                <p class="info-card-text">Foto akan dioptimalkan secara otomatis menjadi ukuran maksimal 1200x900px dengan kualitas kompresi 85% untuk tampilan galeri yang rapi dan loading cepat.</p>
            </div>
        </div>

        <form action="<?= base_url('admin/gallery/update/' . $gallery['gallery_id']) ?>"
            method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <!-- Section: Informasi Foto -->
            <div class="form-section">
                <div class="form-section-title">Informasi Foto</div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-folder"></i>
                        Nama Album
                    </label>
                    <input type="text"
                        name="album"
                        class="form-control"
                        value="<?= esc($gallery['album']) ?>"
                        placeholder="Contoh: Gunung Merbabu"
                        required>
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-heading"></i>
                        Judul Foto
                    </label>
                    <input type="text"
                        name="title"
                        class="form-control"
                        value="<?= esc($gallery['title']) ?>"
                        placeholder="Masukkan judul foto"
                        required>
                </div>
            </div>

            <hr class="hr-custom">

            <!-- Section: Foto Saat Ini -->
            <div class="form-section">
                <div class="form-section-title">Pratinjau Foto Saat Ini</div>
                <div class="current-photo">
                    <img src="<?= base_url('uploads/gallery/' . esc($gallery['image'])) ?>"
                        alt="Current Photo">
                </div>
            </div>

            <hr class="hr-custom">

            <!-- Section: Ganti & Crop Foto -->
            <div class="form-section">
                <div class="form-section-title">Ganti & Crop Foto</div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-image"></i>
                        Pilih Foto Baru
                    </label>
                    <input type="file"
                        id="imageInput"
                        class="form-control"
                        accept="image/jpeg,image/png,image/webp">
                    <span class="form-text">
                        <i class="fas fa-info-circle"></i>
                        Format: JPG, PNG, WEBP | Maksimal 10 MB
                    </span>
                </div>

                <!-- Crop Section (hidden until image selected) -->
                <div id="cropWrapper" class="hidden">
                    <div class="crop-section">
                        <!-- Crop Area -->
                        <div class="crop-area">
                            <div class="crop-area-title">Atur Crop Area</div>
                            <div class="crop-container">
                                <img id="cropImage" alt="Image to crop">
                            </div>
                        </div>

                        <!-- Preview Sidebar -->
                        <div class="crop-sidebar">
                            <div class="preview-title">Preview Hasil</div>
                            <div class="preview-box" id="previewBox"></div>
                            <button type="button" class="btn-crop" id="cropButton">
                                <i class="fas fa-crop"></i> Apply Crop
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden input for cropped image -->
            <input type="hidden" name="cropped_image" id="croppedImageInput">

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
                <a href="<?= base_url('admin/gallery') ?>" class="btn-secondary-custom">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>

<script>
// ===============================================================
// GALLERY EDIT - Image Crop Handler
// ===============================================================

let cropper = null;
const fileInput = document.getElementById('imageInput');
const cropImage = document.getElementById('cropImage');
const cropWrapper = document.getElementById('cropWrapper');
const previewBox = document.getElementById('previewBox');
const cropButton = document.getElementById('cropButton');
const croppedImageInput = document.getElementById('croppedImageInput');

/**
 * Handle file input change
 */
fileInput.addEventListener('change', function(e) {
    const file = this.files[0];
    if (!file) return;

    // Validate file size
    if (file.size > 10485760) {
        alert('❌ File terlalu besar! Maksimal 10MB');
        this.value = '';
        return;
    }

    // Validate file type
    const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!validTypes.includes(file.type)) {
        alert('❌ Format tidak didukung. Gunakan JPG, PNG, atau WEBP');
        this.value = '';
        return;
    }

    // Load and display image
    const reader = new FileReader();
    reader.onload = function(e) {
        cropImage.src = e.target.result;
        cropWrapper.classList.remove('hidden');
        
        // Reset preview
        previewBox.innerHTML = '';
        croppedImageInput.value = '';

        // Initialize cropper
        initCropper();
    };
    reader.readAsDataURL(file);
});

/**
 * Initialize Cropper.js
 */
function initCropper() {
    // Destroy existing cropper
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }

    // Wait for image to load
    setTimeout(() => {
        try {
            cropper = new Cropper(cropImage, {
                aspectRatio: 4 / 3,
                viewMode: 1,
                autoCropArea: 0.8,
                responsive: true,
                guides: true,
                highlight: true,
                cropBoxMovable: true,
                cropBoxResizable: true,
                preview: '#previewBox'
            });
        } catch (err) {
            console.error('Cropper init error:', err);
            alert('Error initializing crop tool. Please try again.');
        }
    }, 100);
}

/**
 * Apply crop and convert to base64
 */
cropButton.addEventListener('click', function(e) {
    e.preventDefault();

    if (!cropper) {
        alert('⚠️ Silakan pilih gambar terlebih dahulu');
        return;
    }

    try {
        const canvas = cropper.getCroppedCanvas({
            width: 1200,
            height: 900,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });

        canvas.toBlob(function(blob) {
            const reader = new FileReader();
            reader.onload = function(e) {
                croppedImageInput.value = e.target.result;
                alert('✅ Crop berhasil! Klik Simpan untuk menyimpan perubahan');
            };
            reader.readAsDataURL(blob);
        }, 'image/jpeg', 0.85);

    } catch (err) {
        console.error('Crop error:', err);
        alert('❌ Error saat crop: ' + err.message);
    }
});

/**
 * Form submission validation
 */
document.querySelector('form').addEventListener('submit', function(e) {
    // If user selected a new file, they must crop it first
    if (fileInput.files.length > 0 && !croppedImageInput.value) {
        e.preventDefault();
        alert('⚠️ Klik "Apply Crop" terlebih dahulu untuk memproses gambar');
        return false;
    }
});
</script>

<?= $this->endSection() ?>