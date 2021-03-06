<?php require_once("koneksi.php");
    if (!isset($_SESSION)) {
        session_start();
    } ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title> Layanan Informasi Tagihan Pada Perusahaan Alat Kesehatan PT. Asri Celebes Mandiri</title>

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
      <a class="navbar-brand" href="index.php"> Layanan Informasi Tagihan Pada Perusahaan Alat Kesehatan PT. Asri Celebes Mandiri</a>
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
          	<li class="nav-item" id="reload2">
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
          <div id="reload">
            <?php                
          $total = 0;
            if (!empty($_SESSION['items'])) {
            ?>

            <table class="table table-hover table-condensed">
            <thead>
            <tr>
              <th>Produk</th>
              <th>Jumlah</th>
              <th>Total Harga</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            error_reporting(0);
              foreach ($_SESSION['items'] as $key => $val) {
            $sql = mysql_query("SELECT * FROM produk WHERE id_produk = '$key'");
            $row = mysql_fetch_array($sql);

            $jumlah_harga = $row['harga'] * $val;
            $total += $jumlah_harga;
            ?>
            <tr>
              <td><img src="foto/<?=$row['foto']?>" style="height: 200px;width: 150px;"><br>
                ID Produk : <?=$row['id_produk']?><br>
                Nama Produk : <?=$row['nama_produk']?><br>
                Harga : Rp. <?=number_format($row['harga'],2,",",".");?><br>
              </td>
              <td><?=$val?></td>
              <td>Rp. <?=number_format($jumlah_harga,2,",",".");?></td>
              <td>
                                        <button type="button" class="btn btn-primary" onclick='tambahdata("<?=$row[id_produk]?>")'><span class="fa fa-plus"></span> Tambah</button>
                                        <button type="button" class="btn btn-warning" onclick='kurangdata("<?=$row[id_produk]?>")'><span class="fa fa-minus"></span> Kurangi</button>
                                        <button type="button" class="btn btn-danger" onclick='deletedata("<?=$row[id_produk]?>")'><span class="fa fa-ban"></span> Hapus</button>
              </td>
            </tr>
            <?php }
            ?> 
            </tbody>
            <tfoot>
              <tr>
                <th><h4>Total</h4></th>
                <th></th>
                <th></th>
                <th><h4>Rp. <?=number_format($total,2,",",".");?></h4></th>
              </tr>
            </tfoot>
          </table>
          <div align="right">
            <a href="index.php" class="btn btn-info">&laquo; CONTINUE SHOPPING</a>
            <a href="checkout.php" class="btn btn-success"><i class="fa fa-shopping-cart icon-white"></i> CHECK OUT &raquo;</a>
          </div>
          <?php }else{ ?> 
          <center>
          <div class="alert alert-danger" role="alert">
          Keranjang Belanja Kosong
          </div>
          <a href="index.php" class="btn btn-info">&laquo; CONTINUE SHOPPING</a>
          </center>
          <?php } ?>
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
    <script>
    function tambahdata(str){

      var id = str;

      $.ajax({
         type: "POST",
         url: "cart.php?act=plus&id_produk="+id,
         dataType: "json"
      }).done(function( data ) {
        if (data.status == 'sukses') {
        $("#reload").load(location.href + " #reload");
        $("#reload2").load(location.href + " #reload2");
        // swal("Berhasil!", "Berhasil Di Hapus Dari Keranjang Belanja", "success");
      } else if(data.status == 'abis') {
        $("#reload").load(location.href + " #reload");
        $("#reload2").load(location.href + " #reload2");
        swal("Info!", "Stok Barang Habis", "info");
      }
     });
    };
  </script>
  <script>
    function kurangdata(str){

      var id = str;

      $.ajax({
         type: "POST",
         url: "cart.php?act=min&id_produk="+id,
         dataType: "json"
      }).done(function( data ) {
        if (data.status == 'sukses') {
        $("#reload").load(location.href + " #reload");
        $("#reload2").load(location.href + " #reload2");
        // swal("Berhasil!", "Berhasil Di Hapus Dari Keranjang Belanja", "success");
      } else if(data.status == 'kosong') {
        $("#reload").load(location.href + " #reload");
        $("#reload2").load(location.href + " #reload2");
        swal("Info!", "Item Telah di Hapus Dari Keranjang Belanja", "info");
      }
     });
    };
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
         url: "cart.php?act=del&id_produk="+id,
         dataType: "json"
      }).done(function( data ) {
        if (data.status == 'sukses') {
        $("#reload").load(location.href + " #reload");
        $("#reload2").load(location.href + " #reload2");
        swal("Berhasil!", "Berhasil Di Hapus Dari Keranjang Belanja", "success");
    	} else {
      swal("Gagal!", "Gagal Di Hapus Dari Keranjang Belanja", "error");
      }
     });
    });
    };
  </script>
  </body>
</html>
