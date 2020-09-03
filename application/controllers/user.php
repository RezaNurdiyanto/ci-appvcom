<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User extends CI_Controller {
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('masuk') !=TRUE){
				$url=base_url();
				redirect($url);
		 };
		$this->load->model('m_user');
	}


	public function index(){
		$data['user']= $this->m_user->view();
		$this->load->view('v_user', $data);
	}

	function tambah_user() {
		$usrname = $this->input->post('username');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$md5=md5($password);
		$status = $this->input->post('status');
		$this->m_user->simpan_user($usrname, $name, $email, $md5, $status);
		redirect('user');
	}

	function hapus_user() {
		$id = $this->input->post('id');
		$this->m_user->hapus_user($id);
		redirect('user');
	}

	function edit_user() {
		$id = $this->input->post('id');
		$usrname = $this->input->post('usrname');
		$name = $this->input->post('name');
		$status = $this->input->post('status');
		$this->m_user->simpan_edit($id, $usrname, $name, $status);
		redirect('user');
	}
}