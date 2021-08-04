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

      $id_makul = $_GET['id_makul'];

      $sql_fak = $koneksi->query("SELECT * FROM tb_makul INNER JOIN tb_prodi ON tb_prodi.id_prodi=tb_makul.id_prodi WHERE id_makul='$id_makul'");
      $data_fak = $sql_fak->fetch_assoc();
      $id_fak = $data_fak['id_fakultas'];
      $id_prodi = $data_fak['id_prodi'];

      $hapus_makul = $koneksi->query("DELETE FROM `tb_makul` WHERE id_makul = '$id_makul'");

      if($hapus_makul===true){
         echo '<script>
            swal({
               title: "Berhasil !!!",
               text: "You clicked the button!",
               type: "success",
               confirmButtonColor: "#0061a8"
            },function(){
               window.location.href = "../menu/mata_kuliah/mata_kuliah.php?prodi='.$id_prodi.'&id_fak='.$id_fak.'";
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
               window.location.href = "../menu/mata_kuliah/mata_kuliah.php?prodi='.$id_prodi.'&id_fak='.$id_fak.'";
            });
         </script>';
      }
   ?>

</body>

</html>