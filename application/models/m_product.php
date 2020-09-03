<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
class m_product extends CI_Model {

	function tampil_barang() {
		$query=$this->db->query("SELECT * FROM barang");
		return $query;
	}

	 public function view(){
    	return $this->db->get('barang')->result(); // Tampilkan semua data yang ada di tabel siswa
		}


		function getall() {
			$hasil=$this->db->get('barang');
			return $hasil;
		}

	function get_plu() {
		$k = $this->db->query("SELECT MAX(RIGHT(plu_id,6)) AS max FROM barang");
		$kd = "";
		if($k->num_rows()>0) {
			foreach($k->result() as $q){
				$tmp=((int)$q->max)+1;
				$kd=sprintf("%06s",$tmp);
			}
		} else {
			$kd="000001";
		}
		return "BR".$kd;
	}

	function simpan_product($plu,$nama,$satuan,$price, $barcode, $image_name){
		$data = array(
			'plu'	=> $plu,
			'description'	=> $nama,
			'satuan' => $satuan,
			'price'	=> $price,
			'barcode' => $barcode,
			'qr'	=> $image_name
		);
		$this->db->insert('barang', $data);
	}

	function update_barang($id,$nm,$st,$pr){
		$query=$this->db->query("UPDATE plu SET Description='$nm', satuan='$st', Price='$pr' WHERE plu_id='$id' ");
		return $query;
	} 

	function hapus_barang($id){
		$query=$this->db->query("DELETE FROM plu where plu_id='$id' ");
		return $query;
	}

	public function get_all(){
		return $this->db->get("plu");
	}

	public function get_barang($id) {
		$query=$this->db->query("SELECT * FROM plu where plu_id='$id' ");
		return $query;
	}
}