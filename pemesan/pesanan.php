<?php
session_start();
// error_reporting(0);

$title = 'Pemesanan';

require '../koneksi.php';

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

require '../function.php';

if (isset($_POST['btn_konfirmasi'])) {
    if (konfirmasi_pesanan($_POST) > 0) {
        header('location:./riwayat.php');
    }
}

if (isset($_POST['btn_pesan'])) {
    $tgl_cekin = $_POST['cek_in'];
    $tgl_cekout = $_POST['cek_out'];

    $today = date('Y-m-d');
    // CEK TANGGAL CEK IN DAN CEK OUT
    if ($tgl_cekin < $tgl_cekout) {
        if (($tgl_cekin >= $today) and ($tgl_cekout > $today)) {
            $_SESSION['tgl_cekin'] = $_POST['cek_in'];
            $_SESSION['tgl_cekout'] = $_POST['cek_out'];
            $_SESSION['user'] = $user;
            $_SESSION['jumlah'] = $_POST['jumlah'];
            header('location:./pesanan.php');
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './heading.php'; ?>
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
                                <a class="nav-link" href="../index.php" id="userDropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600"><i class="fas fa-home"></i> Beranda</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="../kamar.php" id="userDropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600"><i class="fas fa-bed"></i> Kamar</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="../fasilitas.php" id="userDropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-sm-none d-lg-inline text-gray-600"><i class="fas fa-building"></i> Fasilitas</span>
                                </a>
                            </li>

                            <div class="topbar-divider d-none d-lg-block"></div>

                            <?php
                            if ($user == "") {
                            ?>
                                <li class="nav-item my-auto">
                                    <a href="./daftar.php" class="btn">Daftar</a>
                                    <a href="./login.php" class="btn btn-success">Masuk</a>
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
                                        <img class="img-profile rounded-circle d-none d-lg-inline" src="../layout/img/undraw_profile.svg">
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
                                        <a class="dropdown-item" href="../riwayat.php">
                                            <i class="fas fa-history fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Riwayat Pemesanan
                                        </a>

                                        <div class="dropdown-divider d-md-none"></div>

                                        <a class="dropdown-item d-md-none" href="../index.php">
                                            <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Beranda
                                        </a>
                                        <a class="dropdown-item d-md-none" href="../kamar.php">
                                            <i class="fas fa-bed fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Kamar
                                        </a>
                                        <a class="dropdown-item d-md-none" href="../fasilitas.php">
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
                    <img src="../img/banner.jpg" alt="banner" class="d-block w-100" style="height: 400px;">

                    <div class="container-fluid py-3">
                        <form action="" method="post" class="pb-5">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <label for="">Tanggal Cek In</label>
                                    <input type="date" class="form-control" name="cek_in" value="<?= $_SESSION['tgl_cekin'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tanggal Cek Out</label>
                                    <input type="date" class="form-control" name="cek_out" value="<?= $_SESSION['tgl_cekout'] ?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Jumlah Kamar</label>
                                    <input type="number" class="form-control" name="jumlah" placeholder="0" min="0" value="<?= $_SESSION['jumlah'] ?>" required>
                                </div>
                                <div class="col-md-1">
                                    <input type="submit" class="btn btn-primary" style="margin-top: 32px;" name="btn_pesan" value="Pesan">
                                </div>
                            </div>
                        </form>

                        <h1 class="p-1 text-dark" style="font-weight: bold;">Form Pemesanan</h1>

                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user' ");
                        $data = mysqli_fetch_assoc($sql);
                        ?>

                        <form action="" method="post" class="container">
                            <div class="row">
                                <input type="hidden" name="tgl_cekin" value="<?= $_SESSION['tgl_cekin'] ?>">
                                <input type="hidden" name="tgl_cekout" value="<?= $_SESSION['tgl_cekout'] ?>">
                                <input type="hidden" name="jumlah" value="<?= $_SESSION['jumlah'] ?>">

                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span class="h4">Nama Pemesan</span>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="nama_pemesan" value="<?= $data['nama'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span class="h4">Email Pemesan</span>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span class="h4">No Handphone Pemesan</span>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="no_hp" value="<?= $data['no_telpon'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span class="h4">Nama Tamu</span>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="nama_tamu" placeholder="Masukkan nama tamu" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span class="h4">Tipe Kamar</span>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="tipe_kamar" class="form-control">
                                                <?php
                                                $sql_kamar = mysqli_query($conn, "SELECT * FROM kamar WHERE kamar_tersedia >= $_SESSION[jumlah] ORDER BY tipe_kamar ASC");
                                                while ($kamar = mysqli_fetch_assoc($sql_kamar)) {
                                                ?>
                                                    <option value="<?= $kamar['tipe_kamar'] ?>"><?= $kamar['tipe_kamar'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center my-3">
                                    <input type="submit" name="btn_konfirmasi" class="btn btn-primary w-50" value="Konfirmasi Pemesanan">
                                </div>

                            </div>
                        </form>
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
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php
    include './js.php';
    ?>

</body>

</html>