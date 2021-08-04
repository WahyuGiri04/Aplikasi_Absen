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
                                $id_fakultas = $_GET['id_fak'];
                            ?>
                        </div>
                        <div class="ibox-content">
                            <form action="forward.php" method="POST">
                                <input hidden type="text" name="id_fakultas" value = "<?php echo $id_fakultas; ?>" class="form-control">
                                <div class="form-group row"><label class="col-lg-4 col-form-label">Prodi</label>
                                    <div class="col-lg-8">
                                        <select required class="form-control m-b" name="prodi" id = "prodi">
                                            <option selected value="">Pilih prodi :....</option>
                                            <?php
                                            $sql_prodi = $koneksi->query("SELECT * FROM tb_prodi WHERE id_fakultas = '$id_fakultas'");
                                            while($prodi = $sql_prodi->fetch_assoc()){?>
                                                <option value="<?php echo $prodi['id_prodi'] ?>"><?php echo $prodi['nama_prodi'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-4 col-form-label">Kelas</label>
                                    <div class="col-lg-8">
                                        <select required class="form-control m-b" name="kelas" id = "kelas">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-lg-4 col-form-label">Angkatan</label>
                                    <div class="col-lg-8">
                                        <select required class="form-control m-b" name="angkatan" id = "angkatan">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"> </i> Cari Data</button>
                                    </div>
                                </div>
                            </form>
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

    <script src="../../../template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
    
            $("#prodi").change(function(){
            var prodi = $("#prodi").val();
                $.ajax({
                    type: 'POST',
                    url: "get_kelas2.php",
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
    
            $("#kelas").change(function(){
            var kelas = $("#kelas").val();
                $.ajax({
                    type: 'POST',
                    url: "get_angkatan.php",
                    data: {kelas: kelas},
                    cache: false,
                    success: function(msg){
                    $("#angkatan").html(msg);
                    }
                });
            });

        });
    </script>

</body>
</html>
