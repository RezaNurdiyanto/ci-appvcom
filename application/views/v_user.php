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
					<h1 class="m-0 text-dark">User</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">User</li>
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
							<h3 class="card-title">List Data User
							<div class="pull-right"><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span>
								Tambah User</a></div>
							</h3>
						</div>
						<div class="card-body">
							<table id="mydata" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th>UserName</th>
										<th>Name</th>
										<th>status</th>
										<th style="text-align: center;">aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$no=0;
									foreach($user->result_array() as $k):
										$no++;
										$id=$k['id'];
										$nm=$k['username'];
										$ne=$k['name'];
										$st=$k['status'];
								?>
									
										<tr>
											<td><?php echo $id; ?></td>
											<td><?php echo $nm; ?></td>
											<td><?php echo $ne; ?></td>
											<td><?php echo $st; ?></td>
											<td class="text-center">
											<a class="btn btn-sm btn-success" href="#modalEditUser<?php echo $id ?>" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span>Edit</a>
											<a class="btn btn-sm btn-danger" href="#modalHapusUser<?php echo $id ?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span>Hapus</a>
										</tr>
										<?php endforeach ?>
									</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
	</section>

	<!-- Tambah Data -->

	<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel">Tambah User</h3>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo base_url().'index.php/user/tambah_user' ?>">
					<div class="modal-body">
						<table class="table">
							<div class="form-group">
								<label class="control-label col-xs-3">User Name</label>
								<div class="col-xs-9">
									<input name="username" class="form-control" type="text" placeholder="user name" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-9">Name</label>
								<div class="col-xs-9">
									<input name="name" class="form-control" type="text" placeholder="name.." required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-9">email</label>
								<div class="col-xs-9">
									<input name="email" class="form-control" type="text" placeholder="email.." required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-9">password</label>
								<div class="col-xs-9">
									<input type="password" name="password" class="form-control" placeholder="password.." required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-9">status</label>
								<div class="col-xs-9">
									<input name="status" type="text" class="form-control" placeholder="status.." readonly value="Active">
								</div>
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


	<?php
		foreach($user->result_array() as $k){
			$id=$k['id'];
			$usrname = $k['username'];
			$name = $k['name'];
			$email = $k['email'];
			$password = $k['password'];
			$status = $k['status'];
	?>
	<div class="modal fade" id="modalEditUser<?php echo $id; ?>" role="dialog" aria-hidden="true" tab-index="-1" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title" id="myModalLabel">Edit User </div>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				</div>
				<form class="form-horizontal" method="POST" action="<?php echo base_url().'index.php/user/edit_user' ?>">
					<div class="modal-body">
						<div class="form-group">
							<div class="control-label col-xs-3">ID user</div>
								<div class="col-xs-9">
									<input name="id" class="form-control" type="text" value="<?php echo $id; ?>" readonly >
								</div>
						</div>
						<div class="form-group">
							<div class="control-label col-xs-3">User Name</div>
								<div class="col-xs-9">
									<input name="usrname" class="form-control" type="text" value="<?php echo $usrname; ?>" placeholder="user name.." required>
								</div>
						</div>
						<div class="form-group">
							<div class="control-label col-xs-3">Name</div>
								<div class="col-xs-9">
									<input name="name" class="form-control" type="text" value="<?php echo $name; ?>" placeholder="name.." required>
								</div>
						</div>
						<!--<div class="form-group">
							<div class="control-label col-xs-3">password</div>
								<div class="col-xs-9">
									<input name="password" class="form-control" type="password" value="<?php echo $password; ?>" placeholder="password.." required>
								</div>
						</div> -->
						<div class="form-group">
							<div class="control-label col-xs-3">status</div>
								<div class="col-xs-9">
									<select name="status" class="form-control" id="status">
										<?php
											if ($status =="Active") {
												echo "<option selected>Active</option>
													  <option>Non Active</option>";
											} else {
												echo "<option selected>Non Active</option>
													  <option>Active</option>";
											}

										?>
									</select>
								</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
						<button class="btn btn-info">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>


<!-- Hapus Data -->
	<?php
		foreach($user->result_array() as $k){
			$id=$k['id'];
			$usrname = $k['username'];
			$name = $k['name'];
			$email = $k['email'];
			$password = $k['password'];
	?>
	<div class="modal fade" id="modalHapusUser<?php echo $id; ?>" role="dialog" tab-index=-1 aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel">Hapus User </h3>
				</div>
				<form class="form-horizontal" method="POST" action="<?php echo base_url().'index.php/user/hapus_user' ?>">
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

<?php $this->load->view('template/footer'); ?>

<script src="<?php echo base_url().'assets/thema/plugins/datatables/jquery.dataTables.min.js '?>"></script>
<script>
  $(function () {
    $('#mydata').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>