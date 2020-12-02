-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 02:37 AM
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
-- Database: `db_ganesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `kd_guru` varchar(3) NOT NULL,
  `nis` varchar(9) NOT NULL,
  `id_hari` int(11) NOT NULL,
  `id_jampel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tanggal_absen` date NOT NULL,
  `jam_absen` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `kd_guru`, `nis`, `id_hari`, `id_jampel`, `id_kelas`, `tanggal_absen`, `jam_absen`) VALUES
(1, '002', '181907002', 3, 4, 4, '2020-11-18', '09:40'),
(2, '015', '181907003', 3, 1, 4, '2020-11-18', '10:27'),
(3, '015', '181907003', 3, 2, 4, '2020-11-18', '10:27'),
(4, '015', '181907003', 3, 3, 4, '2020-11-18', '10:27'),
(5, '012', '181907002', 3, 7, 4, '2020-11-18', '19:50'),
(6, '012', '181907002', 3, 8, 4, '2020-11-18', '19:50'),
(7, '012', '181907002', 3, 9, 4, '2020-11-18', '19:50'),
(8, '013', '181907004', 4, 1, 4, '2020-11-18', '02:00'),
(9, '013', '181907004', 4, 2, 4, '2020-11-18', '02:00'),
(10, '013', '181907004', 4, 5, 4, '2020-11-18', '02:00'),
(11, '012', '192007055', 5, 10, 3, '2020-11-20', '10:06'),
(12, '012', '192007055', 5, 11, 3, '2020-11-20', '10:06'),
(13, '012', '192007055', 5, 12, 3, '2020-11-20', '10:06');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `role`) VALUES
(3, 'admin', '123456', '000'),
(4, 'absensi', '123456', '001'),
(5, 'bendahara', '123456', '010'),
(6, '192007049', '030107', '011'),
(7, '192007050', '071207', '011'),
(8, '192007051', '150307', '011'),
(9, '192007052', '040207', '011'),
(10, '192007052', '040206', '011'),
(11, '192007053', '061107', '011'),
(12, '192007054', '160907', '011'),
(13, '192007055', '210406', '011'),
(14, '192007056', '200707', '011'),
(15, '192007058', '220505', '011'),
(16, '192007059', '080505', '011'),
(17, '192007060', '050807', '011'),
(18, '192007061', '120207', '011'),
(19, '192007062', '220505', '011'),
(20, '192007063', '130307', '011'),
(21, '192007064', '160907', '011'),
(22, '192007065', '040507', '011'),
(23, '192007066', '021107', '011'),
(24, '192007068', '160207', '011'),
(25, '192007071', '091105', '011'),
(26, '192007072', '111007', '011'),
(27, '181907002', '020306', '011'),
(28, '181907003', '180606', '011'),
(29, '181907004', '190506', '011'),
(30, '181907005', '100606', '011'),
(31, '181907006', '120406', '011'),
(32, '181907007', '030306', '011'),
(33, '181907008', '121204', '011'),
(34, '181907009', '061205', '011'),
(35, '181907010', '241105', '011'),
(36, '181907011', '030206', '011'),
(37, '181907012', '200206', '011'),
(38, '181907013', '200705', '011'),
(39, '181907014', '070205', '011'),
(40, '181907015', '081205', '011'),
(41, '181907016', '100805', '011'),
(42, '181907017', '061106', '011'),
(43, '181907018', '260306', '011'),
(44, '181907019', '011005', '011'),
(45, '181907020', '110306', '011'),
(46, '181907023', '211105', '011'),
(47, '181907024', '021105', '011'),
(48, '181907025', '010305', '011'),
(49, '181907026', '100505', '011'),
(50, '181907027', '190406', '011'),
(51, '181907028', '091204', '011'),
(52, '181907029', '200405', '011'),
(53, '181907030', '261206', '011'),
(54, '181907031', '191206', '011'),
(55, '181907032', '060106', '011'),
(56, '181907033', '030506', '011'),
(57, '385274865120', '100570', '101'),
(58, '754776366420', '150285', '101'),
(59, '594873563520', '160657', '101'),
(60, '803775665730', '050278', '101'),
(61, '254475065020', '121272', '101'),
(62, '455474864930', '220266', '101'),
(63, '454274864930', '100270', '101'),
(64, '183474764930', '020569', '101'),
(65, '335075565730', '181077', '101'),
(66, '303415102164', '191285', '101'),
(67, '511151444041', '080494', '101'),
(68, '171543412145', '200592', '101'),
(69, '186374664630', '310568', '101'),
(70, '364775865930', '150380', '101'),
(71, '541101711151', '160477', '101'),
(72, '112110125411', '030968', '101'),
(73, '120113411517', '110495', '101'),
(74, '181907035', '160806', '011'),
(75, '181907071', '220905', '011'),
(76, '181907072', '040305', '011'),
(77, '181907036', '160606', '011'),
(78, '181907037', '131105', '011'),
(79, '181907038', '010903', '011'),
(80, '181907039', '070506', '011'),
(81, '181907041', '210706', '011'),
(82, '181907042', '170704', '011'),
(83, '181907043', '081104', '011'),
(84, '181907044', '020405', '011'),
(85, '181907045', '011205', '011'),
(86, '181907046', '020906', '011'),
(87, '181907047', '300905', '011'),
(88, '181907048', '110506', '011'),
(89, '181907051', '201004', '011'),
(90, '181907052', '010906', '011'),
(91, '181907053', '310304', '011'),
(92, '181907049', '210705', '011'),
(93, '181907070', '170806', '011'),
(94, '181907054', '270904', '011'),
(95, '181907055', '121005', '011'),
(96, '181907056', '130206', '011'),
(97, '181907067', '271105', '011'),
(98, '181907058', '271005', '011'),
(99, '181907059', '051206', '011'),
(100, '181907060', '051205', '011'),
(101, '181907061', '160806', '011'),
(102, '181907062', '281105', '011'),
(103, '181907063', '190605', '011'),
(104, '181907065', '040206', '011'),
(105, '181907066', '071106', '011'),
(106, '192007025', '140607', '011'),
(107, '192007026', '090704', '011'),
(108, '192007027', '090407', '011'),
(109, '192007028', '150907', '011'),
(110, '192007029', '230607', '011'),
(111, '192007030', '171106', '011'),
(112, '192007031', '270706', '011'),
(113, '192007032', '130707', '011'),
(114, '192007033', '050407', '011'),
(115, '192007034', '060107', '011'),
(116, '192007036', '110307', '011'),
(117, '192007037', '020204', '011'),
(118, '192007038', '100905', '011'),
(119, '192007039', '060907', '011'),
(120, '192007041', '020707', '011'),
(121, '192007042', '240207', '011'),
(122, '192007043', '290605', '011'),
(123, '192007044', '210408', '011'),
(124, '192007045', '280106', '011'),
(125, '192007046', '170707', '011'),
(126, '192007047', '220307', '011'),
(127, '192007048', '010907', '011'),
(128, '192007002', '030107', '011'),
(129, '192007003', '221007', '011'),
(130, '192007004', '211106', '011'),
(131, '192007005', '121005', '011'),
(132, '192007006', '181106', '011'),
(133, '192007007', '071106', '011'),
(134, '192007008', '110806', '011'),
(135, '192007009', '121008', '011'),
(136, '192007010', '071007', '011'),
(137, '192007011', '250905', '011'),
(138, '192007012', '250406', '011'),
(139, '192007013', '280906', '011'),
(140, '192007014', '231105', '011'),
(141, '192007016', '170807', '011'),
(142, '192007017', '040706', '011'),
(143, '192007018', '270406', '011'),
(144, '192007019', '260205', '011'),
(145, '192007020', '290906', '011'),
(146, '192007021', '020906', '011'),
(147, '192007022', '250306', '011'),
(148, '192007023', '141206', '011'),
(149, '192007024', '030807', '011');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id_bayar` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `alokasi` varchar(3) NOT NULL,
  `nis` varchar(9) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nuptk` varchar(16) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `id_matpel` int(11) NOT NULL,
  `kd_guru` varchar(3) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nuptk`, `nama`, `id_matpel`, `kd_guru`, `tgl_lahir`) VALUES
('112110125411', 'Ir. NURSAIDA SINAGA', 10, '017', '1968-09-03'),
('120113411517', 'ROHMAN,S.Pd.', 3, '018', '1995-04-11'),
('171543412145', 'DINA MARIANA,S.E.', 5, '013', '1992-05-20'),
('183474764930', 'MEITY PURNAMAWATI, Dipl.', 6, '009', '1969-05-02'),
('186374664630', 'LESTARI UTAMI, S.Pd.', 10, '014', '1968-05-31'),
('254475065020', 'FERRY IRAWAN,S.Pd.', 12, '006', '1972-12-12'),
('303415102164', 'EDWARD TONI PALMELAY S,Th.', 9, '011', '1985-12-19'),
('335075565730', 'ISTI DARWATI,S.Pd', 7, '010', '1977-10-18'),
('364775865930', 'DIANA SUSANTI,SPd.', 11, '015', '1980-03-15'),
('385274865120', 'WESLI MARPAUNG,SE.', 1, '002', '1970-05-10'),
('454274864930', 'YENTI IDRIS,S.Pd.', 4, '008', '1970-02-10'),
('455474864930', 'WARSINI, Dipl.', 1, '007', '1966-02-22'),
('511151444041', 'SHINTA AYU APRIANI,S.Pd.', 3, '012', '1994-04-08'),
('541101711151', 'WAHYUDIN, S.Pd.I.', 8, '016', '1977-04-16'),
('594873563520', 'SUNARTO, M.Pd.', 12, '004', '1957-06-16'),
('754776366420', 'SUPARDI, S.Pd.I.', 2, '003', '1985-02-15'),
('803775665730', 'KARTINI, S.Pd.', 4, '005', '1978-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `hari` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hari`, `hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jumat');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_hari` int(11) NOT NULL,
  `id_jampel` int(11) NOT NULL,
  `kd_guru` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_kelas`, `id_hari`, `id_jampel`, `kd_guru`) VALUES
(3, 3, 1, 2, '004'),
(4, 3, 1, 3, '004'),
(5, 3, 1, 4, '014'),
(6, 3, 1, 5, '014'),
(7, 3, 1, 6, '002'),
(8, 3, 1, 7, '002'),
(9, 3, 1, 8, '009'),
(10, 3, 1, 9, '009'),
(11, 3, 2, 1, '009'),
(12, 3, 2, 2, '013'),
(13, 3, 2, 3, '013'),
(14, 3, 2, 4, '014'),
(15, 3, 2, 5, '014'),
(16, 3, 2, 6, '014'),
(17, 3, 2, 7, '012'),
(18, 3, 2, 8, '012'),
(19, 3, 2, 9, '012'),
(20, 3, 3, 1, '014'),
(21, 3, 3, 2, '014'),
(22, 3, 3, 3, '004'),
(23, 3, 3, 4, '004'),
(24, 3, 3, 5, '005'),
(25, 3, 3, 6, '005'),
(26, 3, 3, 7, '013'),
(27, 3, 3, 8, '013'),
(28, 3, 3, 9, '013'),
(29, 3, 4, 1, '003'),
(30, 3, 4, 2, '003'),
(31, 3, 4, 3, '003'),
(32, 3, 4, 4, '015'),
(33, 3, 4, 5, '015'),
(34, 3, 4, 6, '015'),
(35, 3, 4, 7, '002'),
(36, 3, 4, 8, '002'),
(37, 3, 5, 10, '012'),
(38, 3, 5, 11, '012'),
(39, 3, 5, 12, '012'),
(40, 3, 5, 13, '002'),
(41, 3, 5, 14, '005'),
(42, 3, 5, 15, '005'),
(43, 4, 1, 2, '008'),
(44, 4, 1, 3, '008'),
(45, 4, 1, 4, '002'),
(46, 4, 1, 5, '012'),
(47, 4, 1, 6, '012'),
(48, 4, 1, 7, '012'),
(49, 4, 1, 8, '002'),
(50, 4, 1, 9, '002'),
(51, 4, 2, 1, '003'),
(52, 4, 2, 2, '003'),
(53, 4, 2, 3, '003'),
(54, 4, 2, 4, '013'),
(55, 4, 2, 5, '004'),
(56, 4, 2, 6, '004'),
(57, 4, 2, 7, '009'),
(58, 4, 2, 8, '009'),
(59, 4, 2, 9, '009'),
(60, 4, 3, 1, '015'),
(61, 4, 3, 2, '015'),
(62, 4, 3, 3, '015'),
(63, 4, 3, 4, '002'),
(64, 4, 3, 5, '017'),
(65, 4, 3, 6, '017'),
(66, 4, 3, 7, '012'),
(67, 4, 3, 8, '012'),
(68, 4, 3, 9, '012'),
(69, 4, 4, 1, '013'),
(70, 4, 4, 2, '013'),
(71, 4, 4, 3, '008'),
(72, 4, 4, 4, '008'),
(73, 4, 4, 5, '013'),
(74, 4, 4, 6, '002'),
(75, 4, 4, 7, '004'),
(76, 4, 4, 8, '004'),
(77, 4, 5, 10, '017'),
(78, 4, 5, 11, '017'),
(79, 4, 5, 12, '017'),
(80, 4, 5, 13, '016'),
(81, 4, 5, 14, '016'),
(82, 4, 5, 15, '016'),
(83, 5, 1, 2, '012'),
(84, 5, 1, 3, '012'),
(85, 5, 1, 4, '012'),
(86, 5, 1, 5, '003'),
(87, 5, 1, 6, '003'),
(88, 5, 1, 7, '003'),
(89, 5, 1, 8, '008'),
(90, 5, 1, 9, '008'),
(91, 5, 2, 1, '004'),
(92, 5, 2, 2, '004'),
(93, 5, 2, 3, '009'),
(94, 5, 2, 4, '009'),
(95, 5, 2, 5, '009'),
(96, 5, 2, 6, '013'),
(97, 5, 2, 7, '013'),
(98, 5, 2, 8, '017'),
(99, 5, 2, 9, '017'),
(100, 5, 3, 1, '012'),
(101, 5, 3, 2, '012'),
(102, 5, 3, 3, '012'),
(103, 5, 3, 4, '015'),
(104, 5, 3, 5, '015'),
(105, 5, 3, 6, '015'),
(106, 5, 3, 7, '002'),
(107, 5, 3, 8, '002'),
(108, 5, 3, 9, '002'),
(109, 5, 4, 1, '008'),
(110, 5, 4, 2, '008'),
(111, 5, 4, 3, '002'),
(112, 5, 4, 4, '002'),
(113, 5, 4, 5, '004'),
(114, 5, 4, 6, '004'),
(115, 5, 4, 7, '013'),
(116, 5, 4, 8, '013'),
(117, 5, 5, 10, '016'),
(118, 5, 5, 11, '016'),
(119, 5, 5, 12, '016'),
(120, 5, 5, 13, '017'),
(121, 5, 5, 14, '017'),
(122, 5, 5, 15, '017'),
(123, 6, 1, 2, '014'),
(124, 6, 1, 3, '014'),
(125, 6, 1, 4, '013'),
(126, 6, 1, 5, '009'),
(127, 6, 1, 6, '009'),
(128, 6, 1, 7, '009'),
(129, 6, 1, 8, '003'),
(130, 6, 1, 9, '003'),
(131, 6, 2, 1, '006'),
(132, 6, 2, 2, '006'),
(133, 6, 2, 3, '017'),
(134, 6, 2, 4, '012'),
(135, 6, 2, 5, '012'),
(136, 6, 2, 6, '012'),
(137, 6, 2, 7, '007'),
(138, 6, 2, 8, '007'),
(139, 6, 2, 9, '007'),
(140, 6, 3, 1, '017'),
(141, 6, 3, 2, '017'),
(142, 6, 3, 3, '005'),
(143, 6, 3, 4, '005'),
(144, 6, 3, 5, '013'),
(145, 6, 3, 6, '013'),
(146, 6, 3, 7, '003'),
(147, 6, 3, 8, '017'),
(148, 6, 3, 9, '017'),
(149, 6, 4, 1, '015'),
(150, 6, 4, 2, '015'),
(151, 6, 4, 3, '015'),
(152, 6, 4, 4, '007'),
(153, 6, 4, 5, '007'),
(154, 6, 4, 6, '012'),
(155, 6, 4, 7, '012'),
(156, 6, 4, 8, '012'),
(157, 6, 5, 10, '013'),
(158, 6, 5, 11, '013'),
(159, 6, 5, 12, '005'),
(160, 6, 5, 13, '005'),
(161, 6, 5, 14, '006'),
(162, 6, 5, 15, '006'),
(163, 7, 1, 2, '009'),
(164, 7, 1, 3, '009'),
(165, 7, 1, 4, '009'),
(166, 7, 1, 5, '004'),
(167, 7, 1, 6, '004'),
(168, 7, 1, 7, '014'),
(169, 7, 1, 8, '014'),
(170, 7, 1, 9, '013'),
(171, 7, 2, 1, '012'),
(172, 7, 2, 2, '012'),
(173, 7, 2, 3, '012'),
(174, 7, 2, 4, '002'),
(175, 7, 2, 5, '002'),
(176, 7, 2, 6, '002'),
(177, 7, 2, 7, '015'),
(178, 7, 2, 8, '015'),
(179, 7, 2, 9, '015'),
(180, 7, 3, 1, '013'),
(181, 7, 3, 2, '013'),
(182, 7, 3, 3, '014'),
(183, 7, 3, 4, '014'),
(184, 7, 3, 5, '014'),
(185, 7, 3, 6, '004'),
(186, 7, 3, 7, '004'),
(187, 7, 3, 8, '005'),
(188, 7, 3, 9, '005'),
(189, 7, 4, 1, '002'),
(190, 7, 4, 2, '002'),
(191, 7, 4, 3, '012'),
(192, 7, 4, 4, '012'),
(193, 7, 4, 5, '012'),
(194, 7, 4, 6, '003'),
(195, 7, 4, 7, '003'),
(196, 7, 4, 8, '003'),
(197, 7, 5, 10, '005'),
(198, 7, 5, 11, '005'),
(199, 7, 5, 12, '014'),
(200, 7, 5, 13, '014'),
(201, 7, 5, 14, '013'),
(202, 7, 5, 15, '013');

-- --------------------------------------------------------

--
-- Table structure for table `jam_pelajaran`
--

CREATE TABLE `jam_pelajaran` (
  `id_jampel` int(11) NOT NULL,
  `jampel` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam_pelajaran`
--

INSERT INTO `jam_pelajaran` (`id_jampel`, `jampel`) VALUES
(1, '07.00-07.50'),
(2, '07.50-08.30'),
(3, '08.30-09.10'),
(4, '09.10-09.50'),
(5, '10.10-10.50'),
(6, '10.50-11.30'),
(7, '11.30-12.10'),
(8, '12.40-13.20'),
(9, '13.20-14.00'),
(10, '07.00-07.40'),
(11, '07.40-08.20'),
(12, '08.20-09.00'),
(13, '09.00-09.40'),
(14, '10.00-10.40'),
(15, '10.40-11.20');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(7, '8-1'),
(6, '8-2'),
(3, '8-3'),
(4, '9-1'),
(5, '9-2');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_matpel` int(11) NOT NULL,
  `nama_matpel` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_matpel`, `nama_matpel`) VALUES
(1, 'Matematika'),
(2, 'PJOK'),
(3, 'Bahasa Indonesia'),
(4, 'Bahasa Inggris'),
(5, 'Bahasa Sunda'),
(6, 'Seni Budaya'),
(7, 'Prakarya'),
(8, 'Pendidikan Agama Islam'),
(9, 'Pendidikan Agama Kristen'),
(10, 'IPA'),
(11, 'PPKn'),
(12, 'IPS');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(9) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `Agama` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `id_kelas`, `nama`, `tgl_lahir`, `Agama`) VALUES
('181907002', 4, 'Alfarizi', '2006-03-02', 'ISLAM'),
('181907003', 4, 'Ananda Yunia Sabila', '2006-06-18', 'ISLAM'),
('181907004', 4, 'Aria Anoro Pasha', '2006-05-19', 'ISLAM'),
('181907005', 4, 'Awal Nur Hakim', '2006-06-10', 'ISLAM'),
('181907006', 4, 'Clarissa Aprianti', '2006-04-12', 'PROTESTAN'),
('181907007', 4, 'Clea Shiva Mayuri', '2006-03-03', 'ISLAM'),
('181907008', 4, 'Dendi Pirmansyah', '2004-12-12', 'ISLAM'),
('181907009', 4, 'Dendy Duta Dafansyah', '2005-12-06', 'ISLAM'),
('181907010', 4, 'Eki Pratama Mulya', '2005-11-24', 'ISLAM'),
('181907011', 4, 'Farid Hidayat', '2006-02-03', 'ISLAM'),
('181907012', 4, 'Indra Saputra', '2006-02-20', 'ISLAM'),
('181907013', 4, 'Julian Pratama', '2005-07-20', 'ISLAM'),
('181907014', 4, 'M. FEBRIYANTO', '2005-02-07', 'ISLAM'),
('181907015', 4, 'Muhammad Alamsyah', '2005-12-08', 'ISLAM'),
('181907016', 4, 'Muhamad Daffa', '2005-08-10', 'ISLAM'),
('181907017', 4, 'M. Fitrah Ramadhan', '2006-11-06', 'ISLAM'),
('181907018', 4, 'M. Ikbal Supriyadi', '2006-03-26', 'ISLAM'),
('181907019', 4, 'M. Salim', '2005-10-01', 'ISLAM'),
('181907020', 4, 'Mareno Restu Putra', '2006-03-11', 'ISLAM'),
('181907023', 4, 'Novvi Yanti Indah Safitri', '2005-11-21', 'ISLAM'),
('181907024', 4, 'Ramdan Ramadhan', '2005-11-02', 'ISLAM'),
('181907025', 4, 'Ridwan', '2005-03-01', 'ISLAM'),
('181907026', 4, 'Rifky Fadilah', '2005-05-10', 'ISLAM'),
('181907027', 4, 'Riva Lugis Sakila', '2006-04-19', 'ISLAM'),
('181907028', 4, 'Samuel Gus Setya Putra', '2004-12-09', 'PROTESTAN'),
('181907029', 4, 'Siti Nurul Ilhan', '2005-04-20', 'ISLAM'),
('181907030', 4, 'Taliyah', '2006-12-26', 'ISLAM'),
('181907031', 4, 'Wanda Syakila', '2006-12-19', 'ISLAM'),
('181907032', 4, 'Yusuf Solahudin', '2006-01-06', 'ISLAM'),
('181907033', 4, 'Faryal Athallah Eriansyah', '2006-05-03', 'ISLAM'),
('181907035', 5, 'Abi Mustafa', '2006-08-16', 'ISLAM'),
('181907036', 5, 'Ahmad Lutfi Syahdilla', '2006-06-16', 'ISLAM'),
('181907037', 5, 'Alfian Muhammad Fathir', '2005-11-13', 'ISLAM'),
('181907038', 5, 'Aliyah Oktaviani', '2003-09-01', 'ISLAM'),
('181907039', 5, 'Ayu Amelia', '2006-05-07', 'ISLAM'),
('181907041', 5, 'Daffa Azzaky', '2006-07-21', 'ISLAM'),
('181907042', 5, 'Dania Putri Agustiana', '2004-07-17', 'ISLAM'),
('181907043', 5, 'Dhini Ramadhani', '2004-11-08', 'ISLAM'),
('181907044', 5, 'Ezra Revancello', '2005-04-02', 'PROTESTAN'),
('181907045', 5, 'Firly Yusmiyati', '2005-12-01', 'ISLAM'),
('181907046', 5, 'Gadis Bunga Pertiwi', '2006-09-02', 'ISLAM'),
('181907047', 5, 'Ibrahim Wijaya', '2005-09-30', 'ISLAM'),
('181907048', 5, 'Levi Kurniawan', '2006-05-11', 'ISLAM'),
('181907049', 5, 'Muhammad Kamal Ardiansyah', '2005-07-21', 'ISLAM'),
('181907051', 5, 'Marhani Oktaviana', '2004-10-20', 'ISLAM'),
('181907052', 5, 'Mario Pattinasarane', '2006-09-01', 'PROTESTAN'),
('181907053', 5, 'Mecelline', '2004-03-31', 'PROTESTAN'),
('181907054', 5, 'Muhammad Rizki', '2004-09-27', 'ISLAM'),
('181907055', 5, 'Nanda Putra Pratama', '2005-10-12', 'ISLAM'),
('181907056', 5, 'Nurul Husnah', '2006-02-13', 'ISLAM'),
('181907058', 5, 'Sheviana Ramadhani', '2005-10-27', 'ISLAM'),
('181907059', 5, 'Siti Nurkhalifah', '2006-12-05', 'ISLAM'),
('181907060', 5, 'Sukanto', '2005-12-05', 'ISLAM'),
('181907061', 5, 'Syifa Nur Andini', '2006-08-16', 'ISLAM'),
('181907062', 5, 'Tiara Rahmania Putri', '2005-11-28', 'ISLAM'),
('181907063', 5, 'Variska Amalia Putri', '2005-06-19', 'ISLAM'),
('181907065', 5, 'Ziyad Hadafi', '2006-02-04', 'ISLAM'),
('181907066', 5, 'Zulfa Noviana', '2006-11-07', 'ISLAM'),
('181907067', 5, 'Salsa Novitasari', '2005-11-27', 'ISLAM'),
('181907070', 5, 'Muhammad Luthfi Faqih', '2006-08-17', 'ISLAM'),
('181907071', 5, 'Adam Rizki Nursabani', '2005-09-22', 'ISLAM'),
('181907072', 5, 'Aditya Saputra', '2005-03-04', 'ISLAM'),
('192007002', 7, 'Agung Ardiyanto', '2007-01-03', 'ISLAM'),
('192007003', 7, 'Ahmad Duta Rossi', '2007-10-22', 'ISLAM'),
('192007004', 7, 'Ahmad Elvansyad', '2006-11-21', 'ISLAM'),
('192007005', 7, 'Andi Ahmad Givary', '2005-10-12', 'ISLAM'),
('192007006', 7, 'Angga Pratama Yudha', '2006-11-18', 'ISLAM'),
('192007007', 7, 'Arvan Saleh Hutasuhut', '2006-11-07', 'ISLAM'),
('192007008', 7, 'Arya Firdaus', '2006-08-11', 'PROTESTAN'),
('192007009', 7, 'Assadur Rofik Ramadani', '2008-10-12', 'ISLAM'),
('192007010', 7, 'Azzam Dhiah Ramadhan', '2007-10-07', 'ISLAM'),
('192007011', 7, 'Bayu Saputra', '2005-09-25', 'ISLAM'),
('192007012', 7, 'Darma Tarung Heriadi', '2006-04-25', 'PROTESTAN'),
('192007013', 7, 'Mutiara Eka Putri Manik', '2006-09-28', 'ISLAM'),
('192007014', 7, 'Nova Heryanti', '2005-11-23', 'ISLAM'),
('192007016', 7, 'Putri Aulia Hartita', '2007-08-17', 'ISLAM'),
('192007017', 7, 'Rani Dwi Cahya', '2006-07-04', 'ISLAM'),
('192007018', 7, 'Rizka Putri Aprillia', '2006-04-27', 'ISLAM'),
('192007019', 7, 'Rizky Andriansyah Kurniawan', '2005-02-26', 'ISLAM'),
('192007020', 7, 'Septiriani', '2006-09-29', 'ISLAM'),
('192007021', 7, 'Sevi Naila Agustin', '2006-09-02', 'ISLAM'),
('192007022', 7, 'Tania Aisya Ria', '2006-03-25', 'ISLAM'),
('192007023', 7, 'Tiara Nafisya', '2006-12-14', 'ISLAM'),
('192007024', 7, 'Zakiia Tri Agustin', '2007-08-03', 'ISLAM'),
('192007025', 6, 'Adelia Sukma', '2007-06-14', 'ISLAM'),
('192007026', 6, 'Adrez Silviana Putri', '2004-07-09', 'ISLAM'),
('192007027', 6, 'Afriyanti Pratiwi', '2007-04-09', 'ISLAM'),
('192007028', 6, 'Alyssa Ramadhani Turandi', '2007-09-15', 'ISLAM'),
('192007029', 6, 'Anisa Saskia', '2007-06-23', 'ISLAM'),
('192007030', 6, 'Aulia Pratama', '2006-11-17', 'ISLAM'),
('192007031', 6, 'Aulia Rofi', '2006-07-27', 'ISLAM'),
('192007032', 6, 'Della Putri Aisyah', '2007-07-13', 'ISLAM'),
('192007033', 6, 'Dewinta Nur Fajar', '2007-04-05', 'ISLAM'),
('192007034', 6, 'Dian Utami', '2007-01-06', 'ISLAM'),
('192007036', 6, 'Ferry Mardiansyah', '2007-03-11', 'ISLAM'),
('192007037', 6, 'Fikri Maulana', '2004-02-02', 'ISLAM'),
('192007038', 6, 'Gilang Ramadhan', '2005-09-10', 'ISLAM'),
('192007039', 6, 'Haikal Aditya Sabani', '2007-09-06', 'ISLAM'),
('192007041', 6, 'Hidayat Nur Julianto', '2007-07-02', 'ISLAM'),
('192007042', 6, 'Ikhsan Fadilah Hakim', '2007-02-24', 'ISLAM'),
('192007043', 6, 'Ivan Catur Nugroho', '2005-06-29', 'ISLAM'),
('192007044', 6, 'Jagat Maulana', '2008-04-21', 'ISLAM'),
('192007045', 6, 'Jihan Japari', '2006-01-28', 'ISLAM'),
('192007046', 6, 'Jordan Slamet Riadi', '2007-07-17', 'ISLAM'),
('192007047', 6, 'Lukman Sembada', '2007-03-22', 'ISLAM'),
('192007048', 6, 'Muhammad Abiyu', '2007-09-01', 'ISLAM'),
('192007049', 3, 'Auwale Sangadji', '2007-01-03', 'ISLAM'),
('192007050', 3, 'Ellyana Simanjuntak', '2007-12-07', 'PROTESTAN'),
('192007051', 3, 'Fatimah Zahra Opik', '2007-03-15', 'ISLAM'),
('192007052', 3, 'Febby Dwi Kurniawati', '2006-02-04', 'ISLAM'),
('192007053', 3, 'Friska Damayanti', '2007-11-06', 'ISLAM'),
('192007054', 3, 'Ineke Suviyah Anum', '2007-09-16', 'ISLAM'),
('192007055', 3, 'Jesslyne Jessieca Pattiwael', '2006-04-21', 'PROTESTAN'),
('192007056', 3, 'Khairunnisa Harahap', '2007-07-20', 'ISLAM'),
('192007058', 3, 'Maria Josepien', '2005-05-22', 'ISLAM'),
('192007059', 3, 'Mayla Putri Prasetyo', '2005-05-08', 'ISLAM'),
('192007060', 3, 'Nasywa Siti Marwah', '2007-08-05', 'ISLAM'),
('192007061', 3, 'Erick Adenio Rozian Hafidz', '2007-02-12', 'ISLAM'),
('192007062', 3, 'M. Davi Alviansyah', '2005-05-22', 'ISLAM'),
('192007063', 3, 'Marvin Wilsonsel', '2007-03-13', 'ISLAM'),
('192007064', 3, 'Muhammad Alif Ramadhan ', '2007-09-16', 'ISLAM'),
('192007065', 3, 'Muhammad Fadhil Akbar', '2007-05-04', 'ISLAM'),
('192007066', 3, 'Muhammad Rafa Baihaqi', '2007-11-02', 'ISLAM'),
('192007068', 3, 'Nathan Prahitna', '2007-02-16', 'ISLAM'),
('192007071', 3, 'Sofyan Putra Ramadhan', '2005-11-09', 'ISLAM'),
('192007072', 3, 'Zakyul Fuad', '2007-10-11', 'ISLAM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `kd_guru` (`kd_guru`),
  ADD KEY `nis` (`nis`),
  ADD KEY `hari` (`id_hari`),
  ADD KEY `jam` (`id_jampel`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nuptk`),
  ADD KEY `id_matpel` (`id_matpel`),
  ADD KEY `kd_guru` (`kd_guru`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `kelas` (`id_kelas`),
  ADD KEY `id_hari` (`id_hari`),
  ADD KEY `id_jampel` (`id_jampel`),
  ADD KEY `kd_guru` (`kd_guru`);

--
-- Indexes for table `jam_pelajaran`
--
ALTER TABLE `jam_pelajaran`
  ADD PRIMARY KEY (`id_jampel`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `nama_kelas` (`nama_kelas`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_matpel`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `jam_pelajaran`
--
ALTER TABLE `jam_pelajaran`
  MODIFY `id_jampel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_matpel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`kd_guru`) REFERENCES `guru` (`kd_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absen_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absen_ibfk_3` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id_hari`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absen_ibfk_4` FOREIGN KEY (`id_jampel`) REFERENCES `jam_pelajaran` (`id_jampel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absen_ibfk_5` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bayar`
--
ALTER TABLE `bayar`
  ADD CONSTRAINT `bayar_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id_matpel`) REFERENCES `mata_pelajaran` (`id_matpel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id_hari`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`id_jampel`) REFERENCES `jam_pelajaran` (`id_jampel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_4` FOREIGN KEY (`kd_guru`) REFERENCES `guru` (`kd_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_5` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
