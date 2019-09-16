<?php
    $iduser = $this->session->userdata("id");
?>
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>


<section class="content">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Horizontal Form</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

    <?=form_open("Welcome/profil","class='form-horizontal'");?>
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Depan" name="nama" value="<?=$user->nama;?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <?=anchor("Welcome","cancel","class='btn btn-default'");?>
        <?=form_submit("btnsubmit", "Simpan", "class='btn btn-success pull-right'");?>
      </div>
      <!-- /.box-footer -->
    <?=form_close();?>
  </div>

</section>