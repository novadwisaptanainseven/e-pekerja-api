-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2021 at 07:15 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epekerja`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tgl_absen` date NOT NULL,
  `hari` varchar(10) NOT NULL,
  `absen` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_pegawai`, `tgl_absen`, `hari`, `absen`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 5, '2021-04-02', 'jumat', 1, 'lorem ipsum dolor sit amet', '2021-04-01 04:31:19', '2021-04-01 04:31:19'),
(3, 5, '2021-04-03', 'sabtu', 2, 'lorem ipsum dolor sit amet', '2021-04-01 04:31:29', '2021-04-01 04:31:29'),
(4, 5, '2021-03-01', 'senin', 1, 'lorem ipsum dolor sit amet', '2021-04-01 05:52:02', '2021-04-01 05:52:02'),
(5, 5, '2021-03-02', 'selasa', 2, 'lorem ipsum dolor sit amet edit', '2021-04-01 05:52:11', '2021-04-01 05:52:11'),
(6, 5, '2021-03-03', 'rabu', 1, 'lorem ipsum dolor sit amet edit', '2021-04-01 05:52:21', '2021-04-01 05:52:21'),
(7, 5, '2021-03-04', 'kamis', 3, 'lorem ipsum dolor sit amet edit', '2021-04-01 05:52:27', '2021-04-01 05:52:27'),
(8, 5, '2020-01-01', 'rabu', 1, 'lorem ipsum dolor sit amet', '2021-04-01 06:14:02', '2021-04-01 06:14:02'),
(9, 5, '2021-04-04', 'minggu', 1, 'Hadir', '2021-04-01 06:26:41', '2021-04-01 06:27:00'),
(10, 5, '2021-03-30', 'selasa', 2, 'lorem ipsum dolor sit amet123', '2021-04-01 07:01:54', '2021-04-05 02:14:54'),
(19, 5, '2021-04-05', 'senin', 1, 'lorem ipsum dolor sit amet', '2021-04-05 02:19:26', '2021-05-10 01:55:25'),
(20, 7, '2021-04-05', 'senin', 1, 'Hadir', '2021-04-05 03:41:01', '2021-04-05 03:41:01'),
(21, 13, '2021-04-01', 'kamis', 1, 'Hadir', '2021-04-05 03:52:10', '2021-04-05 03:52:10'),
(24, 5, '2021-04-01', 'kamis', 1, 'Hadir', '2021-04-05 07:37:29', '2021-04-05 07:37:29'),
(25, 5, '2021-04-16', 'jumat', 5, 'Sakit demam', '2021-04-05 07:37:40', '2021-04-05 07:37:51'),
(26, 24, '2021-04-01', 'kamis', 1, 'lorem ipsum dolor sit amet', '2021-04-13 02:20:55', '2021-04-13 02:20:55'),
(27, 24, '2021-04-02', 'jumat', 1, 'lorem ipsum dolor sit amet', '2021-04-13 02:21:01', '2021-04-13 02:21:01'),
(28, 24, '2021-04-03', 'sabtu', 1, 'lorem ipsum dolor sit amet', '2021-04-13 02:21:07', '2021-04-13 02:21:07'),
(29, 24, '2021-04-04', 'minggu', 2, 'lorem ipsum dolor sit amet', '2021-04-13 02:21:22', '2021-04-13 02:21:22'),
(30, 24, '2021-04-05', 'senin', 2, 'lorem ipsum dolor sit amet', '2021-04-13 02:21:30', '2021-04-13 02:21:30'),
(31, 24, '2021-04-06', 'selasa', 3, 'lorem ipsum dolor sit amet', '2021-04-13 02:21:37', '2021-04-13 02:21:37'),
(32, 24, '2021-04-07', 'rabu', 3, 'lorem ipsum dolor sit amet', '2021-04-13 02:21:43', '2021-04-13 02:21:43'),
(33, 5, '2021-04-07', 'rabu', 2, 'lorem ipsum dolor sit amet', '2021-06-08 07:21:32', '2021-06-08 07:21:32'),
(34, 5, '2021-06-01', 'selasa', 1, 'lorem ipsum dolor sit amet', '2021-06-09 01:59:00', '2021-06-09 01:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id_agama` int(11) NOT NULL,
  `agama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id_agama`, `agama`) VALUES
(1, 'Islam'),
(2, 'Hindu'),
(3, 'Budda'),
(4, 'Kristen');

-- --------------------------------------------------------

--
-- Table structure for table `berkas_pegawai`
--

CREATE TABLE `berkas_pegawai` (
  `id_berkas` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL,
  `tgl_upload` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berkas_pegawai`
--

INSERT INTO `berkas_pegawai` (`id_berkas`, `id_pegawai`, `nama_berkas`, `tgl_upload`, `created_at`, `keterangan`) VALUES
(2, 5, 'images/berkas/39601613696720-file-pdf.pdf', '2021-05-10', '2021-02-19 01:05:20', 'Surat Kontrak Kerja'),
(6, 5, 'images/berkas/111615774664-book1-copy.xlsx', '2021-05-11', '2021-03-15 02:17:44', 'testing upload'),
(9, 7, 'images/berkas/31681620113068-ijazah1.jpg', '2021-05-04', '2021-05-04 07:24:28', 'Ijazah SMK'),
(10, 5, 'images/berkas/88841621237076-ijazah1.jpg', '2021-05-17', '2021-05-17 07:37:56', 'Ijazah SMK'),
(11, 5, 'images/berkas/97061623207499-e-asset-disperkim.pdf', '2021-06-09', '2021-06-09 02:58:19', 'SK'),
(12, 7, 'images/berkas/86261623211039-foto3.jpg', '2021-06-09', '2021-06-09 03:57:19', 'lorem ipsum dolor sit amet');

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(80) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `nama_bidang`, `keterangan`) VALUES
(1, 'Permukiman', 'Unsur pelaksana pemerintah Kota Samarinda dalam bidang Permukiman'),
(2, 'Sekretariat', 'Pelayanan administrasi kepegawaian umum, keuangan dan program'),
(3, 'Perumahan', 'Unsur pelaksana pemerintah Kota Samarinda dalam bidang Perumahan'),
(8, 'Prasarana, Sarana, dan Utilitas Umum', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jenis_cuti` varchar(40) DEFAULT NULL,
  `lama_cuti` varchar(15) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status_cuti` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `id_pegawai`, `jenis_cuti`, `lama_cuti`, `keterangan`, `tgl_mulai`, `tgl_selesai`, `status_cuti`, `created_at`, `updated_at`) VALUES
(2, 5, 'Cuti Tahunan', '1 Bulan', 'Liburan ke Amerika Serikat', '2021-02-10', '2021-02-24', 0, '2021-02-22 05:14:30', NULL),
(3, 5, NULL, '1 Minggu', 'Daftar CPNS', '2021-02-20', '2021-02-27', 0, '2021-02-22 05:15:08', NULL),
(5, 5, NULL, '1 hari', 'lorem ipsum dolor sit amet', '2021-03-26', '2021-03-27', 0, '2021-03-26 02:46:22', '2021-03-29'),
(6, 5, 'Cuti Harian', '1 hari', 'lorem ipsum dolor sit amet', '2021-03-30', '2021-04-06', 0, '2021-03-26 03:14:45', '2021-06-22'),
(7, 5, 'Cuti Bulanan', '1 bulan', 'lorem ipsum dolor sit amet', '2021-03-27', '2021-04-26', 0, '2021-03-26 03:18:13', '2021-06-22'),
(8, 7, NULL, '6 hari', 'lorem ipsum dolor sit amet edit', '2021-03-28', '2021-04-03', 0, '2021-03-26 03:21:24', '2021-03-29'),
(9, 24, NULL, '3 hari', 'lorem ipsum dolor sit amet', '2021-03-29', '2021-04-01', 0, '2021-03-29 06:59:26', NULL),
(10, 7, NULL, '1 minggu', 'lorem ipsum dolor sit amet', '2021-06-08', '2021-06-15', 0, '2021-06-08 06:49:13', NULL),
(11, 9, NULL, '1 bulan', 'lorem ipsum dolor sit amet', '2021-06-09', '2021-07-09', 0, '2021-06-09 03:43:39', NULL),
(12, 5, 'Cuti Bulanan', NULL, 'Cuti Bulanan', '2021-06-24', '2021-06-30', 0, '2021-06-22 12:00:19', NULL),
(13, 24, 'Cuti Tahunan', NULL, 'lorem ipsum dolor sit amet', '2021-06-22', '2021-06-23', 0, '2021-06-22 15:34:52', NULL),
(14, 24, 'Cuti Tahunan', NULL, 'lorem ipsum dolor sit amet', '2021-06-24', '2021-06-28', 0, '2021-06-24 05:52:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diklat`
--

CREATE TABLE `diklat` (
  `id_diklat` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jenis_diklat` varchar(40) NOT NULL,
  `nama_diklat` varchar(80) NOT NULL,
  `penyelenggara` varchar(80) NOT NULL,
  `tahun_diklat` varchar(6) NOT NULL,
  `jumlah_jam` int(11) NOT NULL,
  `dokumentasi` varchar(255) DEFAULT '',
  `sertifikat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diklat`
--

INSERT INTO `diklat` (`id_diklat`, `id_pegawai`, `jenis_diklat`, `nama_diklat`, `penyelenggara`, `tahun_diklat`, `jumlah_jam`, `dokumentasi`, `sertifikat`) VALUES
(1, 5, 'Jenis Diklat', 'Adumla', 'Walikota Samarinda', '1997', 500, 'images/ijazah/961613625299-react.png', 'images/dok_diklat/56531624850016-e-asset-disperkim.pdf'),
(2, 5, 'Jenis Diklat 2', 'Adumla 2', 'Walikota Samarinda 2', '1997', 500, 'images/ijazah/57961613625332-react.png', ''),
(4, 33, 'Jenis Diklat 1', 'Adumla', 'Walikota Samarinda', '2001', 198, 'images/dok_diklat/26261616395967-file-pdf.pdf', ''),
(5, 33, 'Jenis Diklat 2', 'Diklat PIM TK.1', 'Walikota Samarinda', '2005', 150, 'images/dok_diklat/49151616396055-file-pdf.pdf', ''),
(6, 5, 'Jenis Diklat 1', 'Adumla', 'Walikota Samarinda', '2020', 100, 'images/dok_diklat/4791623207031-diklat1.jpg', ''),
(10, 5, 'Jenis Diklat 1', 'Adumla', 'Walikota Samarinda', '2020', 99, '', ''),
(11, 5, 'test', 'test', 'Walikota Samarinda', '2020', 100, 'images/dok_diklat/37531624849167-mobil2.jpg', 'images/dok_diklat/85961624849167-mobil3.png'),
(12, 14, 'Jenis Diklat 1', 'Adumla', 'Walikota Samarinda', '2001', 201, 'images/dok_diklat/82681624859899-e-asset-disperkim.pdf', 'images/dok_diklat/80531624859899-ijazah1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `duk_pegawai`
--

CREATE TABLE `duk_pegawai` (
  `id_duk` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `catatan_mutasi` varchar(100) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `duk_pegawai`
--

INSERT INTO `duk_pegawai` (`id_duk`, `id_pegawai`, `catatan_mutasi`) VALUES
(1, 9, 'Kepala Dinas Kebersihan dan Pertamanan'),
(3, 24, '-'),
(4, 25, '-cvccvc'),
(6, 33, 'Dinas Lingkungan Hidup'),
(8, 38, '-'),
(9, 40, '-'),
(13, 47, '-'),
(18, 52, '-');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Kepala Dinas'),
(2, 'Sekretaris'),
(3, 'Kepala Bidang Perumahan'),
(5, 'Kepala Bidang Kawasan Permukiman'),
(6, 'Kepala Bidang Prasarana, Sarana, dan Utilitas Umum'),
(7, 'Kepala Sub. Bagian Umum dan Kepegawaian'),
(12, 'Kepala Sub. Bagian Perencanaan dan Keuangan'),
(13, 'Kasi Pendataan dan Perencanaan Perumahan'),
(14, 'Kasi Penyediaan dan Pembiayaan Perumahan'),
(15, 'Kasi Pemantauan dan Pengendalian Kawasan Permukiman'),
(16, 'Kasi Pendataan dan Perencanaan Kawasan Permukiman'),
(17, 'Kasi Pencegahan dan Peningkatan Kawasan Permukiman'),
(18, 'Kasi Pemantauan dan Pengendalian Kawasan Permukiman'),
(19, 'Kasi Pendataan dan Perencanaan PSU'),
(20, 'Kasi Penyediaan dan Pelaksanaan PSU'),
(21, 'Kasi Pemantauan dan Evaluasi Pelaksana PSU');

-- --------------------------------------------------------

--
-- Table structure for table `jenjang_pendidikan`
--

CREATE TABLE `jenjang_pendidikan` (
  `id_jenjang` int(11) NOT NULL,
  `jenjang` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenjang_pendidikan`
--

INSERT INTO `jenjang_pendidikan` (`id_jenjang`, `jenjang`) VALUES
(1, 'SD'),
(2, 'SMP'),
(3, 'SMA/MA/SMK'),
(4, 'D3'),
(5, 'D4'),
(6, 'S1'),
(7, 'S2'),
(8, 'S3');

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `nik_nip` varchar(80) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hubungan` varchar(40) NOT NULL,
  `pekerjaan` varchar(80) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`id_keluarga`, `id_pegawai`, `id_agama`, `nik_nip`, `nama`, `hubungan`, `pekerjaan`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `telepon`, `alamat`) VALUES
(1, 5, 1, '123', 'Nova', 'Suami', 'Guru', 'Pria', 'Tanjung Redeb', '1997-11-27', '08123455566', 'Jalan Slamet Riyadi'),
(2, 5, 1, '1234', 'Rio De Janeiro', 'Saudara Kandung', 'Frontliner BRI', 'Laki - Laki', 'Samarinda', '1997-11-27', '08123456789', 'Jalan Pangeran Antasari'),
(4, 7, 1, '1234567', 'Rahma Indrasari', 'Istri', 'Ibu Rumah Tangga', 'Perempuan', 'Tanjung Redeb', '2021-03-10', '0812444373231', 'Jalan Slamet Riyadi'),
(5, 7, 1, '1234567', 'Muhammad Yudi', 'Anak Kandung', 'Pelajar', 'Laki - Laki', 'Berau, Kalimantan Timur', '2021-03-09', '0812444373231', 'Jalan Pangeran Antasari'),
(6, 7, 1, '123456', 'Abdul Wahab', 'Saudara', 'Pegawai Swasta', 'Laki - Laki', 'Tenggarong', '1997-06-24', '0812345678', 'Jalan M. Yamin'),
(12, 24, 1, '1234567', 'Muhammad Yudi', 'Ayah', 'Kepala Sekolah', 'Laki - Laki', 'Tenggarong', '2021-04-12', '0812444373231', 'Jalan Slamet Riyadi'),
(13, 24, 1, '1234567', 'Agnes Monica', 'Ibu', 'Pegawai Bank', 'Perempuan', 'Kutai Barat', '2021-03-31', '0812444373231', 'Jalan Slamet Riyadi'),
(14, 5, 3, '123456', 'Nova Dwi Sapta', 'Ibu', 'Pegawai Swasta', 'Laki - Laki', 'Kutai Barat', '2021-06-09', '0812444373231', 'dfdfdfd'),
(17, 9, 1, '123456', 'Andi Sadam Anan', 'Ayah', 'Pegawai Bank', 'Laki - Laki', 'Samarinda', '2021-06-28', 'dfdf', 'fvf');

-- --------------------------------------------------------

--
-- Table structure for table `kenaikan_pangkat`
--

CREATE TABLE `kenaikan_pangkat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_golongan` int(11) DEFAULT NULL,
  `pangkat_baru` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmt_kenaikan_pangkat` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kenaikan_pangkat`
--

INSERT INTO `kenaikan_pangkat` (`id`, `id_pegawai`, `id_golongan`, `pangkat_baru`, `tmt_kenaikan_pangkat`, `created_at`, `updated_at`) VALUES
(1, 52, NULL, NULL, NULL, '2021-06-30 06:16:00', '2021-06-30 22:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `kgb`
--

CREATE TABLE `kgb` (
  `id_kgb` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `gaji_pokok_lama` int(11) NOT NULL,
  `gaji_pokok_baru` int(11) NOT NULL,
  `tmt_kenaikan_gaji` date NOT NULL,
  `peraturan` varchar(40) NOT NULL,
  `status_kgb` int(1) DEFAULT NULL,
  `kenaikan_gaji_yad` date NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kgb`
--

INSERT INTO `kgb` (`id_kgb`, `id_pegawai`, `gaji_pokok_lama`, `gaji_pokok_baru`, `tmt_kenaikan_gaji`, `peraturan`, `status_kgb`, `kenaikan_gaji_yad`, `created_at`, `updated_at`) VALUES
(1, 5, 3831900, 3952600, '2021-02-01', 'PP No. 30 Tahun 2015', NULL, '2023-02-01', '2021-02-22', NULL),
(2, 5, 3952600, 4500000, '2023-02-01', 'PP No. 30 Tahun 2015', NULL, '2025-02-01', '2021-02-22', NULL),
(3, 5, 4500000, 5000000, '2025-02-01', 'PP No. 30 Tahun 2015', NULL, '2028-04-03', '2021-02-22', NULL),
(7, 5, 4500000, 5000000, '2025-02-01', 'PP No. 30 Tahun 2015', NULL, '2028-04-03', '2021-03-10', NULL),
(8, 5, 5000000, 5500000, '2021-03-24', 'Peraturan KGB', NULL, '2021-03-26', '2021-03-24', NULL),
(10, 7, 1500000, 1800000, '2021-03-26', 'Peraturan KGB', NULL, '2021-03-28', '2021-03-24', NULL),
(11, 7, 1800000, 2000000, '2021-03-26', 'Peraturan KGB', NULL, '2021-03-28', '2021-03-24', NULL),
(12, 7, 2000000, 2300000, '2021-03-24', 'Peraturan KGB', NULL, '2021-03-26', '2021-03-24', NULL),
(13, 5, 5500000, 6000000, '2021-03-22', 'Peraturan KGB', NULL, '2021-04-16', '2021-03-24', '2021-04-15'),
(14, 7, 2300000, 3000000, '2021-06-08', 'Peraturan KGB', NULL, '2021-06-17', '2021-06-08', NULL),
(15, 5, 6000000, 7000000, '2021-06-09', 'Peraturan KGB', NULL, '2021-06-23', '2021-06-09', NULL),
(16, 9, 1500000, 1750000, '2021-06-20', 'Peraturan KGB', NULL, '2021-06-25', '2021-06-18', NULL),
(17, 7, 3000000, 3200000, '2021-06-17', 'Peraturan KGB', NULL, '2021-06-30', '2021-06-18', NULL),
(18, 5, 7000000, 7200000, '2021-06-23', 'Peraturan KGB', NULL, '2021-06-25', '2021-06-23', NULL),
(19, 25, 1500000, 2000000, '2021-06-15', 'Peraturan KGB', NULL, '2021-06-21', '2021-06-23', '2021-06-23'),
(21, 25, 2000000, 3000000, '2021-06-24', 'fdfdfd', NULL, '2021-06-30', '2021-06-24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `masa_kerja_pegawai`
--

CREATE TABLE `masa_kerja_pegawai` (
  `id_masa_kerja` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `mk_jabatan` varchar(40) NOT NULL,
  `mk_sebelum_cpns` varchar(40) NOT NULL,
  `mk_golongan` varchar(40) NOT NULL,
  `mk_seluruhnya` varchar(40) NOT NULL,
  `total_mkg_hari` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masa_kerja_pegawai`
--

INSERT INTO `masa_kerja_pegawai` (`id_masa_kerja`, `id_pegawai`, `mk_jabatan`, `mk_sebelum_cpns`, `mk_golongan`, `mk_seluruhnya`, `total_mkg_hari`, `updated_at`) VALUES
(4, 5, '3 Tahun 4 Bulan', '5 Tahun 6 Bulan', '6 Tahun 3 Bulan', '6 Tahun 2 Bulan', 2280, '2021-06-24 05:44:13'),
(5, 7, '8 Tahun 2 Bulan', '22 Tahun 8 Bulan', '3 Tahun 4 Bulan', '15 Tahun 6 Bulan', NULL, '2021-03-23 03:28:27'),
(7, 9, '2 Tahun 4 Bulan', '12 Tahun 6 Bulan', '3 Tahun 5 Bulan', '2 Tahun 4 Bulan', NULL, '2021-03-23 03:30:05'),
(9, 24, '2 tahun 4 bulan', '2 tahun 4 bulan', '2 tahun 4 bulan', '2 tahun 4 bulan', NULL, '2021-03-09 04:34:27'),
(10, 25, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', NULL, '2021-03-09 06:44:30'),
(12, 33, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', NULL, '2021-03-19 02:49:16'),
(14, 38, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', NULL, '2021-06-09 02:44:14'),
(15, 40, '4 Tahun 5 Bulan', '2 Tahun 2 Bulan', '3 Tahun 2 Bulan', '3 Tahun 6 Bulan', 1155, '2021-06-15 14:19:30'),
(20, 47, '3 Tahun 3 Bulan', '3 Tahun 3 Bulan', '3 Tahun 3 Bulan', '3 Tahun 3 Bulan', NULL, '2021-06-24 04:08:20'),
(25, 52, '2 Tahun 2 Bulan', '2 Tahun 2 Bulan', '2 Tahun 2 Bulan', '2 Tahun 2 Bulan', NULL, '2021-06-30 14:16:00');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_06_29_064358_create_mutasi_table', 2),
(6, '2021_06_30_125131_create_kenaikan_pangkat_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id_mutasi` int(10) UNSIGNED NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tgl_mutasi` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pangkat_eselon`
--

CREATE TABLE `pangkat_eselon` (
  `id_pangkat_eselon` int(11) NOT NULL,
  `eselon` varchar(5) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pangkat_eselon`
--

INSERT INTO `pangkat_eselon` (`id_pangkat_eselon`, `eselon`, `keterangan`) VALUES
(1, 'IVb', NULL),
(2, 'IVa', NULL),
(3, 'IIIb', NULL),
(8, 'IIIa', NULL),
(9, 'IIb', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pangkat_golongan`
--

CREATE TABLE `pangkat_golongan` (
  `id_pangkat_golongan` int(11) NOT NULL,
  `golongan` varchar(5) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pangkat_golongan`
--

INSERT INTO `pangkat_golongan` (`id_pangkat_golongan`, `golongan`, `keterangan`) VALUES
(1, 'IV/e', 'Pembina Utama'),
(2, 'IV/d', 'Pembina Utama Madya'),
(4, 'IV/c', 'Pembina Utama Muda'),
(7, 'IV/b', 'Pembina Tingkat 1'),
(8, 'IV/a', 'Pembina'),
(9, 'III/d', 'Penata Tingkat 1'),
(10, 'III/c', 'Penata'),
(11, 'III/b', 'Penata Muda Tingkat 1'),
(12, 'III/a', 'Penata Muda'),
(13, 'II/d', 'Pengatur Tingkat 1'),
(14, 'II/c', 'Pengatur'),
(15, 'II/b', 'Pengatur Muda Tingkat 1'),
(16, 'II/a', 'Pengatur Muda'),
(17, 'I/d', 'Juru Tingkat 1'),
(18, 'I/c', 'Juru'),
(19, 'I/b', 'Juru Muda Tingkat 1'),
(20, 'I/a', 'Juru Muda');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_bidang` int(11) DEFAULT NULL,
  `id_status_pegawai` int(11) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_golongan` int(11) DEFAULT NULL,
  `id_eselon` int(11) DEFAULT NULL,
  `id_agama` int(11) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama` varchar(80) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(60) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `karpeg` varchar(50) DEFAULT NULL,
  `bpjs` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `tmt_golongan` date DEFAULT NULL,
  `tmt_cpns` date DEFAULT NULL,
  `tmt_jabatan` date DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_ktp` varchar(100) DEFAULT NULL,
  `gaji_pokok` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(255) NOT NULL,
  `status_kerja` varchar(40) NOT NULL DEFAULT 'aktif',
  `id_user` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_bidang`, `id_status_pegawai`, `id_jabatan`, `id_golongan`, `id_eselon`, `id_agama`, `nip`, `nama`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `karpeg`, `bpjs`, `npwp`, `tmt_golongan`, `tmt_cpns`, `tmt_jabatan`, `no_hp`, `email`, `no_ktp`, `gaji_pokok`, `foto`, `status_kerja`, `id_user`, `updated_at`) VALUES
(5, 1, 1, 1, 1, 1, 1, '196511235 343432 3432', 'Ir. H. Dadang N, MMT', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '082155822621', 'novadwisaptans@gmail.com', '6472031409800004', 7000000, 'images/foto/84971622004754-foto1.jpg', 'aktif', 0, NULL),
(7, 1, 1, 1, 1, 1, 1, '196511235 343432 1232', 'Nova Dwi Sapta Nain Seven', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '08123455674', NULL, NULL, 2300000, 'images/foto/38511622008603-foto3.jpg', 'aktif', 0, NULL),
(9, 1, 1, 1, 1, 1, 1, '196511235 343432 3432123', 'Iqbal Wahyudi', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '082155822621', 'novadwisaptans@gmail.com', '6472031409800004', 1750000, 'images/foto/66301622008566-foto2.jpg', 'aktif', 0, NULL),
(13, 2, 2, 7, NULL, NULL, 1, NULL, 'Deddy Corbuzier', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', NULL, NULL, 0, 'images/foto/95541613537480-583px-logo-kota-samarinda.png', 'aktif', 0, NULL),
(14, 2, 2, 2, NULL, NULL, 1, NULL, 'Uzumaki Naruto', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', NULL, NULL, 0, 'images/foto/23861615861451-foto1.jpg', 'aktif', 0, NULL),
(19, 2, 3, 5, NULL, NULL, 1, '198009142008011023', 'Iker Casillas', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', NULL, NULL, 0, 'images/foto/46091613548625-583px-logo-kota-samarinda.png', 'aktif', 0, NULL),
(22, 3, 2, 6, NULL, NULL, 1, NULL, 'Ma\'ruf', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', NULL, NULL, 0, 'images/foto/92731615870141-foto2.jpg', 'pensiun', 0, NULL),
(24, 3, 1, 14, 4, 1, 3, '12345', 'Anton Topadang', 'Jalan Slamet Riyadi', 'Samarinda', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '08123455674', NULL, NULL, 2500000, 'images/foto/54701622010918-foto2.jpg', 'aktif', NULL, NULL),
(25, 3, 1, 5, 2, 2, 1, '123456', 'Fitri Tropica S.E', 'Jalan Pangeran Antasari', 'Tanjung Redeb', '2021-03-19', 'Perempuan', '123', '123', '773806096722000', '2021-03-05', '2021-03-09', '2021-03-09', '08123456789', NULL, NULL, 0, 'images/foto/42271615349916-react.png', 'aktif', NULL, NULL),
(26, 8, 2, 7, NULL, NULL, 1, NULL, 'Irman Maulana', 'Jalan KH. Agus Salim', 'Samarinda', '2021-03-09', 'Laki - Laki', NULL, '123', '123', NULL, NULL, NULL, '08123456789', NULL, NULL, 0, 'images/foto/51631615789776-foto1.jpg', 'aktif', NULL, NULL),
(30, 8, 3, 6, NULL, NULL, 2, '198009142008011023', 'Ilham Dwi Arifin', 'Jalan AWS. Syahranie 3', 'Kutai Barat', '2000-10-08', 'Laki - Laki', NULL, '123', '123', NULL, NULL, NULL, '08123456789', NULL, NULL, 0, 'images/foto/38451615956842-foto2.jpg', 'aktif', NULL, NULL),
(33, 1, 1, 5, 9, 3, 1, '198009142008011024', 'Roman Apricon', 'Jalan Cipto Mangunkusumo', 'Berau', '1997-03-17', 'Laki - Laki', '6563442', '123123', '12321323', '2021-03-19', '2021-03-19', '2021-03-12', '08123456789', NULL, NULL, 1350000, 'images/foto/87501616122155-foto1.jpg', 'pensiun', NULL, NULL),
(36, 8, 3, 18, NULL, NULL, 1, '1999283847134', 'Rani Nurani', 'Jalan Pangeran Antasari', 'Tanjung Redeb', '2021-03-19', 'Perempuan', NULL, '23123123', '12321323', NULL, NULL, NULL, '08123456789', NULL, NULL, 0, 'images/foto/31461616133343-foto4.jpg', 'aktif', NULL, NULL),
(38, 3, 1, 5, 9, 3, 1, '12312321345', 'Andi Sadam Anan', 'sdsdsdd', 'Tenggarong', '2021-06-09', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-06-09', '2021-06-09', '2021-06-09', '08123455674', NULL, NULL, 2000000, 'images/foto/96971623206654-foto1.jpg', 'aktif', NULL, NULL),
(39, 1, 2, 17, NULL, NULL, 4, NULL, 'Andi Sadam Anan', 'fgfgfgf', 'Tanjung Redeb', '2021-06-09', 'Laki - Laki', NULL, '23123123', '12321323', NULL, NULL, NULL, '08123455674', NULL, NULL, 0, 'images/foto/60351623207652-foto1.jpg', 'aktif', NULL, NULL),
(40, 1, 1, 19, 9, 3, 1, '1111', 'Tretan Muslim', 'Jalan Slamet Riyadi', 'Tenggarong', '2021-06-09', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-06-09', '2021-06-09', '2021-06-09', '08123456789', 'tretan@gmail.com', '6472031409800004', 2500000, 'images/foto/44581623218908-foto2.jpg', 'aktif', NULL, NULL),
(41, 3, 2, 2, NULL, NULL, 1, NULL, 'Leon S. Kennedy', 'dfdfdf', 'Kutai Barat', '2021-06-09', 'Laki - Laki', NULL, '23123123', '12321323', NULL, NULL, NULL, '08123455674', 'leon@gmail.com', '6472031409800004', 0, 'images/foto/28601623221880-foto3.jpg', 'aktif', NULL, NULL),
(44, 1, 3, 18, NULL, NULL, 1, '19800914200801102313', 'Atta Halilintar', 'cdfdf', 'Tanjung Redeb', '2021-06-10', 'Laki - Laki', NULL, '23123123', '12321323', NULL, NULL, NULL, '08123455674', 'atta@gmail.com', '6472031409800004', 0, 'images/foto/67361623326537-foto1.jpg', 'aktif', NULL, NULL),
(47, 2, 1, 14, 4, 2, 2, '123456xx1', 'Choki Pardede', 'dfdfdf', 'Tanjung Redeb', '2021-06-24', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-06-23', '2021-06-24', '2021-06-24', '08123453213', 'novadwisaptans@gmail.com', '6472031409800004', 2500000, 'images/foto/49071624507700-foto2.jpg', 'aktif', NULL, NULL),
(52, 1, 1, 13, 2, 1, 1, '1997272', 'Ian Kasela', 'fdfdfd', 'Tanjung Redeb', '2021-06-30', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-06-30', '2021-06-30', '2021-06-23', '08123455674', 'novadwisaptans@gmail.com', '6472031409800004', 1350000, 'images/foto/4771625062560-foto2.jpg', 'aktif', NULL, '2021-06-30 18:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jenjang` varchar(20) NOT NULL,
  `nama_akademi` varchar(80) NOT NULL,
  `jurusan` varchar(40) NOT NULL,
  `no_ijazah` varchar(50) DEFAULT NULL,
  `tahun_lulus` varchar(6) NOT NULL,
  `foto_ijazah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id_pendidikan`, `id_pegawai`, `jenjang`, `nama_akademi`, `jurusan`, `no_ijazah`, `tahun_lulus`, `foto_ijazah`) VALUES
(3, 5, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2020', 'images/ijazah/31161623125201-paket-hosting.PNG'),
(4, 7, 'S1', 'Politeknik Negeri Samarinda 123', 'Teknologi Informasi', '2323211', '2020', 'images/ijazah/73701615532121-ijazah-sample.jpg'),
(6, 9, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2020', 'images/ijazah/15011613531530-file-pdf.pdf'),
(7, 13, 'S1', 'Politeknik Negeri Samarinda', 'Manajemen Informatika', '123-123-123', '2019', 'images/ijazah/16481613535354-file-pdf.pdf'),
(8, 14, 'S1', 'Politeknik Negeri Samarinda', 'Administrasi Bisnis', '123-123-123', '2019', 'images/ijazah/81421613535515-file-pdf.pdf'),
(12, 19, 'D3', 'Politeknik Negeri Samarinda', 'Teknik Industri', '123-123-123', '2019', 'images/ijazah/51871613548625-file-pdf.pdf'),
(14, 5, 'sma/ma/smk', 'SMK Negeri 001 Berau', 'Multimedia', '10-ac-de-20', '2016', 'images/ijazah/44631623125239-ijazah1.jpg'),
(16, 22, 'S1', 'Politeknik Negeri Samarinda', 'Administrasi Bisnis', '123-123-123', '2019', 'images/ijazah/91581615870062-ijazah-sample.jpg'),
(18, 24, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2020', ''),
(19, 25, 'S1', 'Universitas Mulawarman', 'Manajemen Ekonomi', '123', '2018', 'images/ijazah/32801615272270-file-pdf.pdf'),
(20, 7, 'S1', 'Universitas Mulawarman', 'Ekonomi', '1234', '2018', 'images/ijazah/22861615527331-ijazah-sample.jpg'),
(22, 26, 'D3', 'STIMIK WICIDA', 'Manajemen Informatika', '123', '2018', 'images/ijazah/92301615789777-ijazah-sample.jpg'),
(24, 30, 'S1', 'Widya Gama', 'Hukum', '123', '2018', 'images/ijazah/84611615956842-ijazah-sample.jpg'),
(27, 33, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2018', 'images/ijazah/57871616122156-ijazah-sample.jpg'),
(30, 36, 'S1', 'Universitas Mulawarman', 'Ilmu Pemerintahan', '2323211', '2017', 'images/ijazah/32991616130877-ijazah-sample.jpg'),
(32, 38, 'S1', 'Universitas Mulawarman', 'Manajemen Ekonomi', '123456', '2018', 'images/ijazah/38311623206654-ijazah1.jpg'),
(33, 5, 'D4', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2018', 'images/ijazah/13001623206953-ijazah1.jpg'),
(34, 39, 'S1', 'Universitas Mulawarman', 'Manajemen Ekonomi', '123456', '2021', 'images/ijazah/69661623207652-ijazah1.jpg'),
(35, 40, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2021', 'images/ijazah/93901623218908-ijazah1.jpg'),
(36, 41, 'S2', 'Universitas Mulawarman', 'Teknik Informatika', '1234', '2021', 'images/ijazah/8531623221880-ijazah1.jpg'),
(39, 44, 'D3', 'STIMIK Widya Cipta Dharma', 'Sistem Informasi', '2323211', '2021', 'images/ijazah/55111623326537-ijazah1.jpg'),
(40, 7, 'S1', 'Universitas Mulawarman', 'Teknologi Informasi', '2323211', '2020', 'images/ijazah/29571624458088-ijazah1.jpg'),
(43, 47, 'S1', 'Widya Cipta Dharma', 'Sistem Informasi', '2323211', '2021', 'images/ijazah/45741624507700-ijazah1.jpg'),
(48, 52, 'S1', 'Universitas Mulawarman', 'Manajemen Ekonomi', '1234', '2021', 'images/ijazah/53631625062560-ijazah1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penghargaan`
--

CREATE TABLE `penghargaan` (
  `id_penghargaan` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `nama_penerima` varchar(80) DEFAULT NULL,
  `nama_penghargaan` varchar(50) NOT NULL,
  `pemberi` varchar(80) NOT NULL,
  `tgl_penghargaan` date NOT NULL,
  `dokumentasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penghargaan`
--

INSERT INTO `penghargaan` (`id_penghargaan`, `id_pegawai`, `nama_penerima`, `nama_penghargaan`, `pemberi`, `tgl_penghargaan`, `dokumentasi`) VALUES
(1, 5, NULL, 'Penghargaan sebagai Kepala Dinas Terbaik 2021', 'Walikota Samarinda', '2021-12-10', 'images/dok_penghargaan/85301613634561-file-pdf.pdf'),
(2, 5, NULL, 'Penghargaan sebagai Kepala Dinas Terbaik 2021 2', 'Walikota Samarinda 2', '2021-12-10', 'images/dok_penghargaan/42691613634587-file-pdf.pdf'),
(7, 14, 'Rony Purnomo', 'Futsal juara 3', 'Gubernur Kaltim', '2021-10-08', ''),
(8, 9, 'Rony Purnomo', 'Futsal juara 3', 'Gubernur Kaltim', '2021-10-08', ''),
(9, 7, NULL, 'Penghargaan atas kepimpinan selama bekerja', 'Walikota Samarinda', '2021-03-15', 'images/dok_penghargaan/95971615771010-sertifikat-sample.JPG'),
(10, 13, NULL, 'Penghargaan atas kepimpinan selama bekerja 2', 'Walikota Samarinda', '2021-03-17', 'images/dok_penghargaan/91471615951069-sertifikat-sample.JPG'),
(11, 24, NULL, 'Penghargaan atas kepimpinan selama bekerja testing', 'Walikota Samarinda', '2021-04-07', 'images/dok_penghargaan/15801617763499-sertifikat-sample.JPG'),
(12, 7, NULL, 'Penghargaan atas kepimpinan selama bekerja 2', 'Walikota Samarinda', '2021-04-07', 'images/dok_penghargaan/70611617758906-file-pdf.pdf'),
(13, 13, NULL, 'Penghargaan atas kepimpinan selama bekerja', 'Walikota Samarinda', '2021-04-05', 'images/dok_penghargaan/23861617761414-sertifikat-sample.JPG'),
(15, 9, NULL, 'Penghargaan atas kepimpinan selama bekerja 2', 'Walikota Samarinda', '2021-06-09', 'images/dok_penghargaan/12501623728096-e-asset-disperkim.pdf'),
(16, 5, NULL, 'Penghargaan atas kepimpinan selama bekerja 2', 'Walikota Samarinda 2', '2021-06-24', 'images/dok_penghargaan/33041624501996-ijazah1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pensiun`
--

CREATE TABLE `pensiun` (
  `id_pensiun` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tgl_pensiun` date NOT NULL,
  `keterangan` text NOT NULL,
  `status_pensiun` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pensiun`
--

INSERT INTO `pensiun` (`id_pensiun`, `id_pegawai`, `tgl_pensiun`, `keterangan`, `status_pensiun`, `created_at`, `updated_at`) VALUES
(6, 33, '2021-04-09', 'Memutuskan berhenti untuk beristirahat', 1, '2021-04-07 05:51:00', '2021-04-08'),
(7, 22, '2021-06-11', 'lorem ipsum dolor sit amet', 1, '2021-06-08 07:35:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'user-token', 'e6084ed5de45048b2e4715d19424cbe69395030c7a71b9428afc5b37d81adb47', '[\"*\"]', '2021-02-24 20:29:53', '2021-02-24 20:28:24', '2021-02-24 20:29:53'),
(3, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'dd340c094e7370645137d020e2c72ed37746d3513c190c369b9321f10fdc4d6f', '[\"*\"]', '2021-02-28 19:27:44', '2021-02-25 22:44:43', '2021-02-28 19:27:44'),
(4, 'App\\Models\\User', 2, 'novadwisaptanainseven', '116dc1f16304417c12a9c8fcae3df62aca14e03e9c4283e43417674b67907617', '[\"*\"]', '2021-06-30 18:36:22', '2021-02-28 18:28:04', '2021-06-30 18:36:22'),
(5, 'App\\Models\\User', 3, 'iqbalwahyudi', '17bf2c6e7b2d44460536e59d9558b09013c19ebe540b6e3129447e3f716779bd', '[\"*\"]', '2021-02-28 19:55:25', '2021-02-28 19:52:53', '2021-02-28 19:55:25'),
(6, 'App\\Models\\User', 3, 'iqbalwahyudi', '56d67705cf4a6287a99d01bf6b26d9104938e8b5c2716ecb08ae8d370700fa0e', '[\"*\"]', NULL, '2021-03-02 22:16:46', '2021-03-02 22:16:46'),
(7, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'c872e6562a64a86cadf6e7d6e0021238ad819cb7a9f5e1005754dd364a95d54d', '[\"*\"]', NULL, '2021-03-02 23:08:21', '2021-03-02 23:08:21'),
(8, 'App\\Models\\User', 3, 'iqbalwahyudi', 'b574d0179846509668dff259e56e9cda0c862f84f9db1b73f1a1e5c1a24d422b', '[\"*\"]', NULL, '2021-03-02 23:14:35', '2021-03-02 23:14:35'),
(9, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'f59c7c08225a249f5cab382d066b7ff1161d1890574439a4b8c00cae9fc4bc7f', '[\"*\"]', NULL, '2021-03-02 23:19:14', '2021-03-02 23:19:14'),
(10, 'App\\Models\\User', 3, 'iqbalwahyudi', '0970bf8c9a943a76d0cd616753b7bb8151b7577589f7110491309edb89782ed6', '[\"*\"]', NULL, '2021-03-02 23:20:01', '2021-03-02 23:20:01'),
(11, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'ae89a2e35dd6f5b2b67773a70a5f90f0e8e1f38d397b925176db4b87ff712dfa', '[\"*\"]', NULL, '2021-03-03 17:48:43', '2021-03-03 17:48:43'),
(12, 'App\\Models\\User', 3, 'iqbalwahyudi', 'ebd958564b093fec966f95cdfee99ce73204ae68ed26788f9506fc30a893d130', '[\"*\"]', NULL, '2021-03-03 17:50:42', '2021-03-03 17:50:42'),
(13, 'App\\Models\\User', 2, 'novadwisaptanainseven', '55fc606b2473874e9b37037b258b1be31fcfb47ff3b8e5fa8df43555fe6abd28', '[\"*\"]', NULL, '2021-03-03 17:52:23', '2021-03-03 17:52:23'),
(14, 'App\\Models\\User', 2, 'novadwisaptanainseven', '2f0f379cde920f5e7fb722bb7f5de4cc27522f92de2ad7facbd993f57a352406', '[\"*\"]', NULL, '2021-03-03 17:54:27', '2021-03-03 17:54:27'),
(15, 'App\\Models\\User', 2, 'novadwisaptanainseven', '0c659ef5d04fbc28a146abeb50907e4e20d08b3b79f17513ceff3e16892fcd63', '[\"*\"]', NULL, '2021-03-03 18:06:56', '2021-03-03 18:06:56'),
(16, 'App\\Models\\User', 2, 'novadwisaptanainseven', '6243cdbb02a826108d4ef47142d7bf01e5a0248d8dccbb6b1cc95f38ab04430d', '[\"*\"]', NULL, '2021-03-03 18:13:02', '2021-03-03 18:13:02'),
(17, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'c4fa30f0a77e1672e7aa993dac53b5c765e558d2e3fa96508bb10de140507bb2', '[\"*\"]', NULL, '2021-03-03 18:14:09', '2021-03-03 18:14:09'),
(18, 'App\\Models\\User', 2, 'novadwisaptanainseven', '7608f4031ef849740f107b3f52d7aa60c4c4903a33a450a850fa34e7eb054292', '[\"*\"]', NULL, '2021-03-03 18:15:46', '2021-03-03 18:15:46'),
(19, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'b6040e7cbee6627725ecd78e7200788527e86512fbb21d7a9ec633ea649d3fae', '[\"*\"]', NULL, '2021-03-03 18:16:53', '2021-03-03 18:16:53'),
(20, 'App\\Models\\User', 2, 'novadwisaptanainseven', '10ff4517156ce2472223137e5d882956ba9db8eaad178c479f0fe273c9f195c8', '[\"*\"]', NULL, '2021-03-03 18:33:20', '2021-03-03 18:33:20'),
(21, 'App\\Models\\User', 2, 'novadwisaptanainseven', '564573a61f285fd6b074b4da5a54559a7463e394dbbc11237efae8f54da3c463', '[\"*\"]', NULL, '2021-03-03 18:34:46', '2021-03-03 18:34:46'),
(27, 'App\\Models\\User', 2, 'novadwisaptanainseven', '47687a516474f0adfbdb6e2ddd8bf9554eae639591489bbd1e1948ffcd1a12e2', '[\"*\"]', '2021-03-03 23:26:49', '2021-03-03 22:45:03', '2021-03-03 23:26:49'),
(28, 'App\\Models\\User', 2, 'novadwisaptanainseven', '3d2272432b8d5db202cc715ca1af59e5a145421841788a906b810dc5310145c1', '[\"*\"]', '2021-03-03 23:40:40', '2021-03-03 23:40:38', '2021-03-03 23:40:40'),
(29, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'ef9f6f62a9cf1faba3c1ae86b7ae5bf41ae23ab6a816a50200c7d320f7e6a3a6', '[\"*\"]', '2021-03-03 23:45:48', '2021-03-03 23:43:09', '2021-03-03 23:45:48'),
(30, 'App\\Models\\User', 3, 'iqbalwahyudi', '74ce7bf07c6c7239e46c1a32619497a1690b0b551709bc13bda92e42b4e6d9d4', '[\"*\"]', '2021-03-03 23:47:18', '2021-03-03 23:46:52', '2021-03-03 23:47:18'),
(32, 'App\\Models\\User', 2, 'novadwisaptanainseven', '3791a62a2ee6d3dbf6348dcdac80565ac430d7459e2c3d3f4d479e2852d17094', '[\"*\"]', '2021-03-04 00:10:49', '2021-03-04 00:10:21', '2021-03-04 00:10:49'),
(33, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'b1e434e1c645386960b5b2bd0e5b0090d41c10ddde68a1071652ad1fa36adff2', '[\"*\"]', '2021-03-04 22:56:21', '2021-03-04 17:25:02', '2021-03-04 22:56:21'),
(34, 'App\\Models\\User', 2, 'novadwisaptanainseven', '2f88228ebd567a8dbb869c27719482cf81149d359d2938bf782c4c7f67d80210', '[\"*\"]', '2021-03-07 18:37:41', '2021-03-07 17:25:20', '2021-03-07 18:37:41'),
(35, 'App\\Models\\User', 2, 'novadwisaptanainseven', '3421f6090f915ea391ef9d7e83b3bbabaa370dc8f905a0f119647806e81c25f6', '[\"*\"]', '2021-03-07 23:53:34', '2021-03-07 18:46:09', '2021-03-07 23:53:34'),
(37, 'App\\Models\\User', 4, '12345', '43e550641ca40b70e4de5ef49d16da25ac9dd579449aeeb09e8c58a9fd90eb23', '[\"*\"]', '2021-03-08 20:35:52', '2021-03-08 20:35:45', '2021-03-08 20:35:52'),
(38, 'App\\Models\\User', 2, 'novadwisaptanainseven', '43479f9722ab9dfe69cd139c1e14f43fee7dd3cba0bac9f9fce9ab01bc16c93b', '[\"*\"]', '2021-03-08 22:47:40', '2021-03-08 21:38:51', '2021-03-08 22:47:40'),
(39, 'App\\Models\\User', 5, '123456', '03f5b297aa66c19434795971c36b84ce4eb1d8bdecedb705828842870fc7747f', '[\"*\"]', '2021-03-08 22:49:34', '2021-03-08 22:49:29', '2021-03-08 22:49:34'),
(40, 'App\\Models\\User', 2, 'novadwisaptanainseven', '63a06ad871a82ccbf7e48b7a107f76adb69e80ca446c180d432e8783707a5d9d', '[\"*\"]', '2021-03-08 22:50:18', '2021-03-08 22:49:59', '2021-03-08 22:50:18'),
(41, 'App\\Models\\User', 2, 'novadwisaptanainseven', '59075738ab2c0dc5bef9d652a935403cb809a4b9a7c48023dd3005ca33cd5f72', '[\"*\"]', '2021-03-10 00:34:33', '2021-03-09 18:49:00', '2021-03-10 00:34:33'),
(42, 'App\\Models\\User', 2, 'novadwisaptanainseven', '48803761621ec0a0af99539c2e1523a51a6de286a1237f2f388810c8818c492b', '[\"*\"]', '2021-03-11 23:06:13', '2021-03-11 17:32:25', '2021-03-11 23:06:13'),
(43, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'b7852b73e18bfb7863f85533dd439ebd39f39f6e3665f36c978cfc73b5588b15', '[\"*\"]', '2021-03-14 23:15:50', '2021-03-14 16:54:11', '2021-03-14 23:15:50'),
(44, 'App\\Models\\User', 2, 'novadwisaptanainseven', '6241f2e294bbc8d795ef4e04652a25e9113e4175833c86a42306127e6d37d2ac', '[\"*\"]', '2021-03-15 21:21:55', '2021-03-15 17:16:56', '2021-03-15 21:21:55'),
(45, 'App\\Models\\User', 2, 'novadwisaptanainseven', '961572be0c0fa76fabd89a91f47b59822c3cfa62640c11b13638f61d02489e15', '[\"*\"]', '2021-03-16 22:43:01', '2021-03-16 18:17:15', '2021-03-16 22:43:01'),
(46, 'App\\Models\\User', 2, 'novadwisaptanainseven', '9fc9237d4858147b4a32b2fa6916977743f4439d55466545d57e2e2a7a23a85e', '[\"*\"]', '2021-03-18 00:25:51', '2021-03-17 17:25:17', '2021-03-18 00:25:51'),
(47, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'd467d677936ef69131a15bc08b700ee6fad721fc990820556d797b6ed2c19295', '[\"*\"]', '2021-03-18 21:56:04', '2021-03-18 17:43:25', '2021-03-18 21:56:04'),
(48, 'App\\Models\\User', 2, 'novadwisaptanainseven', '8194250c0f71201d5d688f8f0963782b23c513d2266b7dfb59d04557773a1ed4', '[\"*\"]', '2021-03-21 22:55:00', '2021-03-21 17:44:03', '2021-03-21 22:55:00'),
(49, 'App\\Models\\User', 2, 'novadwisaptanainseven', '2978492f1ab933aeb3ca47ae0a44d32875d1179de64c049173a109c6e451387d', '[\"*\"]', '2021-03-22 23:44:48', '2021-03-22 17:59:07', '2021-03-22 23:44:48'),
(50, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'a225da660c6dc57d52e26fdfd4214256e3981b78db22a9ad228885f4b40f89fc', '[\"*\"]', '2021-03-23 23:37:34', '2021-03-23 17:09:41', '2021-03-23 23:37:34'),
(51, 'App\\Models\\User', 2, 'novadwisaptanainseven', '93fbe2934a21d6fb27a4a36c578c8fda02fbef0856285b269cfcd2225988fd05', '[\"*\"]', '2021-03-24 18:16:16', '2021-03-24 18:15:02', '2021-03-24 18:16:16'),
(52, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'c40d0be476e1cbc6cef11a9d6019d8213068d680bfa43fee63b28529bae40c01', '[\"*\"]', '2021-03-24 21:57:22', '2021-03-24 18:25:57', '2021-03-24 21:57:22'),
(53, 'App\\Models\\User', 2, 'novadwisaptanainseven', '6838230a7ac68d5a5e862b7f232d74124e221e64cc24d69a687674d608ab8dec', '[\"*\"]', '2021-03-25 19:23:23', '2021-03-25 16:46:59', '2021-03-25 19:23:23'),
(54, 'App\\Models\\User', 2, 'novadwisaptanainseven', '442ef03757cbe11e09eebc5134a9903a7b6bf7bf07aa1f33ea63e4f6b790a842', '[\"*\"]', '2021-03-28 23:54:22', '2021-03-28 18:48:49', '2021-03-28 23:54:22'),
(55, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'b8388480082498d6f5374354e76a6929c675c6721922eb6ece2ac67996500d4f', '[\"*\"]', '2021-03-29 19:45:51', '2021-03-29 17:03:42', '2021-03-29 19:45:51'),
(56, 'App\\Models\\User', 2, 'novadwisaptanainseven', '75392d0364c9b0b5a555267de3689116ff8c4c70c4c104dc37234d629588c398', '[\"*\"]', '2021-03-29 23:45:59', '2021-03-29 19:47:32', '2021-03-29 23:45:59'),
(57, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'f62dbdbb293357a47fcd9149f7825f8539c8fd95d4b88898a6b472599bcf8b77', '[\"*\"]', '2021-03-31 22:33:34', '2021-03-31 17:17:37', '2021-03-31 22:33:34'),
(58, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'a638898dc3c10f96d0cd526de5facb3dd74cb25f979412b1efbaae4d712fe04a', '[\"*\"]', '2021-03-31 23:23:47', '2021-03-31 22:49:22', '2021-03-31 23:23:47'),
(59, 'App\\Models\\User', 2, 'novadwisaptanainseven', '131ab285e755f43615d3aa125b787befff9b33a317d46c1ff7b5b3956160b6c5', '[\"*\"]', '2021-04-01 21:45:03', '2021-04-01 17:49:35', '2021-04-01 21:45:03'),
(60, 'App\\Models\\User', 2, 'novadwisaptanainseven', '7e9d52dcfebaa5cc03aa6f4c3ccd7e6c0d23184c68663c89b73bab4df20f7ade', '[\"*\"]', '2021-04-04 23:48:23', '2021-04-04 18:10:26', '2021-04-04 23:48:23'),
(61, 'App\\Models\\User', 2, 'novadwisaptanainseven', '91678e3ab1f0d1406d920885f5c36a83dfde28b9afb7801001c9073f4dbae70f', '[\"*\"]', '2021-04-05 23:01:22', '2021-04-05 17:43:51', '2021-04-05 23:01:22'),
(62, 'App\\Models\\User', 2, 'novadwisaptanainseven', '91ce9fe8dcf00cef9aedd468cd932e7edc3fbc3056175b3dc2f2b3f21332133b', '[\"*\"]', '2021-04-06 22:20:46', '2021-04-06 17:12:17', '2021-04-06 22:20:46'),
(63, 'App\\Models\\User', 2, 'novadwisaptanainseven', '5125b3d904d6ee7b7e209a98ff1f362748a125146ee9dadf82f8a46a6a4d2bfe', '[\"*\"]', '2021-04-07 22:46:38', '2021-04-07 19:31:27', '2021-04-07 22:46:38'),
(64, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'accd31b2627f0a4356c14fb04de5379d215cea8200e0caea59d47dbda7fc19aa', '[\"*\"]', '2021-04-11 17:32:48', '2021-04-11 17:32:35', '2021-04-11 17:32:48'),
(65, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'cba4353b46326a39bffe827cf60300dda2f3b2fca91539d90f6f271750c99689', '[\"*\"]', '2021-04-11 20:09:32', '2021-04-11 17:54:27', '2021-04-11 20:09:32'),
(66, 'App\\Models\\User', 2, 'novadwisaptanainseven', '8e9dd68237698c1b880759c8f3331e6ed12a4f80e0052dc95994939d8f32b5e3', '[\"*\"]', '2021-04-11 22:12:49', '2021-04-11 22:09:03', '2021-04-11 22:12:49'),
(68, 'App\\Models\\User', 4, '12345', 'c39d13023b43c1b669b50de13fcc7268eceb86ac085c460f5b0c7d853c91aa6c', '[\"*\"]', '2021-04-11 23:01:23', '2021-04-11 22:38:33', '2021-04-11 23:01:23'),
(69, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'a3571e136eedf079e68df2bc281756d9e71427096e99b844c2c70a5d26b31698', '[\"*\"]', '2021-04-11 23:10:26', '2021-04-11 23:05:06', '2021-04-11 23:10:26'),
(70, 'App\\Models\\User', 4, '12345', 'a7eb7c90bb2db7225ce63d629eadcfa9c2e6c628ba1416cc6f6daf501c2adfa8', '[\"*\"]', '2021-04-11 23:20:18', '2021-04-11 23:10:47', '2021-04-11 23:20:18'),
(71, 'App\\Models\\User', 4, '12345', '073af99f06665a55e60a2b5cb5842d7af2b8882b56500e0a8a1716ad3ce3779d', '[\"*\"]', '2021-04-12 18:19:50', '2021-04-12 18:03:03', '2021-04-12 18:19:50'),
(73, 'App\\Models\\User', 4, '12345', '5fee0685b878e1611f14f24eef021bddd019d91cb067cd92e8999489db30e8b3', '[\"*\"]', '2021-04-12 19:22:27', '2021-04-12 18:23:59', '2021-04-12 19:22:27'),
(74, 'App\\Models\\User', 2, 'novadwisaptanainseven', '681cdf65c075469ea3d9bf3afb36e1aa52287b7ed1b31a260aa6b4404fb79866', '[\"*\"]', '2021-04-13 20:38:39', '2021-04-13 17:29:05', '2021-04-13 20:38:39'),
(75, 'App\\Models\\User', 2, 'novadwisaptanainseven', '958b0a8070e6e62c89d0f846a903ad7eeb2c4c4ebe2cd1a2986baeed59a65791', '[\"*\"]', '2021-04-14 22:29:54', '2021-04-14 17:53:10', '2021-04-14 22:29:54'),
(76, 'App\\Models\\User', 2, 'novadwisaptanainseven', '952029b03c0f47997e17c39a11e88a4b9ebfaba3b4a614eaaa979db624d12be0', '[\"*\"]', '2021-04-18 05:24:23', '2021-04-18 05:24:09', '2021-04-18 05:24:23'),
(77, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'b62144c5fcc7a979e1f5f6524604dfcf41e957518561732ef0498c30f99d7170', '[\"*\"]', '2021-04-24 22:17:02', '2021-04-24 22:16:37', '2021-04-24 22:17:02'),
(78, 'App\\Models\\User', 2, 'novadwisaptanainseven', '89c8f47dc998110b2f778c058c66f20a8c14bc00018629fdd2f1f0fc440b2d3c', '[\"*\"]', '2021-05-03 23:01:31', '2021-05-03 22:13:13', '2021-05-03 23:01:31'),
(79, 'App\\Models\\User', 3, 'iqbalwahyudi', 'b3e6f52ac38d482e328a42566b991a4e96ee5e645c1f8d0f1e5e98b14b384244', '[\"*\"]', '2021-05-03 23:27:16', '2021-05-03 23:05:10', '2021-05-03 23:27:16'),
(80, 'App\\Models\\User', 2, 'novadwisaptanainseven', '12d06780756353ab9f761bed12578ec119bb8e42e8183ea5454fcc2c69afb821', '[\"*\"]', '2021-05-09 18:07:06', '2021-05-09 17:49:28', '2021-05-09 18:07:06'),
(81, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'ce87078404f1c42544bc72e093025920aa5ac472b5565f10898d4b6a434e5c93', '[\"*\"]', '2021-05-10 21:55:52', '2021-05-10 18:50:08', '2021-05-10 21:55:52'),
(82, 'App\\Models\\User', 2, 'novadwisaptanainseven', '1b6b9b3e112fdfff1a0c3a73ecf73d7d6d2bced140fc46f593a10f5eb7f7b1c4', '[\"*\"]', '2021-05-14 10:02:53', '2021-05-14 07:00:50', '2021-05-14 10:02:53'),
(83, 'App\\Models\\User', 2, 'novadwisaptanainseven', '1ff89f21a09a7372c97d2a1af3a26db824038bfcac63cfaa116efd17f2be33b2', '[\"*\"]', '2021-05-15 08:12:31', '2021-05-15 04:42:08', '2021-05-15 08:12:31'),
(84, 'App\\Models\\User', 2, 'novadwisaptanainseven', '1fe344d993a55ba9369fdf266c3ee72d9dc21e2bd4acf9c4b64c518448693478', '[\"*\"]', '2021-05-15 09:12:59', '2021-05-15 08:24:53', '2021-05-15 09:12:59'),
(85, 'App\\Models\\User', 2, 'novadwisaptanainseven', '5f4de03fe16d394583d90b7721eb0a1bfff27e77823dfe90ffeb82da02259929', '[\"*\"]', '2021-05-16 23:38:23', '2021-05-16 17:19:18', '2021-05-16 23:38:23'),
(86, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'ce44e04596db44511f12c0726e8741b30aa4a88a234b33fca244f87f07977cda', '[\"*\"]', '2021-05-25 22:35:20', '2021-05-25 20:52:08', '2021-05-25 22:35:20'),
(87, 'App\\Models\\User', 2, 'novadwisaptanainseven', '6fd086be05598cb997051888b33a8302d9af97d8277a33b6a4dc76ef57a6b91e', '[\"*\"]', '2021-06-07 23:37:13', '2021-06-07 19:20:36', '2021-06-07 23:37:13'),
(88, 'App\\Models\\User', 3, 'iqbalwahyudi', '968101244bde5932ce27f025264441e5ec3aaeb81b09a7e4b76b93b31f986110', '[\"*\"]', '2021-06-07 23:41:25', '2021-06-07 23:37:27', '2021-06-07 23:41:25'),
(89, 'App\\Models\\User', 2, 'novadwisaptanainseven', '6dc994902280c8fca0b11828093d5a2cc26726e510a517d73dc2f91b913e6cd8', '[\"*\"]', '2021-06-08 18:05:15', '2021-06-08 17:53:45', '2021-06-08 18:05:15'),
(90, 'App\\Models\\User', 2, 'novadwisaptanainseven', '51efbb71c24d3297dc833db9b72a29cb1702faec663463161d4d2dab8f38c67c', '[\"*\"]', '2021-06-08 19:56:15', '2021-06-08 18:22:09', '2021-06-08 19:56:15'),
(91, 'App\\Models\\User', 3, 'iqbalwahyudi', '01e50274af83ccc87a4e98eca8b66a3cebb9b0e0142f9c148504c96449f0773b', '[\"*\"]', '2021-06-08 19:58:11', '2021-06-08 19:56:40', '2021-06-08 19:58:11'),
(92, 'App\\Models\\User', 2, 'novadwisaptanainseven', '29e1368f8ffee693734596de3a2d11a3f03acb4c2572f2f47a2feeb087e9442b', '[\"*\"]', '2021-06-08 20:02:28', '2021-06-08 20:02:26', '2021-06-08 20:02:28'),
(93, 'App\\Models\\User', 2, 'novadwisaptanainseven', '1b2c84ac0b21d4f86fbee49727b775da6914d90e0b04b1e08ee2c7e7dd121013', '[\"*\"]', '2021-06-08 23:07:54', '2021-06-08 21:54:31', '2021-06-08 23:07:54'),
(94, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'e56e55c8dd75603a6daed03e6e34285a5287869341ddf94a41c486f6714836d4', '[\"*\"]', '2021-06-09 18:56:09', '2021-06-09 18:48:35', '2021-06-09 18:56:09'),
(95, 'App\\Models\\User', 2, 'novadwisaptanainseven', '9c29816685dd3fe2d4e8a9c6f6db34ada046d3862f258e4d79405f7817611ae7', '[\"*\"]', '2021-06-09 22:19:36', '2021-06-09 19:10:30', '2021-06-09 22:19:36'),
(96, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'f1e0297e20de4bd51d73ceb6e7d0956ac409eba0b73ceacc7e62fa84abae5e5c', '[\"*\"]', '2021-06-10 07:22:29', '2021-06-10 03:46:27', '2021-06-10 07:22:29'),
(97, 'App\\Models\\User', 2, 'novadwisaptanainseven', '579d2fa00b0f050e198b9201b9dda62480d87c6efd07516ab14e54e66084e992', '[\"*\"]', '2021-06-30 21:57:16', '2021-06-10 17:42:51', '2021-06-30 21:57:16'),
(98, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'a9a3e3de014f9b9cd88f2790d3ef08c170457d8491923761d2ff1c7a8b260b42', '[\"*\"]', '2021-06-12 06:04:22', '2021-06-11 23:03:58', '2021-06-12 06:04:22'),
(99, 'App\\Models\\User', 2, 'novadwisaptanainseven', '8319fa99492f8fcf3aabbcdb4372a4e9edef55817089c2baea6a4f1dc7c51808', '[\"*\"]', '2021-06-12 08:54:46', '2021-06-12 08:54:35', '2021-06-12 08:54:46'),
(100, 'App\\Models\\User', 2, 'novadwisaptanainseven', '9ce3e68d77904df1041248de198649d2229e1569c615f9e72200bda32762a795', '[\"*\"]', '2021-06-14 07:49:38', '2021-06-13 17:50:00', '2021-06-14 07:49:38'),
(101, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'e941fa040d78b46f50784ecddefe91fdc38849b160050d70244147e660ff6f5a', '[\"*\"]', '2021-06-15 00:01:17', '2021-06-14 19:10:17', '2021-06-15 00:01:17'),
(102, 'App\\Models\\User', 2, 'novadwisaptanainseven', '7226e61e4f06f655143c46ba0741095ac8f3d692f52c2e3abf57398d4cb497ac', '[\"*\"]', '2021-06-15 22:14:14', '2021-06-15 05:44:28', '2021-06-15 22:14:14'),
(103, 'App\\Models\\User', 2, 'novadwisaptanainseven', '2cc8bd981d1e89174b925b91e4423ee99527ec960e7daca6acce48d979a7bbb8', '[\"*\"]', '2021-06-17 00:06:24', '2021-06-16 23:34:05', '2021-06-17 00:06:24'),
(104, 'App\\Models\\User', 2, 'novadwisaptanainseven', '6b4d0f613c9e4310ab3002b68c23f53d5e28d73c98374fd7a6d1000c9348e8b9', '[\"*\"]', '2021-06-18 05:26:01', '2021-06-17 22:00:49', '2021-06-18 05:26:01'),
(105, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'bea6c287dcf86042083f759e289e9f28705a96b6fca8c8482e9d6ce0861b72d9', '[\"*\"]', '2021-06-20 23:37:37', '2021-06-20 18:34:36', '2021-06-20 23:37:37'),
(106, 'App\\Models\\User', 2, 'novadwisaptanainseven', '183316ae4bc5e332790a952248c73d98c891a33b758f68a951c61153aac78259', '[\"*\"]', '2021-06-21 18:44:32', '2021-06-21 17:28:00', '2021-06-21 18:44:32'),
(107, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'ab399bed875907c5a6013228dc05660593966cf0f8153add7751b25138ca352b', '[\"*\"]', '2021-06-22 08:09:44', '2021-06-22 03:32:08', '2021-06-22 08:09:44'),
(108, 'App\\Models\\User', 2, 'novadwisaptanainseven', '474624af62e955e86f439b63f2f54e20bc844cac4e46ff21427274f24052e2d7', '[\"*\"]', '2021-06-22 22:48:32', '2021-06-22 18:26:36', '2021-06-22 22:48:32'),
(109, 'App\\Models\\User', 2, 'novadwisaptanainseven', '048fedde495295937d780f436d9c9af6d6ea04c7fdb2526f48d3d2b0c80de8fa', '[\"*\"]', '2021-06-23 07:14:44', '2021-06-23 03:32:13', '2021-06-23 07:14:44'),
(110, 'App\\Models\\User', 2, 'novadwisaptanainseven', '7c3d3de562f4ed91ac00d2cb72f47cc09a5f9e341da78c2f5b50bcd3d0540131', '[\"*\"]', '2021-06-23 20:16:04', '2021-06-23 18:05:03', '2021-06-23 20:16:04'),
(111, 'App\\Models\\User', 3, 'iqbalwahyudi', '31bc6b129427d2b2fdd3c7ce367286ad0c9f23067f5dd23e32114eea8de22879', '[\"*\"]', '2021-06-23 20:20:28', '2021-06-23 20:17:11', '2021-06-23 20:20:28'),
(112, 'App\\Models\\User', 2, 'novadwisaptanainseven', '6c4fe0a5578f28053a67d0acb34c56f7b91256d2d5bf2e48d40015760a4cf661', '[\"*\"]', '2021-06-23 21:27:18', '2021-06-23 21:21:17', '2021-06-23 21:27:18'),
(113, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'ed55b895d23f5e57f054f9ae60600c275367a0ce4b5fb3d944ae0315eab00cb2', '[\"*\"]', '2021-06-23 23:57:46', '2021-06-23 21:32:05', '2021-06-23 23:57:46'),
(114, 'App\\Models\\User', 2, 'novadwisaptanainseven', '0aa7990e6a48604ef68f97df1f404e09252adc5a1031dfeaa477a2a9398c0b16', '[\"*\"]', '2021-06-27 22:20:37', '2021-06-27 18:01:51', '2021-06-27 22:20:37'),
(115, 'App\\Models\\User', 3, 'iqbalwahyudi', 'c542f9e4db209256356a497d47595e0ab0aea73d835ee741b2a0e389a3ccc063', '[\"*\"]', '2021-06-27 22:45:46', '2021-06-27 22:30:17', '2021-06-27 22:45:46'),
(116, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'a7f48a7e09c5740ecf219cb23a8707b96662502b8a8f9ac4283bf86e7ebe6e21', '[\"*\"]', '2021-06-27 22:47:05', '2021-06-27 22:46:14', '2021-06-27 22:47:05'),
(117, 'App\\Models\\User', 3, 'iqbalwahyudi', '704a4cdab6cc2d5547abc4e44abc4c3b39650aeba047b982b4eb23b0794d6fa2', '[\"*\"]', '2021-06-27 23:12:21', '2021-06-27 22:47:29', '2021-06-27 23:12:21'),
(118, 'App\\Models\\User', 2, 'novadwisaptanainseven', '45b11872628ec37bbdbd0bce41ac096bb1002f365961100058fcdf981c8c81c0', '[\"*\"]', '2021-06-27 23:20:26', '2021-06-27 23:19:56', '2021-06-27 23:20:26'),
(119, 'App\\Models\\User', 2, 'novadwisaptanainseven', '03afbe6f60cf31aa0da0f14774c6a06d5043bd7bee5d183ac0172981befe486b', '[\"*\"]', '2021-06-28 06:14:59', '2021-06-28 06:01:31', '2021-06-28 06:14:59'),
(120, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'f64fbfac7e3e924c58f770c350feb0f7e1c2a934bdb7cfe4cfa80d7b533d2bd2', '[\"*\"]', '2021-06-28 06:17:43', '2021-06-28 06:15:45', '2021-06-28 06:17:43'),
(121, 'App\\Models\\User', 2, 'novadwisaptanainseven', '293def9547d7f22f4101a81746e30efc766b3a201ac1211c7e0b83425b218e6d', '[\"*\"]', '2021-06-28 06:21:46', '2021-06-28 06:20:42', '2021-06-28 06:21:46'),
(122, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'a2bb784e629b86dc4f1b9763213449fd36f729bfe93782525b38d0f9b31eb388', '[\"*\"]', '2021-06-28 06:23:05', '2021-06-28 06:22:58', '2021-06-28 06:23:05'),
(123, 'App\\Models\\User', 2, 'novadwisaptanainseven', '32143db8d10d2077329d89d3c4c075f9910ff7d0b37d6e8e3fdf118137aa71fe', '[\"*\"]', '2021-06-28 06:24:06', '2021-06-28 06:24:01', '2021-06-28 06:24:06'),
(124, 'App\\Models\\User', 2, 'novadwisaptanainseven', '28746a99a446ec0427a2aebc40954c266e4e2de0e6ee03de4a33c36313436a14', '[\"*\"]', '2021-06-28 07:19:25', '2021-06-28 06:40:14', '2021-06-28 07:19:25'),
(125, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'fc016cbec668f1a656175ce4e83db76db730a8ea5a255c88ad08fa4a905b333d', '[\"*\"]', '2021-06-28 07:31:40', '2021-06-28 07:20:58', '2021-06-28 07:31:40'),
(126, 'App\\Models\\User', 2, 'novadwisaptanainseven', '5ea4aad331f8ad10e3f7cfd7e8c1fede7528025d8fe621c3922e11dfa3a99bc2', '[\"*\"]', '2021-06-28 07:55:56', '2021-06-28 07:55:43', '2021-06-28 07:55:56'),
(127, 'App\\Models\\User', 2, 'novadwisaptanainseven', '70caf7364a5bda6fb8cf44fd4edca881b853f8bb02290f0fdc4c59aed3b33642', '[\"*\"]', '2021-06-28 07:59:57', '2021-06-28 07:56:51', '2021-06-28 07:59:57'),
(128, 'App\\Models\\User', 2, 'novadwisaptanainseven', '6ddad65898ccf2d08843e02c754559f6773cfe60da24aec77471405225f749be', '[\"*\"]', '2021-06-28 08:03:06', '2021-06-28 08:00:46', '2021-06-28 08:03:06'),
(129, 'App\\Models\\User', 2, 'novadwisaptanainseven', '01818df50a431c0c7e292447dc445aee54c6265137bd6f27ef21553362faff2e', '[\"*\"]', '2021-06-28 08:09:41', '2021-06-28 08:06:51', '2021-06-28 08:09:41'),
(130, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'b662b81ea9e16e7bdbcf6dc5e888ba2a52a99b0014af577626c438614eba2a70', '[\"*\"]', '2021-06-28 08:10:54', '2021-06-28 08:10:50', '2021-06-28 08:10:54'),
(131, 'App\\Models\\User', 2, 'novadwisaptanainseven', '7851522adec27d89dacd3015cbc061081f1657eb38393f1eb97b620d34ea8f40', '[\"*\"]', '2021-06-28 08:12:12', '2021-06-28 08:12:00', '2021-06-28 08:12:12'),
(133, 'App\\Models\\User', 2, 'novadwisaptanainseven', '5f3e4b9259f7848a0ff07c7938ec16fafe022aebaca6a44a03aa75837104adf0', '[\"*\"]', '2021-06-28 08:22:41', '2021-06-28 08:18:12', '2021-06-28 08:22:41'),
(134, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'f23573404ad6a9909585915880b02dad9eeb1415386c4989f22de471b9113208', '[\"*\"]', NULL, '2021-06-28 08:26:58', '2021-06-28 08:26:58'),
(135, 'App\\Models\\User', 2, 'novadwisaptanainseven', '9d3611dcfb5aff1131ee1f4c093eeb275fbd6f6d5f2fbfa4f3e9757269687ac5', '[\"*\"]', NULL, '2021-06-28 08:27:21', '2021-06-28 08:27:21'),
(136, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'cd1507b938f002faed1b974c48135e410ec5a4f67d41b63f490ca270ca38ff38', '[\"*\"]', NULL, '2021-06-28 08:28:17', '2021-06-28 08:28:17'),
(137, 'App\\Models\\User', 2, 'novadwisaptanainseven', '190633dcc923b706feb0c4f395cd1232538c7c7faeeacdc37918226c11ccbd39', '[\"*\"]', NULL, '2021-06-28 08:28:59', '2021-06-28 08:28:59'),
(138, 'App\\Models\\User', 2, 'novadwisaptanainseven', '92416a4409b3194d56b33742cf8132e50f849d6fdd8a8cffe83019bab4d86f2f', '[\"*\"]', '2021-06-28 08:29:31', '2021-06-28 08:29:26', '2021-06-28 08:29:31'),
(139, 'App\\Models\\User', 2, 'novadwisaptanainseven', '652cbcb655abe9425a7cf8b967406317d4308b5ae0251937e96eebcbd798faff', '[\"*\"]', '2021-06-28 08:33:02', '2021-06-28 08:32:04', '2021-06-28 08:33:02'),
(140, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'f2d8a94f26c9e41dc6d019780fb061474400c08d6ea56471ee317691b9f5cb8a', '[\"*\"]', '2021-06-28 08:40:08', '2021-06-28 08:33:34', '2021-06-28 08:40:08'),
(141, 'App\\Models\\User', 2, 'novadwisaptanainseven', '3543851be2add8651d096d38367ca513307c311f555d89dd596612d11e9f72f1', '[\"*\"]', '2021-06-28 08:50:04', '2021-06-28 08:40:19', '2021-06-28 08:50:04'),
(142, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'f426c516175c1e187b59e54894f7b15e937e4acc0856e482bc3438d39e2be563', '[\"*\"]', '2021-06-28 08:50:41', '2021-06-28 08:50:30', '2021-06-28 08:50:41'),
(143, 'App\\Models\\User', 2, 'novadwisaptanainseven', '3704cf143584516303106a7bf7d06443db666b4a8a9827231506150900cce253', '[\"*\"]', '2021-06-28 08:56:06', '2021-06-28 08:55:34', '2021-06-28 08:56:06'),
(144, 'App\\Models\\User', 2, 'novadwisaptanainseven', '799c2d50b855f4f22ebe6cc3f506d697c9f4c502b65deb36d5cbc87c373e73ba', '[\"*\"]', '2021-06-28 08:58:48', '2021-06-28 08:58:37', '2021-06-28 08:58:48'),
(145, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'b5840c84d80a21ebf3502f209418836c4da72ee4ac334bb0ff9acaaf06ff00d6', '[\"*\"]', '2021-06-28 09:11:10', '2021-06-28 09:10:23', '2021-06-28 09:11:10'),
(147, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'ac971facf3d77ce8bb732c8d59965be88c7c36d956345b29b93985ce32c96fec', '[\"*\"]', '2021-06-28 09:15:03', '2021-06-28 09:14:04', '2021-06-28 09:15:03'),
(148, 'App\\Models\\User', 2, 'novadwisaptanainseven', '6a7d5fbd8a090af8749a301890d2fc657ba7d937c5ce94b662a0ee7f2ede4724', '[\"*\"]', '2021-06-28 09:15:37', '2021-06-28 09:15:32', '2021-06-28 09:15:37'),
(149, 'App\\Models\\User', 2, 'novadwisaptanainseven', 'aef855750d8148a2b841877ca0710dc2191fece9a476cea2cd187e2b3acc58cb', '[\"*\"]', '2021-06-28 22:12:34', '2021-06-28 17:20:32', '2021-06-28 22:12:34'),
(150, 'App\\Models\\User', 2, 'novadwisaptanainseven', '2f6c3cb4ddce1da723f997bcc2cb9eb88543eba4d25455337bda517204b27d76', '[\"*\"]', '2021-06-30 23:27:04', '2021-06-30 05:41:12', '2021-06-30 23:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `pttb`
--

CREATE TABLE `pttb` (
  `id_pttb` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `penetap_sk` varchar(80) NOT NULL,
  `tgl_penetapan_sk` date NOT NULL,
  `no_sk` varchar(50) NOT NULL,
  `tgl_mulai_tugas` date DEFAULT NULL,
  `kontrak_ke` int(11) NOT NULL,
  `masa_kerja` varchar(15) NOT NULL,
  `tugas` int(11) NOT NULL,
  `gaji_pokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pttb`
--

INSERT INTO `pttb` (`id_pttb`, `id_pegawai`, `nip`, `penetap_sk`, `tgl_penetapan_sk`, `no_sk`, `tgl_mulai_tugas`, `kontrak_ke`, `masa_kerja`, `tugas`, `gaji_pokok`) VALUES
(2, 19, '198009142008011023', 'Ir. H. Dadang', '2021-10-15', '102321312', '2021-03-18', 1, '2 Tahun 3 Bulan', 5, 3500000),
(4, 30, '198009142008011023', 'Karyanto S.Pd', '2021-03-17', '123', '2021-03-17', 2, '2 Tahun 3 Bulan', 6, 2000000),
(6, 36, '1999283847134', 'Kepala Dinas', '2021-03-23', '123123', '2021-03-19', 3, '4 Tahun 5 Bulan', 18, 1350000),
(7, 44, '19800914200801102313', 'Kepala Dinas', '2021-06-24', '123123', '2021-06-24', 3, '2 Tahun 3 Bulan', 5, 2500000);

-- --------------------------------------------------------

--
-- Table structure for table `ptth`
--

CREATE TABLE `ptth` (
  `id_ptth` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `penetap_sk` varchar(80) NOT NULL,
  `tgl_penetapan_sk` date NOT NULL,
  `no_sk` varchar(50) NOT NULL,
  `tgl_mulai_tugas` date NOT NULL,
  `tugas` int(11) NOT NULL,
  `gaji_pokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ptth`
--

INSERT INTO `ptth` (`id_ptth`, `id_pegawai`, `nik`, `penetap_sk`, `tgl_penetapan_sk`, `no_sk`, `tgl_mulai_tugas`, `tugas`, `gaji_pokok`) VALUES
(2, 13, '19651127 199301 1 122', 'Ir. H. Dadang', '2021-10-15', '102321312', '2021-10-20', 7, 1300000),
(3, 14, '19651127 199301 1 122', 'Ir. H. Dadang', '2021-10-15', '102321312', '2021-10-20', 2, 1250000),
(6, 22, '19651127 199301 1 142', 'Kepala Dinas', '2021-10-15', '102321312', '2021-10-20', 6, 1350000),
(7, 26, '6472044812020002', 'Kepala Dinas', '2025-02-01', '123123', '2028-04-03', 7, 5000000),
(12, 39, '19247843wer', 'Kepala Dinas', '2021-06-09', '123123', '2021-06-09', 17, 2500000),
(13, 41, '192478434', 'Kepala Dinas', '2021-06-24', '123123', '2021-06-26', 3, 2500000);

-- --------------------------------------------------------

--
-- Table structure for table `rekap_absensi`
--

CREATE TABLE `rekap_absensi` (
  `id_rekap_absensi` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `cuti` int(11) NOT NULL,
  `tanpa_keterangan` int(11) NOT NULL,
  `hadir` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekap_absensi`
--

INSERT INTO `rekap_absensi` (`id_rekap_absensi`, `id_pegawai`, `izin`, `sakit`, `cuti`, `tanpa_keterangan`, `hadir`, `created_at`) VALUES
(2, 5, 1, 1, 3, 0, 5, '2021-02-24 07:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kerja`
--

CREATE TABLE `riwayat_kerja` (
  `id_riwayat_kerja` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `kantor` varchar(50) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_kerja`
--

INSERT INTO `riwayat_kerja` (`id_riwayat_kerja`, `id_pegawai`, `kantor`, `jabatan`, `keterangan`, `tgl_masuk`, `tgl_keluar`) VALUES
(1, 5, 'Dinas PUPR', 'Kepala Dinas', 'Mutasi edit', '2021-01-21', '2021-05-15'),
(2, 5, 'Dinas Lingkungan Hidup', 'Kepala Bidang', 'Mutasi', '2021-01-21', '2021-05-15'),
(5, 5, 'Dinas Lingkungan Hidup', 'Kasi Pemantauan dan Pengendalian Kawasan Permukiman', 'lorem ipsum dolor sit amet', '2021-06-28', '2021-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_mk`
--

CREATE TABLE `riwayat_mk` (
  `id_riwayat_mk` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `mk_golongan` varchar(15) NOT NULL,
  `mk_jabatan` varchar(15) NOT NULL,
  `mk_sebelum_cpns` varchar(15) NOT NULL,
  `mk_seluruhnya` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_mk`
--

INSERT INTO `riwayat_mk` (`id_riwayat_mk`, `id_pegawai`, `mk_golongan`, `mk_jabatan`, `mk_sebelum_cpns`, `mk_seluruhnya`, `tanggal`, `created_at`, `updated_at`) VALUES
(3, 5, '4 Tahun 3 Bulan', '2 Tahun 4 Bulan', '5 Tahun 6 Bulan', '7 Tahun 2 Bulan', '2021-06-14', '2021-06-13 22:27:53', '2021-06-13 22:27:53'),
(5, 5, '4 Tahun 3 Bulan', '3 Tahun 4 Bulan', '5 Tahun 6 Bulan', '6 Tahun 2 Bulan', '2021-06-14', '2021-06-13 22:31:32', '2021-06-13 22:31:32'),
(6, 5, '4 Tahun 3 Bulan', '3 Tahun 4 Bulan', '5 Tahun 6 Bulan', '6 Tahun 2 Bulan', '2021-06-14', '2021-06-14 06:30:35', '2021-06-14 06:30:35'),
(8, 40, '3 Tahun 2 Bulan', '4 Tahun 5 Bulan', '2 Tahun 2 Bulan', '3 Tahun 6 Bulan', '2021-06-15', '2021-06-15 06:19:30', '2021-06-15 06:19:30'),
(9, 5, '5 Tahun 2 Bulan', '3 Tahun 4 Bulan', '5 Tahun 6 Bulan', '6 Tahun 2 Bulan', '2021-06-16', '2021-06-15 19:40:10', '2021-06-15 19:40:10'),
(10, 47, '3 Tahun 3 Bulan', '3 Tahun 3 Bulan', '3 Tahun 3 Bulan', '3 Tahun 3 Bulan', '2021-06-24', '2021-06-24 04:08:20', '2021-06-24 04:08:20'),
(11, 5, '6 Tahun 3 Bulan', '3 Tahun 4 Bulan', '5 Tahun 6 Bulan', '6 Tahun 2 Bulan', '2021-06-24', '2021-06-23 21:44:13', '2021-06-23 21:44:13'),
(16, 52, '2 Tahun 2 Bulan', '2 Tahun 2 Bulan', '2 Tahun 2 Bulan', '2 Tahun 2 Bulan', '2021-06-30', '2021-06-30 14:16:00', '2021-06-30 14:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_mk_file`
--

CREATE TABLE `riwayat_mk_file` (
  `id_riwayat_mk_file` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `file_slug` varchar(100) NOT NULL,
  `keadaan` varchar(30) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_mk_file`
--

INSERT INTO `riwayat_mk_file` (`id_riwayat_mk_file`, `file`, `file_slug`, `keadaan`, `tanggal`) VALUES
(5, 'Test Riwayat 3', '1623742862206-test-riwayat-3', 'Juni 2021', '2021-06-15'),
(10, 'Test Riwayat 2', '162380937889-test-riwayat-2', 'Juni 2021', '2021-06-16'),
(11, 'Ini File Excel Riwayat', '1623814872560-ini-file-excel-riwayat', 'Juni 2021', '2021-06-16'),
(12, 'Riwayat Testing', '1624513487715-riwayat-testing', 'Juni 2021', '2021-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_sk`
--

CREATE TABLE `riwayat_sk` (
  `id_riwayat_sk` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `no_sk` varchar(80) NOT NULL,
  `penetap_sk` varchar(100) NOT NULL,
  `tgl_penetapan_sk` date NOT NULL,
  `tgl_mulai_tugas` date NOT NULL,
  `kontrak_ke` int(11) DEFAULT NULL,
  `masa_kerja` varchar(30) DEFAULT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tugas` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_sk`
--

INSERT INTO `riwayat_sk` (`id_riwayat_sk`, `id_pegawai`, `no_sk`, `penetap_sk`, `tgl_penetapan_sk`, `tgl_mulai_tugas`, `kontrak_ke`, `masa_kerja`, `gaji_pokok`, `tugas`, `file`, `created_at`, `updated_at`) VALUES
(1, 26, '123123', 'Sekretaris Daerah', '2021-06-01', '2021-06-01', 1, '2 Tahun 3 Bulan', 0, 6, '', '2021-06-11', '2021-06-11'),
(2, 26, '123123', 'Kepala Dinas', '2025-02-01', '2028-04-03', NULL, NULL, 4000000, 6, '', '2021-06-11', '2021-06-11'),
(3, 26, '123123', 'Kepala Dinas', '2025-02-01', '2028-04-03', NULL, NULL, 4000000, 6, NULL, '2021-06-11', '2021-06-11'),
(4, 26, '123123edit', 'Kepala Dinas Edit', '2025-02-01', '2028-04-03', NULL, NULL, 4000111, 6, 'images/surat-kontrak/40041623383639-data-rincian-barang.pdf', '2021-06-12', '2021-06-12'),
(8, 41, '112', 'Sekretaris Daerah', '2021-06-12', '2021-06-14', NULL, NULL, 3000000, 6, 'images/surat-kontrak/70341623491423-data-barang.pdf', '2021-06-12', '2021-06-12'),
(10, 41, '114', 'Sekretaris Daerah', '2021-06-11', '2021-06-14', NULL, NULL, 4000000, 12, 'images/surat-kontrak/97041623487764-e-asset-disperkim.pdf', '2021-06-12', '2021-06-12'),
(12, 44, '123123', 'Sekretaris Daerah', '2021-06-23', '2021-06-25', 2, '2 Tahun 3 Bulan', 1500000, 18, 'images/surat-kontrak/93131624458912-ini-file-pdf.pdf', '2021-06-23', '2021-06-23'),
(13, 41, '123123', 'Kepala Dinas', '2021-06-24', '2021-06-26', NULL, NULL, 2500000, 3, 'images/surat-kontrak/29991624512949-ini-file-pdf.pdf', '2021-06-24', '2021-06-24'),
(14, 44, '123123', 'Kepala Dinas', '2021-06-24', '2021-06-24', 3, '2 Tahun 3 Bulan', 2500000, 5, 'images/surat-kontrak/19301624513173-ini-file-pdf.pdf', '2021-06-24', '2021-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `status_pegawai`
--

CREATE TABLE `status_pegawai` (
  `id_status_pegawai` int(11) NOT NULL,
  `status_pegawai` varchar(10) NOT NULL,
  `keterangan` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_pegawai`
--

INSERT INTO `status_pegawai` (`id_status_pegawai`, `status_pegawai`, `keterangan`) VALUES
(1, 'PNS', 'Pegawai Negeri Sipil'),
(2, 'PTTH', 'Pegawai Tidak Tetap Harian'),
(3, 'PTTB', 'Pegawai Tidak Tetap Bulanan');

-- --------------------------------------------------------

--
-- Table structure for table `sub_bidang`
--

CREATE TABLE `sub_bidang` (
  `id_sub_bidang` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `nama_sub_bidang` varchar(80) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_bidang`
--

INSERT INTO `sub_bidang` (`id_sub_bidang`, `id_bidang`, `nama_sub_bidang`, `keterangan`) VALUES
(1, 2, 'Sub. Bagian Umum dan Kepegawaian', 'Urusan administrasi kepegawaian'),
(3, 1, 'Pembinaan Permukiman', 'Melaksanakan kebijakan, program, dan kegiatan di bidang permukiman'),
(5, 2, 'Sub bidang baru 1 edit', 'lorem ipsum dolor sit amet edit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `level` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profil` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_pegawai`, `name`, `username`, `email`, `email_verified_at`, `level`, `password`, `remember_token`, `foto_profil`, `created_at`, `updated_at`) VALUES
(2, 5, 'Nova Dwi Sapta Nain Seven', 'novadwisaptanainseven', NULL, NULL, 1, '$2y$10$.ZtJ98LuWyxuS47WIwrvyebRbnXYlz32nd.GnpBGgixyBCc0vj8LS', NULL, 'images/foto/61801620612349-foto1.jpg', '2021-02-25 22:11:09', '2021-02-25 22:11:09'),
(3, 7, 'Iqbal Wahyudi', 'iqbalwahyudi', NULL, NULL, 2, '$2y$10$avQ1QHYFmr.Q.A78J06Qsu1j5Ujnek7Dklk7le63u9cMduaxkZ37a', NULL, 'images/foto/21241620113193-foto1.jpg', '2021-02-28 19:52:27', '2021-02-28 19:52:27'),
(4, 24, 'Yuki Kato', '12345', NULL, NULL, 2, '$2y$10$pDzQIU0ADvSfA/WD8px1NeukOvGSyahnvXKBUR06JE2ckiSONg2Mu', NULL, 'images/foto/77001615264466-3x4-resize.jpg', NULL, NULL),
(5, 25, 'Fitri Tropica S.E', '123456', NULL, NULL, 2, '$2y$10$qJjAADfwadgJu8C0noYd1e5dbt7k7HmZNtaddGtgP/uRdd4FkwEly', NULL, 'images/foto/2321615272270-583px-logo-kota-samarinda.png', NULL, NULL),
(7, 33, 'Roman Apricon', '198009142008011024', NULL, NULL, 2, '$2y$10$9P9rfX4Zru3m3cE0c8ycoOIBZHHD7U/FngnhyjitBXpSS/5g8rsUG', NULL, 'images/foto/87501616122155-foto1.jpg', NULL, NULL),
(8, NULL, 'Andi Sadam Anan', '64030567119712321', NULL, NULL, 2, '$2y$10$ztIT2NKhQeg.JTAANe31AOSXN.HGviHCzRlZ4ff6URmnfTLF4czi2', NULL, 'images/foto/39761616124618-foto2.jpg', NULL, NULL),
(9, 36, 'Rani Nurani', '19992838471', NULL, NULL, 2, '$2y$10$/qHUjJdimzfrZ6Q6EuZQU.bZR2U7q82fG2PlzqhPQs8sk3AyDAliq', NULL, 'images/foto/96201616130877-foto3.jpg', NULL, NULL),
(13, NULL, 'Nova Admin 4', 'novaadmin4', NULL, NULL, 1, '$2y$10$ySP7GkdMJkZfry/y5c5Z8e6yLb2Fo.2v4zGlezQrAe6lgz/sLnxVi', NULL, 'images/foto/59171618198124-foto1.jpg', '2021-04-11 19:28:44', '2021-04-11 19:28:44'),
(14, NULL, 'Andi Sadam Anan', '12312321', NULL, NULL, 2, '$2y$10$tgX5iocfrJLD81hhiF4C5ebQBSL5luZzBBWroBTvo5wqMHgPdrSQ2', NULL, 'images/foto/47561623205812-foto2.jpg', NULL, NULL),
(15, 38, 'Andi Sadam Anan', '12312321345', NULL, NULL, 2, '$2y$10$We.ouhsou3rPX3.eCzqdaurF2mNlPXU6HvYHM9uxVtSLHVCcQZu2u', NULL, 'images/foto/96971623206654-foto1.jpg', NULL, NULL),
(16, 39, 'Andi Sadam Anan', '19247843wer', NULL, NULL, 2, '$2y$10$416PydMwxUN1QC/3.9i24eB89LBY8ARiJbK0wSN1H7dZDAwjtptRi', NULL, 'images/foto/60351623207652-foto1.jpg', NULL, NULL),
(17, 40, 'Tretan Muslim', '1111', NULL, NULL, 2, '$2y$10$BzjwQNnHbyRDIiYCFkXXg.zhGbvmc.nXPe8kHkbeBk3PICNcXPOEa', NULL, 'images/foto/44581623218908-foto2.jpg', NULL, NULL),
(18, 41, 'Leon S. Kennedy', '192478434', NULL, NULL, 2, '$2y$10$njWxi3gzVQ1SCsE4l9.D3OgDW5otAk2Y9afl9xg1hDmLPdPM7ru5.', NULL, 'images/foto/28601623221880-foto3.jpg', NULL, NULL),
(19, NULL, 'Andi Sadam Anan', '12312312', NULL, NULL, 2, '$2y$10$5NcWHruJex.HCoir1KeLmeRL1pkzhWWdgfNo7d8dyid5pYSBVe6oS', NULL, 'images/foto/51161623295160-foto2.jpg', NULL, NULL),
(20, NULL, 'Husein', 'fdfdfdf', NULL, NULL, 2, '$2y$10$XrkKbtiL2dWtO3R/mzXJJ.ROYC2g.8LCfAx69c7wu.PZU3iV3Z7t6', NULL, 'images/foto/70411623297774-foto2.jpg', NULL, NULL),
(21, 44, 'Atta Halilintar', '19800914200801102313', NULL, NULL, 2, '$2y$10$xsPHgNvmo23rHyzai5Tiqer7f5GY8K4YwxLDGw3CPlwXmTgw2Bcnu', NULL, 'images/foto/67361623326537-foto1.jpg', NULL, NULL),
(22, NULL, 'Andi Sadam Anan', '12312321345ty', NULL, NULL, 2, '$2y$10$jdQl6yXxN5LYpZsxfiLTGeDLa/TJlP/qEp.59.sGPPl9cfNSuLLlS', NULL, 'images/foto/76581624504186-ijazah1.jpg', NULL, NULL),
(23, 47, 'Choki Pardede', '123456xx1', NULL, NULL, 2, '$2y$10$Toc5Iyv/rE9G9XhbTBKq8.nR4AU1/DSmN/cCkkZJdRs2QGp8KaVMm', NULL, 'images/foto/49071624507700-foto2.jpg', NULL, NULL),
(24, 52, 'Ian Kasela', '1997272', NULL, NULL, 2, '$2y$10$wqqrrqESV26ORwnR4uVLp.GtzJDTKGL6cSt.GmFJ5QfxeSTPVXJUa', NULL, 'images/foto/4771625062560-foto2.jpg', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `berkas_pegawai`
--
ALTER TABLE `berkas_pegawai`
  ADD PRIMARY KEY (`id_berkas`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `diklat`
--
ALTER TABLE `diklat`
  ADD PRIMARY KEY (`id_diklat`);

--
-- Indexes for table `duk_pegawai`
--
ALTER TABLE `duk_pegawai`
  ADD PRIMARY KEY (`id_duk`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jenjang_pendidikan`
--
ALTER TABLE `jenjang_pendidikan`
  ADD PRIMARY KEY (`id_jenjang`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id_keluarga`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_agama` (`id_agama`);

--
-- Indexes for table `kenaikan_pangkat`
--
ALTER TABLE `kenaikan_pangkat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kenaikan_pangkat_id_pegawai_foreign` (`id_pegawai`);

--
-- Indexes for table `kgb`
--
ALTER TABLE `kgb`
  ADD PRIMARY KEY (`id_kgb`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `masa_kerja_pegawai`
--
ALTER TABLE `masa_kerja_pegawai`
  ADD PRIMARY KEY (`id_masa_kerja`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `pangkat_eselon`
--
ALTER TABLE `pangkat_eselon`
  ADD PRIMARY KEY (`id_pangkat_eselon`);

--
-- Indexes for table `pangkat_golongan`
--
ALTER TABLE `pangkat_golongan`
  ADD PRIMARY KEY (`id_pangkat_golongan`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_status_pegawai` (`id_status_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_golongan` (`id_golongan`),
  ADD KEY `id_eselon` (`id_eselon`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_bidang` (`id_bidang`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD PRIMARY KEY (`id_penghargaan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `pensiun`
--
ALTER TABLE `pensiun`
  ADD PRIMARY KEY (`id_pensiun`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pttb`
--
ALTER TABLE `pttb`
  ADD PRIMARY KEY (`id_pttb`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `tugas` (`tugas`);

--
-- Indexes for table `ptth`
--
ALTER TABLE `ptth`
  ADD PRIMARY KEY (`id_ptth`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `tugas` (`tugas`);

--
-- Indexes for table `rekap_absensi`
--
ALTER TABLE `rekap_absensi`
  ADD PRIMARY KEY (`id_rekap_absensi`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `riwayat_kerja`
--
ALTER TABLE `riwayat_kerja`
  ADD PRIMARY KEY (`id_riwayat_kerja`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `riwayat_mk`
--
ALTER TABLE `riwayat_mk`
  ADD PRIMARY KEY (`id_riwayat_mk`),
  ADD KEY `idx_fk_pegawai` (`id_pegawai`);

--
-- Indexes for table `riwayat_mk_file`
--
ALTER TABLE `riwayat_mk_file`
  ADD PRIMARY KEY (`id_riwayat_mk_file`);

--
-- Indexes for table `riwayat_sk`
--
ALTER TABLE `riwayat_sk`
  ADD PRIMARY KEY (`id_riwayat_sk`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `tugas` (`tugas`);

--
-- Indexes for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  ADD PRIMARY KEY (`id_status_pegawai`);

--
-- Indexes for table `sub_bidang`
--
ALTER TABLE `sub_bidang`
  ADD PRIMARY KEY (`id_sub_bidang`),
  ADD KEY `id_bidang` (`id_bidang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `berkas_pegawai`
--
ALTER TABLE `berkas_pegawai`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `diklat`
--
ALTER TABLE `diklat`
  MODIFY `id_diklat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `duk_pegawai`
--
ALTER TABLE `duk_pegawai`
  MODIFY `id_duk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jenjang_pendidikan`
--
ALTER TABLE `jenjang_pendidikan`
  MODIFY `id_jenjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kenaikan_pangkat`
--
ALTER TABLE `kenaikan_pangkat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kgb`
--
ALTER TABLE `kgb`
  MODIFY `id_kgb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `masa_kerja_pegawai`
--
ALTER TABLE `masa_kerja_pegawai`
  MODIFY `id_masa_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id_mutasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pangkat_eselon`
--
ALTER TABLE `pangkat_eselon`
  MODIFY `id_pangkat_eselon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pangkat_golongan`
--
ALTER TABLE `pangkat_golongan`
  MODIFY `id_pangkat_golongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `penghargaan`
--
ALTER TABLE `penghargaan`
  MODIFY `id_penghargaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pensiun`
--
ALTER TABLE `pensiun`
  MODIFY `id_pensiun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `pttb`
--
ALTER TABLE `pttb`
  MODIFY `id_pttb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ptth`
--
ALTER TABLE `ptth`
  MODIFY `id_ptth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rekap_absensi`
--
ALTER TABLE `rekap_absensi`
  MODIFY `id_rekap_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `riwayat_kerja`
--
ALTER TABLE `riwayat_kerja`
  MODIFY `id_riwayat_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `riwayat_mk`
--
ALTER TABLE `riwayat_mk`
  MODIFY `id_riwayat_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `riwayat_mk_file`
--
ALTER TABLE `riwayat_mk_file`
  MODIFY `id_riwayat_mk_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `riwayat_sk`
--
ALTER TABLE `riwayat_sk`
  MODIFY `id_riwayat_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `status_pegawai`
--
ALTER TABLE `status_pegawai`
  MODIFY `id_status_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_bidang`
--
ALTER TABLE `sub_bidang`
  MODIFY `id_sub_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `berkas_pegawai`
--
ALTER TABLE `berkas_pegawai`
  ADD CONSTRAINT `berkas_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `duk_pegawai`
--
ALTER TABLE `duk_pegawai`
  ADD CONSTRAINT `duk_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD CONSTRAINT `keluarga_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `keluarga_ibfk_2` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id_agama`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `kenaikan_pangkat`
--
ALTER TABLE `kenaikan_pangkat`
  ADD CONSTRAINT `kenaikan_pangkat_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kgb`
--
ALTER TABLE `kgb`
  ADD CONSTRAINT `kgb_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masa_kerja_pegawai`
--
ALTER TABLE `masa_kerja_pegawai`
  ADD CONSTRAINT `masa_kerja_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `fk_id_pegawai_mutasi` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id_agama`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`id_status_pegawai`) REFERENCES `status_pegawai` (`id_status_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_4` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_5` FOREIGN KEY (`id_golongan`) REFERENCES `pangkat_golongan` (`id_pangkat_golongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_6` FOREIGN KEY (`id_eselon`) REFERENCES `pangkat_eselon` (`id_pangkat_eselon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_7` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD CONSTRAINT `pendidikan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD CONSTRAINT `penghargaan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pensiun`
--
ALTER TABLE `pensiun`
  ADD CONSTRAINT `pensiun_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pttb`
--
ALTER TABLE `pttb`
  ADD CONSTRAINT `pttb_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pttb_ibfk_2` FOREIGN KEY (`tugas`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `ptth`
--
ALTER TABLE `ptth`
  ADD CONSTRAINT `ptth_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ptth_ibfk_2` FOREIGN KEY (`tugas`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rekap_absensi`
--
ALTER TABLE `rekap_absensi`
  ADD CONSTRAINT `rekap_absensi_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_kerja`
--
ALTER TABLE `riwayat_kerja`
  ADD CONSTRAINT `riwayat_kerja_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `riwayat_mk`
--
ALTER TABLE `riwayat_mk`
  ADD CONSTRAINT `riwayat_mk_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_sk`
--
ALTER TABLE `riwayat_sk`
  ADD CONSTRAINT `riwayat_sk_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riwayat_sk_ibfk_2` FOREIGN KEY (`tugas`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
