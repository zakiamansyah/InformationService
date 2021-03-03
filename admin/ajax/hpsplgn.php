<?php 
include '../../koneksi.php';
  if (!empty($_GET['delete'])) {
            $cek = mysql_query("SELECT * FROM orders WHERE id_pelanggan='$_GET[delete]'");
            while ($del = mysql_fetch_array($cek)) {
              mysql_query("DELETE FROM order_items WHERE id_order='$del[id_order]'");
              mysql_query("DELETE FROM pembayaran WHERE id_order='$del[id_order]'");
            }
            mysql_query("DELETE FROM orders WHERE id_pelanggan='$_GET[delete]'");
          	$hapus = mysql_query("DELETE FROM pelanggan WHERE id_pelanggan='$_GET[delete]'");
   if ($hapus) {
      	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses', 'msg' => 'Berhasil Dihapus'), JSON_PRETTY_PRINT);
  } else {
  	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal', 'msg' => 'Gagal Dihapus'), JSON_PRETTY_PRINT);
  }
  }
  ?>