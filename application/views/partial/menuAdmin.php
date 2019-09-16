<?php
    $iduser = $this->session->userdata("id");
    $user = $this->M_user->getDetail($iduser);
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="<?=($this->uri->segment(1) == 'WAelcome')?'active':''?>"><a href="<?=site_url('Welcome/da
shboard')?>"><i class="fa fa-home"></i> Dashboard</a></li>
  <!-- <li class="<?=($this->uri->segment(1) == 'Welcome')?'':''?>"><a href="<?=site_url('Welcome/dashboard')?>"><i class="fa fa-list"></i> Dashboard</a></li> -->

  <li class="treeview <?=(
    $this->uri->segment(1) == 'Satuan'
    || $this->uri->segment(1) == 'Item'
    || $this->uri->segment(1) == 'User')?'active':''?>">
    <a href="#">
      <i class="fa fa-gear"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li class="<?=($this->uri->segment(1) == 'Satuan')?'active':''?>"><a href="<?=site_url('Satuan')?>">Satuan</a></li>
      <li class="<?=($this->uri->segment(1) == 'Item')?'active':''?>"><a href="<?=site_url('Item')?>">Data Item</a></li>
      <li class="<?=($this->uri->segment(1) == 'User')?'active':''?>"><a href="<?=site_url('User')?>">User</a></li>
    </ul>
  </li>

  <li class="<?=($this->uri->segment(1) == 'Pembelian Item')?'active':''?>"><a href="<?=site_url('PembelianItem')?>"><i class="fa fa-list"></i> Pembelian Item</a></li>
  <li class="<?=($this->uri->segment(1) == 'Workorder')?'active':''?>"><a href="<?=site_url('Workorder')?>"><i class="fa fa-list"></i> Work Order</a></li>
  <li class="<?=($this->uri->segment(1) == 'Faktur')?'active':''?>"><a href="<?=site_url('Faktur')?>"><i class="fa fa-list"></i> Faktur</a></li>
</ul>