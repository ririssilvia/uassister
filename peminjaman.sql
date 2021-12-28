-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2021 at 07:16 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `IdBarang` varchar(15) NOT NULL,
  `BrgNama` varchar(50) NOT NULL,
  `BrgMerk` varchar(50) NOT NULL,
  `BrgJumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`IdBarang`, `BrgNama`, `BrgMerk`, `BrgJumlah`) VALUES
('03.06.001', 'Headset', 'Xiaomi', 8),
('03.06.002', 'Kabel HDMI', 'Sony High Speed', 3),
('03.06.003', 'Kabel Keler', 'Krisbow', 18),
('03.06.004', 'Kunci Cadangan Gedung', '', 30),
('03.06.005', 'Laptop', 'ASUS', 2),
('03.06.006', 'LCD Proyektor', 'Epson', 14),
('03.06.007', 'Mouse', 'M-tech', 5),
('03.06.008', 'Speaker', 'JBL', 6);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `IdSiswa` varchar(10) NOT NULL,
  `SwNama` varchar(50) NOT NULL,
  `SwKelas` varchar(10) NOT NULL,
  `SwNoHp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`IdSiswa`, `SwNama`, `SwKelas`, `SwNoHp`) VALUES
('SW001', 'Tria', 'X TKJ 1', '081234567890'),
('SW002', 'Riris', 'X TKJ 2', '088123456789'),
('SW003', 'Siti', 'X RPL 1', '088888888888'),
('SW004', 'Caca', 'X RPL 2', '089000000000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `IdTransaksi` varchar(50) NOT NULL,
  `IdBarang` varchar(20) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `SwKelas` varchar(10) NOT NULL,
  `BrgNama` varchar(50) NOT NULL,
  `Spesifikasi` varchar(225) NOT NULL,
  `qty` int(3) NOT NULL,
  `TglPinjam` date NOT NULL,
  `TglKembali` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`IdTransaksi`, `IdBarang`, `Nama`, `SwKelas`, `BrgNama`, `Spesifikasi`, `qty`, `TglPinjam`, `TglKembali`, `status`) VALUES
('TR.171221.1', '03.06.001', 'riris ', 'X TKJ 1', 'Headset', 'warna hitam', 1, '2021-12-17', '2021-12-17', 'Pinjam'),
('TR.171221.2', '03.06.002', 'Amalia', 'X TKJ 2', 'Kabel', '100 cm', 1, '2021-12-17', '2021-12-17', 'Pinjam');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `IdUser` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`IdUser`, `nama`, `jabatan`, `username`, `email`, `password`) VALUES
(1, 'Rifatus', 'Staf Sarpras', 'adminstaf', 'staf@gmail.com', '25d55ad283aa400af464c76d713c07ad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`IdBarang`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`IdSiswa`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`IdTransaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
