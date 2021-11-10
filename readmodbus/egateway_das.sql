-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Okt 2021 pada 08.20
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

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
-- Struktur dari tabel `configurations`
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
-- Dumping data untuk tabel `configurations`
--

INSERT INTO `configurations` (`id`, `server_ip`, `analyzer_ip`, `analyzer_port`, `unit_id`, `start_addr`, `addr_num`) VALUES
(1, '192.168.121.1', '192.168.186.126', 502, 1, 0, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sensors`
--

CREATE TABLE `sensors` (
  `id` int(10) UNSIGNED NOT NULL,
  `sensor_code` varchar(30) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `formula` varchar(255) NOT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sensors`
--

INSERT INTO `sensors` (`id`, `sensor_code`, `unit`, `formula`, `xtimestamp`) VALUES
(1, 'NOx', 'ppm', 'round(data[0]/10,2)', '2021-10-08 06:07:02'),
(2, 'SO<sub>2</sub>', 'ppm', 'round(data[2]/10,2)', '2021-10-08 06:07:10'),
(3, 'CO<sub>2</sub>', 'ppm', 'round(data[4]/10,2)', '2021-10-08 06:07:30'),
(4, 'CO', 'ppm', 'round(data[6]/10,2)', '2021-10-08 06:07:36'),
(5, 'O<sub>2</sub>', 'ppm', 'round(data[8]/100,2)', '2021-10-08 06:07:42'),
(6, 'Pressure', 'mBar', 'round(data[10]/1000,2)', '2021-10-08 06:07:49'),
(7, 'Temperature', 'DEGC', 'round(data[12]/10,2)', '2021-10-08 06:07:56'),
(8, 'Flow Speed', 'm/s', 'round(data[14]/10,2)', '2021-10-08 06:08:02'),
(9, 'Dust 28', '', 'round(data[16]/100,2)', '2021-10-08 06:08:06'),
(10, 'Opacity 26', '%', 'round(data[18]/10,2)', '2021-10-08 06:08:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sensor_values`
--

CREATE TABLE `sensor_values` (
  `id` int(10) UNSIGNED NOT NULL,
  `sensor_id` int(11) NOT NULL DEFAULT 0,
  `data` double NOT NULL DEFAULT 0,
  `xtimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sensor_values`
--

INSERT INTO `sensor_values` (`id`, `sensor_id`, `data`, `xtimestamp`) VALUES
(1, 1, 1195.7, '2021-10-08 06:20:08'),
(2, 2, 3968.4, '2021-10-08 06:20:08'),
(3, 3, 341.6, '2021-10-08 06:20:08'),
(4, 4, 1680.4, '2021-10-08 06:20:08'),
(5, 5, 149.94, '2021-10-08 06:20:08'),
(6, 6, 2.17, '2021-10-08 06:20:08'),
(7, 7, 2197, '2021-10-08 06:20:08'),
(8, 8, 3649.7, '2021-10-08 06:20:08'),
(9, 9, 247.02, '2021-10-08 06:20:08'),
(10, 10, 6408.5, '2021-10-08 06:20:08');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labjack_code` (`sensor_code`);

--
-- Indeks untuk tabel `sensor_values`
--
ALTER TABLE `sensor_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labjack_id` (`sensor_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `sensor_values`
--
ALTER TABLE `sensor_values`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
