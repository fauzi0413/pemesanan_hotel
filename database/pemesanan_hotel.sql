-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2022 at 03:32 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemesanan_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_hotel`
--

CREATE TABLE `fasilitas_hotel` (
  `id` int(11) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kamar`
--

CREATE TABLE `fasilitas_kamar` (
  `id` int(11) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas_kamar`
--

INSERT INTO `fasilitas_kamar` (`id`, `tipe_kamar`, `nama_fasilitas`) VALUES
(1, 'Deluxe', 'TV 80 inch'),
(2, 'Deluxe', 'Coffee Maker'),
(3, 'Class', 'TV 24 inch'),
(4, 'Family', 'TV 54 inch'),
(5, 'Deluxe', 'Kamar berukuran luas 45 m2'),
(6, 'Deluxe', 'Kamar mandi shower dan Bath Tub'),
(7, 'Deluxe', 'Sofa'),
(8, 'Deluxe', 'AC'),
(9, 'Superior', 'Kamar berukuran luas 32 m2'),
(10, 'Superior', 'Kamar mandi shower'),
(11, 'Superior', 'Coffee Maker'),
(12, 'Superior', 'AC'),
(13, 'Superior', 'TV 40 inch');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` int(11) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `jumlah_kamar` varchar(100) NOT NULL,
  `kamar_tersedia` varchar(100) NOT NULL,
  `banner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `tipe_kamar`, `jumlah_kamar`, `kamar_tersedia`, `banner`) VALUES
(1, 'Deluxe', '100', '66', 'kamar_deluxe.jpg'),
(3, 'Superior', '120', '96', 'kamar_superior.jpg'),
(7, 'Class', '10', '5', 'kamar_deluxe.jpg'),
(8, 'Family', '15', '13', 'kamar_deluxe.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_pemesanan` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_tamu` varchar(100) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `tgl_cekin` date NOT NULL,
  `tgl_cekout` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_pemesanan`, `username`, `nama_tamu`, `tipe_kamar`, `jumlah`, `tgl_pesan`, `tgl_cekin`, `tgl_cekout`, `status`) VALUES
(1, 'KD00001', 'admin', 'fauzi juga', 'Superior', '2', '2022-02-20', '2022-02-23', '2022-02-28', 'Done'),
(4, 'KD00004', 'admin', 'fauzi juga tapi 2', 'Superior', '2', '2022-02-20', '2022-02-23', '2022-02-28', 'Done'),
(5, 'KD00005', 'admin', 'fauzi', 'Deluxe', '2', '2022-02-20', '2022-02-23', '2022-02-28', 'Done'),
(6, 'KD00006', 'fauzi', 'Fauzi Aditya Pratama', 'Class', '1', '2022-03-03', '2022-03-03', '2022-03-06', 'Cek In'),
(7, 'KD00007', 'raka', 'Raka Putra Atmaja', 'Family', '2', '2022-03-03', '2022-03-04', '2022-03-07', 'Cek In'),
(8, 'KD00008', 'raka', 'Raka Putra Atmaja', 'Class', '2', '2022-03-03', '2022-03-04', '2022-03-04', 'Done'),
(9, 'KD00009', 'raka', 'Fauzi Aditya Pratama', 'Superior', '1', '2022-03-04', '2022-03-07', '2022-03-09', 'Booking'),
(10, 'KD00010', 'raka', 'Fauzi Aditya Pratama', 'Superior', '1', '2022-03-04', '2022-03-07', '2022-03-09', 'Booking'),
(11, 'KD00011', 'raka', 'Raka Putra Atmaja', 'Deluxe', '1', '2022-03-04', '2022-03-07', '2022-03-09', 'Booking'),
(12, 'KD00012', 'raka', 'Sanjaya', 'Deluxe', '2', '2022-03-04', '2022-03-11', '2022-03-14', 'Booking'),
(13, 'KD00013', 'fauzi', 'Gilang Hadi', 'Deluxe', '2', '2022-03-04', '2022-03-07', '2022-03-10', 'Booking'),
(14, 'KD00014', 'fauzi', 'Fauzi Aditya Pratama', 'Family', '2', '2022-03-04', '2022-03-04', '2022-03-04', 'Done'),
(15, 'KD00015', 'fauzi', 'Gilang Pratama', 'Family', '2', '2022-03-04', '2022-03-05', '2022-03-06', 'Booking');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `email`, `no_telpon`, `level`) VALUES
(1, 'admin', 'admin', 'Admin', '', '', 'admin'),
(2, 'resepsionis', 'resepsionis', 'Fauzi Aditya Pratama', '', '', 'resepsionis'),
(3, 'fauzi', 'fauzi', 'Fauzi Aditya Pratama', 'fauzi@gmail.com', '081908279448', 'pemesan'),
(7, 'raka', 'raka', 'Raka Putra', 'raka@gmail.com', '081908279448', 'pemesan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas_hotel`
--
ALTER TABLE `fasilitas_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas_hotel`
--
ALTER TABLE `fasilitas_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
