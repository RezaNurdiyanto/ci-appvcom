<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
class m_barang extends CI_Model {

	function tampil_barang() {
		$query=$this->db->query("SELECT p.*, c.Description as Descat FROM plu p join category c on p.plu_cat = c.plu_cat");
		return $query;
	}

	 public function view(){
    	return $this->db->get('plu')->result(); // Tampilkan semua data yang ada di tabel siswa
		}

	function delete($id){
		$this->db->where_in("plu_id",$id);
		$this->db->delete('plu');
	}
	function get_plu() {
		$k = $this->db->query("SELECT MAX(RIGHT(plu_id,6)) AS max FROM plu");
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

	function simpan_barang($id,$nama,$satuan,$kdcat, $harga, $image_name){
		$query=$this->db->query("INSERT INTO plu(plu_id, Description , Satuan, plu_cat, Price, qr_code) VALUES('$id','$nama','$satuan','$kdcat', '$harga', '$image_name')");
		return $query;
	}

	public function get_plu_barang($kobar){
		$query=$this->db->query("SELECT * From plu where plu_id='$kobar' ");
		return $query;
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