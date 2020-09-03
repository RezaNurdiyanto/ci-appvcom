<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
    <!-- Font Awesome Icons -->
  <link rel="icon" href="<?php echo base_url().'/assets/images/PC-a-icon.png' ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/thema').'/plugins/font-awesome/css/font-awesome.min.css' ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/thema').'/dist/css/adminlte.min.css' ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/thema').'/plugins/iCheck/flat/blue.css' ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('assets/thema').'/plugins/morris/morris.css' ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/thema').'/plugins/jvectormap/jquery-jvectormap-1.2.2.css' ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/thema').'/plugins/datepicker/datepicker3.css' ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" rhref="<?php echo base_url('assets/thema').'/plugins/daterangepicker/daterangepicker-bs3.css' ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/thema').'/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css' ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url().'index.php/dashboard' ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>


  </nav>
  <!-- /.navbar -->