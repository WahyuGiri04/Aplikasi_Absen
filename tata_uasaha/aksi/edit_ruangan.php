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

   $id_ruangan = $_POST['id_ruangan'];
   $nama_ruangan = $_POST['nama_ruangan'];

   $sql_data_ruangan = $koneksi->query("SELECT COUNT(nama_ruangan) as jumlah FROM tb_ruangan WHERE nama_ruangan = '$nama_ruangan'");
   $data_ruangan = $sql_data_ruangan->fetch_assoc();
   
   if($data_ruangan['jumlah'] > 0){
      echo '<script>
         swal({
            title: "Gagal !!!",
            text: "Data Sudah Ada !!!",
            type: "error",
            confirmButtonColor: "#DD6B55"
         },function(){
            window.location.href = "../menu/ruangan/ruangan.php";
         });
      </script>';
   }else{
      $edit_ruangan = $koneksi->query("UPDATE `tb_ruangan` SET nama_ruangan = '$nama_ruangan' WHERE id_ruangan = '$id_ruangan'");

      if($edit_ruangan===true){
         echo '<script>
            swal({
               title: "Berhasil !!!",
               text: "You clicked the button!",
               type: "success",
               confirmButtonColor: "#0061a8"
            },function(){
               window.location.href = "../menu/ruangan/ruangan.php";
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
               window.location.href = "../menu/ruangan/ruangan.php";
            });
         </script>';
      }

   }

?>
</body>

</html>