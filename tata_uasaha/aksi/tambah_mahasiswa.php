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
   $nama_mahasiswa = $_POST['nama_mahasiswa'];
   $nim = $_POST['nim'];
   $prodi = $_POST['prodi'];
   $kelas = $_POST['kelas'];

   $sql_kelas = $koneksi->query("SELECT * FROM tb_kelas WHERE id_kelas = '$kelas'");
   $data_kelas = $sql_kelas->fetch_assoc();
   $nama_kelas = $data_kelas['nama_kelas'];

   $id_prodi = $_GET['prodi'];
   $angkatan = $_GET['angkatan'];

   $sql_data_mahasiswa = $koneksi->query("SELECT COUNT(nama_mahasiswa) as jumlah FROM tb_mahasiswa WHERE nim = '$nim'");
   $data_mahasiswa = $sql_data_mahasiswa->fetch_assoc();

   if($data_mahasiswa['jumlah'] > 0){
      echo '<script>
         swal({
            title: "Gagal !!!",
            text: "Data Sudah Ada !!!",
            type: "error",
            confirmButtonColor: "#DD6B55"
         },function(){
            window.location.href = "../menu/mahasiswa/mahasiswa.php?prodi='.$id_prodi.'&angkatan='.$angkatan.'&kelas='.$nama_kelas.'";
         });
      </script>';
   }else{
      $tambah_mahasiswa = $koneksi->query("INSERT INTO tb_mahasiswa SET nama_mahasiswa = '$nama_mahasiswa', nim = '$nim', id_prodi = '$prodi', id_kelas = '$kelas', id_fakultas = '$id_fakultas'");

      if($tambah_mahasiswa===true){
         echo '<script>
            swal({
               title: "Berhasil !!!",
               text: "You clicked the button!",
               type: "success",
               confirmButtonColor: "#0061a8"
            },function(){
               window.location.href = "../menu/mahasiswa/mahasiswa.php?prodi='.$id_prodi.'&angkatan='.$angkatan.'&kelas='.$nama_kelas.'";
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
               window.location.href = "../menu/mahasiswa/mahasiswa.php?prodi='.$id_prodi.'&angkatan='.$angkatan.'&kelas='.$nama_kelas.'";
            });
         </script>';
      }
   }

?>
</body>

</html>