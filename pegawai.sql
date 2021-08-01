-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2021 at 09:41 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

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
  `gaji_pokok` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(255) NOT NULL,
  `status_kerja` varchar(40) NOT NULL DEFAULT 'aktif',
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_bidang`, `id_status_pegawai`, `id_jabatan`, `id_golongan`, `id_eselon`, `id_agama`, `nip`, `nama`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `karpeg`, `bpjs`, `npwp`, `tmt_golongan`, `tmt_cpns`, `tmt_jabatan`, `no_hp`, `gaji_pokok`, `foto`, `status_kerja`, `id_user`) VALUES
(5, 1, 1, 1, 1, 1, 1, '196511235 343432 3432', 'Ir. H. Dadang N, MMT', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '08123455674', 5000000, 'images/foto/14471613461591-react.png', 'aktif', 0),
(7, 1, 1, 1, 1, 1, 1, '196511235 343432 1232', 'Nova Dwi Sapta Nain Seven', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '08123455674', 1000000, 'images/foto/26601615775369-3x4-resize.jpg', 'aktif', 0),
(9, 1, 1, 1, 1, 1, 1, '196511235 343432 3432123', 'Iqbal Wahyudi', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '08123455674', 0, 'images/foto/98981613531530-react.png', 'aktif', 0),
(13, 2, 2, 7, NULL, NULL, 1, NULL, 'Deddy Corbuzier', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', 0, 'images/foto/95541613537480-583px-logo-kota-samarinda.png', 'aktif', 0),
(14, 2, 2, 2, NULL, NULL, 1, NULL, 'Uzumaki Naruto', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', 0, 'images/foto/23861615861451-foto1.jpg', 'aktif', 0),
(18, 1, 3, 5, NULL, NULL, 1, '123456', 'Ariana Grande 123', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Perempuan', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', 0, 'images/foto/73151613548996-583px-logo-kota-samarinda.png', 'aktif', 0),
(19, 2, 3, 5, NULL, NULL, 1, '198009142008011023', 'Iker Casillas', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', 0, 'images/foto/46091613548625-583px-logo-kota-samarinda.png', 'aktif', 0),
(22, 3, 2, 6, NULL, NULL, 1, NULL, 'Ma\'ruf', 'Jalan Slamet Riyadi', 'Tanjung Redeb', '1997-11-27', 'Laki - Laki', NULL, '123123', '123123', NULL, NULL, NULL, '08123453213', 0, 'images/foto/92731615870141-foto2.jpg', 'pensiun', 0),
(24, 3, 1, 1, 4, 1, 3, '12345', 'Yuki Kato', 'Jalan Slamet Riyadi', 'Samarinda', '1997-11-27', 'Perempuan', '6563442', '23123123', '12321323', '2021-10-10', '2021-10-10', '2021-10-10', '08123455674', 0, 'images/foto/77001615264466-3x4-resize.jpg', 'aktif', NULL),
(25, 3, 1, 5, 2, 2, 1, '123456', 'Fitri Tropica S.E', 'Jalan Pangeran Antasari', 'Tanjung Redeb', '2021-03-19', 'Perempuan', '123', '123', '773806096722000', '2021-03-05', '2021-03-09', '2021-03-09', '08123456789', 0, 'images/foto/42271615349916-react.png', 'aktif', NULL),
(26, 8, 2, 7, NULL, NULL, 1, NULL, 'Irman Maulana', 'Jalan KH. Agus Salim', 'Samarinda', '2021-03-09', 'Laki - Laki', NULL, '123', '123', NULL, NULL, NULL, '08123456789', 0, 'images/foto/51631615789776-foto1.jpg', 'aktif', NULL),
(30, 8, 3, 6, NULL, NULL, 2, '198009142008011023', 'Ilham Dwi Arifin', 'Jalan AWS. Syahranie 3', 'Kutai Barat', '2000-10-08', 'Laki - Laki', NULL, '123', '123', NULL, NULL, NULL, '08123456789', 0, 'images/foto/38451615956842-foto2.jpg', 'aktif', NULL),
(33, 1, 1, 5, 9, 3, 1, '198009142008011024', 'Roman Apricon', 'Jalan Cipto Mangunkusumo', 'Berau', '1997-03-17', 'Laki - Laki', '6563442', '123123', '12321323', '2021-03-19', '2021-03-19', '2021-03-12', '08123456789', 1350000, 'images/foto/87501616122155-foto1.jpg', 'pensiun', NULL),
(35, 2, 2, 12, NULL, NULL, 3, NULL, 'Andi Sadam Anan', 'Jalan Cipto Mangunkusumo', 'Balikpapan', '2021-03-03', 'Laki - Laki', NULL, '123', '123', NULL, NULL, NULL, '123', 0, 'images/foto/39761616124618-foto2.jpg', 'aktif', NULL),
(36, 8, 3, 18, NULL, NULL, 1, '1999283847134', 'Rani Nurani', 'Jalan Pangeran Antasari', 'Tanjung Redeb', '2021-03-19', 'Perempuan', NULL, '23123123', '12321323', NULL, NULL, NULL, '08123456789', 0, 'images/foto/31461616133343-foto4.jpg', 'aktif', NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
