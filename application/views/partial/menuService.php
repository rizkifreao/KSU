<?php
    $iduser = $this->session->userdata("id");
    $user = $this->M_user->getDetail($iduser);
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="<?=($this->uri->segment(1) == 'Pelanggan')?'active':''?>"><a href="<?=site_url('Pelanggan')?>"><i class="fa fa-list"></i> Pelanggan</a></li>
  <li class="<?=($this->uri->segment(1) == 'Workorder')?'active':''?>"><a href="<?=site_url('Workorder')?>"><i class="fa fa-list"></i> Work Order</a></li>
</ul>