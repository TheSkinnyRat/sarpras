-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2021 at 07:04 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarpras`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desc` text NOT NULL,
  `stock` int(10) NOT NULL,
  `status` enum('tampilkan','sembunyikan','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `name`, `desc`, `stock`, `status`) VALUES
(1, 'bola voli', 'ini bola voli', 35, 'tampilkan'),
(2, 'a', 'b', 7, 'tampilkan'),
(3, 'b', 'a', 5, 'tampilkan'),
(6, 'z', 'z', 10, 'sembunyikan'),
(7, 'q', 'q', 8, 'tampilkan'),
(10, 'qw', 'qw', 0, 'tampilkan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peminjam`
--

CREATE TABLE `tbl_peminjam` (
  `id_peminjam` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_peminjam`
--

INSERT INTO `tbl_peminjam` (`id_peminjam`, `username`, `password`, `name`, `email`) VALUES
(1, 'peminjam', 'VHQJZFQ9A24GaQI5DGELaQ==', 'peminjam', 'peminjam@email.com'),
(30, 'purwa', 'J6mqsm/D+ZPW/0/LsWHQQMT6EwSlp9O6ionun3F6DwSiUUt6670cDXsHzNW206+59GEemoljs93BWQ8KWAN78g==', 'Purwa Sabrang Ramadhan ', 'psr@a.com'),
(38, 'yuda', 'oVSXKtKcnClfbg2TI8pLJnxV8LlGsPCA3MZg6iuZ41efIDG06I59Q+1DGtQwuOsnLApsmbUAN0zePjqm3/QbMA==', 'Yuda Aduy', 'yda@ady.com'),
(39, 'wardah', '9H2YHywNRJMom3YesNU4gorGVRDDbfl6SLTP3UXCpR+fQ//Os+5zOBSoo5GxImCecYkEouP4ERGNKLgEq1u4zA==', 'wardah', 'wardah@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_petugas`
--

CREATE TABLE `tbl_petugas` (
  `id_petugas` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_petugas`
--

INSERT INTO `tbl_petugas` (`id_petugas`, `username`, `password`, `name`, `email`, `photo`) VALUES
(1, 'superadmin', 'KkR/ln1U0b8C79VfG3z3AG0Niddn6qhc2/3hc6DEabVdkmJNIwNx9ep2Vfs4a7yukDmm6RtG+b3rb6Jb1sCqlQ==', 'Purwa Sabrang', 'Psr@email.com', ''),
(2, 'petugas', 'BiYPYgV1Dn9XMQExB3g=', 'petugas', 'petugas@email.com', '\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(10) NOT NULL,
  `id_peminjam` int(10) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `jml` int(20) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `status` enum('0','1','2','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `id_peminjam`, `id_barang`, `jml`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(43, 38, 1, 5, '2018-11-02 21:32:43', '0000-00-00 00:00:00', '1'),
(45, 38, 2, 3, '2018-11-02 21:33:02', '0000-00-00 00:00:00', '0'),
(46, 38, 3, 5, '2018-11-02 23:32:16', '0000-00-00 00:00:00', '0'),
(47, 30, 1, 5, '2018-11-02 23:42:06', '0000-00-00 00:00:00', '0'),
(48, 1, 1, 5, '2021-11-14 13:01:42', '0000-00-00 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_riwayat`
--

CREATE TABLE `tbl_riwayat` (
  `id_pinjam` int(10) NOT NULL,
  `id_peminjam` int(10) NOT NULL,
  `id_barang` int(10) NOT NULL,
  `jml` int(20) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `status` enum('0','1','2','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_riwayat`
--

INSERT INTO `tbl_riwayat` (`id_pinjam`, `id_peminjam`, `id_barang`, `jml`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(29, 38, 1, 2, '2018-11-01 23:58:12', '0000-00-00 00:00:00', '0'),
(28, 38, 1, 1, '2018-11-01 23:58:08', '2018-11-01 23:58:44', '1'),
(30, 38, 1, 3, '2018-11-01 23:58:14', '2018-11-01 23:58:45', '1'),
(32, 30, 3, 2, '2018-11-01 23:59:44', '0000-00-00 00:00:00', '0'),
(34, 38, 1, 1, '2018-11-02 15:05:05', '0000-00-00 00:00:00', '0'),
(20, 30, 2, 1, '2018-11-01 22:54:54', '2018-11-02 00:05:44', '1'),
(31, 38, 2, 1, '2018-11-01 23:58:18', '2018-11-02 14:53:10', '1'),
(33, 38, 1, 1, '2018-11-02 15:02:45', '2018-11-02 15:04:39', '1'),
(35, 38, 1, 20, '2018-11-02 15:05:45', '2018-11-02 21:23:01', '1'),
(40, 38, 1, 5, '2018-11-02 21:29:11', '2018-11-02 21:31:53', '1'),
(41, 38, 2, 3, '2018-11-02 21:30:47', '2018-11-02 21:31:54', '1'),
(42, 38, 2, 2, '2018-11-02 21:30:54', '2018-11-02 21:31:55', '1'),
(44, 38, 2, 2, '2018-11-02 21:32:58', '0000-00-00 00:00:00', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_peminjam`
--
ALTER TABLE `tbl_peminjam`
  ADD PRIMARY KEY (`id_peminjam`);

--
-- Indexes for table `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_peminjam`
--
ALTER TABLE `tbl_peminjam`
  MODIFY `id_peminjam` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  MODIFY `id_petugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
