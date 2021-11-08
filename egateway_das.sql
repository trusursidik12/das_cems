-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 02 Okt 2021 pada 06.08
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

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
-- Struktur dari tabel `sensors`
--

CREATE TABLE `sensors` (
  `id` int(10) UNSIGNED NOT NULL,
  `sensor_code` varchar(30) NOT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sensors`
--

INSERT INTO `sensors` (`id`, `sensor_code`, `unit`, `xtimestamp`) VALUES
(1, 'SO2', 'm/g', '2021-10-02 01:23:35'),
(2, 'NOx', 'm/g', '2021-10-02 01:23:41'),
(3, 'CO', 'm/g', '2021-10-02 05:44:29'),
(4, 'O2', 'm/g', '2021-10-02 05:44:33'),
(5, 'O3', 'm/g', '2021-10-02 05:44:38'),
(6, 'XXX', 'm/g', '2021-10-02 05:44:51'),
(7, 'YYY', 'm/g', '2021-10-02 05:44:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sensor_values`
--

CREATE TABLE `sensor_values` (
  `id` int(10) UNSIGNED NOT NULL,
  `sensor_id` int(11) NOT NULL DEFAULT '0',
  `data` double NOT NULL DEFAULT '0',
  `xtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `sensor_values`
--

INSERT INTO `sensor_values` (`id`, `sensor_id`, `data`, `xtimestamp`) VALUES
(1, 1, 291, '2021-10-02 06:08:35'),
(2, 2, 230, '2021-10-02 06:08:35'),
(3, 3, 134, '2021-10-02 06:08:35'),
(4, 4, 134, '2021-10-02 06:08:35'),
(5, 5, 203, '2021-10-02 06:08:35'),
(6, 6, 55, '2021-10-02 06:08:35'),
(7, 7, 39, '2021-10-02 06:08:35');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT untuk tabel `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `sensor_values`
--
ALTER TABLE `sensor_values`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
