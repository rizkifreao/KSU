<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {
	
	var $kelas = "Satuan";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

	}

	public function index(){
		$data["rowData"] = $this->M_mst_satuan->getAll();
		$data['konten'] = "satuan/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_mst_satuan->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("userid");
		$data["nama"] = $this->input->post("nama");
		
		if($id)
			$this->M_mst_satuan->update($id,$data);
		else 
			$this->M_mst_satuan->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_mst_satuan->delete($id);
		redirect($this->kelas);
	}
}
