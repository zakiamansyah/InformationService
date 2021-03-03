<?php 
session_start();
if(empty($_SESSION['username'])) {
header('location:login.php'); 
}elseif ($_SESSION['level'] == "admin") {
    header('location:../admin/index.php');
}
include '../koneksi.php';
    if (empty($_GET['id'])) {
     	header('location:index.php');
     } ?>
<!DOCTYPE html>
<html lang="en">
<print id="print">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Invoice #<?=$_GET['id']?></title>

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
      	  <div class="col-lg-1"></div>
		  <div class="col-lg-10">
		  		<br><br>

				<div class="content-box-large">
				<div class="row">
				<?php
					$id = $_GET['id'];
                  	$pem = mysql_query("SELECT pembayaran.*,orders.id_pelanggan FROM pembayaran,orders WHERE pembayaran.id_order='$id'");
                  	$cekpem = mysql_fetch_array($pem);
					$pel = mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan='$cekpem[id_pelanggan]'");
                  	$cek = mysql_fetch_array($pel);
				?>
				<div class="col-md-9">
					<h2>Layanan Informasi Tagihan Pada Perusahaan Alat Kesehatan PT. Asri Celebes Mandiri</h2>
					<h4>Invoice #<?=$id?></h4>
				</div>
				<div class="col-md-3">
					<br>
					<?php
						if ($cekpem['status'] == 0) {
                        echo '<h3><span class="badge badge-warning">Pending</span></h3>';
                      }elseif ($cekpem['status'] == 1) {
                        echo '<h3><span class="badge badge-success">Sudah Dibayar</span><h3>';
                      }elseif ($cekpem['status'] == 2) {
                        echo '<h3><span class="badge badge-danger">Dibatalkan</span><h3>';
                      }
					?>
				</div>
				<div class="col-md-6">
					<br><br><br>
					<h5>Ditagihkan Kepada</h5>
					<p><?=$cek['nama_pelanggan']?><br>
						<?=$cek['alamat']?><br>
						<?=$cek['nohp']?><br>
					</p>
					<br>
					<h5>Metode Pembayaran</h5>
					<p>Transfer Bank</p>
				</div>
				<div class="col-md-6">
					<br><br><br>
					<h5>Bayar Kepada</h5>
					<p>Zaki Amansyah<br>
					</p>
				</div>
				<div class="col-md-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
				<?php
					$total = 0;
					$sql = mysql_query("SELECT order_items.*,produk.* FROM orders,order_items,produk WHERE order_items.id_order=orders.id_order AND produk.id_produk=order_items.id_produk AND orders.id_pelanggan='$cek[id_pelanggan]' AND orders.id_order='$id'");
                 	while($inv = mysql_fetch_array($sql)){
                 	$subtotal = $inv['harga']*$inv['jumlah_produk'];
                 	$total += $subtotal;
				?>
					<tr>
						<td><?=$inv['nama_produk']?></td>
						<td>Rp. <?=number_format($inv['harga'],2,",",".");?></td>
						<td><?=$inv['jumlah_produk']?></td>
						<td>Rp. <?=number_format($subtotal,2,",",".");?></td>
					</tr>
				<?php } ?>
					<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th>Total</th>
						<th>Rp. <?=number_format($total,2,",",".");?></th>
					</tr>
					</tfoot>
					</tbody>
				</table>
				<?php 
				if ($cekpem['id_order'] != $id) {
				     	header('location:index.php');
				}
				?>
		  	  </div>

		  	</div>

		  <div class="col-lg-1"></div>

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