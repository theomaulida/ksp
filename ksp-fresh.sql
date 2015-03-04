-- phpMyAdmin SQL Dump
-- version 4.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2015 at 08:22 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ksp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cicilan`
--

CREATE TABLE IF NOT EXISTS `cicilan` (
`id` int(11) NOT NULL,
  `kode_nasabah` int(11) DEFAULT NULL,
  `cicilan_ke` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cicilan`
--

INSERT INTO `cicilan` (`id`, `kode_nasabah`, `cicilan_ke`, `jumlah`, `tanggal`) VALUES
(1, 2, 1, 100000, '2014-04-27'),
(2, 1, 1, 20965000, '2014-05-24'),
(3, 1, 2, 20676250, '2014-05-25'),
(4, 1, 1, 833, '2015-02-19');

-- --------------------------------------------------------

--
-- Table structure for table `import_temp`
--

CREATE TABLE IF NOT EXISTS `import_temp` (
  `kode` int(11) NOT NULL,
  `amount` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `import_temp`
--

INSERT INTO `import_temp` (`kode`, `amount`) VALUES
(1, 20000),
(926, 1115500),
(967, 4359850),
(1119, 12734361),
(1155, 7000000),
(1160, 5000000),
(1244, 3188630),
(1281, 3677687),
(1309, 4198611),
(1316, 4716667),
(1395, 3225209),
(1408, 4022783),
(1440, 7590625),
(1467, 5751627),
(1503, 9797760),
(1509, 5524750),
(1543, 11540921),
(1547, 4507950),
(1548, 9545259),
(1554, 4352238),
(1556, 7946726),
(1558, 10000000),
(1563, 2571662),
(1566, 7218003),
(1572, 4326625),
(1575, 9474383),
(1634, 4336111);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE IF NOT EXISTS `nasabah` (
`id` int(11) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `departemen` varchar(40) NOT NULL,
  `tgl_masuk` varchar(20) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id`, `kode`, `nama`, `departemen`, `tgl_masuk`) VALUES
(1, '001', 'Aris', '', '18 Feb 2015');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE IF NOT EXISTS `pinjaman` (
`id` int(11) NOT NULL,
  `kode_nasabah` int(11) NOT NULL,
  `jenis` enum('Uang','Barang') NOT NULL,
  `jumlah` int(20) NOT NULL,
  `lama` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `kode_nasabah`, `jenis`, `jumlah`, `lama`, `tanggal`, `status`) VALUES
(1, 1, 'Uang', 20000000, 24, '2015-02-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE IF NOT EXISTS `simpanan` (
`id` int(11) NOT NULL,
  `kode_nasabah` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('Pokok','Wajib','Sukarela','Surplus','Ambil') NOT NULL,
  `jumlah` int(20) NOT NULL,
  `sld` int(20) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id`, `kode_nasabah`, `tanggal`, `jenis`, `jumlah`, `sld`, `created`) VALUES
(1, '001', '2015-02-19', 'Sukarela', 100000, 100000, 1424333600);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `level`, `username`, `password`) VALUES
(1, 'Aris Setyono', 'admin', 'aris', '288077f055be4fadc3804a69422dd4f8'),
(5, 'Administrator', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(6, 'teller', 'teller', 'teller', '8482dfb1bca15b503101eb438f52deed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cicilan`
--
ALTER TABLE `cicilan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_temp`
--
ALTER TABLE `import_temp`
 ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cicilan`
--
ALTER TABLE `cicilan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
