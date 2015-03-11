# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.17)
# Database: ksp
# Generation Time: 2015-03-11 01:04:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cicilan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cicilan`;

CREATE TABLE `cicilan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_nasabah` int(11) DEFAULT NULL,
  `cicilan_ke` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table keanggotaan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `keanggotaan`;

CREATE TABLE `keanggotaan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `jenis` varchar(100) DEFAULT NULL,
  `simpanan_pokok` int(11) DEFAULT NULL,
  `simpanan_wajib` int(11) DEFAULT NULL,
  `bunga_simpanan` float DEFAULT NULL,
  `denda_pinjaman` float DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `keanggotaan` WRITE;
/*!40000 ALTER TABLE `keanggotaan` DISABLE KEYS */;

INSERT INTO `keanggotaan` (`id`, `jenis`, `simpanan_pokok`, `simpanan_wajib`, `bunga_simpanan`, `denda_pinjaman`, `keterangan`)
VALUES
	(1,'Masyarakat',500,0,0.5,0.2,'Setelah simpanan di atas Rp. 1 juta'),
	(2,'Anggota',500,5000,0.7,0.2,'Setelah ada saldo simpanan pokok'),
	(3,'Siswa',0,0,0,0.2,'Tanpa jasa');

/*!40000 ALTER TABLE `keanggotaan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table nasabah
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nasabah`;

CREATE TABLE `nasabah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `departemen` varchar(40) DEFAULT '',
  `alamat` varchar(200) DEFAULT NULL,
  `hp` varchar(50) DEFAULT NULL,
  `keanggotaan_id` int(11) DEFAULT NULL,
  `tgl_masuk` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table pinjaman
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pinjaman`;

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_nasabah` int(11) NOT NULL,
  `jenis` enum('Uang','Barang') NOT NULL,
  `jumlah` int(20) NOT NULL,
  `lama` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table preference
# ------------------------------------------------------------

DROP TABLE IF EXISTS `preference`;

CREATE TABLE `preference` (
  `attr` varchar(200) DEFAULT NULL,
  `value` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `preference` WRITE;
/*!40000 ALTER TABLE `preference` DISABLE KEYS */;

INSERT INTO `preference` (`attr`, `value`)
VALUES
	('last_check_bunga','');

/*!40000 ALTER TABLE `preference` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table simpanan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `simpanan`;

CREATE TABLE `simpanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_nasabah` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('Pokok','Wajib','Sukarela','Bunga','Ambil') NOT NULL,
  `jumlah` float NOT NULL,
  `sld` float DEFAULT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `level` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `nama`, `level`, `username`, `password`)
VALUES
	(1,'Aris Setyono','admin','aris','288077f055be4fadc3804a69422dd4f8'),
	(5,'Administrator','admin','admin','21232f297a57a5a743894a0e4a801fc3'),
	(6,'teller','teller','teller','8482dfb1bca15b503101eb438f52deed');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
