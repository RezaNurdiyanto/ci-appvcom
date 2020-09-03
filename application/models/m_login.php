<?php
defined("BASEPATH") or exit("No direct script access allowed");
	class m_login extends CI_Model {
		function view() {
			$query = $this->db->query("SELECT * from users");
			return $query;
		}

		function cek_login($user, $pass) {
			$query = $this->db->query("SELECT * FROM users WHERE username='$user' and password=md5('$pass') ");
			return $query;
		}
	}

?>