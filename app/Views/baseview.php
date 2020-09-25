<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>miniPOS - <?= (SEG1) ? ucfirst(SEG1) : "Home"; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/dist/css/adminlte.min.css">
  <!-- Page style -->
  <?= $this->renderSection('style') ?>
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="javascript:;" id="logout" role="button"><i class="fas fa-power-off"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/" class="brand-link">
        <img src="<?= base_url(); ?>/public/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">miniPOS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url(); ?>/public/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Mang Oleh</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?= base_url(); ?>" class="nav-link <?= (SEG1) ? '' : 'active'; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-header">Master Data</li>
            <li class="nav-item has-treeview <?= (SEG1 == 'users') ? 'menu-open' : ''; ?>">
              <a href="#" class="nav-link <?= (SEG1 == 'users') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  User
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url(); ?>/users/level" class="nav-link <?= (SEG1 == 'users' && SEG2) ? 'active' : ''; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level User</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url(); ?>/users" class="nav-link <?= (SEG1 == 'users' && !SEG2) ? 'active' : ''; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data User</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview <?= (SEG1 == 'products') ? 'menu-open' : ''; ?>">
              <a href="#" class="nav-link <?= (SEG1 == 'products') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-box"></i>
                <p>
                  Produk
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url(); ?>/products/category" class="nav-link <?= (SEG1 == 'products' && SEG2) ? 'active' : ''; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori Produk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url(); ?>/products" class="nav-link <?= (SEG1 == 'products' && !SEG2) ? 'active' : ''; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Produk</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">Transaksi</li>
            <li class="nav-item">
              <a href="/purchase" class="nav-link">
                <i class="nav-icon fas fa-truck"></i>
                <p>Barang Masuk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sales" class="nav-link">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>Barang Keluar</p>
              </a>
            </li>
            <li class="nav-header">Lain - Lain</li>
            <li class="nav-item">
              <a href="/logsys" class="nav-link">
                <i class="fas fa-history nav-icon"></i>
                <p>Log System</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
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
              <h1 class="m-0 text-dark"><?= $pageTitle; ?></h1>
            </div><!-- /.col -->
            <!-- <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v2</li>
              </ol>
            </div> -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?= $this->renderSection('content') ?>
        </div>
        <!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <input type="hidden" id="base_url" value="<?= base_url(); ?>">
    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        Page rendered in {elapsed_time} seconds
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="<?= base_url(); ?>/public/assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?= base_url(); ?>/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url(); ?>/public/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url(); ?>/public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url(); ?>/public/assets/dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="<?= base_url(); ?>/public/assets/dist/js/demo.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="<?= base_url(); ?>/public/assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="<?= base_url(); ?>/public/assets/plugins/raphael/raphael.min.js"></script>
  <script src="<?= base_url(); ?>/public/assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="<?= base_url(); ?>/public/assets/plugins/jquery-mapael/maps/indonesia.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url(); ?>/public/assets/plugins/chart.js/Chart.min.js"></script>

  <!-- PAGE SCRIPTS -->
  <script src="<?= base_url(); ?>/public/assets/dist/js/pages/dashboard2.js"></script>
  <script src="<?= base_url(); ?>/public/assets/module/base.min.js"></script>
  <?= $this->renderSection('script') ?>
</body>

</html>