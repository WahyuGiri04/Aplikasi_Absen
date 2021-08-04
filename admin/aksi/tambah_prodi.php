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

   $id_fakultas = $_POST['id_fakultas'];
   $kode_prodi = $_POST['kode_prodi'];
   $nama_prodi = $_POST['nama_prodi'];

   $sql_data_prodi = $koneksi->query("SELECT COUNT(nama_prodi) as jumlah FROM tb_prodi WHERE nama_prodi = '$nama_prodi'");
   $data_prodi = $sql_data_prodi->fetch_assoc();
   
   if($data_prodi['jumlah'] > 0){
      echo '<script>
         swal({
            title: "Gagal !!!",
            text: "Data Sudah Ada !!!",
            type: "error",
            confirmButtonColor: "#DD6B55"
         },function(){
            window.location.href = "../menu/fakultas/prodi.php?id_fakultas='.$id_fakultas.'";
         });
      </script>';
   }else{
      $tambah_prodi = $koneksi->query("INSERT INTO tb_prodi SET nama_prodi = '$nama_prodi', id_fakultas = '$id_fakultas', kode_prodi = '$kode_prodi'");

      if($tambah_prodi===true){
         echo '<script>
            swal({
               title: "Berhasil !!!",
               text: "You clicked the button!",
               type: "success",
               confirmButtonColor: "#0061a8"
            },function(){
               window.location.href = "../menu/fakultas/prodi.php?id_fakultas='.$id_fakultas.'";
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
               window.location.href = "../menu/fakultas/prodi.php?id_fakultas='.$id_fakultas.'";
            });
         </script>';
      }

   }

?>
</body>

</html>