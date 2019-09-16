<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	var $kelas = "User";

	function __construct(){
		parent::__construct();
		if (!$this->session->userdata("id")){
			redirect("Login");
		}

	}

	public function index(){
		$data["rowData"] = $this->M_user->getAll();
		$data['konten'] = "user/index";
		$this->load->view('template',$data);
	}

	public function detail($id){
	    header('Content-Type: application/json');
		$rowData = $this->M_user->getDetail($id);
	    echo json_encode( $rowData );
	}

	public function add(){
		$id = $this->input->post("userid");
		$data["nama"] = $this->input->post("nama");
		$data["jabatan"] = $this->input->post("jabatan");
		
		if($id) {
			if($this->input->post("password") != "")
				$data["password"] = $this->encrypt->encode($this->input->post("password"));
		
			$this->M_user->update($id,$data);
		}
		else 
			$this->M_user->add($data);

		redirect($this->kelas);
	}

	public function delete($id){		
		$this->M_user->delete($id);
		redirect($this->kelas);
	}
}
