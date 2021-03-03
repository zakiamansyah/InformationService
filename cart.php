<?php
require_once("koneksi.php");
    if (!isset($_SESSION)) {
        session_start();
    }
     
    if (isset($_REQUEST['act'])) {
        $act = $_REQUEST['act'];
             
        if ($act == "add") {
            if (isset($_REQUEST['id_produk'])) {
                $id_produk = $_REQUEST['id_produk'];
                $jumlah = $_REQUEST['jumlah'];
                if ($jumlah <= 0) {
                	header("Content-Type: application/json");
    			echo json_encode(array('status' => 'minus'), JSON_PRETTY_PRINT);
                }
                elseif (isset($_SESSION['items'][$id_produk])) {
                    $_SESSION['items'][$id_produk] += $jumlah;
                    header("Content-Type: application/json");
    			echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
                } else {
                    $_SESSION['items'][$id_produk] = $jumlah; 
                    header("Content-Type: application/json");
    			echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
                }
            }
        } elseif ($act == "update") {
            if (isset($_REQUEST['id_produk'])) {
                $id_produk = $_REQUEST['id_produk'];
                $jumlah = $_REQUEST['jumlah'];
                if ($jumlah <= 0) {
                	unset($_SESSION['items'][$id_produk]);
                	header("Content-Type: application/json");
    			echo json_encode(array('status' => 'kosong'), JSON_PRETTY_PRINT);
                }
                elseif (isset($_SESSION['items'][$id_produk])) {
                    $_SESSION['items'][$id_produk] += $jumlah;
                    header("Content-Type: application/json");
    			echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
                }
            }
        } elseif ($act == "plus") {
            if (isset($_REQUEST['id_produk'])) {
                $id_produk = $_REQUEST['id_produk'];
                if (isset($_SESSION['items'][$id_produk])) {
                	$sql = mysql_query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
            		$row = mysql_fetch_array($sql);
            		
            		if ($_SESSION['items'][$id_produk] == $row['stok']) {
    				header("Content-Type: application/json");
    				echo json_encode(array('status' => 'abis'), JSON_PRETTY_PRINT);
            		}else{
            		$_SESSION['items'][$id_produk] += 1;
                    header("Content-Type: application/json");
    				echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    				}
                }
            }
        } elseif ($act == "min") {
            if (isset($_REQUEST['id_produk'])) {
                $id_produk = $_REQUEST['id_produk'];
                if (isset($_SESSION['items'][$id_produk])) {            		
            		if ($_SESSION['items'][$id_produk] == 1) {
            		unset($_SESSION['items'][$id_produk]);
    				header("Content-Type: application/json");
    				echo json_encode(array('status' => 'kosong'), JSON_PRETTY_PRINT);
            		}else{
            		$_SESSION['items'][$id_produk] -= 1;
                    header("Content-Type: application/json");
    				echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
    				}
                }
            }
        } elseif ($act == "del") {
            if (isset($_REQUEST['id_produk'])) {
                $id_produk = $_REQUEST['id_produk'];
                if (isset($_SESSION['items'][$id_produk])) {
                    unset($_SESSION['items'][$id_produk]);
                    header("Content-Type: application/json");
    			echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
                }
            }
        } elseif ($act == "clear") {
            if (isset($_SESSION['items'])) {
                foreach ($_SESSION['items'] as $key => $val) {
                    unset($_SESSION['items'][$key]);
                }
                unset($_SESSION['items']);
                header("Content-Type: application/json");
    			echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
            }
        } 
    }
?>