<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url('assets/thema').'/dist/img/AdminLTELogo.png' ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('assets/thema').'/dist/img/user2-160x160.jpg' ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('user'); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('index.php/dashboard'); ?>" class="nav-link active">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Forms
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('index.php/user'); ?>" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Master User</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('index.php/category'); ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Master Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('index.php/barang'); ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Master Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('index.php/cetakqrcode'); ?>" class="nav-link">
                  <i class="fa fa-barcode nav-icon"></i>
                  <p>Print barcode barang</p>
                </a>
              </li>
            </ul>
          </li>
          <!--<li class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('index.php/sales'); ?>" class="nav-link">
                <i class="nav-icon fa fa-cart-arrow-down"></i>
                <p>Transaksi</p>
              </a>
            </li>
          </li> -->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cart-arrow-down"></i>
              <p>
                Transaksi
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('index.php/sales'); ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('index.php/pembelian'); ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Pembelian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('index.php/retur'); ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Retur</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('index.php/login/logout'); ?>" class="nav-link">
                <i class="nav-icon fa fa-sign-out"></i>
                <p>Log-Out</p>
              </a>
            </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>