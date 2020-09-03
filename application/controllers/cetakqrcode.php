<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class cetakqrcode extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('masuk') !=TRUE){
				$url=base_url();
				redirect($url);
		 };
		$this->load->model('m_cetakqrcode');
				$this->load->library('Ciqrcode');
		$this->load->library('Zend');

	}

	function index(){
		$data['barang']=$this->m_cetakqrcode->tampil_barang();
		$this->load->view('v_cetakqrcode', $data);
	}

	function qrcode_proses(){
		$this->load->view('v_qrview');
	}

	function set_barcode($kodenya){
		$this->zend->load('Zend/Barcode');
		Zend_Barcode::render('code128','image',array('text' => $kodenya));
    }
} 