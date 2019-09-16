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
$this->apdf->Cell(0,6,$filename." #".$data->nomor,0,2,'C');
$this->apdf->Ln();

//Content
$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Nama",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(85,6,": ".$data->nama,0,1,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Tanggal Keluar",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(85,6,": ".(($data->tanggal_keluar)?date("d-m-Y H:i:s",strtotime($data->tanggal_keluar)):"-"),0,1,'L');

$this->apdf->SetFont('Helvetica','B',10);
$this->apdf->Cell(30,6,"Keterangan",0,0,'L');
$this->apdf->SetFont('Helvetica','',10);
$this->apdf->Cell(85,6,": ".$data->keterangan,0,1,'L');

$this->apdf->Ln(5);

// ======================================
$this->apdf->SetLineWidth(0.5);
$this->apdf->Cell(0,3,'','B',1,'C');
$this->apdf->Ln(5);

$this->apdf->SetFont('Helvetica','B',8);
$this->apdf->SetHeader();
$this->apdf->SetFillColor(238,238,238);
$this->apdf->SetWidths(array(7,105,35,15,18));
$this->apdf->Row(array(
				'No',
				// 'Pelayanan',
				'Item',
				'Jumlah',
				'Satuan'
));


$no=1;
$this->apdf->SetFont('Helvetica','',8);
$this->apdf->SetAligns(array("C","L","C","C","R"));
foreach($rowData as $key){	
	$this->apdf->Row(array(
					$no++,
					// $this->M_mst_pelayanan->getDetail($key->pelayananid)->nama,
					$this->M_item->getDetail($key->itemid)->nama_item,
					$key->qty,
					$this->M_mst_satuan->getDetail($this->M_item->getDetail($key->itemid)->satuanid)->nama
	));	
}
?>
