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
                            <h5>DATA MAHASISWA</h5>
                            <?php
                                include ('../../../koneksi.php');
                                $id_jadwal = $_GET['id_jadwal'];
                                $sql_jadwal = $koneksi->query("SELECT * FROM tb_jadwal INNER JOIN tb_makul ON tb_makul.id_makul=tb_jadwal.id_makul WHERE id_jadwal = '$id_jadwal'");
                                $data_jadwal = $sql_jadwal->fetch_assoc();
                                $nama_makul = $data_jadwal['nama_makul'];
                            ?>
                        </div>
                        <div class="ibox-content">
                            <a type="button" class="btn btn-primary" href = "print_laporan.php?id_jadwal=<?php echo $id_jadwal ?>&nama_makul=<?php echo $nama_makul ?>" target = "_blank">
                                <i class="fa fa-print"> </i>
                                Cetak Laporan Absensi <?php echo $nama_makul ?>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Tepat Waktu</th>
                                            <th>Terlambat</th>
                                            <th>Alfa</th>
                                            <th>Total Pertemuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql_data_mahasiswa = $koneksi->query("SELECT * FROM tb_anggota_kelas INNER JOIN tb_mahasiswa ON tb_mahasiswa.id_mahasiswa=tb_anggota_kelas.id_mahasiswa WHERE id_jadwal = '$id_jadwal'");
                                        while($data_mahasiswa = $sql_data_mahasiswa->fetch_assoc()){
                                            $id_mahasiswa = $data_mahasiswa['id_mahasiswa'];

                                            $sql_jumlah_pertemuan = $koneksi->query("SELECT COUNT(id_absen) AS jumlah_pertemuan FROM tb_absen WHERE id_jadwal = '$id_jadwal'");
                                            $jumlah_pertemuan = $sql_jumlah_pertemuan->fetch_assoc();
                                            $jumlah_pertemuan = $jumlah_pertemuan['jumlah_pertemuan'];

                                            $sql_jumlah_asben = $koneksi->query("SELECT COUNT(id_detail_absen) AS jumlah_absen FROM tb_detail_absen WHERE id_jadwal = '$id_jadwal' AND id_mahasiswa = '$id_mahasiswa'");
                                            $jumlah_absen = $sql_jumlah_asben->fetch_assoc();
                                            $jumlah_absen = $jumlah_absen['jumlah_absen'];

                                            $sql_terlambat = $koneksi->query("SELECT COUNT(id_detail_absen) AS jumlah_terlambat FROM tb_detail_absen WHERE id_jadwal = '$id_jadwal' AND id_mahasiswa = '$id_mahasiswa' AND keterangan = 'TERLAMBAT'");
                                            $terlambat = $sql_terlambat->fetch_assoc();
                                            $terlambat = $terlambat['jumlah_terlambat'];
                                            $terlambat = @($terlambat / $jumlah_pertemuan) * 100 ;

                                            $sql_tepat = $koneksi->query("SELECT COUNT(id_detail_absen) AS jumlah_tepat FROM tb_detail_absen WHERE id_jadwal = '$id_jadwal' AND id_mahasiswa = '$id_mahasiswa' AND keterangan = 'TEPAT WAKTU'");
                                            $tepat = $sql_tepat->fetch_assoc();
                                            $tepat = $tepat['jumlah_tepat'];
                                            $tepat = @($tepat / $jumlah_pertemuan) * 100 ;

                                            $alpa = $jumlah_pertemuan - $jumlah_absen;
                                            $alpa =@($alpa/$jumlah_pertemuan) * 100;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data_mahasiswa['nim'] ?></td>
                                            <td><?php echo $data_mahasiswa['nama_mahasiswa'] ?></td>
                                            <td><?php echo round($tepat,2) ?> %</td>
                                            <td><?php echo round($terlambat,2) ?> %</td>
                                            <td><?php echo round($alpa,2) ?> %</td>
                                            <td><?php echo $jumlah_pertemuan ?> Pertemuan</td>
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
                                            <th>Tepat Waktu</th>
                                            <th>Terlambat</th>
                                            <th>Alfa</th>
                                            <th>Total Pertemuan</th>
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

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
            });

        });

    </script>
    <script src="../../../template/js/plugins/sweetalert/sweetalert.min.js"></script>

    
</body>
</html>
