<?php
// $this->apdf = new PDF();

// $this->apdf->setFilename($filename);

$this->apdf->fpdf('L','mm','A4');
$this->apdf->AliasNbPages();
$this->apdf->AddPage();


//HEADER
$this->apdf->setMargins(20,0);
$this->apdf->Ln(-10);
$this->apdf->SetFont('Arial','B',12);
$this->apdf->Cell(0,6,$filename,0,2,'C');
$this->apdf->Ln();

//Content
$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Nama Pemilik",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(170,6,": ".$data->nama_pemilik,0,0,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(20,6,"No Polisi",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(60,6,": ".$data->nopolisi,0,1,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Alamat Rumah",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(170,6,": ".$data->alamat,0,0,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(20,6,"Jenis",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(60,6,": ".$this->M_mst_jenis->getDetail($data->jenisid)->nama,0,1,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"No Telepon",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(170,6,": ".$data->notelp,0,0,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(20,6,"Merk",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(60,6,": ".$this->M_mst_merk->getDetail($data->merkid)->nama,0,1,'L');
$this->apdf->Ln(5);

// ======================================
$this->apdf->SetLineWidth(0.5);
$this->apdf->Cell(0,3,'','B',1,'C');
$this->apdf->Ln(5);

$this->apdf->SetFont('Helvetica','B',8);
$this->apdf->SetHeader();
$this->apdf->SetFillColor(238,238,238);
$this->apdf->SetWidths(array(7,40,40,50,50,11,29,30));
$this->apdf->Row(array(
				'No',
				'Tanggal Masuk',
				'Tanggal Keluar',
				'Keluhan',
				'Keterangan',
				'Status',
				'Mekanik',
				'Rata-rata Feedback'
));


$no=1;
$this->apdf->SetFont('Helvetica','',8);
$this->apdf->SetAligns(array("C","L"));
foreach($rowData as $data){
	$penjualan = $this->M_penjualan->getDetailByFk($data->workorderid);
	$rata = 0;
	if($penjualan){
	    $penjualanid = $penjualan->penjualanid;
	    $nilai = $this->M_feedback->getSumNilai($penjualanid)->nilai;
	    $rata = ($nilai)?$nilai/count($this->M_mst_feedback->getAll()):"0";
	  }
	$this->apdf->Row(array(
					$no++,
					$data->tanggal_masuk,
	                $data->tanggal_keluar,
	                $data->keluhan,
	                $data->keterangan,
	                $data->status,
	                $this->M_user->getDetail($data->userid)->nama,
                    $rata
	));	
}
?>
