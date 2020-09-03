 <?php $this->load->view('template/header'); ?>
 <?php $this->load->view('template/sidebar'); ?>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
 
   <link rel="stylesheet" href="<?php echo base_url().'assets/thema/plugins/datatables/jquery.dataTables.min.css' ?>"> 

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/thema/dist/css/adminlte.min.css '?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				 	<h1 class="m-0 text-dark">Barang</h1>
				 </div>
				 <div class="col-sm-6">
				 	<ol class="breadcrumb float-sm-right">
				 		<li class="breadcrumb-item"><a href="#">Home</a></li>
				 			<li class="breadcrumb-item active">Barang</li>
				 	</ol>
				 </div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">List Data Barang
						<a href="<?php echo base_url('index.php/barang/export') ?>" class="btn btn-sm btn-success"><span class="fa fa-edit"></span>Export To Excel</a>
						<a href="<?php echo base_url('index.php/barang/importexcel') ?>" class="btn btn-sm btn-danger"><span class="fa fa-edit"></span>Import From Excel</a>
						<a href="<?php echo base_url('index.php/barang/exportpdf') ?>" class="btn btn-sm btn-success"><span class="fa fa-edit"></span>Export From pdf</a>
						<div class="pull-right"><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Barang</a></div>
						</h3>
					</div>
					<div class="card-body">
						<form method="post" action="<?php echo base_url('index.php/barang/delete') ?>" id="form-delete">
						<table id="mydata" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><input type="checkbox" id="check-all"></th>
									<th>No</th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Satuan</th>
									<th>Category</th>
									<th>Harga</th>
									<th>qr code</th>
									<th style="text-align: center;">Aksi</th>
									
								</tr>
							</thead>
							<tbody>
								<?php 
									$no=0;
									foreach ($barang->result_array() as $k):
										$no++;
										$id=$k['plu_id'];
										$nb=$k['Description'];
										$st=$k['satuan'];
										$ct=$k['Descat'];
										$hr=$k['Price'];
										$qr=$k['qr_code'];
									?>
									<tr>
										<td style="width: 10px;"><input type="checkbox" class="check-item" name="id[]" value="<?php echo $id; ?>"></td>
										<td><?php echo $no; ?></td>
										<td><?php echo $id; ?></td>
										<td><?php echo $nb; ?></td>
										<td><?php echo $st; ?></td>
										<td><?php echo $ct; ?></td>
										<td style="text-align: right;"><?php echo 'Rp ' .number_format($hr); ?></td>
										<td><img style="width: 100px;" src="<?php echo base_url().'assets/images/'.$qr; ?>"></td>
										<td class="text-center">
											<a class="btn btn-sm btn-success" href="#modalEditBarang<?php echo $id ?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span>Edit</a>
											<a class="btn btn-sm btn-danger" href="#modalHapusBarang<?php echo $id ?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span>Hapus</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<hr>
						<button type="button" id="btn-delete" class="btn btn-sm btn-danger" >Delete</button>					</form>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Form Tambah Data Barang -->
	<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel">Tambah Barang</h3>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/barang/tambah_barang'?>">
					<div class="modal-body">
						<table class="table">
							<div class="form-group">
								<label class="control-label col-xs-3">Nama Barang</label>
								<div class="col-xs-9">
									<input name="description" class="form-control" type="text" placeholder="Nama Barang..." required>
								</div>
							</div>
							<div class="form-group">
								<label for="satuan" class="control-label">satuan</label>
								<select name="satuan" class="form-control" id="satuan">
									<option>PCS</option>
									<option>UNIT</option>
									<option>Box</option>
								</select>
							</div>
								<div class="form-group">
									<label class="control-label col-xs-3">Category</label>
									 <select name="category" class="selectpicker show-tick form-control" data-live-search="true" title="pilih salah satu" data-width="100%" onchange="category()">
								                    <?php 
								                        $query=$this->db->query("SELECT * from category");
								                        foreach ($query->result_array() as $i) {
								                              $kd=$i['plu_cat'];
								                              $nm=$i['Description'];
								                              $sess_id=$this->session->userdata('category');
								                              if($sess_id==$kd)
								                                    echo "<option value='$kd' selected>$nm</option>";
								                               else
								                                  	echo "<option value='$kd'>$nm</option>";
								                    } ?>
								     </select>
								</div>
							<div class="form-group">
								<label class="control-label col-xs-3">Harga</label>
								<input type="price" name="price" class="price form-control" type="value" placeholder="Harga...">
							</div>
						</table>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
						<button class="btn btn-info">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Edit Data -->

	<?php 
		foreach($barang->result_array() as $k){
			$id=$k['plu_id'];
			$nm=$k['Description'];
			$st=$k['satuan'];
			$pr=$k['Price'];
	?>
	<div id="modalEditBarang<?php echo $id; ?>" class="modal fade" tabindex="-1"  role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title" id="myModalLabel">Edit Barang</div>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				</div>
				<form class="form-horizontal" method="POST" action="<?php echo base_url().'index.php/barang/edit_barang' ?>">
					<div class="modal-body">
						<div class="form-group">
							<div class="control-label col-xs-3">Kode Barang</div>
							<div class="col-xs-9">
								<input name="id" class="form-control" type="text" value="<?php echo $id; ?>" placeholder="kode barang.."  readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="control-label col-xs-3">Nama Barang</div>
							<div class="col-xs-9">
								<input name="description" class="form-control" type="text" value="<?php echo $nm; ?>" placeholder="nama barang.."  required>
							</div>
						</div>
						<div class="form-group">
							<div class="control-label col-xs-3">Satuan </div>
							<div class="col-xs-9">
								<input name="satuan" class="form-control" type="text" value="<?php echo $st; ?>" placeholder="satuan.. " required>
							</div>
						</div>
						<div class="form-group">
							<div class="contorl-label col-xs-3">Harga </div>
							<div class="col-xs-9">
								<input name="price" class="price form-control" type="text" value="<?php echo $pr; ?>" placeholder="price..." required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
							<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
							<button type="submit" class="btn btn-info">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php } ?>

	<!-- hapus data -->
	<?php
		foreach($barang->result_array() as $k) {
			$id=$k['plu_id'];
			$nm=$k['Description'];
			$st=$k['satuan'];
			$hr=$k['Price'];
	?>
	<div id="modalHapusBarang<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel">Hapus Barang</h3>
				</div>
				<form class="form-horizontal" method="POST" action="<?php echo base_url().'index.php/barang/hapus_barang' ?>">
					<div class="modal-body">
						<p>Apakah Yakin ingin menghapus data dengan kode <?php echo $id; ?> dengan nama <?php echo $nm; ?>  ini..?</p>
						<input name="id" type="hidden" value="<?php echo $id; ?>">
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
						<button type="submit" class="btn btn-primary">Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php } ?>

	
</div>

<?php $this->load->view('template/footer'); ?>

<script src="<?php echo base_url().'assets/thema/plugins/datatables/jquery.dataTables.min.js '?>"></script>
<script src="<?php echo base_url().'assets/js/jquery.price_format.min.js' ?>"></script>
<script>
  $(function () {
    $('#mydata').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });
</script>
 <!--   <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable({
                "language": {
                    "search":"Cari",
                    "info":"Menampilkan _START_ Sampai _END_ Dari _TOTAL_ data",
                    "lengthMenu":"Menampilkan _MENU_ baris",
                    "infoEmpty":"Tidak ditemukan",
                    "infoFiltered":"(pencarian dari _MAX_ data)",
                    "zeroRecords":"Data tidak ditemukan",
                    "paginate": {
                        "next":"Selanjutnya",
                        "previous":"Sebelumnya",
                    }
                }
            });
        } );
    </script>-->
<script type="text/javascript">
	$(function() {
		$('.price').priceFormat({
			prefix: '',
			centsLimit : 0,
			thousandsSeparator:','
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#check-all").click(function(){
			if($(this).is(":checked"))
				$(".check-item").prop("checked",true);
			else
				$(".check-item").prop("checked",false);
		});

		$("#btn-delete").click(function() {
			var confirm = window.confirm("Apakah anda yakin ingin menghapus data ini?")

		if(confirm)
			$("#form-delete").submit();
		});
	});
</script>