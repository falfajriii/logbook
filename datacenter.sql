-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2019 at 05:45 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datacenter`
--

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` int(5) NOT NULL,
  `nm_kunjungan` varchar(30) NOT NULL,
  `company` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(300) NOT NULL,
  `jam_msk` varchar(50) NOT NULL,
  `jam_klr` varchar(50) NOT NULL,
  `pendamping` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`id_kunjungan`, `nm_kunjungan`, `company`, `tanggal`, `keterangan`, `jam_msk`, `jam_klr`, `pendamping`) VALUES
(1, 'Alfajri', 'Perusahaan', '2019-05-22', 'tes', '13.38 WIB', '15.12 WIB', 'pendamping1'),
(2, 'Alfajri', 'Perusahaan', '2019-06-30', 'testing', '11.06 WIB', '12.22 WIB', 'pendamping1');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(5) NOT NULL,
  `nama_pendamping` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `tugas` varchar(500) NOT NULL,
  `status` enum('Dikonfirmasi','Ditolak','Menunggu') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `nama_pendamping`, `tgl`, `tugas`, `status`) VALUES
(1, 'pendamping1', '2019-05-22', 'mendampingi', 'Dikonfirmasi'),
(2, 'pendamping3', '2019-06-30', 'benerin listrik', 'Dikonfirmasi'),
(3, 'pendamping2', '2019-06-30', 'testing gan', 'Ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengunjung` int(10) NOT NULL,
  `nama_pengunjung` varchar(30) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `status` enum('Menunggu','Terkonfirmasi','Ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_pengunjung`, `nama_pengunjung`, `nik`, `no_telp`, `instansi`, `alamat`, `email`, `foto`, `status`) VALUES
(1, 'Alfajri', '11160930000001', '081818181811', 'Perusahaan', 'Kreo', 'asri@gmail', '17052019171029DSC.jpg', 'Terkonfirmasi'),
(2, 'asri', '30148894611', '0821991922822', 'UIN', 'ciputat', 'asimayo99@gmail.com', '30062019130936IMG-20190529-WA0014.jpg', 'Ditolak'),
(3, 'testtttt', '11160930000008', '123123131231', 'Pusdatin', 'jakarta', 'evan@gmail.com', '30062019131050IMG-20190531-WA0001.jpg', 'Terkonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level_user` enum('kasubag','pendamping') NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level_user`, `nama`) VALUES
(1, 'kasubag', 'kasubag', 'kasubag', 'kasubag'),
(2, 'pendamping1', 'pendamping1', 'pendamping', 'pendamping1'),
(3, 'pendamping2', 'pendamping2', 'pendamping', 'pendamping2'),
(4, 'pendamping3', 'pendamping3', 'pendamping', 'pendamping3'),
(5, 'pendamping4', 'pendamping4', 'pendamping', 'pendamping4'),
(6, 'pendamping5', 'pendamping5', 'pendamping', 'pendamping5'),
(7, 'pendamping6', 'pendamping6', 'pendamping', 'pendamping6'),
(8, 'pendamping7', 'pendamping7', 'pendamping', 'pendamping7'),
(9, 'pendamping8', 'pendamping8', 'pendamping', 'pendamping8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengunjung`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id_kunjungan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_pengunjung` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
