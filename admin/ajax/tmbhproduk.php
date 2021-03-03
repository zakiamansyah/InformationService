<?php
include '../../koneksi.php';
  if (!empty($_POST['id_produk'])) {
    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $id_tipe = $_POST['id_tipe'];
    $foto = $_FILES['foto']['name'];
    $add = mysql_query("INSERT INTO produk VALUES('$id_produk','$nama_produk','$harga','$stok','$deskripsi','$id_tipe','$foto')");
    move_uploaded_file($_FILES['foto']['tmp_name'], "../../foto/".$_FILES['foto']['name']);
      if ($add) {
      	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
  } else {
  	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
  }
  }
  ?>