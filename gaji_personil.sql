-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Jan 2024 pada 15.35
-- Versi Server: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gaji_personil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi_per_periode`
--

CREATE TABLE IF NOT EXISTS `divisi_per_periode` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(250) NOT NULL,
  `periode` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `divisi_per_periode`
--

INSERT INTO `divisi_per_periode` (`id_divisi`, `nama_divisi`, `periode`) VALUES
(1, 'A', '2024-01-01'),
(2, 'B', '2024-01-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hitung_gaji`
--

CREATE TABLE IF NOT EXISTS `hitung_gaji` (
  `id_personil` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `jumlah_jam` int(2) NOT NULL,
  `jumlah_hari` int(2) NOT NULL,
  `insentif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hitung_gaji`
--

INSERT INTO `hitung_gaji` (`id_personil`, `id_divisi`, `jumlah_jam`, `jumlah_hari`, `insentif`) VALUES
(1, 1, 5, 0, 0),
(2, 1, 8, 0, 0),
(1, 2, 0, 5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_divisi`
--

CREATE TABLE IF NOT EXISTS `master_divisi` (
`id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(250) NOT NULL,
  `rumus_gaji` varchar(250) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `master_divisi`
--

INSERT INTO `master_divisi` (`id_divisi`, `nama_divisi`, `rumus_gaji`) VALUES
(1, 'A', '$jumlah_jam'),
(2, 'B', '$jumlah_hari*$insentif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_personil`
--

CREATE TABLE IF NOT EXISTS `master_personil` (
`id_personil` int(11) NOT NULL,
  `nama` varchar(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `master_personil`
--

INSERT INTO `master_personil` (`id_personil`, `nama`) VALUES
(1, 'Personil 1'),
(2, 'Personil 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penempatan_personil`
--

CREATE TABLE IF NOT EXISTS `penempatan_personil` (
`id_penempatan` int(11) NOT NULL,
  `id_personil` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `penempatan_personil`
--

INSERT INTO `penempatan_personil` (`id_penempatan`, `id_personil`, `id_divisi`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekapitulasi_gaji`
--

CREATE TABLE IF NOT EXISTS `rekapitulasi_gaji` (
`id_rekap` int(11) NOT NULL,
  `id_personil` int(11) DEFAULT NULL COMMENT 'dieroleh dari referensi master personil',
  `id_divisi` int(11) DEFAULT NULL COMMENT 'diperoleh dari referensi master_divisi',
  `rumus_gaji` varchar(250) DEFAULT NULL,
  `total_gaji` decimal(50,2) DEFAULT NULL,
  `periode` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `rekapitulasi_gaji`
--

INSERT INTO `rekapitulasi_gaji` (`id_rekap`, `id_personil`, `id_divisi`, `rumus_gaji`, `total_gaji`, `periode`) VALUES
(1, 1, 1, '$jumlah_jam', '5.00', '2024-01-01'),
(2, 2, 1, '$jumlah_jam', '8.00', '2024-01-01'),
(3, 1, 2, '$jumlah_hari*$insentif', '10.00', '2024-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_divisi`
--
ALTER TABLE `master_divisi`
 ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `master_personil`
--
ALTER TABLE `master_personil`
 ADD PRIMARY KEY (`id_personil`);

--
-- Indexes for table `penempatan_personil`
--
ALTER TABLE `penempatan_personil`
 ADD PRIMARY KEY (`id_penempatan`);

--
-- Indexes for table `rekapitulasi_gaji`
--
ALTER TABLE `rekapitulasi_gaji`
 ADD PRIMARY KEY (`id_rekap`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_divisi`
--
ALTER TABLE `master_divisi`
MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `master_personil`
--
ALTER TABLE `master_personil`
MODIFY `id_personil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `penempatan_personil`
--
ALTER TABLE `penempatan_personil`
MODIFY `id_penempatan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rekapitulasi_gaji`
--
ALTER TABLE `rekapitulasi_gaji`
MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
