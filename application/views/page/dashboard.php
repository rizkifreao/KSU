<?php
    $iduser = $this->session->userdata("id");
    $bulanSebelum = date("Y-m", strtotime("-1 month"));
?>

<style>
  .batasbawah{
    height: 400px !important;
  }
</style>

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
  <div class="row">
    <div class="col-md-6">
      <!-- LINE CHART -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Total Hasil Pengeluaran Item Tahun 2019</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="line-chart" style="height: 300px;"></div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
  
    </div><!-- /.col (LEFT) -->
    <div class="col-md-6">

      <!-- BAR CHART -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Total Pengeluaran Item Tahun 2019</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="bar-chart" style="height: 300px;"></div>
          <div id="legend" class="bars-legend"></div>
        </div>
      </div>

    </div><!-- /.col (RIGHT) -->
  </div><!-- /.row -->
</section>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?=base_url('extras/');?>plugins/morris/morris.min.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(function () {
        "use strict";
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // PENJUALAN
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [
            <?php 
            // $query = $this->db->query("SELECT DISTINCT(w.sparepartid) AS sparepartid, s.nama FROM workorder_detail w, sparepart s WHERE s.sparepartid = w.sparepartid");
            // $rowTanggal = $query->result();

            for ($i=1;$i<=12;$i++) :
              if($i<10)
                $i = "0".$i;
              $bulan = "2019-".$i;
              $query = $this->db->query("SELECT count(penjualanid) as jml FROM `penjualan` WHERE tanggal_faktur LIKE '".$bulan."-%'");
              $jml = $query->row()->jml;
            ?>
            {y: '<?=$bulan?>', item1: <?=($jml)?$jml:'0'?>},
            <?php
            endfor;
            ?>
          ],
          xkey: 'y',
          ykeys: ['item1'],
          labels: ['Item 1'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto',
          xLabelAngle: '70',
          xLabelFormat: function (x) { return months[x.getMonth()]; }
        });

        //LAYANAN
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
            <?php 
            // $query = $this->db->query("SELECT DISTINCT(w.sparepartid) AS sparepartid, s.nama FROM workorder_detail w, sparepart s WHERE s.sparepartid = w.sparepartid");
            // $rowTanggal = $query->result();

            for ($i=1;$i<=12;$i++) :
              if($i<10)
                $i = "0".$i;
              $bulan = "2019-".$i;
              $queryA = $this->db->query("SELECT COUNT(workorderid) as jml FROM `workorder` WHERE tanggal_keluar LIKE '".$bulan."-%'");
              $jmlA = $queryA->row()->jml;
              $queryB = $this->db->query("SELECT COUNT(workorderid) as jml FROM `workorder` WHERE tanggal_keluar LIKE '".$bulan."-%' AND status = 'NF'");
              $jmlB = $queryB->row()->jml;
            ?>
            {y: '<?=date("M", strtotime($bulan))?>', a: <?=($jmlA)?$jmlA:'0'?>, b: <?=($jmlB)?$jmlB:'0'?>},
            <?php
            endfor;
            ?>
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['Transaksi Pengeluaran', 'Transaksi Batal'],
          xLabelAngle: '70',
          hideHover: 'auto'
        });

        bar.options.labels.forEach(function(label, i) {
          var legendItem = $('<span style="margin-left:50px"></span>').text( label).prepend('<span>&nbsp;</span>');
          legendItem.find('span')
            .css('backgroundColor', bar.options.barColors[i])
            .css('width', '20px')
            .css('display', 'inline-block')
            .css('margin', '5px');
          $('#legend').append(legendItem)
        });
      });
    </script>