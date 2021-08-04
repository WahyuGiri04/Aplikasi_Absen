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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>DATA MAHASISWA</h5>
                            <?php
                                include ('../../../koneksi.php');
                            ?>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Prodi</th>
                                            <th>Kelas</th>
                                            <th>Angkatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $id_kelas = $_GET['id_kelas'];
                                        $sql_data_mahasiswa = $koneksi->query("SELECT * FROM tb_mahasiswa LEFT JOIN tb_kelas ON tb_mahasiswa.id_kelas=tb_kelas.id_kelas INNER JOIN tb_prodi ON tb_prodi.id_prodi=tb_mahasiswa.id_prodi WHERE tb_kelas.id_kelas = '$id_kelas' ORDER BY nama_mahasiswa ASC");
                                        while($data_mahasiswa = $sql_data_mahasiswa->fetch_assoc()){
                                            $id_mahasiswa = $data_mahasiswa['id_mahasiswa'];
                                            $id[] = $id_mahasiswa;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data_mahasiswa['nim'] ?></td>
                                            <td><?php echo $data_mahasiswa['nama_mahasiswa'] ?></td>
                                            <td><?php echo $data_mahasiswa['nama_prodi'] ?></td>
                                            <td><?php echo $data_mahasiswa['nama_kelas'] ?></td>
                                            <td><?php echo $data_mahasiswa['angkatan'] ?></td>
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
                                            <th>Prodi</th>
                                            <th>Kelas</th>
                                            <th>Angkatan</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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

    <!-- Page-Level Scripts -->
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
                        window.location.href = "../../aksi/hapus_mahasiswa.php?id_mahasiswa=<?php echo $id[$x] ?>";
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

    <script type="text/javascript">
        $(document).ready(function(){
    
            $("#prodi").change(function(){
            var prodi = $("#prodi").val();
                $.ajax({
                    type: 'POST',
                    url: "get_kelas.php",
                    data: {prodi: prodi},
                    cache: false,
                    success: function(msg){
                    $("#kelas").html(msg);
                    }
                });
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
    
            $("#e_prodi").change(function(){
            var prodi = $("#e_prodi").val();
                $.ajax({
                    type: 'POST',
                    url: "get_kelas.php",
                    data: {prodi: prodi},
                    cache: false,
                    success: function(msg){
                    $("#e_kelas").html(msg);
                    }
                });
            });


        });
    </script>
</body>
</html>
