-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05 Mei 2020 pada 12.15
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyekaplin`
--
CREATE DATABASE IF NOT EXISTS `proyekaplin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proyekaplin`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `ID_BARANG` int(11) NOT NULL,
  `NAMA_BARANG` varchar(50) NOT NULL,
  `STOK_BARANG` int(11) NOT NULL,
  `GAMBAR_BARANG` varchar(150) NOT NULL,
  `DESKRIPSI_BARANG` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_BARANG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `confirm_email`
--

DROP TABLE IF EXISTS `confirm_email`;
CREATE TABLE IF NOT EXISTS `confirm_email` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `confirm_email`
--

INSERT INTO `confirm_email` (`id`, `id_user`, `code`, `status`, `insert_date`, `update_date`) VALUES
(0, 4, 'a3uxt4bu6dxhp8csqbxt', 1, '2020-05-05 13:50:50', '2020-05-05 14:08:36'),
(0, 5, 'bx5t6dajtdid922g9r86', 0, '2020-05-05 14:13:16', '0000-00-00 00:00:00'),
(0, 6, 'pqnuyzq8iip4us9cykam', 0, '2020-05-05 14:21:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dtrans`
--

DROP TABLE IF EXISTS `dtrans`;
CREATE TABLE IF NOT EXISTS `dtrans` (
  `ID_DTRANS` varchar(50) NOT NULL,
  `ID_BARANG` varchar(50) NOT NULL,
  `JUMLAH_BARANG` int(11) NOT NULL,
  `JUMLAH_DTRANS` int(11) NOT NULL,
  PRIMARY KEY (`ID_DTRANS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `htrans`
--

DROP TABLE IF EXISTS `htrans`;
CREATE TABLE IF NOT EXISTS `htrans` (
  `ID_HTRANS` varchar(50) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `TOTAL_TRANS` int(11) NOT NULL,
  `TGL_TRANS` int(11) NOT NULL,
  PRIMARY KEY (`ID_HTRANS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `ID_KATEGORI` varchar(50) NOT NULL,
  `NAMA_KATEGORI` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_KATEGORI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

DROP TABLE IF EXISTS `kategori_barang`;
CREATE TABLE IF NOT EXISTS `kategori_barang` (
  `ID_KATEGORI` varchar(50) NOT NULL,
  `ID_BARANG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

DROP TABLE IF EXISTS `keranjang`;
CREATE TABLE IF NOT EXISTS `keranjang` (
  `ID_KERANJANG` varchar(50) NOT NULL,
  `ID_USER` varchar(50) NOT NULL,
  `ID_BARANG` varchar(50) NOT NULL,
  `JUMLAH_BARANG` int(11) NOT NULL,
  `HARGA_BARANG` int(11) NOT NULL,
  PRIMARY KEY (`ID_KERANJANG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `ID_PEMBAYARAN` varchar(50) NOT NULL,
  `ID_USER` varchar(50) NOT NULL,
  `TIPE_PEMBAYARAN` varchar(50) NOT NULL,
  `STATUS_PEMBAYARAN` int(11) NOT NULL,
  `ID_HTRANS` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_PEMBAYARAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_size`
--

DROP TABLE IF EXISTS `tipe_size`;
CREATE TABLE IF NOT EXISTS `tipe_size` (
  `ID_SIZE` varchar(50) NOT NULL,
  `NAMA_SIZE` varchar(50) NOT NULL,
  `HARGA` int(11) NOT NULL,
  `STOK` int(11) NOT NULL,
  PRIMARY KEY (`ID_SIZE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tipe_size`
--

INSERT INTO `tipe_size` (`ID_SIZE`, `NAMA_SIZE`, `HARGA`, `STOK`) VALUES
('TS00', 'XL', 0, 0),
('TS001', 'XS', 0, 0),
('TS002', 'S', 0, 0),
('TS003', 'M', 0, 0),
('TS004', 'L', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_warna`
--

DROP TABLE IF EXISTS `tipe_warna`;
CREATE TABLE IF NOT EXISTS `tipe_warna` (
  `ID_WARNA` varchar(50) NOT NULL,
  `NAMA_WARNA` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_WARNA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tipe_warna`
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
-- Struktur dari tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD_USER` varchar(50) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `ROLE` int(1) NOT NULL,
  `STATUS` int(1) NOT NULL,
  `ALAMAT` varchar(150) DEFAULT NULL,
  `NO_TELEPON` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID_USER`, `EMAIL`, `PASSWORD_USER`, `NAMA`, `ROLE`, `STATUS`, `ALAMAT`, `NO_TELEPON`) VALUES
(13, 'jeremiasoswaldo10@gmail.com', '$2y$10$PEUvstkZ/W.1HEL6iYZVX.w3nP8gMswVRBIC/8tlOND', 'Jeremias', 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `ID_WISHLIST` varchar(50) NOT NULL,
  `ID_BARANG` varchar(50) NOT NULL,
  `ID_USER` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_WISHLIST`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
