-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2021 at 08:29 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `egateway_das`
--

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` int(11) NOT NULL,
  `server_ip` varchar(30) NOT NULL,
  `analyzer_ip` varchar(30) NOT NULL,
  `analyzer_port` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `start_addr` int(11) NOT NULL,
  `addr_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `server_ip`, `analyzer_ip`, `analyzer_port`, `unit_id`, `start_addr`, `addr_num`) VALUES
(1, '192.168.121.1', '192.168.31.3', 502, 1, 2000, 51);

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `id` int(10) UNSIGNED NOT NULL,
  `sensor_code` varchar(30) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `formula` varchar(255) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`id`, `sensor_code`, `unit`, `formula`, `xtimestamp`) VALUES
(1, 'NOx', 'ppm', 'round(data[0]/10,2)', '2021-10-08 06:07:02'),
(2, 'SO<sub>2</sub>', 'ppm', 'round(data[1]/10,2)', '2021-10-08 07:52:04'),
(3, 'CO<sub>2</sub>', '%', 'round(data[2]/10,2)', '2021-10-08 07:52:10'),
(4, 'CO', 'ppm', 'round(data[3]/10,2)', '2021-10-08 07:52:17'),
(5, 'O<sub>2</sub>', '%', 'round(data[4]/100,2)', '2021-10-08 07:52:20'),
(6, 'Pressure', 'mBar', 'round(data[5]/1000,3)', '2021-10-08 08:04:37'),
(7, 'Temperature', 'DEGC', 'round(data[6]/10,2)', '2021-10-08 07:52:43'),
(8, 'Flow Speed', 'm/s', 'round(data[21]/100,2)', '2021-10-08 07:53:19'),
(9, 'Opacity 28', '%', 'round(data[7]/10,2)', '2021-10-08 08:03:15'),
(10, 'Dust 28', 'mg/m<sup>3</sup>', 'round(data[8]/100,2)', '2021-10-08 08:03:04'),
(11, 'Opacity 26', '%', 'round(data[9]/10,2)', '2021-10-08 08:03:37'),
(12, 'Dust 26', 'mg/m<sup>3</sup>', 'round(data[50]/100,2)', '2021-10-08 08:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `sensor_values`
--

CREATE TABLE `sensor_values` (
  `id` int(10) UNSIGNED NOT NULL,
  `sensor_id` int(11) NOT NULL DEFAULT 0,
  `data` double NOT NULL DEFAULT 0,
  `xtimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sensor_values`
--

INSERT INTO `sensor_values` (`id`, `sensor_id`, `data`, `xtimestamp`) VALUES
(1, 1, 0, '2021-10-11 06:26:43'),
(2, 2, 0, '2021-10-11 06:26:43'),
(3, 3, 0, '2021-10-11 06:26:43'),
(4, 4, 0, '2021-10-11 06:26:43'),
(5, 5, 0, '2021-10-11 06:26:43'),
(6, 6, 0, '2021-10-11 06:26:43'),
(7, 7, 0, '2021-10-11 06:26:43'),
(8, 8, 0, '2021-10-11 06:26:43'),
(9, 9, 0, '2021-10-11 06:26:43'),
(10, 10, 0, '2021-10-11 06:26:43'),
(11, 11, 0, '2021-10-11 06:26:43'),
(12, 12, 0, '2021-10-11 06:26:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labjack_code` (`sensor_code`);

--
-- Indexes for table `sensor_values`
--
ALTER TABLE `sensor_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labjack_id` (`sensor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sensor_values`
--
ALTER TABLE `sensor_values`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
