-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2021 at 10:26 AM
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
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id` int(11) NOT NULL,
  `pegawai_nip` varchar(40) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jam_masuk` datetime DEFAULT NULL,
  `jam_keluar` datetime DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `status_kehadiran_id` varchar(15) DEFAULT NULL,
  `lokasi_pegawai_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id`, `pegawai_nip`, `tanggal_masuk`, `jam_masuk`, `jam_keluar`, `latitude`, `longitude`, `status_kehadiran_id`, `lokasi_pegawai_id`) VALUES
(2, '196204191994032001', '2021-06-15', '2021-06-15 10:36:58', '0000-00-00 00:00:00', 0.46385583576375367, 101.41722032329635, 'Terlambat', 'WFO'),
(3, '196204191994032001', '2021-06-15', '2021-06-15 10:36:58', NULL, 0.42890019999999995, 101.4192472, 'Terlambat', 'WFH');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_laporan_harian`
--

CREATE TABLE `tb_detail_laporan_harian` (
  `id` int(11) NOT NULL,
  `nomor_laporan_harian` varchar(30) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `uraian_kegiatan` varchar(255) NOT NULL,
  `output` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_laporan_harian`
--

INSERT INTO `tb_detail_laporan_harian` (`id`, `nomor_laporan_harian`, `nama_kegiatan`, `uraian_kegiatan`, `output`) VALUES
(1, 'LP0406210001', '- Audit Dokumen\r\n- Stemming Data', 'Cek berkas', 'Dokumen'),
(2, 'LP070621210002', 'Tess', 'Beli cangkul', 'Ga ada');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan_harian`
--

CREATE TABLE `tb_laporan_harian` (
  `nomor_laporan` varchar(20) NOT NULL,
  `absensi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_laporan_harian`
--

INSERT INTO `tb_laporan_harian` (`nomor_laporan`, `absensi_id`) VALUES
('LP0406210001', 1),
('LP070621210002', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi_pegawai`
--

CREATE TABLE `tb_lokasi_pegawai` (
  `id` int(11) NOT NULL,
  `lokasi_pegawai` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_lokasi_pegawai`
--

INSERT INTO `tb_lokasi_pegawai` (`id`, `lokasi_pegawai`) VALUES
(1, 'WFH'),
(2, 'WFO');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `nip` varchar(40) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `golongan` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `status_pegawai` enum('Aktif','Tidak Aktif') NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `nama_pegawai`, `jabatan`, `golongan`, `password`, `pangkat`, `status_pegawai`, `foto`) VALUES
('196204191994032001', 'Samiyem', 'Bendahara (PNBP)', 'III/b', '$2y$10$Ww/TyzxPNmd4ftesVnOjz.hF2c97nT0RsNP6xGb/QxjvcxT9sQY7O', '', 'Aktif', '3c01ba8531a1f8447de10510e2f47fac.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajuan_izin`
--

CREATE TABLE `tb_pengajuan_izin` (
  `id` int(11) NOT NULL,
  `nip` varchar(40) NOT NULL,
  `jenis_ajuan` enum('Cuti','Sakit','Izin','Lainnya') NOT NULL,
  `keterangan` text NOT NULL,
  `file_surat` text,
  `file_type` text NOT NULL,
  `status_pengajuan` enum('Diproses','Diterima','Ditolak') NOT NULL,
  `readBySsed` int(11) NOT NULL,
  `readByAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengajuan_izin`
--

INSERT INTO `tb_pengajuan_izin` (`id`, `nip`, `jenis_ajuan`, `keterangan`, `file_surat`, `file_type`, `status_pengajuan`, `readBySsed`, `readByAdmin`) VALUES
(1, '63436346', 'Sakit', 'Malaria', 'f998f9e1b8f55422e490becfd2663883.jpg', 'image/jpeg', 'Diterima', 1, 1),
(2, '63436346', 'Cuti', 'Merantau', 'f99cf93bea362d90a0a2e049f88c7bd1.jpg', 'image/jpeg', 'Diterima', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_status_kehadiran`
--

CREATE TABLE `tb_status_kehadiran` (
  `id` int(11) NOT NULL,
  `status_kehadiran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `nama`, `alamat`, `no_hp`) VALUES
(1, 'admin', '$2y$12$BqfjJzewYHHR269ur3ad/OE3a33sj/0LYw2FXdivyR92a6zTKriYe', 'Administrator', 'Administrator', 'Jl. Seroja kk', '081275127265'),
(2, 'ssed', '$2y$12$BqfjJzewYHHR269ur3ad/OE3a33sj/0LYw2FXdivyR92a6zTKriYe', 'Kepala Balai', 'Kepala Balai', 'Jl. Seroja', '081275127265');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_detail_laporan_harian`
--
ALTER TABLE `tb_detail_laporan_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_laporan_harian`
--
ALTER TABLE `tb_laporan_harian`
  ADD PRIMARY KEY (`nomor_laporan`);

--
-- Indexes for table `tb_lokasi_pegawai`
--
ALTER TABLE `tb_lokasi_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tb_pengajuan_izin`
--
ALTER TABLE `tb_pengajuan_izin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_status_kehadiran`
--
ALTER TABLE `tb_status_kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_detail_laporan_harian`
--
ALTER TABLE `tb_detail_laporan_harian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_lokasi_pegawai`
--
ALTER TABLE `tb_lokasi_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pengajuan_izin`
--
ALTER TABLE `tb_pengajuan_izin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_status_kehadiran`
--
ALTER TABLE `tb_status_kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
