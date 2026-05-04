-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.45 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.15.0.7171
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk sekolahh
CREATE DATABASE IF NOT EXISTS `sekolahh` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sekolahh`;

-- membuang struktur untuk table sekolahh.tabel_menu
CREATE TABLE IF NOT EXISTS `tabel_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `icon` varchar(25) NOT NULL,
  `is_main_menu` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tabel_menu: ~22 rows (lebih kurang)
INSERT INTO `tabel_menu` (`id`, `nama_menu`, `link`, `icon`, `is_main_menu`) VALUES
	(1, 'Data Siswa', 'siswa', 'fa fa-users', 0),
	(2, 'Data Guru', 'guru', 'fa fa-user-circle', 0),
	(3, 'Data Master', '#', 'fa fa-bars', 0),
	(4, 'Mata Pelajaran', 'mapel', 'fa fa-book', 3),
	(5, 'Ruangan Kelas', 'ruangan', 'fa fa-building', 3),
	(6, 'Tingkatan Kelas', 'tingkatan', 'fa fa-sitemap', 3),
	(7, 'Jurusan', 'jurusan', 'fa fa-th-large', 3),
	(8, 'Tahun Akademik', 'tahunakademik', 'fa fa-calendar-check-o', 3),
	(9, 'Kelas', 'kelas', 'fa fa-cubes', 3),
	(10, 'Kurikulum', 'kurikulum', 'fa fa-list', 3),
	(11, 'Jadwal Pelajaran', 'jadwal', 'fa fa-calendar-plus-o', 0),
	(12, 'Peserta Didik', 'siswa/siswa_aktif', 'fa fa-users', 0),
	(13, 'Walikelas', 'walikelas', 'fa fa-user-plus', 0),
	(14, 'Pengguna Sistem', 'user', 'fa fa-id-badge', 0),
	(15, 'Menu', 'menu', 'fa fa-list', 0),
	(16, 'Form Pembayaran', 'pembayaran', 'fa fa-dollar', 0),
	(17, 'Nilai', 'nilai', 'fa fa-archive', 0),
	(18, 'Laporan Nilai', 'laporan_nilai', 'fa fa-file-pdf-o', 0),
	(19, 'Wali Kelas', '#', 'fa fa-graduation-cap', 0),
	(20, 'Portal Wali Kelas', 'portal_walikelas', 'fa fa-dashboard', 19),
	(21, 'Siswa Kelas', 'wk_siswa', 'fa fa-users', 19),
	(22, 'Tambah Walikelas', 'walikelas/add', 'fa fa-user-plus', 0);

-- membuang struktur untuk table sekolahh.tbl_agama
CREATE TABLE IF NOT EXISTS `tbl_agama` (
  `kd_agama` int NOT NULL,
  `nama_agama` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_agama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_agama: ~7 rows (lebih kurang)
INSERT INTO `tbl_agama` (`kd_agama`, `nama_agama`) VALUES
	(1, 'ISLAM'),
	(2, 'KRISTEN/ PROTESTAN'),
	(3, 'KATHOLIK'),
	(4, 'HINDU'),
	(5, 'BUDHA'),
	(6, 'KHONG HU CHU'),
	(99, 'LAIN LAIN');

-- membuang struktur untuk table sekolahh.tbl_guru
CREATE TABLE IF NOT EXISTS `tbl_guru` (
  `id_guru` int NOT NULL AUTO_INCREMENT,
  `nuptk` varchar(11) NOT NULL,
  `nama_guru` varchar(40) NOT NULL,
  `gender` enum('P','W') NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_guru: ~4 rows (lebih kurang)
INSERT INTO `tbl_guru` (`id_guru`, `nuptk`, `nama_guru`, `gender`, `username`, `password`) VALUES
	(0, '00000000000', 'Default', 'W', '', ''),
	(1, '00000000001', 'Fajri, S.Pd.I', 'P', 'fajri', 'e10adc3949ba59abbe56e057f20f883e'),
	(2, '00000000002', 'Teuku Tommy Yanuar Satria, S.Pd.I', 'P', '', ''),
	(3, '00000000003', 'Mariyadi, A.Md', 'P', '', '');

-- membuang struktur untuk table sekolahh.tbl_jadwal
CREATE TABLE IF NOT EXISTS `tbl_jadwal` (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_tahun_akademik` int NOT NULL,
  `semester` varchar(10) NOT NULL,
  `kd_jurusan` varchar(5) NOT NULL,
  `kd_tingkatan` varchar(5) NOT NULL,
  `kd_kelas` varchar(5) NOT NULL,
  `kd_mapel` varchar(5) NOT NULL,
  `id_guru` int NOT NULL,
  `jam` varchar(30) NOT NULL,
  `kd_ruangan` varchar(10) NOT NULL,
  `hari` varchar(10) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_jadwal: ~22 rows (lebih kurang)
INSERT INTO `tbl_jadwal` (`id_jadwal`, `id_tahun_akademik`, `semester`, `kd_jurusan`, `kd_tingkatan`, `kd_kelas`, `kd_mapel`, `id_guru`, `jam`, `kd_ruangan`, `hari`) VALUES
	(1, 1, 'ganjil', 'IPA', '7', '7-A1', 'BID1', 1, '13.00 - 13.30', 'VIIA1', 'Selasa'),
	(2, 1, 'ganjil', 'IPA', '7', '7-B1', 'BID1', 0, '', '000', ''),
	(3, 1, 'ganjil', 'IPA', '8', '8-A1', 'BID2', 0, '', '000', ''),
	(4, 1, 'ganjil', 'IPA', '8', '8-B1', 'BID2', 2, '', 'VIIIA1', ''),
	(5, 1, 'ganjil', 'IPA', '9', '9-A1', 'BID3', 0, '', '000', ''),
	(6, 1, 'ganjil', 'IPA', '9', '9-B1', 'BID3', 0, '', '000', ''),
	(7, 1, 'ganjil', 'IPA', '7', '7-A1', 'BIO1', 1, '', 'VIIA1', ''),
	(8, 1, 'ganjil', 'IPA', '7', '7-B1', 'BIO1', 0, '', '000', ''),
	(9, 1, 'ganjil', 'IPA', '8', '8-A1', 'BIO2', 0, '', '000', ''),
	(10, 1, 'ganjil', 'IPA', '8', '8-B1', 'BIO2', 1, '', 'VIIIA1', ''),
	(11, 1, 'ganjil', 'IPA', '9', '9-A1', 'BIO3', 0, '', '000', ''),
	(12, 1, 'ganjil', 'IPA', '9', '9-B1', 'BIO3', 0, '', '000', ''),
	(13, 6, 'ganjil', 'IPA', '6', '6-A', 'BID1', 0, '', '000', ''),
	(14, 6, 'ganjil', 'IPA', '6', '6-A', 'MTK1', 0, '', '000', ''),
	(16, 6, 'ganjil', 'IPA', '7', '7-B1', 'BID1', 0, '', '000', ''),
	(18, 6, 'ganjil', 'IPA', '7', '7-B1', 'BIO1', 0, '', '000', ''),
	(19, 6, 'ganjil', 'IPA', '7', '7-A1', 'MTK1', 0, '', '000', ''),
	(20, 6, 'ganjil', 'IPA', '7', '7-B1', 'MTK1', 0, '', '000', ''),
	(24, 6, 'ganjil', 'IPA', '5', '5-A', 'BID1', 1, '', '000', ''),
	(25, 6, 'ganjil', 'IPA', '5', '5-A', 'BIO2', 1, '', '000', ''),
	(26, 6, 'ganjil', 'IPA', '3', '3-A', 'BID1', 0, '', '000', ''),
	(27, 6, 'ganjil', '', '1', '1-A', 'BID1', 1, '', '000', '');

-- membuang struktur untuk table sekolahh.tbl_jurusan
CREATE TABLE IF NOT EXISTS `tbl_jurusan` (
  `kd_jurusan` varchar(5) NOT NULL,
  `nama_jurusan` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_jurusan: ~2 rows (lebih kurang)
INSERT INTO `tbl_jurusan` (`kd_jurusan`, `nama_jurusan`) VALUES
	('IPA', 'IPA'),
	('IPS', 'IPS');

-- membuang struktur untuk table sekolahh.tbl_kelas
CREATE TABLE IF NOT EXISTS `tbl_kelas` (
  `kd_kelas` varchar(5) NOT NULL,
  `nama_kelas` varchar(30) NOT NULL,
  `kd_tingkatan` varchar(5) NOT NULL,
  `kd_jurusan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_kelas`),
  KEY `fk_kelas_tingkatan` (`kd_tingkatan`),
  CONSTRAINT `fk_kelas_tingkatan` FOREIGN KEY (`kd_tingkatan`) REFERENCES `tbl_tingkatan_kelas` (`kd_tingkatan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_kelas: ~20 rows (lebih kurang)
INSERT INTO `tbl_kelas` (`kd_kelas`, `nama_kelas`, `kd_tingkatan`, `kd_jurusan`) VALUES
	('1-A', '1-A', '1', NULL),
	('1-B', '1-B', '1', NULL),
	('2-A', '2-A', '2', NULL),
	('2-B', '2-B', '2', NULL),
	('3-A', '3-A', '3', 'IPA'),
	('4-A', '4-A', '4', 'IPA'),
	('5-A', '5-A', '5', 'IPA'),
	('6-A', '6-A', '6', 'IPA'),
	('7-A1', 'Kelas 7-A IPA', '7', 'IPA'),
	('7-A2', 'Kelas 7-A IPS', '7', 'IPS'),
	('7-B1', 'Kelas 7-B IPA', '7', 'IPA'),
	('7-B2', 'Kelas 7-B IPS', '7', 'IPS'),
	('8-A1', 'Kelas 8-A IPA', '8', 'IPA'),
	('8-A2', 'Kelas 8-A IPS', '8', 'IPS'),
	('8-B1', 'Kelas 8-B IPA', '8', 'IPA'),
	('8-B2', 'Kelas 8-B IPS', '8', 'IPS'),
	('9-A1', 'Kelas 9-A IPA', '9', 'IPA'),
	('9-A2', 'Kelas 9-A IPS', '9', 'IPS'),
	('9-B1', 'Kelas 9-B IPA', '9', 'IPA'),
	('9-B2', 'Kelas 9-B IPS', '9', 'IPS');

-- membuang struktur untuk table sekolahh.tbl_kurikulum
CREATE TABLE IF NOT EXISTS `tbl_kurikulum` (
  `id_kurikulum` int NOT NULL AUTO_INCREMENT,
  `nama_kurikulum` varchar(30) NOT NULL,
  `is_aktif` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id_kurikulum`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_kurikulum: ~4 rows (lebih kurang)
INSERT INTO `tbl_kurikulum` (`id_kurikulum`, `nama_kurikulum`, `is_aktif`) VALUES
	(1, 'Kurikulum 2013 (K13)', 'Y'),
	(2, 'Kurikulum 2006 (KTSP)', 'N'),
	(3, 'Kurikulum 2004 (KBK)', 'N'),
	(4, 'Kurikulum Merdeka (KM)', 'N');

-- membuang struktur untuk table sekolahh.tbl_kurikulum_detail
CREATE TABLE IF NOT EXISTS `tbl_kurikulum_detail` (
  `id_kurikulum_detail` int NOT NULL AUTO_INCREMENT,
  `id_kurikulum` int NOT NULL,
  `kd_mapel` varchar(5) NOT NULL,
  `kd_jurusan` varchar(5) NOT NULL,
  `kd_tingkatan` varchar(5) NOT NULL,
  PRIMARY KEY (`id_kurikulum_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_kurikulum_detail: ~13 rows (lebih kurang)
INSERT INTO `tbl_kurikulum_detail` (`id_kurikulum_detail`, `id_kurikulum`, `kd_mapel`, `kd_jurusan`, `kd_tingkatan`) VALUES
	(1, 1, 'BID1', 'IPA', '7'),
	(2, 1, 'BID2', 'IPA', '8'),
	(3, 1, 'BID3', 'IPA', '9'),
	(4, 1, 'BIO1', 'IPA', '7'),
	(5, 1, 'BIO2', 'IPA', '8'),
	(6, 1, 'BIO3', 'IPA', '9'),
	(7, 1, 'BID1', 'IPA', '6'),
	(8, 1, 'MTK1', 'IPA', '6'),
	(9, 1, 'MTK1', 'IPA', '7'),
	(10, 1, 'BID1', 'IPA', '5'),
	(11, 1, 'BIO2', 'IPA', '5'),
	(12, 1, 'BID1', 'IPA', '3'),
	(13, 1, 'BID1', '', '1');

-- membuang struktur untuk table sekolahh.tbl_level_user
CREATE TABLE IF NOT EXISTS `tbl_level_user` (
  `id_level_user` int NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(30) NOT NULL,
  PRIMARY KEY (`id_level_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_level_user: ~4 rows (lebih kurang)
INSERT INTO `tbl_level_user` (`id_level_user`, `nama_level`) VALUES
	(1, 'Admin'),
	(2, 'Walikelas'),
	(3, 'Guru'),
	(4, 'Keuangan');

-- membuang struktur untuk table sekolahh.tbl_mapel
CREATE TABLE IF NOT EXISTS `tbl_mapel` (
  `kd_mapel` varchar(5) NOT NULL,
  `nama_mapel` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_mapel: ~15 rows (lebih kurang)
INSERT INTO `tbl_mapel` (`kd_mapel`, `nama_mapel`) VALUES
	('BID1', 'Bahasa Indonesia 1'),
	('BID2', 'Bahasa Indonesia 2'),
	('BID3', 'Bahasa Indonesia 3'),
	('BING', 'BAHASA INGGRISS'),
	('BIO1', 'Biologi 1'),
	('BIO2', 'Biologi 2'),
	('BIO3', 'Biologi 3'),
	('MTK1', 'Matematika 1'),
	('MTK2', 'Matematika 2'),
	('MTK3', 'Matematika 3'),
	('PAI1', 'Pendidikan Agama Islam 1'),
	('PAI2', 'Pendidikan Agama Islam 2'),
	('PAI3', 'Pendidikan Agama Islam 3'),
	('PJOK', 'Penjaskes'),
	('pkn', 'ppkn');

-- membuang struktur untuk table sekolahh.tbl_nilai
CREATE TABLE IF NOT EXISTS `tbl_nilai` (
  `id_nilai` int NOT NULL AUTO_INCREMENT,
  `id_jadwal` int NOT NULL,
  `nim` varchar(11) NOT NULL,
  `nilai` int NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_nilai: ~11 rows (lebih kurang)
INSERT INTO `tbl_nilai` (`id_nilai`, `id_jadwal`, `nim`, `nilai`) VALUES
	(1, 1, '18SI1000', 100),
	(2, 1, '18SI1001', 80),
	(3, 1, '18SI1002', 75),
	(4, 1, '18SI1003', 85),
	(5, 1, '18TI2000', 90),
	(6, 1, '18TI2001', 100),
	(7, 1, '18TI2002', 99),
	(8, 1, '18TI2003', 99),
	(9, 24, '1111', 100),
	(10, 7, '23412', 100),
	(11, 1, '23412', 100);

-- membuang struktur untuk table sekolahh.tbl_riwayat_kelas
CREATE TABLE IF NOT EXISTS `tbl_riwayat_kelas` (
  `id_riwayat` int NOT NULL AUTO_INCREMENT,
  `kd_kelas` varchar(5) NOT NULL,
  `nim` varchar(11) NOT NULL,
  `id_tahun_akademik` int NOT NULL,
  PRIMARY KEY (`id_riwayat`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_riwayat_kelas: ~18 rows (lebih kurang)
INSERT INTO `tbl_riwayat_kelas` (`id_riwayat`, `kd_kelas`, `nim`, `id_tahun_akademik`) VALUES
	(1, '7-A1', '18SI1000', 1),
	(2, '7-A1', '18SI1001', 1),
	(3, '7-A1', '18SI1002', 1),
	(4, '7-A1', '18SI1003', 1),
	(5, '7-A1', '18TI2000', 1),
	(6, '7-A1', '18TI2001', 1),
	(7, '7-A1', '18TI2002', 1),
	(8, '7-A1', '18TI2003', 1),
	(9, '7-A1', '', 1),
	(10, '8-A1', '14.12.8199', 1),
	(11, '8-B1', '14.12.8198', 1),
	(12, '6-A', '12345', 1),
	(15, '5-A', 'E020323012', 6),
	(16, '5-A', '1111', 6),
	(17, '4-A', '12345', 6),
	(18, '1-A', '555426472', 6),
	(19, '7-A1', '23412', 6),
	(20, '1-A', '536537758', 6);

-- membuang struktur untuk table sekolahh.tbl_ruangan
CREATE TABLE IF NOT EXISTS `tbl_ruangan` (
  `kd_ruangan` varchar(10) NOT NULL,
  `nama_ruangan` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_ruangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_ruangan: ~11 rows (lebih kurang)
INSERT INTO `tbl_ruangan` (`kd_ruangan`, `nama_ruangan`) VALUES
	('000', 'Default'),
	('123', 'def'),
	('IA', 'Ruangan Kelas I A'),
	('VIIA1', 'Ruangan Kelas VII-A IPA'),
	('VIIA2', 'Ruangan Kelas VII-A IPS'),
	('VIIB1', 'Ruangan Kelas VII-B IPA'),
	('VIIB2', 'Ruangan Kelas VII-B IPS'),
	('VIIIA1', 'Ruangan Kelas VIII-A IPA'),
	('VIIIA2', 'Ruangan Kelas VIII-A IPS'),
	('VIIIB1', 'Ruangan Kelas VIII-B IPA'),
	('VIIIB2', 'Ruangan Kelas VIII-B IPS');

-- membuang struktur untuk table sekolahh.tbl_siswa
CREATE TABLE IF NOT EXISTS `tbl_siswa` (
  `nim` varchar(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `kd_agama` int NOT NULL,
  `foto` text NOT NULL,
  `kd_kelas` varchar(5) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_siswa: ~12 rows (lebih kurang)
INSERT INTO `tbl_siswa` (`nim`, `nama`, `gender`, `tanggal_lahir`, `tempat_lahir`, `kd_agama`, `foto`, `kd_kelas`) VALUES
	('1111', 'sgmgdkg', 'L', '2005-12-20', ' skvn', 1, '', '5-A'),
	('12345', 'qwerty', 'L', '2004-02-01', 'wer', 1, '', '4-A'),
	('18SI1000', 'Muhammad Athallah Zuhry', 'L', '1996-12-19', 'Banda Aceh', 1, 'user-siluet.jpg', '7-A1'),
	('18SI1001', 'Rian Armansyah Maulana', 'L', '1996-01-02', 'Taliwang', 1, 'user-siluet1.jpg', '7-A1'),
	('18SI1002', 'Rezha Septyan Ramandha', 'L', '1997-01-24', 'Lampung', 1, 'user-siluet2.jpg', '7-A1'),
	('18SI1003', 'Ovillia Dyah Charisma', 'P', '1996-01-18', 'Semarang', 1, 'user-siluet3.jpg', '7-A1'),
	('18TI2000', 'Hadi Luthfi Firdaus', 'L', '1996-01-30', 'Pekanbaru', 1, 'user-siluet4.jpg', '7-A1'),
	('18TI2001', 'Muhammad Fajar', 'L', '1995-01-14', 'Yogyakarta', 1, 'user-siluet5.jpg', '7-A1'),
	('18TI2002', 'Bagus Widiatmono', 'L', '1996-01-09', 'Purworejo', 1, 'user-siluet6.jpg', '7-A1'),
	('18TI2003', 'Aris Harwanto', 'L', '1996-01-13', 'Klaten', 1, 'user-siluet7.jpg', '7-A1'),
	('536537758', 'nfnfw', 'P', '2004-12-30', 'nfsjfnsj', 1, '', '1-A'),
	('555426472', 'upin', 'L', '2007-12-30', 'arab', 1, '', '1-A');

-- membuang struktur untuk table sekolahh.tbl_tahun_akademik
CREATE TABLE IF NOT EXISTS `tbl_tahun_akademik` (
  `id_tahun_akademik` int NOT NULL AUTO_INCREMENT,
  `tahun_akademik` varchar(10) NOT NULL,
  `is_aktif` enum('Y','N') NOT NULL,
  `semester` varchar(10) NOT NULL,
  PRIMARY KEY (`id_tahun_akademik`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_tahun_akademik: ~5 rows (lebih kurang)
INSERT INTO `tbl_tahun_akademik` (`id_tahun_akademik`, `tahun_akademik`, `is_aktif`, `semester`) VALUES
	(1, '2018/2019', 'N', 'ganjil'),
	(2, '2017/2018', 'N', 'genap'),
	(5, '2019/2020', 'N', 'genap'),
	(6, '2025/2026', 'Y', 'ganjil'),
	(7, '2026/2027', 'N', '');

-- membuang struktur untuk table sekolahh.tbl_tingkatan_kelas
CREATE TABLE IF NOT EXISTS `tbl_tingkatan_kelas` (
  `kd_tingkatan` varchar(5) NOT NULL,
  `nama_tingkatan` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_tingkatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_tingkatan_kelas: ~9 rows (lebih kurang)
INSERT INTO `tbl_tingkatan_kelas` (`kd_tingkatan`, `nama_tingkatan`) VALUES
	('1', 'TIngkat Kelas 1 (I)'),
	('2', 'Tingkat Kelas 2 (II)'),
	('3', 'Tingkat Kelas 3 (III)'),
	('4', 'Tingkat Kelas 4 (IV)'),
	('5', 'Tingkatan Kelas 5 (V)'),
	('6', 'Tingkat Kelas 6 (VII)'),
	('7', 'Tingkat Kelas 7 (VII)'),
	('8', 'Tingkat Kelas 8 (VIII)'),
	('9', 'Tingkat Kelas 9 (IX)');

-- membuang struktur untuk table sekolahh.tbl_user
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `id_level_user` int NOT NULL,
  `foto` text NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_user: ~6 rows (lebih kurang)
INSERT INTO `tbl_user` (`id_user`, `nama_lengkap`, `username`, `password`, `id_level_user`, `foto`) VALUES
	(1, 'Muhammad Zuhri', 'zuhri', 'e10adc3949ba59abbe56e057f20f883e', 1, 'user-siluet2.jpg'),
	(3, 'Ika Nurul Fadhila', 'ika', 'e10adc3949ba59abbe56e057f20f883e', 4, 'user-siluet3.jpg'),
	(5, 'Dita Ayu Lestari', 'dita', 'e10adc3949ba59abbe56e057f20f883e', 3, 'user_icon1.png'),
	(6, 'Putri Yulia', 'putri', 'e10adc3949ba59abbe56e057f20f883e', 4, 'user_icon2.png'),
	(7, 'Adam Setiawan', 'adam', 'e10adc3949ba59abbe56e057f20f883e', 2, 'user_icon3.png'),
	(8, 'Muhammad Ihsanul Arifin', 'arifin', 'e10adc3949ba59abbe56e057f20f883e', 1, '');

-- membuang struktur untuk table sekolahh.tbl_user_rule
CREATE TABLE IF NOT EXISTS `tbl_user_rule` (
  `id_rule` int NOT NULL AUTO_INCREMENT,
  `id_menu` int NOT NULL,
  `id_level_user` int NOT NULL,
  PRIMARY KEY (`id_rule`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_user_rule: ~24 rows (lebih kurang)
INSERT INTO `tbl_user_rule` (`id_rule`, `id_menu`, `id_level_user`) VALUES
	(1, 16, 4),
	(2, 1, 1),
	(3, 2, 1),
	(4, 3, 1),
	(5, 4, 1),
	(6, 5, 1),
	(8, 8, 1),
	(9, 11, 1),
	(10, 6, 1),
	(11, 14, 1),
	(12, 15, 1),
	(13, 13, 1),
	(14, 12, 1),
	(15, 10, 1),
	(16, 9, 1),
	(17, 11, 3),
	(19, 17, 3),
	(20, 18, 3),
	(21, 12, 3),
	(22, 19, 2),
	(23, 20, 2),
	(24, 21, 2),
	(25, 18, 2),
	(26, 7, 1);

-- membuang struktur untuk table sekolahh.tbl_walikelas
CREATE TABLE IF NOT EXISTS `tbl_walikelas` (
  `id_walikelas` int NOT NULL AUTO_INCREMENT,
  `id_guru` int NOT NULL,
  `id_tahun_akademik` int NOT NULL,
  `kd_kelas` varchar(5) NOT NULL,
  PRIMARY KEY (`id_walikelas`),
  KEY `fk_walikelas_kelas` (`kd_kelas`),
  KEY `fk_walikelas_tahun` (`id_tahun_akademik`),
  CONSTRAINT `fk_walikelas_kelas` FOREIGN KEY (`kd_kelas`) REFERENCES `tbl_kelas` (`kd_kelas`) ON DELETE CASCADE,
  CONSTRAINT `fk_walikelas_tahun` FOREIGN KEY (`id_tahun_akademik`) REFERENCES `tbl_tahun_akademik` (`id_tahun_akademik`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel sekolahh.tbl_walikelas: ~50 rows (lebih kurang)
INSERT INTO `tbl_walikelas` (`id_walikelas`, `id_guru`, `id_tahun_akademik`, `kd_kelas`) VALUES
	(1, 1, 1, '7-A1'),
	(2, 1, 1, '7-A2'),
	(3, 0, 1, '7-B1'),
	(4, 0, 1, '7-B2'),
	(5, 1, 1, '8-A1'),
	(6, 0, 1, '8-A2'),
	(7, 0, 1, '8-B1'),
	(8, 0, 1, '8-B2'),
	(9, 0, 1, '9-A1'),
	(10, 0, 1, '9-A2'),
	(11, 0, 1, '9-B1'),
	(12, 0, 1, '9-B2'),
	(13, 0, 6, '6-A'),
	(14, 1, 6, '7-A1'),
	(15, 0, 6, '7-A2'),
	(16, 0, 6, '7-B1'),
	(17, 0, 6, '7-B2'),
	(18, 0, 6, '8-A1'),
	(19, 0, 6, '8-A2'),
	(20, 0, 6, '8-B1'),
	(21, 0, 6, '8-B2'),
	(22, 0, 6, '9-A1'),
	(23, 0, 6, '9-A2'),
	(24, 0, 6, '9-B1'),
	(25, 0, 6, '9-B2'),
	(26, 0, 6, '5-A'),
	(27, 0, 6, '4-A'),
	(28, 1, 6, '3-A'),
	(31, 1, 6, '1-A'),
	(32, 1, 6, '2-A'),
	(34, 0, 7, '1-A'),
	(36, 0, 7, '2-A'),
	(37, 0, 7, '3-A'),
	(38, 0, 7, '4-A'),
	(39, 0, 7, '5-A'),
	(40, 0, 7, '6-A'),
	(41, 0, 7, '7-A1'),
	(42, 0, 7, '7-A2'),
	(43, 0, 7, '7-B1'),
	(44, 0, 7, '7-B2'),
	(45, 0, 7, '8-A1'),
	(46, 0, 7, '8-A2'),
	(47, 0, 7, '8-B1'),
	(48, 0, 7, '8-B2'),
	(49, 0, 7, '9-A1'),
	(50, 0, 7, '9-A2'),
	(51, 0, 7, '9-B1'),
	(52, 0, 7, '9-B2'),
	(54, 1, 6, '1-B'),
	(56, 0, 6, '2-B');

-- membuang struktur untuk view sekolahh.view_kelas
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `view_kelas` (
	`kd_kelas` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_kelas` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`kd_tingkatan` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`kd_jurusan` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`nama_tingkatan` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_jurusan` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci'
);

-- membuang struktur untuk view sekolahh.view_user
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `view_user` (
	`id_user` INT NOT NULL,
	`nama_lengkap` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`username` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`password` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_level_user` INT NOT NULL,
	`foto` TEXT NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_level` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci'
);

-- membuang struktur untuk view sekolahh.view_walikelas
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `view_walikelas` (
	`nama_guru` VARCHAR(1) NULL COLLATE 'latin1_swedish_ci',
	`nama_kelas` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_walikelas` INT NOT NULL,
	`id_tahun_akademik` INT NOT NULL,
	`nama_jurusan` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_tingkatan` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`tahun_akademik` VARCHAR(1) NOT NULL COLLATE 'latin1_swedish_ci'
);

-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `view_kelas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_kelas` AS select `tk`.`kd_kelas` AS `kd_kelas`,`tk`.`nama_kelas` AS `nama_kelas`,`tk`.`kd_tingkatan` AS `kd_tingkatan`,`tk`.`kd_jurusan` AS `kd_jurusan`,`ttk`.`nama_tingkatan` AS `nama_tingkatan`,`tj`.`nama_jurusan` AS `nama_jurusan` from ((`tbl_kelas` `tk` join `tbl_tingkatan_kelas` `ttk` on((`tk`.`kd_tingkatan` = `ttk`.`kd_tingkatan`))) left join `tbl_jurusan` `tj` on((`tk`.`kd_jurusan` = `tj`.`kd_jurusan`)))
;

-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `view_user`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_user` AS select `tu`.`id_user` AS `id_user`,`tu`.`nama_lengkap` AS `nama_lengkap`,`tu`.`username` AS `username`,`tu`.`password` AS `password`,`tu`.`id_level_user` AS `id_level_user`,`tu`.`foto` AS `foto`,`tlu`.`nama_level` AS `nama_level` from (`tbl_user` `tu` join `tbl_level_user` `tlu`) where (`tu`.`id_level_user` = `tlu`.`id_level_user`)
;

-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `view_walikelas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_walikelas` AS select `tg`.`nama_guru` AS `nama_guru`,`tk`.`nama_kelas` AS `nama_kelas`,`tw`.`id_walikelas` AS `id_walikelas`,`tw`.`id_tahun_akademik` AS `id_tahun_akademik`,coalesce(`tj`.`nama_jurusan`,'Tidak Ada') AS `nama_jurusan`,coalesce(`ttk`.`nama_tingkatan`,'Tidak Ada') AS `nama_tingkatan`,`tta`.`tahun_akademik` AS `tahun_akademik` from (((((`tbl_walikelas` `tw` join `tbl_kelas` `tk` on((`tw`.`kd_kelas` = `tk`.`kd_kelas`))) left join `tbl_guru` `tg` on((`tw`.`id_guru` = `tg`.`id_guru`))) left join `tbl_jurusan` `tj` on((`tk`.`kd_jurusan` = `tj`.`kd_jurusan`))) left join `tbl_tingkatan_kelas` `ttk` on((`tk`.`kd_tingkatan` = `ttk`.`kd_tingkatan`))) join `tbl_tahun_akademik` `tta` on((`tw`.`id_tahun_akademik` = `tta`.`id_tahun_akademik`)))
;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
