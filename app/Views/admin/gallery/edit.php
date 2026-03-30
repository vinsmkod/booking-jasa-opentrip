<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet">

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

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- Informasi Optimasi Gambar -->
            <div class="alert alert-info mb-4">
                <i class="fas fa-info-circle"></i>
                <strong>Optimasi Gambar:</strong> Foto akan dioptimalkan secara otomatis menjadi ukuran maksimal 1200x1200px untuk tampilan galeri yang rapi dan cepat loading.
            </div>

            <form action="<?= base_url('admin/gallery/update/' . $gallery['gallery_id']) ?>"
                method="post"
                enctype="multipart/form-data">

                <?= csrf_field() ?>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Nama Album</label>
                    <input type="text"
                        name="album"
                        class="form-control"
                        value="<?= esc($gallery['album']) ?>"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Judul Foto</label>
                    <input type="text"
                        name="title"
                        class="form-control"
                        value="<?= esc($gallery['title']) ?>"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                    <div class="text-center">
                        <img src="<?= base_url('uploads/gallery/' . $gallery['image']) ?>"
                            class="img-preview-current"
                            alt="Current Photo">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Ganti Foto</label>
                    <input type="file"
                        id="imageInput"
                        class="form-control"
                        accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, WEBP | Maksimal 10 MB</small>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="crop-container">
                            <img id="cropImage">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="preview-box">
                            <h6>Preview</h6>
                            <div class="img-preview"></div>
                            <small class="text-muted d-block mt-2">Hasil crop akan dioptimalkan ke ukuran 1200x1200px</small>
                        </div>

                        <button type="button"
                            class="btn btn-success w-100 mt-3"
                            onclick="cropImage()">
                            <i class="fas fa-crop"></i> Crop & Optimasi Foto
                        </button>
                    </div>
                </div>

                <input type="hidden" name="cropped_image" id="cropped_image">

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4" id="submitBtn">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('admin/gallery') ?>" class="btn btn-outline-secondary px-4 ms-2">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<style>
    .img-preview-current {
        max-width: 100%;
        height: 300px;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .crop-container {
        width: 100%;
        max-height: 450px;
        overflow: hidden;
        border-radius: 10px;
        background: #f8f9fa;
    }

    .crop-container img {
        max-width: 100%;
    }

    .preview-box {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #dee2e6;
    }

    .preview-box h6 {
        margin-bottom: 10px;
        font-weight: 600;
    }

    .img-preview {
        width: 100%;
        height: 200px;
        overflow: hidden;
        border-radius: 10px;
        background: #fff;
    }

    .img-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .alert-info {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdef5 100%);
        border: none;
        border-radius: 12px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>

<script>
    let cropper;
    const image = document.getElementById('cropImage');

    document.getElementById('imageInput').addEventListener('change', function(e) {
        const files = e.target.files;

        if (files && files.length > 0) {
            const file = files[0];

            // Validasi ukuran file
            if (file.size > 10485760) {
                alert('Ukuran file terlalu besar! Maksimal 10 MB.');
                this.value = '';
                return;
            }

            // Validasi tipe file
            const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung! Gunakan JPG, PNG, atau WEBP.');
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                image.src = e.target.result;

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(image, {
                    aspectRatio: 4 / 3,
                    viewMode: 1,
                    preview: '.img-preview',
                    autoCropArea: 1,
                    responsive: true,
                    minCropBoxWidth: 300,
                    minCropBoxHeight: 300,
                    guides: true,
                    center: true,
                    highlight: true,
                    background: false,
                });
            }

            reader.readAsDataURL(file);
        }
    });

    function cropImage() {
        if (!cropper) {
            alert('Pilih gambar terlebih dahulu');
            return;
        }

        // Tampilkan loading
        const cropBtn = document.querySelector('.btn-success');
        const originalText = cropBtn.innerHTML;
        cropBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        cropBtn.disabled = true;

        setTimeout(() => {
            try {
                // Mendapatkan hasil crop dengan ukuran optimal untuk galeri
                const canvas = cropper.getCroppedCanvas({
                    width: 1200,
                    height: 900
                });

                // Konversi ke base64 dengan kualitas 85%
                const croppedImageData = canvas.toDataURL('image/jpeg', 0.85);
                document.getElementById('cropped_image').value = croppedImageData;

                // Preview hasil crop
                const previewDiv = document.querySelector('.img-preview');
                previewDiv.innerHTML = `<img src="${croppedImageData}" style="width:100%; height:100%; object-fit:cover;">`;

                alert('Foto berhasil di-crop dan akan dioptimalkan!');
            } catch (error) {
                alert('Terjadi kesalahan saat memproses gambar');
                console.error(error);
            } finally {
                cropBtn.innerHTML = originalText;
                cropBtn.disabled = false;
            }
        }, 100);
    }

    // Loading saat submit form
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        submitBtn.disabled = true;

        // Form akan submit, loading hanya untuk feedback
        setTimeout(() => {
            // Ini hanya fallback jika submit terlalu lama
        }, 1000);
    });
</script>

<?= $this->endSection() ?>