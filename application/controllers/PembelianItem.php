<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PembelianItem extends CI_Controller {
	
	var $kelas = "PembelianItem";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

		$id = $this->session->userdata("id");
		$this->user = $this->M_user->getDetail($id);

	}

	public function index(){
		$data["rowData"] = $this->M_pembelian->getAll();
		$data['konten'] = "pembelian/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
		$data["data"] = $this->M_pembelian->getDetail($id);
		$data["rowData"] = $this->M_pembelian_detail->getAllBy("pembelianid = ".$id);
		$data['konten'] = "pembelian/detail";
		$this->load->view('template',$data);
	}

	public function add(){
		$id = $this->input->post("pembelianid");
		$data["userid"] = $this->user->userid;
		$data["tanggal"] = $this->input->post("tanggall");
		$data["nofaktur"] = $this->input->post("nofaktur");
		$data["suplier"] = $this->input->post("suplier");
		
		if($id) 
			$this->M_pembelian->update($id,$data);
		else 
			$this->M_pembelian->add($data);

		redirect($this->kelas);
	}

	public function addTanggal(){
		$id = $this->input->post("pembelianid");
		$data["tanggal_datang"] = $this->input->post("tanggal_datang");
		$this->M_pembelian->update($id,$data);

		redirect($this->kelas);
	}

	public function addDetail(){
		$data["pembelianid"] = $pembelianid = $this->input->post("pembelianid");
		$data["itemid"] = $itemid = $this->input->post("itemid");
		$data["hargasatuan"] = $hargasatuan = $this->input->post("hargasatuan");
		$data["jumlah"] = $jumlah = $this->input->post("jumlah");
		$data["total"] = $totalbeli = $hargasatuan*$jumlah;
		$this->M_pembelian_detail->add($data);

		//update stok sparepart
		$stokakhir = $this->M_item->getDetail($itemid)->stokakhir;
		$dataSparepart["stokakhir"] = $stokakhir + $jumlah;
		$this->M_item->update($itemid,$dataSparepart);

		//update total pembelian
		$total = $this->M_pembelian->getDetail($pembelianid)->total;
		$dataPembelian["total"] = $total + $totalbeli;
		$this->M_pembelian->update($pembelianid,$dataPembelian);

		redirect($this->kelas."/detail/".$pembelianid);
	}

	public function delete($id){		

		$rowPembelian = $this->M_pembelian_detail->getAllBy("pembelianid = $id");
		foreach ($rowPembelian as $row) {
			$this->deleteDetail($row->pembeliandetailid, 1);
		}
		
		$this->M_pembelian->delete($id);
		redirect($this->kelas);
	}

	public function deleteDetail($id, $loop = 0){		
		$pembelianid = $this->M_pembelian_detail->getDetail($id)->pembelianid;
		$jumlah = $this->M_pembelian_detail->getDetail($id)->jumlah;
		$itemid = $this->M_pembelian_detail->getDetail($id)->itemid;
		$totalbeli= $this->M_pembelian_detail->getDetail($id)->total;

		//update stok sparepart
		$stokakhir = $this->M_item->getDetail($itemid)->stokakhir;
		$dataSparepart["stokakhir"] = $stokakhir - $jumlah;
		$this->M_item->update($itemid,$dataSparepart);

		//update total pembelian
		$total = $this->M_pembelian->getDetail($pembelianid)->total;
		$dataPembelian["total"] = $total - $totalbeli;
		$this->M_pembelian->update($pembelianid,$dataPembelian);

		$this->M_pembelian_detail->delete($id);
		if($loop != 1) redirect($this->kelas."/detail/".$pembelianid);
	}
}
