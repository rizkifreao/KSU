<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {
	
	var $kelas = "Item";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}
	}

	public function index(){
		$data["rowData"] = $this->M_item->getAll();
		$data['konten'] = "item/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
		$data["data"] = $this->M_item->getDetail($id);
		$data['konten'] = "item/detail";
		$this->load->view('template',$data);
	}

	public function detailJson($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_item->getDetail($id);
		$json['itemid'] = $rowData->itemid;
		$json['nama_item'] = $rowData->nama_item;
		$json['stokakhir'] = $rowData->stokakhir;
		$json['satuanid'] = $rowData->satuanid;
		$json['satuan'] = $this->M_mst_satuan->getDetail($rowData->satuanid)->nama;
	    echo json_encode( $json );
	}

	public function add(){
		$id = $this->input->post("itemid");
		$data["nama_item"] = $this->input->post("nama_item");
		// $data["kategoriid"] = $this->input->post("kategoriid");
		// $data["jenisid"] = $this->input->post("jenisid");
		$data["satuanid"] = $this->input->post("satuanid");
		// $data["hargajual"] = $this->input->post("hargajual");
		
		if($id) 
			$this->M_item->update($id,$data);
		else 
			$this->M_item->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_item->delete($id);
		redirect($this->kelas);
	}
}
