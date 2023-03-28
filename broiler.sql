-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2016 at 03:28 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `broiler`
--

-- --------------------------------------------------------

--
-- Table structure for table `kandang`
--

CREATE TABLE `kandang` (
  `idkandang` int(2) NOT NULL,
  `namapemilik` varchar(32) NOT NULL,
  `alamatpemilik` varchar(100) NOT NULL,
  `telp` varchar(14) NOT NULL,
  `lokasikandang` varchar(100) NOT NULL,
  `kapasitas` int(5) NOT NULL,
  `user` varchar(24) NOT NULL,
  `password` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kandang`
--

INSERT INTO `kandang` (`idkandang`, `namapemilik`, `alamatpemilik`, `telp`, `lokasikandang`, `kapasitas`, `user`, `password`) VALUES
(1, 'Kholil', 'Jalan Raya Mangkang Wetan Semarang', '024', 'Kampung Podorejo', 2500, 'user', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `user` varchar(14) NOT NULL,
  `password` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `user`, `password`) VALUES
(1, 'user', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `idproduksi` int(5) NOT NULL,
  `idkandang` int(2) NOT NULL,
  `tgldocin` date NOT NULL,
  `ayammasuk` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`idproduksi`, `idkandang`, `tgldocin`, `ayammasuk`, `status`) VALUES
(1, 1, '2016-06-01', 2550, 0),
(2, 1, '2016-08-12', 2550, 1);

-- --------------------------------------------------------

--
-- Table structure for table `recording`
--

CREATE TABLE `recording` (
  `idrecording` int(16) NOT NULL,
  `idproduksi` int(5) NOT NULL,
  `umur` int(3) NOT NULL,
  `mati` int(3) NOT NULL,
  `bbrata` int(4) DEFAULT NULL,
  `jmlpakan` decimal(2,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recording`
--

INSERT INTO `recording` (`idrecording`, `idproduksi`, `umur`, `mati`, `bbrata`, `jmlpakan`) VALUES
(1, 1, 1, 4, NULL, '0.5'),
(3, 1, 2, 1, NULL, '0.5'),
(4, 1, 3, 1, NULL, '1.0'),
(5, 1, 4, 2, NULL, '1.0'),
(6, 1, 5, 1, NULL, '1.5'),
(7, 1, 6, 1, NULL, '1.5'),
(8, 1, 7, 1, 170, '2.0'),
(9, 1, 8, 3, NULL, '1.5'),
(11, 1, 9, 1, NULL, '1.5'),
(12, 1, 10, 0, NULL, '2.5'),
(13, 1, 11, 0, NULL, '3.0'),
(15, 1, 12, 1, NULL, '3.5'),
(16, 1, 13, 2, NULL, '3.0'),
(17, 1, 14, 2, 440, '3.0'),
(18, 1, 15, 3, NULL, '3.0'),
(19, 1, 16, 9, NULL, '3.0'),
(20, 1, 17, 10, NULL, '3.5'),
(21, 1, 18, 9, NULL, '6.0'),
(22, 1, 19, 2, NULL, '4.0'),
(23, 1, 20, 3, NULL, '4.5'),
(24, 1, 21, 1, 800, '5.0'),
(25, 1, 22, 1, NULL, '4.5'),
(26, 1, 23, 4, NULL, '5.0'),
(27, 1, 24, 1, NULL, '5.0'),
(28, 1, 25, 3, NULL, '6.0'),
(29, 1, 26, 2, NULL, '6.5'),
(30, 1, 27, 3, NULL, '6.0'),
(31, 1, 28, 0, 1260, '6.5'),
(32, 1, 29, 0, NULL, '6.5'),
(33, 1, 30, 2, NULL, '7.0'),
(34, 1, 31, 2, NULL, '7.0'),
(35, 1, 32, 0, NULL, '6.0'),
(36, 1, 33, 4, NULL, '6.0'),
(37, 1, 34, 0, NULL, '7.0'),
(38, 1, 35, 0, 1760, '7.0'),
(39, 2, 1, 2, NULL, '0.5'),
(40, 2, 2, 1, NULL, '0.5'),
(41, 2, 3, 0, NULL, '1.0');

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE `target` (
  `minggu` int(3) NOT NULL,
  `targetdayahidup` decimal(4,2) NOT NULL,
  `targetbbrata` int(4) NOT NULL,
  `targetpakan` int(4) NOT NULL,
  `targetfi` int(4) NOT NULL,
  `targetfcr` decimal(5,2) NOT NULL,
  `targetip` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`minggu`, `targetdayahidup`, `targetbbrata`, `targetpakan`, `targetfi`, `targetfcr`, `targetip`) VALUES
(1, '99.30', 160, 0, 146, '0.92', 296),
(2, '98.60', 400, 0, 514, '1.23', 276),
(3, '97.90', 800, 0, 1124, '1.40', 301),
(4, '97.20', 1250, 0, 1923, '1.52', 318),
(5, '96.50', 1750, 0, 2912, '1.65', 324),
(6, '95.80', 2250, 0, 4036, '1.79', 323);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kandang`
--
ALTER TABLE `kandang`
  ADD PRIMARY KEY (`idkandang`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`idproduksi`),
  ADD KEY `idkandang` (`idkandang`);

--
-- Indexes for table `recording`
--
ALTER TABLE `recording`
  ADD PRIMARY KEY (`idrecording`),
  ADD KEY `idproduksi` (`idproduksi`),
  ADD KEY `umur_2` (`umur`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`minggu`),
  ADD KEY `umur` (`minggu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kandang`
--
ALTER TABLE `kandang`
  MODIFY `idkandang` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `idproduksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `recording`
--
ALTER TABLE `recording`
  MODIFY `idrecording` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `produksi_ibfk_1` FOREIGN KEY (`idkandang`) REFERENCES `kandang` (`idkandang`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
