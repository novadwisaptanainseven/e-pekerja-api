-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 09:47 AM
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
(22, 18, '2021-04-01', 'kamis', 2, 'Sakit demam', '2021-04-05 04:03:57', '2021-04-05 04:03:57'),
(23, 18, '2021-04-02', 'jumat', 1, 'lorem ipsum dolor sit amet edit', '2021-04-05 04:04:04', '2021-04-05 04:04:04'),
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
(3, 5, 'images/berkas/59301613696783-583px-logo-kota-samarinda.png', '2021-05-03', '2021-02-19 01:06:23', 'Foto pegawai 3x4'),
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
  `lama_cuti` varchar(15) NOT NULL,
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

INSERT INTO `cuti` (`id_cuti`, `id_pegawai`, `lama_cuti`, `keterangan`, `tgl_mulai`, `tgl_selesai`, `status_cuti`, `created_at`, `updated_at`) VALUES
(2, 5, '1 Bulan', 'Liburan ke Amerika Serikat', '2021-02-10', '2021-02-24', 0, '2021-02-22 05:14:30', NULL),
(3, 5, '1 Minggu', 'Daftar CPNS', '2021-02-20', '2021-02-27', 0, '2021-02-22 05:15:08', NULL),
(5, 5, '1 hari', 'lorem ipsum dolor sit amet', '2021-03-26', '2021-03-27', 0, '2021-03-26 02:46:22', '2021-03-29'),
(6, 5, '1 hari', 'lorem ipsum dolor sit amet', '2021-03-30', '2021-04-06', 0, '2021-03-26 03:14:45', '2021-03-29'),
(7, 5, '1 bulan', 'lorem ipsum dolor sit amet', '2021-03-27', '2021-04-26', 0, '2021-03-26 03:18:13', NULL),
(8, 7, '6 hari', 'lorem ipsum dolor sit amet edit', '2021-03-28', '2021-04-03', 0, '2021-03-26 03:21:24', '2021-03-29'),
(9, 24, '3 hari', 'lorem ipsum dolor sit amet', '2021-03-29', '2021-04-01', 0, '2021-03-29 06:59:26', NULL),
(10, 7, '1 minggu', 'lorem ipsum dolor sit amet', '2021-06-08', '2021-06-15', 0, '2021-06-08 06:49:13', NULL),
(11, 9, '1 bulan', 'lorem ipsum dolor sit amet', '2021-06-09', '2021-07-09', 0, '2021-06-09 03:43:39', NULL);

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
  `dokumentasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diklat`
--

INSERT INTO `diklat` (`id_diklat`, `id_pegawai`, `jenis_diklat`, `nama_diklat`, `penyelenggara`, `tahun_diklat`, `jumlah_jam`, `dokumentasi`) VALUES
(1, 5, 'Jenis Diklat', 'Adumla', 'Walikota Samarinda', '1997', 500, 'images/ijazah/961613625299-react.png'),
(2, 5, 'Jenis Diklat 2', 'Adumla 2', 'Walikota Samarinda 2', '1997', 500, 'images/ijazah/57961613625332-react.png'),
(4, 33, 'Jenis Diklat 1', 'Adumla', 'Walikota Samarinda', '2001', 198, 'images/dok_diklat/26261616395967-file-pdf.pdf'),
(5, 33, 'Jenis Diklat 2', 'Diklat PIM TK.1', 'Walikota Samarinda', '2005', 150, 'images/dok_diklat/49151616396055-file-pdf.pdf'),
(6, 5, 'Jenis Diklat 1', 'Adumla', 'Walikota Samarinda', '2020', 100, 'images/dok_diklat/4791623207031-diklat1.jpg'),
(7, 5, 'Jenis Diklat 1', 'Adumla', 'Walikota Samarinda', '2020', 100, 'images/dok_diklat/70911623207040-diklat1.jpg'),
(8, 5, 'Jenis Diklat 1', 'Adumla', 'Walikota Samarinda', '2020', 100, 'images/dok_diklat/43811623207067-ini-file-pdf.pdf');

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
(7, 37, '-'),
(8, 38, '-'),
(9, 40, '-'),
(10, 42, '-'),
(11, 43, '-');

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
(11, 14, 1, '1234567', 'Wahyulianto', 'Ayah', 'Guru Bahasa Inggris', 'Laki - Laki', 'Tenggarong', '2021-03-16', '0812345678', 'Jalan KH. Dewantara'),
(12, 24, 1, '1234567', 'Muhammad Yudi', 'Ayah', 'Kepala Sekolah', 'Laki - Laki', 'Tenggarong', '2021-04-12', '0812444373231', 'Jalan Slamet Riyadi'),
(13, 24, 1, '1234567', 'Agnes Monica', 'Ibu', 'Pegawai Bank', 'Perempuan', 'Kutai Barat', '2021-03-31', '0812444373231', 'Jalan Slamet Riyadi'),
(14, 5, 3, '123456', 'Nova Dwi Sapta', 'Ibu', 'Pegawai Swasta', 'Laki - Laki', 'Kutai Barat', '2021-06-09', '0812444373231', 'dfdfdfd');

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
(15, 5, 6000000, 7000000, '2021-06-09', 'Peraturan KGB', NULL, '2021-06-23', '2021-06-09', NULL);

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masa_kerja_pegawai`
--

INSERT INTO `masa_kerja_pegawai` (`id_masa_kerja`, `id_pegawai`, `mk_jabatan`, `mk_sebelum_cpns`, `mk_golongan`, `mk_seluruhnya`, `updated_at`) VALUES
(4, 5, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2021-02-22 01:26:01'),
(5, 7, '8 Tahun 2 Bulan', '22 Tahun 8 Bulan', '3 Tahun 4 Bulan', '15 Tahun 6 Bulan', '2021-03-23 03:28:27'),
(7, 9, '2 Tahun 4 Bulan', '12 Tahun 6 Bulan', '3 Tahun 5 Bulan', '2 Tahun 4 Bulan', '2021-03-23 03:30:05'),
(9, 24, '2 tahun 4 bulan', '2 tahun 4 bulan', '2 tahun 4 bulan', '2 tahun 4 bulan', '2021-03-09 04:34:27'),
(10, 25, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2021-03-09 06:44:30'),
(12, 33, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2021-03-19 02:49:16'),
(13, 37, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2021-06-09 02:30:12'),
(14, 38, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2021-06-09 02:44:14'),
(15, 40, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2021-06-09 06:08:28'),
(16, 42, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2021-06-10 03:19:21'),
(17, 43, '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2 Tahun 3 Bulan', '2021-06-10 04:02:55');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_bidang`, `id_status_pegawai`, `id_jabatan`, `id_golongan`, `id_eselon`, `id_agama`, `nip`, `nama`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `karpeg`, `bpjs`, `npwp`, `tmt_golongan`, `tmt_cpns`, `tmt_jabatan`, `no_hp`, `email`, `no_ktp`, `gaji_pokok`, `foto`, `status_kerja`, `id_user`) VALUES
(5, 1, 1, 1, 1, 1, 1, '196511235 343432 3432', 'Ir. H. Dadang N, MMT', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '08123455674', NULL, NULL, 6000000, 'images/foto/84971622004754-foto1.jpg', 'aktif', 0),
(7, 1, 1, 1, 1, 1, 1, '196511235 343432 1232', 'Nova Dwi Sapta Nain Seven', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '08123455674', NULL, NULL, 2300000, 'images/foto/38511622008603-foto3.jpg', 'aktif', 0),
(9, 1, 1, 1, 1, 1, 1, '196511235 343432 3432123', 'Iqbal Wahyudi', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '08123455674', NULL, NULL, 0, 'images/foto/66301622008566-foto2.jpg', 'aktif', 0),
(13, 2, 2, 7, NULL, NULL, 1, NULL, 'Deddy Corbuzier', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', NULL, NULL, 0, 'images/foto/95541613537480-583px-logo-kota-samarinda.png', 'aktif', 0),
(14, 2, 2, 2, NULL, NULL, 1, NULL, 'Uzumaki Naruto', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', NULL, NULL, 0, 'images/foto/23861615861451-foto1.jpg', 'aktif', 0),
(18, 1, 3, 5, NULL, NULL, 1, '123456', 'Ariana Grande 123', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Perempuan', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', NULL, NULL, 0, 'images/foto/73151613548996-583px-logo-kota-samarinda.png', 'aktif', 0),
(19, 2, 3, 5, NULL, NULL, 1, '198009142008011023', 'Iker Casillas', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', NULL, NULL, 0, 'images/foto/46091613548625-583px-logo-kota-samarinda.png', 'aktif', 0),
(22, 3, 2, 6, NULL, NULL, 1, NULL, 'Ma\'ruf', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', NULL, NULL, 0, 'images/foto/92731615870141-foto2.jpg', 'pensiun', 0),
(24, 3, 1, 14, 4, 1, 3, '12345', 'Anton Topadang', 'Jalan Slamet Riyadi', 'Samarinda', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '08123455674', NULL, NULL, 2500000, 'images/foto/54701622010918-foto2.jpg', 'aktif', NULL),
(25, 3, 1, 5, 2, 2, 1, '123456', 'Fitri Tropica S.E', 'Jalan Pangeran Antasari', 'Tanjung Redeb', '2021-03-19', 'Perempuan', '123', '123', '773806096722000', '2021-03-05', '2021-03-09', '2021-03-09', '08123456789', NULL, NULL, 0, 'images/foto/42271615349916-react.png', 'aktif', NULL),
(26, 8, 2, 7, NULL, NULL, 1, NULL, 'Irman Maulana', 'Jalan KH. Agus Salim', 'Samarinda', '2021-03-09', 'Laki - Laki', NULL, '123', '123', NULL, NULL, NULL, '08123456789', NULL, NULL, 0, 'images/foto/51631615789776-foto1.jpg', 'aktif', NULL),
(30, 8, 3, 6, NULL, NULL, 2, '198009142008011023', 'Ilham Dwi Arifin', 'Jalan AWS. Syahranie 3', 'Kutai Barat', '2000-10-08', 'Laki - Laki', NULL, '123', '123', NULL, NULL, NULL, '08123456789', NULL, NULL, 0, 'images/foto/38451615956842-foto2.jpg', 'aktif', NULL),
(33, 1, 1, 5, 9, 3, 1, '198009142008011024', 'Roman Apricon', 'Jalan Cipto Mangunkusumo', 'Berau', '1997-03-17', 'Laki - Laki', '6563442', '123123', '12321323', '2021-03-19', '2021-03-19', '2021-03-12', '08123456789', NULL, NULL, 1350000, 'images/foto/87501616122155-foto1.jpg', 'pensiun', NULL),
(35, 2, 2, 12, NULL, NULL, 3, NULL, 'Andi Sadam Anan', 'Jalan Cipto Mangunkusumo', 'Balikpapan', '2021-03-03', 'Laki - Laki', NULL, '123', '123', NULL, NULL, NULL, '123', NULL, NULL, 0, 'images/foto/39761616124618-foto2.jpg', 'aktif', NULL),
(36, 8, 3, 18, NULL, NULL, 1, '1999283847134', 'Rani Nurani', 'Jalan Pangeran Antasari', 'Tanjung Redeb', '2021-03-19', 'Perempuan', NULL, '23123123', '12321323', NULL, NULL, NULL, '08123456789', NULL, NULL, 0, 'images/foto/31461616133343-foto4.jpg', 'aktif', NULL),
(37, 2, 1, 2, 4, 2, 1, '12312321', 'Andi Sadam Anan', 'dfdfdfdfd', 'Kutai Barat', '2021-06-09', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-06-09', '2021-06-09', '2021-06-09', '08123455674', NULL, NULL, 2500000, 'images/foto/4391623205847-foto3.jpg', 'aktif', NULL),
(38, 3, 1, 5, 9, 3, 1, '12312321345', 'Andi Sadam Anan', 'sdsdsdd', 'Tenggarong', '2021-06-09', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-06-09', '2021-06-09', '2021-06-09', '08123455674', NULL, NULL, 2000000, 'images/foto/96971623206654-foto1.jpg', 'aktif', NULL),
(39, 1, 2, 17, NULL, NULL, 4, NULL, 'Andi Sadam Anan', 'fgfgfgf', 'Tanjung Redeb', '2021-06-09', 'Laki - Laki', NULL, '23123123', '12321323', NULL, NULL, NULL, '08123455674', NULL, NULL, 0, 'images/foto/60351623207652-foto1.jpg', 'aktif', NULL),
(40, 1, 1, 19, 9, 3, 1, '1111', 'Tretan Muslim', 'Jalan Slamet Riyadi', 'Tenggarong', '2021-06-09', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-06-09', '2021-06-09', '2021-06-09', '08123456789', 'tretan@gmail.com', '6472031409800004', 2500000, 'images/foto/44581623218908-foto2.jpg', 'aktif', NULL),
(41, 3, 2, 2, NULL, NULL, 1, NULL, 'Leon S. Kennedy', 'dfdfdf', 'Kutai Barat', '2021-06-09', 'Laki - Laki', NULL, '23123123', '12321323', NULL, NULL, NULL, '08123455674', 'leon@gmail.com', '6472031409800004', 0, 'images/foto/28601623221880-foto3.jpg', 'aktif', NULL),
(42, 2, 1, 3, 9, 2, 2, '12312312', 'Andi Sadam Anan', 'dfdfdfd', 'Kutai Barat', '2021-06-09', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-06-10', '2021-06-25', '2021-06-10', '08123455674', 'novadwisaptans@gmail.com', '6472031409800004', 2000000, 'images/foto/51161623295160-foto2.jpg', 'aktif', NULL),
(43, 1, 1, 2, 8, 2, 1, 'fdfdfdf', 'Husein', 'dfdfd', 'Tanjung Redeb', '2021-06-10', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-06-10', '2021-06-10', '2021-06-10', '08123456789', 'novadwisaptans@gmail.com', '6472031409800004', 2500000, 'images/foto/70411623297774-foto2.jpg', 'aktif', NULL);

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
(4, 7, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2020', 'images/ijazah/73701615532121-ijazah-sample.jpg'),
(6, 9, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2020', 'images/ijazah/15011613531530-file-pdf.pdf'),
(7, 13, 'S1', 'Politeknik Negeri Samarinda', 'Manajemen Informatika', '123-123-123', '2019', 'images/ijazah/16481613535354-file-pdf.pdf'),
(8, 14, 'S1', 'Politeknik Negeri Samarinda', 'Administrasi Bisnis', '123-123-123', '2019', 'images/ijazah/81421613535515-file-pdf.pdf'),
(11, 18, 'D3', 'Politeknik Negeri Samarinda', 'Teknik Industri', '123-123-123', '2019', 'images/ijazah/72931613546354-file-pdf.pdf'),
(12, 19, 'D3', 'Politeknik Negeri Samarinda', 'Teknik Industri', '123-123-123', '2019', 'images/ijazah/51871613548625-file-pdf.pdf'),
(14, 5, 'sma/ma/smk', 'SMK Negeri 001 Berau', 'Multimedia', '10-ac-de-20', '2016', 'images/ijazah/44631623125239-ijazah1.jpg'),
(16, 22, 'S1', 'Politeknik Negeri Samarinda', 'Administrasi Bisnis', '123-123-123', '2019', 'images/ijazah/91581615870062-ijazah-sample.jpg'),
(18, 24, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2020', ''),
(19, 25, 'S1', 'Universitas Mulawarman', 'Manajemen Ekonomi', '123', '2018', 'images/ijazah/32801615272270-file-pdf.pdf'),
(20, 7, 'S1', 'Universitas Mulawarman', 'Ekonomi', '1234', '2018', 'images/ijazah/22861615527331-ijazah-sample.jpg'),
(22, 26, 'D3', 'STIMIK WICIDA', 'Manajemen Informatika', '123', '2018', 'images/ijazah/92301615789777-ijazah-sample.jpg'),
(24, 30, 'S1', 'Widya Gama', 'Hukum', '123', '2018', 'images/ijazah/84611615956842-ijazah-sample.jpg'),
(27, 33, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2018', 'images/ijazah/57871616122156-ijazah-sample.jpg'),
(29, 35, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2021', 'images/ijazah/23651616124618-ijazah-sample.jpg'),
(30, 36, 'S1', 'Universitas Mulawarman', 'Ilmu Pemerintahan', '2323211', '2017', 'images/ijazah/32991616130877-ijazah-sample.jpg'),
(31, 37, 'S1', 'Universitas Mulawarman', 'Manajemen Ekonomi', '123456', '2021', 'images/ijazah/35501623205812-ijazah1.jpg'),
(32, 38, 'S1', 'Universitas Mulawarman', 'Manajemen Ekonomi', '123456', '2018', 'images/ijazah/38311623206654-ijazah1.jpg'),
(33, 5, 'D4', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2018', 'images/ijazah/13001623206953-ijazah1.jpg'),
(34, 39, 'S1', 'Universitas Mulawarman', 'Manajemen Ekonomi', '123456', '2021', 'images/ijazah/69661623207652-ijazah1.jpg'),
(35, 40, 'S1', 'Politeknik Negeri Samarinda', 'Teknologi Informasi', '2323211', '2021', 'images/ijazah/93901623218908-ijazah1.jpg'),
(36, 41, 'S2', 'Universitas Mulawarman', 'Teknik Informatika', '1234', '2021', 'images/ijazah/8531623221880-ijazah1.jpg'),
(37, 42, 'S1', 'Universitas Mulawarman', 'Teknik Informatika', '2323211', '2021', 'images/ijazah/60651623295161-ijazah1.jpg'),
(38, 43, 'D4', 'Universitas Mulawarman', 'Manajemen Ekonomi', '2323211', '2021', 'images/ijazah/15121623297775-ijazah1.jpg');

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
(14, 5, NULL, 'Penghargaan atas kepimpinan selama bekerja 2', 'Walikota Samarinda', '2021-06-09', 'images/dok_penghargaan/79681623207442-ijazah1.jpg'),
(15, 9, NULL, 'Penghargaan atas kepimpinan selama bekerja 2', 'Walikota Samarinda', '2021-06-09', 'images/dok_penghargaan/81661623210538-diklat1.jpg');

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
(4, 'App\\Models\\User', 2, 'novadwisaptanainseven', '116dc1f16304417c12a9c8fcae3df62aca14e03e9c4283e43417674b67907617', '[\"*\"]', '2021-04-05 20:30:22', '2021-02-28 18:28:04', '2021-04-05 20:30:22'),
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
(95, 'App\\Models\\User', 2, 'novadwisaptanainseven', '9c29816685dd3fe2d4e8a9c6f6db34ada046d3862f258e4d79405f7817611ae7', '[\"*\"]', '2021-06-09 22:19:36', '2021-06-09 19:10:30', '2021-06-09 22:19:36');

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
  `tugas` varchar(50) NOT NULL,
  `gaji_pokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pttb`
--

INSERT INTO `pttb` (`id_pttb`, `id_pegawai`, `nip`, `penetap_sk`, `tgl_penetapan_sk`, `no_sk`, `tgl_mulai_tugas`, `kontrak_ke`, `masa_kerja`, `tugas`, `gaji_pokok`) VALUES
(1, 18, '123456', 'Ir. H. Dadang', '2021-10-15', '102321312', '2021-03-16', 1, '2 Tahun 3 Bulan', '5', 5000000),
(2, 19, '198009142008011023', 'Ir. H. Dadang', '2021-10-15', '102321312', '2021-03-18', 1, '2 Tahun 3 Bulan', '5', 3500000),
(4, 30, '198009142008011023', 'Karyanto S.Pd', '2021-03-17', '123', '2021-03-17', 2, '2 Tahun 3 Bulan', '6', 2000000),
(6, 36, '1999283847134', 'Kepala Dinas', '2021-03-23', '123123', '2021-03-19', 3, '4 Tahun 5 Bulan', '18', 1350000);

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
  `tugas` varchar(50) NOT NULL,
  `gaji_pokok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ptth`
--

INSERT INTO `ptth` (`id_ptth`, `id_pegawai`, `nik`, `penetap_sk`, `tgl_penetapan_sk`, `no_sk`, `tgl_mulai_tugas`, `tugas`, `gaji_pokok`) VALUES
(2, 13, '19651127 199301 1 122', 'Ir. H. Dadang', '2021-10-15', '102321312', '2021-10-20', '7', 1300000),
(3, 14, '19651127 199301 1 122', 'Ir. H. Dadang', '2021-10-15', '102321312', '2021-10-20', '2', 1250000),
(6, 22, '19651127 199301 1 142', 'Kepala Dinas', '2021-10-15', '102321312', '2021-10-20', '6', 1350000),
(7, 26, '6472044812020002', 'H. Widodo S.E, M.A', '2021-03-15', '123', '2021-03-15', '7', 2500000),
(11, 35, '64030567119712321', 'Sekretaris Daerah', '2021-03-09', '123123', '2021-03-11', '12', 2500000),
(12, 39, '19247843wer', 'Kepala Dinas', '2021-06-09', '123123', '2021-06-09', '17', 2500000),
(13, 41, '192478434', 'Sekretaris Daerah', '2021-06-09', '123123', '2021-06-09', '2', 2000000);

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
  `jabatan` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_kerja`
--

INSERT INTO `riwayat_kerja` (`id_riwayat_kerja`, `id_pegawai`, `kantor`, `jabatan`, `keterangan`, `tgl_masuk`, `tgl_keluar`) VALUES
(1, 5, 'Dinas PUPR', 'Kepala Dinas', 'Mutasi', '2021-01-21', '2021-05-15'),
(2, 5, 'Dinas Lingkungan Hidup', 'Kepala Bidang', 'Mutasi', '2021-01-21', '2021-05-15');

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
(8, 35, 'Andi Sadam Anan', '64030567119712321', NULL, NULL, 2, '$2y$10$ztIT2NKhQeg.JTAANe31AOSXN.HGviHCzRlZ4ff6URmnfTLF4czi2', NULL, 'images/foto/39761616124618-foto2.jpg', NULL, NULL),
(9, 36, 'Rani Nurani', '19992838471', NULL, NULL, 2, '$2y$10$/qHUjJdimzfrZ6Q6EuZQU.bZR2U7q82fG2PlzqhPQs8sk3AyDAliq', NULL, 'images/foto/96201616130877-foto3.jpg', NULL, NULL),
(13, NULL, 'Nova Admin 4', 'novaadmin4', NULL, NULL, 1, '$2y$10$ySP7GkdMJkZfry/y5c5Z8e6yLb2Fo.2v4zGlezQrAe6lgz/sLnxVi', NULL, 'images/foto/59171618198124-foto1.jpg', '2021-04-11 19:28:44', '2021-04-11 19:28:44'),
(14, 37, 'Andi Sadam Anan', '12312321', NULL, NULL, 2, '$2y$10$tgX5iocfrJLD81hhiF4C5ebQBSL5luZzBBWroBTvo5wqMHgPdrSQ2', NULL, 'images/foto/47561623205812-foto2.jpg', NULL, NULL),
(15, 38, 'Andi Sadam Anan', '12312321345', NULL, NULL, 2, '$2y$10$We.ouhsou3rPX3.eCzqdaurF2mNlPXU6HvYHM9uxVtSLHVCcQZu2u', NULL, 'images/foto/96971623206654-foto1.jpg', NULL, NULL),
(16, 39, 'Andi Sadam Anan', '19247843wer', NULL, NULL, 2, '$2y$10$416PydMwxUN1QC/3.9i24eB89LBY8ARiJbK0wSN1H7dZDAwjtptRi', NULL, 'images/foto/60351623207652-foto1.jpg', NULL, NULL),
(17, 40, 'Tretan Muslim', '1111', NULL, NULL, 2, '$2y$10$BzjwQNnHbyRDIiYCFkXXg.zhGbvmc.nXPe8kHkbeBk3PICNcXPOEa', NULL, 'images/foto/44581623218908-foto2.jpg', NULL, NULL),
(18, 41, 'Leon S. Kennedy', '192478434', NULL, NULL, 2, '$2y$10$njWxi3gzVQ1SCsE4l9.D3OgDW5otAk2Y9afl9xg1hDmLPdPM7ru5.', NULL, 'images/foto/28601623221880-foto3.jpg', NULL, NULL),
(19, 42, 'Andi Sadam Anan', '12312312', NULL, NULL, 2, '$2y$10$5NcWHruJex.HCoir1KeLmeRL1pkzhWWdgfNo7d8dyid5pYSBVe6oS', NULL, 'images/foto/51161623295160-foto2.jpg', NULL, NULL),
(20, 43, 'Husein', 'fdfdfdf', NULL, NULL, 2, '$2y$10$XrkKbtiL2dWtO3R/mzXJJ.ROYC2g.8LCfAx69c7wu.PZU3iV3Z7t6', NULL, 'images/foto/70411623297774-foto2.jpg', NULL, NULL);

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
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `ptth`
--
ALTER TABLE `ptth`
  ADD PRIMARY KEY (`id_ptth`),
  ADD KEY `id_pegawai` (`id_pegawai`);

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
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `diklat`
--
ALTER TABLE `diklat`
  MODIFY `id_diklat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `duk_pegawai`
--
ALTER TABLE `duk_pegawai`
  MODIFY `id_duk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kgb`
--
ALTER TABLE `kgb`
  MODIFY `id_kgb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `masa_kerja_pegawai`
--
ALTER TABLE `masa_kerja_pegawai`
  MODIFY `id_masa_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `penghargaan`
--
ALTER TABLE `penghargaan`
  MODIFY `id_penghargaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pensiun`
--
ALTER TABLE `pensiun`
  MODIFY `id_pensiun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `pttb`
--
ALTER TABLE `pttb`
  MODIFY `id_pttb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_riwayat_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- Constraints for table `kgb`
--
ALTER TABLE `kgb`
  ADD CONSTRAINT `kgb_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `masa_kerja_pegawai`
--
ALTER TABLE `masa_kerja_pegawai`
  ADD CONSTRAINT `masa_kerja_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `pttb_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `ptth`
--
ALTER TABLE `ptth`
  ADD CONSTRAINT `ptth_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
