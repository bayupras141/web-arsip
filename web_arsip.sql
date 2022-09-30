-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Sep 30, 2022 at 09:34 AM
-- Server version: 8.0.30
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_09_29_000258_table_surat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat`
--

CREATE TABLE `tb_surat` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_surat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_pengarsipan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_surat`
--

INSERT INTO `tb_surat` (`id`, `nomor_surat`, `kategori`, `judul`, `waktu_pengarsipan`, `file`, `created_at`, `updated_at`) VALUES
(2, '2022/PD3/TU/012', 'Nota Dinas', 'Nota Dinas WFO', '2022-09-29 08:58:15', 'public/files/Ah11YfjtCuDoMNhFqmszy6EJj0nuAJHJyhFWJdMb.pdf', '2022-09-29 08:58:15', '2022-09-29 08:58:15'),
(3, '2022/P3/TAA/AU01', 'Pemberitahuan', 'Pemberitahuan Keputusan Kelurahan', '2022-09-29 09:34:14', 'public/files/dfkEr0EzAoqy1TqVJ26BqfNTqawIroETG3VieNDI.pdf', '2022-09-29 09:34:14', '2022-09-29 09:34:14'),
(4, '2021/PE3/T01/SK1', 'Pemberitahuan', 'Pemberitahuan Kepada RT RW', '2022-09-29 10:40:48', 'public/files/a8GD9C1CPUlhxMS64tvJUUbHFG9kWpva1vU0k0w0.pdf', '2022-09-29 10:40:48', '2022-09-29 10:40:48'),
(5, '2022/U1/P3', 'Undangan', 'Undangan Kepada RT', '2022-09-29 10:45:44', 'public/files/72NBFjcktONMlZLfvAEjhSs4KIzEoxJZO2vOKyIx.pdf', '2022-09-29 17:45:44', '2022-09-29 17:45:44'),
(6, '2021/PE3/T03/SK2', 'Undangan', 'Undangan Kepada Camat', '2022-09-29 11:52:23', 'public/files/AeyyNagpI88EkJyAiVHDRl0y1c9gcB5p6mWyQU69.pdf', '2022-09-29 18:52:23', '2022-09-29 18:52:23'),
(9, '2022/PD2/MN1/001', 'Pengumuman', 'Pengumuman Acara', '2022-09-29 13:00:06', 'public/files/Ytfu9vmWyX2EozDyvf4SR5bTGBYaGbF3MC8mmSHs.pdf', '2022-09-29 20:00:06', '2022-09-30 16:29:43'),
(16, 'P01/007/WW', 'Pemberitahuan', 'Pengumuman Acara', '2022-09-30 09:30:50', 'public/files/YdoLDjpyy0RNjPZc5992n5dF1x3o8fJTWZmocxXy.pdf', '2022-09-30 16:30:50', '2022-09-30 16:30:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_surat`
--
ALTER TABLE `tb_surat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_surat`
--
ALTER TABLE `tb_surat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
