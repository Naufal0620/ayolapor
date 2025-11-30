<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title><?= $title ?? 'Petugas AyoLapor' ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/mobile-style.css') ?>">

    <?php
    $ci = &get_instance();
    $current_controller = $ci->uri->segment(1);
    $current_page = $ci->uri->segment(2);
    ?>

    <script>
        let base_url = '<?= base_url() ?>';
        let current_controller = '<?= $current_controller ?>';
        let current_page = '<?= $current_page ?>';
        let loadingIcon = "fas fa-spinner fa-spin";
  </script>
</head>
<body>

    <div class="app-header">
        <h5><?= $header ?? 'AyoLapor' ?></h5>
        <div class="profile-icon">
            <img src="https://ui-avatars.com/api/?name=Petugas+X&background=random" class="rounded-circle" width="35">
        </div>
    </div>

    <div class="container mt-3">
        <?php $this->load->view($content); ?>
    </div>

    <div class="bottom-nav">
        <a href="<?= base_url('petugas/dashboard') ?>" class="nav-item-link <?= ($this->uri->segment(2) == 'dashboard') ? 'active' : '' ?>">
            <i class="fas fa-hammer"></i>
            Tugas
        </a>
        <a href="<?= base_url('petugas/riwayat') ?>" class="nav-item-link <?= ($this->uri->segment(2) == 'riwayat') ? 'active' : '' ?>">
            <i class="fas fa-history"></i>
            Riwayat
        </a>
        <a href="<?= base_url('auth/logout') ?>" class="nav-item-link text-danger">
            <i class="fas fa-sign-out-alt"></i>
            Keluar
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php if(isset($libjs)): ?>
        <script src="<?= base_url('assets/libjs/'.$libjs.'.js?v=" . time() . "') ?>"></script>
    <?php endif; ?>

</body>
</html>