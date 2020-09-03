<!DOCTYPE html>
<html>
<head>
	<title>Data Mahasiswa</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h2>Data <small>Mahasiswa</small></h2>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add New</button>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>NIM</th>
						<th>NAMA</th>
						<th>PRODI</th>
						<th>price</th>
						<th>barcode</th>
						<th>QR CODE</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data->result() as $row):?>
					<tr>
						<td style="vertical-align: middle;"><?php echo $row->plu;?></td>
						<td style="vertical-align: middle;"><?php echo $row->description;?></td>
						<td style="vertical-align: middle;"><?php echo $row->satuan;?></td>
						<td><?php echo $row->price; ?></td>
						<td><?php echo $row->barcode; ?></td>
						<td><img style="width: 100px;" src="<?php echo base_url().'assets/images/'.$row->qr;?>"></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal add new mahasiswa-->
	<form action="<?php echo base_url().'index.php/product/simpan'?>" method="post">
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Add New Mahasiswa</h4>
		      </div>
		      <div class="modal-body">
		    
		          <div class="form-group">
		            <label for="nim" class="control-label">NIM:</label>
		            <input type="text" name="plu" class="form-control" id="nim">
		          </div>
		          <div class="form-group">
		            <label for="nama" class="control-label">NAMA:</label>
		            <input type="text" name="description" class="form-control" id="nama">
		          </div>
		         <div class="form-group">
		            <label for="nama" class="control-label">NAMA:</label>
		            <input type="text" name="satuan" class="form-control" id="nama">
		          </div>
		          <div class="form-group">
		            <label for="nama" class="control-label">NAMA:</label>
		            <input type="text" name="price" class="form-control" id="nama">
		          </div>
	       		  <!--<div class="form-group">
		            <label for="prodi" class="control-label">PRODI:</label>
		            <select name="prodi" class="form-control" id="prodi">
		            	<option>Sistem Informasi</option>
		            	<option>Sistem Komputer</option>
		            	<option>Manajemen Informatika</option>
		            </select>
		          </div>-->
	        
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		        <button type="submit" class="btn btn-primary">Simpan</button>
		      </div>
		    </div>
		  </div>
		</div>
	</form>

</body>
</html>