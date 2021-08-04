<?php
	include "phpqrcode/qrlib.php"; 

	$tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
	if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

    //isi qrcode jika di scan
    $codeContents = 'https://www.maribelajarcoding.com'; 
	 
	//simpan file kedalam temp 
	//nilai konfigurasi Frame di bawah 4 tidak direkomendasikan 
    QRcode::png($codeContents, $tempdir.'008_4.png', QR_ECLEVEL_L, 3, 4);   
    QRcode::png($codeContents, $tempdir.'008_6.png', QR_ECLEVEL_L, 3, 6); 
    QRcode::png($codeContents, $tempdir.'008_12.png', QR_ECLEVEL_L, 3, 10); 

    echo '<h2>Ukuran Frame QRCode</h2>';
    // displaying 
    echo '<img src="'.$tempdir.'008_4.png" />'; 
    echo '<img src="'.$tempdir.'008_6.png" />'; 
    echo '<img src="'.$tempdir.'008_12.png" />'; 
?>