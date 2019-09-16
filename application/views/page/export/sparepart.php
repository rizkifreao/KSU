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
$this->apdf->Cell(0,6,$filename,0,2,'C');

$tanggal = date("d-m-Y", strtotime("-31 day"));

$this->apdf->Cell(0,6,$tanggal." s/d ".date("d-m-Y") ,0,2,'C');
$this->apdf->Ln();

//Content
$this->apdf->SetFont('Helvetica','B',8);
$this->apdf->SetFillColor(189,189,189);
$this->apdf->SetHeader();
$this->apdf->SetWidths(array(7,70,20,20,20,30));
$this->apdf->Row(array(
				'No',
				'Nama',
				'Stok Akhir',
				'Satuan',
				'Safety Stok',
				'Yang Harus Dibeli'
));

$no=1;
$this->apdf->SetFont('Helvetica','',8);

foreach($rowData as $data){	
	$this->apdf->Row(array(
				$no++,
                $data->nama,
                $data->stokakhir,
                $data->satuan,
                $data->safety,
                ceil($data->safety + (0.1*$data->safety))
	));	
}

$this->apdf->Ln(2);
?>
