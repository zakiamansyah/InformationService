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
          	<li class="nav-item" id="reload">
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
    <?php
    $sql = mysql_query("SELECT produk.*,tipe_produk.nama_tipe FROM produk,tipe_produk WHERE produk.id_tipe=tipe_produk.id_tipe AND produk.id_produk='$_GET[id]'");
    $row = mysql_fetch_array($sql);
    $cek = mysql_num_rows($sql);
    if($cek == 0) {
      header('location:index.php');
    }
    ?>
    <div class="container">
      <div class="row">
		  <div class="col-lg-12">
		  	<div class="content-box-large box-with-header">
				<div class="bd-callout bd-callout-success">
					<div class="row">
						<div class="col-md-4">
							<img src="foto/<?=$row['foto']?>" style="height: 400px;width: 300px;">
						</div>
						<div class="col-md-8">
							<h3><?=$row['nama_produk']?></h3>
							<p>
								<table class="table">
									<tr>
										<td>Harga</td><td>:</td><td>Rp. <?=number_format($row['harga'],2,",",".");?></td>
									</tr>
									<tr>
										<td>Stok</td><td>:</td><td><?php if ($row['stok'] >= 1){
	                           echo '<span class="badge badge-primary">Produk Tersedia : '.$row['stok'].'</span>';	
                                } else {
	                           echo '<span class="badge badge-danger">Produk Habis</span>';	
                                } ?></td>
									</tr>
									<tr>
										<td>Kategori</td><td>:</td><td><a href="kategori.php?id=<?=$row['id_tipe']?>"><?=$row['nama_tipe']?></a></td>
									</tr>
									<tr>
										<td>Deskripsi</td><td>:</td><td><?=$row['deskripsi']?></td>
									</tr>
								</table>
								<?php if ($row['stok'] >= 1){ ?>
	                           <form method="post" id="forminput">
	                           	<div class="row">
	                           		<div class="col-lg-4">
		                           		<div class="input-group">
		                                    <span class="input-group-btn">
		                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
		                                          <span class="fa fa-minus"></span>
		                                        </button>
		                                    </span>
		                                    <input type="hidden" id="act" name="act" value="add">
		                                    <input type="hidden" id="id_produk" name="id_produk" value="<?=$row['id_produk']?>">
		                                    <input type="text" id="jumlah" name="jumlah" class="form-control input-number" value="1" min="1" max="5" readonly>
		                                    <span class="input-group-btn">
		                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
		                                            <span class="fa fa-plus"></span>
		                                        </button>
		                                    </span>
		                                    </form>
		                                    &nbsp;<button type="button" class="btn btn-primary" id="save"><span class="fa fa-shopping-cart"></span> Beli</button>
		                                </div>
                            		</div>
                        	  	</div>
                               <?php } else { ?>
	                           <button type="button" class="btn btn-warning">Produk Habis</button>
                               <?php } ?>
							</p>
						</div>
					</div>
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
    <script type="text/javascript">
    	$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        e.preventDefault();
        var quantity = parseInt($('#jumlah').val());
        
            if(quantity<<?=$row['stok']?>){
            $('#jumlah').val(quantity + 1);
            }
        
    });

     $('.quantity-left-minus').click(function(e){
        e.preventDefault();
        var quantity = parseInt($('#jumlah').val());
        
            if(quantity>0){
            $('#jumlah').val(quantity - 1);
            }
    });
    
});
    </script>
    <script>
    $('#save').click(function(){

      var datas= $("#forminput").serialize();

      $.ajax({
         type: "POST",
         url: "cart.php",
         dataType: "json",
         data: datas
      }).done(function( data ) {
        if (data.status == 'sukses') {
        $("#reload").load(location.href + " #reload");
        swal("Berhasil!", "Berhasil ditambahkan Ke Keranjang Belanja", "success");
        setTimeout(function(){
        window.location.href= 'order.php';
        }, 2000);
    	} else {
    	swal("Gagal!", "Gagal ditambahkan Ke Keranjang Belanja", "error");
    	}
     });
    });
  </script>
  </body>
</html>
