<?php
$rowItem = $this->M_item->getAll();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Pembelian Item  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?=site_url('PembelianItem');?>"> Pembelian Item </a></li>
    <li><a href=""> Pembelian Item #<?=$data->pembelianid?></a></li>
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
            <a href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalForm" onclick="clearForm()"><i class="fa fa-plus"></i> Tambah Data</a>
            <a href="<?=site_url("Cetak/pembelian/$data->pembelianid")?>" class="btn btn-xs btn-success"><i class="fa fa-print"></i> Print</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Item</th>
              <th>Harga Satuan</th>
              <th>Jumlah</th>
              <th>Total</th>
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
                <td><?=$this->M_item->getDetail($row->itemid)->nama_item;?></td>
                <td><?=$row->hargasatuan;?></td>
                <td><?=$row->jumlah;?></td>
                <td><?=$row->total;?></td>
                <td>
                  <a href="<?=site_url('PembelianItem/deleteDetail/'.$row->pembeliandetailid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title">Tambah Data Pembelian</h4>
      </div>
      <?=form_open("PembelianItem/addDetail","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="tanggal" class="col-sm-4 control-label">Item</label>
                  <input type="hidden" class="form-control" placeholder="pembelianid" name="pembelianid" value="<?=$data->pembelianid?>">
                  <div class="col-sm-8">
	                  <select name="itemid" id="itemid" required class="custom-select" required>
	                    <option value="">- Pilih Item -</option>
	                    <?php foreach($rowItem as $item):?>
	                    <option value="<?=$item->itemid?>" ><?=$item->nama_item?></option>
	                    <?php endforeach;?>
	                  </select>
                  </div>
                </div>   
                <div class="form-group">
                  <label for="hargasatuan" class="col-sm-4 control-label">Harga Satuan</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="hargasatuan" placeholder="harga satuan" name="hargasatuan" value="" min="1" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="jumlah" class="col-sm-4 control-label">Jumlah</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="jumlah" placeholder="harga satuan" name="jumlah" value="" min="1" required>
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
  $(document).ready(function() {
    $('#itemid').select2();
});
  function getDetail(ini) {
    var id = $(ini).attr('data-id');
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>PembelianItem/detailJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#pembelianid').val(id).hide();
         $('#tanggal').val(data.tanggal);
        }
    });
  }

  function clearForm() {  	
     $('#pembelianid').val("");
     $('#tanggal').val("");
  }
</script>