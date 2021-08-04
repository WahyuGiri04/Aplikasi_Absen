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
                    <?php
                        include ('../../../koneksi.php');
                        $id_jadwal = $_GET['id_jadwal'];
                        $id_makul = $_GET['id_makul'];
                        $sql_nama_kelas = $koneksi->query("SELECT * FROM tb_makul WHERE id_makul = '$id_makul'");
                        $nama_kelas = $sql_nama_kelas->fetch_assoc();
                        $sql_prodi = $koneksi->query("SELECT * FROM tb_jadwal INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_jadwal.id_kelas WHERE id_jadwal = '$id_jadwal'");
                        $prodi = $sql_prodi->fetch_assoc();
                        $id_prodi = $prodi['id_prodi'];
                    ?>
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>DATA ANGGOTA KELAS <?php echo strtoupper($nama_kelas['nama_makul']); ?> </h5>
                        </div>
                        <div class="ibox-content">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"> </i>
                                Tambah Anggota Kelas
                            </button>
                            <br><br>
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-plus modal-icon"></i>
                                            <h5 class="modal-title">Tambah Anggota Kelas</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ibox ">
                                                <div class="ibox-content">
                                                    <form action="../../aksi/tambah_anggota_kelas.php" method="POST">
                                                        <input hidden type="text" name="id_jadwal" placeholder="Kode Mata Kuliah" value = "<?php echo $id_jadwal; ?>" class="form-control">
                                                        <input hidden type="text" name="id_makul" placeholder="Kode Mata Kuliah" value = "<?php echo $id_makul; ?>" class="form-control">
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">NIM / Nama Mahasiswa</label>
                                                            <div class="col-lg-8">
                                                                <select name = "id_mahasiswa" data-placeholder="Choose a Country..." class="chosen-select"  tabindex="2">
                                                                    <?php
                                                                    $sql_mahasiswa = $koneksi->query("SELECT * FROM tb_mahasiswa WHERE id_prodi = '$id_prodi'");
                                                                    while($mahasiswa = $sql_mahasiswa->fetch_assoc()){?>
                                                                        <option value="<?php echo $mahasiswa['id_mahasiswa'] ?>"><?php echo $mahasiswa['nim'] ?> ( <?php echo $mahasiswa['nama_mahasiswa'] ?> )</option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-offset-2 col-lg-10">
                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql_anggota_kelas = $koneksi->query("SELECT * FROM tb_anggota_kelas INNER JOIN tb_mahasiswa ON tb_mahasiswa.id_mahasiswa=tb_anggota_kelas.id_mahasiswa INNER JOIN tb_prodi ON tb_prodi.id_prodi=tb_mahasiswa.id_prodi INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_mahasiswa.id_kelas WHERE id_jadwal = '$id_jadwal'");
                                        while($data_mahasiswa = $sql_anggota_kelas->fetch_assoc()){
                                            $id_anggota_kelas = $data_mahasiswa['id_anggota_kelas'];
                                            $id[] = $id_anggota_kelas;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data_mahasiswa['nim'] ?></td>
                                            <td><?php echo $data_mahasiswa['nama_mahasiswa'] ?></td>
                                            <td><?php echo $data_mahasiswa['nama_prodi'] ?></td>
                                            <td><?php echo $data_mahasiswa['nama_kelas'] ?></td>
                                            <td><?php echo $data_mahasiswa['angkatan'] ?></td>
                                            <td class="center">
                                                <button class="btn btn-danger hapus<?php echo $id_anggota_kelas ?>"><i class="fa fa-trash"> </i> Hapus</button>
                                            </td>
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
                                            <th>Aksi</th>
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

    <!-- Page-Level Scripts -->
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
                        window.location.href = "../../aksi/hapus_anggota_kelas.php?id_anggota_kelas=<?php echo $id[$x] ?>&id_jadwal=<?php echo $id_jadwal ?>&id_makul=<?php echo $id_makul ?>";
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
