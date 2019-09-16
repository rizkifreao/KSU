<?php
    $iduser = $this->session->userdata("id");
    $user = $this->M_user->getDetail($iduser);
?>
<ul class="nav navbar-nav">
  <!-- Messages: style can be found in dropdown.less-->
  <!-- User Account: style can be found in dropdown.less -->
  <li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <img src="<?=base_url('extras/');?>dist/img/avatar5.png" class="user-image" alt="User Image">
      <span class="hidden-xs"><?=$user->nama;?></span>
    </a>
    <ul class="dropdown-menu">
      <!-- User image -->
      <li class="user-header">
        <img src="<?=base_url('extras/');?>dist/img/avatar5.png" class="img-circle" alt="User Image">

        <p>
          <?=$user->nama;?>
        </p>
      </li>
      <!-- Menu Footer-->
      <li class="user-footer">
        <div class="pull-left">
          <a href="<?=($user->jabatan == '1') ? site_url("Welcome/profil") : site_url("Welcome/profil");?>" class="btn btn-default btn-flat">Profile</a>
        </div>
        <div class="pull-right">
          <a href="<?=site_url("Login/logout");?>" class="btn btn-default btn-flat">Sign out</a>
        </div>
      </li>
    </ul>
  </li>
</ul>

