<?php
// $this->apdf = new PDF();

// $this->apdf->setFilename($filename);

$this->apdf->fpdf('P','mm','A4');
$this->apdf->AliasNbPages();
$this->apdf->AddPage();


//HEADER
$this->apdf->setMargins(20,0);
$this->apdf->Ln(-10);
$this->apdf->SetFont('Arial','B',12);
$this->apdf->Cell(0,6,$filename." #".$data->nomorfaktur,0,2,'C');
$this->apdf->Ln();

//Content
$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Nama",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(60,6,": ".$rowWo->nama,0,0,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(40,6,"Nomor Order",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(60,6,": #".$rowWo->nomor,0,1,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Keterangan",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(60,6,": ".$rowWo->keterangan,0,0,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(40,6,"Tanggal Pengambilan",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(60,6,": ".$rowWo->tanggal_keluar,0,1,'L');

// $this->apdf->SetFont('Helvetica','B',10);
// $this->apdf->Cell(30,6,"No Telepon",0,0,'L');
// $this->apdf->SetFont('Helvetica','',10);
// $this->apdf->Cell(85,6,": ".$rowCust->notelp,0,0,'L');

// $this->apdf->SetFont('Helvetica','B',10);
// $this->apdf->Cell(20,6,"Merk",0,0,'L');
// $this->apdf->SetFont('Helvetica','',10);
// $this->apdf->Cell(60,6,": ".$this->M_mst_merk->getDetail($rowCust->merkid)->nama,0,1,'L');
// $this->apdf->Ln(5);

// ======================================
$this->apdf->SetLineWidth(0.5);
$this->apdf->Cell(0,3,'','B',1,'C');
$this->apdf->Ln(5);

$this->apdf->SetFont('Helvetica','B',8);
$this->apdf->SetHeader();
$this->apdf->SetFillColor(238,238,238);
$this->apdf->SetWidths(array(15,130,20,38));
$this->apdf->Row(array(
				'No',
				'Item',
				'Jumlah'
				
));


$no=1;
$this->apdf->SetFont('Helvetica','',8);
$this->apdf->SetAligns(array("C","L","C","R"));
$sumTotal = 0;
foreach($rowDetailWo as $data){	
	$this->apdf->Row(array(
					$no++,
					$this->M_item->getDetail($data->itemid)->nama_item,
					$data->qty,
					// number_format($data->total,0,",",".")
	));	
	$sumTotal += $data->total;
}

// $this->apdf->SetWidths(array(132,38));
// $this->apdf->SetAligns(array("R"));
// $this->apdf->Row(array("Total",number_format($sumTotal,0,",",".")));
$this->apdf->Ln(35);
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(5,6,"",0,0,'C');
$this->apdf->Cell(50,6,"Petugas Gudang",0,0,'C');
$this->apdf->Cell(60,6,"",0,0,'C');
$this->apdf->Cell(50,6,"Penerima",0,1,'C');


$this->apdf->Ln(20);
$this->apdf->SetFont('Helvetica','BU',10);
$this->apdf->Cell(5,6,"",0,0,'C');
$this->apdf->Cell(50,6,"Administrator",0,0,'C');
$this->apdf->Cell(60,6,"",0,0,'C');
$this->apdf->Cell(50,6,"$rowWo->nama",0,1,'C');

?>
