<?php
require './koneksi.php';
// error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Hebat | Room</title>

    <!-- Logo -->
    <link rel="icon" href="./">

    <!-- Custom fonts for this template-->
    <link href="./layout/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./layout/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./style/main.css">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-none topbar mb-4 static-top shadow">

                    <h2>HOTEL HEBAT</h3>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item">
                                <a class="nav-link" href="./home.php" id="userDropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600"><i class="fas fa-home"></i> Beranda</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./room.php" id="userDropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 active"><i class="fas fa-bed"></i> Kamar</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./fasilitas.php" id="userDropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-sm-none d-lg-inline text-gray-600"><i class="fas fa-building"></i> Fasilitas</span>
                                </a>
                            </li>

                            <div class="topbar-divider d-none d-lg-block"></div>

                            <?php
                            if ($user == "") {
                            ?>
                                <li class="nav-item my-auto d-none d-lg-inline">
                                    <a href="./daftar.php" class="btn">Daftar</a>
                                    <a href="./login.php" class="btn btn-success">Masuk</a>
                                </li>

                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle d-md-none" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn btn-link d-md-none rounded-circle">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                        <div class="dropdown-divider d-md-none"></div>

                                        <a class="dropdown-item d-md-none" href="./index.php">
                                            <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Beranda
                                        </a>
                                        <a class="dropdown-item d-md-none" href="./kamar.php">
                                            <i class="fas fa-bed fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Kamar
                                        </a>
                                        <a class="dropdown-item d-md-none" href="./fasilitas.php">
                                            <i class="fas fa-building fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Fasilitas
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <div class="p-1 d-md-none">
                                            <a class="btn" href="./daftar.php">
                                                Daftar
                                            </a>
                                            <a class="btn btn-success" href="./login.php">
                                                Masuk
                                            </a>
                                        </div>

                                    </div>
                                </li>

                            <?php
                            } elseif ($user != "") {
                                $sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user' ");
                                $data = mysqli_fetch_assoc($sql);
                            ?>

                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600">
                                            <?= $data['username'] ?>
                                        </span>
                                        <img class="img-profile rounded-circle d-none d-lg-inline" src="./layout/img/undraw_profile.svg">
                                        <button class="btn btn-link d-md-none rounded-circle">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item" href="./riwayat.php">
                                            <i class="fas fa-history fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Riwayat Pemesanan
                                        </a>

                                        <div class="dropdown-divider d-md-none"></div>

                                        <a class="dropdown-item d-md-none" href="./index.php">
                                            <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Beranda
                                        </a>
                                        <a class="dropdown-item d-md-none" href="./kamar.php">
                                            <i class="fas fa-bed fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Kamar
                                        </a>
                                        <a class="dropdown-item d-md-none" href="./fasilitas.php">
                                            <i class="fas fa-building fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Fasilitas
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>

                            <?php
                            }
                            ?>

                        </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="min-height: 450px;">

                    <!-- BANNER -->
                    <img src="./img/banner.jpg" alt="banner" class="d-block w-100" style="height: 400px;">

                    <div class="container-fluid py-3">

                        <h1 class="p-1 text-dark" style="font-weight: bold;">Tipe Kamar</h1>

                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM kamar ORDER BY tipe_kamar ASC");
                        while ($data = mysqli_fetch_assoc($sql)) {
                        ?>

                            <!-- Begin Page Content -->
                            <div class="container-fluid py-3">

                                <div class="row">
                                    <!-- BANNER -->
                                    <img src="./img/<?= $data['banner'] ?>" alt="banner" class="d-block w-100 col-md-8" style="height: 400px;">

                                    <div class="container-fluid py-3 col-md-4">
                                        <h1 class="p-1 text-dark" style="font-weight: bold;">Tipe <?= $data['tipe_kamar'] ?></h1>

                                        <span>Fasilitas :</span>
                                        <br>
                                        <?php
                                        $sql_fasilitas = mysqli_query($conn, "SELECT * FROM fasilitas_kamar WHERE tipe_kamar = '$data[tipe_kamar]' ORDER BY nama_fasilitas ASC ");
                                        while ($fasilitas = mysqli_fetch_assoc($sql_fasilitas)) {
                                        ?>
                                            <span><?= $fasilitas['nama_fasilitas'] ?></span>
                                            <br>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <!-- End Page Content -->
                            <hr class="fw-bold">
                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="./layout/vendor/jquery/jquery.min.js"></script>
    <script src="./layout/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./layout/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./layout/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="./layout/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="./layout/js/demo/chart-area-demo.js"></script>
    <script src="./layout/js/demo/chart-pie-demo.js"></script>
</body>

</html>