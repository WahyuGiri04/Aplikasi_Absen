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
    
    <link href="../../../template/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

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
                            <h5>DATA DOSEN</h5>
                            <?php
                                include ('../../../koneksi.php');
                                echo $id_fak = $_GET['id_fak'];
                                echo $id_pro = $_GET['id_prodi'];
                                if(($id_pro==="")&&($id_fak==="")){
                                    $sql_data_prodi = $koneksi->query("SELECT * FROM tb_prodi ORDER BY nama_prodi ASC");
                                    $sql_data_dosen = $koneksi->query("SELECT * FROM tb_dosen INNER JOIN tb_prodi ON tb_prodi.id_prodi=tb_dosen.id_prodi ORDER BY nama_dosen ASC");
                                }elseif($id_pro===""){
                                    $sql_data_prodi = $koneksi->query("SELECT * FROM tb_prodi WHERE tb_prodi.id_fakultas='$id_fak' ORDER BY nama_prodi ASC");
                                    $sql_data_dosen = $koneksi->query("SELECT * FROM tb_dosen INNER JOIN tb_prodi ON tb_prodi.id_prodi=tb_dosen.id_prodi WHERE tb_prodi.id_fakultas='$id_fak' ORDER BY nama_dosen ASC");
                                }else{
                                    $sql_data_prodi = $koneksi->query("SELECT * FROM tb_prodi WHERE tb_prodi.id_fakultas='$id_fak' AND tb_prodi.id_prodi='$id_pro' ORDER BY nama_prodi ASC");
                                    $sql_data_dosen = $koneksi->query("SELECT * FROM tb_dosen INNER JOIN tb_prodi ON tb_prodi.id_prodi=tb_dosen.id_prodi WHERE tb_prodi.id_fakultas='$id_fak' AND tb_prodi.id_prodi='$id_pro' ORDER BY nama_dosen ASC");
                                }
                            ?>
                        </div>
                        <div class="ibox-content">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"> </i>
                                Tambah Data Dosen
                            </button>
                            <br><br>
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-plus modal-icon"></i>
                                            <h5 class="modal-title">Tambah Data Dosen</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ibox ">
                                                <div class="ibox-content">
                                                    <form action="../../aksi/tambah_dosen.php" method="POST">
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">NIP</label>
                                                            <div class="col-lg-8"><input type="text" name="nip" placeholder="NIP" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Nama Dosen</label>
                                                            <div class="col-lg-8"><input type="text" name="nama_dosen" placeholder="Nama Dosen" class="form-control"></div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Prodi</label>
                                                            <div class="col-lg-8">
                                                                <select class="form-control m-b" name="id_prodi">
                                                                <?php
                                                                while($data_prodi=$sql_data_prodi->fetch_assoc()){?>
                                                                    <option value="<?php echo $data_prodi['id_prodi'] ?>"><?php echo $data_prodi['nama_prodi'] ?></option>
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
                                            <th>NIP</th>
                                            <th>Nama Dosen</th>
                                            <th>Prodi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while($data_dosen = $sql_data_dosen->fetch_assoc()){
                                            $id_dosen = $data_dosen['id_dosen'];
                                            $id[] = $id_dosen;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data_dosen['nip'] ?></td>
                                            <td><?php echo $data_dosen['nama_dosen'] ?></td>
                                            <td><?php echo $data_dosen['nama_prodi'] ?></td>
                                            <td class="center">
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#<?php echo $id_dosen ?>">
                                                    <i class="fa fa-edit"> </i>
                                                    Edit Data Dosen
                                                </button>
                                                <div class="modal inmodal" id="<?php echo $id_dosen ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content animated rollIn">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                <i class="fa fa-edit modal-icon"></i>
                                                                <h5 class="modal-title">Edit Data Dosen</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="ibox ">
                                                                    <div class="ibox-content">
                                                                        <form action="../../aksi/edit_dosen.php" method="POST">
                                                                            <input type="text" hidden value="<?php echo $id_dosen ?>" name="id_dosen">
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">NIP</label>
                                                                                <div class="col-lg-8"><input disabled type="text" value="<?php echo $data_dosen['nip'] ?>" name="nip" placeholder="NIP" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">Nama Dosen</label>
                                                                                <div class="col-lg-8"><input type="text" value="<?php echo $data_dosen['nama_dosen'] ?>" name="nama_dosen" placeholder="Nama Dosen" class="form-control"></div>
                                                                            </div>
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">Prodi</label>
                                                                                <div class="col-lg-8">
                                                                                    <select class="form-control m-b" name="id_prodi">
                                                                                    <?php
                                                                                    $id_prodi = $data_dosen['id_prodi'];
                                                                                    $sql_data_prodi = $koneksi->query("SELECT * FROM tb_prodi ORDER BY nama_prodi ASC");
                                                                                    while($data_prodi=$sql_data_prodi->fetch_assoc()){?>
                                                                                        <option <?php if($id_prodi==$data_prodi['id_prodi']){ echo "selected";}?> value="<?php echo $data_prodi['id_prodi'] ?>"><?php echo $data_prodi['nama_prodi'] ?></option>
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
                                                <button class="btn btn-danger hapus<?php echo $id_dosen ?>"><i class="fa fa-trash"> </i> Hapus</button>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
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
                                window.location.href = "../../aksi/hapus_dosen.php?id_dosen=<?php echo $id[$x] ?>";
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

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
            });

        });

    </script>
    
    
</body>
</html>
