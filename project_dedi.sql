-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2020 at 02:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_dedi`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2020_07_02_065159_tbl_pinjaman', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_kode` text NOT NULL,
  `admin_nama` varchar(50) DEFAULT NULL,
  `admin_kelamin` varchar(20) DEFAULT NULL,
  `admin_tanggal_lahir` date DEFAULT NULL,
  `admin_tempat_lahir` varchar(100) DEFAULT NULL,
  `admin_alamat` varchar(100) DEFAULT NULL,
  `admin_kontak` varchar(20) DEFAULT NULL,
  `admin_username` text NOT NULL,
  `admin_password` text NOT NULL,
  `admin_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_kode`, `admin_nama`, `admin_kelamin`, `admin_tanggal_lahir`, `admin_tempat_lahir`, `admin_alamat`, `admin_kontak`, `admin_username`, `admin_password`, `admin_foto`) VALUES
(1, 'AD-xjjx', 'Kang Dedi Playboy', 'laki-laki', '2020-06-17', 'Diatas Tanah', NULL, NULL, 'admin', '$2y$10$DJxrbbFOhs53Wuv6KrIjf.gU1lFvpfnfplIrF0D8AUngEU5b2GeoS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_anggota`
--

CREATE TABLE `tbl_anggota` (
  `anggota_id` int(11) NOT NULL,
  `anggota_kode` text NOT NULL,
  `anggota_username` text NOT NULL,
  `anggota_password` text NOT NULL,
  `anggota_nik` varchar(100) NOT NULL,
  `anggota_nama` varchar(100) DEFAULT NULL,
  `anggota_kelamin` varchar(20) DEFAULT NULL,
  `anggota_tempat_lahir` varchar(100) DEFAULT NULL,
  `anggota_tanggal_lahir` date DEFAULT NULL,
  `anggota_alamat_ktp` varchar(100) DEFAULT NULL,
  `anggota_alamat_sekarang` varchar(100) DEFAULT NULL,
  `anggota_kontak` varchar(15) DEFAULT NULL,
  `anggota_pekerjaan` varchar(50) DEFAULT NULL,
  `status` text NOT NULL COMMENT '0=tidak_aktif,1=operator_setuju,2=admin_setuju,3=admin_nolak,4=operator_nolak',
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_anggota`
--

INSERT INTO `tbl_anggota` (`anggota_id`, `anggota_kode`, `anggota_username`, `anggota_password`, `anggota_nik`, `anggota_nama`, `anggota_kelamin`, `anggota_tempat_lahir`, `anggota_tanggal_lahir`, `anggota_alamat_ktp`, `anggota_alamat_sekarang`, `anggota_kontak`, `anggota_pekerjaan`, `status`, `foto`) VALUES
(1, 'AG-827', 'anggota', '$2y$10$sV9K2sSYB0x5Gc.9FXgTTuYUSwDh8xf13xgqPPtf6MRsI38DE7qte', '9900292828', 'Dahlan', 'Laki - Laki', 'Hagu Barat Laut', '1989-06-30', 'Hagu Barat Laut', 'Hagu Barat Laut', '082272242022', 'PNS DOSEN', '3', ''),
(3, 'AG-8130', 'sumail', '$2y$10$c1lU9MWQoJbHUV5CQ/RLouRWUl2UQWFoiZn1ONzMQI9zU7w8TTHvi', '1209666377397', 'Sumail', 'laki-laki', 'Lhokseumawe', '1993-07-02', 'Madina', 'Paloh lada', '123123123123', 'Swasta', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entri_anggota`
--

CREATE TABLE `tbl_entri_anggota` (
  `entri_id` int(11) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `entri_tanggal_daftar` datetime NOT NULL,
  `operator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entri_simpanan`
--

CREATE TABLE `tbl_entri_simpanan` (
  `entri_id` int(11) NOT NULL,
  `simpanan_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `entri_tanggal_simpanan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_pinjaman`
--

CREATE TABLE `tbl_kategori_pinjaman` (
  `kategori_id` int(11) NOT NULL,
  `kategori_jenis` varchar(100) DEFAULT NULL,
  `kategori_besar_pinjaman` text DEFAULT NULL,
  `kategori_lama_pinjaman` text DEFAULT NULL,
  `kategori_besar_bunga` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori_pinjaman`
--

INSERT INTO `tbl_kategori_pinjaman` (`kategori_id`, `kategori_jenis`, `kategori_besar_pinjaman`, `kategori_lama_pinjaman`, `kategori_besar_bunga`) VALUES
(2, 'skala besar', '10000000', '24', '5'),
(3, 'skala menengah', '5000000', '12', '10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_simpanan`
--

CREATE TABLE `tbl_kategori_simpanan` (
  `kategori_id` int(11) NOT NULL,
  `kategori_jenis` varchar(100) DEFAULT NULL,
  `kategori_biaya_simpanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori_simpanan`
--

INSERT INTO `tbl_kategori_simpanan` (`kategori_id`, `kategori_jenis`, `kategori_biaya_simpanan`) VALUES
(4, 'POKOK', 10000),
(5, 'SIMPANAN WAJIB', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_operator`
--

CREATE TABLE `tbl_operator` (
  `operator_id` int(11) NOT NULL,
  `operator_kode` text NOT NULL,
  `operator_nomor_pegawai` varchar(50) NOT NULL,
  `operator_nama` varchar(50) DEFAULT NULL,
  `operator_kelamin` varchar(20) DEFAULT NULL,
  `operator_tempat_lahir` varchar(100) DEFAULT NULL,
  `operator_tanggal_lahir` date DEFAULT NULL,
  `operator_alamat` varchar(100) DEFAULT NULL,
  `operator_kontak` varchar(15) DEFAULT NULL,
  `operator_username` text NOT NULL,
  `operator_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_operator`
--

INSERT INTO `tbl_operator` (`operator_id`, `operator_kode`, `operator_nomor_pegawai`, `operator_nama`, `operator_kelamin`, `operator_tempat_lahir`, `operator_tanggal_lahir`, `operator_alamat`, `operator_kontak`, `operator_username`, `operator_password`) VALUES
(1, 'OP-92028', '123456', 'Admin Tunggal', 'Laki - Laki', 'sdfsdf', '2020-06-23', 'sdfsdfsdf', '23423423', 'operator', '$2y$10$ApXi7DlOSo9Qk.vtZf8uQ.U89OWOk4NbHfelQYVJMsvjcfzLG72mS'),
(3, 'OP-97636', '34234', 'sfsdfsd', 'Laki - Laki', 'sdfsdf', '2020-06-16', 'sdfsdf', '2345454', 'operator2', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjaman`
--

CREATE TABLE `tbl_pinjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anggota_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinjaman_kode` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinjaman_tgl` datetime NOT NULL,
  `pinjaman_jumlah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinjaman_skema_angsuran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinjaman_bunga` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinjaman_angsuran_lama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinjaman_ket` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinjaman_status` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0=masih diajukan,1=disetujui operator,2=ditolak operator,3=disetujui admin,4=ditolak admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pinjaman`
--

INSERT INTO `tbl_pinjaman` (`id`, `anggota_id`, `pinjaman_kode`, `pinjaman_tgl`, `pinjaman_jumlah`, `pinjaman_skema_angsuran`, `pinjaman_bunga`, `pinjaman_angsuran_lama`, `pinjaman_ket`, `pinjaman_status`) VALUES
(1, '3', 'PNJ-8155', '2020-07-03 00:00:00', '9000000', '393750', '5', '24', 'kalau sudah disetujui janagan mau makan-makan', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_simpanan`
--

CREATE TABLE `tbl_simpanan` (
  `simpanan_id` int(11) NOT NULL,
  `anggota_id` int(11) DEFAULT NULL,
  `simpanan_id_kategori` int(11) DEFAULT NULL,
  `simpanan_jumlah` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_simpanan`
--

INSERT INTO `tbl_simpanan` (`simpanan_id`, `anggota_id`, `simpanan_id_kategori`, `simpanan_jumlah`) VALUES
(1, 1, 4, '10000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `level` text NOT NULL COMMENT '1=admin,2=operator,3=anggota',
  `kode_user` text NOT NULL,
  `status` text NOT NULL COMMENT '1=aktif,0=non-aktif',
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama`, `username`, `password`, `level`, `kode_user`, `status`, `foto`) VALUES
(1, 'Kang Dedi Playboy', 'admin', '$2y$10$DJxrbbFOhs53Wuv6KrIjf.gU1lFvpfnfplIrF0D8AUngEU5b2GeoS', '1', 'AD-443', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `use_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  ADD PRIMARY KEY (`anggota_id`),
  ADD UNIQUE KEY `anggota_kode` (`anggota_nik`);

--
-- Indexes for table `tbl_entri_anggota`
--
ALTER TABLE `tbl_entri_anggota`
  ADD PRIMARY KEY (`entri_id`);

--
-- Indexes for table `tbl_entri_simpanan`
--
ALTER TABLE `tbl_entri_simpanan`
  ADD PRIMARY KEY (`entri_id`);

--
-- Indexes for table `tbl_kategori_pinjaman`
--
ALTER TABLE `tbl_kategori_pinjaman`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tbl_kategori_simpanan`
--
ALTER TABLE `tbl_kategori_simpanan`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tbl_operator`
--
ALTER TABLE `tbl_operator`
  ADD PRIMARY KEY (`operator_id`),
  ADD UNIQUE KEY `operator_nomor_pegawai` (`operator_nomor_pegawai`);

--
-- Indexes for table `tbl_pinjaman`
--
ALTER TABLE `tbl_pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_simpanan`
--
ALTER TABLE `tbl_simpanan`
  ADD PRIMARY KEY (`simpanan_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`use_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_anggota`
--
ALTER TABLE `tbl_anggota`
  MODIFY `anggota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_entri_anggota`
--
ALTER TABLE `tbl_entri_anggota`
  MODIFY `entri_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_entri_simpanan`
--
ALTER TABLE `tbl_entri_simpanan`
  MODIFY `entri_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kategori_pinjaman`
--
ALTER TABLE `tbl_kategori_pinjaman`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kategori_simpanan`
--
ALTER TABLE `tbl_kategori_simpanan`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_operator`
--
ALTER TABLE `tbl_operator`
  MODIFY `operator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pinjaman`
--
ALTER TABLE `tbl_pinjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_simpanan`
--
ALTER TABLE `tbl_simpanan`
  MODIFY `simpanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `use_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
