<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../template/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="../../template/css/animate.css" rel="stylesheet">
    <link href="../../template/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        
    </div>

    <script src="../../template/js/jquery-3.1.1.min.js"></script>
    <script src="../../template/js/popper.min.js"></script>
    <script src="../../template/js/bootstrap.js"></script>
    <script src="../../template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../../template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../../template/js/inspinia.js"></script>
    <script src="../../template/js/plugins/pace/pace.min.js"></script>
   <script src="../../template/js/plugins/sweetalert/sweetalert.min.js"></script>
<?php

   include ('../../koneksi.php');

   $id_jadwal = $_POST['id_jadwal'];
   $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));

   $nama_makul = $_POST['nama_makul'];

   $tambah_absen = $koneksi->query("INSERT INTO tb_absen SET id_jadwal = '$id_jadwal', tanggal = '$tanggal'");

   $sql_absen = $koneksi->query("SELECT * FROM `tb_absen` ORDER BY id_absen DESC LIMIT 1");
   $absen = $sql_absen->fetch_assoc();
   $id_absen = $absen['id_absen'];

   include "phpqrcode/qrlib.php"; 

    $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
    if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

            //isi qrcode jika di scan
    $codeContents = $id_absen;
            //nama file qrcode yang akan disimpan
    $namaFile=$id_absen.".png";
            //ECC Level
    $level=QR_ECLEVEL_H;
            //Ukuran pixel
    $UkuranPixel=10;
            //Ukuran frame
    $UkuranFrame=4;

    QRcode::png($codeContents, $tempdir.$namaFile, $level, $UkuranPixel, $UkuranFrame); 

    $update_absen = $koneksi->query("UPDATE tb_absen SET qr_code = '$namaFile' WHERE id_absen = '$id_absen'");

   if($update_absen===true){
      echo '<script>
         swal({
            title: "Berhasil !!!",
            text: "You clicked the button!",
            type: "success",
            confirmButtonColor: "#0061a8"
         },function(){
            window.location.href = "../menu/jadwal/absen.php?id_jadwal='.$id_jadwal.'&nama_makul='.$nama_makul.'";
         });
      </script>';
   }else{
      echo '<script>
         swal({
            title: "Gagal !!!",
            text: "You clicked the button!",
            type: "error",
            confirmButtonColor: "#DD6B55"
         },function(){
            window.location.href = "../menu/jadwal/absen.php?id_jadwal='.$id_jadwal.'&nama_makul='.$nama_makul.'";
         });
      </script>';
   }
?>
</body>

</html>