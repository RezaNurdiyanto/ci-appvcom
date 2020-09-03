<?php
defined("BASEPATH") OR exit("No direct script access allowes");

class m_dashboard extends CI_Model {
	public function salesnow() {
		$query=$this->db->query("SELECT Salesno, count(salesno) FROM salesheader WHERE salesdate=date(now()) GROUP by Salesno; ");
		return $query->num_rows();
	}

	public function sales_product() {
		$query= $this->db->query("SELECT s.plu_id, Count(s.plu_id) FROM salesheader h join SalesItem s on h.SalesNo = s.SalesNo where h.Salesdate=date(now()) Group By s.plu_id; ");
		return $query->num_rows();
	}
}