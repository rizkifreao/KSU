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
$this->apdf->Ln();

//Content
$bulan = 12;
for($x = $bulan; $x>0;$x--):

	// $rowData = $this->M_penjualan->getAllBy("tanggal_faktur LIKE '%-".str_pad($x, 2, 0, STR_PAD_LEFT)."-%'");
	if(count($rowData)>0):
		$this->apdf->SetFont('Helvetica','B',8);
		$this->apdf->SetWidths(array(167));
		$this->apdf->SetAligns(array("L"));
		$this->apdf->RowNoLine(array(date("F",strtotime("1990-".$x."-1"))));

		$this->apdf->SetFillColor(189,189,189);
		$this->apdf->SetHeader();
		$this->apdf->SetWidths(array(7,20,30,30,30,30,20));
		$this->apdf->Row(array(
						'No',
						'Nomor Fakur',
						'Nomor Order',
						'Tanggal Masuk',
						'Tanggal Faktur',
						'Tanggal Cetak',
						'Total'
		));

		$no=1;
		$sumTotal = 0;
		$this->apdf->SetFont('Helvetica','',8);
		$this->apdf->SetAligns(array("C","L","L","C","C","C","R"));

		foreach($rowData as $key){	
			$this->apdf->Row(array(
						$no++,
		                $key->nomorfaktur,
		                $this->M_workorder->getDetail($key->woid)->nomor,
		                date("d-m-Y H:i:s",strtotime($this->M_workorder->getDetail($key->woid)->tanggal_masuk)),
		                date("d-m-Y H:i:s",strtotime($key->tanggal_faktur)),
		                date("d-m-Y H:i:s",strtotime($key->tanggal_cetak)),
		                number_format($key->total,0,",",".")
			));	
			$sumTotal += $key->total;
		}

		$this->apdf->SetFont('Helvetica','B',8);
		$this->apdf->SetWidths(array(147,20));
		$this->apdf->SetAligns(array("R"));
		$this->apdf->Row(array("Total",number_format($sumTotal,0,",",".")));

		$this->apdf->Ln(2);
	endif;
endfor;
?>
