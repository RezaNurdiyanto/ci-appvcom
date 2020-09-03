<?php 
defined("BASEPATH") OR exit("No direct script access allowed");

class Sales extends CI_Controller{
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('masuk') !=TRUE){
				$url=base_url();
				redirect($url);
		 };
		$this->load->model('m_barang');
		$this->load->model('m_sales');
	}


	public function index() {
		$data['salesno'] = $this->m_sales->get_salesno();
		$data['barang']=$this->m_barang->tampil_barang();
		$this->load->view('v_sales',$data);
	}

	public function add_cart(){
		$st=$this->input->post('salestype');
		$this->session->set_userdata('salestype',$st);
		$id=$this->input->post('kode_brg');
		$nm=$this->m_barang->get_barang($id);
		$i=$nm->row_array();
		$data = array (
			'id'		=> $i['plu_id'], 
			'name'		=> $i['Description'], 
			'satuan'	=> $i['satuan'],
			'price'		=> $i['Price'], 
			'disc'		=> $this->input->post('diskon') ,
			'qty'		=> $this->input->post('qty') 
		);
		$this->cart->insert($data);
		redirect('sales');

	}

	function get_barang(){	
		$kobar=$this->input->post('kode_brg');
		$x['brg']=$this->m_barang->get_plu_barang($kobar);
		$this->load->view('v_detail_barang_jual',$x);

		$this->load->view('test',$x);
	}

	function remove() {
		$row_id=$this->uri->segment(3);
		$this->cart->update(array(
			'rowid'	=> $row_id,
			'qty'	=> 0 
		));
		redirect('sales');
	}

	function updateqtymin() {
		foreach ($this->cart->contents() as $items) {
			$id = $items['id'];
			$qtylama = $items['qty'];
			$row_id=$this->uri->segment(3);
				$up = array(
					'rowid'	=> $row_id,
					'qty'	=>$qtylama - 1
				);
				$this->cart->update($up);
			}
		redirect('sales');
	}

		function updateqtyplus() {
		foreach ($this->cart->contents() as $items) {
			$id = $items['id'];
			$qtylama = $items['qty'];
			$row_id=$this->uri->segment(3);
				$up = array(
					'rowid'	=> $row_id,
					'qty'	=>$qtylama + 1
				);
				$this->cart->update($up);
			}
		redirect('sales');
	}

	function simpan_penjualan () {
		$salestype = 'S';
		$salesno = $this->m_sales->get_salesno();
		$salesdate = date('Y-m-d');
		$total = $this->input->post('total1');
		$jml_uang = str_replace(",","",$this->input->post('bayar'));
		$kembalian = $jml_uang-$total;
		if (!empty($total) && !empty($jml_uang) && !empty($salestype)) {
			if ($jml_uang < $total) {
			echo $this->session->set_flashdata('error','<label class="label label-danger">Jumlah uang yang anda masukan kurang</label>');
			redirect('sales');
		} else {
			$this->session->set_userdata('salesno',$salesno);
			$sales_proses = $this->m_sales->simpan_penjualan($salesno, $salestype, $salesdate, $total, $jml_uang, $kembalian);
			if ($sales_proses){
				$this->cart->destroy();
				$this->session->unset_userdata('salesdate');
				$this->session->unset_userdata('salestype');
				//echo $this->session->set_flashdata('success_register','<label class="label label-success">Data Sukses Disimpan</label>');
				$this->load->view('alert/alert_sukses');
			} else {
				redirect('sales');
			}
		}
	} else {
		echo $this->session->set_flashdata('error', '<label class="label label-danger">Penjualan gagal disimpan, mohon periksa semua inputan anda!</label>');
		redirect ('sales');
	}

	}

	function cetak_struck() {
		$x['data'] = $this->m_sales->cetak();
		$this->load->view('laporan/v_struck', $x);
	}
}