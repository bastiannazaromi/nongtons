-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2024 at 08:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nongtons`
--

-- --------------------------------------------------------

--
-- Table structure for table `cinema`
--

CREATE TABLE `cinema` (
  `id` int(11) NOT NULL,
  `namaCinema` varchar(30) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cinema`
--

INSERT INTO `cinema` (`id`, `namaCinema`, `createdAt`, `updatedAt`) VALUES
(1, 'Cinema 1', '2024-04-19 02:45:53', NULL),
(3, 'Cinema 2', '2024-04-19 03:12:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `genre` varchar(25) NOT NULL,
  `durasi` int(11) NOT NULL,
  `sinopsis` text NOT NULL,
  `gambar` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `judul`, `genre`, `durasi`, `sinopsis`, `gambar`, `createdAt`, `updatedAt`) VALUES
(1, 'Kung Fu Panda 4', 'Action', 120, 'Po, sang Pendekar Naga telah melalui tiga petualangan menantang maut. Dia mampu mengalahkan penjahat kelas dunia dengan keberaniannya dan juga kemampuan bela diri yang luar biasa.\r\nHingga akhirnya, Pendekar Naga tersebut ditakdirkan untuk pensiun dan menjadi Spiritual Leader di Lembah Perdamaian. Hal tersebut tentu saja menimbulkan berbagai masalah yang berat baginya.\r\nMasalah pertama yakni, Po harus menguasai banyak hal terkait kepemimpinannya sebagai Spiritual Leader. Selain Itu, dia juga harus segera menemukan seorang Dragon Warrior untuk menggantikan posisinya sebagai Pendekar Naga.\r\nMasalah semakin rumit saat penyihir jahat yang dapat berubah wujud muncul. Sosok bernama The Chameleon tersebut sangat serakah dan mempunyai kekuatan untuk memanggil kembali semua penjahat yang telah dikalahkan Po.\r\nOleh karena itu, Po membutuhkan bantuan untuk mengatasi berbagai masalah tersebut. Dalam prosesnya, Po akhirnya berhasil menemukan pahlawan di berbagai tempat yang tak terduga untuk membantunya.', '994b542797c2a0481b8b3e1d1173d0fd.jpg', '2024-10-03 08:00:23', '2024-11-28 05:38:09'),
(6, 'The Last: Naruto the Movie', 'Action', 120, 'Dua tahun setelah peristiwa Perang Besar Shinobi Keempat, bulan Hagoromo Ōtsutsuki yang sudah lama dibuat untuk menyegel Jūbi mulai jatuh ke Bumi. Ancaman bulan yang akan menjadi meteor ini pun akan menghancurkan segala sesuatu yang akan berdampak buruk. Peristiwa ini disebabkan oleh Toneri Ōtsutsuki, keturunan terakhir dari saudara kembar Hagoromo Ōtsutsuki/Rikudou Sennin, yaitu Hamura Ōtsutsuki yang di mana salah satu dari keluarganya tersegel di bulan sejak pembentukannya. Di tengah suasana yang sepi di rumah klan Hyuga, Toneri mencoba untuk menculik adik Hinata Hyuuga, yaitu Hanabi. Naruto dan teman-temannya harus segera menyusun misi penyelamatan sebelum temuan mereka terlibat dalam pertempuran akhir untuk menentukan nasib dari segalanya.', '7f507420fdc20075201b35923062cc9c.jpg', '2024-11-28 01:49:10', '2024-11-28 05:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_tayang`
--

CREATE TABLE `jadwal_tayang` (
  `id` int(11) NOT NULL,
  `idCinema` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jamTayang` time NOT NULL,
  `jumlahKursi` int(11) NOT NULL,
  `kursiTerjual` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_tayang`
--

INSERT INTO `jadwal_tayang` (`id`, `idCinema`, `idFilm`, `tanggal`, `jamTayang`, `jumlahKursi`, `kursiTerjual`, `createdAt`, `updatedAt`) VALUES
(1, 1, 1, '2024-10-03', '15:30:00', 100, 0, '2024-10-03 08:01:02', '2024-10-03 08:04:05'),
(3, 3, 1, '2024-10-03', '19:00:00', 100, 0, '2024-10-03 08:03:31', '2024-10-24 04:24:13'),
(4, 1, 6, '2024-11-28', '15:00:00', 73, 0, '2024-11-28 02:00:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'nongtons-12345678', 1, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idJadwal` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `no_kursi` int(11) NOT NULL,
  `harga` double NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `role` int(1) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `username`, `password`, `tahun`, `no_hp`, `role`, `createdAt`, `updatedAt`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '$2y$10$.pUHewzPqCdcnaOt5sUNf.FU6CTsEo.Rjki7jVeU7Bwb/cu74sN5K', 2024, '', 1, '2024-03-13 07:13:19', '2024-11-28 01:14:11'),
(2, 'Dalban', 'dalban@gmail.com', 'dalban.1', '$2y$10$.pUHewzPqCdcnaOt5sUNf.FU6CTsEo.Rjki7jVeU7Bwb/cu74sN5K', 2024, '', 2, '2024-11-28 07:13:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_tayang`
--
ALTER TABLE `jadwal_tayang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cinema`
--
ALTER TABLE `cinema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jadwal_tayang`
--
ALTER TABLE `jadwal_tayang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
