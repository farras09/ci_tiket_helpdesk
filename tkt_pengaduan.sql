-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2022 at 07:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tkt_pengaduan`
--

CREATE TABLE `tkt_pengaduan` (
  `pgd_id` varchar(20) NOT NULL,
  `pgd_pg_nip` varchar(17) NOT NULL,
  `pgd_tgl_pengaduan` date NOT NULL,
  `pgd_uraian_pengaduan` text NOT NULL,
  `pgd_biaya_perbaikan` tinyint(1) NOT NULL,
  `pgd_teknisi` varchar(100) NOT NULL,
  `pgd_adm_keterangan` text DEFAULT NULL,
  `pgd_teknisi_status` enum('Belum Selesai','Sudah Selesai') NOT NULL,
  `pgd_jumlah_biaya_perbaikan` double DEFAULT NULL,
  `pgd_adm_status` enum('Diproses','Diterima') NOT NULL,
  `pgd_umum_keterangan` text DEFAULT NULL,
  `pgd_umum_status` enum('Diproses','Diterima','Ditunda') NOT NULL,
  `pgd_read_by_admin` tinyint(1) NOT NULL,
  `pgd_read_by_umum` tinyint(1) NOT NULL,
  `pgd_read_by_teknisi` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkt_pengaduan`
--

INSERT INTO `tkt_pengaduan` (`pgd_id`, `pgd_pg_nip`, `pgd_tgl_pengaduan`, `pgd_uraian_pengaduan`, `pgd_biaya_perbaikan`, `pgd_teknisi`, `pgd_adm_keterangan`, `pgd_teknisi_status`, `pgd_jumlah_biaya_perbaikan`, `pgd_adm_status`, `pgd_umum_keterangan`, `pgd_umum_status`, `pgd_read_by_admin`, `pgd_read_by_umum`, `pgd_read_by_teknisi`) VALUES
('LP061221000001', '12435235', '2021-11-02', 'Tes', 1, ' Irwan', 'Langsung diperbaiki teknisi', 'Belum Selesai', 50000, 'Diterima', '', 'Diterima', 1, 1, 1),
('LP131221000002', '12435235', '2021-12-14', 'UPS tidak berfungsi', 1, 'Irwan', 'Memerlukan proses 3 hari', 'Sudah Selesai', 500000, 'Diterima', 'Jika ada biaya tambahan tidak perlu mengajukan ulang', 'Diterima', 1, 1, 1),
('LP141221000003', '12435235', '2021-12-14', 'AC rusak', 1, '', 'Beli AC 4 PK 2 unit', 'Sudah Selesai', 2000000, 'Diterima', 'Diundur bulan depan karena kondisi finansial kantor sedang di audit, jadi tidak bisa mengeluarkan anggaran. Laporan akan dianggarkan ke resolusi bulan depan', 'Ditunda', 1, 1, 1),
('LP201221000004', '90213123', '2021-12-20', 'Butuh tambahan kabel LAN 30 meter', 0, '', '', 'Sudah Selesai', 100000, 'Diterima', 'Project bisa dimulai minggu depan', 'Diterima', 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tkt_pengaduan`
--
ALTER TABLE `tkt_pengaduan`
  ADD PRIMARY KEY (`pgd_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
