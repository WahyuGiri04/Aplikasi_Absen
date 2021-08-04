<!DOCTYPE html>
<html>

<?php
session_start();
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include ('title.php');
    ?>

    <link href="../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../template/css/animate.css" rel="stylesheet">
    <link href="../template/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="ibox-content">
            <div class="row">
                <div class="col-md-6">
                    <h2 align = "center" class="font-bold">Welcome to APP Absensi Mahasiswa</h2>

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" height="250px" src="../gambar/absen.png" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Aplikasi Absensi Mahasiswa</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" height="250px" src="../gambar/absen_2.jpg" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Aplikasi Absensi Mahasiswa</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" height="250px" src="../gambar/absen_3.png" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Aplikasi Absensi Mahasiswa</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ibox-content">
                        <h3 align = "center" class="font-bold">Login Dosen</h3>
                        <form class="m-t" role="form" method="post" action="login.php">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username / NIP" required="">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required="">
                            </div>
                            <button type="submit" class="btn btn-primary block full-width m-b"><i class="fa fa-paper-plane" ></i>  Login</button>
                            
                            <p class="text-muted text-center">
                                <small>Belum punya akun ?</small>
                            </p>
                            <a class="btn btn-sm btn-white btn-block" href="register.php"><i class="fa fa-sign-out" ></i> Register</a>
                        </form>
                        <p class="m-t">
                            <small>Copyright Aplikasi Absensi V.0.1 &copy; 2021</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../template/js/jquery-3.1.1.min.js"></script>
    <script src="../template/js/popper.min.js"></script>
    <script src="../template/js/bootstrap.js"></script>
    <script src="../template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../template/js/inspinia.js"></script>
    <script src="../template/js/plugins/pace/pace.min.js"></script>

</body>

</html>
