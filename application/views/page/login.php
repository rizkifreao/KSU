<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KSU PAKSI | Log in</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>plugins/iCheck/square/blue.css">
  <!-- Custom -->
  <link rel="stylesheet" href="<?=base_url('extras/');?>custom.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
  .login-page{
        background: #FFF;
  }
  .logo{
    height: 100px;
  }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Koperasi Serba Usaha Paksi</p>

    <?php if($this->session->userdata("error")):?>
    <div class="alert alert-danger" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      Username / Password yang anda masukan salah
    </div>
    <?php 
    $this->session->unset_userdata("error");
    endif; 
    ?>



    <?=form_open("Login/index/","id='loginForm'");?>
      <div class="form-group has-feedback">
        <div class="row">
          <label class="col-md-2">Username</label>
          <div class="col-md-10">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <span class="ikon glyphicon glyphicon-user form-control-feedback"></span>
          </div>
        </div>  
      </div>
      <div class="form-group has-feedback">
        <div class="row">
          <label class="col-md-2">Password</label>
          <div class="col-md-10">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <span class="ikon glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
        </div>  
      </div>
      <div class="row">
        <div class="col-xs-12 text-center">
            <?=form_submit("btnsubmit","Sign in","class='btn btn-primary '");?>
        </div>
        <!-- /.col -->
      </div>

    <?=form_close();?>
















    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="<?=base_url('extras/');?>plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url('extras/');?>bootstrap/js/bootstrap.min.js"></script>
</body>
</html>