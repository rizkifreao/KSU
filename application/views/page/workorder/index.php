<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Pengeluaran Item  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href=""> Pengeluaran item </a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title">
            Order Baru
          </h3>
          <div class="pull-right">
            <a href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalForm" onclick="clearForm()"><i class="fa fa-plus"></i> Tambah Data</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="" class="example0 table table-bordered table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Nomor Order</th>
              <th>Tanggal Keluar</th>
              <!-- <th>Tanggal Keluar</th> -->
              <th>Atas Nama</th>
              <!-- <th>Mekanik</th> -->
              <th>Keterangan</th>
              <th>action</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowData as $row) :
                if($row->status == ""):
              ?>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$row->nomor;?></td>
                <td><?=date("d-m-Y H:i:s",strtotime($row->tanggal_keluar));?></td>
                <!-- <td><?=($row->tanggal_keluar)?date("d-m-Y H:i:s",strtotime($row->tanggal_keluar)):"-";?></td> -->
                <td><?=$row->nama;?></td>
                <!-- <td><?=$this->M_user->getDetail($row->userid)->nama;?></td> -->
                <td><?=$row->keterangan;?></td>
                <td>
                  <a href="<?=site_url('Workorder/detail/'.$row->workorderid);?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                  <a href="" data-id="<?=$row->workorderid?>" data-toggle="modal" data-target="#modalForm" onclick="getDetail(this)" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                  <a href="<?=site_url('Workorder/delete/'.$row->workorderid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <?php 
                endif;
              endforeach;?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">
            Order Selesai
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="" class="example0 table table-bordered table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Nomor Order</th>
              <!-- <th>Tanggal Masuk</th> -->
              <th>Tanggal Keluar</th>
              <!-- <th>Keluhan</th> -->
              <th>Penerima</th>
              <th>Keterangan</th>
              <th>action</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowData as $row) :
                if($row->status == "F"):
              ?>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$row->nomor;?></td>
                <!-- <td><?=date("d-m-Y H:i:s",strtotime($row->tanggal_masuk));?></td> -->
                <td><?=($row->tanggal_keluar)?date("d-m-Y H:i:s",strtotime($row->tanggal_keluar)):"-";?></td>
                <!-- <td><?=$row->keluhan;?></td> -->
                <td><?=$row->nama;?></td>
                <td><?=$row->keterangan;?></td>
                <td>
                  <a href="<?=site_url('Faktur/detail/'.$row->workorderid);?>" class="btn btn-xs btn-info">FAKTUR <i class="fa fa-forward"></i></a>
                </td>
              </tr>
              <?php 
                endif;
              endforeach;?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">
            Order Batal
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="" class="example0 table table-bordered table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Nomor Order</th>
              <!-- <th>Tanggal Masuk</th> -->
              <th>Tanggal Keluar</th>
              <th>Penerima</th>
              <!-- <th>Mekanik</th> -->
              <th>Keterangan</th>
              <th>action</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowData as $row) :
                if($row->status == "NF"):
              ?>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$row->nomor;?></td>
                <!-- <td><?=date("d-m-Y H:i:s",strtotime($row->tanggal_masuk));?></td> -->
                <td><?=($row->tanggal_keluar)?date("d-m-Y H:i:s",strtotime($row->tanggal_keluar)):"-";?></td>
                <td><?=$row->nama;?></td>
                <!-- <td><?=$this->M_user->getDetail($row->userid)->nama;?></td> -->
                <td><?=$row->keterangan;?></td>
                <td>
                  <a href="<?=site_url('Workorder/detail/'.$row->workorderid);?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>                  
                </td>
              </tr>
              <?php 
                endif;
              endforeach;?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->






<!-- Modal -->
<div id="modalForm" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pengeluaran Barang</h4>
      </div>
      <?=form_open("Workorder/add","class='form-horizontal'");
      ?>
      <input type="hidden" class="form-control" id="workorderid" placeholder="workorderid" name="workorderid" value="">
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">                
                <div class="form-group">
                  <label for="nomor" class="col-sm-4 control-label">Nomor Order</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nomor" placeholder="nomor" value="" readonly>
                  </div>
                </div>
      
                <div class="form-group">
                  <label for="keluhan" class="col-sm-4 control-label">Atas Nama</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" placeholder="Masukan Nama" name="nama" value="" required>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label for="keluhan" class="col-sm-4 control-label">Keluhan</label>
                  <div class="col-sm-8">
                    <textarea type="text" class="form-control" id="keluhan" placeholder="keluhan" name="keluhan" value=""></textarea>
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="keterangan" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-8">
                    <textarea type="text" class="form-control" id="keterangan" placeholder="keterangan" name="keterangan" value=""></textarea>
                  </div>
                </div>            
              </div>        
            </div>
          </div>
          <!-- /.box-footer -->
      </div>
      <div class="modal-footer">
        <?=form_submit("btnsubmit", "save","class='btn btn-success'");?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <?=form_close();?>
    </div>

  </div>
</div>


<script>
  function getDetail(ini) {
    var id = $(ini).attr('data-id');
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>Workorder/detailJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#workorderid').val(id).hide();
         $('#nomor').val(data.nomor);
         $('#nama').val(data.nama);
         $('#keterangan').val(data.keterangan);
         $('#keluhan').val(data.keluhan);
        }
    });
  }

  function clearForm() {  	
     $('#workorderid').val("");
     $('#nomor').val("");
     $('#pelangganid').val("");
     $('#tanggal_masuk').val("");
     $('#keterangan').val("");
     $('#keluhan').val("");
  }
</script>