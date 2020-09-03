<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('masuk') !=TRUE){
				$url=base_url();
				redirect($url);
		 };
		 	$this->load->model('m_dashboard');
			$this->load->model('m_barang');
			$this->load->model('m_user');
			$this->load->model('m_sales');
	}
	
	public function index() {
		$data['sales']=$this->m_dashboard->salesnow();
		$data['product'] =$this->m_dashboard->sales_product();
		$data['user']=$this->m_user->count_user();
		$data['data']=$this->m_sales->msales();
		$this->load->view('v_dashboard', $data);

	}

}