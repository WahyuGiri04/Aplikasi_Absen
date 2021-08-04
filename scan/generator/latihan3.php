<?php
	include "phpqrcode/qrlib.php"; 

	$tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
	if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

    //isi qrcode jika di scan
    $codeContents = 'https://www.maribelajarcoding.com'; 
	 
	//simpan file kedalam temp 
	//Kode QR mendukung empat tingkat koreksi kesalahan untuk memungkinkan pemulihan data yang hilang, salah dibaca, atau dikaburkan
	
	QRcode::png($codeContents, $tempdir.'006_L.png', QR_ECLEVEL_L); 
    QRcode::png($codeContents, $tempdir.'006_M.png', QR_ECLEVEL_M); 
    QRcode::png($codeContents, $tempdir.'006_Q.png', QR_ECLEVEL_Q); 
    QRcode::png($codeContents, $tempdir.'006_H.png', QR_ECLEVEL_H);

    echo '<h2>ECC Level QRCode</h2>';
	//menampilkan file qrcode 
	echo '<img src="'.$tempdir.'006_L.png" />'; 
    echo '<img src="'.$tempdir.'006_M.png" />'; 
    echo '<img src="'.$tempdir.'006_Q.png" />'; 
    echo '<img src="'.$tempdir.'006_H.png" />'; 
?>