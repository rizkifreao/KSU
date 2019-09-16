-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.35-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ksu_paksi
CREATE DATABASE IF NOT EXISTS `ksu_paksi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ksu_paksi`;

-- Dumping structure for table ksu_paksi.item
CREATE TABLE IF NOT EXISTS `item` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `nama_item` varchar(255) DEFAULT NULL,
  `stokakhir` int(255) DEFAULT NULL,
  `satuanid` int(255) DEFAULT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

-- Dumping data for table ksu_paksi.item: ~4 rows (approximately)
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` (`itemid`, `nama_item`, `stokakhir`, `satuanid`) VALUES
	(114, 'Ciki', 0, 2),
	(115, 'Rokok Magnum', 10, 7),
	(116, 'Cokolatos', 20, 2),
	(117, 'ABC Kopi', 0, 2),
	(118, 'TEST', 5, 1);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;

-- Dumping structure for table ksu_paksi.mst_satuan
CREATE TABLE IF NOT EXISTS `mst_satuan` (
  `satuanid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`satuanid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ksu_paksi.mst_satuan: ~4 rows (approximately)
/*!40000 ALTER TABLE `mst_satuan` DISABLE KEYS */;
INSERT INTO `mst_satuan` (`satuanid`, `nama`) VALUES
	(1, 'Dus'),
	(2, 'Buah'),
	(3, 'Set'),
	(6, 'Liter'),
	(7, 'Bungkus');
/*!40000 ALTER TABLE `mst_satuan` ENABLE KEYS */;

-- Dumping structure for table ksu_paksi.pembelian
CREATE TABLE IF NOT EXISTS `pembelian` (
  `pembelianid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `nofaktur` varchar(50) DEFAULT NULL,
  `suplier` varchar(50) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tanggal_datang` datetime DEFAULT NULL,
  PRIMARY KEY (`pembelianid`),
  KEY `userid` (`userid`),
  CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `sys_user` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- Dumping data for table ksu_paksi.pembelian: ~3 rows (approximately)
/*!40000 ALTER TABLE `pembelian` DISABLE KEYS */;
INSERT INTO `pembelian` (`pembelianid`, `userid`, `nofaktur`, `suplier`, `tanggal`, `total`, `tanggal_datang`) VALUES
	(59, 1, '9664377646611870', NULL, '2019-09-04 00:00:00', 500, NULL),
	(60, 1, '9664377646611871', 'PT ABC', '2019-09-04 00:00:00', 10000, NULL),
	(61, 1, '9664377646611873', 'PT ABC', '2019-09-05 00:00:00', 264000, NULL);
/*!40000 ALTER TABLE `pembelian` ENABLE KEYS */;

-- Dumping structure for table ksu_paksi.pembelian_detail
CREATE TABLE IF NOT EXISTS `pembelian_detail` (
  `pembeliandetailid` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) DEFAULT NULL,
  `jumlah` int(255) DEFAULT NULL,
  `hargasatuan` int(255) DEFAULT NULL,
  `total` int(255) DEFAULT NULL,
  `pembelianid` int(11) DEFAULT NULL,
  PRIMARY KEY (`pembeliandetailid`),
  KEY `sparepartid` (`itemid`),
  KEY `pembelianid` (`pembelianid`),
  CONSTRAINT `pembelian_detail_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `item` (`itemid`),
  CONSTRAINT `pembelian_detail_ibfk_2` FOREIGN KEY (`pembelianid`) REFERENCES `pembelian` (`pembelianid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ksu_paksi.pembelian_detail: ~6 rows (approximately)
/*!40000 ALTER TABLE `pembelian_detail` DISABLE KEYS */;
INSERT INTO `pembelian_detail` (`pembeliandetailid`, `itemid`, `jumlah`, `hargasatuan`, `total`, `pembelianid`) VALUES
	(2, 114, 1, 500, 500, 59),
	(3, NULL, NULL, NULL, 0, NULL),
	(4, NULL, NULL, NULL, 0, NULL),
	(5, 118, 5, 12000, 60000, 61),
	(6, 115, 12, 17000, 204000, 61),
	(7, 116, 20, 500, 10000, 60);
/*!40000 ALTER TABLE `pembelian_detail` ENABLE KEYS */;

-- Dumping structure for table ksu_paksi.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `penjualanid` int(11) NOT NULL AUTO_INCREMENT,
  `nomorfaktur` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `tanggal_faktur` datetime DEFAULT NULL,
  `tanggal_cetak` datetime DEFAULT NULL,
  `total` int(255) DEFAULT NULL,
  `woid` int(11) DEFAULT NULL,
  PRIMARY KEY (`penjualanid`),
  KEY `userid` (`userid`),
  KEY `woid` (`woid`),
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `sys_user` (`userid`),
  CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`woid`) REFERENCES `workorder` (`workorderid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ksu_paksi.penjualan: ~6 rows (approximately)
/*!40000 ALTER TABLE `penjualan` DISABLE KEYS */;
INSERT INTO `penjualan` (`penjualanid`, `nomorfaktur`, `userid`, `tanggal_faktur`, `tanggal_cetak`, `total`, `woid`) VALUES
	(1, 'FA92', 1, '2019-09-04 00:00:00', NULL, 0, 92),
	(2, 'FA93', 1, '2019-09-04 00:00:00', NULL, 0, 93),
	(3, 'FA94', 1, '2019-09-04 00:00:00', NULL, 0, 94),
	(4, 'FA94', 1, '2019-08-04 00:00:00', NULL, 0, 94),
	(5, 'FA94', 1, '2018-08-04 00:00:00', NULL, 0, 94),
	(6, 'FA95', 1, '2019-09-05 00:00:00', NULL, 0, 95),
	(7, 'FA97', 1, '2019-09-05 00:00:00', NULL, 0, 97);
/*!40000 ALTER TABLE `penjualan` ENABLE KEYS */;

-- Dumping structure for table ksu_paksi.sys_log
CREATE TABLE IF NOT EXISTS `sys_log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `idPenerima` int(11) DEFAULT NULL,
  `aksi` text,
  `waktu` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `path` text,
  `statusNotif` int(11) DEFAULT '0',
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ksu_paksi.sys_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `sys_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_log` ENABLE KEYS */;

-- Dumping structure for table ksu_paksi.sys_user
CREATE TABLE IF NOT EXISTS `sys_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `jabatan` enum('Administrator','Kasir','Manager','Kepala Gudang','Service Advisor') DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ksu_paksi.sys_user: ~5 rows (approximately)
/*!40000 ALTER TABLE `sys_user` DISABLE KEYS */;
INSERT INTO `sys_user` (`userid`, `nama`, `jabatan`, `password`) VALUES
	(1, 'Administrator', 'Administrator', '/4/9Rmz10P/qoQcwIh0RMan6Ag0Ru72oDeyreLoLNZW9sgF2xKlxHxwy9OGqV5vDweIzwlX1iJXlWlgFctXoaQ=='),
	(2, 'Kasir', 'Kasir', 'BhBXhkOBlQyHauxRJjS4nZea1527utwBs3kkdgCkEOoJ6UP8GHE+UoTosV0A9MVpqWiggS58bHOLJi8nnXsQjw=='),
	(3, 'manager', 'Manager', 'u/bcKcCiYYWwwGON8mUO0fWyRN6EOdrle8gXuQq74/wLBuinKSILwKhztdK7sXGViyHTemsbYiGEbrS9ZpilmA=='),
	(4, 'gudang', 'Kepala Gudang', 'TCobkIuzgXZlMB1fsJMb5b3ALs0frb4hzLRRZi2NPSaHCs/+vR7dj0iEky/+gJlCbfMkj3KUVTtMDzsD4oPQZw=='),
	(5, 'bengkel', 'Service Advisor', 'vN+ZZOwlvvD96ae2AyDu4H0XnU98Lc71imy2i9IWesFhGIZoGrp5mdgP/TI+ZUFAaqy9UZJEx4oPPv35kDDf4g==');
/*!40000 ALTER TABLE `sys_user` ENABLE KEYS */;

-- Dumping structure for table ksu_paksi.workorder
CREATE TABLE IF NOT EXISTS `workorder` (
  `workorderid` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `hasil` varchar(255) DEFAULT NULL,
  `tanggal_masuk` datetime DEFAULT NULL,
  `tanggal_keluar` datetime DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`workorderid`),
  KEY `userid` (`userid`),
  CONSTRAINT `workorder_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `sys_user` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- Dumping data for table ksu_paksi.workorder: ~8 rows (approximately)
/*!40000 ALTER TABLE `workorder` DISABLE KEYS */;
INSERT INTO `workorder` (`workorderid`, `nomor`, `nama`, `keterangan`, `status`, `hasil`, `tanggal_masuk`, `tanggal_keluar`, `userid`) VALUES
	(92, 'WO0', 'Wibi', 'ffff', 'F', NULL, NULL, '2019-09-04 00:00:00', 1),
	(93, 'WO92', 'admin', '', 'F', NULL, NULL, '2019-09-04 00:00:00', 1),
	(94, 'WO93', 'Wibi', '', 'F', NULL, NULL, '2019-09-04 13:56:34', 1),
	(95, 'WO95', 'Cokolatos', 'asddddd', 'F', NULL, NULL, '2019-09-05 13:43:10', 1),
	(96, 'WO95', 'AAA', '', 'NF', NULL, NULL, '2019-09-05 14:36:59', 1),
	(97, 'WO96', 'Agus', 'ngambil barang', 'F', NULL, NULL, '2019-09-05 14:45:26', 1),
	(98, 'WO97', 'Agus', '', 'NF', NULL, NULL, '2019-09-05 14:47:08', 1),
	(99, 'WO98', 'Wibi', '', NULL, NULL, NULL, '2019-09-05 15:28:10', 1);
/*!40000 ALTER TABLE `workorder` ENABLE KEYS */;

-- Dumping structure for table ksu_paksi.workorder_detail
CREATE TABLE IF NOT EXISTS `workorder_detail` (
  `detailwoid` int(11) NOT NULL AUTO_INCREMENT,
  `workorderid` int(11) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` int(255) DEFAULT NULL,
  PRIMARY KEY (`detailwoid`),
  KEY `workorderid` (`workorderid`),
  KEY `sparepartid` (`itemid`),
  CONSTRAINT `workorder_detail_ibfk_1` FOREIGN KEY (`workorderid`) REFERENCES `workorder` (`workorderid`),
  CONSTRAINT `workorder_detail_ibfk_2` FOREIGN KEY (`itemid`) REFERENCES `item` (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table ksu_paksi.workorder_detail: ~7 rows (approximately)
/*!40000 ALTER TABLE `workorder_detail` DISABLE KEYS */;
INSERT INTO `workorder_detail` (`detailwoid`, `workorderid`, `itemid`, `qty`, `total`) VALUES
	(1, 92, 114, 1, 0),
	(3, 93, 114, 10, 0),
	(5, 93, 114, 1, 0),
	(9, 94, 114, 2, 0),
	(10, 95, 114, 2, 0),
	(11, 95, 115, 1, 0),
	(12, 97, 114, 2, 0),
	(13, 97, 115, 1, 0);
/*!40000 ALTER TABLE `workorder_detail` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
