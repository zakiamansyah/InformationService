<?php
error_reporting(0);
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
                         	<li><a href="tipeproduk.php">Tipe Produk</a></li>
                            <li class="current"><a href="brgmasuk.php">Barang Masuk</a></li>
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
                            <li><a href="pembayaran.php">Pembayaran</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="content-box-header success">
			  	<div class="panel-title" style="color: #fff;">Barang Masuk</div>		
			</div>
				<div class="content-box-large box-with-header">
					<button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#baru"><i class="icon fa fa-plus fa-1x"></i> Barang Baru </button>

					<div class="modal fade" id="baru" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-lg" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="modalLabel">Tambah Barang Baru</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        <form id="forminput" method="post" enctype="multipart/form-data">
						          <div class="form-group">
						            <label for="id_produk" class="form-control-label">ID Produk</label>
						            <input type="text" class="form-control" name="id_produk" id="id_produk" value="<?php echo kodeotomatis('produk','id_produk',2,'PR');?>" readonly />
						          </div>
						          <div class="form-group">
						            <label for="nama_produk" class="form-control-label">Nama</label>
						            <input type="text" class="form-control" name="nama_produk" id="nama_produk" required />
						          </div>
						          <div class="form-group">
						            <label for="harga" class="form-control-label">Harga</label>
						            <input type="number" class="form-control" name="harga" id="harga" required />
						          </div>
						          <div class="form-group">
						            <label for="stok" class="form-control-label">Stok</label>
						            <input type="number" class="form-control" name="stok" id="stok" required />
						          </div>
						          <div class="form-group">
						            <label for="deskripsi" class="form-control-label">Deskripsi</label>
						            <textarea id="ckeditor_full" class="form-control" name="deskripsi" id="deskripsi" required></textarea>
						          </div>
						          <div class="form-group">
						            <label for="id_tipe" class="form-control-label">Tipe Barang</label>
						            <select class="form-control" name="id_tipe" id="id_tipe" required>
				                      <option></option>
				                      <?php
				                      $sql = mysql_query("SELECT * FROM tipe_produk");
				                      while ($row = mysql_fetch_array($sql)) {
				                      	echo '<option value="'.$row[id_tipe].'">'.$row[nama_tipe].'</option>';
				                      }
				                      ?>
				                    </select>
						          </div>
						          <div class="form-group">
						            <label for="foto" class="form-control-label">Foto</label>
						            <input type="file" class="form-control" name="foto" id="foto" onchange="tampilkanPreview(this,'preview')" required multiple/>
						            <br>Preview Gambar<br><img id="preview" src="" alt="" width="350px"/>
						          </div>
						        
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        <button type="submit" name="save" class="btn btn-primary">Input</button>
						        </form>
						      </div>
						    </div>
						  </div>
						</div>

				<table class="table" id="tablebr">
					<thead>
              		<tr>
              			<th>No</th>
              			<th>ID Produk</th>
              			<th>Foto Produk</th>
              			<th>Nama Produk</th>
              			<th>Harga</th>
              			<th>Stok</th>
              			<th>Tipe Produk</th>
              			<th>Aksi</th>
              		</tr>
              	</thead>
              	<tbody>
              		<?php
              		$sql = mysql_query("SELECT produk.*,tipe_produk.nama_tipe FROM produk,tipe_produk WHERE produk.id_tipe=tipe_produk.id_tipe");
              		$no = 1;
              		while ($row = mysql_fetch_array($sql)) {
              			echo '
              			<tr>
              				<td>'.$no.'</td>
              				<td>'.$row[id_produk].'</td>
              				<td><img src="../foto/'.$row[foto].'" alt="" width="150px" height="150px"/></td>
              				<td>'.$row[nama_produk].'</td>
              				<td>'.$row[harga].'</td>
              				<td>'.$row[stok].' ';if ($row['stok'] <= 0){ echo'<span class="badge badge-danger">Stok Habis</span>'; } echo'</td>
              				<td>'.$row[nama_tipe].'</td>
              				<td><button type="button" data-toggle="modal" data-target="#des'.$row[id_produk].'" class="btn btn-success">Deskripsi</button><button type="button" data-toggle="modal" data-target="#myModal'.$row[id_produk].'" class="btn btn-primary">Update</button><button type="button" class="btn btn-warning" onclick=\'deletedata("'.$row[id_produk].'")\'>Delete</button>
              				<div class="modal fade" id="myModal'.$row[id_produk].'" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
				        <div class="modal-dialog modal-lg" role="document">
				          <div class="modal-content">
				            <div class="modal-header">
				              <h5 class="modal-title" id="modalLabel">Update Barang</h5>
				              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>
				            <div class="modal-body">
				              <form method="post" action="" enctype="multipart/form-data">
				                  <input type="hidden" name="upid" class="form-control" id="upid" value="'.$row[id_produk].'" />
				                <div class="form-group">
						            <label for="upnama_produk" class="form-control-label">Nama</label>
						            <input type="text" class="form-control" name="upnama_produk" id="upnama_produk" value="'.$row[nama_produk].'" required />
						          </div>
						          <div class="form-group">
						            <label for="upharga" class="form-control-label">Harga</label>
						            <input type="number" class="form-control" name="upharga" id="upharga" value="'.$row[harga].'" required />
						          </div>
						          <div class="form-group">
						            <label for="upstok" class="form-control-label">Stok</label>
						            <input type="number" class="form-control" name="upstok" id="upstok" value="'.$row[stok].'" required />
						          </div>
						          <div class="form-group">
						            <label for="updeskripsi" class="form-control-label">Deskripsi</label>
						            <textarea id="ckeditor_full" class="form-control" name="updeskripsi" id="updeskripsi" required>'.$row[deskripsi].'</textarea>
						          </div>
						          <div class="form-group">
						            <label for="upid_tipe" class="form-control-label">Tipe Barang</label>
						            <select class="form-control" name="upid_tipe" id="upid_tipe" required>
				                      <option></option>';
				                      $sqlz = mysql_query("SELECT * FROM tipe_produk");
				                      while ($rowz = mysql_fetch_array($sqlz)) {
				                      	echo '<option value="'.$rowz[id_tipe].'">'.$rowz[nama_tipe].'</option>';
				                      }
				                    echo'</select>
						          </div>
						          <div class="form-group">
						            <label for="upfoto" class="form-control-label">Foto</label>
						            <input type="file" class="form-control" name="upfoto" id="upfoto" onchange="uptampilkanPreview(this,\'uppreview\')" multiple />
						            <br>Gambar Awal<br><img src="../foto/'.$row[foto].'" alt="" width="350px"/>
						            <br>Preview Gambar<br><img id="uppreview" src="" alt="" width="350px"/>
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
				      <div class="modal fade" id="des'.$row[id_produk].'" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
				        <div class="modal-dialog modal-lg" role="document">
				          <div class="modal-content">
				            <div class="modal-header">
				              <h5 class="modal-title" id="modalLabel">Deskripsi Barang</h5>
				              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>
				            <div class="modal-body">
				              '.$row[deskripsi].'
				          </div>
				            <div class="modal-footer">
				              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				            </div>
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
    $id_produk = $_POST['upid'];
    $nama_produk = $_POST['upnama_produk'];
    $harga = $_POST['upharga'];
    $stok = $_POST['upstok'];
    $deskripsi = $_POST['updeskripsi'];
    $id_tipe = $_POST['upid_tipe'];
    $foto = $_FILES['upfoto']['name'];

    if ($foto) {
    $sql = mysql_query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
	$row = mysql_fetch_array($sql);
	unlink("../foto/".$row['foto']);
    $update = mysql_query("UPDATE produk SET nama_produk='$nama_produk',harga='$harga',stok='$stok',deskripsi='$deskripsi',id_tipe='$id_tipe',foto='$foto' WHERE id_produk='$id_produk'");
    move_uploaded_file($_FILES['upfoto']['tmp_name'], "../foto/".$_FILES['upfoto']['name']);
    }else{
    $update = mysql_query("UPDATE produk SET nama_produk='$nama_produk',harga='$harga',stok='$stok',deskripsi='$deskripsi',id_tipe='$id_tipe' WHERE id_produk='$id_produk'");
	}
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
  <?php
  if (isset($_POST['save'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $id_tipe = $_POST['id_tipe'];
    $foto = $_FILES['foto']['name'];
    $add = mysql_query("INSERT INTO produk VALUES('$id_produk','$nama_produk','$harga','$stok','$deskripsi','$id_tipe','$foto')");
    move_uploaded_file($_FILES['foto']['tmp_name'], "../foto/".$_FILES['foto']['name']);
      if ($add) {
      	echo "<script>swal(
  'Sukses!',
  'Tipe Sudah ditambahkan',
  'success'
)
setTimeout(function(){
        window.location.href=window.location.href;
        }, 2000);</script>";
  } else {
    echo "<script>swal(
  'Error!',
  'Tipe Tidak ditambahkan!',
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
    <script type="text/javascript" src="../dist/js/jquery-2.0.3.min.js">
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
    <script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{ //membuat objek gambar
  var gb = userfile.files;
  //loop untuk merender gambar
  for (var i = 0; i < gb.length; i++)
  { //bikin variabel
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);            
    var reader = new FileReader();
    if (gbPreview.type.match(imageType)) 
    { //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element) 
      {
        return function(e) 
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      { //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }    
}
</script>
<script type="text/javascript">
function uptampilkanPreview(userfile,upidpreview)
{ //membuat objek gambar
  var gb = userfile.files;
  //loop untuk merender gambar
  for (var i = 0; i < gb.length; i++)
  { //bikin variabel
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(upidpreview);            
    var reader = new FileReader();
    if (gbPreview.type.match(imageType)) 
    { //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element) 
      {
        return function(e) 
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      { //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }    
}
</script>
<!-- <script>
    $('#save').click(function(){
      var datas= $("#forminput").serialize();
      formdata = false;

      $.ajax({
         type: "POST",
         url: "ajax/tmbhproduk.php",
         dataType: "json",
         data: datas
      }).done(function( data ) {
        $('#myModal').modal('hide')
        if (data.status == 'sukses') {
        formdata = new FormData();
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
  </script> -->
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
         url: "ajax/hpsproduk.php?delete="+id
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
