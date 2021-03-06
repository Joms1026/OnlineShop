-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 04:23 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshop`
--
CREATE DATABASE IF NOT EXISTS `onlineshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `onlineshop`;

-- --------------------------------------------------------

--
-- Table structure for table `baju`
--

DROP TABLE IF EXISTS `baju`;
CREATE TABLE `baju` (
  `ID` int(11) NOT NULL,
  `NAMA` varchar(100) NOT NULL,
  `DESKRIPSI` text NOT NULL,
  `STATUS` int(11) NOT NULL,
  `ID_KATEGORI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `confirm_email`
--

DROP TABLE IF EXISTS `confirm_email`;
CREATE TABLE `confirm_email` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dchat`
--

DROP TABLE IF EXISTS `dchat`;
CREATE TABLE `dchat` (
  `ID` int(11) NOT NULL,
  `ID_HCHAT` int(11) NOT NULL,
  `SENDER` int(11) NOT NULL,
  `MESSAGE` text NOT NULL,
  `CREATED_AT` datetime NOT NULL,
  `READ_STATUS` tinyint(1) NOT NULL,
  `UPDATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dtrans`
--

DROP TABLE IF EXISTS `dtrans`;
CREATE TABLE `dtrans` (
  `ID_DTRANS` varchar(50) NOT NULL,
  `ID_BARANG` varchar(50) NOT NULL,
  `JUMLAH_BARANG` int(11) NOT NULL,
  `JUMLAH_DTRANS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

DROP TABLE IF EXISTS `gambar`;
CREATE TABLE `gambar` (
  `ID_GAMBAR` int(11) NOT NULL,
  `LINK_GAMBAR` varchar(200) NOT NULL,
  `ID_BAJU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `hchat`
--

DROP TABLE IF EXISTS `hchat`;
CREATE TABLE `hchat` (
  `ID` int(11) NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `ID_CUSTOMER` int(11) NOT NULL,
  `LAST_REPLIER` int(11) NOT NULL,
  `LAST_MESSAGE` text NOT NULL,
  `READ_STATUS` tinyint(1) NOT NULL,
  `CREATED_AT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` datetime NOT NULL,
  `CUST_LEAVE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `htrans`
--

DROP TABLE IF EXISTS `htrans`;
CREATE TABLE `htrans` (
  `ID_HTRANS` varchar(50) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `TOTAL_TRANS` int(11) NOT NULL,
  `TGL_TRANS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `ID_KATEGORI` int(11) NOT NULL,
  `NAMA_KATEGORI` varchar(50) NOT NULL,
  `STATUS` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`, `STATUS`) VALUES
(1, 'Laki-laki', 1),
(2, 'Perempuan', 1),
(3, 'Anak-anak', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

DROP TABLE IF EXISTS `kategori_barang`;
CREATE TABLE `kategori_barang` (
  `ID_KATEGORI` varchar(50) NOT NULL,
  `ID_BARANG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

DROP TABLE IF EXISTS `keranjang`;
CREATE TABLE `keranjang` (
  `ID_KERANJANG` varchar(50) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_BARANG` int(11) NOT NULL,
  `JUMLAH_BARANG` int(11) NOT NULL,
  `HARGA_BARANG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran` (
  `ID_PEMBAYARAN` varchar(50) NOT NULL,
  `ID_USER` varchar(50) NOT NULL,
  `TIPE_PEMBAYARAN` varchar(50) NOT NULL,
  `STATUS_PEMBAYARAN` int(11) NOT NULL,
  `ID_HTRANS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_size`
--

DROP TABLE IF EXISTS `tipe_size`;
CREATE TABLE `tipe_size` (
  `ID_SIZE` varchar(50) NOT NULL,
  `NAMA_SIZE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipe_size`
--

INSERT INTO `tipe_size` (`ID_SIZE`, `NAMA_SIZE`) VALUES
('TS001', 'XS'),
('TS002', 'S'),
('TS003', 'M'),
('TS004', 'L'),
('TS005', 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_warna`
--

DROP TABLE IF EXISTS `tipe_warna`;
CREATE TABLE `tipe_warna` (
  `ID_WARNA` varchar(50) NOT NULL,
  `NAMA_WARNA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipe_warna`
--

INSERT INTO `tipe_warna` (`ID_WARNA`, `NAMA_WARNA`) VALUES
('TW001', 'MERAH'),
('TW002', 'KUNING'),
('TW003', 'HIJAU'),
('TW004', 'BIRU'),
('TW005', 'HITAM'),
('TW006', 'PUTIH'),
('TW007', 'GRAY');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD_USER` varchar(100) NOT NULL,
  `EMAIL_USER` varchar(50) NOT NULL,
  `ROLE` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `ALAMAT` varchar(150) DEFAULT NULL,
  `NO_TELEPON` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `varian_baju`
--

DROP TABLE IF EXISTS `varian_baju`;
CREATE TABLE `varian_baju` (
  `ID_VARIAN` int(11) NOT NULL,
  `ID_BAJU` int(11) NOT NULL,
  `HARGA` int(11) NOT NULL,
  `STOK` int(11) NOT NULL DEFAULT '0',
  `ID_WARNA` varchar(50) NOT NULL,
  `ID_UKURAN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `ID_WISHLIST` varchar(50) NOT NULL,
  `ID_BARANG` varchar(50) NOT NULL,
  `ID_USER` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baju`
--
ALTER TABLE `baju`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dtrans`
--
ALTER TABLE `dtrans`
  ADD PRIMARY KEY (`ID_DTRANS`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`ID_GAMBAR`);

--
-- Indexes for table `htrans`
--
ALTER TABLE `htrans`
  ADD PRIMARY KEY (`ID_HTRANS`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_PEMBAYARAN`);

--
-- Indexes for table `tipe_size`
--
ALTER TABLE `tipe_size`
  ADD PRIMARY KEY (`ID_SIZE`);

--
-- Indexes for table `tipe_warna`
--
ALTER TABLE `tipe_warna`
  ADD PRIMARY KEY (`ID_WARNA`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_USER`),
  ADD UNIQUE KEY `EMAIL_USER` (`EMAIL_USER`);

--
-- Indexes for table `varian_baju`
--
ALTER TABLE `varian_baju`
  ADD PRIMARY KEY (`ID_VARIAN`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`ID_WISHLIST`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baju`
--
ALTER TABLE `baju`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `ID_GAMBAR` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `ID_KATEGORI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `varian_baju`
--
ALTER TABLE `varian_baju`
  MODIFY `ID_VARIAN` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
