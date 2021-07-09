-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 05:50 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataakuns`
--

CREATE TABLE `dataakuns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_instansi` enum('klinik','puskesmas','rumahsakit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` int(11) NOT NULL,
  `kelurahan` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dataakuns`
--

INSERT INTO `dataakuns` (`id`, `nama_instansi`, `jenis_instansi`, `alamat`, `kecamatan`, `kelurahan`, `email`, `created_at`, `updated_at`) VALUES
(1, 'margadanas', 'puskesmas', 'jl hmhmhmhmhm', 1, 14, 'yau@gmail.com', '2021-07-06 23:11:46', '2021-07-06 23:11:46'),
(2, 'debongs', 'puskesmas', 'jl jscnjc', 3, 16, 'debong@gmail.com', '2021-07-07 02:47:02', '2021-07-07 02:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `datapenyakits`
--

CREATE TABLE `datapenyakits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_penyakit` enum('TBC','Pneunomia','HIV/AIDS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `usia` enum('balita','remaja','dewasa','lansia') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_input` date NOT NULL,
  `kecamatan` int(11) NOT NULL,
  `kelurahan` int(11) NOT NULL,
  `status` enum('Diterima','Ditolak','Belum dikonfirmasi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_instansi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datapenyakits`
--

INSERT INTO `datapenyakits` (`id`, `nama_penyakit`, `usia`, `jenis_kelamin`, `tanggal_input`, `kecamatan`, `kelurahan`, `status`, `id_instansi`, `created_at`, `updated_at`) VALUES
(3, 'HIV/AIDS', 'balita', 'laki-laki', '2021-07-21', 1, 14, 'Belum dikonfirmasi', 2, '2021-07-07 03:37:46', '2021-07-07 03:37:46'),
(4, 'Pneunomia', 'balita', 'laki-laki', '2021-07-30', 2, 19, 'Belum dikonfirmasi', 1, '2021-07-07 03:50:01', '2021-07-07 03:50:01'),
(5, 'HIV/AIDS', 'balita', 'laki-laki', '2021-07-31', 1, 1, 'Diterima', 1, '2021-07-09 16:14:23', '2021-07-09 16:14:43'),
(6, 'Pneunomia', 'dewasa', 'laki-laki', '2021-07-23', 1, 1, 'Diterima', 1, '2021-07-09 16:16:21', '2021-07-09 16:16:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `collor_maps` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `nama`, `lat`, `lng`, `created_at`, `updated_at`, `collor_maps`) VALUES
(1, 'margadana', NULL, NULL, NULL, NULL, '#00FFFF'),
(2, 'tegal timur', NULL, NULL, NULL, NULL, '#7FFFD4'),
(3, 'tegal selatan', NULL, NULL, NULL, NULL, '#7FFF00'),
(4, 'tegal barat', NULL, NULL, NULL, NULL, '#00CED1');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahans`
--

CREATE TABLE `kelurahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `kecamatan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelurahans`
--

INSERT INTO `kelurahans` (`id`, `nama`, `lat`, `lng`, `kecamatan`, `created_at`, `updated_at`) VALUES
(1, 'pesurungan lor', NULL, NULL, 1, NULL, NULL),
(3, 'cabawan', NULL, NULL, 1, NULL, NULL),
(4, 'kaligangsa', NULL, NULL, 1, NULL, NULL),
(5, 'kalinyamat kulon', NULL, NULL, 1, NULL, NULL),
(6, 'krandon', NULL, NULL, 1, NULL, NULL),
(7, 'margadana', NULL, NULL, 1, NULL, NULL),
(8, 'sumurpanggang', NULL, NULL, 1, NULL, NULL),
(9, 'debong lor', NULL, NULL, 4, NULL, NULL),
(10, 'kemandungan', NULL, NULL, 4, NULL, NULL),
(11, 'kraton', NULL, NULL, 4, NULL, NULL),
(12, 'muarareja', NULL, NULL, 4, NULL, NULL),
(13, 'pekauman', NULL, NULL, 4, NULL, NULL),
(14, 'pesurungan kidul', NULL, NULL, 4, NULL, NULL),
(15, 'tegalsari', NULL, NULL, 4, NULL, NULL),
(16, 'bandung', NULL, NULL, 3, NULL, NULL),
(17, 'debong kidul', NULL, NULL, 3, NULL, NULL),
(18, 'debong kulon', NULL, NULL, 3, NULL, NULL),
(19, 'debong tengah', NULL, NULL, 3, NULL, NULL),
(20, 'kalinyamat wetan', NULL, NULL, 3, NULL, NULL),
(21, 'keturen', NULL, NULL, 3, NULL, NULL),
(22, 'randugunting', NULL, NULL, 3, NULL, NULL),
(23, 'tunon', NULL, NULL, 3, NULL, NULL),
(24, 'kejambon', NULL, NULL, 2, NULL, NULL),
(25, 'mangkukusuman', NULL, NULL, 2, NULL, NULL),
(26, 'mintaragen', NULL, NULL, 2, NULL, NULL),
(27, 'panggung', NULL, NULL, 0, NULL, NULL),
(28, 'slerok', NULL, NULL, 0, NULL, NULL),
(29, 'panggung', NULL, NULL, 0, NULL, NULL),
(30, 'slerok', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_16_155414_dataakun', 1),
(5, '2021_06_16_173235_kecamatan', 1),
(6, '2021_06_16_174323_kelurahan', 1),
(7, '2021_06_19_122153_datapenyakit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `rule` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `rule`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'galan', 'galan@gmail.com', NULL, '1', '$2y$10$UCjFqp3t66dxFymDwvCuzOM7YEWQ67wq1pDIcS3.3tt7hXmNp1/5.', NULL, '2021-07-06 23:03:07', '2021-07-06 23:03:07'),
(2, 'margadanas', 'yau@gmail.com', NULL, '2', '$2y$10$6AK5adH3pqNnH5j03xGDpuP5xGG8GIDXhby/xqLF1oKfbKEtnX.Le', NULL, '2021-07-06 23:11:46', '2021-07-06 23:11:46'),
(3, 'debongs', 'debong@gmail.com', NULL, '2', '$2y$10$92PqjVTfbyNRAfRAqrIAmemWOoJOZGpbcbidTm312UMOmwIVMciLu', NULL, '2021-07-07 02:47:02', '2021-07-07 02:47:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataakuns`
--
ALTER TABLE `dataakuns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datapenyakits`
--
ALTER TABLE `datapenyakits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelurahans`
--
ALTER TABLE `kelurahans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataakuns`
--
ALTER TABLE `dataakuns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `datapenyakits`
--
ALTER TABLE `datapenyakits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelurahans`
--
ALTER TABLE `kelurahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
