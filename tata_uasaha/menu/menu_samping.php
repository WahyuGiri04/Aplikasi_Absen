<?php

session_start();

$user = $_SESSION['username'];
$id_user = $_SESSION['id_user'];
$nama_pengguna = $_SESSION['nama_pengguna'];

$kode_fak = $_SESSION['username'];

include_once('../../../koneksi.php');


$sql_fak = $koneksi->query("SELECT * FROM tb_fakultas WHERE kode_fakultas='$kode_fak'");
$data_fak = $sql_fak->fetch_assoc();
$id_fak = $data_fak['id_fakultas'];

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
                        <span class="block m-t-xs font-bold"><?php echo $nama_pengguna ?></span>
                        <span class="text-muted text-xs block">Detail <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="../setting/setting.php">Ubah Password</a></li>
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
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Data Dosen </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="../dosen/dosen.php?prodi=&id_fak=<?php echo $id_fak ?>"><i class="fa fa-users"></i> Semua Data</a></li>
                    <?php
                        include_once('../../../koneksi.php');
                        $sql_data_prodi = $koneksi->query("SELECT * FROM tb_prodi WHERE id_fakultas='$id_fak' ORDER BY nama_prodi ASC");
                        while($data_prodi=$sql_data_prodi->fetch_assoc()){
                            $id_prodi = $data_prodi['id_prodi'];
                        ?>
                            <li><a href="../dosen/dosen.php?prodi=<?php echo $id_prodi ?>&id_fak=<?php echo $id_fak ?>"><i class="fa fa-user"></i> <?php echo $data_prodi['nama_prodi'] ?></a></li>
                        <?php    
                        }
                    ?>
                </ul>
            </li>
            <li>
                <a href=""><i class="fa fa-file"></i> <span class="nav-label">Mata Kuliah</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="../mata_kuliah/mata_kuliah.php?prodi=&id_fak=<?php echo $id_fak ?>"><i class="fa fa-users"></i> Semua Data</a></li>
                    <?php
                        include_once('../../../koneksi.php');
                        $sql_data_prodi = $koneksi->query("SELECT * FROM tb_prodi WHERE id_fakultas='$id_fak' ORDER BY nama_prodi ASC");
                        while($data_prodi=$sql_data_prodi->fetch_assoc()){
                            $id_prodi = $data_prodi['id_prodi'];
                        ?>
                            <li><a href="../mata_kuliah/mata_kuliah.php?prodi=<?php echo $id_prodi ?>&id_fak=<?php echo $id_fak ?>"><i class="fa fa-user"></i> <?php echo $data_prodi['nama_prodi'] ?></a></li>
                        <?php    
                        }
                    ?>
                </ul>
            </li>
            <li>
                <a href="../kelas/kelas.php"><i class="fa fa-server"></i> <span class="nav-label">Kelas</span></a>
            </li>
            <li>
                <a href="../ruangan/ruangan.php"><i class="fa fa-server"></i> <span class="nav-label">Ruangan</span></a>
            </li>
            <li>
                <a href="../mahasiswa/filter_mahasiswa.php?id_fak=<?php echo $id_fak ?>"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Data Mahasiswa</span></a>
            </li>
            <li>
                <a href="../jadwal/jadwal.php"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Data Jadwal</span></a>
            </li>
        </ul>
    </div>
</nav>