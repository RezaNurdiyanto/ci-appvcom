<?php
	error_reporting(0);
	$b=$brg->row_array();
?>
<form action="<?php echo base_url().'index.php/pembelian/add_cart' ?> " method="post">
<table>
	<tr>
		<th style="width:200px;"></th>
		<th>Nama Barang</th>
		<th>Satuan</th>
		<th>Price(Rp)</th>
		<th>jumlah</th>
	</tr>
	<tr>
		<td style="width:200px;"></td>
		<input type="hidden" name="kode_brg" value="<?php echo $b['plu_id']; ?>">
		<td><input type="text" name="nama" value="<?php echo $b['Description']; ?>" style="width:660px;margin-right:5px;" class="form-control input-sm" readonly></td>
		<td><input type="text" name="satuan" value="<?php echo $b['satuan']; ?>" style="width:80px;margin-right:5px;" class="form-control input-sm" readonly></td>
		<td><input type="text" name="price" value="<?php echo number_format($b['Price']); ?> " style="width:120px;margin-right:5px;" class="form-control input-sm" readonly></td>
		<td><input type="number" name="qty" id="qty" value="1" min="1" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
		<td><button type="submit" class="btn btn-sm btn-primary">Ok</button></td>
	</tr>
</table>
</form>
