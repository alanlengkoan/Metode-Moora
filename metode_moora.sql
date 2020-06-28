-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Jun 2020 pada 16.05
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metode_moora`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `alternatif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternatif`, `alternatif`) VALUES
(4, 'Naruto'),
(5, 'Tanjiro'),
(6, 'Midoriya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_evaluasi`
--

CREATE TABLE `tb_evaluasi` (
  `id_evaluasi` int(11) NOT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_evaluasi`
--

INSERT INTO `tb_evaluasi` (`id_evaluasi`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(21, 4, 8, 30),
(22, 4, 9, 40),
(23, 4, 10, 20),
(24, 4, 11, 40),
(25, 5, 8, 40),
(26, 5, 9, 20),
(27, 5, 10, 30),
(28, 5, 11, 30),
(29, 6, 8, 40),
(30, 6, 9, 40),
(31, 6, 10, 40),
(32, 6, 11, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `kriteria` varchar(100) NOT NULL,
  `type` set('Benefit','Cost') NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `kode`, `kriteria`, `type`, `bobot`) VALUES
(8, 'K1', 'Power', 'Benefit', 3),
(9, 'K2', 'Damege', 'Benefit', 4),
(10, 'K3', 'Speed', 'Cost', 3),
(11, 'K4', 'Stamina', 'Cost', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_poin`
--

CREATE TABLE `tb_poin` (
  `id_poin` int(11) NOT NULL,
  `kd_poin` varchar(50) NOT NULL,
  `poin` int(11) NOT NULL,
  `kt_poin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_poin`
--

INSERT INTO `tb_poin` (`id_poin`, `kd_poin`, `poin`, `kt_poin`) VALUES
(4, 'SB1', 1, 'Sangat Buruk'),
(5, 'B1', 10, 'Buruk'),
(6, 'C', 20, 'Cukup'),
(7, 'B2', 30, 'Baik'),
(8, 'CB', 40, 'Cukup Baik'),
(9, 'SB2', 50, 'Sangat Baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `token` text,
  `tokenExpire` text,
  `level` enum('admin','users') DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `nama`, `email`, `username`, `password`, `picture`, `token`, `tokenExpire`, `level`, `created`, `modified`) VALUES
(1, 'Alan Saputra Lengkoan', 'benixukerbeck@gmail.com', 'aaaa', '$2y$10$yVrNHMm6CYbRQFNsy2Nwuuk7VAbt/4MwveF4/TzSlmq.5oeOuOSAm', NULL, 'SMVyGX4vuat9fBAgRxJ3Kh6lYQqbCD1E', '1578184269', 'admin', '2020-01-02 13:23:40', '2020-06-09 13:19:44');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `tb_evaluasi`
--
ALTER TABLE `tb_evaluasi`
  ADD PRIMARY KEY (`id_evaluasi`);

--
-- Indeks untuk tabel `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tb_poin`
--
ALTER TABLE `tb_poin`
  ADD PRIMARY KEY (`id_poin`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_evaluasi`
--
ALTER TABLE `tb_evaluasi`
  MODIFY `id_evaluasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_poin`
--
ALTER TABLE `tb_poin`
  MODIFY `id_poin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
