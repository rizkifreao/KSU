<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	var $kelas = "Login";

	function __construct(){
		parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
	}

	public function index(){
		if ($this->input->post('btnsubmit')) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$cek = $this->M_user->login($username,$password);
			if($cek){	
				$this->session->set_userdata("id",$cek->userid);
				$this->session->set_userdata("error",FALSE);
				$this->session->set_userdata("welcome",TRUE);
				if($cek->jabatan == "Administrator")
					redirect("Welcome");
				else if($cek->jabatan == "Kasir")
					redirect("Welcome");
				else if($cek->jabatan == "Manager")
					redirect("Welcome");
				else if($cek->jabatan == "Kepala Gudang")
					redirect("Welcome");
				else if($cek->jabatan == "Service Advisor")
					redirect("Welcome");
			}

			$this->session->set_userdata("error",TRUE);
		}
		$this->load->view("page/login");
	}

	public function logout(){	
		$this->session->unset_userdata("id");
		$this->session->unset_userdata("error");
		$this->session->unset_userdata("welcome");
		redirect("Login");
	}
}
