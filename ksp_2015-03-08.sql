# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.17)
# Database: ksp
# Generation Time: 2015-03-08 15:19:47 +0000
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

LOCK TABLES `cicilan` WRITE;
/*!40000 ALTER TABLE `cicilan` DISABLE KEYS */;

INSERT INTO `cicilan` (`id`, `kode_nasabah`, `cicilan_ke`, `jumlah`, `tanggal`)
VALUES
	(1,2,1,100000,'2014-04-27'),
	(2,1,1,20965000,'2014-05-24'),
	(3,1,2,20676250,'2014-05-25'),
	(4,1,1,833,'2015-02-19'),
	(5,2,1,240000,'2015-02-19');

/*!40000 ALTER TABLE `cicilan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table import_temp
# ------------------------------------------------------------

DROP TABLE IF EXISTS `import_temp`;

CREATE TABLE `import_temp` (
  `kode` int(11) NOT NULL,
  `amount` int(20) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `import_temp` WRITE;
/*!40000 ALTER TABLE `import_temp` DISABLE KEYS */;

INSERT INTO `import_temp` (`kode`, `amount`)
VALUES
	(1,20000),
	(926,1115500),
	(967,4359850),
	(1119,12734361),
	(1155,7000000),
	(1160,5000000),
	(1244,3188630),
	(1281,3677687),
	(1309,4198611),
	(1316,4716667),
	(1395,3225209),
	(1408,4022783),
	(1440,7590625),
	(1467,5751627),
	(1503,9797760),
	(1509,5524750),
	(1543,11540921),
	(1547,4507950),
	(1548,9545259),
	(1554,4352238),
	(1556,7946726),
	(1558,10000000),
	(1563,2571662),
	(1566,7218003),
	(1572,4326625),
	(1575,9474383),
	(1634,4336111);

/*!40000 ALTER TABLE `import_temp` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `nasabah` WRITE;
/*!40000 ALTER TABLE `nasabah` DISABLE KEYS */;

INSERT INTO `nasabah` (`id`, `kode`, `nama`, `departemen`, `alamat`, `hp`, `keanggotaan_id`, `tgl_masuk`)
VALUES
	(1,'001','Aris Setyono','','Trenggalek','085259838599',1,'2014-11-11'),
	(2,'002','setyo','','','',1,'2015-02-08'),
	(3,'003','agus','','','',3,'2014-07-01'),
	(4,'004','Budi Waseso','Dalam Negeri','Jakarta Utara','085259838599',2,'2015-03-12');

/*!40000 ALTER TABLE `nasabah` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `pinjaman` WRITE;
/*!40000 ALTER TABLE `pinjaman` DISABLE KEYS */;

INSERT INTO `pinjaman` (`id`, `kode_nasabah`, `jenis`, `jumlah`, `lama`, `tanggal`, `status`)
VALUES
	(1,1,'Uang',20000000,24,'2015-02-19','1'),
	(2,2,'Uang',2000000,10,'2015-02-19','1');

/*!40000 ALTER TABLE `pinjaman` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table simpanan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `simpanan`;

CREATE TABLE `simpanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_nasabah` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('Pokok','Wajib','Sukarela','Surplus','Ambil') NOT NULL,
  `jumlah` int(20) NOT NULL,
  `sld` int(20) DEFAULT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `simpanan` WRITE;
/*!40000 ALTER TABLE `simpanan` DISABLE KEYS */;

INSERT INTO `simpanan` (`id`, `kode_nasabah`, `tanggal`, `jenis`, `jumlah`, `sld`, `created`)
VALUES
	(1,'001','2015-02-19','Sukarela',100000,100000,1424333600),
	(2,'002','2015-02-19','Pokok',50000,50000,1424335277),
	(3,'002','2015-02-19','Wajib',200000,250000,1424335334),
	(4,'002','2015-02-19','Sukarela',300000,550000,1424335386),
	(5,'002','2014-11-05','Sukarela',200000,750000,1424335453),
	(6,'002','2015-02-19','Ambil',-25000,725000,1424335580),
	(7,'004','2015-03-08','Wajib',5000,5000,1425818153),
	(8,'001','2015-03-08','Pokok',500,100500,1425826779);

/*!40000 ALTER TABLE `simpanan` ENABLE KEYS */;
UNLOCK TABLES;


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
