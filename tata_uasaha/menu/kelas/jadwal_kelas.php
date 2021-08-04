<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include ('../../title.php');
    ?>


    <link href="../../../template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="../../../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../../../template/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="../../../template/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

    <link href="../../../template/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <link href="../../../template/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="../../../template/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="../../../template/css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="../../../template/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="../../../template/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="../../../template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="../../../template/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="../../../template/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="../../../template/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="../../../template/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="../../../template/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="../../../template/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="../../../template/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <link href="../../../template/css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">

    <link href="../../../template/css/animate.css" rel="stylesheet">
    <link href="../../../template/css/style.css" rel="stylesheet">

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
                            <h5>DATA JADWAL</h5>
                            <?php
                                include ('../../../koneksi.php');
                                $id_kelas = $_GET['id_kelas'];
                            ?>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Makul</th>
                                            <th>Dosen Pengampu</th>
                                            <th>Ruangan</th>
                                            <th>Jam</th>
                                            <th>Hari</th>
                                            <th>Kelas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql_data_jadwal = $koneksi->query("SELECT * FROM tb_jadwal INNER JOIN tb_makul ON tb_makul.id_makul=tb_jadwal.id_makul INNER JOIN tb_dosen ON tb_dosen.id_dosen=tb_makul.id_dosen INNER JOIN tb_ruangan ON tb_ruangan.id_ruangan=tb_jadwal.id_ruangan INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_jadwal.id_kelas WHERE tb_kelas.id_kelas = '$id_kelas'");
                                        while($data_jadwal = $sql_data_jadwal->fetch_assoc()){
                                            $id_jadwal = $data_jadwal['id_jadwal'];
                                            $id[] = $id_jadwal;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data_jadwal['nama_makul'] ?></td>
                                            <td><?php echo $data_jadwal['nama_dosen'] ?></td>
                                            <td><?php echo $data_jadwal['nama_ruangan'] ?></td>
                                            <td><?php echo $data_jadwal['waktu_mulai'] ?> - <?php echo $data_jadwal['waktu_selesai'] ?></td>
                                            <td><?php echo $data_jadwal['hari'] ?></td>
                                            <td><?php echo $data_jadwal['nama_kelas'] ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Makul</th>
                                            <th>Dosen Pengampu</th>
                                            <th>Ruangan</th>
                                            <th>Jam</th>
                                            <th>Hari</th>
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

    <!-- Chosen -->
    <script src="../../../template/js/plugins/chosen/chosen.jquery.js"></script>

   <!-- JSKnob -->
   <script src="../../../template/js/plugins/jsKnob/jquery.knob.js"></script>

   <!-- Input Mask-->
    <script src="../../../template/js/plugins/jasny/jasny-bootstrap.min.js"></script>

   <!-- Data picker -->
   <script src="../../../template/js/plugins/datapicker/bootstrap-datepicker.js"></script>

   <!-- NouSlider -->
   <script src="../../../template/js/plugins/nouslider/jquery.nouislider.min.js"></script>

   <!-- Switchery -->
   <script src="../../../template/js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="../../../template/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="../../../template/js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="../../../template/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="../../../template/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="../../../template/js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="../../../template/js/plugins/cropper/cropper.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="../../../template/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="../../../template/js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="../../../template/js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="../../../template/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Tags Input -->
    <script src="../../../template/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- Dual Listbox -->
    <script src="../../../template/js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
            });
            $('.chosen-select').chosen({width: "100%"});

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
                        window.location.href = "../../aksi/hapus_jadwal.php?id_jadwal=<?php echo $id[$x] ?>&id_prodi=<?php echo $id_prodi ?>";
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
