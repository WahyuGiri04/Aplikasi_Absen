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
                            <h5>DATA JADWAL</h5>
                            <?php
                                include ('../../../koneksi.php');
                                $id_prodi = $_GET['id_prodi'];
                                $sql_prodi = $koneksi->query("SELECT * FROM tb_prodi WHERE id_prodi = '$id_prodi'");
                                $prodi = $sql_prodi->fetch_assoc();
                                $nama_prodi = $prodi['nama_prodi'];
                                $id_fakultas = $prodi['id_fakultas'];
                            ?>
                        </div>
                        <div class="ibox-content">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"> </i>
                                Tambah Data Jadwal <?php echo $nama_prodi ?>
                            </button>
                            <br><br>
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-plus modal-icon"></i>
                                            <h5 class="modal-title">Tambah Data Jadwal <?php echo $nama_prodi ?></h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ibox ">
                                                <div class="ibox-content">
                                                    <form action="../../aksi/tambah_jadwal.php" method="POST">
                                                        <input type="text" name="prodi" hidden value = "<?php echo $id_prodi ?>" class="form-control">
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Hari</label>
                                                            <div class="col-lg-8">
                                                                <select class="form-control m-b" name="hari">
                                                                    <option value="Senin">Senin</option>
                                                                    <option value="Selasa">Selasa</option>
                                                                    <option value="Rabu">Rabu</option>
                                                                    <option value="Kamis">Kamis</option>
                                                                    <option value="Jumat">Jum'at</option>
                                                                    <option value="Sabtu">Sabtu</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Jam Mulai</label>
                                                            <div class="col-lg-8">
                                                                <input type="time" name="jam_mulai" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Jam Selesai</label>
                                                            <div class="col-lg-8">
                                                                <input type="time" name="jam_selesai" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Kelas</label>
                                                            <div class="col-lg-8">
                                                                <select class="form-control m-b" name="kelas">
                                                                    <option value="">Pilih kelas :...</option>
                                                                <?php
                                                                $sql_kelas = $koneksi->query("SELECT * FROM tb_kelas WHERE id_prodi = '$id_prodi' ORDER BY nama_kelas ASC");
                                                                while($data_kelas=$sql_kelas->fetch_assoc()){?>
                                                                    <option value="<?php echo $data_kelas['id_kelas'] ?>"><?php echo $data_kelas['nama_kelas'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Ruangan</label>
                                                            <div class="col-lg-8">
                                                                <select class="form-control m-b" name="ruangan">
                                                                    <?php
                                                                    $sql_ruangan = $koneksi->query("SELECT * FROM tb_ruangan WHERE id_fakultas = '$id_fakultas'");
                                                                    while($ruangan = $sql_ruangan->fetch_assoc()){?>
                                                                        <option value="<?php echo $ruangan['id_ruangan'] ?>"><?php echo $ruangan['nama_ruangan'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Mata Kuliah</label>
                                                            <div class="col-lg-8">
                                                                <select name = "makul" data-placeholder="Choose a Country..." class="chosen-select"  tabindex="2">
                                                                    <?php
                                                                    $sql_makul = $koneksi->query("SELECT * FROM tb_makul INNER JOIN tb_prodi ON tb_prodi.id_prodi=tb_makul.id_prodi WHERE tb_prodi.id_prodi = '$id_prodi' ORDER BY tb_makul.nama_makul");
                                                                    while($makul = $sql_makul->fetch_assoc()){?>
                                                                        <option value="<?php echo $makul['id_makul'] ?>"><?php echo $makul['nama_makul'] ?> (<?php echo $makul['nama_prodi'] ?>)</option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row"><label class="col-lg-4 col-form-label">Nama Dosen</label>
                                                            <div class="col-lg-8">
                                                                <select class="form-control m-b" name="id_dosen">
                                                                    <option value="">Pilih Dosen :...</option>
                                                                <?php
                                                                $sql_dosen = $koneksi->query("SELECT * FROM tb_dosen WHERE id_prodi = '$id_prodi' ORDER BY nama_dosen ASC");
                                                                while($data_dosen=$sql_dosen->fetch_assoc()){?>
                                                                    <option value="<?php echo $data_dosen['id_dosen'] ?>"><?php echo $data_dosen['nama_dosen'] ?></option>
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
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <?php 
                                    $sql_angkatan = $koneksi->query("SELECT * FROM tb_kelas GROUP BY angkatan ORDER BY angkatan DESC");
                                    while($data_angkatan = $sql_angkatan->fetch_assoc())
                                    {?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $data_angkatan['angkatan'] ?>"><?php echo $nama_prodi ?> Angkatan : <?php echo $data_angkatan['angkatan'] ?></a>
                                                </h5>
                                            </div>
                                            <div id="<?php echo $data_angkatan['angkatan'] ?>" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Hari</th>
                                                                    <th>Jam</th>
                                                                    <th>Kelas</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th>SKS</th>
                                                                    <th>Dosen</th>
                                                                    <th>Ruangan</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no = 1;
                                                                $sql_data_jadwal = $koneksi->query("SELECT * FROM tb_jadwal INNER JOIN tb_makul ON tb_makul.id_makul=tb_jadwal.id_makul INNER JOIN tb_ruangan ON tb_ruangan.id_ruangan=tb_jadwal.id_ruangan INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_jadwal.id_kelas INNER JOIN tb_dosen ON tb_dosen.id_dosen=tb_jadwal.id_dosen WHERE tb_kelas.id_prodi = '$id_prodi' AND tb_kelas.angkatan = '".$data_angkatan['angkatan']."' ORDER BY hari DESC");
                                                                while($data_jadwal = $sql_data_jadwal->fetch_assoc()){
                                                                    $id_jadwal = $data_jadwal['id_jadwal'];
                                                                    $id[] = $id_jadwal;
                                                                ?>
                                                                <tr class="gradeX">
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $data_jadwal['hari'] ?></td>
                                                                    <td><?php echo $data_jadwal['waktu_mulai'] ?> - <?php echo $data_jadwal['waktu_selesai'] ?></td>
                                                                    <td><?php echo $data_jadwal['nama_kelas'] ?> / (<?php echo $data_jadwal['angkatan'] ?>)</td>
                                                                    <td><?php echo $data_jadwal['nama_makul'] ?></td>
                                                                    <td><?php echo $data_jadwal['sks'] ?> SKS</td>
                                                                    <td><?php echo $data_jadwal['nama_dosen'] ?></td>
                                                                    <td><?php echo $data_jadwal['nama_ruangan'] ?></td>
                                                                    
                                                                    <td class="center">
                                                                        <a href="laporan.php?id_jadwal=<?php echo $id_jadwal; ?>" class="btn btn-primary "><i class="fa fa-calendar"> </i> Laporan Absen</a>
                                                                        <a href="anggota_kelas.php?id_jadwal=<?php echo $id_jadwal; ?>&id_makul=<?php echo $data_jadwal['id_makul'] ?>" class="btn btn-success "><i class="fa fa-users"> </i> Anggota Kelas</a>
                                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#<?php echo $id_jadwal ?>">
                                                                            <i class="fa fa-edit"> </i>
                                                                            Edit Jadwal
                                                                        </button>
                                                                        <button class="btn btn-danger hapus<?php echo $id_jadwal ?>"><i class="fa fa-trash"> </i> Hapus</button>
                                                                        <div class="modal inmodal" id="<?php echo $id_jadwal ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content animated rollIn">
                                                                                    <div class="modal-header">
                                                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                                        <i class="fa fa-edit modal-icon"></i>
                                                                                        <h5 class="modal-title">Edit Jadwal Kuliah</h5>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="ibox ">
                                                                                            <div class="ibox-content">
                                                                                                <form action="../../aksi/edit_jadwal.php" method="POST">
                                                                                                    <input type="text" hidden value="<?php echo $id_jadwal ?>" name="id_jadwal">
                                                                                                    <input type="text" name="prodi" hidden value = "<?php echo $id_prodi ?>" class="form-control">
                                                                                                    <div class="form-group row"><label class="col-lg-4 col-form-label">Hari</label>
                                                                                                        <div class="col-lg-8">
                                                                                                            <select class="form-control m-b" name="hari">
                                                                                                                <option <?php if($data_jadwal['hari']==="Senin"){ echo "selected" ; } ?> value="Senin">Senin</option>
                                                                                                                <option <?php if($data_jadwal['hari']==="Selasa"){ echo "selected" ; } ?> value="Selasa">Selasa</option>
                                                                                                                <option <?php if($data_jadwal['hari']==="Rabu"){ echo "selected" ; } ?> value="Rabu">Rabu</option>
                                                                                                                <option <?php if($data_jadwal['hari']==="Kamis"){ echo "selected" ; } ?> value="Kamis">Kamis</option>
                                                                                                                <option <?php if($data_jadwal['hari']==="Jumat"){ echo "selected" ; } ?> value="Jumat">Jum'at</option>
                                                                                                                <option <?php if($data_jadwal['hari']==="Sabtu"){ echo "selected" ; } ?> value="Sabtu">Sabtu</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group row"><label class="col-lg-4 col-form-label">Jam Mulai</label>
                                                                                                        <div class="col-lg-8">
                                                                                                            <input type="time" value = "<?php echo $data_jadwal['waktu_mulai'] ?>" name="jam_mulai" class="form-control">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group row"><label class="col-lg-4 col-form-label">Jam Selesai</label>
                                                                                                        <div class="col-lg-8">
                                                                                                            <input type="time" value = "<?php echo $data_jadwal['waktu_selesai'] ?>" name="jam_selesai" class="form-control">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group row"><label class="col-lg-4 col-form-label">Kelas</label>
                                                                                                        <div class="col-lg-8">
                                                                                                            <select class="form-control m-b" name="kelas">
                                                                                                            <?php
                                                                                                            $kelas = $data_jadwal['id_kelas'];
                                                                                                            $sql_kelas = $koneksi->query("SELECT * FROM tb_kelas WHERE id_prodi = '$id_prodi' ORDER BY nama_kelas ASC");
                                                                                                            while($data_kelas=$sql_kelas->fetch_assoc()){
                                                                                                            if($kelas===$data_kelas['id_kelas']){
                                                                                                                $k = "selected";
                                                                                                            }else{
                                                                                                                $k = "";
                                                                                                            }
                                                                                                            ?>
                                                                                                                <option <?php echo $k ?> value="<?php echo $data_kelas['id_kelas'] ?>"><?php echo $data_kelas['nama_kelas'] ?></option>
                                                                                                            <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group row"><label class="col-lg-4 col-form-label">Ruangan</label>
                                                                                                        <div class="col-lg-8">
                                                                                                            <select class="form-control m-b" name="ruangan">
                                                                                                                <?php
                                                                                                                $id_ruangan = $data_jadwal['id_ruangan'];
                                                                                                                $sql_ruangan = $koneksi->query("SELECT * FROM tb_ruangan WHERE id_fakultas = '$id_fakultas'");
                                                                                                                while($ruangan = $sql_ruangan->fetch_assoc()){
                                                                                                                if($id_ruangan===$ruangan['id_ruangan']){
                                                                                                                    $keterangan = "selected";
                                                                                                                }else{
                                                                                                                    $keterangan = "";
                                                                                                                }
                                                                                                                ?>
                                                                                                                    <option <?php echo $keterangan ?> value="<?php echo $ruangan['id_ruangan'] ?>"><?php echo $ruangan['nama_ruangan'] ?></option>
                                                                                                                <?php
                                                                                                                }
                                                                                                                ?>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group row"><label class="col-lg-4 col-form-label">Mata Kuliah</label>
                                                                                                        <div class="col-lg-8">
                                                                                                            <select name = "makul" data-placeholder="Choose a Country..." class="chosen-select"  tabindex="2">
                                                                                                                <?php
                                                                                                                $id_mata_kuliah = $data_jadwal['id_makul'];
                                                                                                                $sql_makul = $koneksi->query("SELECT * FROM tb_makul INNER JOIN  tb_prodi ON tb_prodi.id_prodi=tb_makul.id_prodi WHERE tb_prodi.id_prodi = '$id_prodi' ORDER BY tb_makul.nama_makul");
                                                                                                                while($makul = $sql_makul->fetch_assoc()){
                                                                                                                if($id_mata_kuliah===$makul['id_makul']){
                                                                                                                    $ket = "selected";
                                                                                                                }else{
                                                                                                                    $ket = "";
                                                                                                                }
                                                                                                                ?>
                                                                                                                    <option <?php echo $ket ?> value="<?php echo $makul['id_makul'] ?>"><?php echo $makul['nama_makul'] ?> ( <?php echo $makul['nama_prodi'] ?> )</option>
                                                                                                                <?php
                                                                                                                }
                                                                                                                ?>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group row"><label class="col-lg-4 col-form-label">Nama Dosen</label>
                                                                                                        <div class="col-lg-8">
                                                                                                            <select class="form-control m-b" name="id_dosen">
                                                                                                                <option value="">Pilih Dosen :...</option>
                                                                                                            <?php
                                                                                                            $sql_dosen = $koneksi->query("SELECT * FROM tb_dosen WHERE id_prodi = '$id_prodi' ORDER BY nama_dosen ASC");
                                                                                                            while($data_dosen=$sql_dosen->fetch_assoc()){
                                                                                                                if($data_jadwal['id_dosen']===$data_dosen['id_dosen']){
                                                                                                                    $ket1 = "selected";
                                                                                                                }else{
                                                                                                                    $ket1 = "";
                                                                                                                }
                                                                                                            ?>
                                                                                                                <option <?php echo $ket1 ?> value="<?php echo $data_dosen['id_dosen'] ?>"><?php echo $data_dosen['nama_dosen'] ?></option>
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
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Hari</th>
                                                                    <th>Jam</th>
                                                                    <th>Kelas</th>
                                                                    <th>Nama Mata Kuliah</th>
                                                                    <th>SKS</th>
                                                                    <th>Dosen</th>
                                                                    <th>Ruangan</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    <?php }
                                    ?>
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
                        window.location.href = "../../aksi/hapus_jadwal.php?id_jadwal=<?php echo $id[$x] ?>&id_prodi=<?php echo $id_prodi ?>";
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
