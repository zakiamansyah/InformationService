<?php
function kodeotomatis($tabel,$field,$lebar=0,$awalan='') {
 $sqlstr="SELECT $field FROM $tabel ORDER by $field DESC limit 1";
 $hasil=mysql_query($sqlstr);
 	if(!$hasil) die('gagal auto number query:'.mysql_error());
 		$jumlahrecord=mysql_num_rows($hasil);
 		if($jumlahrecord == 0)
 			$nomor=1;
 		else
 		{
 	$row=mysql_fetch_array($hasil);
 	$nomor=intval(substr($row[0],strlen($awalan)))+1;
 	}
 	if($lebar>0)
 		$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
 	else
 		$angka = $awalan.$nomor;
 		return $angka;
 	}
?>
