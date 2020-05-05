-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2020 at 07:40 AM
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
CREATE DATABASE IF NOT EXISTS `onlineshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `onlineshop`;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `ID_BARANG` int(11) NOT NULL,
  `NAMA_BARANG` varchar(50) NOT NULL,
  `GAMBAR_BARANG` varchar(150) NOT NULL,
  `DESKRIPSI_BARANG` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `ID_CART` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_BARANG` int(11) NOT NULL,
  `JUMLAH_BARANG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `ID_CHAT` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ISI_CHAT` varchar(200) NOT NULL,
  `ID_ADMIN` int(11) DEFAULT NULL,
  `TANGGAL_CHAT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `LINK_GAMBAR` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `ID_KATEGORI` varchar(50) NOT NULL,
  `NAMA_KATEGORI` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `NAMA_SIZE` varchar(50) NOT NULL,
  `HARGA` int(11) NOT NULL,
  `STOK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipe_size`
--

INSERT INTO `tipe_size` (`ID_SIZE`, `NAMA_SIZE`, `HARGA`, `STOK`) VALUES
('TS00', 'XL', 0, 0),
('TS001', 'XS', 0, 0),
('TS002', 'S', 0, 0),
('TS003', 'M', 0, 0),
('TS004', 'L', 0, 0);

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
  `PASSWORD_USER` varchar(50) NOT NULL,
  `EMAIL_USER` varchar(50) NOT NULL,
  `ROLE` int(11) NOT NULL,
  `ALAMAT` varchar(150) DEFAULT NULL,
  `NO_TELEPON` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `users` (`ID_USER`, `USERNAME`, `PASSWORD_USER`, `EMAIL_USER`, `ROLE`, `ALAMAT`, `NO_TELEPON`) VALUES
(1, 'ste', '*EEF065AC68DD638F9E5056625B442263936163E3', 'stefanieangelina@gmail.com', 0, 'Kapasari', 2147483647);

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
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID_CART`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID_CHAT`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD UNIQUE KEY `EMAIL_USER` (`EMAIL_USER`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`ID_WISHLIST`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID_CART` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `ID_CHAT` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `ID_GAMBAR` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
