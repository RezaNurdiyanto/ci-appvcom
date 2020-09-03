<?php 
defined("BASEPATH") or exit ("No direct script access allowed");

class m_category extends CI_Model {
	function view(){
		$query  = $this->db->query("SELECT * from category");
		return $query;
	}
	function simpan_category($nm){
		$query=$this->db->query("INSERT INTO category (Description) values('$nm') ");
		return $query;
	}

	function simpan_edit_category($id, $nm) {
		$query=$this->db->query("UPDATE category SET Description='$nm' where plu_cat='$id' ");
		return $query;
	}

	function hapus_cat($id){
		$query = $this->db->query("DELETE from category WHERE plu_cat='$id' ");
		return $query;
	}
}