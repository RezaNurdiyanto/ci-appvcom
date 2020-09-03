<?php
defined("BASEPATH") OR exit("No direct script access allowed ");
class m_user extends CI_Model {

	public function view(){
		$query=$this->db->query("SELECT * from Users");
		return $query;
	}

	public function count_user() {
		$query= $this->db->query("SELECT id, Count(id) FROM users where status='Active' Group By id; ");
		return $query->num_rows();
	}

	function simpan_user($usrname, $name, $email , $password, $status) {
		$query = $this->db->query("INSERT INTO users (username, name, email, password , status )
							   VALUES ('$usrname','$name','$email','$password' , '$status')");
		return $query;
	}

	function hapus_user($id){
		$query = $this->db->query("DELETE FROM users where id='$id' ");
		return $query;
	}

	function simpan_edit($id, $usrname, $name, $status) {
		$query = $this->db->query("UPDATE users SET username='$usrname', name='$name' , status='$status' WHERE id='$id' ");
		return $query;
	}
}