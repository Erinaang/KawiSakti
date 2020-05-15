-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2020 at 09:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kawi`
--

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_penyewa` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `total` int(16) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_pemesanan` datetime DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `masa_sewa` int(11) NOT NULL,
  `jumlah_set` int(11) NOT NULL,
  `frame` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `masa_sewa`, `jumlah_set`, `frame`, `harga`) VALUES
(1, 30, 50, 'MF-170', 40000),
(2, 30, 50, 'MF-190', 44000),
(3, 30, 50, 'LF-90', 40000),
(4, 21, 50, 'MF-170', 35200),
(5, 21, 50, 'MF-190', 39600),
(6, 21, 50, 'LF-90', 31400),
(7, 15, 50, 'MF-170', 31400),
(8, 15, 50, 'MF-190', 35800),
(9, 15, 50, 'T-190', 31400),
(10, 7, 50, 'MF-170', 28400),
(11, 7, 50, 'MF-190', 31800),
(12, 7, 50, 'T-190', 28400),
(13, 30, 26, 'MF-170', 46600),
(14, 30, 26, 'MF-190', 51600),
(15, 30, 26, 'LF-90', 46600),
(16, 21, 26, 'MF-170', 43200),
(17, 21, 26, 'MF-190', 48800),
(18, 21, 26, 'LF-90', 43200),
(19, 15, 26, 'MF-170', 38000),
(20, 15, 26, 'MF-190', 42400),
(21, 15, 26, 'LF-90', 38000),
(22, 7, 26, 'MF-170', 34400),
(23, 7, 26, 'MF-190', 38600),
(24, 7, 26, 'LF-90', 38000),
(25, 30, 11, 'MF-170', 55000),
(26, 30, 11, 'MF-190', 61400),
(27, 30, 11, 'LF-90', 55000),
(28, 21, 11, 'MF-170', 50800),
(29, 21, 11, 'MF-190', 56400),
(30, 21, 11, 'LF-90', 50800),
(31, 15, 11, 'MF-170', 56200),
(32, 15, 11, 'MF-190', 51200),
(33, 15, 11, 'LF-90', 46200),
(34, 7, 11, 'MF-170', 41800),
(35, 7, 11, 'MF-190', 46400),
(36, 7, 11, 'LF-90', 41800),
(37, 30, 3, 'MF-170', 60600),
(38, 30, 3, 'MF-190', 67800),
(39, 30, 3, 'LF-90', 60600),
(40, 21, 3, 'MF-170', 56400),
(41, 21, 3, 'MF-190', 61200),
(42, 21, 3, 'LF-90', 56400),
(43, 15, 3, 'MF-170', 50800),
(44, 15, 3, 'MF-190', 56400),
(45, 15, 3, 'LF-90', 50800),
(46, 7, 3, 'MF-170', 45800),
(47, 7, 3, 'MF-190', 50800),
(48, 7, 3, 'LF-90', 45800),
(49, 30, 1, 'MF-170', 68000),
(50, 30, 1, 'MF-190', 75600),
(51, 30, 1, 'LF-90', 68000),
(52, 21, 1, 'MF-170', 60200),
(53, 21, 1, 'MF-190', 67000),
(54, 21, 1, 'LF-90', 60200),
(55, 15, 1, 'MF-170', 51800),
(57, 15, 1, 'MF-190', 58000),
(58, 15, 1, 'LF-90', 51800),
(59, 7, 1, 'MF-170', 48400),
(61, 7, 1, 'MF-190', 49800),
(62, 7, 1, 'LF-90', 48400);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `biaya` int(20) NOT NULL,
  `max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `nama`, `biaya`, `max`) VALUES
(1, 'Pickup', 500000, 100),
(2, 'Truck Kecil', 700000, 500),
(3, 'Truck Bes', 1000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) NOT NULL,
  `id_penyewa` int(10) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `jaminan` int(11) NOT NULL,
  `id_pengiriman` int(11) NOT NULL,
  `bukti_pembayaran` varchar(50) NOT NULL,
  `bukti_ktp` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `jam_pemesanan` datetime DEFAULT NULL,
  `tgl_sewa` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` varchar(100) DEFAULT 'p.png',
  `no_telp` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `status`, `nama`, `foto`, `no_telp`, `alamat`) VALUES
(6, 'erina', '827ccb0eea8a706c4c34a16891f84e7b', 'erinaangg@gmail.com', 'penyewa', 'erina1', 'p.png', '08765342537', 'jl sapu sapu'),
(7, 'kiki1', '827ccb0eea8a706c4c34a16891f84e7b', 'kikirabdullah@gmail.com', 'admin', 'kiki', 'p.png', '08653425362', 'jl in aja dulu ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
