
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     Pembelian Item  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href=""> Pembelian Item </a></li>
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
              <th>No Faktur</th>
              <th>Tanggal Masuk</th>
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
                <td><?=$row->nofaktur?></td>
                <td><?=date("d-m-Y",strtotime($row->tanggal));?></td>
                <td><?=number_format($row->total,0,",",".");?></td>
                <td>
                  <a href="<?=site_url('PembelianItem/detail/'.$row->pembelianid);?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                  <a href="" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalTanggal" onclick="tanggal(this)" data-id="<?=$row->pembelianid?>"><i class="fa fa-calendar"></i></a>
                  <a href="<?=site_url('PembelianItem/delete/'.$row->pembelianid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
      <?=form_open("PembelianItem/add","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">    
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">No Faktur</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nofaktur" placeholder="Masukan nomor faktur" name="nofaktur" value="" required>
                  </div>
                </div> 
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Suplier</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="suplier" placeholder="Masukan nomor faktur" name="suplier" value="" required>
                  </div>
                </div>        
                <div class="form-group">
                  <label for="tanggal" class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" id="pembelianid" placeholder="pembelianid" name="pembelianid" value="">
                    <input type="date" class="form-control" id="tanggall" placeholder="tanggal" name="tanggall" value="<?= date('Y-m-d') ?>">
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
<div id="modalTanggal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Data</h4>
      </div>
      <?=form_open("PembelianItem/addTanggal","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="tanggal" class="col-sm-4 control-label">Tanggal Datang</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control pembelianid" placeholder="pembelianid" name="pembelianid" value="">
                    <input type="date" class="form-control" id="tanggal" placeholder="tanggal" name="tanggal_datang" value="">
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

  var d = new Date();

  var month = d.getMonth()+1;
  var day = d.getDate();

  var output = ((''+month).length<2 ? '0' : '') + month + '/' +
      ((''+day).length<2 ? '0' : '') + day + '/' +
      d.getFullYear();

    //   var output = d.getFullYear() + '/' +
    // ((''+month).length<2 ? '0' : '') + month + '/' +
    // ((''+day).length<2 ? '0' : '') + day;

  // $('#tanggall').val(output);
  
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

  function tanggal(ini) {
    var id = $(ini).attr('data-id');
    $('.pembelianid').val(id);
  }
</script>