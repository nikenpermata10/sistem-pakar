-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2024 pada 14.45
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pakar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_aturan`
--

CREATE TABLE `tb_aturan` (
  `ID` int(11) NOT NULL,
  `kode_penyakit` varchar(16) DEFAULT NULL,
  `kode_gejala` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_aturan`
--

INSERT INTO `tb_aturan` (`ID`, `kode_penyakit`, `kode_gejala`, `nilai`) VALUES
(1, 'P01', 'G01', 0.75),
(54, 'P01', 'G04', 0.71),
(55, 'P02', 'G02', 0.88),
(56, 'P02', 'G03', 0.75),
(57, 'P02', 'G06', 0.13),
(58, 'P01', 'G05', 0.88),
(77, 'P01', 'G02', 0.88),
(78, 'P01', 'G03', 0.63),
(79, 'P01', 'G06', 0.38),
(80, 'P01', 'G07', 0.38),
(81, 'P01', 'G08', 0.25),
(82, 'P01', 'G09', 0.13),
(83, 'P02', 'G01', 0.63),
(84, 'P02', 'G08', 0.75),
(85, 'P02', 'G09', 0.5),
(86, 'P02', 'G10', 0.63),
(87, 'P02', 'G11', 0.13),
(88, 'P02', 'G12', 0.5),
(89, 'P03', 'G01', 0.71),
(90, 'P03', 'G02', 0.71),
(91, 'P03', 'G06', 0.43),
(92, 'P03', 'G10', 0.29),
(93, 'P03', 'G11', 0.43),
(94, 'P03', 'G12', 0.43),
(95, 'P03', 'G13', 0.71),
(96, 'P03', 'G14', 0.57),
(97, 'P03', 'G15', 0.71),
(98, 'P03', 'G16', 0.57),
(99, 'P03', 'G17', 0.71),
(100, 'P04', 'G02', 0.71),
(101, 'P04', 'G03', 0.43),
(102, 'P04', 'G18', 0.86),
(103, 'P04', 'G19', 0.86),
(104, 'P04', 'G20', 0.86),
(105, 'P04', 'G21', 0.57),
(106, 'P04', 'G22', 0.71);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_diagnosis`
--

CREATE TABLE `tb_diagnosis` (
  `id_diagnosis` int(11) NOT NULL,
  `nama` text NOT NULL,
  `umur` text NOT NULL,
  `alamat` text NOT NULL,
  `jeniskelamin` text NOT NULL,
  `gejala` text NOT NULL,
  `selected_gejala` text NOT NULL,
  `hasil_diagnosis` text NOT NULL,
  `persentase` text NOT NULL,
  `keterangan` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_diagnosis`
--

INSERT INTO `tb_diagnosis` (`id_diagnosis`, `nama`, `umur`, `alamat`, `jeniskelamin`, `gejala`, `selected_gejala`, `hasil_diagnosis`, `persentase`, `keterangan`, `waktu`) VALUES
(5, 'muti', '23', 'dsa', '', 'Pendarahan, Keputihan', 'G02, G03', 'Kanker Serviks', '82.53', '• Pembedahan.\r\n• Pada kanker serviks stadium 1, pembedahan pada umumnya dilakukan dengan mengangkat serviks dan rahim (histerektomi).\r\n• Kemoradiasi.\r\n• Kemoradiasi lebih ditunjukan untuk kanker serviks stadium 1B.', '2024-07-02 19:33:32'),
(6, 'ani', '25', 'jakarta', '', 'Penurunan berat badan, Nafsu makan menurun', 'G06, G07', 'Kanker Ovarium', '43', '• Tes darah, bertujuan untuk mendeteksi protein CA-125, yang merupakan penanda adanya kanker.\r\n• Pemindaian, metode awal yang dilakukan untuk mendeteksi kanker ovarium adalah USG perut.\r\n• Biopsi, pada pemeriksaan ini dokter akan mengambil sampel jaringan ovarium untuk diteliti di laboratorium', '2024-07-02 19:41:56'),
(7, 'putri', '25', 'jakarta', '', 'Anemia, Nyeri saat berhubungan seksual', 'G05, G10', 'Kanker Rahim (Uterus)', '88', '•Biopsi: Prosedur pengambilan sampel jaringan rahim untuk diteliti menggunakan mikroskop pada laboratorium.\r\n•Pemeriksaan darah: Prosedur pengambilan sampel darah untuk menganalisis kadar protein CA-125 yang menjadi salah satu\r\nindikator kemungkinan adanya kanker uterus/rahim.\r\n• Histeroskopi: prosedur pemeriksaan kondisi rahim dengan memasukkan histereskop (selang kecil dan elestis yang dilengkapi kamera) melalui vagina.', '2024-07-02 19:43:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `kode_gejala` varchar(16) NOT NULL,
  `nama_gejala` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_gejala`
--

INSERT INTO `tb_gejala` (`kode_gejala`, `nama_gejala`) VALUES
('G01', 'Nyeri Perut'),
('G02', 'Pendarahan'),
('G03', 'Keputihan'),
('G04', 'Lemas'),
('G05', 'Anemia'),
('G06', 'Penurunan berat badan'),
('G07', 'Nafsu makan menurun'),
('G08', 'Nyeri Panggul'),
('G09', 'Haid tidak teratur'),
('G10', 'Nyeri saat berhubungan seksual'),
('G11', 'Sering buang air kecil'),
('G12', 'Sakit di punggung bagian bawah'),
('G13', 'Perut kembung'),
('G14', 'Cepat kenyang'),
('G15', 'Mual'),
('G16', 'Konstipasi (sembelit)'),
('G17', 'Perut membengkak'),
('G18', 'Nyeri'),
('G19', 'Gatal pada daerah vulva'),
('G20', 'Benjolan seperti kutil kecil'),
('G21', 'Luka seperti borok daerah vulva'),
('G22', 'Luka pada daerah vulva');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `usia` varchar(10) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penyakit`
--

CREATE TABLE `tb_penyakit` (
  `kode_penyakit` varchar(16) NOT NULL,
  `nama_penyakit` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_penyakit`
--

INSERT INTO `tb_penyakit` (`kode_penyakit`, `nama_penyakit`, `keterangan`) VALUES
('P01', 'Kanker Rahim (Uterus)', '•Biopsi: Prosedur pengambilan sampel jaringan rahim untuk diteliti menggunakan mikroskop pada laboratorium.\r\n•Pemeriksaan darah: Prosedur pengambilan sampel darah untuk menganalisis kadar protein CA-125 yang menjadi salah satu\r\nindikator kemungkinan adanya kanker uterus/rahim.\r\n• Histeroskopi: prosedur pemeriksaan kondisi rahim dengan memasukkan histereskop (selang kecil dan elestis yang dilengkapi kamera) melalui vagina.'),
('P02', 'Kanker Serviks', '• Pembedahan.\r\n• Pada kanker serviks stadium 1, pembedahan pada umumnya dilakukan dengan mengangkat serviks dan rahim (histerektomi).\r\n• Kemoradiasi.\r\n• Kemoradiasi lebih ditunjukan untuk kanker serviks stadium 1B.'),
('P03', 'Kanker Ovarium', '• Tes darah, bertujuan untuk mendeteksi protein CA-125, yang merupakan penanda adanya kanker.\r\n• Pemindaian, metode awal yang dilakukan untuk mendeteksi kanker ovarium adalah USG perut.\r\n• Biopsi, pada pemeriksaan ini dokter akan mengambil sampel jaringan ovarium untuk diteliti di laboratorium'),
('P04', 'Kanker Vulva', '• Biopsi, Sebagian kecil jaringan vulva akan diambil sampel jaringan untuk diperiksa dibawah mikroskop apakah terdapat tanda-tanda dari sel kanker.\r\n• Pemeriksaan pencitraan, digunakan untuk mencari apakah kanker telah menyebar ke jaringan sekitar punggul atau ketempat yang jauh.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`user`);

--
-- Indeks untuk tabel `tb_aturan`
--
ALTER TABLE `tb_aturan`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `tb_diagnosis`
--
ALTER TABLE `tb_diagnosis`
  ADD PRIMARY KEY (`id_diagnosis`);

--
-- Indeks untuk tabel `tb_gejala`
--
ALTER TABLE `tb_gejala`
  ADD PRIMARY KEY (`kode_gejala`);

--
-- Indeks untuk tabel `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_penyakit`
--
ALTER TABLE `tb_penyakit`
  ADD PRIMARY KEY (`kode_penyakit`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_aturan`
--
ALTER TABLE `tb_aturan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `tb_diagnosis`
--
ALTER TABLE `tb_diagnosis`
  MODIFY `id_diagnosis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
