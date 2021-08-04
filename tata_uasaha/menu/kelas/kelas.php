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
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>DATA KELAS</h5>
                            <?php
                                include ('../../../koneksi.php');
                            ?>
                        </div>
                        <div class="ibox-content">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"> </i>
                                Tambah Kelas
                            </button>
                            <br><br>
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-plus modal-icon"></i>
                                            <h5 class="modal-title">Tambah Kelas</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ibox ">
                                                <div class="ibox-content">
                                                    <form action="../../aksi/tambah_kelas.php" method="POST">
                                                        <?php
                                                        $kode_fakultas = $_SESSION['username'];
                                                        $sql_fak = $koneksi->query("SELECT * FROM tb_fakultas WHERE kode_fakultas = '$kode_fakultas'");
                                                        $data_fak = $sql_fak->fetch_assoc();
                                                        $id_fakultas = $data_fak['id_fakultas'];
                                                        ?>
                                                        <input hidden type="text" name="id_fakultas" placeholder="Kode Mata Kuliah" value = "<?php echo $id_fakultas; ?>" class="form-control">
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Nama Kelas</label>
                                                            <div class="col-lg-8"><input type="text" name="nama_kelas" placeholder="Nama Kelas" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Angkatan</label>
                                                            <div class="col-lg-8"><input type="text" name="angkatan" placeholder="Angkatan" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Prodi</label>
                                                            <div class="col-lg-8">
                                                                <select class="form-control m-b" name="prodi">
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
                                            <th>Kelas</th>
                                            <th>Angkatan</th>
                                            <th>Prodi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql_data_kelas = $koneksi->query("SELECT * FROM tb_kelas INNER JOIN tb_prodi ON tb_prodi.id_prodi=tb_kelas.id_prodi WHERE tb_kelas.id_fakultas = '$id_fakultas' ORDER BY nama_kelas ASC");
                                        while($data_kelas = $sql_data_kelas->fetch_assoc()){
                                            $id_kelas = $data_kelas['id_kelas'];
                                            $id[] = $id_kelas;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data_kelas['nama_kelas'] ?></td>
                                            <td><?php echo $data_kelas['angkatan'] ?></td>
                                            <td><?php echo $data_kelas['nama_prodi'] ?></td>
                                            <td class="center">                                               
                                                <a href="jadwal_kelas.php?id_kelas=<?php echo $id_kelas ?>" class="btn btn-primary "><i class="fa fa-calendar"> </i> Jadwal</a>
                                                <a href="anggota_kelas.php?id_kelas=<?php echo $data_kelas['id_kelas']; ?>" class="btn btn-success "><i class="fa fa-users"> </i> Mahasiswa</a>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#<?php echo $id_kelas ?>">
                                                    <i class="fa fa-edit"> </i>
                                                    Edit Kelas
                                                </button>
                                                <div class="modal inmodal" id="<?php echo $id_kelas ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content animated rollIn">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                <i class="fa fa-edit modal-icon"></i>
                                                                <h5 class="modal-title">Edit Kelas</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="ibox ">
                                                                    <div class="ibox-content">
                                                                        <form action="../../aksi/edit_kelas.php" method="POST">
                                                                            <input type="text" hidden value="<?php echo $id_kelas ?>" name="id_kelas">
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">Nama Kelas</label>
                                                                                <div class="col-lg-8"><input type="text" value="<?php echo $data_kelas['nama_kelas'] ?>" name="nama_kelas" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">Angkatan</label>
                                                                                <div class="col-lg-8"><input type="text" value="<?php echo $data_kelas['angkatan'] ?>" name="angkatan" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">Prodi</label>
                                                                                <div class="col-lg-8">
                                                                                    <select class="form-control m-b" name="prodi">
                                                                                    <?php
                                                                                    $sql_prodi = $koneksi->query("SELECT * FROM tb_prodi WHERE id_fakultas = '$id_fakultas'");
                                                                                    while($prodi = $sql_prodi->fetch_assoc()){
                                                                                    if($data_kelas['id_prodi']===$prodi['id_prodi']){
                                                                                        $ket = "selected";
                                                                                    }else{
                                                                                        $ket = "";
                                                                                    }
                                                                                    ?>
                                                                                        <option <?php echo $ket ?> value="<?php echo $prodi['id_prodi'] ?>"><?php echo $prodi['nama_prodi'] ?></option>
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
                                                <button class="btn btn-danger hapus<?php echo $id_kelas ?>"><i class="fa fa-trash"> </i> Hapus</button>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Angkatan</th>
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
                                window.location.href = "../../aksi/hapus_kelas.php?id_kelas=<?php echo $id[$x] ?>";
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
