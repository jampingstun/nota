-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 25, 2012 at 10:41 
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `notaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `grouppemohon`
--

CREATE TABLE IF NOT EXISTS `grouppemohon` (
  `id_grouppemohon` int(11) NOT NULL AUTO_INCREMENT,
  `nm_grouppemohon` varchar(30) NOT NULL,
  `pb_grouppemohon` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_grouppemohon`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `grouppemohon`
--


-- --------------------------------------------------------

--
-- Table structure for table `grouptransaksi`
--

CREATE TABLE IF NOT EXISTS `grouptransaksi` (
  `id_grouptr` int(11) NOT NULL AUTO_INCREMENT,
  `nm_grouptr` varchar(30) NOT NULL,
  `pb_grouptr` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_grouptr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `grouptransaksi`
--


-- --------------------------------------------------------

--
-- Table structure for table `pemohon`
--

CREATE TABLE IF NOT EXISTS `pemohon` (
  `idpemohon` int(11) NOT NULL AUTO_INCREMENT,
  `idgrouppemohon` int(11) NOT NULL,
  `tgldaftarpemohon` date NOT NULL,
  `infopemohon` text NOT NULL,
  `pbpemohon` tinyint(4) NOT NULL,
  PRIMARY KEY (`idpemohon`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `pemohon`
--

INSERT INTO `pemohon` (`idpemohon`, `idgrouppemohon`, `tgldaftarpemohon`, `infopemohon`, `pbpemohon`) VALUES
(1, 1, '2012-07-18', '{"ktp":"12345","nama":"test","kota":"jogja"}\r\n', 1),
(6, 0, '0000-00-00', '{"nama":"coba","tempat":"abc","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(7, 0, '0000-00-00', '{"nama":"","tempat":"","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(8, 0, '0000-00-00', '{"nama":"","tempat":"","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(9, 0, '0000-00-00', '{"nama":"pradana","tempat":"bantul","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(10, 0, '0000-00-00', '{"nama":"lkjh","tempat":"lkjh","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(11, 0, '0000-00-00', '{"nama":"abc","tempat":"def","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(12, 0, '0000-00-00', '{"nama":"oioioi","tempat":"oioioio","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(13, 0, '0000-00-00', '{"nama":"qwert","tempat":"qwert","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(14, 0, '0000-00-00', '{"nama":"frgre","tempat":"gdfg","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(15, 0, '0000-00-00', '{"nama":"coba","tempat":"def","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(16, 0, '0000-00-00', '{"nama":"budi","tempat":"kp","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1),
(17, 0, '0000-00-00', '{"nama":"faris","tempat":"def","tglahir":"","alamat":"","agama":"","pekerjaan":"","notelp":"","grouppemohon":"something"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_index`
--

CREATE TABLE IF NOT EXISTS `tbl_index` (
  `tipe` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `isi` varchar(200) NOT NULL,
  KEY `id` (`id`),
  KEY `kode` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_index`
--

INSERT INTO `tbl_index` (`tipe`, `id`, `kode`, `isi`) VALUES
('pemohon', 1, 'ktp', '123456'),
('pemohon', 1, 'nama', 'test'),
('pemohon', 1, 'user', '{"user":"test","password":"1234"}'),
('pemohon', 12, 'tempat', 'oioioio'),
('pemohon', 13, 'tempat', 'qwert'),
('pemohon', 14, 'nama', 'frgre'),
('pemohon', 14, 'tempat', 'gdfg'),
('pemohon', 15, 'nama', 'coba'),
('pemohon', 15, 'tempat', 'def'),
('pemohon', 16, 'nama', 'budi'),
('pemohon', 16, 'tempat', 'kp'),
('pemohon', 17, 'nama', 'faris'),
('pemohon', 17, 'tempat', 'def');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tglmasuk` date NOT NULL,
  `id_pemohon` int(11) NOT NULL,
  `id_grouptr` int(11) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `jmlberkas` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `jmlberkasselesai` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `sudahbayar` int(11) NOT NULL,
  `tglselesai` date NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `transaksi`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `akses` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `akses`) VALUES
('admin', 'admin', 'admin');
