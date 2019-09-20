<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	function __construct(){
		parent::__construct();
		// if (!$this->session->userdata("id")){
		// 	redirect("Login");
		// }

		$id = $this->session->userdata("id");
		$this->user = $this->M_user->getDetail($id);
	}

	public function faktur($id){
		
        $data['filename'] = "Faktur Pengeluaran";
		$data["data"] = $faktur = $this->M_penjualan->getDetailByFk($id);
		$data["rowDetailWo"] = $this->M_workorder_detail->getAllBy("workorderid = ".$id);
		$data["rowWo"] = $wo = $this->M_workorder->getDetail($id);
		// $data["rowFeedback"] = $this->M_feedback->getAllBy("penjualanid = ".$faktur->penjualanid);
		// $data["rowCust"] = $this->M_pelanggan->getDetail($wo->pelangganid);

		$data['konten'] = "page/export/faktur_pengeluaran";
		// echo json_encode($data);
        $this->load->view("page/export/templatePdf",$data);
	}

	public function laporanfaktur(){
        $data['filename'] = "Laporan Faktur";

		$data["rowData"] = $this->M_penjualan->getAll();
		$data["nomorfaktur"] = 'All';

		$data['konten'] = "page/export/laporanfaktur";
        $this->load->view("page/export/templatePdfAll",$data);
	}

	public function laporanharian(){
        $data['filename'] = "Laporan Faktur Harian";

		$data["rowData"] = $this->M_penjualan->getAllBy(
			"tanggal_faktur = '".date('Y-m-d ')."'"
		);
		$data["nomorfaktur"] = 'Harian';

		$data['konten'] = "page/export/laporanharian";
		$this->load->view("page/export/templatePdfAll",$data);
		// echo json_encode($data);
	}

	public function workorder($id){
        $data['filename'] = "Workorder";

		$data["data"] = $wo = $this->M_workorder->getDetail($id);
		$data["rowData"] = $this->M_workorder_detail->getAllBy("workorderid = ".$id);
		// $data["rowCust"] = $this->M_pelanggan->getDetail($wo->pelangganid);

		$data['konten'] = "page/export/workorder";
        $this->load->view("page/export/templatePdfWo",$data);
	}

	public function pembelian($id){
        $data['filename'] = "Faktur Pembelian";

		$data["data"] = $this->M_pembelian->getDetail($id);
		$data["rowData"] = $this->M_pembelian_detail->getAllBy("pembelianid = ".$id);

		$data['konten'] = "page/export/pembelian";
        $this->load->view("page/export/templatePdfPembelian",$data);
	}

	public function test()
	{
		echo $this->M_penjualan->getAllBy("tanggal_faktur LIKE '%-".str_pad(9, 2, 0, STR_PAD_LEFT)."-%'");
	}
}
