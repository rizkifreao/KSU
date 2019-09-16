<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur extends CI_Controller {
	
	var $kelas = "Faktur";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}
	}

	public function index(){
		$data["rowData"] = $this->M_penjualan->getAll();
		$data['konten'] = "faktur/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
		$data["data"] = $faktur = $this->M_penjualan->getDetailByFk($id);
		$data["rowDetailWo"] = $this->M_workorder_detail->getAllBy("workorderid = ".$id);
		$data["rowWo"] = $wo = $this->M_workorder->getDetail($id);
		// $data["rowFeedback"] = $this->M_feedback->getAllBy("penjualanid = ".$faktur->penjualanid);
		// $data["rowCust"] = $this->M_pelanggan->getDetail($wo->pelangganid);
		$data['konten'] = "faktur/detail";
		$this->load->view('template',$data);
	}

	public function add(){
		if($this->input->post("btnsubmit")){
			$data["idrefatribut"] = $this->input->post("idrefatribut");
			$this->M_penjualan->add($data);
			redirect($this->kelas);
		}
		$data['konten'] = "faktur/index";
		$this->load->view('template',$data);
	}

	public function update($id){
		if($this->input->post("btnsubmit")){
			$data["idrefatribut"] = $this->input->post("idrefatribut");
			$this->M_penjualan->update($id,$data);
			redirect($this->kelas);
		}
		$data["data"] = $this->M_penjualan->getDetail($id);
		$data['konten'] = "faktur/index";
		$this->load->view('template',$data);
	}

	public function cetak($id){
		$data["tanggal_cetak"] = date("Y-m-d");

		//add FEEDBACK
		$rowFeedback = $this->M_mst_feedback->getAll();
		foreach ($rowFeedback as $row) {
			$dataFeedback["penjualanid"] = $id;
			$dataFeedback["nilai"] = $this->input->post($row->mstfeedbackid);
			$dataFeedback["mstfeedbackid"] = $row->mstfeedbackid;
			$this->M_feedback->add($dataFeedback);
		}

		$this->M_penjualan->update($id,$data);
		redirect("Cetak/faktur/$id");
	}

	public function delete($id){		
		$this->M_penjualan->delete($id);
		redirect($this->kelas);
	}
}
