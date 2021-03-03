<?php require_once("koneksi.php");
    if (!isset($_SESSION)) {
        session_start();
    } ?>
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
          <?php
          require_once('autonumber.php');
          if (isset($_POST['submit'])) {
          	$id = kodeotomatis('pelanggan','id_pelanggan',2,'PL');
            $nama_pelanggan = $_POST['nama_pelanggan'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $alamat = $_POST['alamat'];
            $nohp = $_POST['nohp'];
            $sql = mysql_query("SELECT * FROM pelanggan WHERE email = '$email' AND password = '$password'");
            $row = mysql_fetch_array($sql);
            if($row['email'] == $email) {
              echo "<script>swal(
                    'Error!',
                    'Email Sudah Terdaftar',
                    'error'
                  )</script>";
              }else{
          $add = mysql_query("INSERT into pelanggan VALUES('$id','$email','$password','$nama_pelanggan','$alamat','$nohp')");
          if ($add) {
            echo "<script>swal(
                'Sukses!',
                'Data Berhasil Terdaftar!',
                'success'
              )
              setTimeout(function(){
        window.location.href= 'http://localhost/baru/login.php';
        }, 2000);
        </script>";
          }else{
              echo "<script>swal(
              'Error!',
              'Data Tidak Terdaftar!',
              'error'
            )</script>";
          }
        }
          }
          ?>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Register</h4>
                <form method="post">
                  <div class="form-group">
                    <label for="nama_pelanggan">Nama</label>
                    <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" placeholder="Nama" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="nohp">No Telp</label>
                    <input type="text" class="form-control" name="nohp" id="nohp" placeholder="No Telp" required>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
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
    <script src="dist/js/jquery-2.0.3.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>