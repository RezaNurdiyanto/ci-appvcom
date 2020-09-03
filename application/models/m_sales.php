<?php

defined("BASEPATH") OR exit("No direct script access allowed");
class m_sales extends CI_Model {

	function tampil_sales() {
		$query=$this->db->query("SELECT * From salesheader");
		return $query();
	}

	function get_salesno () {
		$q = $this->db->query("SELECT MAX(RIGHT(SalesNo,6)) as kd_max FROM salesheader WHERE Date(SalesDate)=CURDATE()");
		$kd = "" ;
		if ($q -> num_rows() > 0 ){
			foreach($q->result() as $k) {
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}else {
			$kd = "000001";
		}
		date_default_timezone_set('Asia/Jakarta');
		return date('Ymd').$kd;
	}

		function simpan_penjualan($salesno,$salestype,$salesdate,$total,$jml_uang,$kembalian){
		$this->db->query("INSERT INTO salesheader (SalesNo, SalesType, salesdate, total_jual, total_uang, total_kembali) 
			VALUES('$salesno','$salestype','$salesdate','$total','$jml_uang','$kembalian')");
		foreach($this->cart->contents() as $item){
			$data=array(
				'SalesNo'		=>$salesno,
				'plu_id'		=>$item['id'],
				'Description' =>$item['name'],
				'Qty'			=>$item['qty'],
				'Uprice'		=>$item['price'],
				'NetPrice'	=>$item['subtotal']
			);
			$this->db->insert('salesitem',$data);
		}
		return true;
	}

	function cetak() {
		$salesno = $this->session->userdata('salesno');
		$hasil = $this->db->query("SELECT c.*, DATE_FORMAT(SalesDate, '%d/%m/%y %h:%i:%s') as Tgl ,
									s.plu_id, s.Description, s.Qty, s.Uprice,  s.NetPrice,
									p.satuan
									FROM salesheader c
										 join SalesItem s on c.SalesNo = s.SalesNo
										 join plu p on s.plu_id = p.plu_id
										  WHERE c.SalesNo = '$salesno' ");
		return $hasil;
	}

	function msales() {
		$query=$this->db->query("SELECT 
					    	h.salesno, h.salesdate, month(h.salesdate) as bulan,
					    	month(now()) as bln
					    from 
					    	salesheader h 
					    ");
		return $query->num_rows();
	}
}