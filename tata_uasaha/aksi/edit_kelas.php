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

   $id_kelas = $_POST['id_kelas'];
   $nama_kelas = $_POST['nama_kelas'];
   $angkatan = $_POST['angkatan'];
   $prodi = $_POST['prodi'];

   $edit_kelas = $koneksi->query("UPDATE `tb_kelas` SET nama_kelas = '$nama_kelas', angkatan = '$angkatan', id_prodi = '$prodi' WHERE id_kelas = '$id_kelas'");

   if($edit_kelas===true){
      echo '<script>
         swal({
            title: "Berhasil di Ubah !!!",
            text: "You clicked the button!",
            type: "success",
            confirmButtonColor: "#0061a8"
         },function(){
            window.location.href = "../menu/kelas/kelas.php";
         });
      </script>';
   }else{
      echo '<script>
         swal({
            title: "Gagal di Ubah !!!",
            text: "You clicked the button!",
            type: "error",
            confirmButtonColor: "#DD6B55"
         },function(){
            window.location.href = "../menu/kelas/kelas.php";
         });
      </script>';
   }
?>
</body>

</html>