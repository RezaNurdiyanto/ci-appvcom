<!DOCTYPE html>
<html>
<head>
	<title>Barcode print</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

</head>
<body onload="window.print()">
	<?php
	$jml_data =count($this->input->post('a'));
	$kd='12345';

	for ($i=1; $i <= $jml_data; $i++){
		for ($b=1; $b <= $this->input->post('b')[$i]; $b++){
			$row=$this->m_cetakqrcode->view_one('plu', array('plu_id' => $this->input->post('a')[$i]), 'plu_id') ->row_array();
			
	?>
			<div class="space col-xs-2">
				<center>
					<?php echo $row['Description']; ?>
				</center>
			<img src="<?php echo site_url('cetakqrcode/set_barcode/'.$this->input->post('a')[$i]); ?>" alt=""> 
			</div>

	<?php
			}
		}
	?>
</body>
</html>