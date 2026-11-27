-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2026 at 07:33 AM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auth-simple`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mata_kuliah_id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruangan` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `mata_kuliah_id`, `hari`, `jam_mulai`, `jam_selesai`, `ruangan`, `created_at`, `updated_at`) VALUES
(5, 3, 'Senin', '08:30:00', '10:30:00', 'TRMK 1', '2026-11-26 21:58:29', '2026-11-26 21:58:29'),
(6, 4, 'Selasa', '08:30:00', '10:30:00', 'TRMK 1', '2026-11-26 21:58:50', '2026-11-26 21:58:50'),
(7, 5, 'Rabu', '08:30:00', '10:30:00', 'TRMK 1', '2026-11-26 21:59:13', '2026-11-26 21:59:13'),
(8, 6, 'Kamis', '08:30:00', '10:30:00', 'TRMK 1', '2026-11-26 23:08:43', '2026-11-26 23:08:43'),
(9, 7, 'Jumat', '08:30:00', '10:30:00', 'TRMK 1', '2026-11-26 23:08:57', '2026-11-26 23:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `mata_kuliah_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id`, `mahasiswa_id`, `mata_kuliah_id`, `created_at`, `updated_at`) VALUES
(8, 5, 6, '2026-11-26 23:13:34', '2026-11-26 23:13:34'),
(9, 6, 6, '2026-11-26 23:13:34', '2026-11-26 23:13:34'),
(10, 7, 6, '2026-11-26 23:13:34', '2026-11-26 23:13:34'),
(11, 8, 6, '2026-11-26 23:13:34', '2026-11-26 23:13:34'),
(12, 9, 6, '2026-11-26 23:13:34', '2026-11-26 23:13:34'),
(13, 10, 6, '2026-11-26 23:13:34', '2026-11-26 23:13:34'),
(14, 11, 6, '2026-11-26 23:13:34', '2026-11-26 23:13:34'),
(15, 12, 6, '2026-11-26 23:13:34', '2026-11-26 23:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `sks` tinyint(3) UNSIGNED NOT NULL,
  `semester` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `kode`, `nama`, `sks`, `semester`, `dosen_id`, `created_at`, `updated_at`) VALUES
(3, 'TPr1', 'Pemograman 1', 2, 1, 1, '2026-11-26 21:52:25', '2026-11-26 21:52:25'),
(4, 'TP1', 'Teknik Pengukuran', 2, 1, 1, '2026-11-26 21:53:01', '2026-11-26 21:53:01'),
(5, 'TM1', 'Teknik Manufaktur', 2, 1, 1, '2026-11-26 21:53:34', '2026-11-26 21:53:34'),
(6, 'BSI1', 'Bahasa Inggris 1', 2, 1, 1, '2026-11-26 21:53:48', '2026-11-26 21:53:48'),
(7, 'MT1', 'Matematika Teknik 1', 2, 1, 1, '2026-11-26 21:53:59', '2026-11-26 21:53:59'),
(8, 'EM1', 'Elemen Mesin 1', 2, 2, 1, '2026-11-26 21:54:20', '2026-11-26 21:54:20'),
(9, 'FD1', 'Fisika Dasar 1', 2, 2, 1, '2026-11-26 21:54:34', '2026-11-26 21:54:34'),
(10, 'IB1', 'Ilmu Bahan 1', 2, 2, 1, '2026-11-26 21:54:50', '2026-11-26 21:54:50'),
(11, 'MTT1', 'Mekanika Teknik 1', 2, 2, 1, '2026-11-26 21:55:45', '2026-11-26 21:55:45'),
(12, 'RL1', 'Rangkaian Listrik 1', 2, 2, 1, '2026-11-26 21:56:01', '2026-11-26 21:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '0001_01_01_000000_create_users_table', 1),
(8, '0001_01_01_000001_create_cache_table', 1),
(9, '0001_01_01_000002_create_jobs_table', 1),
(10, '2026_11_26_155617_add_role_ipk_to_users_table', 1),
(11, '2026_11_26_155627_create_siakad_tables', 1),
(12, '2026_11_27_023355_add_semester_to_nilai_table', 2),
(13, '2026_11_27_023413_create_tagihans_table', 2),
(14, '2026_11_27_031646_add_semester_to_mata_kuliah_table', 3),
(15, '2026_11_27_031654_create_krs_table', 3),
(16, '2026_11_27_031700_make_nilai_columns_nullable', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `mata_kuliah_id` bigint(20) UNSIGNED NOT NULL,
  `semester` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `nilai_tugas` tinyint(3) UNSIGNED DEFAULT NULL,
  `nilai_uts` tinyint(3) UNSIGNED DEFAULT NULL,
  `nilai_uas` tinyint(3) UNSIGNED DEFAULT NULL,
  `nilai_angka` tinyint(3) UNSIGNED DEFAULT NULL,
  `nilai_huruf` varchar(2) DEFAULT NULL,
  `bobot` decimal(3,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `mahasiswa_id`, `mata_kuliah_id`, `semester`, `nilai_tugas`, `nilai_uts`, `nilai_uas`, `nilai_angka`, `nilai_huruf`, `bobot`, `created_at`, `updated_at`) VALUES
(5, 5, 6, 1, 100, 88, 90, 92, 'A', 4.00, '2026-11-26 23:14:18', '2026-11-26 23:14:46'),
(6, 6, 6, 1, 100, 67, 89, 86, 'A', 4.00, '2026-11-26 23:14:18', '2026-11-26 23:14:46'),
(7, 7, 6, 1, 100, 45, 78, 75, 'B', 3.00, '2026-11-26 23:14:18', '2026-11-26 23:14:46'),
(8, 8, 6, 1, 100, 98, 100, 99, 'A', 4.00, '2026-11-26 23:14:18', '2026-11-26 23:14:46'),
(9, 9, 6, 1, 100, 68, 77, 81, 'A', 4.00, '2026-11-26 23:14:18', '2026-11-26 23:14:46'),
(10, 10, 6, 1, 100, 90, 89, 93, 'A', 4.00, '2026-11-26 23:14:18', '2026-11-26 23:14:46'),
(11, 11, 6, 1, 100, 50, 76, 75, 'B', 3.00, '2026-11-26 23:14:18', '2026-11-26 23:14:46'),
(12, 12, 6, 1, 100, 45, 87, 78, 'B', 3.00, '2026-11-26 23:14:18', '2026-11-26 23:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ya4lBoDvpnQfSFJld4geFrv8s9tPoq6k32Axl2hY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/158.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJxczFzYml1cTk3VU44UzRXanNsN3lzVXVNWm11dmt3T1E0R0RYa2RVIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImhvbWUifX0=', 1795760945);

-- --------------------------------------------------------

--
-- Table structure for table `tagihans`
--

CREATE TABLE `tagihans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `semester` tinyint(3) UNSIGNED NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `status` enum('belum','lunas') NOT NULL DEFAULT 'belum',
  `tanggal_bayar` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tagihans`
--

INSERT INTO `tagihans` (`id`, `mahasiswa_id`, `semester`, `keterangan`, `jumlah`, `jatuh_tempo`, `status`, `tanggal_bayar`, `created_at`, `updated_at`) VALUES
(2, 9, 2, 'Uang Gedung', 15000000, '2026-12-04', 'belum', NULL, '2026-11-26 23:20:06', '2026-11-26 23:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` enum('mahasiswa','dosen') NOT NULL DEFAULT 'mahasiswa',
  `email` varchar(255) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `ipk` decimal(3,2) NOT NULL DEFAULT 0.00,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nim`, `name`, `username`, `role`, `email`, `tempat_lahir`, `tanggal_lahir`, `photo`, `ipk`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '0011223344', 'M. Trisha Vampire S.T', 'Trisha', 'dosen', 'trisha@teacher.darkmoon.ac.id', 'Yogyakarta', '1980-05-17', 'photos/tNw0otkH70D22kRWlKrnkkvSWwluV2XMDL2znA5W.jpg', 0.00, NULL, '$2y$12$Egxa3jL93m6/Oo/c/8xlaus2Dl4NRDdwI1N2MPCzkbqAZbmoHjBJa', NULL, '2026-11-26 09:09:24', '2026-11-26 23:18:48'),
(4, '0022334455', 'Dr. Siti Aminah, M.T.', 'dosen2', 'dosen', 'dosen2@kampus.ac.id', 'Bandung', '1985-03-12', NULL, 0.00, NULL, '$2y$12$fLeHWNLlQl4KU/qXY/ZDlOf3Lcb1Ln/GIc98WKhXjRqQk9SXG2A92', NULL, '2026-11-26 21:39:01', '2026-11-26 21:39:01'),
(5, '20246001', 'Sooha Vampire', 'Sooha', 'mahasiswa', 'sooha@student.darkmoon.ac.id', 'Surakarta', '2026-11-17', 'photos/OeIYP0nbvLvOezP3uBNg7tUby5htT0zvsSdDcCUA.jpg', 4.00, NULL, '$2y$12$8wiZk67SuKmRV10nrt6byePXqsQ/85OyKama4zJ88cvKzVKZ/wwle', NULL, '2026-11-26 21:44:53', '2026-11-26 23:14:46'),
(6, '20246002', 'Heli Vampire', 'Heli', 'mahasiswa', 'heli@student.darkmoon.ac.id', 'Yogyakarta', '2026-11-18', 'photos/CgyUcR8I1EA3JQql1lowIvddlOz8Kl4R7Cidexs0.jpg', 4.00, NULL, '$2y$12$C1x295gv9WEjcysIXrW4LOLL5agEOohGw0MWK7F0AGjXgonTw77IC', NULL, '2026-11-26 21:45:54', '2026-11-26 23:14:46'),
(7, '20246003', 'Jaan Vampire', 'Jaan', 'mahasiswa', 'jaan@student.darkmoon.ac.id', 'Lampung', '2026-11-09', 'photos/CztnVcqi5Qmf9IRlemy4Oarm91goyMue0MgKLRYo.jpg', 3.00, NULL, '$2y$12$nlw4SGrb5hGAwffZFy7GFuph5nR37k4x7ewURjIf0hS.6PlTNaoru', NULL, '2026-11-26 21:46:57', '2026-11-26 23:14:46'),
(8, '20246004', 'Jino Vampire', 'Jino', 'mahasiswa', 'jino@student.darkmoon.ac.id', 'Semarang', '2026-11-05', 'photos/zS6s4sbsVZayV2VEEw5yBPaEhJuqCXutzdendcjn.jpg', 4.00, NULL, '$2y$12$aRTz90HZWoNm75Mg/D4H4OuUr4/7M3M26pbj8D4L0OTaTniWoaNMm', NULL, '2026-11-26 21:49:08', '2026-11-26 23:14:46'),
(9, '20246005', 'Solon Vampire', 'Solon', 'mahasiswa', 'solon@student.darkmoon.ac.id', 'Nusa Tenggara Timur', '2026-11-22', 'photos/HXktf06UqlXS3YFkvnkFgcnWJ5TMvKRUGtCboWpV.jpg', 4.00, NULL, '$2y$12$wWOBRg6lRHk/zQNWmpmOnee4IrslRgOXPqcmG88nGAlhT9B4lETYq', NULL, '2026-11-26 21:49:55', '2026-11-26 23:14:46'),
(10, '20246006', 'Shion Vampire', 'Shion', 'mahasiswa', 'shion@student.darkmoon.ac.id', 'Papua', '2026-11-17', 'photos/aOwNENtl0YgBMNB0Ieb02Llk9j7X9ffCr784YqCg.jpg', 4.00, NULL, '$2y$12$z42IVfH1f2rn4dG9GeaiWOU.zbMwQT1etiuo.zwE/BD5K9p4.Xrue', NULL, '2026-11-26 21:50:42', '2026-11-26 23:14:46'),
(11, '20246007', 'Jakah Vampire', 'Jakah', 'mahasiswa', 'jakah@student.darkmoon.ac.id', 'Surabaya', '2026-11-26', 'photos/jz6UzI8ezHxyzStNKNUy0iYoO8u6PQT8m0gKSNXB.jpg', 3.00, NULL, '$2y$12$vBlpVzoaZXYg7swxUPr/eOA3ll3KQwOM5.WgKxooeX10wDjsvKXQO', NULL, '2026-11-26 21:51:19', '2026-11-26 23:14:46'),
(12, '20246008', 'Noa Vampire', 'Noa', 'mahasiswa', 'noa@student.darkmoon.ac.id', 'Kalimantan', '2026-11-07', 'photos/ggYGgX855je2vlGOHqHTSyvUBhda09lZ9shiYt2A.jpg', 3.00, NULL, '$2y$12$y92cHtHpA4u.jK6RmwC7X.y4zg7gDMtIpDVLmPoSsV7xVgkArchaG', NULL, '2026-11-26 21:51:49', '2026-11-26 23:14:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_mata_kuliah_id_foreign` (`mata_kuliah_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `krs_mahasiswa_id_mata_kuliah_id_unique` (`mahasiswa_id`,`mata_kuliah_id`),
  ADD KEY `krs_mata_kuliah_id_foreign` (`mata_kuliah_id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mata_kuliah_kode_unique` (`kode`),
  ADD KEY `mata_kuliah_dosen_id_foreign` (`dosen_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nilai_mahasiswa_id_mata_kuliah_id_unique` (`mahasiswa_id`,`mata_kuliah_id`),
  ADD KEY `nilai_mata_kuliah_id_foreign` (`mata_kuliah_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tagihans`
--
ALTER TABLE `tagihans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tagihans_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nim_unique` (`nim`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tagihans`
--
ALTER TABLE `tagihans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_mata_kuliah_id_foreign` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `krs_mata_kuliah_id_foreign` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_mata_kuliah_id_foreign` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tagihans`
--
ALTER TABLE `tagihans`
  ADD CONSTRAINT `tagihans_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
