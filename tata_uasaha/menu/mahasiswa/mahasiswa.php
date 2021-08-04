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
                                $id_prodi = $_GET['prodi'];
                                $angkatan = $_GET['angkatan'];
                                $kelas = $_GET['kelas'];
                            ?>
                        </div>
                        <div class="ibox-content">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"> </i>
                                Tambah Data Mahasiswa
                            </button>
                            <br><br>
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-plus modal-icon"></i>
                                            <h5 class="modal-title">Tambah Data Mahasiswa</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ibox ">
                                                <div class="ibox-content">
                                                    <form action="../../aksi/tambah_mahasiswa.php?prodi=<?php echo $id_prodi ?>&angkatan=<?php echo $angkatan ?>" method="POST">
                                                        <?php
                                                        $kode_fakultas = $_SESSION['username'];
                                                        $sql_fak = $koneksi->query("SELECT * FROM tb_fakultas WHERE kode_fakultas = '$kode_fakultas'");
                                                        $data_fak = $sql_fak->fetch_assoc();
                                                        $id_fakultas = $data_fak['id_fakultas'];
                                                        ?>
                                                        <input hidden type="text" name="id_fakultas" placeholder="Kode Mata Kuliah" value = "<?php echo $id_fakultas; ?>" class="form-control">
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">NIM</label>
                                                            <div class="col-lg-8"><input type="text" name="nim" placeholder="NIM Mahasiswa" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Nama Mahasiswa</label>
                                                            <div class="col-lg-8"><input type="text" name="nama_mahasiswa" placeholder="Nama Mahasiswa" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Prodi</label>
                                                            <div class="col-lg-8">
                                                                <select class="form-control m-b" name="prodi" id = "prodi">
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
                                                                <select class="form-control m-b" name="kelas" id = "kelas">
                                                                    <option value=""></option>
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
                                        $sql_data_mahasiswa = $koneksi->query("SELECT * FROM tb_mahasiswa INNER JOIN tb_prodi ON tb_prodi.id_prodi=tb_mahasiswa.id_prodi INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_mahasiswa.id_kelas WHERE tb_mahasiswa.id_fakultas = '$id_fakultas' AND tb_prodi.id_prodi = '$id_prodi' AND angkatan = '$angkatan' AND nama_kelas = '$kelas' ORDER BY nama_mahasiswa ASC");
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
                                            <td class="center">
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#<?php echo $id_mahasiswa ?>">
                                                    <i class="fa fa-edit"> </i>
                                                    Edit Mahasiswa
                                                </button>
                                                <div class="modal inmodal" id="<?php echo $id_mahasiswa ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content animated rollIn">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                <i class="fa fa-edit modal-icon"></i>
                                                                <h5 class="modal-title">Edit Mahasiswa</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="ibox ">
                                                                    <div class="ibox-content">
                                                                        <form action="../../aksi/edit_mahasiswa.php?prodi=<?php echo $id_prodi ?>&angkatan=<?php echo $angkatan ?>" method="POST">
                                                                            <input type="text" hidden value="<?php echo $id_mahasiswa ?>" name="id_mahasiswa">
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">NIM</label>
                                                                                <div class="col-lg-8">
                                                                                    <input type="text" hidden value="<?php echo $data_mahasiswa['nim'] ?>" name="nim" class="form-control">
                                                                                    <input type="text" disabled value="<?php echo $data_mahasiswa['nim'] ?>" name="" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">Nama Mahasiswa</label>
                                                                                <div class="col-lg-8"><input type="text" value="<?php echo $data_mahasiswa['nama_mahasiswa'] ?>" name="nama_mahasiswa" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">Prodi</label>
                                                                                <div class="col-lg-8">
                                                                                    <select class="form-control m-b" name="prodi" id = "e_prodi">
                                                                                        <?php
                                                                                        $sql_prodi = $koneksi->query("SELECT * FROM tb_prodi WHERE id_fakultas = '$id_fakultas'");
                                                                                        while($prodi = $sql_prodi->fetch_assoc()){
                                                                                            if($data_kelas['id_prodi']===$prodi['id_prodi']){
                                                                                                $ket = "selected";
                                                                                            }else{
                                                                                                $ket = "";
                                                                                            }
                                                                                        ?>
                                                                                            <option value="<?php echo $prodi['id_prodi'] ?>"><?php echo $prodi['nama_prodi'] ?></option>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row"><label class="col-lg-4 col-form-label">Kelas</label>
                                                                                <div class="col-lg-8">
                                                                                    <select class="form-control m-b" name="kelas" id = "e_kelas">
                                                                                        <?php
                                                                                        $prodi = $data_mahasiswa['id_prodi'];
                                                                                        $sql_kelas = $koneksi->query("SELECT * FROM tb_kelas WHERE id_prodi = '$prodi' ");
                                                                                        while($kelas=$sql_kelas->fetch_assoc()){
                                                                                            if($data_mahasiswa['kelas']==$kelas['id_kelas']){
                                                                                                $select = "selected";
                                                                                            }else{
                                                                                                $select = "";
                                                                                            }
                                                                                            ?>
                                                                                                <option <?php echo $select ?> value="<?php echo $kelas['id_kelas'] ?>"> <?php echo $kelas['nama_kelas'] ?> / <?php echo $kelas['angkatan'] ?></option>
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
                                                <button class="btn btn-danger hapus<?php echo $id_mahasiswa ?>"><i class="fa fa-trash"> </i> Hapus</button>
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
                        window.location.href = "../../aksi/hapus_mahasiswa.php?id_mahasiswa=<?php echo $id[$x] ?>&prodi=<?php echo $id_prodi ?>&angkatan=<?php echo $angkatan ?>";
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
