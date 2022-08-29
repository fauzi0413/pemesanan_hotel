<?php
session_start();
// error_reporting(0);

$title = 'Cetak Bukti Pemesanan';
require './koneksi.php';

$id = 'KD00006';
// $id = '6';
$sql = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id_pemesanan = '$id' ");
$data = mysqli_fetch_assoc($sql);

$sql_user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$data[username]' ");
$data_user = mysqli_fetch_assoc($sql_user);


// 
// PROSES PDF MENGGUNAKAN FPDF 1.81
// 
require './fpdf181/fpdf.php';
$pdf = new FPDF('l', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16); // 'Jenis Font','B/I/U','Ukuran Font'

// URUTAN : 
// 'Width','height','Apa yang mau di ketik', border, new line, 'text align'
$pdf->Cell(40, 20, 'Logo', 0, 0, 'C');
$pdf->Cell(100, 20, 'HOTEL HEBAT', 0, 1, 'C');

$pdf->Line(10, 30, 500, 30);
$pdf->Ln(20);

$pdf->Cell(100, 20, 'Bukti pemesanan', 0, 1, 'C');
$pdf->Ln(20);

// ISI DARI PDF NANTI
while ($data) {
    $pdf->Cell(20, 20, 'Nama Pemesan : ', 1, 0, 'C');
    $pdf->Cell(20, 20, $data_user['nama'], 1, 1, 'C');

    // $pdf->Cell()
}

$titlePDF = $title . '_' . $data['id_pemesanan'] . '.PDF';
$pdf->Output('D', $titlePDF, true);
