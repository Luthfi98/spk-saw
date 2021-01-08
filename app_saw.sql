-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2021 at 12:41 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_edited` timestamp NOT NULL,
  `last_login` timestamp NOT NULL,
  `is_active` enum('true','false') NOT NULL,
  `gambar` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `id_jabatan`, `date_created`, `date_edited`, `last_login`, `is_active`, `gambar`) VALUES
(1, 'admin1', '$2y$10$WD6QqwG32vNPp8B0iahAyuopcq.hJc357XsyJuAi5.VNUNUkCPh8.', 1, '2020-12-30 08:16:40', '2021-01-04 15:42:57', '2021-01-08 12:39:25', 'true', 'Profileadmin_04012021_905.png');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` tinyint(4) NOT NULL,
  `kode_alternatif` char(3) NOT NULL,
  `nama_alternatif` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `kode_alternatif`, `nama_alternatif`) VALUES
(1, 'A01', 'Toshiba'),
(2, 'A02', 'Dell'),
(3, 'A03', 'Acer');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL,
  `deskripsi_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `deskripsi_jabatan`) VALUES
(1, 'Administrator 1', 'Administrator 1');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(3) NOT NULL,
  `nama_kriteria` varchar(25) NOT NULL,
  `jenis_kriteria` enum('Benefit','Cost') NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode_kriteria`, `nama_kriteria`, `jenis_kriteria`, `bobot`) VALUES
(1, 'K1', 'Brand', 'Benefit', 0.35),
(2, 'K2', 'Harga', 'Cost', 0.35),
(3, 'K3', 'Processor', 'Benefit', 0.15),
(4, 'K4', 'Memory', 'Benefit', 0.05),
(5, 'K5', 'Fasilitas', 'Benefit', 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(25) NOT NULL,
  `url_menu` varchar(50) NOT NULL,
  `mempunyai_link` int(1) NOT NULL COMMENT '0: Tidak memiliki Link\r\n1:Memiliki Link ',
  `ikon_menu` varchar(20) DEFAULT NULL,
  `posisi` int(11) NOT NULL,
  `main_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `url_menu`, `mempunyai_link`, `ikon_menu`, `posisi`, `main_menu`) VALUES
(1, 'Dashboard', 'admin-dashboard', 1, 'dashboard', 1, 0),
(2, 'Pengaturan Menu', 'menu', 0, 'list', 7, 0),
(3, 'Pengaturan Pengguna', 'pengguna', 0, 'users', 8, 0),
(4, 'Manajemen Menu', 'menu/manajemen-menu', 1, '', 1, 2),
(5, 'Manajemen Akun', 'pengguna/manajemen-akun', 1, '', 1, 3),
(6, 'Manajemen Posisi Menu', 'menu/manajemen-posisi', 1, '', 2, 2),
(7, 'Manajemen Jabatan', 'pengguna/manajemen-jabatan', 1, '', 2, 3),
(8, 'Profile', 'profile', 1, 'user', 9, 0),
(9, 'Pengaturan Kriteria', 'kriteria', 0, 'file-text', 5, 0),
(10, 'Manajemen Kriteria', 'master/manajemen-kriteria', 1, '', 1, 20),
(11, 'Manajemen Nilai Kriteria', 'kriteria/manajemen-nilai-kriteria', 1, '', 1, 9),
(12, 'Perbandingan Kroteria', 'kriteria/perbandingan-kriteria', 1, '', 2, 9),
(13, 'Pembobotan Kriteria', 'kriteria/pembobotan-kriteria', 1, '', 3, 9),
(14, 'Pengaturan Alternatif', 'alternatif', 0, 'list-alt', 6, 0),
(15, 'Manajemen Alternatif', 'master/manajemen-alternatif', 1, '', 2, 20),
(16, 'Normalisasi Alternatif', 'alternatif/normalisasi-alternatif', 1, '', 1, 14),
(17, 'Perankingan', 'perankingan', 1, 'calculator', 4, 0),
(20, 'Data Master', 'master', 0, 'database', 2, 0),
(21, 'Nilai Alternatif', 'master/manajemen-nilai-alternatif', 1, '', 3, 20),
(22, 'Normalisasi Alternatif', 'normalisasi-alternatif', 1, 'table', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `id_nilai` int(11) NOT NULL,
  `baris` tinyint(4) DEFAULT NULL,
  `kolom` tinyint(4) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `hasil` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`id_nilai`, `baris`, `kolom`, `nilai`, `hasil`) VALUES
(1, 1, 1, 12, '3.750'),
(2, 1, 2, 21, '1.000'),
(3, 1, 3, 23, '3.348'),
(4, 1, 4, 13, '6.769'),
(5, 1, 5, 12, '3.750'),
(6, 2, 1, 45, '1.000'),
(7, 2, 2, 67, '0.313'),
(8, 2, 3, 77, '1.000'),
(9, 2, 4, 88, '1.000'),
(10, 2, 5, 45, '1.000'),
(11, 3, 1, 35, '1.286'),
(12, 3, 2, 35, '0.600'),
(13, 3, 3, 36, '2.139'),
(14, 3, 4, 45, '1.956'),
(15, 3, 5, 45, '1.000');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_kriteria_1` tinyint(4) NOT NULL,
  `id_kriteria_2` tinyint(4) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_kriteria_1`, `id_kriteria_2`, `nilai`) VALUES
(1, 1, 1),
(2, 1, 0.333333),
(2, 2, 1),
(1, 2, 3),
(3, 1, 0.5),
(3, 2, 4),
(3, 3, 1),
(1, 3, 2),
(2, 3, 0.25),
(4, 1, 5),
(4, 2, 0.25),
(4, 3, 3),
(4, 4, 1),
(1, 4, 0.2),
(2, 4, 4),
(3, 4, 0.333333);

-- --------------------------------------------------------

--
-- Table structure for table `previlege_jabatan`
--

CREATE TABLE `previlege_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `previlege_jabatan`
--

INSERT INTO `previlege_jabatan` (`id_jabatan`, `id_menu`) VALUES
(1, 1),
(1, 20),
(1, 10),
(1, 15),
(1, 21),
(1, 22),
(1, 17),
(1, 2),
(1, 4),
(1, 6),
(1, 3),
(1, 5),
(1, 7),
(1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `id` tinyint(4) NOT NULL,
  `id_alternatif` tinyint(4) NOT NULL,
  `hasil` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ranking`
--

INSERT INTO `ranking` (`id`, `id_alternatif`, `hasil`) VALUES
(1, 1, '2.878'),
(2, 2, '0.760'),
(3, 3, '1.179');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ranking`
--
ALTER TABLE `ranking`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
