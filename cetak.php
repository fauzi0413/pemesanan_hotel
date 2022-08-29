<?php
session_start();

$title = 'Cetak Bukti Pemesanan';
require './koneksi.php';

// CEK DATA PEMESANAN
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id_pemesanan = '$id' ");
$data = mysqli_fetch_assoc($sql);

$sql_user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$data[username]' ");
$data_user = mysqli_fetch_assoc($sql_user);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include './layouts/heading.php';
    ?>
</head>

<body>
    <div class="container p-5">
        <h1 class="text-center" style="margin-bottom: 10px;border-bottom: 2px solid #000;">Bukti Pemesanan</h1>

        <form action="" method="post" class="container mt-5">
            <div class="row">

                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <span class="h4">Nama Pemesan</span>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama_pemesan" placeholder="Masukkan nama pemesan" value="<?= $data_user['nama'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <span class="h4">Nama Tamu</span>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama_tamu" placeholder="Masukkan nama tamu" value="<?= $data['nama_tamu'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <span class="h4">Email Pemesan</span>
                        </div>
                        <div class="col-md-9">
                            <input type="email" class="form-control" name="email" placeholder="Masukkan email pemesan" value="<?= $data_user['email'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <span class="h4">No Handphone Pemesan</span>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="no_hp" placeholder="Masukkan no handphone pemesan" value="<?= $data_user['no_telpon'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="">Tipe Kamar</h4>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama_tamu" placeholder="Masukkan nama tamu" value="<?= $data['tipe_kamar'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="">Jumlah Kamar</h4>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama_tamu" placeholder="Masukkan nama tamu" value="<?= $data['jumlah'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="">Tanggal Cek In</h4>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama_tamu" placeholder="Masukkan nama tamu" value="<?= $data['tgl_cekin'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="">Tanggal Cek Out</h4>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nama_tamu" placeholder="Masukkan nama tamu" value="<?= $data['tgl_cekout'] ?>" required>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>

    <?php
    include './layouts/js.php';
    ?>
    <script>
        window.print()
    </script>
</body>

</html>