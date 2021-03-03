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
    <link rel="stylesheet" type="text/css" href="dist/datatables/css/dataTables.bootstrap4.min.css">
    <link href="dist/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="dist/css/styles.css" rel="stylesheet">
    <link href="dist/css/select2.min.css" rel="stylesheet">
    <link href="dist/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css">
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
                      <a class="nav-link" href="myorder.php">Pesanan </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="akun.php">Akun </a>
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
        <div class="content-box-header success">
          <div class="panel-title" style="color: #fff;">Pesanan</div>   
        </div>
				<div class="content-box-large box-with-header">
          <table class="table" id="tablebr">
          <thead>
                  <tr>
                    <th>No</th>
                    <th>ID ORDER</th>
                    <th>Tanggal Order</th>
                    <th>Status Pembayaran</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  error_reporting(0);
                  $pel = mysql_query("SELECT * FROM pelanggan WHERE email='$_SESSION[username]'");
                  $cek = mysql_fetch_array($pel);
                  $sql = mysql_query("SELECT DISTINCT(order_items.id_order),orders.*,pembayaran.* FROM orders,order_items,pembayaran WHERE order_items.id_order=orders.id_order AND pembayaran.id_order=orders.id_order AND orders.id_pelanggan='$cek[id_pelanggan]'");
                  $no = 1;
                  while ($row = mysql_fetch_array($sql)) {
                    echo '
                    <tr>
                      <td>'.$no.'</td>
                      <td><a href="invoice.php?id='.$row[id_order].'" target="_blank">'.$row[id_order].'</a></td>
                      <td>'.$row[tgl_order].'</td>
                      <td>';
                      if ($row['status'] == 0) {
                        echo '<span class="badge badge-pill badge-warning">Pending</span>';
                      }elseif ($row['status'] == 1) {
                        echo '<span class="badge badge-pill badge-success">Sudah Dibayar</span>';
                      }elseif ($row['status'] == 2) {
                        echo '<span class="badge badge-pill badge-danger">Dibatalkan</span>';
                      }
                      echo'</td>
                      </tr>
                    ';$no++;
                  }
                  ?>
                </tbody>
                </table>
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
    <script src="dist/js/jquery.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/select2.min.js"></script>
    <script src="vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>

    <script src="vendors/ckeditor/ckeditor.js"></script>
    <script src="vendors/ckeditor/adapters/jquery.js"></script>
    <script type="text/javascript" src="vendors/tinymce/js/tinymce/tinymce.min.js"></script>

    <script src="dist/js/custom.js"></script>
    <script src="dist/js/editors.js"></script>
    <script type="text/javascript" src="dist/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="dist/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function() {
    $('#tablebr').DataTable();
    });
    </script>
  </body>
</html>
