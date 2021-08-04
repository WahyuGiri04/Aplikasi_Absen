<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../template/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="../template/css/animate.css" rel="stylesheet">
    <link href="../template/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        
    </div>

    <script src="../template/js/jquery-3.1.1.min.js"></script>
    <script src="../template/js/popper.min.js"></script>
    <script src="../template/js/bootstrap.js"></script>
    <script src="../template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../template/js/inspinia.js"></script>
    <script src="../template/js/plugins/pace/pace.min.js"></script>
   <script src="../template/js/plugins/sweetalert/sweetalert.min.js"></script>


    <?php

    session_start();
    include "../koneksi.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    $sql_login = $koneksi->query("SELECT COUNT(id_user) AS jumlah FROM tb_user WHERE username = '$username' AND password = '$password' AND level = 'mahasiswa'");
    $login = $sql_login->fetch_assoc();
    $sql_data = $koneksi->query("SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");
    $data = $sql_data->fetch_assoc();
    if($login['jumlah']==="1"){
        $_SESSION['username'] = $data['username'];
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama_pengguna'] = $data['nama_pengguna'];
        echo '<script>
         swal({
            title: "Berhasil Login !!!",
            text: "You clicked the button!",
            type: "success",
            confirmButtonColor: "#0061a8"
         },function(){
            window.location.href = "menu/home/home.php";
         });
      </script>';
    }else{
        echo '<script>
         swal({
            title: "Gagal Login !!!",
            text: "You clicked the button!",
            type: "error",
            confirmButtonColor: "#DD6B55"
         },function(){
            window.location.href = "index.php";
         });
      </script>';
    }

    ?>
</body>

</html>