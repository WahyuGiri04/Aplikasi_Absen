<?php

session_start();

$user = $_SESSION['username'];
$id_user = $_SESSION['id_user'];

if($user==NULL){
    header("location: ../../index.php");
}

?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="../../../template/img/profile_small.jpg"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold"><?php echo strtoupper($user); ?></span>
                        <span class="text-muted text-xs block">Detail <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="../setting/setting.php">Setting</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../../logout.php">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="../home/home.php"><i class="fa fa-home"></i> <span class="nav-label">Halaman Utama</span></a>
            </li>
            <li>
                <a href="../fakultas/fakultas.php"><i class="fa fa-file"></i> <span class="nav-label">Data Fakultas & Prodi</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Data Dosen</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="../dosen/dosen.php?id_prodi=&id_fak=">Semua Dosen</a></li>
                    <?php
                    include_once('../../../koneksi.php');
                    $fak = $koneksi->query("SELECT * FROM tb_fakultas");
                    while($data_fak=$fak->fetch_assoc()){
                        $id_fakultas = $data_fak['id_fakultas'];
                        ?>
                        <li>
                            <a href="#" id="damian"><?php echo $data_fak['nama_fakultas'] ?> <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li><a href="../dosen/dosen.php?id_prodi=&id_fak=<?php echo $id_fakultas ?>">Semua Dosen</a></li>
                                <?php 
                                $prodi = $koneksi->query("SELECT * FROM tb_prodi WHERE id_fakultas = '$id_fakultas'");
                                while($data_prodi = $prodi->fetch_assoc()){
                                    $nama_prodi = $data_prodi['nama_prodi'];
                                    $id_prodi = $data_prodi['id_prodi'];
                                ?>
                                    <li>
                                        <a href="../dosen/dosen.php?id_prodi=<?php echo $id_prodi ?>&id_fak=<?php echo $id_fakultas ?>"><?php echo $nama_prodi ?></a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Data Pengguna</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="../pengguna/dosen.php">Dosen</a></li>
                    <li><a href="../pengguna/mahasiswa.php">Mahasiswa</a></li>
                    <li><a href="../pengguna/fakultas.php">Fakultas</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>