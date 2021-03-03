<?php
include '../../koneksi.php';
  if (!empty($_POST['nama_tipe'])) {
    $nama_tipe = $_POST['nama_tipe'];

    $add = mysql_query("INSERT INTO tipe_produk VALUES('','$nama_tipe')");

      if ($add) {
      	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses', 'nama_tipe' => $nama_tipe), JSON_PRETTY_PRINT);
  } else {
  	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal', 'nama_tipe' => $nama_tipe), JSON_PRETTY_PRINT);
  }
  }
  ?>