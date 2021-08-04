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

    <link href="../../../template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
    <?php
    include ('../menu_samping.php');
    ?>

    <div id="page-wrapper" class="gray-bg">
        <?php
        include ('../menu_atas.php');
        ?>
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">                           
                            <?php
                                $id_absen = $_GET['id_absen'];
                                $nama_makul = $_GET['nama_makul'];
                                include ('../../../koneksi.php');
                            ?>
                            <h5>DETAIL ABSEN <?php echo $nama_makul ?></h5>
                        </div>
                        <div class="ibox-content">
                            <a type="button" class="btn btn-primary" href = "detail_absensi_print.php?id_absen=<?php echo $id_absen ?>&nama_makul=<?php echo $nama_makul ?>" target = "_blank">
                                <i class="fa fa-print"> </i>
                                Cetak Laporan Absensi <?php echo $nama_makul ?>
                            </a>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Kelas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $n = 1;
                                        $sql_data_absen = $koneksi->query("SELECT * FROM tb_detail_absen INNER JOIN tb_mahasiswa ON tb_mahasiswa.id_mahasiswa=tb_detail_absen.id_mahasiswa WHERE id_absen = '$id_absen' ORDER BY id_absen ASC");
                                        while($data_absen = $sql_data_absen->fetch_assoc()){
                                            $id_absen = $data_absen['id_detail_absen'];
                                            $id[] = $id_absen;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data_absen['nim'] ?></td>
                                            <td><?php echo $data_absen['nama_mahasiswa'] ?></td>
                                            <td><?php echo $data_absen['keterangan'] ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Kelas</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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

    <!-- Data picker -->
   <script src="../../../template/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
            });

            var mem = $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
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
                                window.location.href = "../../aksi/hapus_absen.php?id_absen=<?php echo $id[$x] ?>&id_absen=<?php echo $id_absen ?>&nama_makul=<?php $nama_makul ?>";
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
