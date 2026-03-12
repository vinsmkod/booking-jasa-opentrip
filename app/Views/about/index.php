<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- HERO SECTION -->
<section class="hero-about text-white" style="background: url('<?= base_url('assets/images/about-hero.jpg') ?>') center/cover no-repeat; height: 60vh; display: flex; align-items: center;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold"><?= esc($about['title']) ?></h1>
        <p class="lead mt-3"><?= esc($about['subtitle'] ?? 'Learn more about us') ?></p>
        <a href="#timeline" class="btn btn-primary btn-lg mt-4">Our Journey</a>
    </div>
</section>

<!-- ABOUT CONTENT -->
<section class="about-content py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="fw-bold">Who We Are</h2>
                <p><?= esc($about['content']) ?></p>
            </div>
            <div class="col-md-6">
                <img src="<?= base_url('assets/images/about-team.jpg') ?>" alt="About Us" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- TIMELINE / SEJARAH -->
<section id="timeline" class="timeline py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Our Journey</h2>
        <div class="row">
            <?php foreach ($timeline as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?= esc($item['year']) ?></h5>
                            <p class="card-text"><?= esc($item['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- TEAM / STAFF -->
<section class="team py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Meet Our Team</h2>
        <div class="row">
            <?php foreach ($team as $member): ?>
                <div class="col-md-3 mb-4">
                    <div class="card text-center shadow-sm">
                        <img src="<?= base_url('assets/images/team/'.$member['photo']) ?>" class="card-img-top" alt="<?= esc($member['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($member['name']) ?></h5>
                            <p class="card-text"><?= esc($member['role']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA BUTTON -->
<section class="cta py-5 text-white text-center" style="background: #007bff;">
    <div class="container">
        <h2 class="fw-bold mb-3">Want to Work With Us?</h2>
        <p class="mb-4">Contact us today and let's make something amazing together!</p>
        <a href="<?= base_url('contact') ?>" class="btn btn-light btn-lg">Contact Us</a>
    </div>
</section>

<?= $this->endSection() ?>