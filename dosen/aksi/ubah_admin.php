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

   $id_user = $_POST['id_user'];
   $password_baru = $_POST['password_baru'];
   $konfir_password = $_POST['konfir_password'];
   $password = $_POST['password'];
   $pass = md5($password);
   $pass_new = md5($password_baru);
   $username = $_POST['username'];

   $sql_user = $koneksi->query("SELECT COUNT(id_user) AS jumlah FROM tb_user WHERE username = '$username' AND password = '$pass' AND level = 'dosen'");
   $user = $sql_user->fetch_assoc();
   $jumlah = $user['jumlah'];

   if($jumlah==1){

      if($password_baru===$konfir_password){
         $edit_pengguna_admin = $koneksi->query("UPDATE `tb_user` SET password = '$pass_new' WHERE id_user = '$id_user'");

         if($edit_pengguna_admin===true){
            echo '<script>
               swal({
                  title: "Berhasil di Ubah !!!",
                  text: "Silahkan Login Kembali :)",
                  type: "success",
                  confirmButtonColor: "#0061a8"
               },function(){
                  window.location.href = "../logout.php";
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
                  window.location.href = "../menu/setting/setting.php";
               });
            </script>';
         }
      }else{
         echo '<script>
         swal({
            title: "Gagal di Ubah !!!",
            text: "Password baru dan Konfirmasi password berbeda !!!",
            type: "error",
            confirmButtonColor: "#DD6B55"
         },function(){
            window.location.href = "../menu/setting/setting.php";
         });
      </script>';
      }

   }else{
      echo '<script>
         swal({
            title: "Gagal di Ubah !!!",
            text: "Password lama berbeda !!!",
            type: "error",
            confirmButtonColor: "#DD6B55"
         },function(){
            window.location.href = "../menu/setting/setting.php";
         });
      </script>';
   }

?>
</body>

</html>