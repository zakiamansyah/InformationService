<?php 
error_reporting(0);
session_start();
if(empty($_SESSION['username'])) {
header('location:login.php'); 
}elseif ($_SESSION['level'] == "admin") {
    header('location:../admin/index.php');
}
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<print id="print">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Layanan Informasi Tagihan Pada Perusahaan Alat Kesehatan PT. Asri Celebes Mandiri</title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../dist/css/styles.css" rel="stylesheet">
  <style type="text/css">
  	@page 
        {
           	size:  auto;
            margin: 4mm;  
        }
  </style>
  </head>

  <body>
  	<div class="container">
      <div class="row">
		  <div class="col-lg-12">
		  		<br><br>

				<div class="content-box-large">
					<h3>Laporan Stok Barang</h3>
					<table class="table table-striped">
						<thead>
              		<tr>
              			<th>No</th>
              			<th>ID Produk</th>
              			<th>Foto Produk</th>
              			<th>Nama Produk</th>
              			<th>Harga</th>
              			<th>Stok</th>
              			<th>Tipe Produk</th>
              		</tr>
              	</thead>
              	<tbody>
              		<?php
              		$sql = mysql_query("SELECT produk.*,tipe_produk.nama_tipe FROM produk,tipe_produk WHERE produk.id_tipe=tipe_produk.id_tipe");
              		$no = 1;
              		while ($row = mysql_fetch_array($sql)) {
                    $cekkeluar = mysql_query("SELECT sum(jumlah_produk) as keluar FROM order_items WHERE id_produk='$row[id_produk]'");
                    $keluar = mysql_fetch_array($cekkeluar);
                    $stok = $keluar[keluar]+$row[stok];
              			echo '
              			<tr>
              				<td>'.$no.'</td>
              				<td>'.$row[id_produk].'</td>
              				<td><img src="../foto/'.$row[foto].'" alt="" width="150px"  height="150px"/></td>
              				<td>'.$row[nama_produk].'</td>
              				<td>Rp. '.number_format($row['harga'],2,",",".").'</td>
              				<td>'.$stok.'</td>
              				<td>'.$row[nama_tipe].'</td>
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
  	
</print>
<div class="col-md-12">
<a class="btn btn-primary" href="#" id="cetak"><i class="fa fa-print"></i> Cetak</a>
</div>
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../dist/js/jquery-2.0.3.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script>window.jQuery || document.write('<script src="dist/bootstrap4/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="../dist/js/jquery.PrintArea.js"></script>
<script>
$(document).ready(function(){
    $("#cetak").click(function(){
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode : mode, popClose : close};
        $("print#print").printArea( options );
    });
});
</script>
</body>
</html>