<?php
session_start();
if(empty($_SESSION['username'])) {
header('location:login.php'); 
}elseif ($_SESSION['level'] == "admin") {
    header('location:../admin/index.php');
}
include '../koneksi.php';
$pending = mysql_num_rows(mysql_query("SELECT * FROM pembayaran WHERE status='0'"));
$sukses = mysql_num_rows(mysql_query("SELECT * FROM pembayaran WHERE status='1'"));
$cancel = mysql_num_rows(mysql_query("SELECT * FROM pembayaran WHERE status='2'"));
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Layanan Informasi Tagihan Pada Perusahaan Alat Kesehatan PT. Asri Celebes Mandiri </title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../dist/css/styles.css" rel="stylesheet">
    <link href="../dist/css/select2.min.css" rel="stylesheet">
    <link href="../dist/sweetalert.css" rel="stylesheet">
    <script src="../dist/sweetalert.min.js"></script>
    <script src="../dist/sweetalert-dev.js"></script>
   	<style type="text/css">
      footer {
    position: fixed;
    height: 100px;
    bottom: 0;
    width: 100%;
}
    </style>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="index.php">Layanan Informasi Tagihan Pada Perusahaan Alat Kesehatan PT. Asri Celebes Mandiri</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      	<ul class="navbar-nav mr-auto"></ul>
        <span class="navbar-text">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <a class="nav-link" href="out.php">Logout</a>
            </li>
        </ul>
        </span>
      </div>
    </nav>
    <br><br><br><br>

    <div class="page-content">
      <div class="row">
        <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="submenu">
                         <a href="#">
                            <i class="fa fa-money"></i> Data Invoice
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="datainvoice.php?s=pending">Pending</a></li>
                            <li><a href="datainvoice.php?s=sukses">Success</a></li>
                            <li><a href="datainvoice.php?s=cancel">Cancel</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                         <a href="#">
                            <i class="fa fa-file"></i> Laporan
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="stok.php">Stok</a></li>
                            <li><a href="penjualan.php">Penjualan</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
				<div class="alert alert-success" role="alert">
				  <h4 class="alert-heading">Selamat Datang PT. Asri Celebes Mandiri</h4>
				</div>

		  	<div class="content-box-header warning">
			  	<div class="panel-title">Data Invoice</div>		
			</div>
				<div class="content-box-large box-with-header">
				<div class="row">
		  		  <div class="col-md-4">
						<div class="alert alert-warning" role="alert">
							<h4 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> Pending!</h4>
							<h1 align="right"><a href="datainvoice.php?s=pending" class="alert-link"><?=$pending?></a></h1>
							<hr>
							<h4 align="right">Invoice.</h4>
						</div>
				</div>
				<div class="col-md-4">
						<div class="alert alert-success" role="alert">
							<h4 class="alert-heading"><i class="fa fa-check"></i> Success!</h4>
							<h1 align="right"><a href="datainvoice.php?s=sukses" class="alert-link"><?=$sukses?></a></h1>
							<hr>
							<h4 align="right">Invoice.</h4>
						</div>
				</div>
				<div class="col-md-4">
						<div class="alert alert-danger" role="alert">
							<h4 class="alert-heading"><i class="fa fa-times"></i> Cancel!</h4>
							<h1 align="right"><a href="datainvoice.php?s=cancel" class="alert-link"><?=$cancel?></a></h1>
							<hr>
							<h4 align="right">Invoice.</h4>
						</div>
				</div>
		  	  </div>
		  	</div>

		  </div>

        </div>
      </div>

     <footer>
         <div class="container">
         
            <div class="copy text-center">
               Layanan Informasi Tagihan Pada Perusahaan Alat Kesehatan PT. Asri Celebes Mandiri
            </div>
            <div class="copy text-center">
			Muhammad Zaki Amansyah © 2018
			</div>
            
         </div>
      </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../dist/js/jquery-1.10.2.min.js"></script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../dist/js/select2.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/custom.js"></script>
  </body>
</html>
