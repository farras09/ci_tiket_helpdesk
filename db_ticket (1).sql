-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2021 at 07:24 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `tkt_bidang`
--

CREATE TABLE `tkt_bidang` (
  `bd_id` int(11) NOT NULL,
  `bd_nama_bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkt_bidang`
--

INSERT INTO `tkt_bidang` (`bd_id`, `bd_nama_bidang`) VALUES
(1, 'Kepala Dinas'),
(3, 'Sekretaris');

-- --------------------------------------------------------

--
-- Table structure for table `tkt_pegawai`
--

CREATE TABLE `tkt_pegawai` (
  `pg_nip` varchar(17) NOT NULL,
  `pg_nama` varchar(100) NOT NULL,
  `pg_email` varchar(50) NOT NULL,
  `pg_no_hp` varchar(15) NOT NULL,
  `pg_password` varchar(255) NOT NULL,
  `pg_bdg_id` int(11) NOT NULL,
  `pg_foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkt_pegawai`
--

INSERT INTO `tkt_pegawai` (`pg_nip`, `pg_nama`, `pg_email`, `pg_no_hp`, `pg_password`, `pg_bdg_id`, `pg_foto`) VALUES
('12435235', 'Muhammad Jamil, S.Ag, M.T', 'jamil@kadis.com', '08123213123', '$2y$10$wMuhW.VFI8PFcgMIh5nHf.IplaklAxeK/PshMXjhdbIn7L49565nC', 1, '1d4cffee80d354f71602ffc6ce20f9cf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tkt_pengaduan`
--

CREATE TABLE `tkt_pengaduan` (
  `pgd_id` varchar(20) NOT NULL,
  `pgd_pg_nip` varchar(17) NOT NULL,
  `pgd_tgl_pengaduan` date NOT NULL,
  `pgd_uraian_pengaduan` text NOT NULL,
  `pgd_biaya_perbaikan` int(11) NOT NULL,
  `pgd_adm_keterangan` text,
  `pgd_adm_status` enum('Diproses','Diterima') NOT NULL,
  `pgd_umum_keterangan` text,
  `pgd_umum_status` enum('Diproses','Diterima','Ditunda') NOT NULL,
  `pgd_read_by_admin` int(11) NOT NULL,
  `pgd_read_by_umum` int(11) NOT NULL,
  `pgd_hasil` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkt_pengaduan`
--

INSERT INTO `tkt_pengaduan` (`pgd_id`, `pgd_pg_nip`, `pgd_tgl_pengaduan`, `pgd_uraian_pengaduan`, `pgd_biaya_perbaikan`, `pgd_adm_keterangan`, `pgd_adm_status`, `pgd_umum_keterangan`, `pgd_umum_status`, `pgd_read_by_admin`, `pgd_read_by_umum`, `pgd_hasil`) VALUES
('LP061221000001', '12435235', '2021-11-02', 'Tes', 1, 'Rp. 3.000.000,-', 'Diterima', '', 'Diterima', 1, 1, NULL),
('LP131221000002', '12435235', '2021-12-13', 'UPS tidak berfungsi', 1, 'Rp. 50.000,-', 'Diterima', 'Jika ada biaya tambahan tidak perlu mengajukan ulang', 'Diterima', 1, 1, NULL),
('LP141221000003', '12435235', '2021-12-14', 'AC rusak', 1, 'Rp. 1.000.000,-', 'Diterima', 'Diundur bulan depan karena kondisi finansial kantor sedang di audit, jadi tidak bisa mengeluarkan anggaran. Laporan akan dianggarkan ke resolusi bulan depan', 'Ditunda', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tkt_tracking`
--

CREATE TABLE `tkt_tracking` (
  `trck_id` int(11) NOT NULL,
  `trck_pgd_id` varchar(17) NOT NULL,
  `trck_status` varchar(50) NOT NULL,
  `trck_keterangan` text,
  `trck_tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkt_tracking`
--

INSERT INTO `tkt_tracking` (`trck_id`, `trck_pgd_id`, `trck_status`, `trck_keterangan`, `trck_tgl`) VALUES
(1, 'LP061221000001', 'Memasuki inisialisasi proyek', 'Proses 2 sampai 3 hari', '2021-12-13'),
(2, 'LP061221000001', 'Perbaikan telah selesai', '', '2021-12-13'),
(3, 'LP131221000002', 'Laporan Pengaduan Diterima', 'Perbaikan dimulai besok pagi. Jika ada biaya tambahan tidak perlu mengajukan pengaduan kembali', '2021-12-13'),
(4, 'LP131221000002', 'Perbaikan telah selesai', '', '2021-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `tkt_user`
--

CREATE TABLE `tkt_user` (
  `usr_id` int(11) NOT NULL,
  `usr_username` varchar(20) NOT NULL,
  `usr_password` varchar(255) NOT NULL,
  `usr_role` varchar(15) NOT NULL,
  `usr_nama` varchar(30) NOT NULL,
  `usr_alamat` text NOT NULL,
  `usr_email` varchar(50) NOT NULL,
  `usr_no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tkt_user`
--

INSERT INTO `tkt_user` (`usr_id`, `usr_username`, `usr_password`, `usr_role`, `usr_nama`, `usr_alamat`, `usr_email`, `usr_no_hp`) VALUES
(1, 'admin', '$2y$12$BqfjJzewYHHR269ur3ad/OE3a33sj/0LYw2FXdivyR92a6zTKriYe', 'Administrator', 'Administrator', 'Jl. Seroja', 'admin@gmail.com', '081275127265'),
(2, 'bagianumum', '$2y$10$0clGk5ArVsIHhFaATThabua/AeBZPFmAj.sg6tJtfsFfUeQuLd3uS', 'Bagian Umum', 'Bagian Umum', 'Jl. Seroja', '', '081275127265');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tkt_bidang`
--
ALTER TABLE `tkt_bidang`
  ADD PRIMARY KEY (`bd_id`);

--
-- Indexes for table `tkt_pegawai`
--
ALTER TABLE `tkt_pegawai`
  ADD PRIMARY KEY (`pg_nip`),
  ADD UNIQUE KEY `nip` (`pg_nip`);

--
-- Indexes for table `tkt_pengaduan`
--
ALTER TABLE `tkt_pengaduan`
  ADD PRIMARY KEY (`pgd_id`);

--
-- Indexes for table `tkt_tracking`
--
ALTER TABLE `tkt_tracking`
  ADD PRIMARY KEY (`trck_id`);

--
-- Indexes for table `tkt_user`
--
ALTER TABLE `tkt_user`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tkt_bidang`
--
ALTER TABLE `tkt_bidang`
  MODIFY `bd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tkt_tracking`
--
ALTER TABLE `tkt_tracking`
  MODIFY `trck_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tkt_user`
--
ALTER TABLE `tkt_user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
