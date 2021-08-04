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
                                $id_jadwal = $_GET['id_jadwal'];
                                $id_mahasiswa = $_GET['id_mahasiswa'];
                                $sql_makul = $koneksi->query("SELECT * FROM tb_jadwal INNER JOIN tb_makul ON tb_makul.id_makul=tb_jadwal.id_makul WHERE id_jadwal = '$id_jadwal'");
                                $makul = $sql_makul->fetch_assoc();
                                $nama_makul = $makul['nama_makul'];
                                $sql_jadwal = $koneksi->query("SELECT * FROM tb_jadwal WHERE id_jadwal = '$id_jadwal'");
                                $data_jadwal = $sql_jadwal->fetch_assoc();
                            ?>
                            <h5>DATA ABSEN <?php echo $nama_makul ?></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
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
    
</body>
</html>
