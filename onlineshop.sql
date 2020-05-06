-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Bulan Mei 2020 pada 05.44
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Struktur dari tabel `baju`
--

DROP TABLE IF EXISTS `baju`;
CREATE TABLE `baju` (
  `ID` int(11) NOT NULL,
  `NAMA` varchar(100) NOT NULL,
  `DESKRIPSI` text NOT NULL,
  `STATUS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
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
-- Struktur dari tabel `cart`
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
-- Struktur dari tabel `chat`
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
-- Struktur dari tabel `dchat`
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
-- Struktur dari tabel `dtrans`
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
-- Struktur dari tabel `gambar`
--

DROP TABLE IF EXISTS `gambar`;
CREATE TABLE `gambar` (
  `ID_GAMBAR` int(11) NOT NULL,
  `LINK_GAMBAR` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hchat`
--

DROP TABLE IF EXISTS `hchat`;
CREATE TABLE `hchat` (
  `ID` int(11) NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `ID_CUSTOMER` int(11) NOT NULL,
  `LAST_REPLIER` int(11) NOT NULL,
  `LAST_MESSAGE` text NOT NULL,
  `READ_STATUS` tinyint(1) NOT NULL,
  `CREATED_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` datetime NOT NULL,
  `CUST_LEAVE` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `htrans`
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
-- Struktur dari tabel `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `ID_KATEGORI` int(11) NOT NULL,
  `NAMA_KATEGORI` varchar(50) NOT NULL,
  `STATUS` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`, `STATUS`) VALUES
(2, 'iuhkj', 0),
(3, 'Baju Cowok', 0),
(4, 'Baju Cowok', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

DROP TABLE IF EXISTS `kategori_barang`;
CREATE TABLE `kategori_barang` (
  `ID_KATEGORI` varchar(50) NOT NULL,
  `ID_BARANG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
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
-- Struktur dari tabel `pembayaran`
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
-- Struktur dari tabel `tipe_size`
--

DROP TABLE IF EXISTS `tipe_size`;
CREATE TABLE `tipe_size` (
  `ID_SIZE` varchar(50) NOT NULL,
  `NAMA_SIZE` varchar(50) NOT NULL,
  `HARGA` int(11) NOT NULL,
  `STOK` int(11) NOT NULL
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
CREATE TABLE `tipe_warna` (
  `ID_WARNA` varchar(50) NOT NULL,
  `NAMA_WARNA` varchar(50) NOT NULL
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
CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD_USER` varchar(64) NOT NULL,
  `EMAIL_USER` varchar(50) NOT NULL,
  `ROLE` int(11) NOT NULL,
  `ALAMAT` varchar(150) DEFAULT NULL,
  `NO_TELEPON` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD_USER` varchar(100) NOT NULL,
  `EMAIL_USER` varchar(50) NOT NULL,
  `ROLE` int(11) NOT NULL,
  `code_verify` varchar(100) NOT NULL,
  `verify_email` int(11) NOT NULL,
  `ALAMAT` varchar(150) DEFAULT NULL,
  `NO_TELEPON` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`ID_USER`, `USERNAME`, `PASSWORD_USER`, `EMAIL_USER`, `ROLE`, `code_verify`, `verify_email`, `ALAMAT`, `NO_TELEPON`) VALUES
(8, 'Stefanie', '$2y$10$QTWp9AkzfQMr6scowFOZ/uoZbjXL6yXiAq/qmRH.pMp2Vg5D2wf96', 'stefanieangl@gmail.com', 1, '', 1, 'kapasari 50', 2147483647),
(9, 'Stefanie', '$2y$10$XGX4MvszK3OuKexP1ljdjO3jXG0.3Alw.5raeov.17xUh8y8b0L7y', 'stefanie@gmail.com', 0, '', 1, 'kapasari 50', 2147483647),
(10, 'jennifer', '$2y$10$qO0Y2Eucr6uV/5GXw0CHX.RLb7KUKRPnKNnHr1CnasTZLBnP8fYdC', 'jennifer@gmail.com', 1, '', 1, '', 0),
(11, 'jens', '$2y$10$yhnCGbk06ezgGjsNRL6D1eZ8SaxkjP8nv3YNDS1e7.JUj2toI3pMm', 'jen@gmail.com', 1, '', 1, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `varian_baju`
--

DROP TABLE IF EXISTS `varian_baju`;
CREATE TABLE `varian_baju` (
  `ID_VARIAN` int(11) NOT NULL,
  `ID_BAJU` int(11) NOT NULL,
  `HARGA` int(11) NOT NULL,
  `STOK` int(11) NOT NULL DEFAULT 0,
  `ID_WARNA` int(11) NOT NULL,
  `ID_UKURAN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
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
-- Indeks untuk tabel `baju`
--
ALTER TABLE `baju`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID_CART`);

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID_CHAT`);

--
-- Indeks untuk tabel `dtrans`
--
ALTER TABLE `dtrans`
  ADD PRIMARY KEY (`ID_DTRANS`);

--
-- Indeks untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`ID_GAMBAR`);

--
-- Indeks untuk tabel `htrans`
--
ALTER TABLE `htrans`
  ADD PRIMARY KEY (`ID_HTRANS`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_PEMBAYARAN`);

--
-- Indeks untuk tabel `tipe_size`
--
ALTER TABLE `tipe_size`
  ADD PRIMARY KEY (`ID_SIZE`);

--
-- Indeks untuk tabel `tipe_warna`
--
ALTER TABLE `tipe_warna`
  ADD PRIMARY KEY (`ID_WARNA`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD UNIQUE KEY `EMAIL_USER` (`EMAIL_USER`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_USER`),
  ADD UNIQUE KEY `EMAIL_USER` (`EMAIL_USER`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`ID_WISHLIST`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `ID_CART` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `ID_CHAT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gambar`
--
ALTER TABLE `gambar`
  MODIFY `ID_GAMBAR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `ID_KATEGORI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
