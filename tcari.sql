/*
SQLyog Ultimate v8.6 Beta2
MySQL - 5.6.26 : Database - tcari
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `ID_Barang` varchar(10) NOT NULL,
  `ID_User` varchar(15) NOT NULL,
  `Nama_Barang` varchar(15) NOT NULL,
  `Tanggal` datetime NOT NULL,
  `Tempat` varchar(20) NOT NULL,
  `Kategori` varchar(20) NOT NULL,
  `Keterangan` text NOT NULL,
  `Foto` varchar(40) NOT NULL,
  `Security_Ques` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`ID_Barang`,`ID_User`,`Nama_Barang`,`Tanggal`,`Tempat`,`Kategori`,`Keterangan`,`Foto`,`Security_Ques`) values ('B001','5114100066','Jas Hujan','2017-04-11 00:00:00','Sekitar PB1','Ditemukan','ditemukan jas hujan berwarna merah di sekitar PB 1','','Apakah jenis hujan tersebut?'),('B002','5114100104','Payung','2017-04-10 00:00:00','Sekitar PL1','Kehilangan','Saya telah kehilangan payung yang sebelumnya kalau tidak salah saya tinggal disekitar PL1 Teknik Informatika ITS','','Apa warna dari payung tersebut dan jenis payungnya?');

/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `ID_Message` varchar(10) NOT NULL,
  `Judul_Message` varchar(25) NOT NULL,
  `Isi_Message` text NOT NULL,
  `ID_Sender` varchar(15) NOT NULL,
  `ID_Receiver` varchar(15) NOT NULL,
  `Tanggal` datetime NOT NULL,
  PRIMARY KEY (`ID_Message`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `message` */

insert  into `message`(`ID_Message`,`Judul_Message`,`Isi_Message`,`ID_Sender`,`ID_Receiver`,`Tanggal`) values ('MS001','Itu Jas Hujan Punya Saya','Itu jas hujan punya saya, jenis jas hujan ponco warna merah kan','5114100076','5114100066','2017-04-12 00:00:00'),('MS002','Ada Ditemukan Payung','Itu payungnya warna biru dan jenis payungnya itu yang bisa kecil dilipat bukan?','5114100066','5114100104','2017-04-11 00:00:00');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `ID_Transaksi` varchar(10) NOT NULL,
  `ID_Barang` varchar(20) NOT NULL,
  `ID_Pemilik` varchar(20) NOT NULL,
  `ID_Penemu` varchar(20) NOT NULL,
  `Tanggal_Selesai` datetime NOT NULL,
  `Status` varchar(30) NOT NULL,
  `Progress` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`ID_Transaksi`,`ID_Barang`,`ID_Pemilik`,`ID_Penemu`,`Tanggal_Selesai`,`Status`,`Progress`) values ('TR001','B001','','5114100066','0000-00-00 00:00:00','NOT CLEAR','FOUND'),('TR002','B002','5114100104','','0000-00-00 00:00:00','NOT CLEAR','LOST');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `ID_User` varchar(15) NOT NULL,
  `Nama_User` varchar(40) NOT NULL,
  `No_Telepon` varchar(15) NOT NULL,
  `Foto` varchar(40) NOT NULL,
  `Password_user` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`ID_User`,`Nama_User`,`No_Telepon`,`Foto`,`Password_user`) values ('5114100066','Vinsensia Sipriana Zega','089673927393','','singlehappy'),('5114100076','Muhammad Faishal Ilham','085668869515','','anakgaul'),('5114100104','Fathihah Ulya Hakiem','087826382638','','akuanakio');

/* Procedure structure for procedure `sp_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login`(u_name VARCHAR(15), u_pass VARCHAR(32))
BEGIN
	IF EXISTS (SELECT * FROM users WHERE(u_name = id_user) AND (u_pass = password_user)) THEN
	SELECT 0, "Login Berhasil";
	ELSE
	SELECT -1, "Username atau password anda tidak cocok";
	END IF;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
