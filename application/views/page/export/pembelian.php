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
$this->apdf->Cell(0,6,$filename." #".$data->pembelianid,0,2,'C');
$this->apdf->Ln();

//Content
$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Suplier",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(85,6,": ".$data->suplier,0,1,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Tanggal Beli",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(85,6,": ".(($data->tanggal)?date("d-m-Y H:i:s",strtotime($data->tanggal)):"-"),0,1,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Tanggal Datang",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(85,6,": ".(($data->tanggal_datang)?date("d-m-Y H:i:s",strtotime($data->tanggal_datang)):"-"),0,1,'L');

$this->apdf->Ln(5);

// ======================================
$this->apdf->SetLineWidth(0.5);
$this->apdf->Cell(0,3,'','B',1,'C');
$this->apdf->Ln(5);

$this->apdf->SetFont('Helvetica','B',8);
$this->apdf->SetHeader();
$this->apdf->SetFillColor(238,238,238);
$this->apdf->SetWidths(array(7,100,28,15,20));
$this->apdf->Row(array(
				'No',
				'Item',
				'Harga Satuan',
				'Jumlah',
				'Sub Total'
));


$no=1;
$this->apdf->SetFont('Helvetica','',8);
$this->apdf->SetAligns(array("C","L","R","C","R"));
$sumTotal = 0;
foreach($rowData as $data){	
	$this->apdf->Row(array(
					$no++,
					$this->M_item->getDetail($data->itemid)->nama_item,
					number_format($data->hargasatuan,0,",","."),
					$data->jumlah,
					number_format($data->total,0,",",".")
	));	
	$sumTotal += $data->total;
}

$this->apdf->SetWidths(array(150,20));
$this->apdf->SetAligns(array("R"));
$this->apdf->Row(array("Total",number_format($sumTotal,0,",",".")));
?>
