<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'BLNTRK OUTDOOR') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }

        body {
            background-color: #f5f6f8;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        .card-trip {
            border: none;
            border-radius: 12px;
            transition: 0.2s ease;
        }

        .card-trip:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 600;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }

        footer a {
            color: #fff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<?= $this->include('layouts/navbar') ?>

<!-- Main Content -->
<div class="container mt-4 main-content">
    <?= $this->renderSection('content') ?? '' ?>
</div>

<!-- Footer -->
<footer class="mt-auto">
    <div class="container text-center">
        <p class="mb-1">© <?= date('Y') ?> BLNTRK OUTDOOR. All rights reserved.</p>
        <p>
            <a href="<?= base_url('about') ?>">About</a> |
            <a href="<?= base_url('contact') ?>">Contact</a> |
            <a href="<?= base_url('privacy') ?>">Privacy Policy</a>
        </p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> 