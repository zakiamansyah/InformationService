<?php
session_start();
if(empty($_SESSION['username'])) {
header('location:login.php'); 
}elseif ($_SESSION['level'] == "admin") {
    header('location:../admin/index.php');
}
include '../koneksi.php';
require_once('../autonumber.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Layanan Informasi Tagihan Pada Perusahaan Alat Kesehatan PT. Asri Celebes Mandiri</title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../dist/datatables/css/dataTables.bootstrap4.min.css">
    <link href="../dist/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../dist/css/styles.css" rel="stylesheet">
    <link href="../dist/css/select2.min.css" rel="stylesheet">
    <link href="../dist/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css">
    <script src="../dist/sweetalert.min.js"></script>
    <script src="../dist/sweetalert-dev.js"></script>
   	<style type="text/css">
      footer {
    position: fixed;
    height: 70px;
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
                    <li><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="submenu current">
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
		  <div class="col-md-10" id="reload">
		  	<div class="content-box-header success">
			  	<div class="panel-title" style="color: #fff;">Pelanggan</div>		
			</div>
				<div class="content-box-large box-with-header">
          <?php if ($_GET['s'] == 'sukses') {
            echo '<a href="cetakinvosukses.php" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-print"></i> Cetak</a>';
            }?>
				<table class="table" id="tablebr">
          <thead>
                  <tr>
                    <th>No</th>
                    <th>ID ORDER</th>
                    <th>Tanggal Order</th>
                    <th>Status Pembayaran</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  error_reporting(0);
                  if ($_GET['s'] == 'pending') {
                  $sql = mysql_query("SELECT DISTINCT(order_items.id_order),orders.*,pembayaran.* FROM orders,order_items,pembayaran WHERE order_items.id_order=orders.id_order AND pembayaran.id_order=orders.id_order AND pembayaran.status='0'");
                  $no = 1;
                  while ($row = mysql_fetch_array($sql)) {
                    echo '
                    <tr>
                      <td>'.$no.'</td>
                      <td><a href="invoice.php?id='.$row[id_order].'" target="_blank">'.$row[id_order].'</a></td>
                      <td>'.$row[tgl_order].'</td>
                      <td><span class="badge badge-pill badge-warning">Pending</span></td>
                      <td></td>
                      </tr>
                    ';$no++;
                  }
                }elseif ($_GET['s'] == 'sukses') {
                  $sql = mysql_query("SELECT DISTINCT(order_items.id_order),orders.*,pembayaran.* FROM orders,order_items,pembayaran WHERE order_items.id_order=orders.id_order AND pembayaran.id_order=orders.id_order AND pembayaran.status='1'");
                  $no = 1;
                  while ($row = mysql_fetch_array($sql)) {
                    echo '
                    <tr>
                      <td>'.$no.'</td>
                      <td><a href="invoice.php?id='.$row[id_order].'" target="_blank">'.$row[id_order].'</a></td>
                      <td>'.$row[tgl_order].'</td>
                      <td><span class="badge badge-pill badge-success">Sukses</span></td>
                      <td></td>
                      </tr>
                    ';$no++;
                  }
                }elseif ($_GET['s'] == 'cancel') {
                  $sql = mysql_query("SELECT DISTINCT(order_items.id_order),orders.*,pembayaran.* FROM orders,order_items,pembayaran WHERE order_items.id_order=orders.id_order AND pembayaran.id_order=orders.id_order AND pembayaran.status='2'");
                  $no = 1;
                  while ($row = mysql_fetch_array($sql)) {
                    echo '
                    <tr>
                      <td>'.$no.'</td>
                      <td><a href="invoice.php?id='.$row[id_order].'" target="_blank">'.$row[id_order].'</a></td>
                      <td>'.$row[tgl_order].'</td>
                      <td><span class="badge badge-pill badge-danger">Cancel</span></td>
                      <td></td>
                      </tr>
                    ';$no++;
                  }
                }else{
                  echo '<meta http-equiv="refresh" content="0; url=index.php" />';
                }
                  ?>
                </tbody>
                </table>		

		  		</div>

		  </div>

        </div>
      </div>
<?php
          if (isset($_GET['setujui'])){
            date_default_timezone_set('Asia/Jakarta');
            $tgl_byr = date('Y-m-d H:i:s');
            $setuju = mysql_query("UPDATE pembayaran SET status='1',tgl_bayar='$tgl_byr' WHERE id_order='$_GET[setujui]'");

          }
            ?>
            <?php
          if (isset($_GET['tolak'])){
            $tolak = mysql_query("UPDATE pembayaran SET status='2' WHERE id_order='$_GET[tolak]'");

          }
            ?>
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
    <script type="text/javascript" src="../dist/js/jquery.min.js">
	</script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/select2.min.js"></script>
    <script src="../vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="../vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>

    <script src="../vendors/ckeditor/ckeditor.js"></script>
    <script src="../vendors/ckeditor/adapters/jquery.js"></script>
    <script type="text/javascript" src="../vendors/tinymce/js/tinymce/tinymce.min.js"></script>

    <script src="../dist/js/custom.js"></script>
    <script src="../dist/js/editors.js"></script>
    <script type="text/javascript" src="../dist/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../dist/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function() {
    $('select').select2();
    $('#tablebr').DataTable();
    });
    </script>
  <script>
    function setujui(str){
      var id = str;
      swal({
  title: "Peringatan!!",
  text: "Apakah Anda Yakin Ingin Mensetujuinya??",
  type: "warning",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
},function(){
          
      $.ajax({
         type: "POST",
         url: "datainvoice.php?setujui="+id
      }).done(function( data ) {
        swal("Berhasil!!", "Data Berhasil Di Setujui", "success");
      setTimeout(function(){
        location.reload();
        }, 2000);
      });
});
      
    }
  </script>
  <script>
    function tolak(str){
      var id = str;
      swal({
  title: "Peringatan!!",
  text: "Apakah Anda Yakin Ingin Menolaknya??",
  type: "warning",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
},function(){
          
      $.ajax({
         type: "POST",
         url: "datainvoice.php?tolak="+id
      }).done(function( data ) {
        swal("Berhasil!!", "Data Berhasil Di Tolak", "success");
      setTimeout(function(){
        location.reload();
        }, 2000);
      });
});
      
    }
  </script>
  </body>
</html>
