<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		// if (!$this->session->userdata("id")){
		// 	redirect("Login");
		// }

		$id = $this->session->userdata("id");
		$this->user = $this->M_user->getDetail($id);
	}

	public function index()
	{
		if (!$this->session->userdata("id")){
			redirect("Login");
		}
		$data["konten"] = "dashboard";
		$this->load->view('template',$data);
	}

	public function dashboard()
	{
		$data["konten"] = "dashboard";
		$this->load->view('template',$data);
	}

	public function profil(){
	    if($this->input->post("btnsubmit")){
			$data["nama"] = $this->input->post("nama");
			if($this->input->post("password")){
				$data["password"] = $this->encrypt->encode($this->input->post("password"));
			}
			$this->M_user->update($this->user->userid,$data);
			redirect("Welcome/profil");
	    }
		
		$data['user'] = $this->user;
		$data['konten'] = "profil";
		$this->load->view('template',$data);
	}

	public function export(){
        $data['filename'] = "Laporan";
		$data["rowData"] = $this->M_user->getAll();
        $data['konten'] = "page/export/user";
        $this->load->view("page/export/templatePdf",$data);
	}
}
