<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../../../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../../../template/css/animate.css" rel="stylesheet">
    <link href="../../../template/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">

        <div class="wrapper wrapper-content  animated fadeInRight article">
            <div class="row justify-content-md-center">
                <div class="col-lg-10">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="text-center article-title">
                            <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date('d-M-Y') ?></span>
                                <h1>
                                    Laporan Absen <?php echo $_GET['nama_makul'] ?>
                                </h1>
                            </div>
                            <div>
                                <table border="1" class="table table-striped" >
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
                                        include ('../../../koneksi.php');
                                        $no = 1;
                                        $id_jadwal = $_GET['id_jadwal'];
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
                                            $alpa = @($alpa/$jumlah_pertemuan) * 100;
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
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

    <!-- Mainly scripts -->
    <script src="../../../template/js/jquery-3.1.1.min.js"></script>
    <script src="../../../template/js/popper.min.js"></script>
    <script src="../../../template/js/bootstrap.js"></script>
    <script src="../../../template/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../../../template/js/inspinia.js"></script>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>
