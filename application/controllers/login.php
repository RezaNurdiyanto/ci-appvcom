<?php
defined("BASEPATH") or exit("No direct script access allowed");

class login extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('m_login');
	}

	function index(){
		$this->load->view('v_login');
	}

	function login() {
		$username = strip_tags(stripslashes($this->input->post('username',TRUE)));
		$password = strip_tags(stripslashes($this->input->post('password',TRUE)));
		$user = $username;
		$pass = $password;
		$data = $this->m_login->cek_login($user, $pass);
		if ($data->num_rows() > 0 ){
			$this->session->set_userdata('masuk',true);
			$this->session->set_userdata('user',$user);
			redirect('dashboard');
		} else {
			redirect('login');
		}
		
	}

	function logout() {
		$this->session->sess_destroy();
		$url=base_url('index.php/login');
		redirect($url);
	}
 }
?>