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
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Waktu</th>
                                            <th>Waktu Keterlambatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id_jadwal = $_GET['id_jadwal'];
                                        $id_mahasiswa = $_GET['id_mahasiswa'];
                                        $nama_makul = $_GET['nama_makul'];
                                        include ('../../../koneksi.php');
                                        $sql_jadwal = $koneksi->query("SELECT * FROM tb_jadwal WHERE id_jadwal = '$id_jadwal'");
                                        $data_jadwal = $sql_jadwal->fetch_assoc();
                                        $no = 1;
                                        $sql_data_absen = $koneksi->query("SELECT * FROM tb_absen INNER JOIN tb_detail_absen ON tb_absen.id_absen=tb_detail_absen.id_absen WHERE tb_absen.id_jadwal = '$id_jadwal' AND tb_detail_absen.id_mahasiswa = '$id_mahasiswa'");
                                        while($data_absen = $sql_data_absen->fetch_assoc()){
                                            $id_absen = $data_absen['id_detail_absen'];
                                            $id[] = $id_absen;
                                            $tanggal = date('d F Y', strtotime($data_absen['tanggal']));
                                            $tanggal_waktu = date('d F Y / H:i', strtotime($data_absen['waktu']));

                                            if($data_absen['keterangan']==="TERLAMBAT"){
                                                $waktu_awal = strtotime($data_jadwal['waktu_selesai']);
                                                $waktu_akhir = strtotime($data_absen['waktu']);
                                                $diff = $waktu_akhir - $waktu_awal;
                                                $jam =floor($diff / (60 * 60));
                                                $menit =$diff - $jam * (60 * 60);
                                                $menit = floor( $menit / 60 );
                                                $waktu_terlambat = "Terlambat $jam jam dan $menit menit";
                                            }else{
                                                $waktu_terlambat = "0 Jam 0 Menit";
                                            }
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $tanggal ?></td>
                                            <td><?php echo $data_absen['keterangan'] ?></td>
                                            <td><?php echo $tanggal_waktu ?></td>
                                            <td><?php echo $waktu_terlambat ?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Waktu</th>
                                            <th>Waktu Keterlambatan</th>
                                        </tr>
                                    </tfoot>
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
