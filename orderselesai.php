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
      <a class="navbar-brand" href="index.php">PT. Asri Celebes Mandiri</a>
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
              <a class="nav-link" href="order.php"><i class="fa fa-shopping-cart"></i> 0</a>
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
          <?php
          		  require_once('autonumber.php');
          		  date_default_timezone_set('Asia/Jakarta');
                  $username = $_SESSION['username'];
                  $sql = mysql_query("SELECT * FROM pelanggan WHERE email='$username'");
                  $user = mysql_fetch_array($sql);
                  $total = 0;
	                if (!empty($_SESSION['items'])) {
	                $id_order = kodeotomatis('orders','id_order',6,'ACM-');
	                $id_bayar = kodeotomatis('pembayaran','id_bayar',6,'PAY-');
	                $tgl_order = date('Y-m-d H:i:s');
	                mysql_query("INSERT Into orders VALUES('$id_order','$user[id_pelanggan]','$tgl_order')");
	                mysql_query("INSERT Into pembayaran VALUES('$id_bayar','$id_order','0','')");
	                foreach ($_SESSION['items'] as $key => $val) {
	                $cek = mysql_query("SELECT * FROM produk WHERE id_produk = '$key'");
	                $row = mysql_fetch_array($cek);
	                $stok = $row['stok']-$val;
	                $jumlah_harga = $row['harga'] * $val;
                    $total += $jumlah_harga;
	                $id_item = kodeotomatis('order_items','id_order_item',6,'OID-');
	                mysql_query("INSERT Into order_items VALUES('$id_item','$id_order','$key','$val')");
	                mysql_query("UPDATE produk SET stok='$stok' WHERE id_produk='$row[id_produk]'");
	                unset($_SESSION['items'][$key]);
	            	}
                $auth = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzMjk2ODc3NiwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjU4MDk3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.NDw_3X0Q-ntCBxDybwhpYxEpkbFx1o5l4v3oG-f0NDs";

$sms[0]['phone_number'] = $user['nohp'];
$sms[0]['message'] = "Halo $user[nama_pelanggan], Pesanan Anda ($id_order) Berhasil, Silahkan Bayar Dengan Total Nominal Rp. ".number_format($total,2,",",".")." . Terima Kasih";
$sms[0]['device_id'] = 97585;

$post = json_encode($sms);

$ch = curl_init("https://smsgateway.me/api/v4/message/send");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: $auth"));
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result = curl_exec ($ch);
        curl_close($ch);
	            }else{ 
            header('location:index.php');
        	}
          ?>	

		  		  <div align="center">
		              <h2>Konfirmasi Pesanan</h2>
		              <p>Terima Kasih Telah Memesan</p><br>
		              <h6>Nomor Pesanan Anda : <span class="badge badge-pill badge-success"><?=$id_order?></span></h6>
		              <h6>Total Yang Harus Di Bayar <span class="badge badge-pill badge-info"> Rp. <?=number_format($total,2,",",".");?></span></h6>
		              <h6>Status : <span class="badge badge-pill badge-warning">Pending</span></h6>
		              <br><br>
		              <p>Silahkan Melakukan Pembayaran Untuk Memperbarui Status</p>
		              <small>Bank Untuk Pembayaran :</small>
		              <table>
		                <tr>
		                  <th>BJB</th>
		                  <td><h5><span class="badge badge-info">0060434441001</span></h5></td>
		                </tr>
		              </table>
		              <small>Jika Sudah Melakukan Pembayaran, Mohon Tunggu Untuk Perbaruan Status</small>
		              <center><a href="myorder.php">Klik Disini Untuk Cek Pesanan</a></center>
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
