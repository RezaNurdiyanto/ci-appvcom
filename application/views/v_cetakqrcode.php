<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/sidebar'); ?>

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
 
   <link rel="stylesheet" href="<?php echo base_url().'assets/thema/plugins/datatables/jquery.dataTables.min.css' ?>"> 

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/thema/dist/css/adminlte.min.css '?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


<div class="content-wrapper">
	<div class="content-header">
		<div class="container->fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Cetak Qr Code Barang</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Cetak Qr Code Barang</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
				<form method="post" target="_BLANK" action="<?php echo base_url('index.php/cetakqrcode/qrcode_proses') ?>">
					<div class="card-header">
						<h3 class="card-title">List Data Barang</h3>
						<button type="submit" class="pull-right btn btn-primary btn-sm">Proces Cetak</button>
					</div>
					<div class="card-body">
						
							<table id="mydata" class="table table-bordered table-striped">

							<thead>
								<tr>
									<th style="width: 10px;">No</th>
									<th style="width: 120px;">Jml Cetak</th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Satuan</th>
									<th>Harga</th>
								</tr>
							</thead>
							<tbody>
								
								<?php
								$no=0;
								foreach($barang->result_array() as $k){
									$no++;
									$id=$k['plu_id'];
									$nm=$k['Description'];
									$st=$k['satuan'];
									$pr=$k['Price'];
									$kl=$k['qr_code'];
								?>
								<!--<tr>
									<td><?php echo $no; ?></td>
									<input type="hidden" name="a[$no]" value="<?php echo $id ?>">
									<td><input type="number" name="b[$no]" value="0" style="width: 100%;"></td>
									<td><?php echo $id; ?></td>
									<td><?php echo $nm; ?></td>
									<td><?php echo $st; ?></td>
									<td><?php echo $pr; ?></td>
								</tr>-->


							<?php
							echo "<tr>
									<td>$no</td>
									<input type='hidden' name='a[$no]' value='$k[plu_id]'>
									<td><input type='number' name='b[$no]' value='0' style='width:100%'; </td>
									<td>$k[plu_id]</td>
									<td>$k[Description]</td>
									<td>$k[satuan]</td>
									<td style='text-align: right;'>Rp $k[Price]</td>
								</tr>";
								}
							?>
							</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

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