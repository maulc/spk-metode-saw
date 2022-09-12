-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Sep 2022 pada 10.39
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metodesaw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(64) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id`, `nama`) VALUES
(2, 'Converse'),
(3, 'Skechers'),
(4, 'Vans');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(64) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`) VALUES
(1, 'Harga Sepatu'),
(3, 'Jenis Sepatu'),
(4, 'Kualitas Sepatu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `id` int(64) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `hargasepatu` int(64) NOT NULL,
  `jenissepatu` varchar(64) NOT NULL,
  `kualitassepatu` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`id`, `nama`, `hargasepatu`, `jenissepatu`, `kualitassepatu`) VALUES
(2, 'Converse', 600, 'Canvas Sneakers', 'Sangat Bagus'),
(3, 'Skechers', 300, 'Slip-on Sneakers', 'Bagus\r\n'),
(4, 'Vans', 450, 'Plimsolls Sneakers', 'Sangat Bagus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id_kriteria` int(64) NOT NULL,
  `1` varchar(255) NOT NULL,
  `2` varchar(255) NOT NULL,
  `3` varchar(255) NOT NULL,
  `4` varchar(255) NOT NULL,
  `5` varchar(255) NOT NULL,
  `atribut` enum('Cost','Benefit') NOT NULL,
  `bobot` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id_kriteria`, `1`, `2`, `3`, `4`, `5`, `atribut`, `bobot`) VALUES
(1, '>100.000 dan < 250.000', '> 250.000 dan < 300.000', '> 300.000 dan < 450.000', '> 450.000 dan < 600.000', '> 600.000', 'Cost', 40),
(3, 'Authentic Sneakers', 'Plimsolls Sneakers', 'Slip-on Sneakers', 'Leather Sneakers', 'Canvas Sneakers', 'Benefit', 20),
(4, '-', 'Bagus', '-', 'Sangat Bagus', '-', 'Benefit', 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_normalisasi`
--

CREATE TABLE `nilai_normalisasi` (
  `id` int(64) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `hargasepatu` int(64) NOT NULL,
  `jenissepatu` int(64) NOT NULL,
  `kualitassepatu` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_normalisasi`
--

INSERT INTO `nilai_normalisasi` (`id`, `nama`, `hargasepatu`, `jenissepatu`, `kualitassepatu`) VALUES
(1, 'Converse', 5, 5, 4),
(2, 'Skechers', 2, 3, 2),
(3, 'Vans', 4, 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `username` int(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `nilai_normalisasi`
--
ALTER TABLE `nilai_normalisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `nilai_normalisasi`
--
ALTER TABLE `nilai_normalisasi`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD CONSTRAINT `nilai_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
