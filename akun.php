<?php
error_reporting(0);
require_once("koneksi.php");
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
        <div class="content-box-header success">
          <div class="panel-title" style="color: #fff;">Akun</div>   
          <div style="float: right;"><button type="submit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit">Edit</button> <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pw">Ganti Password</button></div>
          <?php
          $pel = mysql_query("SELECT * FROM pelanggan WHERE email='$_SESSION[username]'");
          $cek = mysql_fetch_array($pel);
          ?>
          <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="forminput" method="post">
                      <div class="form-group">
                        <label for="email" class="form-control-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?=$cek[email]?>" readonly />
                      </div>
                      <div class="form-group">
                        <label for="nama_pelanggan" class="form-control-label">Nama</label>
                        <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?=$cek[nama_pelanggan]?>" required />
                      </div>
                      <div class="form-group">
                        <label for="alamat" class="form-control-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" required><?=$cek[alamat]?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="nohp" class="form-control-label">No Telepon</label>
                        <input type="text" class="form-control" name="nohp" id="nohp" value="<?=$cek[nohp]?>" required />
                      </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="pw" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="forminput" method="post">
                      <div class="form-group">
                        <label for="pwlama" class="form-control-label">Password Lama</label>
                        <input type="password" class="form-control" name="pwlama" id="pwlama" required />
                      </div>
                      <div class="form-group">
                        <label for="pwbaru" class="form-control-label">Password Baru</label>
                        <input type="password" class="form-control" name="pwbaru" id="pwbaru" required />
                      </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="ganti" class="btn btn-primary">Save</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          <br>
        </div>
				<div class="content-box-large box-with-header">
          <table class="table">
            <tr>
              <td>Email</td>
              <td><?=$cek[email]?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td><?=$cek[nama_pelanggan]?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td><?=$cek[alamat]?></td>
            </tr>
            <tr>
              <td>No Telepon</td>
              <td><?=$cek[nohp]?></td>
            </tr>
          </table>
		  	</div>

		  </div>

        </div>
      </div>
  <?php
  if (isset($_POST['save'])) {
    $email = $_POST['email'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $update = mysql_query("UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan',alamat='$alamat',nohp='$nohp' WHERE email='$email'");
      if ($update) {
    echo "<script>swal(
  'Sukses!',
  'Data Sudah diubah',
  'success'
)
setTimeout(function(){
        window.location.href=window.location.href;
        }, 2000);</script>";
  } else {
    echo "<script>swal(
  'Error!',
  'Data Tidak diubah!',
  'error'
)
setTimeout(function(){
        window.location.href=window.location.href;
        }, 2000);</script>";
  }
  }
  ?>
  <?php
  if (isset($_POST['ganti'])) {
    $pwlama = $_POST['pwlama'];
    $pwbaru = $_POST['pwbaru'];
    if ($cek[password] == $pwlama) {
    $ganti = mysql_query("UPDATE pelanggan SET password='$pwbaru' WHERE email='$_SESSION[username]'");
      if ($ganti) {
    echo "<script>swal(
  'Sukses!',
  'Password Sudah diubah',
  'success'
)
setTimeout(function(){
        window.location.href=window.location.href;
        }, 2000);</script>";
  } else {
    echo "<script>swal(
  'Error!',
  'Password Tidak diubah!',
  'error'
)
setTimeout(function(){
        window.location.href=window.location.href;
        }, 2000);</script>";
  }
}else{
  echo "<script>swal(
  'Error!',
  'Password Lama Salah',
  'error'
)
setTimeout(function(){
        window.location.href=window.location.href;
        }, 2000);</script>";
}
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
