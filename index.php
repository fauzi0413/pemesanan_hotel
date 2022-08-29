<?php
session_start();
error_reporting(0);

$title = 'Beranda';
require './koneksi.php';

if (isset($_SESSION['pemesan'])) {
    $user = $_SESSION['pemesan'];
} elseif (!isset($_SESSION['pemesan'])) {
    if (isset($_SESSION['admin'])) {
        header('location:./admin/index.php');
    } elseif (isset($_SESSION['resepsionis'])) {
        header('location:./resepsionis/index.php');
    }
}


if ($user == "") {
    $user == "";
}

if (isset($_POST['btn_pesan'])) {
    $_SESSION['user'] = $user;
    $_SESSION['tgl_cekin'] = $_POST['cek_in'];
    $_SESSION['tgl_cekout'] = $_POST['cek_out'];
    $_SESSION['jumlah'] = $_POST['jumlah'];

    $today = date('Y-m-d');
    // CEK TANGGAL CEK IN DAN CEK OUT
    if ($_SESSION['tgl_cekin'] < $_SESSION['tgl_cekout']) {
        if (($_SESSION['tgl_cekin'] >= $today) and ($_SESSION['tgl_cekout'] > $today)) {
            header('location:./pemesan/pesanan.php');
        } else {
            echo "
            <script>
                alert('Tanggal Cek In tidak boleh kurang dari tanggal hari ini, Silahkah periksa kembali pesanan anda !!');
            </script>";
        }
    } else {
        echo "
    <script>
        alert('Tanggal Cek Out tidak boleh sama atau kurang dari tanggal Cek In, Silahkah periksa kembali pesanan anda !!');
    </script>";
    }
}

if (isset($_POST['btn_cek'])) {
    echo "
    <script>
        alert('Anda belum memasukkan akun, silahkan masuk terlebih dahulu');
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head><meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<title>Hotel Hebat | <?= $title ?></title>

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
                                <a class="nav-link" href="./index.php" id="userDropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 active"><i class="fas fa-home"></i> Beranda</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./kamar.php" id="userDropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600"><i class="fas fa-bed"></i> Kamar</span>
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
                        <?php
                        if ($user == "") {
                        ?>
                            <form action="" method="post" class="pb-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <label for="">Tanggal Cek In</label>
                                        <input type="date" class="form-control" name="cek_in">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Tanggal Cek Out</label>
                                        <input type="date" class="form-control" name="cek_out">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Jumlah Kamar</label>
                                        <input type="number" class="form-control" name="jumlah" placeholder="0" min="0">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="submit" class="btn btn-primary" style="margin-top: 32px;" name="btn_cek" value="Pesan">
                                    </div>
                                </div>
                            </form>
                        <?php
                        } elseif ($user != "") {
                        ?>
                            <form action="" method="post" class="pb-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <label for="">Tanggal Cek In</label>
                                        <input type="date" class="form-control" name="cek_in" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Tanggal Cek Out</label>
                                        <input type="date" class="form-control" name="cek_out" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Jumlah Kamar</label>
                                        <input type="number" class="form-control" name="jumlah" placeholder="0" min="0" required>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="submit" class="btn btn-primary" style="margin-top: 32px;" name="btn_pesan" value="Pesan">
                                    </div>
                                </div>
                            </form>
                        <?php
                        }
                        ?>

                        <h1 class="text-center p-1 text-dark" style="font-weight: bold;">Tentang Kami</h1>

                        <span>Lepaskan diri Anda ke Hotel Hebat, dikelilingi oleh keindahan pegunugan yang indah, dana, dan sawah menghijau. Nikmati sore yang hangat dengan berenang di kolam renang dengan pemandangan matahari terbenam yang memukau; Kid's Club yang luas - menawarkan beragam fasilitas dan kegiatan anak-anak yang akan melengkapi kenyamanan keluarga. Convention Center kami, dilengkapi pelayanan lengkap dengan ruang konvensi terbesar di Bandung mampu mengakomodasi hingga 3.000 delegasi. Manfaatkan ruang penyelenggaraan konvensi M.I.C.E ataupun mewujudkan acara pernikahan adat yang mewah</span>
                    </div>

                    <hr>

                    <h1 class="text-center p-3 pb-5 text-dark" style="font-weight: bold;">Tipe Kamar</h1>

                    <!-- Begin Page Content -->
                    <div class="container-fluid" style="min-height: 450px;">
                        <div class="row">
                            <?php
                            $sql_kamar = mysqli_query($conn, "SELECT * FROM kamar");
                            $data_kamar = mysqli_fetch_assoc($sql_kamar);
                            ?>
                            <!-- BANNER -->
                            <img src="./img/kamar_superior.jpg" alt="banner" class="d-block w-100 col-md-8" style="height: 400px;">

                            <div class="container-fluid py-3 col-md-4">
                                <h1 class="p-1 text-dark" style="font-weight: bold;">Tipe <?= $data_kamar['tipe_kamar'] ?></h1>

                                <span>Fasilitas :</span>
                                <br>
                                <?php
                                $sql_fasilitas_kamar = mysqli_query($conn, "SELECT * FROM fasilitas_kamar WHERE tipe_kamar = '$data_kamar[tipe_kamar]' ORDER BY nama_fasilitas ASC ");
                                while ($fasilitas_kamar = mysqli_fetch_assoc($sql_fasilitas_kamar)) {
                                ?>
                                    <span><?= $fasilitas_kamar['nama_fasilitas'] ?></span>
                                    <br>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="col-md-12 pt-4">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <a href="./kamar.php" class="btn btn-primary w-100 text-center" style="font-weight: bold;">More <i class="fas fa-arrow-right ml-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                    <!-- Fasilitas -->
                    <div class="container-fluid py-3">
                        <h1 class="text-center p-1 text-dark" style="font-weight: bold;">Fasilitas</h1>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <a href="">
                                    <div class="card shadow">
                                        <img src="./img/lobby.jpg" alt="" style="min-height: 200px;max-height: 200px; height: max-content;">
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-4">
                                <a href="">
                                    <div class="card shadow">
                                        <img src="./img/kolam.jpg" alt="" style="min-height: 200px;max-height: 200px; height: max-content;">
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 mb-4">
                                <a href="">
                                    <div class="card shadow">
                                        <img src="./img/gym.jpg" alt="" style="min-height: 200px;max-height: 200px; height: max-content;">
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <a href="./fasilitas.php" class="btn btn-primary w-100 text-center" style="font-weight: bold;">More <i class="fas fa-arrow-right ml-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="./logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php
    include './layouts/js.php';
    ?>

</body>

</html>