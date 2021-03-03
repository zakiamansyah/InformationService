<?php
require_once("koneksi.php");
    if (!isset($_SESSION)) {
        session_start();
    }
$email = $_POST['email'];
$password = $_POST['password'];
$cekuser = mysql_query("SELECT * FROM pelanggan WHERE email = '$email' AND password = '$password'");
$jumlah = mysql_num_rows($cekuser);
$hasil = mysql_fetch_array($cekuser);
if($jumlah == 0) {
	header('location:login.php?login=gagal');
	}else{
$_SESSION['username'] = $hasil['email'];
$_SESSION['nama_pelanggan'] = $hasil['nama_pelanggan'];
$ref = $_SESSION['REAL_REFERER']; 
if (empty($ref)) {
	header('location:index.php');
}else{
header('location:'.$ref.'');
}
}
?>