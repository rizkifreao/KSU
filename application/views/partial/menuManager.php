<?php
    $iduser = $this->session->userdata("id");
    $user = $this->M_user->getDetail($iduser);
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="<?=($this->uri->segment(1) == 'TugasAkhir')?'active':''?>"><a href="<?=site_url('Welcome/da
shboard')?>"><i class="fa fa-home"></i> Dashboard</a></li>
</ul>