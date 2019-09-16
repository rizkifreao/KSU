<?php
$Items = $this->M_item->getAll();
// $rowMstFeedback = $this->M_mst_feedback->getAll();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Faktur Detail  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?=site_url('Faktur');?>"> Faktur </a></li>
    <li><a href=""> Faktur #<?=$data->nomorfaktur?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="pull-right">
            
              <a href="<?=site_url("Cetak/faktur/$data->woid")?>" class="btn btn-success"><i class="fa fa-print"></i></a>
            
              <!-- <a href="" class="btn btn-success" data-toggle="modal" data-target="#modalFeedback"><i class="fa fa-print"></i></a> -->
            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row form-horizontal">
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=$rowWo->nama?>" disabled="">
                  </div>
                </div>        
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">No Order</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=$rowWo->nomor?>" disabled="">
                  </div>
                </div>   
              </div> 
              <div class="col-md-6"> 
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-8">
                    <textarea type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="" disabled=""><?=$rowWo->keterangan?></textarea>
                  </div>
                </div>          
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Tanggal Pengambilan</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?=$rowWo->tanggal_keluar?>" disabled="">
                  </div>
                </div>        
              </div>        
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Detail Item
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Item</th>
              <th>Jumlah</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowDetailWo as $row) :
              ?>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$this->M_item->getDetail($row->itemid)->nama_item;?></td>
                <td><?=$row->qty;?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <!-- /.col -->
    
<!--     <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Feedback
          </h3>
        </div>
        <div class="box-body">
          <table id="" class="example2 table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Pertanyaan</th>
              <th>NIlai</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowFeedback as $row) :
              ?>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$this->M_mst_feedback->getDetail($row->mstfeedbackid)->pertanyaan;?></td>
                <td><?=$row->nilai;?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
    </div> -->

    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->



<!-- Modal -->