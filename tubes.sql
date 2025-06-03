-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2023 at 03:07 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `gambar` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama` char(200) DEFAULT NULL,
  `brand` char(200) DEFAULT NULL,
  `harga` decimal(10,3) DEFAULT NULL,
  `detail` char(200) DEFAULT NULL,
  `kategori` varchar(200) DEFAULT NULL,
  `kategori_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `gambar`, `nama`, `brand`, `harga`, `detail`, `kategori`, `kategori_id`) VALUES
(30, '648514f9326eb.png', 'Harajuku WomensWear 1', 'HarajukuHues', 1000000.000, 'authentic for girl', 'wanita', 22),
(31, '648515205762f.jpg', 'Harajuku WomensWear 2', 'HarajukuHues', 1000000.000, 'authentic for girl', 'wanita', 22),
(32, '648515506ff30.jpg', 'Harajuku WomensWear 3', 'HarajukuHues', 1500000.000, 'authentic for girl', 'wanita', 22),
(33, '648516976ec9a.jpg', 'Harajuku mensWear 1', 'HarajukuHues', 1000000.000, 'cool men', 'pria', 23),
(34, '648516c4a323c.png', 'Harajuku mensWear 2', 'HarajukuHues', 1500000.000, 'cool men styling', 'pria', 23),
(35, '6485e206ce241.jpg', 'Harajuku mensWear 3', 'HarajukuHues', 100.000, 'cool men', 'pria', 23),
(36, '6485e24ea30ff.webp', 'Harajuku BottomsWear', 'HarajukuHues', 1000.000, 'Pants Harajukuhues', 'celana', 24),
(37, '6485e294887ff.png', 'Harajuku Upper Wear', 'HarajukuHues', 300.000, 'upperwears by harajukuhues', 'baju', 25),
(38, '6485e2dec49b7.png', 'Harajuku accessories', 'HarajukuHues', 100.000, 'accessories by harajukuhues', 'aksesoris', 26);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(22, 'wanita'),
(23, 'pria'),
(24, 'celana'),
(25, 'baju'),
(26, 'aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `jumlah` int NOT NULL,
  `lunas` tinyint(1) DEFAULT '0',
  `total_harga` int DEFAULT NULL,
  `harga` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `user_id`, `item_id`, `kategori_id`, `jumlah`, `lunas`, `total_harga`, `harga`) VALUES
(61, 22, 30, 22, 1, 0, NULL, 1000000.000),
(62, 22, 34, 23, 4, 0, NULL, 1500000.000);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `total_harga` decimal(10,3) DEFAULT NULL,
  `tanggal_pembayaran` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_pembayaran` decimal(10,3) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `nomor_rekening` varchar(50) DEFAULT NULL,
  `nama_pembeli` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `user_id`, `total_harga`, `tanggal_pembayaran`, `total_pembayaran`, `metode_pembayaran`, `nomor_rekening`, `nama_pembeli`) VALUES
(33, 18, 12222.000, '2023-05-28 09:22:08', 12222.000, NULL, NULL, NULL),
(34, 18, 100000.000, '2023-05-28 09:23:53', 100000.000, NULL, NULL, NULL),
(35, 18, 100000.000, '2023-05-28 09:26:42', 100000.000, NULL, NULL, NULL),
(36, 15, 0.000, '2023-05-29 09:40:56', 0.000, NULL, NULL, NULL),
(37, 15, 0.000, '2023-05-29 09:41:07', 0.000, NULL, NULL, NULL),
(38, 15, 0.000, '2023-05-29 09:41:39', 0.000, NULL, NULL, NULL),
(39, 15, 0.000, '2023-05-29 09:41:53', 0.000, NULL, NULL, NULL),
(40, 15, 0.000, '2023-05-29 09:42:49', 0.000, NULL, NULL, NULL),
(41, 19, 100000.000, '2023-05-29 09:43:23', 100000.000, NULL, NULL, NULL),
(42, 20, 100000.000, '2023-05-29 11:31:55', 100000.000, NULL, NULL, NULL),
(43, 20, 100000.000, '2023-05-29 11:36:09', 100000.000, NULL, NULL, NULL),
(44, 20, 0.000, '2023-05-29 11:38:17', 0.000, NULL, NULL, NULL),
(45, 20, 0.000, '2023-05-29 11:38:28', 0.000, NULL, NULL, NULL),
(46, 20, 0.000, '2023-05-29 03:18:32', 0.000, NULL, NULL, NULL),
(47, 20, 0.000, '2023-05-29 03:42:07', 0.000, NULL, NULL, NULL),
(48, 20, 100000.000, '2023-05-29 03:46:25', 100000.000, NULL, NULL, NULL),
(49, 15, 0.000, '2023-05-29 10:48:46', 0.000, NULL, NULL, NULL),
(50, 15, 100000.000, '2023-05-30 01:10:42', 100000.000, NULL, NULL, NULL),
(51, 15, 0.000, '2023-05-30 01:11:13', 0.000, NULL, NULL, NULL),
(52, 4, 10.000, '2023-05-30 01:12:18', 10.000, NULL, NULL, NULL),
(53, 15, 0.000, '2023-05-31 12:04:53', 0.000, NULL, NULL, NULL),
(54, 15, 100000.000, '2023-05-31 12:05:56', 100000.000, NULL, NULL, NULL),
(55, 15, 12222.000, '2023-06-01 07:43:24', 12222.000, NULL, NULL, NULL),
(56, 15, 112222.000, '2023-06-01 07:44:06', 112222.000, NULL, NULL, NULL),
(57, 22, 0.000, '2023-06-01 11:45:46', 0.000, NULL, NULL, NULL),
(58, 22, 0.000, '2023-06-01 11:47:52', 0.000, NULL, NULL, NULL),
(59, 22, 100000.000, '2023-06-02 12:27:11', 100000.000, NULL, NULL, NULL),
(60, 22, 10.000, '2023-06-02 12:27:25', 10.000, NULL, NULL, NULL),
(61, 22, 10.000, '2023-06-02 12:31:59', 10.000, NULL, NULL, NULL),
(62, 22, 10.000, '2023-06-02 12:36:19', 10.000, 'Rekening', '766601014121534', 'Lisvindanu'),
(63, 22, 10.000, '2023-06-02 12:37:58', 10.000, 'transfer_bank', '766601014121534', 'Lisvindanu'),
(64, 22, 200000.000, '2023-06-04 05:52:17', 200000.000, 'transfer_bank', '', ''),
(65, 22, 3000000.000, '2023-06-11 02:35:46', 3000000.000, 'transfer_bank', '76887', 'hgf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(3, 'hedi', '$2y$10$08ks9y7rEgDbbOyUqRto7.AIm7emEQwwCkafpY01H7uj0PSscnQpa', 'user'),
(4, 'lisvindanu', '$2y$10$8ZitzIvizTzKyRskappOR.1yQwdpOoLwQfquHt83bXtWdnc6zLi0m', 'admin'),
(5, 'doni', '$2y$10$eeXFCqyX1JDe2yZQpN3.w.2rc82QzHhpnrD0wZPIS.ik0xvu.TnT.', 'user'),
(6, 'dragnell', '$2y$10$q3qEllbtE844oH1bBc1.jOH46sl6m/QV/BQE2XjLzjfseEei9QjVq', 'user'),
(7, 'pakih', '$2y$10$eKoz9KgrSLB6TXrTPXFWiOXdEQoKQtyJaucEF4W3XpSjf7wNm4MEu', 'user'),
(8, 'unad', '$2y$10$Y2hGsTCAud0eR5ZIfvMrueSaRTzDyVmVDoD5RMRpj2O52sHD0Nzpy', 'user'),
(10, 'unaddgacor', '$2y$10$oqFScCIRcGliUNGGR9ayeuLoEtK.oRKmXOqud9vmVDEz4lqxVkiP6', 'user'),
(11, 'unaddgacor1', '$2y$10$KvTExxJ0dgojS0INMb8r2OcMP0.Etf1O2uax7DJJcQVqabI2.6cfi', 'user'),
(13, 'und1', '$2y$10$yIRV7gOOCynjqcIGe9iW7.p63zH3yzZfD3WUyVa//i6SPtnxTnW.i', 'user'),
(14, 'unad12', '$2y$10$xKCC/MPubtJQiVHqzij1POh.KNhATjXzgR/5jfEY75ssznZDqyOke', 'admin'),
(15, 'a', '$2y$10$/IpzhG/4ksKt.d6YGdwiW.Bh2TsrgsjvdEQdODzZ9QR/8lgTzKfiC', 'user'),
(16, 'as', '$2y$10$HFDQePCm5wmY4eljJmCIX.8XznpRVoQQvIsAgphucnzLHlZJkluWq', 'user'),
(17, 's', '$2y$10$dM9Dtl1O/naeoy6PhOBIXuzXLG7DWHqbvgSlcXKzLTgrRFlVSzCea', 'user'),
(18, 'pp', '$2y$10$V/qR/9Fn9yOFq0QDsCRw2OmpvZ130RvPZqXhd7BSMXJzkhxVpRIZC', 'user'),
(19, 't', '$2y$10$bRH97mFQUS91kjxcQbzK2e0oLQ/FgoOCTNaja2Vv2.Br3zvfueHFW', 'user'),
(20, 'ahmad', '$2y$10$1dclEpbrigQgZsGFnVNuN.S9Qgx87ee5bDFV1KAouQWBPHjccokha', 'user'),
(21, 'aa', '$2y$10$jXMAXkShOpA9pozKDtal1OJam46lkNIrlWJt1el8wHFX6gcJ/gq4a', 'user'),
(22, 'qq', '$2y$10$eewXjIi2doWd/vV3eNJxK.brqSgnHZ3TMj8puXonKjtMYBhCaDwNy', 'user'),
(24, 'qqqq', '$2y$10$Hz0e8kGtr.6mx3yw/Y4V6.514/D3VhAGI7BO6Q1D5gnRciNQbigYu', 'user'),
(25, 'w', '$2y$10$HfhzhMRu/HpkwSFRi8W3tuAel0p5egr7WQoGYdEE67EDa5eRpwFTS', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembayaran_users` (`user_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `keranjang_ibfk_3` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `FK_pembayaran_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
