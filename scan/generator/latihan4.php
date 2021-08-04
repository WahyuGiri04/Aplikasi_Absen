<?php
	include "phpqrcode/qrlib.php"; 

	$tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
	if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

    //isi qrcode jika di scan
    $codeContents = 'https://www.maribelajarcoding.com'; 
	 
	//simpan file kedalam temp 
	//parameter ke empat ukuran pixel qrcode
	QRcode::png($codeContents, $tempdir.'007_1.png', QR_ECLEVEL_L, 1); 
    QRcode::png($codeContents, $tempdir.'007_2.png', QR_ECLEVEL_L, 2); 
    QRcode::png($codeContents, $tempdir.'007_3.png', QR_ECLEVEL_L, 3); 
    QRcode::png($codeContents, $tempdir.'007_4.png', QR_ECLEVEL_L, 4);

    echo '<h2>Ukuran Pixel QRCode</h2>';
	//menampilkan file qrcode 
	echo '<img src="'.$tempdir.'007_1.png" />'; 
    echo '<img src="'.$tempdir.'007_2.png" />'; 
    echo '<img src="'.$tempdir.'007_3.png" />'; 
    echo '<img src="'.$tempdir.'007_4.png" />'; 
?>