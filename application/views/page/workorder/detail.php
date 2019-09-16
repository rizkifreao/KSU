<?php
// $rowPelayanan = $this->M_mst_pelayanan->getAll();
$Items = $this->M_item->getAll();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Pembelian Item  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?=site_url('Workorder');?>"> Workorder </a></li>
    <li><a href=""> Workorder #<?=$data->nomor?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="pull-right">
            <a href="<?=site_url("Cetak/workorder/$data->workorderid")?>" class="btn btn-success"><i class="fa fa-print"></i></a>
          </div>
        </div>
        <div class="box-header">
        <?php if($this->session->flashdata("warning")): ?>
          <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <?=$this->session->flashdata("warning")?>
            </div>
          </div>
        <?php endif; ?>

        <?php if(!$data->status): ?>
          <div class="col-md-12">
            <div class="text-center">
              <a href="<?=site_url('Workorder/batal/').$data->workorderid;?>" class="btn btn-danger">BATAL</a>
              <!-- <a href="<?=site_url('Workorder/save/').$data->workorderid;?>" class="btn btn-success">SELESAI</a> -->
              <a href="" data-toggle="modal" data-target="#modalEnd"  class="btn btn-success">SELESAI</a>
            </div>
          </div>
        <?php endif; ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row form-horizontal">
              <div class="col-md-6">            

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
              <th>Nama Item</th>
              <th>Satuan</th>
              <th>Jumlah</th>
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
                <td><?=$this->M_item->getDetail($row->itemid)->nama_item;?></td>
                <td><?=$this->M_mst_satuan->getDetail($this->M_item->getDetail($row->itemid)->satuanid)->nama;?></td>
                <td><?=$row->qty;?></td>
                <!-- <td><?=$row->total;?></td> -->
                <td>
                  <a href="" data-id="<?=$row->detailwoid?>" data-toggle="modal" title="Ubah" data-target="#modalEditForm" onclick="editDetail(this)" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                  <a href="<?=site_url('Workorder/deleteDetail/'.$row->detailwoid);?>" title="Hapus" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
      <?=form_open("Workorder/addDetail","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="tanggal" class="col-sm-4 control-label">Item</label>
                  <input type="hidden" class="form-control" placeholder="workorderid" name="workorderid" value="<?=$data->workorderid;?>">
                  <div class="col-sm-8">
	                  <select name="itemID" id="itemID" required class="form-control" onchange="getDetail(this)" data-pelangganid="<?=$data->pelangganid;?>">
	                    <option value="">- Pilih Item -</option>
	                    <?php foreach($Items as $item):?>
	                    <option value="<?=$item->itemid?>" ><?=$item->nama_item?></option>
	                    <?php endforeach;?>
	                  </select>
                  </div>
                </div>   
                <div class="form-group text-center showGagal" hidden="">
                  <i class="text-danger">- Stok item kosong atau habis -</i>
                </div>   
                <div class="form-group showSukses" hidden="">
                  <label for="qty" class="col-sm-4 control-label">Stok</label>
                  <div class="col-sm-8 menusparepart has-success">
                  </div>
                </div>
                <div class="form-group showSukses" hidden="">
                  <label for="qty" class="col-sm-4 control-label">Satuan</label>
                  <div class="col-sm-8 satuan">
                  </div>
                </div>  
                <div class="form-group showSukses" hidden="">
                  <label for="qty" class="col-sm-4 control-label">Jumlah</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="qty" min="1" placeholder="jumlah" name="qty" value="" required>
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

<div id="modalEditForm" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal Edit content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ubah Data</h4>
      </div>
      <?=form_open("Workorder/editDetail","class='form-horizontal'");
      ?>
      <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="nama_item" class="col-sm-4 control-label">Nama Item</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_item" value="" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="qty" class="col-sm-4 control-label">Stok</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="itemid" name="itemid" value="">
                    <input type="text" class="form-control" id="detailwoid" name="detailwoid" value="">
                    <input type="text" class="form-control" id="workorderid" name="workorderid" value="">
                    <input type="text" class="form-control" id="stok" value="" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="qty" class="col-sm-4 control-label">Satuan</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="satuan" placeholder="Satuan" value="" readonly>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="qty" class="col-sm-4 control-label">Jumlah</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="jumlah" min="1" placeholder="jumlah" name="qty" value="">
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

<!-- Modal -->
<div id="modalEnd" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Faktur</h4>
      </div>
      <?=form_open("Workorder/save/$data->workorderid","class='form-horizontal'");
      ?>
      <input type="hidden" class="form-control" placeholder="workorderid" name="workorderid" value="<?php echo $data->workorderid;?>">
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nomorfaktur" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="nomorfaktur" placeholder="nomor faktur" name="tanggal" value="">
                  </div>
                </div> 
              </div>      
            </div>
          </div>
          <!-- /.box-footer -->
      </div>
      <div class="modal-footer">
        <?=form_submit("btnsubmit", "CETAK","class='btn btn-success'");?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <?=form_close();?>
    </div>

  </div>
</div>


<script>
  function getDetail(ini) {
    var pelangganid = $(ini).attr('data-pelangganid');
    var id = $('#itemID').val();
    clearForm();
    $.ajax({
      type: 'GET',
      url: "<?=base_url('');?>Item/detailJson/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          // console.log(data);
          if(data.stokakhir > 0 ){
            $(".showSukses").show();

              if(data.stokakhir < 0){
                var li = $("<div class='radio disabled'><label class='text-danger'><input disabled type='radio' name='itemid' value='"+data.itemid+"'>"+data.nama+" ("+data.stokakhir+" tersedia)</label></div>");
              }else{
                // var li = $("<label><input type='text' name='itemid' value='"+data.itemid+"'>"+data.nama_item+" ("+data.stokakhir+" tersedia)</label>");
                var li = $(`
                    <input type="hidden" class="form-control" id="itemid" name="itemid" value="`+data.itemid+`">
                    <input type="text" class="form-control" value="`+data.stokakhir+` (tersedia)" readonly>
                `);

                var satuan = $(
                  `<input type="text" class="form-control" value="`+data.satuan+`" readonly>`
                );
              }
              // console.log(li);
              

              $(".satuan").append(satuan);
              $(".menusparepart").append(li);
            // $.each(data, function(key, val){
            // });
          }
          else{
            $(".showGagal").show();
          }
         // $('#workorderid').val(id).hide();
         // $('#itemid').val(data.itemid);
         // $('#qty').val(data.qty);
      },
      error: function (data) {
        $(".showGagal").show();
      }
    });
  }

  function editDetail(params) {
    var detailwoid = $(params).attr('data-id');
    $.ajax({
      type: 'GET',
      url : "<?=base_url('');?>Workorder/editDetailJson/"+detailwoid,
      success: function (results) {
        console.log(results);
        $('#jumlah').val(results.qty);
        $('#nama_item').val(results.nama_item);
        $('#stok').val(results.stok+"(tersedia)");
        $('#itemid').val(results.itemid).hide();
        $('#detailwoid').val(results.detailwoid).hide();
        $('#workorderid').val(results.workorderid).hide();
        $('#satuan').val(results.satuan);
      }
    })
  }

  function clearForm() {    
    $('.satuan').empty();
    $(".menusparepart").empty();
    $('#qty').val("");
    $(".showGagal").hide();
    $(".showSukses").hide();
  }
</script>