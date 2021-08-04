<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include ('../../title.php');
    ?>

    <link href="../../../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../../../template/css/animate.css" rel="stylesheet">
    <link href="../../../template/css/style.css" rel="stylesheet">
    
    <link href="../../../template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <script>
	  (adsbygoogle = window.adsbygoogle || []).push({
		google_ad_client: "ca-pub-6724419004010752",
		enable_page_level_ads: true
	  });
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131906273-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'UA-131906273-1');
	</script>

</head>

<body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <div id="wrapper">
    <?php
    include ('../menu_samping.php');
    ?>

    <div id="page-wrapper" class="gray-bg">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        include ('../menu_atas.php');
        ?>
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>SCAN QR-CODE <?php echo date('H:i:s') ?></h5>
                            <?php
                                include ('../../../koneksi.php');
                            ?>
                        </div>
                        <div class="ibox-content">
                            <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                            <div class="col-sm-12">
                                <video id="preview" class="p-1 border" style="width:100%;"></video>
                            </div>
                            <?php
                            $nim = $_SESSION['username'];
                            $sql_mahasiswa = $koneksi->query("SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
                            $mahasiswa = $sql_mahasiswa->fetch_assoc();
                            $id_mahasiswa = $mahasiswa['id_mahasiswa'];
                            ?>
                            <script type="text/javascript">
                                var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
                                scanner.addListener('scan',function(content){
                                    window.location.href="../../aksi/tambah_absen.php?id_absen="+content+"&id_mahasiswa=<?php echo $id_mahasiswa ?>";
                                });
                                Instascan.Camera.getCameras().then(function (cameras){
                                    if(cameras.length>0){
                                        scanner.start(cameras[1]);
                                    }else{
                                        console.error('No cameras found.');
                                        alert('No cameras found.');
                                    }
                                }).catch(function(e){
                                    console.error(e);
                                    alert(e);
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include ('../footer.php');
            ?>
        </div>
    </div>

    <script src="../../../template/js/jquery-3.1.1.min.js"></script>
    <script src="../../../template/js/popper.min.js"></script>
    <script src="../../../template/js/bootstrap.js"></script>
    <script src="../../../template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../../../template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../../../template/js/plugins/dataTables/datatables.min.js"></script>
    <script src="../../../template/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../../../template/js/inspinia.js"></script>
    <script src="../../../template/js/plugins/pace/pace.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
            });

        });

    </script>
    <script src="../../../template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>

        $(document).ready(function () {
        <?php
        $jumlah = count($id);
        for ($x = 0; $x < $jumlah; $x++) {
        ?>
            $('.hapus<?php echo $id[$x] ?>').click(function () {
                swal({
                            title: "Apakah kamu yakin?",
                            text: "Your will not be able to recover this imaginary file!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel !",
                            closeOnConfirm: false,
                            closeOnCancel: false },
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location.href = "../../aksi/hapus_dosen.php?id_dosen=<?php echo $id[$x] ?>";
                            } else {
                                swal("Batal !!!", "Your imaginary file is safe :)", "error");
                            }
                        });
            });
        <?php
            }
        ?>

        });

    </script>
    
</body>
</html>
