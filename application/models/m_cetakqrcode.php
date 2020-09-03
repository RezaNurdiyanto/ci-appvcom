<?php
defined("BASEPATH") OR exit("No direct script access allwed");

class m_cetakqrcode extends CI_Model{

	function tampil_barang(){
		$query= $this->db->query("SELECT plu_id, Description , satuan, Price, qr_code from plu");
		return $query;
	}

	public function view_one($table, $data, $order){
		$this->db->where($data);
		$this->db->order_by($order,"ASC");
		return $this->db->get($table);
	}
}