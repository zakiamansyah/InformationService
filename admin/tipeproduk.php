<?php
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
                    <li class="submenu current"">
                         <a href="#">
                            <i class="fa fa-list"></i> Produk
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                         	<li class="current"><a href="tipeproduk.php">Tipe Produk</a></li>
                            <li><a href="brgmasuk.php">Barang Masuk</a></li>
                            <li><a href="brgkeluar.php">Barang Keluar</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
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
                        </ul>
                    </li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10" id="reload">
		  	<div class="content-box-header success">
			  	<div class="panel-title" style="color: #fff;">Tipe Produk</div>		
			</div>
				<div class="content-box-large box-with-header">
					<button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#baru"><i class="icon fa fa-plus fa-1x"></i> Tipe Baru </button>

					<div class="modal fade" id="baru" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="modalLabel">Tambah Tipe Baru</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <form id="forminput">
						          <div class="form-group">
						            <label for="nama_tipe" class="form-control-label">Nama Tipe</label>
						            <input type="text" class="form-control" name="nama_tipe" id="nama_tipe" required />
						          </div>
						        </form>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        <button type="submit" id="save" class="btn btn-primary">Input</button>
						      </div>
						    </div>
						  </div>
						</div>

				<table class="table" id="tablebr">
					<thead>
              		<tr>
              			<th>No</th>
              			<th>ID Produk</th>
              			<th>Nama Tipe</th>
              			<th>Aksi</th>
              		</tr>
              	</thead>
              	<tbody>
              		<?php
              		error_reporting(0);
              		$sql = mysql_query("SELECT * FROM tipe_produk");
              		$no = 1;
              		while ($row = mysql_fetch_array($sql)) {
              			echo '
              			<tr>
              				<td>'.$no.'</td>
              				<td>'.$row[id_tipe].'</td>
              				<td>'.$row[nama_tipe].'</td>
              				<td><button type="button" data-toggle="modal" data-target="#myModal'.$row[id_tipe].'" class="btn btn-primary">Update</button><button type="button" class="btn btn-warning" onclick=\'deletedata("'.$row[id_tipe].'")\'>Delete</button>
              				<div class="modal fade" id="myModal'.$row[id_tipe].'" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
				        <div class="modal-dialog" role="document">
				          <div class="modal-content">
				            <div class="modal-header">
				              <h5 class="modal-title" id="modalLabel">Update Tipe</h5>
				              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>
				            <div class="modal-body">
				              <form method="post" action="">
				                  <input type="hidden" name="upid" class="form-control" id="upid" value="'.$row[id_tipe].'" />
				                <div class="form-group">
						            <label for="upnama" class="form-control-label">Nama Tipe</label>
						            <input type="text" class="form-control" name="upnama" id="upnama" value="'.$row[nama_tipe].'" required/>
						          </div>
				          </div>
				            <div class="modal-footer">
				              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				              <button type="submit" name="submit" class="btn btn-primary">Update</button>
				            </div>
				            </form>
				          </div>
				        </div>
				      </div>
				      </td>
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
 <?php
  if (isset($_POST['submit'])) {
    $upid = $_POST['upid'];
    $upnama = $_POST['upnama'];

    $update = mysql_query("UPDATE tipe_produk SET nama_tipe='$upnama' WHERE id_tipe='$upid'");

      if ($update) {
    echo "<script>swal(
  'Sukses!',
  'Tipe Sudah diubah',
  'success'
)
setTimeout(function(){
        window.location.href=window.location.href;
        }, 2000);</script>";
  } else {
    echo "<script>swal(
  'Error!',
  'Tipe Tidak diubah!',
  'error'
)
setTimeout(function(){
        window.location.href=window.location.href;
        }, 2000);</script>";
  }
  }
  ?>
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
    $('#save').click(function(){

      var datas= $("#forminput").serialize();

      $.ajax({
         type: "POST",
         url: "ajax/tmbhtipe.php",
         dataType: "json",
         data: datas
      }).done(function( data ) {
        $('#myModal').modal('hide')
        if (data.status == 'sukses') {
        $("#reload").load(location.href + " #reload");
        swal("Berhasil!", "Berhasil ditambahkan", "success");
    	} else {
    	swal("Gagal!", "Gagal ditambahkan", "error");
    	}
        document.getElementById("forminput").reset();
        setTimeout(function(){
        location.reload();
        }, 2000);
     });
    });
  </script>
  <script>
    function deletedata(str){
      var id = str;
      swal({
  title: "Peringatan!!",
  text: "Apakah Anda Yakin Ingin Menghapusnya??",
  type: "warning",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
},function(){
          
      $.ajax({
         type: "POST",
         dataType: "json",
         url: "ajax/hpstipe.php?delete="+id
      }).done(function( data ) {
      	if (data.status == 'sukses') {
        $("#reload").load(location.href + " #reload");
        swal("Berhasil!", "Berhasil dihapus", "success");
    	} else {
    	swal("Gagal!", "Gagal dihapus", "error");
    	}
      setTimeout(function(){
        location.reload();
        }, 2000);
});
      
    });
  }
  </script>
  </body>
</html>
