<?php
    $iduser = $this->session->userdata("id");
    $user = $this->M_user->getDetail($iduser);
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  
  <li class="<?=($this->uri->segment(1) == 'PembelianSparepart')?'active':''?>"><a href="<?=site_url('PembelianSparepart')?>"><i class="fa fa-list"></i> Pembelian Spare Part</a></li>
  <li class="<?=($this->uri->segment(1) == 'Forecast')?'active':''?>"><a href="<?=site_url('Forecast')?>"><i class="fa fa-magic"></i> Forecast</a></li>
</ul>