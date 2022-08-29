<?php
require '../koneksi.php';

function data_kamar()
{
    global $conn;

    $tipe_kamar = $_POST['tipe_kamar'];
    $jumlah_kamar = $_POST['jumlah_kamar'];

    // CEK TIPE KAMAR
    $sql = mysqli_query($conn, "SELECT * FROM kamar WHERE tipe_kamar = '$tipe_kamar' ");
    if (mysqli_fetch_assoc($sql)) {
        echo "
        <script>
            alert('Tipe kamar sudah terdaftar');
        </script>";
    } else {

        // CEK DATA BANNER
        $nama_file = $_FILES['banner']['name'];
        $ukuran_file = $_FILES['banner']['size'];
        $tipe_file = $_FILES['banner']['type']; 
        $tmp_file = $_FILES['banner']['tmp_name'];

        // Set path folder tempat menyimpan gambarnya
        $path = "gambar/" . $nama_file;

        if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") { // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
            // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
            if ($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
                // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
                // Proses upload
                if (move_uploaded_file($tmp_file, $path)) { // Cek apakah gambar berhasil diupload atau tidak
                    // Jika gambar berhasil diupload, Lakukan :	
                    // Proses simpan ke Database
                    $sql = mysqli_query($conn, "INSERT INTO kamar VALUES ('','$tipe_kamar','$jumlah_kamar','$jumlah_kamar','$nama_file') ");

                    if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
                        // Jika Sukses, Lakukan :
                        echo "Data berhasil di tambahkan!";
                        header('location:index.php');
                    } else {
                        // Jika Gagal, Lakukan :
                        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data.";
                    }
                } else {
                    // Jika gambar gagal diupload, Lakukan :
                    echo "Maaf, Gambar gagal untuk diupload.";
                }
            } else {
                // Jika ukuran file lebih dari 1MB, lakukan :
                echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
            }
        } else {
            // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
            echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
        }
        return mysqli_affected_rows($conn);
    }
}

function data_fasilitas_kamar()
{
    global $conn;

    $tipe_kamar = $_POST['tipe_kamar'];
    $fasilitas_kamar = $_POST['fasilitas_kamar'];

    mysqli_query($conn, "INSERT INTO fasilitas_kamar VALUES('','$tipe_kamar','$fasilitas_kamar')");
    return mysqli_affected_rows($conn);
}

function data_fasilitas_hotel()
{
    global $conn;

    $fasilitas_hotel = $_POST['fasilitas_hotel'];
    $keterangan = $_POST['keterangan'];

    // CEK DATA BANNER
    $nama_file = $_FILES['image']['name'];
    $ukuran_file = $_FILES['image']['size'];
    $tipe_file = $_FILES['image']['type'];
    $tmp_file = $_FILES['image']['tmp_name'];

    // Set path folder tempat menyimpan gambarnya
    $path = "gambar/" . $nama_file;

    if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") { // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
        // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
        if ($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
            // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
            // Proses upload
            if (move_uploaded_file($tmp_file, $path)) { // Cek apakah gambar berhasil diupload atau tidak
                // Jika gambar berhasil diupload, Lakukan :	
                // Proses simpan ke Database
                $sql = mysqli_query($conn, "INSERT INTO fasilitas_hotel VALUES ('','$fasilitas_hotel','$keterangan','$nama_file') ");

                if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
                    // Jika Sukses, Lakukan :
                    echo "Data berhasil di tambahkan!";
                    header('location:fasilitas-hotel.php');
                } else {
                    // Jika Gagal, Lakukan :
                    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data.";
                }
            } else {
                // Jika gambar gagal diupload, Lakukan :
                echo "Maaf, Gambar gagal untuk diupload.";
            }
        } else {
            // Jika ukuran file lebih dari 1MB, lakukan :
            echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
        }
    } else {
        // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
        echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
    }
    return mysqli_affected_rows($conn);
}

function konfirmasi_pesanan()
{
    global $conn;

    // MEMBUAT KODE TRANSAKSI OTOMATIS
    $sql = mysqli_query($conn, "SELECT max(id) as maxID FROM pemesanan");
    $data = mysqli_fetch_assoc($sql);

    $kode = $data['maxID'];
    $kode++;
    $ket = "KD";
    $id_pemesanan = $ket . sprintf("%05s", $kode);

    $user = $_SESSION['user'];
    $nama_tamu = $_POST['nama_tamu'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $jumlah = $_POST['jumlah'];

    date_default_timezone_set('Asia/Jakarta');

    $tgl_pesan = date('Y-m-d');

    $tgl_cekin = $_POST['tgl_cekin'];
    $tgl_cekout = $_POST['tgl_cekout'];

    // MENG-UPDATE DATA KAMAR TERSEDIA DI TABEL KAMAR
    $sql = mysqli_query($conn, "SELECT * FROM kamar WHERE tipe_kamar = '$tipe_kamar' ");
    $kamar = mysqli_fetch_assoc($sql);
    $kamar_tersedia = $kamar['kamar_tersedia'] - $jumlah;
    mysqli_query($conn, "UPDATE kamar SET kamar_tersedia = '$kamar_tersedia' WHERE tipe_kamar = '$tipe_kamar' ");

    // MENGECEK STATUS YANG AKAN DI MASUKKAN KE DATA KAMAR
    $today = date('Y-m-d');
    if ($tgl_cekin < $today) {
        $status = 'Booking';
    } elseif ($tgl_cekin >= $today) {
        $status = 'Cek In';
    }

    // MEMASUKKAN DATA KONFIRMASI PESANAN
    mysqli_query($conn, "INSERT INTO pemesanan VALUES('','$id_pemesanan','$user','$nama_tamu','$tipe_kamar','$jumlah','$tgl_pesan','$tgl_cekin','$tgl_cekout','$status') ");
    return mysqli_affected_rows($conn);
}


// 
// FUNCTION UBAH DATA
// 

function ubah_kamar()
{
    global $conn;

    $id = $_POST['id'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $jumlah_kamar = $_POST['jumlah_kamar'];

    $filesize = $_FILES['banner']['size'];

    if ($filesize == 0) {
        mysqli_query($conn, "UPDATE kamar SET tipe_kamar = '$tipe_kamar', jumlah_kamar = '$jumlah_kamar' WHERE id = '$id' ");
    } else {
        // CEK DATA BANNER
        $nama_file = $_FILES['banner']['name'];
        $ukuran_file = $_FILES['banner']['size'];
        $tipe_file = $_FILES['banner']['type'];
        $tmp_file = $_FILES['banner']['tmp_name'];

        // Set path folder tempat menyimpan gambarnya
        $path = "gambar/" . $nama_file;

        if ($tipe_file == "image/jpeg" || $tipe_file == "image/png") { // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
            // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
            if ($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
                // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
                // Proses upload
                if (move_uploaded_file($tmp_file, $path)) { // Cek apakah gambar berhasil diupload atau tidak
                    // Jika gambar berhasil diupload, Lakukan :	
                    // Proses simpan ke Database
                    $sql = mysqli_query($conn, "UPDATE kamar SET tipe_kamar = '$tipe_kamar', jumlah_kamar = '$jumlah_kamar', banner = '$nama_file' WHERE id = '$id' ");

                    if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
                        // Jika Sukses, Lakukan :
                        echo "Data berhasil di tambahkan!";
                        header('location:index.php');
                    } else {
                        // Jika Gagal, Lakukan :
                        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data.";
                    }
                } else {
                    // Jika gambar gagal diupload, Lakukan :
                    echo "Maaf, Gambar gagal untuk diupload.";
                }
            } else {
                // Jika ukuran file lebih dari 1MB, lakukan :
                echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
            }
        } else {
            // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
            echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
        }
    }
    return mysqli_affected_rows($conn);
}

function ubah_fasilitas_kamar()
{
    global $conn;

    $id = $_POST['id'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $fasilitas_kamar = $_POST['fasilitas_kamar'];

    mysqli_query($conn, "UPDATE fasilitas_kamar SET tipe_kamar = '$tipe_kamar', nama_fasilitas = '$fasilitas_kamar' WHERE id = '$id' ");
    return mysqli_affected_rows($conn);
}



//
// FUNCTION HAPUS DATA
// 

function hapus_kamar($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM kamar WHERE id = '$id' ");

    return mysqli_affected_rows($conn);
}

function hapus_fasilitas_kamar($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM fasilitas_kamar WHERE id = '$id' ");

    return mysqli_affected_rows($conn);
}

function hapus_fasilitas_hotel($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM fasilitas_hotel WHERE id = '$id' ");

    return mysqli_affected_rows($conn);
}
