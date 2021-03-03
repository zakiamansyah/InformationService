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
				<div class="alert alert-success" role="alert">
				  <h4 class="alert-heading">Selamat Datang Di PT. Asri Celebes Mandiri</h4>
				</div>


				<div class="content-box-large box-with-header">
				<div class="row">
          <?php
                  $halaman = 12;
                  $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
                  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                  $result = mysql_query("SELECT * FROM produk");
                  $total = mysql_num_rows($result);
                  $pages = ceil($total/$halaman);   
                  $sql = mysql_query("SELECT produk.*,tipe_produk.nama_tipe FROM produk,tipe_produk WHERE produk.id_tipe=tipe_produk.id_tipe LIMIT $mulai, $halaman");
                  $no = $mulai+1;
                  while ($row = mysql_fetch_array($sql)) {
          ?>

		  		  <div class="col-md-3">
  						<div class="card" style="width: 17rem;">
              <a href="produk.php?id=<?=$row['id_produk']?>"><img class="card-img-top" src="foto/<?=$row['foto']?>" alt="<?=$row['nama_produk']?>" style="height: 400px;"></a>
              <div class="card-body">
                <h4 class="card-title"><a href="produk.php?id=<?=$row['id_produk']?>" style="text-decoration: none;"><?=$row['nama_produk']?></a></h4>
                <p class="card-text">
                  Harga     : Rp. <?=number_format($row['harga'],2,",",".");?><br>
                  Kategori  : <a href="kategori.php?id=<?=$row['id_tipe']?>"><?=$row['nama_tipe']?></a>
                </p>
              </div>
            </div>
				  </div>

          <?php }?>

		  	  </div>
          <br><br>

            <nav aria-label="paging">
              <ul class="pagination">
                <!-- Awalan Paging -->
                <?php
                  if($page == 1){
                  ?>
                <!-- Page Awal -->
                <?php }else{
                $link_prev = ($page > 1)? $page - 1 : 1; ?>
                <li class="page-item">
                  <a class="page-link" href="index.php?page=<?=$link_prev?>" tabindex="-1">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <?php } ?>

                <?php
                  $jumlah_number = 3;
                  $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; 
                  $end_number = ($page < ($pages - $jumlah_number))? $page + $jumlah_number : $pages; 
                  for($i = $start_number; $i <= $end_number; $i++){
                    $link_active = ($page == $i)? 'active' : '';
                  ?>
                    <li class="page-item <?php echo $link_active; ?>"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                  <?php
                  }
                  ?>

                <!-- Akhiran Paging -->
                <?php
                if($page == $pages){
                ?>
                <!-- Page Terakhir -->
                <?php }else{
                $link_next = ($page < $pages)? $page + 1 : $pages; ?>
                <li class="page-item">
                  <a class="page-link" href="index.php?page=<?php echo $link_next; ?>">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
                <?php } ?>

              </ul>
            </nav>

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
  </body>
</html>
