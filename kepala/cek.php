<?php
session_start();
include '../koneksi.php';
$username = $_POST['username'];
$password = $_POST['password'];
$cekuser = mysql_query("SELECT * FROM adminlogin WHERE username = '$username' AND password = '$password'");
$jumlah = mysql_num_rows($cekuser);
$hasil = mysql_fetch_array($cekuser);
if($jumlah == 0) {
	header('location:login.php?login=gagal');
	}elseif ($hasil[level] == "admin") {
	header('location:../admin/login.php');
	}else{
$_SESSION['username'] = $hasil['username'];
$_SESSION['level'] = $hasil[level];
header('location:index.php');
}
?>