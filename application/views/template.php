<?php
    $iduser = $this->session->userdata("id");
    $user = $this->M_user->getDetail($iduser);
    $sitename = $this->config->item("SITENAME");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$sitename?> | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>plugins/datatables/dataTables.bootstrap.css">
  <!-- Custom -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>custom.css">

<style>
  @media print {
  body * {
    visibility: hidden;
  }
  .section-to-print, .section-to-print * {
    visibility: visible;
  }
  .not-to-print, .not-to-print * {
    visibility: hidden;
  }
 
  .section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
  
}
</style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- jQuery 2.2.0 -->
    <script src="<?=base_url('extras/');?>plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?=base_url('extras/');?>dist/js/jquery-ui.min.js"></script>
</head>
<body class="sidebar-mini skin-purple-light">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=site_url('');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">SITA</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?=$sitename?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <!-- begin header nav -->
        <?php $this->load->view("partial/headermenu");?>
        <!-- end header nav --> 
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- begin sidebar nav -->

        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?=base_url('extras/');?>dist/img/avatar5.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?=$user->nama?></p>
          </div>
        </div>

        <?php 
        if($user->jabatan == "Administrator")
          $this->load->view("partial/menuAdmin");
        if($user->jabatan == "Kasir")
          $this->load->view("partial/menuKasir");
        if($user->jabatan == "Manager")
          $this->load->view("partial/menuManager");
        if($user->jabatan == "Kepala Gudang")
          $this->load->view("partial/menuGudang");
        if($user->jabatan == "Service Advisor")
          $this->load->view("partial/menuService");
        ?>
        <!-- end sidebar nav --> 
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <?php $this->load->view("page/".$konten);?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.3
    </div>
    <strong>Copyright &copy; 2017.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url('extras/');?>bootstrap/js/bootstrap.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url('extras/');?>plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url('extras/');?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url('extras/');?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url('extras/');?>plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url('extras/');?>dist/js/moment.min.js"></script>
<script src="<?=base_url('extras/');?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=base_url('extras/');?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url('extras/');?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url('extras/');?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url('extras/');?>plugins/fastclick/fastclick.js"></script>
<!-- DataTables -->
<script src="<?=base_url('extras/');?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('extras/');?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('extras/');?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('extras/');?>dist/js/demo.js"></script>

<!-- page script -->
<script>
  $(function () {
    
    $("#example1").DataTable();
    $(".example0").DataTable();
    
    $('.example11').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": true,
    });
    
    $('.example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "lengthMenu": [[5, 10, -1], [5, 10, "All"]]
    });
    
    $('.exampleJual').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "lengthMenu": [[1, 10, -1]]
    });

    $('.textarea').wysihtml5();

  });

</script>

</body>
</html>