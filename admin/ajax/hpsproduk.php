<?php 
include '../../koneksi.php';
  if (!empty($_GET['delete'])) {
          	$hapus = mysql_query("DELETE FROM produk WHERE id_produk='$_GET[delete]'");
   if ($hapus) {
      	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses', 'msg' => 'Berhasil Dihapus'), JSON_PRETTY_PRINT);
  } else {
  	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal', 'msg' => 'Gagal Dihapus'), JSON_PRETTY_PRINT);
  }
  }
  ?>