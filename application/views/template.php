<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?></title>
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= base_url() ?>assets/dist/img/logo-retina.png" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- Chart.js -->
  <link rel="stylesheet" href="<?= base_url("") ?>/assets/plugins/chart.js/Chart.min.css">
  <!-- DataTables Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url("") ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- OverlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url("") ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- SweetAlert2 Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url("") ?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url("") ?>/assets/plugins/toastr/toastr.min.css">
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

<style>
  .user-panel img {
    object-fit: cover;
    object-position: center;
    width: 2.1rem;
    max-height: 2.1rem;
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
          <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger text-white nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i> Keluar
          </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">NGELAPOR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar h-100 overflow-auto">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $this->session->userdata("photo") ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $this->session->userdata("nama") ?></a>
            </div>
        </div>
        <?php $this->load->view($sidebar); ?>
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $header ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
              <li class="breadcrumb-item active"><?= $header ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php $this->load->view($content); ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">

    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2025-2026 <a href="http://localhost/ngelapor">Ngelapor</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- JQuery -->
<script src="<?= base_url("") ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- JQuery UI -->
<script src="<?= base_url("") ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap JS -->
<script src="<?= base_url("") ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js -->
<script src="<?= base_url("") ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url("") ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- DataTables Bootstrap 4 -->
<script src="<?= base_url("") ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- OverlayScrollbars -->
<script src="<?= base_url("") ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url("") ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url("") ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url("") ?>assets/dist/js/adminlte.min.js"></script>
<!-- Utility -->
<script src="<?= base_url("") ?>assets/dist/js/utility.js"></script>
<!-- Libjs -->
<?php if (isset($libjs) && !empty($libjs)) {
	echo "<script src='" . base_url() . "assets/libjs/$libjs.js?v=" . time() . "'></script>";
} ?>
</body>
</html>
