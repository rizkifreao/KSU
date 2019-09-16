<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Faktur  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href=""> Faktur </a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Tabel Data
          </h3>
          <div class="pull-right">
            <a href="<?=site_url("Cetak/laporanfaktur")?>" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Nomor Faktur</th>
              <th>Nomor Order</th>
              <th>Atas Nama</th>
              <th>Tanggal Faktur</th>
              <!-- <th>Tanggal Cetak</th> -->
              <!-- <th>Total</th> -->
              <th>action</th>
            </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rowData as $row) :
              ?>
              <tr>
                <td><?=$no++;?></td>
                <td><?=$row->nomorfaktur;?></td>
                <td><?=$this->M_workorder->getDetail($row->woid)->nomor;?></td>
                <td><?=$this->M_workorder->getDetail($row->woid)->nama;?></td>
                <td><?=date("d-m-Y",strtotime($row->tanggal_faktur));?></td>
                <!-- <td><?=($row->tanggal_cetak)?date("d-m-Y",strtotime($row->tanggal_cetak)):"-";?></td> -->
                <!-- <td><?=number_format($row->total,0,",",".");?></td> -->
                <td>
                  <a href="<?=site_url('Faktur/detail/'.$row->woid);?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                </td>
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
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <?=form_open("Workorder/add","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">                
                <div class="form-group">
                  <label for="nomor" class="col-sm-4 control-label">Nomor Workorder</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" id="workorderid" placeholder="workorderid" name="workorderid" value="">
                    <input type="text" class="form-control" id="nomor" placeholder="nomor" name="nomor" value="">
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label for="pelangganid" class="col-sm-4 control-label">Pelanggan</label>
                  <div class="col-sm-8">
                      <select name="pelangganid" id="pelangganid" required class="form-control">
                        <option value="">- Pelanggan -</option>
                        <?php foreach($rowPelanggan as $pelanggan):?>
                        <option value="<?=$pelanggan->pelangganid?>" ><?=$pelanggan->nama_pemilik?></option>
                        <?php endforeach;?>
                      </select>
                  </div>
                </div>     -->
                <div class="form-group">
                  <label for="tanggal_masuk" class="col-sm-4 control-label">Tanggal Masuk</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="tanggal_masuk" placeholder="tanggal_masuk" name="tanggal_masuk" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="keluhan" class="col-sm-4 control-label">Keluhan</label>
                  <div class="col-sm-8">
                    <textarea type="text" class="form-control" id="keluhan" placeholder="keluhan" name="keluhan" value=""></textarea>
                  </div>
                </div>
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
         $('#pelangganid').val(data.pelangganid);
         $('#tanggal_masuk').val(data.tanggal_masuk);
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