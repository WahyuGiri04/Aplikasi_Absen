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
                                <table class="table table-striped" >
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
                                        include ('../../../koneksi.php');
                                        $id_absen = $_GET['id_absen'];
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
