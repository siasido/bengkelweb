-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2021 at 10:10 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `montir`
--

CREATE TABLE `montir` (
  `idmontir` int(11) NOT NULL,
  `namamontir` varchar(40) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `montir`
--

INSERT INTO `montir` (`idmontir`, `namamontir`, `nohp`, `is_deleted`) VALUES
(1, 'Galihzz', '08123123112', 0),
(2, 'jajang', '09876786722', 1);

-- --------------------------------------------------------

--
-- Table structure for table `montirorders`
--

CREATE TABLE `montirorders` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamatlengkap` text NOT NULL,
  `orderdate` datetime NOT NULL,
  `idmerk` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `kendala` text NOT NULL,
  `idrekening` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `resi` varchar(30) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `idmontir` int(1) NOT NULL,
  `notes` text DEFAULT NULL,
  `statusbayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `montirorders`
--

INSERT INTO `montirorders` (`id`, `userid`, `nama`, `nohp`, `alamatlengkap`, `orderdate`, `idmerk`, `type`, `kendala`, `idrekening`, `status`, `resi`, `created_at`, `idmontir`, `notes`, `statusbayar`) VALUES
(1, 2, '', '', 'zz', '2021-07-22 17:00:00', 3, 'Scoopy', 'zz', 1, '3', 'resi-120210722131044.jpg', '2021-07-22 13:09:43', 1, 'zzz', 2);

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `id` int(11) NOT NULL,
  `merk` varchar(40) NOT NULL,
  `keterangan` text NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`id`, `merk`, `keterangan`, `is_deleted`) VALUES
(1, 'Yamaha', 'tetszz', 0),
(2, 'Honda', 'zzz', 1),
(3, 'Honda', '', 0),
(4, 'Kawasaki', '', 0),
(5, 'Vespa', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id` int(11) NOT NULL,
  `norek` varchar(20) NOT NULL,
  `namabank` varchar(50) NOT NULL,
  `namaakun` varchar(40) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id`, `norek`, `namabank`, `namaakun`, `is_deleted`) VALUES
(1, '054567', 'BNI', 'Surya Mandiri Motor', 0),
(2, '067856', 'BCA', 'Surya Mandiri Motor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `serviceorders`
--

CREATE TABLE `serviceorders` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `idmerk` int(40) NOT NULL,
  `type` varchar(50) NOT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `kendala` text NOT NULL,
  `idrekening` int(11) NOT NULL,
  `orderdate` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(1) DEFAULT NULL,
  `resi` varchar(30) DEFAULT NULL,
  `statusbayar` int(1) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `serviceorders`
--

INSERT INTO `serviceorders` (`id`, `userid`, `nama`, `idmerk`, `type`, `nohp`, `kendala`, `idrekening`, `orderdate`, `created_at`, `status`, `resi`, `statusbayar`, `notes`) VALUES
(2, 2, NULL, 3, 'zz', NULL, 'zz', 1, '2021-07-30 10:00:00', '2021-07-22 14:16:22', 2, 'resi-220210722145830.jpg', 2, 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `image` varchar(40) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `fullname`, `nohp`, `password`, `image`, `level`) VALUES
(1, 'admin', 'admin 21', '0812123411234', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user-20210624081614.jpg', 1),
(2, 'john', 'johnny cash z', '0987653456788', 'a51dda7c7ff50b61eaea0444371f4a6a9301e501', 'user-20210623063035.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `montir`
--
ALTER TABLE `montir`
  ADD PRIMARY KEY (`idmontir`);

--
-- Indexes for table `montirorders`
--
ALTER TABLE `montirorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_montirs_merk` (`idmerk`),
  ADD KEY `fk_montirs_users` (`userid`),
  ADD KEY `fk_montirs_rekening` (`idrekening`);

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceorders`
--
ALTER TABLE `serviceorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_service_merk` (`idmerk`),
  ADD KEY `fk_service_rekening` (`idrekening`),
  ADD KEY `fk_service_users` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `montir`
--
ALTER TABLE `montir`
  MODIFY `idmontir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `montirorders`
--
ALTER TABLE `montirorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `motor`
--
ALTER TABLE `motor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `serviceorders`
--
ALTER TABLE `serviceorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `montirorders`
--
ALTER TABLE `montirorders`
  ADD CONSTRAINT `fk_montirs_merk` FOREIGN KEY (`idmerk`) REFERENCES `motor` (`id`),
  ADD CONSTRAINT `fk_montirs_rekening` FOREIGN KEY (`idrekening`) REFERENCES `rekening` (`id`),
  ADD CONSTRAINT `fk_montirs_users` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `serviceorders`
--
ALTER TABLE `serviceorders`
  ADD CONSTRAINT `fk_service_merk` FOREIGN KEY (`idmerk`) REFERENCES `motor` (`id`),
  ADD CONSTRAINT `fk_service_rekening` FOREIGN KEY (`idrekening`) REFERENCES `rekening` (`id`),
  ADD CONSTRAINT `fk_service_users` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
