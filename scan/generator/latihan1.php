<?php

	include "phpqrcode/qrlib.php"; 

	//isi qrcode jika di scan
	$codeContents = 'https://www.maribelajarcoding.com'; 
	 
	//output gambar langsung ke browser, sebagai PNG
	QRcode::png($codeContents); 
	

 ?>