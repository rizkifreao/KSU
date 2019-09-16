<?php
    $iduser = $this->session->userdata("id");
    $user = $this->M_user->getDetail($iduser);
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  
  <li class="<?=($this->uri->segment(1) == 'Workorder')?'active':''?>"><a href="<?=site_url('Workorder')?>"><i class="fa fa-list"></i> Work Order</a></li>
  <li class="<?=($this->uri->segment(1) == 'Faktur')?'active':''?>"><a href="<?=site_url('Faktur')?>"><i class="fa fa-list"></i> Faktur</a></li>
</ul>