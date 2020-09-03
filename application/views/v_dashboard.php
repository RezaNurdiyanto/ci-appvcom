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
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				 	<h1 class="m-0 text-dark">Welcome To Dashboard</h1>
				 </div>
				 <div class="col-sm-6">
				 	<ol class="breadcrumb float-sm-right">
				 		<li class="breadcrumb-item"><a href="#">Home</a></li>
				 			<li class="breadcrumb-item active">Dashboard</li>
				 	</ol>
				 </div>
			</div>
		</div>
	</div>
	<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $sales; ?></h3>

                <p>Transaksi Hari ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $product; ?> </h3>
                <!--<sup style="font-size: 20px">%</sup></h3> -->

                <p>Product Yang Terjual Hari ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $user; ?></h3>

                <p>Total User</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $data; ?></h3>

                <p>Total Transaksi Bulan ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </section>

     <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">List Stock Barang </h3>
            </div>
              <div class="card-body">
                <table id="mydata" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width:1px;">No</th>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Stock Awal </th>
                      <th>Sales</th>
                      <th>Receive</th>
                      <th>Retur</th>
                      <th>Stock Akhir</th>
                    </tr>
                  </thead>
                    <tbody>
                      <?php
                       $no=0;
                      $query=$this->db->query("Call Stock()");
                      foreach($query->result_array() as $k):                          
                          $no++;
                          $kd=$k['plu_id'];
                          $nm=$k['Description'];
                          $op=$k['Opening'];
                          $sl=$k['Sales'];
                          $rc=$k['Penerimaan'];
                          $rt=$k['Retur'];
                          $st=$k['TotQty'];
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $kd; ?></td>
                        <td><?php echo $nm; ?></td>
                        <td><?php echo $op; ?></td>
                        <td><?php echo $sl; ?></td>
                        <td><?php echo $rc; ?></td>
                        <td><?php echo $rt; ?></td>
                        <td><?php echo $st; ?></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
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