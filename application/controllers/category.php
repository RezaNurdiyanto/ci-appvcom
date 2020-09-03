<?php
defined("BASEPATH") Or exit ("no direct script access allowed");

class category extends CI_Controller {
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('masuk') !=TRUE){
				$url=base_url();
				redirect($url);
		 };
		$this->load->model('m_category');
	}

	public function index(){
		$data['category']= $this->m_category->view();
		$this->load->view('v_category',$data);
	}

	function tambah_category(){
		$nm=$this->input->post('description');
		$this->m_category->simpan_category($nm);
		echo $this->session->set_flashdata('msg','Data Berhasil Disimpan');
		redirect('category');
	}

	function edit_category(){
		$id=$this->input->post('id');
		$nm=$this->input->post('description');
		$this->m_category->simpan_edit_category($id, $nm);
		echo $this->session->set_flashdata('notif','<div class="alert alert-success"><b>Data Berhasil Disimpan</b></div>');
		redirect('category');
	}

	function hapus_cat() {
		$id = $this->input->post('id');
		$this->m_category->hapus_cat($id);
		redirect('category');
	}
}