<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Workorder extends CI_Controller {
	
	var $kelas = "Workorder";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

		$id = $this->session->userdata("id");
		$this->user = $this->M_user->getDetail($id);

	}

	public function index(){
		$data["rowData"] = $this->M_workorder->getAll();
		$data['konten'] = "workorder/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
		$data["data"] = $wo = $this->M_workorder->getDetail($id);
		$data["rowData"] = $this->M_workorder_detail->getAllBy("workorderid = ".$id);
		// $data["rowCust"] = $this->M_pelanggan->getDetail($wo->pelangganid);
		$data['konten'] = "workorder/detail";
		$this->load->view('template',$data);
	}

	public function detailJson($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_workorder->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function editDetailJson($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_workorder_detail->getDetail($id);
		$data['detailwoid'] = $rowData->detailwoid;
		$data['workorderid'] = $rowData->workorderid;
		$data['itemid'] = $rowData->itemid;
		$item = $this->M_item->getDetail($rowData->itemid);
		$data['stok'] = $item->stokakhir;
		$data['nama_item'] = $item->nama_item;
		$data['satuan'] = $this->M_mst_satuan->getDetail($item->satuanid)->nama;
		$data['qty'] = $rowData->qty;
		$data['total'] = $rowData->total;

	    echo json_encode( $data );
	}

	public function add(){
		$id = $this->input->post("workorderid");
		$data["userid"] = $this->user->userid;
		$data["nomor"] = $this->nomor("WO");
		// $data["pelangganid"] = $this->input->post("pelangganid");
		$data["tanggal_keluar"] = date("Y-m-d H:i:s");
		$data["nama"] = $this->input->post("nama");
		$data["keterangan"] = $this->input->post("keterangan");
		
		if($id) 
			$this->M_workorder->update($id,$data);
		else 
			$this->M_workorder->add($data);

		redirect($this->kelas);
	}

	public function addDetail()
	{
		$data["workorderid"] = $workorderid = $this->input->post("workorderid");
		$data["itemid"] = $itemid = $this->input->post("itemid");
		$data["qty"] = $qty = $this->input->post("qty");
		$item = $this->M_item->getDetail($itemid);
		$detailWO = $this->M_workorder_detail->getAllBy("workorderid = ".$workorderid);

		if ($detailWO) {
			foreach ($detailWO as $key) {
				if ($itemid == $key->itemid) {
					$this->session->set_flashdata("warning","Item <strong>$item->nama_item</strong> sudah ada");
				}else{
					if($item->stokakhir < $qty){
						$this->session->set_flashdata("warning","Stok <strong>$item->nama_item</strong> tidak mencukupi");
					}else{
						$data["total"] = $item->hargajual*$qty;
						$this->M_workorder_detail->add($data);
					}
				}
			}
		}else {
			if($item->stokakhir < $qty){
				$this->session->set_flashdata("warning","Stok <strong>$item->nama_item</strong> tidak mencukupi");
			}else{
				$data["total"] = $item->hargajual*$qty;
				$this->M_workorder_detail->add($data);
			}
		}

		redirect($this->kelas."/detail/".$workorderid);
		
	}

	public function editDetail(){
		$detailwoid = $this->input->post("detailwoid");
		$data["workorderid"] = $workorderid = $this->input->post("workorderid");
		// $data["pelayananid"] = $pelayananid = $this->input->post("pelayananid");
		$data["itemid"] = $itemid = $this->input->post("itemid");
		$item = $this->M_item->getDetail($itemid);
		
		$data["qty"] = $qty = $this->input->post("qty");
		if($item->stokakhir < $qty){
			$this->session->set_flashdata("warning","Stok <strong>$item->nama_item</strong> tidak mencukupi");
		}else{
			// $data["total"] = $item->hargajual*$qty;
			$this->M_workorder_detail->update($detailwoid,$data);
		}

		redirect($this->kelas."/detail/".$workorderid);
	}

	public function save($id){
		// $id = $this->input->post("workorderid");
		$rowDetailWo = $this->M_workorder_detail->getAllBy("workorderid = ".$id);
		$total = 0;

		foreach ($rowDetailWo as $detailWo) {
			//update stok item
			$total+=$detailWo->total;
			$item = $this->M_item->getDetail($detailWo->itemid);
			$dataitem["stokakhir"]= $item->stokakhir - $detailWo->qty;
			$this->M_item->update($detailWo->itemid,$dataitem);
		}

		//add FAKTUR
		$dataPenjualan["woid"] = $id;
		$dataPenjualan["total"] = $total;
		$dataPenjualan["userid"] = $this->user->userid;
		$dataPenjualan["nomorfaktur"] = $this->nomor("FA");
		// TODO DEV
		// $dataPenjualan["tanggal_faktur"] = date("Y-m-d H:i:s");
		$dataPenjualan["tanggal_faktur"] = $this->input->post("tanggal");
		$this->M_penjualan->add($dataPenjualan);
		
		//update status WO
		$dataWo["status"] = "F";
		// TODO DEV
		// $dataWo["tanggal_keluar"] = date("Y-m-d H:i:s");
		// $dataWo["tanggal_keluar"] = $this->input->post("tanggal");
		$this->M_workorder->update($id,$dataWo);

		redirect($this->kelas);
	}

	public function update($id){
		if($this->input->post("btnsubmit")){
			$data["idrefatribut"] = $this->input->post("idrefatribut");
			$this->M_workorder->update($id,$data);
			redirect($this->kelas);
		}
		$data["data"] = $this->M_workorder->getDetail($id);
		$data['konten'] = "workorder/index";
		$this->load->view('template',$data);
	}

	public function batal($id){
		$data["status"] = "NF";
		$this->M_workorder->update($id,$data);
		redirect($this->kelas);
	}

	public function delete($id){		
		$rowWorkorder = $this->M_workorder_detail->getAllBy("workorderid = $id");
		foreach ($rowWorkorder as $row) {
			$this->deleteDetail($row->detailwoid, 1);
		}

		$this->M_workorder->delete($id);
		redirect($this->kelas);
	}

	public function deleteDetail($id, $loop = 0){		
		$workorderid = $this->M_workorder_detail->getDetail($id)->workorderid;
		$this->M_workorder_detail->delete($id);
		if($loop != 1) redirect($this->kelas."/detail/".$workorderid);
	}

	public function nomor($param){
		$max = $this->M_workorder->getMax()->workorderid;
		// $nomor = sprintf("%04d",$max);
		$nomor = sprintf("%d",$max);
		return $param.$nomor;
	}
}
