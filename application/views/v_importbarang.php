 <?php $this->load->view('template/header'); ?>
 <?php $this->load->view('template/sidebar'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				 	<h1 class="m-0 text-dark">Upload Barang</h1>
				 </div>
				 <div class="col-sm-6">
				 	<ol class="breadcrumb float-sm-right">
				 		<li class="breadcrumb-item"><a href="#">Home</a></li>
				 			<li class="breadcrumb-item active">Upload Barang</li>
				 	</ol>
				 </div>
			</div>
		</div>
	</div>

		<div class="container" style="margin-top: 100px">
		    <div class="row">
		        <div class="col-md-8 offset-2">
		            <?php echo $this->session->flashdata('notif') ?>
		            <form method="POST" action="<?php echo base_url() ?>index.php/barang/upload" enctype="multipart/form-data">
		              <div class="form-group">
		                <label for="exampleInputEmail1">UNGGAH FILE EXCEL</label>
		                <input type="file" name="userfile" class="form-control">
		              </div>

		              <button type="submit" class="btn btn-success">UPLOAD</button>
		            </form>
		        </div>
		    </div>
		</div>

</div>

 <?php $this->load->view('template/footer'); ?>
