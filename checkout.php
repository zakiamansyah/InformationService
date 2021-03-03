<?php require_once("koneksi.php");
if (!isset($_SESSION)) {
  session_start();
} 
if(empty($_SESSION['username'])) {
  $_SESSION['REAL_REFERER'] = $_SERVER['HTTP_REFERER'];

  $referer = '';
  if (isset($_SESSION['REAL_REFERER'])) {
      $referer = $_SESSION['REAL_REFERER'];
      // unset($_SESSION['REAL_REFERER']);
  }
  else {
      $referer = $_SERVER['HTTP_REFERER'];
  }
  header('location:login.php'); 
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Layanan Informasi Tagihan Pada Perusahaan Alat Kesehatan PT. Asri Celebes Mandiri</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="dist/css/styles.css" rel="stylesheet">
    <link href="dist/css/select2.min.css" rel="stylesheet">
    <link href="dist/sweetalert.css" rel="stylesheet">
    <script src="dist/sweetalert.min.js"></script>
    <script src="dist/sweetalert-dev.js"></script>
   	<style type="text/css">
      footer {
    /*position: fixed;*/
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
      	<ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <?php 
            if (!empty($_SESSION['username'])) {
              echo '<li class="nav-item">
                      <a class="nav-link" href="myorder.php">Pesanan</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="akun.php">Akun</a>
                    </li>';
            }
            ?>
        </ul>
        <span class="navbar-text">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <?php 
              if(isset($_SESSION['items'])){
              echo '<a class="nav-link" href="order.php"><i class="fa fa-shopping-cart"></i> '.count($_SESSION['items']).'</a>'; 
              }else{
              echo '<a class="nav-link" href="order.php"><i class="fa fa-shopping-cart"></i> 0</a>'; 
              }
              ?>
            </li>
            <li class="nav-item">
            <?php 
            if (empty($_SESSION['username'])) {
              echo '<a class="nav-link" href="login.php">Login</a>';
            }else{
              echo '<a class="nav-link" href="out.php">Logout</a>';
            }
            ?>
            </li>
        </ul>
        </span>
      </div>
    </nav>
    <br><br><br><br>

    <div class="container">
      <div class="row">
		  <div class="col-lg-12">

				<div class="content-box-large box-with-header">
				<div class="row">
          <?php
                  $username = $_SESSION['username'];
                  $sql = mysql_query("SELECT * FROM pelanggan WHERE email='$username'");
                  $user = mysql_fetch_array($sql);
          ?>

		  		  <div class="col-md-8">
              <h4>Data Pelanggan</h4>
              <table class="table">
                <tr>
                  <td>Nama</td><td><?=$user['nama_pelanggan']?></td>
                </tr>
                <tr>
                  <td>Alamat</td><td><?=$user['alamat']?></td>
                </tr>
                <tr>
                  <td>Email</td><td><?=$user['email']?></td>
                </tr>
                <tr>
                  <td>No Telp</td><td><?=$user['nohp']?></td>
                </tr>
              </table>
              <h3>Metode Pembayaran</h3>
              <h5>Bank Transfer</h5>
				    </div>

            <div class="col-md-4">
              <h4>Order Items</h4>
              <table class="table">
                <?php      
                error_reporting(0);          
                $total = 0;
                if (!empty($_SESSION['items'])) {
                foreach ($_SESSION['items'] as $key => $val) {
                $sql = mysql_query("SELECT * FROM produk WHERE id_produk = '$key'");
                $row = mysql_fetch_array($sql);

                $jumlah_harga = $row['harga'] * $val;
                $total += $jumlah_harga;
                ?>
            <tr>
              <td>
                ID Produk : <?=$row['id_produk']?><br>
                Nama Produk : <?=$row['nama_produk']?><br>
                Harga : Rp. <?=number_format($row['harga'],2,",",".");?><br>
              </td>
              <td><?=$val?></td>
              <td>Rp. <?=number_format($jumlah_harga,2,",",".");?></td>
            </tr>
            <?php }
            ?> 
              </table>
              <a href="orderselesai.php" class="btn btn-success"><i class="fa fa-shopping-cart icon-white"></i> Proses &raquo;</a>
            </div>
          <?php 
          }else{ 
            header('location:index.php');
          }?>
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
    <script src="dist/js/jquery-1.10.2.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/select2.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/custom.js"></script>
  </body>
</html>
