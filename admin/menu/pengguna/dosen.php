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

<link href="../../../template/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

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
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>DATA PENGGUNA DOSEN</h5>
                            <?php
                                include ('../../../koneksi.php');
                            ?>
                        </div>
                        <div class="ibox-content">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"> </i>
                                Tambah Data Pengguna Dosen
                            </button>
                            <br><br>
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-plus modal-icon"></i>
                                            <h5 class="modal-title">Tambah Data Pengguna Dosen</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ibox ">
                                                <div class="ibox-content">
                                                    <form action="../../aksi/tambah_pengguna_dosen.php" method="POST">
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">NIP / Username</label>
                                                            <div class="col-lg-8">
                                                                <select name = "id_dosen" data-placeholder="NIP / Username ...." class="chosen-select"  tabindex="2">
                                                                    <?php
                                                                    $sql_dosen = $koneksi->query("SELECT * FROM tb_dosen INNER JOIN tb_prodi ON tb_dosen.id_prodi=tb_prodi.id_prodi");
                                                                    while($dosen = $sql_dosen->fetch_assoc()){?>
                                                                        <option value="<?php echo $dosen['id_dosen'] ?>"><?php echo $dosen['nip'] ?> ( <?php echo $dosen['nama_dosen'] ?> / <?php echo $dosen['nama_prodi'] ?> )</option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Password</label>
                                                            <div class="col-lg-8"><input type="password" name="password" placeholder="Password" class="form-control"></div>
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
                                            <th>NIP / Username</th>
                                            <th>Nama Dosen</th>
                                            <th>Prodi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql_pengguna_dosen = $koneksi->query("SELECT * FROM tb_user INNER JOIN tb_dosen ON tb_dosen.nip=tb_user.username INNER JOIN tb_prodi ON tb_dosen.id_prodi=tb_prodi.id_prodi WHERE level = 'dosen' ORDER BY username ASC");
                                        while($data_pengguna_dosen = $sql_pengguna_dosen->fetch_assoc()){
                                            $id_user = $data_pengguna_dosen['id_user'];
                                            $id[] = $id_user;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data_pengguna_dosen['username'] ?></td>
                                            <td><?php echo $data_pengguna_dosen['nama_pengguna'] ?></td>
                                            <td><?php echo $data_pengguna_dosen['nama_prodi'] ?></td>
                                            <td class="center">
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#<?php echo $id_user ?>">
                                                    <i class="fa fa-edit"> </i>
                                                    Edit Passowrd Pengguna Dosen
                                                </button>
                                                <div class="modal inmodal" id="<?php echo $id_user ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content animated rollIn">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                <i class="fa fa-edit modal-icon"></i>
                                                                <h5 class="modal-title">Edit Password Pengguna Dosen</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="ibox ">
                                                                    <div class="ibox-content">
                                                                        <form action="../../aksi/edit_password.php" method="POST">
                                                                            <input type="text" hidden value="<?php echo $id_user ?>" name="id_user">
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">NIP / Username</label>
                                                                                <div class="col-lg-8"><input disabled type="text" value="<?php echo $data_pengguna_dosen['username'] ?>" name="username" placeholder="NIP" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">Nama Dosen</label>
                                                                                <div class="col-lg-8"><input disabled type="text" value="<?php echo $data_pengguna_dosen['nama_pengguna'] ?>" name="nama_pengguna" placeholder="Nama Dosen" class="form-control"></div>
                                                                            </div>
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">Password</label>
                                                                                <div class="col-lg-8"><input type="password" name="password" placeholder="Password" class="form-control"></div>
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
                                                <button class="btn btn-danger hapus<?php echo $id_user ?>"><i class="fa fa-trash"> </i> Hapus</button>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP / Username</th>
                                            <th>Nama Dosen</th>
                                            <th>Prodi</th>
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
                        window.location.href = "../../aksi/hapus_pengguna_dosen.php?id_user=<?php echo $id[$x] ?>";
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
