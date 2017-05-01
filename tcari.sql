-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2017 at 07:25 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcari`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID_Barang` varchar(10) NOT NULL,
  `ID_User` varchar(15) NOT NULL,
  `Nama_Barang` varchar(15) NOT NULL,
  `Tanggal` datetime NOT NULL,
  `Tempat` varchar(20) NOT NULL,
  `Kategori` varchar(20) NOT NULL,
  `Keterangan` text NOT NULL,
  `Foto` varchar(40) NOT NULL,
  `Security_Ques` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_Barang`, `ID_User`, `Nama_Barang`, `Tanggal`, `Tempat`, `Kategori`, `Keterangan`, `Foto`, `Security_Ques`) VALUES
('B001', '5114100066', 'Jas Hujan', '2017-04-11 00:00:00', 'Sekitar PB1', 'Ditemukan', 'ditemukan jas hujan berwarna merah di sekitar PB 1', '', 'Apakah jenis hujan tersebut?'),
('B002', '5114100104', 'Payung', '2017-04-10 00:00:00', 'Sekitar PL1', 'Kehilangan', 'Saya telah kehilangan payung yang sebelumnya kalau tidak salah saya tinggal disekitar PL1 Teknik Informatika ITS', '', 'Apa warna dari payung tersebut dan jenis payungnya?');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `ID_Message` varchar(10) NOT NULL,
  `Judul_Message` varchar(25) NOT NULL,
  `Isi_Message` text NOT NULL,
  `ID_Sender` varchar(15) NOT NULL,
  `ID_Receiver` varchar(15) NOT NULL,
  `Tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`ID_Message`, `Judul_Message`, `Isi_Message`, `ID_Sender`, `ID_Receiver`, `Tanggal`) VALUES
('MS001', 'Itu Jas Hujan Punya Saya', 'Itu jas hujan punya saya, jenis jas hujan ponco warna merah kan', '5114100076', '5114100066', '2017-04-12 00:00:00'),
('MS002', 'Ada Ditemukan Payung', 'Itu payungnya warna biru dan jenis payungnya itu yang bisa kecil dilipat bukan?', '5114100066', '5114100104', '2017-04-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Transaksi` varchar(10) NOT NULL,
  `ID_Barang` varchar(20) NOT NULL,
  `ID_Pemilik` varchar(20) NOT NULL,
  `ID_Penemu` varchar(20) NOT NULL,
  `Tanggal_Selesai` datetime NOT NULL,
  `Status` varchar(30) NOT NULL,
  `Progress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `ID_Barang`, `ID_Pemilik`, `ID_Penemu`, `Tanggal_Selesai`, `Status`, `Progress`) VALUES
('TR001', 'B001', '', '5114100066', '0000-00-00 00:00:00', 'NOT CLEAR', 'FOUND'),
('TR002', 'B002', '5114100104', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'LOST');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_User` varchar(15) NOT NULL,
  `Nama_User` varchar(40) NOT NULL,
  `No_Telepon` varchar(15) NOT NULL,
  `Foto` varchar(40) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_User`, `Nama_User`, `No_Telepon`, `Foto`, `Password`) VALUES
('5114100066', 'Vinsensia Sipriana Zega', '089673927393', '', 'singlehappy'),
('5114100076', 'Muhammad Faishal Ilham', '085668869515', '', 'anakgaul'),
('5114100104', 'Fathihah Ulya Hakiem', '087826382638', '', 'akuanakio');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_Barang`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID_Message`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_User`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
