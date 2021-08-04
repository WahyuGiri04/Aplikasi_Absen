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
   $kode_fakultas = $_POST['kode_fakultas'];
   $nama_fakultas = $_POST['nama_fakultas'];

   $sql_data_fakultas = $koneksi->query("SELECT COUNT(nama_fakultas) as jumlah FROM tb_fakultas WHERE kode_fakultas = '$kode_fakultas'");
   $data_fakultas = $sql_data_fakultas->fetch_assoc();

      $edit_fakultas = $koneksi->query("UPDATE `tb_fakultas` SET nama_fakultas = '$nama_fakultas', kode_fakultas = '$kode_fakultas' WHERE id_fakultas = '$id_fakultas'");

      if($edit_fakultas===true){
         echo '<script>
            swal({
               title: "Berhasil !!!",
               text: "You clicked the button!",
               type: "success",
               confirmButtonColor: "#0061a8"
            },function(){
               window.location.href = "../menu/fakultas/fakultas.php";
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
               window.location.href = "../menu/fakultas/fakultas.php";
            });
         </script>';
      }

?>
</body>

</html>