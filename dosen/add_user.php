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
    $konfir_password = $_POST['konfir_password'];
    $konfir_password = md5($konfir_password);
    $password = md5($password);

    if($konfir_password===$password){
        $sql_cek_dosen = $koneksi->query("SELECT COUNT(id_dosen) AS jumlah_dosen FROM tb_dosen WHERE nip = '$username'");
        $cek_dosen = $sql_cek_dosen->fetch_assoc();
        $jumlah_dosen = $cek_dosen['jumlah_dosen'];
        if($jumlah_dosen==="0"){
            echo '<script>
                swal({
                    title: "Gagal !!!",
                    text: "Anda Bukan Dosen !!!",
                    type: "error",
                    confirmButtonColor: "#DD6B55"
                },function(){
                    window.location.href = "index.php";
                });
            </script>';
        }else{
            $sql_cek_user = $koneksi->query("SELECT COUNT(id_user) AS jumlah_user FROM tb_user WHERE username = '$username'");
            $cek_user = $sql_cek_user->fetch_assoc();
            $jumlah_user = $cek_user['jumlah_user'];

            if($jumlah_user==="0"){

                $sql_nama_pengguna = $koneksi->query("SELECT * FROM tb_dosen WHERE nip = '$username'");
                $nama_pengguna = $sql_nama_pengguna->fetch_assoc();
                $nama_pengguna = $nama_pengguna['nama_dosen'];

                $sql_tambah_user = $koneksi->query("INSERT INTO tb_user SET username = '$username', nama_pengguna = '$nama_pengguna', password = '$password', level = 'dosen'");

                if($sql_tambah_user===TRUE){
                    echo '<script>
                     swal({
                        title: "Berhasil Buat Membuat Akun dan Silahkan Login !!!",
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

            }else{
                echo '<script>
                    swal({
                        title: "Gagal !!!",
                        text: "Anda Sudah Terdaftar !!!",
                        type: "error",
                        confirmButtonColor: "#DD6B55"
                    },function(){
                        window.location.href = "index.php";
                    });
                </script>';
            }
        }
    }else{
        echo '<script>
         swal({
            title: "Gagal !!!",
            text: "Password dan Konfirmasi Password berbeda !!!",
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