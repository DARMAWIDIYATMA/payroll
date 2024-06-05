-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 10:08 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `semester4`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` int(11) NOT NULL,
  `nama_cuti` varchar(255) NOT NULL,
  `batas_hari` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `nama_cuti`, `batas_hari`) VALUES
(1, 'Cuti Tahunan', 12),
(2, 'Cuti Melahirkan', 0),
(3, 'Cuti Menikah', 0),
(4, 'Cuti Kerabat Meninggal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_cuti`
--

CREATE TABLE `data_cuti` (
  `id` int(11) NOT NULL,
  `id_cuti` int(11) NOT NULL,
  `nip` bigint(20) NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `status_approval` varchar(20) NOT NULL,
  `nip_atasan` bigint(20) NOT NULL,
  `tanggal_pengajuan` datetime NOT NULL,
  `tgl_mulai_cuti` date NOT NULL,
  `tgl_akhir_cuti` date NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_cuti`
--

INSERT INTO `data_cuti` (`id`, `id_cuti`, `nip`, `jumlah_hari`, `status_approval`, `nip_atasan`, `tanggal_pengajuan`, `tgl_mulai_cuti`, `tgl_akhir_cuti`, `id_jabatan`) VALUES
(1, 1, 1791209830491805, 2, 'SUCCESS', 1791209830491801, '2023-02-20 00:00:00', '2023-02-20', '2023-02-21', 6),
(2, 3, 1791209830491805, 1, 'FAILED', 1791209830491801, '2023-02-20 00:00:00', '2023-02-24', '2023-02-24', 6),
(3, 1, 1791209830491805, 3, 'FAILED', 1791209830491801, '2023-02-21 00:00:00', '2023-02-28', '2023-03-02', 6),
(5, 1, 1791209830491805, 2, 'SUCCESS', 1791209830491801, '2023-02-21 00:00:00', '2023-02-28', '2023-03-01', 6),
(6, 1, 1791209830491805, 1, 'SUCCESS', 1791209830491801, '2023-02-21 00:00:00', '2023-02-28', '2023-02-28', 6),
(7, 1, 1791209830491805, 1, 'SUCCESS', 1791209830491801, '2023-02-21 00:00:00', '2023-01-30', '2023-01-30', 6),
(8, 2, 1791209830491805, 1, 'FAILED', 1791209830491801, '2024-05-25 00:00:00', '2024-05-25', '2024-05-25', 6),
(9, 3, 1791209830491805, 1, 'PENDING', 1791209830491801, '2024-05-27 00:00:00', '2024-05-27', '2024-05-27', 6);

-- --------------------------------------------------------

--
-- Table structure for table `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(20) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `gaji_pokok` bigint(20) NOT NULL,
  `transport` bigint(20) NOT NULL,
  `uang_makan` bigint(20) NOT NULL,
  `id_pph_pk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `transport`, `uang_makan`, `id_pph_pk`) VALUES
(2, 'Staff Admin Kredit', 3500000, 200000, 300000, NULL),
(3, 'Staff Security', 2500000, 200000, 300000, NULL),
(4, 'Direktur Utama', 5800000, 200000, 300000, NULL),
(5, 'Staff CS', 3700000, 200000, 300000, NULL),
(6, 'Staff IT', 5500000, 200000, 300000, NULL),
(7, 'Staff Teller', 4100000, 200000, 300000, NULL),
(8, 'Kepala Divisi Operasional', 5240000, 200000, 300000, NULL),
(9, 'Staff Pramubakti', 3120000, 200000, 300000, NULL),
(10, 'Staff Analis', 4420000, 200000, 300000, NULL),
(11, 'Staff Marketing', 4330000, 200000, 300000, NULL),
(12, 'Staff Remedial', 4400000, 200000, 300000, NULL),
(13, 'Staff Akunting', 3700000, 200000, 300000, NULL),
(14, 'Audit Internal', 4530000, 200000, 300000, NULL),
(15, 'Direktur', 5320000, 200000, 300000, NULL),
(16, 'Kepala Divisi Marketing', 4960000, 200000, 300000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_kehadiran`
--

CREATE TABLE `data_kehadiran` (
  `id_kehadiran` int(20) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `nip` bigint(20) DEFAULT NULL,
  `hadir` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `alpha` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_kehadiran`
--

INSERT INTO `data_kehadiran` (`id_kehadiran`, `bulan`, `nip`, `hadir`, `izin`, `sakit`, `alpha`, `id_jabatan`) VALUES
(1, '022023', 1791209830492812, 20, 0, 0, 5, 9),
(2, '022023', 1791209830491806, 25, 0, 0, 0, 3),
(3, '022023', 1791209830491807, 25, 0, 0, 0, 2),
(4, '022023', 1791209830491809, 25, 0, 0, 0, 16),
(5, '022023', 17912098304918010, 25, 0, 0, 0, 12),
(6, '022023', 1791209830491808, 25, 0, 0, 0, 13),
(7, '022023', 1791209830491801, 25, 0, 0, 0, 4),
(8, '022023', 17912098304928116, 25, 0, 0, 0, 3),
(9, '022023', 17912098304928113, 25, 0, 0, 0, 3),
(10, '022023', 1791209830491912, 24, 0, 0, 1, 10),
(11, '022023', 17912098304928115, 23, 0, 0, 2, 10),
(12, '022023', 17912098304918012, 25, 0, 0, 0, 11),
(13, '022023', 1791209830491802, 25, 0, 0, 0, 8),
(14, '022023', 17912098304928114, 25, 0, 0, 0, 10),
(15, '022023', 1791209830491805, 25, 0, 0, 0, 6),
(16, '022023', 17912098304918011, 25, 0, 0, 0, 6),
(17, '012023', 1791209830492812, 25, 0, 0, 0, 9),
(18, '012023', 1791209830491806, 25, 0, 0, 0, 3),
(19, '012023', 1791209830491807, 25, 0, 0, 0, 2),
(20, '012023', 1791209830491809, 25, 0, 0, 0, 16),
(21, '012023', 17912098304918010, 25, 0, 0, 0, 12),
(22, '012023', 1791209830491808, 25, 0, 0, 0, 13),
(23, '012023', 1791209830491801, 25, 0, 0, 0, 4),
(24, '012023', 17912098304928116, 25, 0, 0, 0, 3),
(25, '012023', 17912098304928113, 25, 0, 0, 0, 3),
(26, '012023', 1791209830491912, 25, 0, 0, 0, 10),
(27, '012023', 17912098304928115, 25, 0, 0, 0, 10),
(28, '012023', 17912098304918012, 25, 0, 0, 0, 11),
(29, '012023', 1791209830491802, 25, 0, 0, 0, 8),
(30, '012023', 17912098304928114, 25, 0, 0, 0, 10),
(31, '012023', 1791209830491805, 24, 0, 0, 0, 6),
(32, '012023', 17912098304918011, 25, 0, 0, 0, 6),
(33, '032023', 1791209830492812, 25, 0, 0, 0, 9),
(34, '032023', 1791209830491806, 22, 1, 2, 0, 3),
(35, '032023', 1791209830491807, 25, 0, 0, 0, 2),
(36, '032023', 1791209830491809, 25, 0, 0, 0, 16),
(37, '032023', 17912098304918010, 25, 0, 0, 0, 12),
(38, '032023', 1791209830491808, 25, 0, 0, 0, 13),
(39, '032023', 1791209830491801, 25, 0, 0, 0, 4),
(40, '032023', 17912098304928116, 25, 0, 0, 0, 3),
(41, '032023', 17912098304928113, 25, 0, 0, 0, 3),
(42, '032023', 1791209830491912, 25, 0, 0, 0, 10),
(43, '032023', 17912098304928115, 25, 0, 0, 0, 10),
(44, '032023', 17912098304918012, 25, 0, 0, 0, 11),
(45, '032023', 1791209830491802, 25, 0, 0, 0, 8),
(46, '032023', 17912098304928114, 25, 0, 0, 0, 10),
(47, '032023', 1791209830491805, 25, 0, 0, 0, 6),
(48, '032023', 17912098304918011, 25, 0, 0, 0, 6),
(49, '052024', 1791209830492812, 22, 1, 1, 1, 9),
(50, '052024', 1791209830491809, 23, 0, 0, 2, 16),
(51, '052024', 1791209830491806, 24, 0, 0, 1, 3),
(52, '052024', 1791209830491807, 22, 0, 0, 3, 2),
(53, '052024', 17912098304918010, 22, 1, 0, 2, 10),
(54, '052024', 1791209830491808, 23, 0, 0, 2, 13),
(55, '052024', 17912098304928116, 20, 2, 0, 3, 3),
(56, '052024', 17912098304928113, 21, 0, 0, 4, 3),
(57, '052024', 1791209830491912, 22, 0, 2, 1, 10),
(58, '052024', 17912098304928115, 21, 0, 0, 4, 10),
(59, '052024', 17912098304918012, 22, 0, 1, 2, 11),
(60, '052024', 1791209830491802, 24, 0, 0, 1, 8),
(61, '052024', 1791209830491805, 22, 0, 0, 3, 6),
(62, '052024', 17912098304928114, 23, 0, 0, 2, 10),
(63, '052024', 1791209830491801, 22, 0, 2, 1, 4),
(64, '052024', 17912098304918011, 21, 1, 1, 2, 6),
(65, '022024', 1791209830492812, 0, 0, 0, 0, 9),
(66, '022024', 1791209830491809, 0, 0, 0, 0, 16),
(67, '022024', 1791209830491806, 0, 0, 0, 0, 3),
(68, '022024', 1791209830491807, 0, 0, 0, 0, 2),
(69, '022024', 17912098304918010, 0, 0, 0, 0, 10),
(70, '022024', 1791209830491808, 0, 0, 0, 0, 13),
(71, '022024', 17912098304928116, 0, 0, 0, 0, 3),
(72, '022024', 17912098304928113, 0, 0, 0, 0, 3),
(73, '022024', 1791209830491912, 0, 0, 0, 0, 10),
(74, '022024', 17912098304928115, 0, 0, 0, 0, 10),
(75, '022024', 17912098304918012, 0, 0, 0, 0, 11),
(76, '022024', 1791209830491802, 0, 0, 0, 0, 8),
(77, '022024', 1791209830491805, 0, 0, 0, 0, 6),
(78, '022024', 17912098304928114, 0, 0, 0, 0, 10),
(79, '022024', 1791209830491801, 0, 0, 0, 0, 4),
(80, '022024', 17912098304918011, 0, 0, 0, 0, 6),
(81, '012024', 1791209830491801, 0, 0, 0, 0, 4),
(82, '012024', 1791209830491802, 0, 0, 0, 0, 8),
(83, '012024', 1791209830491805, 0, 0, 0, 0, 6),
(84, '012024', 1791209830491806, 0, 0, 0, 0, 3),
(85, '012024', 1791209830491807, 0, 0, 0, 0, 2),
(86, '012024', 1791209830491808, 0, 0, 0, 0, 13),
(87, '012024', 1791209830491809, 0, 0, 0, 0, 16),
(88, '012024', 1791209830492812, 0, 0, 0, 0, 9),
(89, '012024', 17912098304918010, 0, 0, 0, 0, 10),
(90, '012024', 17912098304918011, 0, 0, 0, 0, 6),
(91, '012024', 17912098304918012, 0, 0, 0, 0, 11),
(92, '012024', 17912098304928113, 0, 0, 0, 0, 3),
(93, '012024', 17912098304928114, 1, 0, 0, 0, 10),
(94, '012024', 17912098304928116, 1, 0, 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `nip` bigint(20) NOT NULL,
  `nama_pegawai` varchar(200) NOT NULL,
  `nik` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_jabatan` int(20) DEFAULT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `no_telp` bigint(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `id_akses` int(11) DEFAULT NULL,
  `status_keaktifan` varchar(20) NOT NULL,
  `id_lokasi_kerja_pk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`nip`, `nama_pegawai`, `nik`, `username`, `password`, `id_jabatan`, `jenis_kelamin`, `alamat`, `no_telp`, `email`, `tgl_masuk`, `status`, `photo`, `id_akses`, `status_keaktifan`, `id_lokasi_kerja_pk`) VALUES
(1791209830491801, 'Yudis', 3103846890002394, 'yudis', '202cb962ac59075b964b07152d234b70', 4, 'Laki-Laki', 'Jl. KH Agus Salim 16, Sabang, Menteng Jakarta Pusat', 81274857362, 'hendrydjahja@gmail.com', '2012-02-06', 'Pegawai Tetap', 'boy7.png', 3, 'Aktif', 1),
(1791209830491802, 'Rifal', 3302846820002197, 'rifal', '202cb962ac59075b964b07152d234b70', 8, 'Laki-Laki', 'JL. Tebet Raya No. 84, Tebet, Jakarta Selatan', 81222691988, 'richarddjahja@gmail.com', '2012-02-01', 'Pegawai Tetap', 'boy8.png', 1, 'Aktif', 1),
(1791209830491805, 'Ryan', 3321846230002213, 'ryan', '202cb962ac59075b964b07152d234b70', 6, 'Laki-Laki', 'Jl. Metro Pondok Indah Kav. IV, Kebayoran Lama, Jakarta Selatan', 81245760990, 'yana@gmail.com', '2023-02-06', 'Pegawai Tetap', 'boy32.png', 2, 'Aktif', 1),
(1791209830491806, 'Dijah', 3318246420002237, 'dijah', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'Perempuan', 'Jl. Setiabudi Tengah No. 3, Jakarta Selatan 12910', 81260217971, 'dijah@gmail.com', '2023-02-05', 'Pegawai Tetap', 'boy21.png', 1, 'Aktif', 1),
(1791209830491807, 'Dwitya', 3662442312000091, 'dwitya', '81dc9bdb52d04dc20036dbd8313ed055', 2, 'Perempuan', 'Jalan Gunung Sahari 11 Kecil Nomor 22,RT 3 RW 3, Jakarta ', 81282388488, 'dwitya@gmail.com', '2016-01-01', 'Pegawai Tetap', 'girl12.jpeg', 2, 'Aktif', 1),
(1791209830491808, 'Havita Safitri', 3954818850002169, 'havita', '81dc9bdb52d04dc20036dbd8313ed055', 13, 'Perempuan', 'Jalan Bonang No. 19. RT 2/RW 5 Menteng, Jakarta Pusat', 81285539295, 'havitaf@gmail.com', '2017-01-01', 'Pegawai Tetap', 'girl121.jpeg', 2, 'Aktif', 1),
(1791209830491809, 'Darma', 3132892820002168, 'darma', '202cb962ac59075b964b07152d234b70', 16, 'Laki-Laki', 'Jl. Seulawah Raya no. B-3, Kompleks TNI AU Waringin Permai, Jatiwaringin, Kelurahan Cipinang Melayu, Kecamatan Makasar, Jakarta Timur 13620', 81285550385, 'fadlan1@gmail.com', '2019-01-28', 'Pegawai Tetap', 'boy33.png', 1, 'Aktif', 1),
(1791209830491912, 'Murdoko', 6702656820002218, 'murdoko', '202cb962ac59075b964b07152d234b70', 10, 'Laki-Laki', 'Jl Pramuka Sari 5 no 7, Rawasari, Cempaka Putih, Jakarta Pusat. Belakang Hotel Sentral', 82292245433, 'murd0k0@gmail.com', '2023-01-31', 'Pegawai Tetap', 'boy35.png', 2, 'Tidak Aktif', 1),
(1791209830492812, 'Arif B.', 3103846890002394, 'arif', '81dc9bdb52d04dc20036dbd8313ed055', 9, 'Laki-Laki', 'Jln. Raden Saleh Raya no 37 Cikini Jakarta Pusat ', 82311884417, 'arifb2@gmail.com', '2017-01-31', 'Pegawai Tetap', 'boy42.png', 2, 'Aktif', 1),
(17912098304918010, 'Haryono', 3321473950002449, 'haryono', '202cb962ac59075b964b07152d234b70', 10, 'Laki-Laki', 'Jl. Kemuning Raya No. 1 RT/RW 012/02 Utan Kayu Utara, Kec. Matraman – Jakarta Timur', 81297145562, 'hary08@gmail.com', '2019-12-02', 'Pegawai Tetap', 'boy41.png', 2, 'Aktif', 1),
(17912098304918011, 'Yulia', 3213849360002420, 'yulia', '81dc9bdb52d04dc20036dbd8313ed055', 6, 'Perempuan', 'Jalan Pulo Raya V No.14, Kebayoran Baru, Jakarta Selatan 12170 (Belakang Kantor Walikota Jakarta Selatan)', 81355255781, 'yulia02@gmail.com', '2011-02-07', 'Pegawai Tetap', 'girl4.jpeg', 2, 'Aktif', 2),
(17912098304918012, 'Riana', 3127493857460234, 'riana', '81dc9bdb52d04dc20036dbd8313ed055', 11, 'Perempuan', 'Jl. Martapura III No. 4 dan No 8, Kebon Melati, Tanah Abang, Jakarta Pusat 10230', 82259710745, 'r1ana@gmail.com', '2017-02-01', 'Pegawai Tetap', 'girl31.jpeg', 2, 'Aktif', 1),
(17912098304928113, 'Lasma Pardosi', 6948576689000391, 'lasma', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'Perempuan', 'Jl. Kramat Jaya Baru 3 No. 14 RW/RT: 01/15 Kel/Kec: Johar Baru – Jakarta Pusat', 82312446655, 'lasma.pardosi@gloryoffset.com', '2017-02-14', 'Pegawai Tetap', 'girl5.jpeg', 2, 'Aktif', 1),
(17912098304928114, 'Syamil', 6384028490002394, 'syamil', '202cb962ac59075b964b07152d234b70', 10, 'Laki-Laki', 'Green Garden Blok B13 No.27 Kel. Rorotan Kec. Cilincing Jakarta Utara', 85227777728, 'syafrudin@gmail.com', '2016-02-17', 'Pegawai Tetap', 'boy36.png', 2, 'Aktif', 1),
(17912098304928115, 'Nuroso', 6503843850002394, 'nuroso', '202cb962ac59075b964b07152d234b70', 10, 'Laki-Laki', 'Jl. Gunung Sahari XI No. 24 RT 3/3, Jakarta Pusat (Belakang BNI 46)', 83841212099, 'nuroso@gmail.com', '2019-01-15', 'Pegawai Tetap', 'boy43.png', 2, 'Tidak Aktif', 1),
(17912098304928116, 'Kevin Hansdinata', 1234567890987650, 'kevin', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'Laki-Laki', 'UBM', 81348212340, 'kevin@gmail.com', '2023-01-01', 'Pegawai Tetap', 'boy9.png', 2, 'Aktif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_pph`
--

CREATE TABLE `data_pph` (
  `id` int(11) NOT NULL,
  `batas_atas` bigint(20) NOT NULL,
  `batas_bawah` bigint(20) NOT NULL,
  `persen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pph`
--

INSERT INTO `data_pph` (`id`, `batas_atas`, `batas_bawah`, `persen`) VALUES
(1, 0, 60000000, 5),
(3, 60000000, 250000000, 15),
(4, 250000000, 500000000, 25),
(6, 500000000, 5000000000, 30),
(7, 500000000, 9223372036854775807, 35);

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_akses` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_akses`, `keterangan`) VALUES
(1, 'admin'),
(2, 'pegawai'),
(3, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `kalender_thr`
--

CREATE TABLE `kalender_thr` (
  `id` int(11) NOT NULL,
  `tanggal_thr` date NOT NULL,
  `bulan_thr` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kalender_thr`
--

INSERT INTO `kalender_thr` (`id`, `tanggal_thr`, `bulan_thr`) VALUES
(1, '2023-03-16', '032023'),
(3, '2023-03-23', '032023'),
(4, '2024-05-28', '052024');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_kerja`
--

CREATE TABLE `lokasi_kerja` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi_kerja`
--

INSERT INTO `lokasi_kerja` (`id`, `nama_lokasi`, `alamat`) VALUES
(1, 'Jakarta', ''),
(2, 'Malang', ''),
(3, 'Medan', ''),
(4, 'Surabaya', '');

-- --------------------------------------------------------

--
-- Table structure for table `potongan_gaji`
--

CREATE TABLE `potongan_gaji` (
  `id_pot` int(11) NOT NULL,
  `potongan` varchar(50) NOT NULL,
  `jml_potongan` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `potongan_gaji`
--

INSERT INTO `potongan_gaji` (`id_pot`, `potongan`, `jml_potongan`) VALUES
(1, 'Jaminan Kesehatan (%)', 1),
(2, 'Jaminan Hari Tua (%)', 2),
(4, 'Alpha (Dalam Rupiah)', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `relation_cuti_potongan`
--

CREATE TABLE `relation_cuti_potongan` (
  `id` int(11) NOT NULL,
  `id_cuti` int(11) NOT NULL,
  `col_jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relation_cuti_potongan`
--

INSERT INTO `relation_cuti_potongan` (`id`, `id_cuti`, `col_jabatan`) VALUES
(1, 1, 'uang_makan');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_mutasi`
--

CREATE TABLE `riwayat_mutasi` (
  `id` int(11) NOT NULL,
  `nip_pk` bigint(22) NOT NULL,
  `id_jabatan_new_pk` int(11) NOT NULL,
  `id_jabatan_recent_pk` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_lokasi_kerja_new_pk` int(11) NOT NULL,
  `id_lokasi_kerja_recent_pk` int(11) NOT NULL,
  `alasan_mutasi` text NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_mutasi`
--

INSERT INTO `riwayat_mutasi` (`id`, `nip_pk`, `id_jabatan_new_pk`, `id_jabatan_recent_pk`, `tanggal`, `id_lokasi_kerja_new_pk`, `id_lokasi_kerja_recent_pk`, `alasan_mutasi`, `bulan`, `status`) VALUES
(1, 17912098304918012, 11, 11, '2023-03-11', 2, 2, 'Ditempatkan dekat dengan rumah', '032023', 'PENDING'),
(4, 17912098304918011, 6, 6, '2023-03-11', 2, 1, 'dekat dengan rumah', '032023', 'SUCCESS'),
(5, 1791209830491802, 10, 8, '2024-05-28', 3, 1, 'dinas luar kota', '052024', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_phk`
--

CREATE TABLE `riwayat_phk` (
  `id` int(11) NOT NULL,
  `nip_pk` bigint(22) NOT NULL,
  `tanggal` date NOT NULL,
  `alasan_phk` text NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_phk`
--

INSERT INTO `riwayat_phk` (`id`, `nip_pk`, `tanggal`, `alasan_phk`, `bulan`, `status`) VALUES
(1, 17912098304928115, '2023-03-11', 'Kinerja tidak bagus', '032023', 'SUCCESS'),
(2, 1791209830491912, '2024-05-28', 'malas malasan', '052024', 'SUCCESS');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_promosi`
--

CREATE TABLE `riwayat_promosi` (
  `id` int(11) NOT NULL,
  `nip_pk` bigint(22) NOT NULL,
  `id_jabatan_new_pk` int(11) NOT NULL,
  `id_jabatan_recent_pk` int(11) NOT NULL,
  `alasan_promosi` text NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_promosi`
--

INSERT INTO `riwayat_promosi` (`id`, `nip_pk`, `id_jabatan_new_pk`, `id_jabatan_recent_pk`, `alasan_promosi`, `tanggal`, `bulan`, `status`, `keterangan`) VALUES
(1, 17912098304918010, 10, 12, 'Kinerjanya bagus, harus di naikkan', '2023-03-11', '032023', 'SUCCESS', 'PROMOSI');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_sia`
--

CREATE TABLE `riwayat_sia` (
  `id` int(11) NOT NULL,
  `nip_pk` bigint(22) NOT NULL,
  `jenis_sia` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `id_potongan_gaji_pk` int(11) DEFAULT NULL,
  `id_jabatan_pk` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_sia`
--

INSERT INTO `riwayat_sia` (`id`, `nip_pk`, `jenis_sia`, `status`, `tanggal_awal`, `tanggal_akhir`, `tanggal_pengajuan`, `bulan`, `jumlah_hari`, `id_potongan_gaji_pk`, `id_jabatan_pk`, `keterangan`) VALUES
(1, 1791209830491806, 'IJIN', 'SUCCESS', '2023-03-09', '2023-03-09', '2023-03-09', '032023', 1, NULL, 3, 'ijin ke Surabaya'),
(2, 1791209830491806, 'SAKIT', 'SUCCESS', '2023-03-07', '2023-03-08', '2023-03-09', '032023', 2, NULL, 3, 'sakit perut'),
(3, 1791209830491805, 'IJIN', 'FAILED', '2024-05-27', '2024-05-27', '2024-05-27', '052024', 1, NULL, 6, 'sda'),
(4, 1791209830491805, 'SAKIT', 'PENDING', '2024-05-28', '2024-05-28', '2024-05-28', '052024', 1, NULL, 6, 'pusing');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_thr`
--

CREATE TABLE `riwayat_thr` (
  `id` int(11) NOT NULL,
  `id_kalender_thr_pk` int(11) NOT NULL,
  `nip_pk` bigint(22) NOT NULL,
  `nominal` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_thr`
--

INSERT INTO `riwayat_thr` (`id`, `id_kalender_thr_pk`, `nip_pk`, `nominal`) VALUES
(1, 1, 1791209830491801, 5500000),
(2, 1, 1791209830491802, 5200000),
(3, 1, 1791209830491805, 266667),
(4, 1, 1791209830491806, 208333),
(5, 1, 1791209830491807, 3500000),
(6, 1, 1791209830491808, 3700000),
(7, 1, 1791209830491809, 4560000),
(8, 1, 1791209830491912, 720000),
(9, 1, 1791209830492812, 3120000),
(10, 1, 17912098304918010, 4320000),
(11, 1, 17912098304918011, 3200000),
(12, 1, 17912098304918012, 4330000),
(13, 1, 17912098304928113, 2500000),
(14, 1, 17912098304928114, 4320000),
(15, 1, 17912098304928116, 416667),
(16, 3, 1791209830491801, 5800000),
(17, 3, 1791209830491802, 5240000),
(18, 3, 1791209830491805, 458333),
(19, 3, 1791209830491806, 208333),
(20, 3, 1791209830491807, 3500000),
(21, 3, 1791209830491808, 3700000),
(22, 3, 1791209830491809, 4960000),
(23, 3, 1791209830491912, 736667),
(24, 3, 1791209830492812, 3120000),
(25, 3, 17912098304918010, 4420000),
(26, 3, 17912098304918011, 5500000),
(27, 3, 17912098304918012, 4330000),
(28, 3, 17912098304928113, 2500000),
(29, 3, 17912098304928114, 4420000),
(30, 3, 17912098304928116, 416667);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_cuti`
--
ALTER TABLE `data_cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cuti` (`id_cuti`),
  ADD KEY `nip` (`nip`),
  ADD KEY `nip_atasan` (`nip_atasan`);

--
-- Indexes for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `id_pph` (`id_pph_pk`);

--
-- Indexes for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_akses` (`id_akses`),
  ADD KEY `id_lokasi_kerja` (`id_lokasi_kerja_pk`);

--
-- Indexes for table `data_pph`
--
ALTER TABLE `data_pph`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `kalender_thr`
--
ALTER TABLE `kalender_thr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_kerja`
--
ALTER TABLE `lokasi_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  ADD PRIMARY KEY (`id_pot`);

--
-- Indexes for table `relation_cuti_potongan`
--
ALTER TABLE `relation_cuti_potongan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cuti` (`id_cuti`);

--
-- Indexes for table `riwayat_mutasi`
--
ALTER TABLE `riwayat_mutasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip_pk`),
  ADD KEY `id_jabatan_new` (`id_jabatan_new_pk`),
  ADD KEY `id_jabatan_recent` (`id_jabatan_recent_pk`),
  ADD KEY `id_lokasi_kerja_new` (`id_lokasi_kerja_new_pk`),
  ADD KEY `id_lokasi_kerja_recent` (`id_lokasi_kerja_recent_pk`);

--
-- Indexes for table `riwayat_phk`
--
ALTER TABLE `riwayat_phk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip_pk`);

--
-- Indexes for table `riwayat_promosi`
--
ALTER TABLE `riwayat_promosi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip_pk`),
  ADD KEY `id_jabatan_new` (`id_jabatan_new_pk`),
  ADD KEY `id_jabatan_recent` (`id_jabatan_recent_pk`);

--
-- Indexes for table `riwayat_sia`
--
ALTER TABLE `riwayat_sia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip_pk`),
  ADD KEY `id_potongan_gaji` (`id_potongan_gaji_pk`),
  ADD KEY `id_jabatan_pk` (`id_jabatan_pk`);

--
-- Indexes for table `riwayat_thr`
--
ALTER TABLE `riwayat_thr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kalender_thr` (`id_kalender_thr_pk`),
  ADD KEY `nip` (`nip_pk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_cuti`
--
ALTER TABLE `data_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id_kehadiran` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `data_pph`
--
ALTER TABLE `data_pph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kalender_thr`
--
ALTER TABLE `kalender_thr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lokasi_kerja`
--
ALTER TABLE `lokasi_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  MODIFY `id_pot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `relation_cuti_potongan`
--
ALTER TABLE `relation_cuti_potongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `riwayat_mutasi`
--
ALTER TABLE `riwayat_mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `riwayat_phk`
--
ALTER TABLE `riwayat_phk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `riwayat_promosi`
--
ALTER TABLE `riwayat_promosi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `riwayat_sia`
--
ALTER TABLE `riwayat_sia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `riwayat_thr`
--
ALTER TABLE `riwayat_thr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_cuti`
--
ALTER TABLE `data_cuti`
  ADD CONSTRAINT `data_cuti_ibfk_1` FOREIGN KEY (`id_cuti`) REFERENCES `cuti` (`id`),
  ADD CONSTRAINT `data_cuti_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `data_pegawai` (`nip`),
  ADD CONSTRAINT `data_cuti_ibfk_3` FOREIGN KEY (`nip_atasan`) REFERENCES `data_pegawai` (`nip`);

--
-- Constraints for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD CONSTRAINT `data_jabatan_ibfk_1` FOREIGN KEY (`id_pph_pk`) REFERENCES `data_pph` (`id`);

--
-- Constraints for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD CONSTRAINT `data_kehadiran_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `data_pegawai` (`nip`);

--
-- Constraints for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD CONSTRAINT `data_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `data_jabatan` (`id_jabatan`),
  ADD CONSTRAINT `data_pegawai_ibfk_2` FOREIGN KEY (`id_akses`) REFERENCES `hak_akses` (`id_akses`);

--
-- Constraints for table `relation_cuti_potongan`
--
ALTER TABLE `relation_cuti_potongan`
  ADD CONSTRAINT `relation_cuti_potongan_ibfk_1` FOREIGN KEY (`id_cuti`) REFERENCES `cuti` (`id`);

--
-- Constraints for table `riwayat_mutasi`
--
ALTER TABLE `riwayat_mutasi`
  ADD CONSTRAINT `riwayat_mutasi_ibfk_1` FOREIGN KEY (`nip_pk`) REFERENCES `data_pegawai` (`nip`),
  ADD CONSTRAINT `riwayat_mutasi_ibfk_2` FOREIGN KEY (`id_jabatan_new_pk`) REFERENCES `data_jabatan` (`id_jabatan`),
  ADD CONSTRAINT `riwayat_mutasi_ibfk_3` FOREIGN KEY (`id_jabatan_recent_pk`) REFERENCES `data_jabatan` (`id_jabatan`),
  ADD CONSTRAINT `riwayat_mutasi_ibfk_4` FOREIGN KEY (`id_lokasi_kerja_new_pk`) REFERENCES `lokasi_kerja` (`id`),
  ADD CONSTRAINT `riwayat_mutasi_ibfk_5` FOREIGN KEY (`id_lokasi_kerja_recent_pk`) REFERENCES `lokasi_kerja` (`id`);

--
-- Constraints for table `riwayat_phk`
--
ALTER TABLE `riwayat_phk`
  ADD CONSTRAINT `riwayat_phk_ibfk_1` FOREIGN KEY (`nip_pk`) REFERENCES `data_pegawai` (`nip`);

--
-- Constraints for table `riwayat_promosi`
--
ALTER TABLE `riwayat_promosi`
  ADD CONSTRAINT `riwayat_promosi_ibfk_1` FOREIGN KEY (`nip_pk`) REFERENCES `data_pegawai` (`nip`),
  ADD CONSTRAINT `riwayat_promosi_ibfk_2` FOREIGN KEY (`id_jabatan_new_pk`) REFERENCES `data_jabatan` (`id_jabatan`),
  ADD CONSTRAINT `riwayat_promosi_ibfk_3` FOREIGN KEY (`id_jabatan_recent_pk`) REFERENCES `data_jabatan` (`id_jabatan`);

--
-- Constraints for table `riwayat_sia`
--
ALTER TABLE `riwayat_sia`
  ADD CONSTRAINT `riwayat_sia_ibfk_1` FOREIGN KEY (`nip_pk`) REFERENCES `data_pegawai` (`nip`),
  ADD CONSTRAINT `riwayat_sia_ibfk_2` FOREIGN KEY (`id_potongan_gaji_pk`) REFERENCES `potongan_gaji` (`id_pot`);

--
-- Constraints for table `riwayat_thr`
--
ALTER TABLE `riwayat_thr`
  ADD CONSTRAINT `riwayat_thr_ibfk_1` FOREIGN KEY (`id_kalender_thr_pk`) REFERENCES `kalender_thr` (`id`),
  ADD CONSTRAINT `riwayat_thr_ibfk_2` FOREIGN KEY (`nip_pk`) REFERENCES `data_pegawai` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
