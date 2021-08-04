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
                                include ('../../../koneksi.php');
                                $nim = $_SESSION['username'];
                                $sql_mahasiswa = $koneksi->query("SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
                                $mahasiswa = $sql_mahasiswa->fetch_assoc();
                                $id_mahasiswa = $mahasiswa['id_mahasiswa'];
                            ?>
                            <h5>DATA ABSENSI</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Makul</th>
                                            <th>Nama Dosen</th>
                                            <th>Hari</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql_data_jadwal = $koneksi->query("SELECT * FROM tb_jadwal INNER JOIN tb_anggota_kelas ON tb_jadwal.id_jadwal=tb_anggota_kelas.id_jadwal INNER JOIN tb_makul ON tb_makul.id_makul=tb_jadwal.id_makul INNER JOIN tb_dosen ON tb_dosen.id_dosen=tb_makul.id_dosen WHERE id_mahasiswa = '$id_mahasiswa'");
                                        while($data_jadwal = $sql_data_jadwal->fetch_assoc()){
                                            $id_jadwal = $data_jadwal['id_jadwal'];
                                            $id[] = $id_jadwal;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data_jadwal['nama_makul'] ?></td>
                                            <td><?php echo $data_jadwal['nama_dosen'] ?></td>
                                            <td><?php echo $data_jadwal['hari'] ?></td>
                                            <td class="center">
                                                <a href="hasil_absen.php?id_mahasiswa=<?php echo $id_mahasiswa ?>&id_jadwal=<?php echo $id_jadwal ?>" class="btn btn-primary "><i class="fa fa-calendar"> </i> Detail Absensi</a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Makul</th>
                                            <th>Nama Dosen</th>
                                            <th>Hari</th>
                                            <th>Aksi</th>
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
                                window.location.href = "../../aksi/hapus_absen.php?id_absen=<?php echo $id[$x] ?>&id_jadwal=<?php echo $id_jadwal ?>&nama_makul=<?php $nama_makul ?>";
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
