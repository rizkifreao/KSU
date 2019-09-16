
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
     User  
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('');?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href=""> User </a></li>
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
              <th>Jabatan</th>
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
                <td><?=$row->nama;?></td>
                <td><?=$row->jabatan;?></td>
                <td>
                  <a href="" data-id="<?=$row->userid?>" data-toggle="modal" data-target="#modalForm" onclick="getDetail(this)" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                  <a href="<?=site_url('User/delete/'.$row->userid);?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title">Tambah User</h4>
      </div>
      <?=form_open("User/add","class='form-horizontal'");
      ?>
      <div class="modal-body">

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">            
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Nama</label>
                  <div class="col-sm-8">
                    <input type="hidden" class="form-control" id="userid" placeholder="userid" name="userid" value="">
                    <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="">
                  </div>
                </div>      
                <div class="form-group">
                  <label for="nama" class="col-sm-4 control-label">Jabatan</label>
                  <div class="col-sm-8">
                      <select name="jabatan" id="jabatan" required class="form-control">
                        <option value="">- Jabatan -</option>
                        <option value="Administrator" >Administrator</option>
                        <option value="Manager" >Manager</option>
                        <option value="Kasir" >Kasir</option>
                        <option value="Kepala Gudang" >Kepala Gudang</option>
                        <option value="Service Advisor" >Service Advisor</option>
                      </select>
                  </div>
                </div>    
                <div class="form-group">
                  <label for="password" class="col-sm-4 control-label">Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" placeholder="password" name="password" value="">
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
      url: "<?=base_url('');?>User/detail/"+id,
      success: function (data) {
        //Do stuff with the JSON data
          console.log(data);
         $('#userid').val(id).hide();
         $('#nama').val(data.nama);
         $('#jabatan').val(data.jabatan);
        }
    });
  }

  function clearForm() {    
     $('#userid').val("");
     $('#nama').val("");
     $('#jabatan').val("");
  }
</script>