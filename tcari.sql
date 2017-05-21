-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2017 at 01:00 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcari`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login` (IN `u_name` VARCHAR(15), IN `u_pass` VARCHAR(32))  BEGIN
IF EXISTS (SELECT * FROM users WHERE(u_name = id_user) AND (u_pass = password_user)) THEN
	SELECT 0, "Login Berhasil";
	ELSE
	SELECT -1, "Username atau password anda tidak cocok";
	END IF;
    END$$

DELIMITER ;

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
('B001', '5114100066', 'Charger Laptop', '2017-05-01 00:00:00', 'Plaza Baru II TC', 'Kehilangan', 'Berkabel hitam, panjangnya kurang lebih 70cm.', 'Charger Laptop.jpg', 'Apa merek dari charger tersebut?'),
('B003', '5114100066', 'Tumbler ', '2017-05-20 00:00:00', 'Parkiran Motor TC', 'Kehilangan', 'Bermerek StarBucks , bagian luar berbahan plastik ,  bagian dalam berbahan aluminium.', 'Tumblr Starbucks.jpg', 'Berapa ukuran botol minuman tersebut?'),
('B005', '5114100066', 'Earphone', '2017-05-20 18:27:00', 'Lab. MI', 'Kehilangan', 'Berwarna hitam dengan paduan biru, panjang kabelnya kurang lebih 40cm, ada bagian busa yang tergores di salah satu kuping.', 'Earphone.jpg', 'Disebelah mana bagian busa yang tergores itu?'),
('B010', '5114100066', 'Kotak Pensil', '2017-05-17 07:48:00', 'IF- 105A', 'Ditemukan', 'Berwarna putih, bercorak bunga mawar, di dalamnya ada beberapa alat-tulis (pulpen, penggaris, penghapus, dan spidol kecil)', 'Kotak Pensil.jpg', 'Apa warna spidol yang terdapat di dalam kotak pensil?'),
('B012', '5114100066', 'Laptop Case', '2017-05-12 09:30:00', 'IF - 102', 'Ditemukan', 'Berwarna putih, ada corak  hitamnya, reseletingnya berwarna abu-abu.', 'Laptop Case.jpg', 'Apa merek dari laptop case tersebut?'),
('B014', '5114100076', 'Samsung Note 5', '2017-05-09 19:11:00', 'Musholla TC', 'Kehilangan', 'Berwarna silver, ada hardcasenya, ada goresan dibagian bawah', 'Samsung Note 5.jpg', 'Goresan yang dibagian bawah terletak disebelah mana?'),
('B016', '5114100076', 'Kacamataku', '2017-05-19 00:00:00', 'Lab. Alpro', 'Kehilangan', 'Berwarna silver dengan corak hitam-hitam, berbahan alumi.nium', 'Kacamata.jpg', 'Apa merek dari kacamata tersebut?'),
('B018', '5114100076', 'Jaket Hujan', '2017-05-14 11:07:00', 'Plasa Lama TC', 'Kehilangan', 'Berwarna kuning, terdapat kantong di dalam jaket, ada reseleting untuk membuka atau memasukkan hoodie nya', 'Jaket Hujan.jpg', 'Apa merek dari jaket tersebut?'),
('B020', '5114100066', 'Kacamata', '2017-05-10 12:11:00', 'Lab. MI', 'Ditemukan', 'Berwarna hitam berpadu dengan coklat. Gagangnya sedikit lebar.', 'Kacamata.jpg', 'Apa merek dari kacamata tersebut?'),
('B022', '5114100076', 'Jam Tangan', '2017-05-17 19:59:00', 'Lab. NCC', 'Ditemukan', 'Berwana silver, layarnya warna hitam, terdapat goresan kecil di dekat layar.', 'Jam Tangan.jpg', 'Apa merek dari jam tangan tersebut?'),
('B024', '5114100076', 'Botol Minum Luc', '2017-05-16 12:22:00', 'IF - 108', 'Ditemukan', 'Berwarna kuning, ada tali kecil, berbahan aluminium.', 'Botol Minum Lucu.jpg', 'Berapa ukuran botol minuman tersebut?'),
('B026', '5114100076', 'Payung Hujan', '2017-05-13 10:39:00', 'IF - 106', 'Ditemukan', 'Berwarna merah, ada goresan di ujung gagang, ada inisial di atas payung', 'Payung Hujan.jpg', 'Apa inisial yang terdapat di atas payung?'),
('B028', '5114100104', 'Kotak Kacamata', '2017-05-17 11:10:00', 'IF - 101', 'Kehilangan', 'Bermerek rayban, case nya berwana hitam , dalamnya berwarna putih. Ada kain pembersih kacamatanya juga dan ada inisial di kain pembersih tersebut. ', 'Kotak Kacamata.jpg', 'Apa inisial yang terdapat di kain pembersih kacamata yang di dalam kotak?'),
('B030', '5114100104', 'Helm merah', '2017-05-15 11:59:00', 'Depan LP II', 'Kehilangan', 'Berwarna merah, kacanya berwarna hitam, terdapat goresan sedikit, busa dibagian dalam ada yang robek', 'Helm merah.jpg', 'Dibagian sebelah manakah kain busa yang robek?'),
('B032', '5114100104', 'Headset Pink', '2017-05-12 12:12:00', 'Depan LP II', 'Kehilangan', 'Berwarna pink, bermerek asus, ada bagian headset yang hampir terputus.', 'Headset Pink.jpg', 'Dibagian sebelah headset manakan yang hampir putus?'),
('B034', '5114100104', 'Kalkulator', '2017-05-15 07:00:00', 'IF - 103', 'Ditemukan', 'Bermerek casio, tidak ada tutupnya, susah dimatiin, ada inisial dibelakang kalkulator.', 'Kalkulator.jpg', 'Apa inisial yang terdapat di belakang kalkulator?'),
('B036', '5114100104', '1 set kacamata', '2017-05-19 13:03:00', 'Parkiran Motor TC', 'Ditemukan', 'Terdapat kotak kacamata yang berwarna merah keperakann, lalu ada kacamata yang berwarna merah maroon dengan frame yang kecil, lalu ada kain pembersih kacamatanya juga.', '1 set kacamata.jpg', 'Apa merek dari satu set kacamata tersebut?'),
('B038', '5114100104', 'Tas Laptop', '2017-05-04 16:11:00', 'IF - 104', 'Ditemukan', 'Tas laptopnya berwarna hitam, berbahan kain yang tahan air. Di dalamnya terdapat mouse mini.', 'Tas Laptop HItam.jpg', 'Apa merek dari tas tersebut?'),
('B040', '5114100092', 'Glasses Box', '2017-05-14 12:00:00', 'Lab. NCC', 'Kehilangan', 'Berwarna ungu, bahannya plastik, di dalamnya ada pembersih kacamata.', 'Glasses Box.jpg', 'Apa merek dari kotak kacamata  tersebut?'),
('B042', '5114100092', 'Mouse Biru', '2017-05-08 09:59:00', 'Parkiran Mobil TC', 'Ditemukan', 'Merupakan mouse portable yang berwarna biru dengan ada pattern nya. Lebarnya kurang lebih 6cm', 'Mouse Biru.jpg', 'Apakah ada batre di dalam mouse tersebut?'),
('B044', '5114100142', 'Powerbank Pink', '2017-05-11 10:07:00', 'IF - 102', 'Kehilangan', 'Berwarna pink shock, merek XiaoMi, berkapasitas 10000mAh.', 'Powerbank Pink.jpg', 'Apakah ada lecet dibagian luar power bank tersebut?'),
('B046', '5114100142', 'MiFi Putih', '2017-05-08 09:12:00', 'Depan Kantin TC', 'Ditemukan', 'Berwarna putih, ukurannya se-genggang tangan, ada lecet sedikit di bagian luar', 'MiFi Putih.jpg', 'Dibagian sebelah mifi manakah yang lecet?'),
('B048', '5114100142', 'Senter Hitam', '2017-05-17 20:19:00', 'LP II TC', 'Ditemukan', 'Berwarna hitam, dengan daya 2000W, merek POLICE. Ada inisial yang tertulis di bagian bawah.', 'Senter Hitam.jpg', 'Apa inisial yang terdapat di bawah senter?'),
('B050', '5114100188', 'Jam Swatch', '2017-05-12 08:22:00', 'IF - 105B', 'Kehilangan', 'Merek Swatch, berbahan aluminium, diameter kurang lebih 4cm dan jamnya sudah habis batre,', 'Jam Swatch.jpg', 'Apakah ada bagian jam tangan yang berkarat?'),
('B052', '5114100188', 'Tas Laptop Pink', '2017-05-11 14:55:00', 'Depan RBTC ', 'Ditemukan', 'Berwarna pink, tas untuk ukuran laptop 14inchi, ada banyak reseleting yang terdapat didalam tas.', 'Tas Laptop Pink.jpg', 'Apa merek dari tas laptop tersebut?'),
('B053', '', '', '0000-00-00 00:00:00', '', '', '', '', ''),
('B054', '5114100188', 'Helm Hitam', '2017-05-11 12:44:00', 'Depan IF-108', 'Ditemukan', 'Berwarna hitam, ada banyak sticker di bagian belakang helm.', 'Helm Hitam.jpg', 'Ada brp banyak sticker yang tempel di helm tersebut?'),
('B055', '', '', '0000-00-00 00:00:00', '', '', '', '', ''),
('B056', '5114100188', '2 Payung Unik', '2017-05-15 11:22:00', 'Plasa Lama TC', 'Ditemukan', 'Ada 2 payung, 1 nya berukuran besar dan berwarna merah dan 1 nya lagi berukuran kecil dan berwarna ungu. Gagangnya berbahan kayu. Ada corak di kain payungnya. Ada tulisan inisial di pegangan payungnya.', '2 Payung Unik.jpg', 'Apa tulisan inisial yang terdapat pada pegangan payung tersebut?'),
('B057', '', '', '0000-00-00 00:00:00', '', '', '', '', ''),
('B058', '5114100092', 'Mug Rubik', '2017-05-20 21:17:00', 'Lab. NCC', 'Kehilangan', 'Gelas Mug berbentuk  seperti rubik, berbahan keramik. Dibawah mug ada tulisan inisial.', 'Mug Rubik.jpg', 'Apa inisial yang terdapat di bawah mug?'),
('B059', '', '', '0000-00-00 00:00:00', '', '', '', '', ''),
('B060', '5114100092', 'Sendok & Garpu', '2017-05-18 14:12:00', 'Depan IF - 102', 'Kehilangan', 'Sepasang alat makan yang berupa aluminium dimana diujung gagangnya ada mainan es krim.', 'Sendok & Garpu.jpg', 'Terbuat dari negara manakah alat makan ini?'),
('B061', '', '', '0000-00-00 00:00:00', '', '', '', '', ''),
('B062', '5114100076', 'Gantungan Lego', '2017-05-21 11:29:00', 'Lab. RPL', 'Ditemukan', 'Kondisinya masih baru, gantungannya berbahan aluminium biasa, mainan gantungannya yaitu stormtrooper star wars warna putih. Di belakang badan mainan nya ada tulisan angka.', 'Gantungan Lego.jpg', 'Apa tulisan angka yang terdapat di belakang badan mainan gantungan tersebut?'),
('B063', '', '', '0000-00-00 00:00:00', '', '', '', '', '');

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
  `Kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `ID_Barang`, `ID_Pemilik`, `ID_Penemu`, `Tanggal_Selesai`, `Status`, `Kategori`) VALUES
('TR001', 'B001', '5114100066', '', '2017-05-21 15:50:08', 'NOT CLEAR', 'Kehilangan'),
('TR002', 'B002', '5114100066', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR003', 'B003', '5114100066', '', '2017-05-21 15:50:24', 'NOT CLEAR', 'Kehilangan'),
('TR004', 'B004', '5114100066', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR005', 'B005', '5114100066', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR006', 'B006', '5114100066', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR007', 'B007', '', '5114100066', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR008', 'B008', '', '5114100066', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR009', 'B009', '', '5114100066', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR010', 'B010', '', '5114100066', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR011', 'B011', '', '5114100066', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR012', 'B012', '', '5114100066', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR013', 'B013', '', '5114100066', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR014', 'B014', '5114100076', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR015', 'B015', '5114100076', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR016', 'B016', '5114100076', '', '2017-05-21 16:30:11', 'NOT CLEAR', 'Kehilangan'),
('TR017', 'B017', '5114100076', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR018', 'B018', '5114100076', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR019', 'B019', '5114100076', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR020', 'B020', '', '5114100066', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR021', 'B021', '', '5114100066', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR022', 'B022', '', '5114100076', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR023', 'B023', '', '5114100076', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR024', 'B024', '', '5114100076', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR025', 'B025', '', '5114100076', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR026', 'B026', '', '5114100076', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR027', 'B027', '', '5114100076', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR028', 'B028', '5114100104', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR029', 'B029', '5114100104', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR030', 'B030', '5114100104', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR031', 'B031', '5114100104', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR032', 'B032', '5114100104', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR033', 'B033', '5114100104', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR034', 'B034', '', '5114100104', '2017-05-21 16:54:46', 'NOT CLEAR', 'Ditemukan'),
('TR035', 'B035', '', '5114100104', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR036', 'B036', '', '5114100104', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR037', 'B037', '', '5114100104', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR038', 'B038', '', '5114100104', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR039', 'B039', '', '5114100104', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR040', 'B040', '5114100092', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR041', 'B041', '5114100092', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR042', 'B042', '', '5114100092', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR043', 'B043', '', '5114100092', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR044', 'B044', '5114100142', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR045', 'B045', '5114100142', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR046', 'B046', '', '5114100142', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR047', 'B047', '', '5114100142', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR048', 'B048', '', '5114100142', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR049', 'B049', '', '5114100142', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR050', 'B050', '5114100188', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR051', 'B051', '5114100188', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR052', 'B052', '', '5114100188', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR053', 'B053', '', '5114100188', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR054', 'B054', '', '5114100188', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR055', 'B055', '', '5114100188', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR056', 'B056', '', '5114100188', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR057', 'B057', '', '5114100188', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR058', 'B058', '5114100092', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR059', 'B059', '5114100092', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR060', 'B060', '5114100092', '', '0000-00-00 00:00:00', 'NOT CLEAR', 'Kehilangan'),
('TR061', 'B061', '5114100092', '', '0000-00-00 00:00:00', 'NOT CLEAR', ''),
('TR062', 'B062', '', '5114100076', '0000-00-00 00:00:00', 'NOT CLEAR', 'Ditemukan'),
('TR063', 'B063', '', '5114100076', '0000-00-00 00:00:00', 'NOT CLEAR', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_User` varchar(15) NOT NULL,
  `Nama_User` varchar(40) NOT NULL,
  `No_Telepon` varchar(15) NOT NULL,
  `Foto` varchar(40) NOT NULL,
  `password_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_User`, `Nama_User`, `No_Telepon`, `Foto`, `password_user`) VALUES
('5114100066', 'Vinsensia Sipriana Zega', '089673927393', 'Vinsensia Sipriana Zega.JPG', 'singlehappy'),
('5114100076', 'Muhammad Faishal Ilham', '085668869515', 'Muhammad Faishal.JPG', 'anakgaul'),
('5114100092', 'Kharisma Monika', '080811112222', '', '5114100092'),
('5114100104', 'Fathihah Ulya Hakiem', '087826382638', 'Fathihah Ulya Hakiem.jpg', 'akuanakio'),
('5114100142', 'Dwika Setya Muhammad', '089876543210', '', '5114100142'),
('5114100188', 'Hilma Kamilah', '0811223344', '', '5114100188');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
