-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Bulan Mei 2021 pada 02.36
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistembonus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buruh`
--

CREATE TABLE `buruh` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `posisi` varchar(128) NOT NULL,
  `bonus` int(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buruh`
--

INSERT INTO `buruh` (`id`, `nama`, `posisi`, `bonus`, `is_active`) VALUES
(1, 'Muh. Adhan', 'Operator Mesin Cutting', 20, 1),
(2, 'Bambang Sugiyono', 'Operator Komputer', 20, 1),
(3, 'Adam Bilal', 'Programmer', 60, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `pembayaran` int(128) NOT NULL,
  `buruhA` int(128) NOT NULL,
  `buruhB` int(128) NOT NULL,
  `buruhC` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data`
--

INSERT INTO `data` (`id`, `pembayaran`, `buruhA`, `buruhB`, `buruhC`) VALUES
(1, 2000000, 25, 25, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(4, 'Regular User', 'member@gmail.com', 'default.jpg', '$2y$10$jL9luH0cSVaD7fzkrCtM4.U4ngoP8BngzmPB9QXQkr3M8xwKHljOC', 2, 1, 1621908782),
(5, 'admin', 'admin@gmail.com', 'default.jpg', '$2y$10$Av5LsWex0cZSarDjNwEpp.auanIhNOLtwrtvRFRdWaeIdxllI8vYG', 1, 1, 1621909505),
(10, 'Darma', 'darma@gmail.com', 'default.jpg', '$2y$10$1Va1hU9W8K.4v9RDtuaDTeRMmcojGqhDVL.N40eakR8R99L8MogFe', 2, 1, 1622166972);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Regular User');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buruh`
--
ALTER TABLE `buruh`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buruh`
--
ALTER TABLE `buruh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
