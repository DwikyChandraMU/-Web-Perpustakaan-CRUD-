-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.11.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for perpustakaan
CREATE DATABASE IF NOT EXISTS `perpustakaan` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */;
USE `perpustakaan`;

-- Dumping structure for table perpustakaan.anggota
CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id_anggota`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table perpustakaan.anggota: ~5 rows (approximately)
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` (`id_anggota`, `nama`) VALUES
	(1101, 'Febriana Susilowati'),
	(1102, 'Dwiky Chandra Mulyo Utomo'),
	(1103, 'Eva Sopitri'),
	(1104, 'M. Sirrajuth Thayyib'),
	(1105, 'Maulana Ishak');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.buku
CREATE TABLE IF NOT EXISTS `buku` (
  `ISBN` int(11) NOT NULL,
  `judul_buku` varchar(50) DEFAULT NULL,
  `jenis_buku` varchar(30) DEFAULT NULL,
  `jumlah_ketersediaan` int(11) DEFAULT NULL,
  `kode_rak` char(5) DEFAULT NULL,
  PRIMARY KEY (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table perpustakaan.buku: ~8 rows (approximately)
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` (`ISBN`, `judul_buku`, `jenis_buku`, `jumlah_ketersediaan`, `kode_rak`) VALUES
	(24010901, 'Rindu Untuk Ayah', 'FIKSI', 35, 'F24'),
	(24010902, 'Angkasa dan 56 Hari', 'FIKSI', 30, 'F24'),
	(24010903, 'Orang - orang Biasa', 'FIKSI', 20, 'F24'),
	(24010904, 'Laskar Pelangi', 'FIKSI', 40, 'F24'),
	(24010905, 'Filosofi Teras', 'NON FIKSI', 35, 'NF23'),
	(24010906, 'Biografi Gus Dur', 'NON FIKSI', 35, 'NF23'),
	(24010907, 'Catatan Seorang Demonstran', 'NON FIKSI', 40, 'NF23'),
	(24010908, 'Perempuan dan Literasi', 'NON FIKSI', 40, 'NF23');
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;

-- Dumping structure for procedure perpustakaan.delete_buku
DELIMITER //
CREATE PROCEDURE `delete_buku`()
BEGIN
    DELETE FROM buku WHERE ISBN = ISBN;
END//
DELIMITER ;

-- Dumping structure for procedure perpustakaan.delete_peminjam
DELIMITER //
CREATE PROCEDURE `delete_peminjam`()
BEGIN
DELETE FROM peminjaman WHERE id_peminjam = id_peminjam;
END//
DELIMITER ;

-- Dumping structure for function perpustakaan.jumlah_data
DELIMITER //
CREATE FUNCTION `jumlah_data`() RETURNS int(11)
BEGIN
DECLARE total INT;
SELECT COUNT(*) INTO total FROM buku;
RETURN total;
END//
DELIMITER ;

-- Dumping structure for table perpustakaan.laporan
CREATE TABLE IF NOT EXISTS `laporan` (
  `id_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `riwayat` varchar(15) DEFAULT NULL,
  `ISBN` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `id_peminjam` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_laporan`) USING BTREE,
  KEY `FK_laporan_buku` (`ISBN`),
  KEY `FK_laporan_anggota` (`id_peminjam`),
  CONSTRAINT `FK_laporan_anggota` FOREIGN KEY (`id_peminjam`) REFERENCES `anggota` (`id_anggota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_laporan_buku` FOREIGN KEY (`ISBN`) REFERENCES `buku` (`ISBN`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table perpustakaan.laporan: ~1 rows (approximately)
/*!40000 ALTER TABLE `laporan` DISABLE KEYS */;
INSERT INTO `laporan` (`id_laporan`, `riwayat`, `ISBN`, `tanggal`, `id_peminjam`) VALUES
	(16, 'Peminjaman', 24010908, '2024-01-09 03:35:05', 1101),
	(17, 'Peminjaman', 24010907, '2024-01-09 03:37:34', 1102),
	(18, 'Peminjaman', 24010905, '2024-01-09 03:38:25', 1103),
	(19, 'Peminjaman', 24010906, '2024-01-09 03:38:41', 1104),
	(20, 'Peminjaman', 24010904, '2024-01-09 03:38:50', 1105);
/*!40000 ALTER TABLE `laporan` ENABLE KEYS */;

-- Dumping structure for table perpustakaan.peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `ISBN` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `id_peminjam` int(11) NOT NULL,
  PRIMARY KEY (`id_peminjam`),
  KEY `isbn` (`ISBN`),
  CONSTRAINT `id_peminjam` FOREIGN KEY (`id_peminjam`) REFERENCES `anggota` (`id_anggota`),
  CONSTRAINT `isbn` FOREIGN KEY (`ISBN`) REFERENCES `buku` (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table perpustakaan.peminjaman: ~1 rows (approximately)
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` (`ISBN`, `tanggal`, `id_peminjam`) VALUES
	(24010908, '2024-01-09 03:35:05', 1101),
	(24010907, '2024-01-09 03:37:34', 1102),
	(24010905, '2024-01-09 03:38:25', 1103),
	(24010906, '2024-01-09 03:38:41', 1104),
	(24010904, '2024-01-09 03:38:50', 1105);
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;

-- Dumping structure for view perpustakaan.peminjaman_buku
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `peminjaman_buku` (
	`ISBN` INT(11) NULL,
	`id_peminjam` INT(11) NOT NULL,
	`judul_buku` VARCHAR(50) NULL COLLATE 'utf8mb4_general_ci',
	`jenis_buku` VARCHAR(30) NULL COLLATE 'utf8mb4_general_ci',
	`nama` VARCHAR(35) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for procedure perpustakaan.tambah_anggota
DELIMITER //
CREATE PROCEDURE `tambah_anggota`()
BEGIN
	INSERT INTO anggota(id_anggota, nama) VALUES (id_anggota, nama);
END//
DELIMITER ;

-- Dumping structure for procedure perpustakaan.tambah_buku
DELIMITER //
CREATE PROCEDURE `tambah_buku`()
BEGIN
	INSERT INTO buku(ISBN, judul_buku, jenis_buku, jumlah_ketersediaan, kode_rak) VALUES (ISBN, judul_buku, jenis_buku, jumlah_ketersediaan, kode_rak);
END//
DELIMITER ;

-- Dumping structure for procedure perpustakaan.tambah_pinjaman
DELIMITER //
CREATE PROCEDURE `tambah_pinjaman`()
BEGIN
	INSERT INTO peminjaman(ISBN, judul_buku, jenis_buku, kode_rak, tanggal, id_peminjam, peminjam) VALUES (ISBN, judul_buku, jenis_buku, kode_rak, tanggal, id_peminjam, peminjam);
END//
DELIMITER ;

-- Dumping structure for trigger perpustakaan.peminjaman
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `peminjaman` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
	INSERT INTO laporan (riwayat, ISBN, tanggal, id_peminjam) VALUES ("Peminjaman",
	NEW.ISBN, NOW(), NEW.id_peminjam);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger perpustakaan.peminjaman_before_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `peminjaman_before_delete` BEFORE DELETE ON `peminjaman` FOR EACH ROW BEGIN
	INSERT INTO laporan (riwayat, ISBN, tanggal, id_peminjam) VALUES ("Pengembalian",
	OLD.ISBN, NOW(), OLD.id_peminjam);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for view perpustakaan.peminjaman_buku
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `peminjaman_buku`;
CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW `peminjaman_buku` AS SELECT 
peminjaman.ISBN,
peminjaman.id_peminjam,
buku.judul_buku,
buku.jenis_buku,
anggota.nama
FROM peminjaman
JOIN buku ON peminjaman.ISBN = buku.ISBN
JOIN anggota ON peminjaman.id_peminjam = anggota.id_anggota
WHERE peminjaman.ISBN = buku.ISBN and peminjaman.id_peminjam = anggota.id_anggota ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
