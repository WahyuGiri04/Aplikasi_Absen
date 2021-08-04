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

   $id_jadwal = $_POST['id_jadwal'];
   $id_makul = $_POST['makul'];
   $jam_mulai = $_POST['jam_mulai'];
   $jam_selesai = $_POST['jam_selesai'];
   $id_kelas = $_POST['kelas'];
   $id_ruangan = $_POST['ruangan'];
   $hari = $_POST['hari'];
   $prodi = $_POST['prodi'];
   $id_dosen = $_POST['id_dosen'];

   $edit_jadwal = $koneksi->query("UPDATE tb_jadwal SET id_makul = '$id_makul', waktu_mulai = '$jam_mulai', waktu_selesai = '$jam_selesai', id_kelas = '$id_kelas', id_ruangan = '$id_ruangan', hari = '$hari', id_dosen = '$id_dosen' WHERE id_jadwal = '$id_jadwal'");
  
   $hapus_anggota_kelas = $koneksi->query("DELETE FROM tb_anggota_kelas WHERE id_jadwal = '$id_jadwal'");

   $sql_anggota_kelas = $koneksi->query("SELECT * FROM tb_mahasiswa WHERE id_kelas = '$id_kelas'");
   while($anggota_kelas = $sql_anggota_kelas->fetch_assoc()){
      
      $id_mahasiswa = $anggota_kelas['id_mahasiswa'];
      $tambah_anggota_kelas = $koneksi->query("INSERT INTO tb_anggota_kelas SET id_jadwal = '$id_jadwal', id_mahasiswa = '$id_mahasiswa'");
   }
  
   if($edit_jadwal===true){
    echo '<script>
       swal({
          title: "Berhasil !!!",
          text: "You clicked the button!",
          type: "success",
          confirmButtonColor: "#0061a8"
       },function(){
          window.location.href = "../menu/jadwal/jadwal_prodi.php?id_prodi='.$prodi.'";
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
          window.location.href = "../menu/jadwal/jadwal_prodi.php?id_prodi='.$prodi.'";
       });
    </script>';
   }
?>
</body>

</html>