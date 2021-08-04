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

   $id_absen = $_GET['id_absen'];
   $id_mahasiswa = $_GET['id_mahasiswa'];

   $sql_jadwal = $koneksi->query("SELECT * FROM tb_absen WHERE id_absen = '$id_absen'");
   $jadwal = $sql_jadwal->fetch_assoc();
   $id_jadwal = $jadwal['id_jadwal'];

   $sql_nama_makul = $koneksi->query("SELECT * FROM tb_jadwal INNER JOIN tb_makul ON tb_jadwal.id_makul=tb_makul.id_makul WHERE id_jadwal = '$id_jadwal'");
   $nama_makul = $sql_nama_makul->fetch_assoc();
   $mata_kulia = $nama_makul['nama_makul'];

   $sql_data_absen = $koneksi->query("SELECT COUNT(id_jadwal) as jumlah FROM tb_detail_absen WHERE id_absen = '$id_absen' AND id_mahasiswa = '$id_mahasiswa'");
   $data_absen = $sql_data_absen->fetch_assoc();

   $sql_anggota = $koneksi->query("SELECT COUNT(id_anggota_kelas) as jumlah FROM tb_anggota_kelas WHERE id_mahasiswa = '$id_mahasiswa' AND id_jadwal = '$id_jadwal'");
   $anggota_kelas = $sql_anggota->fetch_assoc();
   $anggota = $anggota_kelas['jumlah'];
   
   if($data_absen['jumlah'] > 0){
      echo '<script>
         swal({
            title: "Gagal !!!",
            text: "Anda sudah Absen !!!",
            type: "error",
            confirmButtonColor: "#DD6B55"
         },function(){
            window.location.href = "../menu/absen/absen.php";
         });
      </script>';
   }elseif($anggota==='0'){
      echo '<script>
         swal({
            title: "Gagal !!!",
            text: "Anda Bukan Anggota Kelas !!!",
            type: "error",
            confirmButtonColor: "#DD6B55"
         },function(){
            window.location.href = "../menu/absen/absen.php";
         });
      </script>';
   }else{

      date_default_timezone_set('Asia/Jakarta');
      $sql_tanggal = $koneksi->query("SELECT * FROM tb_absen INNER JOIN tb_jadwal ON tb_jadwal.id_jadwal=tb_absen.id_jadwal WHERE id_absen = '$id_absen'");
      $tanggal = $sql_tanggal->fetch_assoc();
      $tanggal_jadwal = $tanggal['tanggal'];
      $tanggal_sekarang = date("Y-m-d");
      $jam_mulai = $tanggal['waktu_mulai'];
      $jam_selesai = $tanggal['waktu_selesai'];
      $jam_sekarang = date('H:i:s');

      if(strtotime($tanggal_jadwal)<strtotime($tanggal_sekarang)){
         $keterangan = "TERLAMBAT";
      }elseif(strtotime($tanggal_sekarang)===strtotime($tanggal_jadwal)){
         if(strtotime($jam_sekarang)<strtotime($jam_mulai)){
            $keterangan = "TEPAT WAKTU";
         }elseif((strtotime($jam_sekarang)>strtotime($jam_selesai))){
            $keterangan = "TERLAMBAT";
         }else{
            $keterangan = "TEPAT WAKTU";
         }
      }else{
         $keterangan = "TEPAT WAKTU";
      }
         $tambah_absen = $koneksi->query("INSERT INTO tb_detail_absen SET id_absen = '$id_absen', id_jadwal = '$id_jadwal', id_mahasiswa = '$id_mahasiswa', keterangan = '$keterangan', waktu = '$jam_sekarang'");

         if($tambah_absen===true){
            echo '<script>
               swal({
                  title: "Berhasil Absen !!!",
                  text: "Mata Kuliah : '.$mata_kulia.' & Keterangan : '.$keterangan.'",
                  type: "success",
                  confirmButtonColor: "#0061a8"
               },function(){
                  window.location.href = "../menu/hasil_absen/hasil_absen.php?id_jadwal='.$id_jadwal.'&id_mahasiswa='.$id_mahasiswa.'";
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
                  window.location.href = "../menu/hasil_absen/hasil_absen.php?id_jadwal='.$id_jadwal.'&id_mahasiswa='.$id_mahasiswa.'";
               });
            </script>';
         }

   }

?>
</body>

</html>