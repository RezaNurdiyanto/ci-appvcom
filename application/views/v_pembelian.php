<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/sidebar'); ?>

   <link rel="stylesheet" href="<?php echo base_url().'assets/thema/plugins/datatables/jquery.dataTables.min.css' ?>"> 
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/thema/dist/css/adminlte.min.css '?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.css' ?>" rel="stylesheet">
  <link href="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-select.min.css' ?>" rel="stylesheet">


<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				 	<h1 class="m-0 text-dark">Purchase</h1>
				 </div>
				 <div class="col-sm-6">
				 	<ol class="breadcrumb float-sm-right">
				 		<li class="breadcrumb-item"><a href="#">Home</a></li>
				 			<li class="breadcrumb-item active">Purchase</li>
				 	</ol>
				 </div>
			</div>
		</div>
	</div>
							<?php
												if ($this->session->flashdata('error') !='')
												{
													echo '<div class="alert alert-danger" role="alert"> ';
													echo $this->session->flashdata('error');
													echo '</div>';
												}
											?>
											<?php
												if ($this->session->flashdata('success_register') !='')
												{
													echo '<div class="alert alert-info" role="alert"> ';
													echo $this->session->flashdata('success_register');
													echo '</div>';
												}

											?>

 	<section class="content">
 		<div class="row">
 			<div class="col-12">
 				<div class="card">	
						<div class="card-header">
							<h4 class="card-title">List Data Transaksi
								<a style="size: 26px;" href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Bantuan?</small></a>
							</h4>
						</div>
						<br>

						<!--<form action="<?php echo base_url().'index.php/pembelian/add_cart' ?> " method="post"> -->
						<div class="row" style="margin-left: 10px;">
									<div class="col-md-6">
										<div class="card" style="background-color: blue; height: 100px;">
											<div style="padding-top: 10px;">
												<table style="margin-left: 10px; color: white; font: bold; font-family: 'times-new-roman'	; ">
													<tr>
														<td>No Trx</td>
														<td>:</td>
														<td>
															<input type="text" name="notrx" class="form-control" readonly value="<?= $salesno; ?>">
														</td>
														</td>
													
													</tr>
													<tr>
														<td>Tanggal</td>
														<td>:</td>
														<td>
															<input style="text-align: right;" class="form-control" type="text" name="tgl" value="<?= date('d/m/Y') ?>" readonly >
														</td>
													</tr>

												</table>
											</div>
										</div>
									</div>


							<div class="col-md-6">
										<div class="card" style="background-color: blue; height: 100px; margin-right: 10px;">
													<div style="margin-top:0px; margin-left: 10px; font: bold; font-family: 'arial'; color: white; font-size: 80px; text-align: right;"> <?= number_format($this->cart->total()); ?></div>	
										</div>
							</div>
						</div>
 				

 						<div class="row">
									<div class="col-12">
										<div style="background-color: transparent; margin-left: 20px;">
				            <table>
					                       <tr>
					                            <th>Kode Barang</th>
					                        </tr>
					                        <tr>
					                            <th><input type="text" style="width: 180px;" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>                     
					                        </tr>
					                            <div id="detail_barang" style="position:absolute;">
					                            </div>
				            </table>
										</div>
									</div>
							</div>
						<!--</form> -->

									<div class="col-12">
										<div style="background-color: none; margin-top: 10px;">
											<div class="form-row" style="margin-left: 10px; margin-right: 10px;">
												<div class="form-group col-6">
													<div class="pull-left"><a  href="#largeModal" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#largeModal"><span class="fa fa-search"></span> Cari Barang</a></div>
												</div>
												<div class="form-group col-2">
													<label>Nama Kasir : <?php echo $this->session->userdata('user'); ?> </label>
												</div>
											</div>
										</div>
									</div>

								<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="card-body" style="font-size: 16px;">
												<div class="tabel-responsive">
										                <table class="table table-bordered table-striped" >
										                  <thead style="background-color: blue; color: white; font-style: bold;">
										                    <tr>
										                        <th width="5%">Kode</th>
										                        <th>Nama Barang</th>
										                        <th style="text-align: center;" width="5%">satuan</th>
										                        <th width="10%" style="text-align: right">Harga</th>
										                        <th></th>
										                        <th width="5%" style="text-align: center">Qty</th>
										                        <th></th>
										                        <th width="15%" style="text-align: right;">SubTotal</th>
										                        <th width="5%" style="text-align: center;"><i class="fa fa-trash"></th>
										                    </tr>
										                </thead>
										                <tbody style="background-color: white; color: black;">
										                	<?php $i=1; 
										                		  $total = 0;
										                	?>
										                	<?php foreach ($this->cart->contents() as $items): 
										                		?>
										                	<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
										                	<tr>
										                		<td><?=$items['id']; ?></td>
										                		<td><?=$items['name']; ?></td>
										                		<td><?=$items['satuan']; ?></td>
										                		<td style="text-align: right;"><?php echo number_format($items['price']); ?></td>
										                		<td width="2%"><a name="kode_brg" href="<?php echo base_url().'index.php/pembelian/updateqtymin/' .$items['rowid']; ?>" class="btn btn-primary"><i class="fa fa-minus"></i></a></td>
										                		<td style="text-align: center;">					                			
										                			<?php echo number_format($items['qty']); ?>									      
										                			</td>
										                		<td width="2%">	<a name="kode_brg" href="<?php echo base_url().'index.php/pembelian/updateqtyplus/' .$items['rowid']; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a></td>
										                		<td style="text-align: right;"><?php echo number_format($items['subtotal']); ?></td>
										                		<td class="text-center no-padding"><a href="<?php echo base_url(). 'index.php/pembelian/remove/' .$items['rowid']; ?>"class="btn btn-danger btn-block btn-flat"> <i class="fa fa-trash"></i></a></td>
										                	</tr>
										                	<?php $i ++; ?>
										                <?php endforeach; ?>
										                </tbody>
										            	</table>
								            		</div>
											</div>
										</div>
									</div>
								</div>

						<form action="<?php echo base_url().'index.php/pembelian/simpan_penjualan' ?>" method="post">
								<div class="row">
						
								<div class="col-md-6">
									
										<div class="card" style="background-color: none; height: 140px; ">
											<br>

													<table style="font: bold; font-family: 'times-new-roman'; margin-left: 140px; ">
													<tr>
														<td>Bayar</td>
														<td>:</td>
														<td><input style="text-align: right;" type="text" name="bayar" id="bayar" placeholder="0" class="bayar input-sm" ></td>
													</tr>
													<tr>
														<td>Kembalian</td>
														<td>:</td>
														<td><input style="text-align: right;" type="text" name="Kembalian" id="Kembalian" readonly placeholder="0" class="Kembalian input-sm"  ></td>
														<input type="hidden" name="kembalian1" id="kembalian1">
													</tr>
												</table>
												<div><button style="margin-left: 10px;" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Simpan</button>
												<button style="margin-left: 430px;" type="submit" class="btn btn-primary"><i class="fa fa-edit"?></i>Batal</button>
												</div>
										</div>
																		</div>

									<div class="col-md-6">
											<div class="card" style="background-color: none; height: 140px; ">
												<table  style="font: bold; font-family: 'times-new-roman'; margin-top: 10px; margin-left: 240px; ">
													<tr>
														<td style="font-size: 20px;font:bold;" >Sub Total</td>
														<td>:</td>
														<td style="font-size: 15px;font:bold;" ><input type="text" style="text-align: right;" name="subtotal" readonly value="<?= number_format($this->cart->total()); ?>">
														</td>
													</tr>
													<tr>
														<td style="font-size: 20px;font:bold;">Diskon</td>
														<td>:</td>
														<td style="font-size: 15px;font:bold;"><input  style="text-align: right;" type="text" name="diskon"  id="diskon" placeholder="0"></td>
													</tr>
													<tr>
														<td style="font-size: 20px;font:bold;">Total</td>
														<td>:</td>
														<td style="font-size: 15px;font:bold;"><input style="text-align: right;" type="text" name="total" id="total" value="<?= number_format($this->cart->total()); ?>" ></td>
														<input type="hidden" name="total1" id="total1" value="<?= $this->cart->total(); ?>">
													</tr>
												</table>
											</div>
									</div>

	
								</div>
							</form>

					</div>
 			</div>
 		</div>
 	</section>



	<!-- Tampil data -->

	<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel">Data Barang</h3>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>

				</div>
				<div class="modal-body" style="overflow: scroll;height: 500px;">
					<table class="table table-bordered table-striped" style="font-size: 11px;" id="mydata">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Satuan</th>
								<th>Harga</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=0;
							foreach ($barang->result_array() as $k ):
								$no++;
								$id=$k['plu_id'];
								$nm=$k['Description'];
								$st=$k['satuan'];
								$pr=$k['Price'];

							?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $id; ?></td>
									<td><?php echo $nm; ?></td>
									<td><?php echo $st; ?></td>
									<td><?php echo $pr; ?></td>
									<td style="text-align: center;">
										<form action="<?php echo base_url().'index.php/pembelian/add_cart' ?>" method="post">

											<input type="hidden" name="kode_brg" value="<?php echo $id; ?>">
											<input type="hidden" name="nama" value="<?php echo $nm; ?>">
											<input type="hidden" name="satuan" value="<?php echo $st; ?>">
											<input type="hidden" name="price" value="<?php echo number_format($pr); ?>">
											<input type="hidden" name="qty" value="1" required>
												<button type="submit" class="btn btn-sm btn-primary" title="pilih"><span class="fa fa-edit"></span>Pilih</button>
										</form>	
									</td>
								</tr>
						<?php endforeach; ?>
						</tbody>
						
					</table>
				</div>
				<div class="modal-footer">
						<button type="btn" data-dismiss="modal" ari-hidden="true">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('template/footer'); ?>
<script src="<?php echo base_url('assets/thema'); ?>/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
<script src="<?php echo base_url().'assets/thema/plugins/datatables/jquery.dataTables.min.js '?>"></script>
<script type="text/javascript">
	$(function(){
		$('#bayar').on("input", function() {
			var diskon=$('#diskon').val();
			var total=$('#total1').val();
			var jml_uang=$('#bayar').val();
			var hsl = jml_uang.replace(/[^\d]/g,"");
			$('#jml_uang2').val(hsl);
			$('#Kembalian').val(hsl-total);
		})
	});
</script>
<script>
	$(function() {
		$('.bayar').priceFormat({
			prefix: '',
			centsLimit : 0,
			thousandsSeparator: ','
		});
		$('#jml_uang2').priceFormat({
			prefix : '',
			centsLimit : 0,
			thousandsSeparator: ''
		});
		$('#Kembalian').priceFormat({
			prefix : '',
			centsLimit : 0,
			thousandsSeparator : ','
		});
	});
</script>

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

    <script type="text/javascript">
        $(document).ready(function(){
            //Ajax kabupaten/kota insert
            $("#kode_brg").focus();
            $("#kode_brg").on("input",function(){
                var kobar = {kode_brg:$(this).val()};
                   $.ajax({
               type: "POST",
               url : "<?php echo base_url().'index.php/pembelian/get_barang';?>",
               data: kobar,
               success: function(msg){
               $('#detail_barang').html(msg);
               }
            });
            }); 

            $("#kode_brg").keypress(function(e){
                if(e.which==13){
                    $("#qty").focus();
                }
            });
        });
    </script>
    <script>
    	function editQty(qty, aksi, kode_brg) {
    		var posting = $.post('<?= base_url() ?>index.php/pembelian/updateqty', {
    			kode_brg : kode_brg,
    			aksi : aksi,
    			qty : qty
    		});
    	}
    </script>