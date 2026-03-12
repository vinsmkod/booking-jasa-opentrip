<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container py-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold">Dokumentasi Gunung</h2>
        <p class="text-muted">Galeri perjalanan dan pengalaman trip</p>
    </div>

    <div class="row g-4">

        <?php if(!empty($galleryPhotos)): ?>
            <?php foreach($galleryPhotos as $index => $photo): ?>

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm h-100 gallery-card">

                        <div class="overflow-hidden">

                            <img src="<?= base_url('uploads/gallery/'.$photo['image']) ?>"
                                 class="card-img-top gallery-img"
                                 data-bs-toggle="modal"
                                 data-bs-target="#preview<?= $index ?>"
                                 alt="<?= esc($photo['title']) ?>">

                        </div>

                        <div class="card-body text-center">

                            <h5 class="card-title fw-semibold">
                                <?= esc($photo['title']) ?>
                            </h5>

                            <?php if(isset($photo['created_at'])): ?>
                                <small class="text-muted">
                                    <?= date('d M Y', strtotime($photo['created_at'])) ?>
                                </small>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>


                <!-- Modal Preview -->

                <div class="modal fade" id="preview<?= $index ?>" tabindex="-1">

                    <div class="modal-dialog modal-lg modal-dialog-centered">

                        <div class="modal-content border-0">

                            <div class="modal-body p-0">

                                <img src="<?= base_url('uploads/gallery/'.$photo['image']) ?>"
                                     class="img-fluid w-100">

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12 text-center">

                <div class="alert alert-light border">
                    Belum ada foto galeri.
                </div>

            </div>

        <?php endif; ?>

    </div>

</div>


<style>

.gallery-img{
height:250px;
object-fit:cover;
cursor:pointer;
transition: transform .4s ease;
}

.gallery-card:hover .gallery-img{
transform: scale(1.08);
}

.gallery-card{
transition: all .3s ease;
}

.gallery-card:hover{
transform: translateY(-5px);
box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

</style>

<?= $this->endSection() ?>