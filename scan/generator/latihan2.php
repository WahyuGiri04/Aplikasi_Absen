<?php

	include "phpqrcode/qrlib.php"; 

	$tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
	if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

    //isi qrcode jika di scan
    $codeContents = 'https://www.maribelajarcoding.com'; 
	 
	//simpan file kedalam folder temp dengan nama 001.png
	QRcode::png($codeContents,$tempdir."001.png"); 


	echo '<h2>Simpan File QRCode</h2>';
	//menampilkan file qrcode 
	echo '<img src="'.$tempdir.'001.png" />';
 ?>