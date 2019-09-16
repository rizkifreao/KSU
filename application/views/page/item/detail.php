<?php 
echo $data->sparepartid;
echo "<hr>";
echo $data->nama;
?>
<?php 
//PENJUALAN
$tanggal = date("Y-m-d", strtotime("-31 day"));
$no = 1;
?>
<hr>
PENJUALAN
<table border="1">
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Frekuensi</th>
	</tr>
<?php

for ($i=1; $i <= 30; $i++) :
	$tanggal = date("Y-m-d", strtotime("1 day", strtotime($tanggal)));
	$queryPenjualan="SELECT SUM(qty) as jumlah, sparepartid from(
						SELECT
							c.nama,
							b.detailwoid,
							b.sparepartid,
							a.workorderid,
							b.qty,
							a.`status`,
							d.penjualanid,
							d.woid,
							d.tanggal_faktur
						FROM
							sparepart AS c ,
							workorder AS a
						INNER JOIN workorder_detail AS b ON b.workorderid = a.workorderid
						INNER JOIN penjualan AS d ON d.woid = a.workorderid
						WHERE
							b.sparepartid = c.sparepartid
							AND b.sparepartid = $data->sparepartid
							AND tanggal_faktur = '$tanggal'
					) as penjualan
			";
	$rowPenjualan = $this->db->query($queryPenjualan)->row();
	$frekuensiJual = ($rowPenjualan->jumlah)?$rowPenjualan->jumlah:0;
?>
	<tr>
		<td><?=$no++?></td>
		<td><?=$tanggal?></td>
		<td><?=$frekuensiJual?></td>
	</tr>
<?php
endfor;
?>
</table>

<?php 
// PEMBELIAN
$queryPembelian="SELECT
				a.pembelianid,
				a.tanggal,
				a.tanggal_datang,
				DATEDIFF(a.tanggal_datang,
				a.tanggal) AS leadtime,
				b.pembeliandetailid,
				b.sparepartid
				FROM
				pembelian a
				INNER JOIN pembelian_detail b ON b.pembelianid = a.pembelianid
				WHERE b.sparepartid = $data->sparepartid
				ORDER BY pembelianid DESC
				LIMIT 8
";
$rowPembelian = $this->db->query($queryPembelian)->result();

$queryLead = "SELECT
				a.waktu
				FROM
				mst_tipe_pelayanan AS a
				INNER JOIN mst_pelayanan AS b ON b.tipepelayananid = a.tipepelayananid
				INNER JOIN mst_pelayanan_detail AS c ON c.pelayananid = b.pelayananid
				INNER JOIN sparepart AS d ON c.sparepartid = d.sparepartid
				WHERE
				d.sparepartid = $data->sparepartid
			";
$waktu = $this->db->query($queryLead)->row()->waktu;

$no = 1;
?>
<hr>
PEMBELIAN
<table border="1">
	<tr>
		<th>Leadtime</th>
		<th>Frekuensi</th>
	</tr>
<?php
for ($i = $waktu ; $i<= $waktu+3 ; $i++) :
	$queryJml = "SELECT
					COUNT(leadtime) AS jml
				FROM
					(
						SELECT
							a.pembelianid,
							a.tanggal,
							a.tanggal_datang,
							DATEDIFF(a.tanggal_datang, a.tanggal) AS leadtime,
							b.pembeliandetailid,
							b.sparepartid
						FROM
							pembelian a
						INNER JOIN pembelian_detail b ON b.pembelianid = a.pembelianid
						WHERE
							b.sparepartid = $data->sparepartid
						ORDER BY
							pembelianid DESC
						LIMIT 8
					) AS beli
				WHERE
					leadtime = $i
				";
	$frekuensiBeli = $this->db->query($queryJml)->row()->jml;
?>
	<tr>
		<td><?=$i?></td>
		<td><?=$frekuensiBeli?></td>
	</tr>
<?php
endfor;
?>
</table>