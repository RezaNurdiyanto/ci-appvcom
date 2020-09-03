<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/sidebar'); ?>

<link rel="stylesheet" href="<?php echo base_url().'assets/thema/plugins/datatables/jquery.dataTables.min.css' ?>">

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Category</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Category</li>
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
						<h3 class="card-title">List Data Category
						<div class="pull-right"><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span>Tambah Baru</a></div>
						</h3>
					</div>
					<div class="card-body">
						<table id="mydata" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Description</th>
									<th style="text-align: center;">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($category->result_array() as $k):
									$id=$k['plu_cat'];
									$nm=$k['Description'];
								?>
								<tr>
									<td><?php echo $id; ?></td>
									<td><?php echo $nm; ?></td>
									<td style="text-align: center;">
										<a class="btn btn-sm btn-success" href="#modalEditCategory<?php echo $id ?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span>Edit</a>
										<a class="btn btn-sm btn-danger" href="#modalHapusCategory<?php echo $id ?>" data-toggle="modal" title="Hapus"><span class="fa fa-hapus"></span>Hapus</a>
									</td>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--Tambah Data -->

	<div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content bg-primary">
				<div class="modal-header">
					<h3 class="modal-title" id="myModallabel">Tambah Category</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="close">
	 					<span aria-hidden="true">&times;</span></button>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/category/tambah_category' ?>">
					<div class="modal-body">
						<table class="table">
							<div class="form-group">
								<label class="control-label col-xs-3">Nama Category</label>
								<div class="col-xs-9">
									<input name="description" class="form-control" type="text" placeholder="nama category..." required>
								</div>
							</div>
						</table>
					</div>
			 			<div class="modal-footer justify-content-between">
			 				<button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
			 				<button class="btn btn-outline-light">save</button>
			 			</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Eit Data -->
	<?php
		foreach ($category->result_array() as $k){
		$id=$k['plu_cat'];
		$nm=$k['Description'];
	?>
	<div class="modal fade" tabindex="-1" id="modalEditCategory<?php echo $id; ?>" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModallabel">Edit Category</h3>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/category/edit_category' ?> ">
					<div class="modal-body">
						<div class="form-group">
							<div class="control-label col-xs-3">ID Category</div>
							<div class="col-xs-9">
								<input name="id" class="form-control" type="text" value="<?php echo $id; ?>" placeholder="id category" readonly>
							</div>
						</div>
						<div class="form-group">
							<div class="control-label col-xs-3">Nama Category</div>
							<div class="col-xs-9">
								<input name="description" class="form-control" type="text" value="<?php echo $nm; ?>" placeholder="nama category.." required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
						<button  class="btn btn-info">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>

<!-- Hapus Data -->
	<?php
		foreach ($category->result_array() as $k){
		$id=$k['plu_cat'];
		$nm=$k['Description'];
	?>
	<div class="modal fade" id="modalHapusCategory<?php echo $id; ?>" role="dialog" tab-index=-1 aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel">Hapus User </h3>
				</div>
				<form class="form-horizontal" method="POST" action="<?php echo base_url().'index.php/category/hapus_cat' ?>">
					<div class="modal-body">
						<p>Apakah yakin ingin menghapus data ini </p>
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


</div>

<?php $this->load->view('template/footer'); ?>

<script src="<?php echo base_url().'assets/thema/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
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