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

   $id_dosen = $_POST['id_dosen'];

   $data_dosen = $koneksi->query("SELECT * FROM tb_dosen WHERE id_dosen = '$id_dosen'");
   $dosen = $data_dosen->fetch_assoc();
   
   $username = $dosen['nip'];
   $nama_pengguna = $dosen['nama_dosen'];

   $password = $_POST['password'];
   $pass = md5($password);

   $tambah_pengguna_dosen = $koneksi->query("INSERT INTO tb_user SET username = '$username', nama_pengguna = '$nama_pengguna', password = '$pass', level = 'dosen'");

   if($tambah_pengguna_dosen===true){
      echo '<script>
         swal({
            title: "Berhasil !!!",
            text: "You clicked the button!",
            type: "success",
            confirmButtonColor: "#0061a8"
         },function(){
            window.location.href = "../menu/pengguna/dosen.php";
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
            window.location.href = "../menu/pengguna/dosen.php";
         });
      </script>';
   }
?>
</body>

</html>