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

    $id_user = $_GET['id_user'];

    $hapus_pengguna_dosen = $koneksi->query("DELETE FROM `tb_user` WHERE id_user = '$id_user'");

    if($hapus_pengguna_dosen===true){
        echo '<script>
            swal({
                title: "Berhasil Hapus Data !!!",
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
                title: "Gagal Hapus Data !!!",
                text: "You clicked the button!",
                type: "error",
                confirmButtonColor: "#0061a8"
            },function(){
                window.location.href = "../menu/pengguna/dosen.php";
            });
        </script>';
    }
    ?>

</body>

</html>