<?php

session_start();

$user = $_SESSION['username'];
$id_user = $_SESSION['id_user'];
$nama_pengguna = $_SESSION['nama_pengguna'];

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
                        <span class="block m-t-xs font-bold"><?php echo strtoupper($nama_pengguna); ?></span>
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
                <a href="../absen/absen.php"><i class="fa fa-camera"></i> <span class="nav-label">Absen</span></a>
            </li>
            <li>
                <a href="../hasil_absen/absensi.php"><i class="fa fa-database"></i> <span class="nav-label">Hasil Absensi</span></a>
            </li>
        </ul>
    </div>
</nav>