<?php
$rowSatuan = $this->M_mst_satuan->getAll();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Item  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href=""> Item </a></li>
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
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Stok Akhir</th>
              <th>Satuan</th>
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
                <td><?=$row->nama_item;?></td>
                <td><?=($row->stokakhir)?$row->stokakhir:0;?></td>
                <td><?=$this->M_mst_satuan->getDetail($row->satuanid)->nama?></td>
                <td>
                  <!-- <a href="<?=site_url('Item/detail/'.$row->itemid);?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a> -->
                  <a href="" data-id="<?=$row->itemid?>" data-toggle="modal" data-target="#modalForm" onclick="getDetail(this)" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                  <a href="<?=site_url('Item/delete/'.$row->itemid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
      <?=form_open("Item/add","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Nama Item</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" id="itemid" placeholder="itemid" name="itemid" value="">
                    <input type="text" class="form-control" id="nama_item" placeholder="Masukan Nama Item" name="nama_item" value="" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Satuan</label>
                  <div class="col-sm-8">
                    <select name="satuanid" id="satuanid" class="form-control custom-select" required>
                    <option value="">- Pilih Satuan -</option>
                      <?php foreach ($rowSatuan as $key ) :?>
                      <option value="<?=$key->satuanid ?>"><?= $key->nama ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div> 
                <!-- <div class="form-group">
                  <label for="qty" class="col-sm-4 control-label">Harga Jual</label>
                  <div class="col-sm-8">
                    <input type="number" min="1" class="form-control" id="hargajual" placeholder="Masukan harga" name="hargajual" value="" required>
                  </div>
                </div>    -->
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
    $('#satuanid').select2();
});
  function getDetail(ini) {
    var id = $(ini).attr('data-id');
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>Item/detailJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          // console.log(data);
         $('#itemid').val(id).hide();
         $('#nama_item').val(data.nama_item);
         $('#satuanid').val(data.satuanid);
        }
    });
  }

  function clearForm() {  	
     $('#itemid').val("");
     $('#nama').val("");
     $('#satuanid').val("");
  }
</script>