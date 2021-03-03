<?php
// error_reporting(0);
session_start();
if(empty($_SESSION['username'])) {
header('location:login.php'); 
}elseif ($_SESSION['level'] == "kepala") {
    header('location:../kepala/index.php');
}
include '../koneksi.php';
require_once('../autonumber.php');
$pending = mysql_num_rows(mysql_query("SELECT * FROM pembayaran WHERE status='0'"));
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
                    <li class="submenu">
                         <a href="#">
                            <i class="fa fa-list"></i> Produk
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                         	<li><a href="tipeproduk.php">Tipe Produk</a></li>
                            <li><a href="brgmasuk.php">Barang Masuk</a></li>
                            <li><a href="brgkeluar.php">Barang Keluar</a></li>
                        </ul>
                    </li>
                    <li class="submenu current">
                         <a href="#">
                            <i class="fa fa-money"></i> Data Invoice
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="datainvoice.php?s=pending">Pending <?php if ($pending != 0) { echo'<span class="badge badge-warning">'.$pending.'</span>'; } ?></a></li>
                            <li><a href="datainvoice.php?s=sukses">Success</a></li>
                            <li><a href="datainvoice.php?s=cancel">Cancel</a></li>
                        </ul>
                    </li>
                    <li><a href="pelanggan.php"><i class="fa fa-users"></i> Data Pelanggan</a></li>
                    <li class="submenu">
                         <a href="#">
                            <i class="fa fa-file"></i> Laporan
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="stok.php">Stok</a></li>
                            <li><a href="pembayaran.php">Pembayaran</a></li>
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
                      <td><button type="button" class="btn btn-success" onclick=\'setujui("'.$row[id_order].'")\'>Setujui</button> <button type="button" class="btn btn-danger" onclick=\'tolak("'.$row[id_order].'")\'>Tolak</button></td>
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
            $id = $_GET['setujui'];
            $tgl_byr = date('Y-m-d H:i:s');
            $setuju = mysql_query("UPDATE pembayaran SET status='1',tgl_bayar='$tgl_byr' WHERE id_order='$id'");
            $cekodr = mysql_query("SELECT * FROM orders WHERE id_order='$id'");
            $rowodr = mysql_fetch_array($cekodr);
            $cekplg = mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan='$rowodr[id_pelanggan]'");
            $rowplg = mysql_fetch_array($cekplg);
            $auth = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzMjk2ODc3NiwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjU4MDk3LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.NDw_3X0Q-ntCBxDybwhpYxEpkbFx1o5l4v3oG-f0NDs";

$sms[0]['phone_number'] = $rowplg['nohp'];
$sms[0]['message'] = "Halo $rowplg[nama_pelanggan], Pembayaran Untuk Pesanan Anda ($id) Berhasil Dikonfirmasi. Terima Kasih";
$sms[0]['device_id'] = 97585;

$post = json_encode($sms);

$ch = curl_init("https://smsgateway.me/api/v4/message/send");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: $auth"));
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result = curl_exec ($ch);
        curl_close($ch);
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
