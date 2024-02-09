-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 09:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastwork_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti`
--

CREATE TABLE `bukti` (
  `id_bukti` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bukti_pembayaran` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukti`
--

INSERT INTO `bukti` (`id_bukti`, `nama`, `email`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
(4, 'Roberth Colln', 'pattroberth13@gmail.com', 'Bukti Pembayaran20240208010323.png', '2024-02-08 04:03:23', '2024-02-08 04:03:23'),
(5, 'Nama 1', 'pattroberth13@gmail.com', 'Bukti Pembayaran20240208055052.png', '2024-02-08 08:50:52', '2024-02-08 08:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_kegiatans`
--

CREATE TABLE `daftar_kegiatans` (
  `id_daftar_kegiatan` int(10) UNSIGNED NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `id_kategori_anggota` int(11) NOT NULL,
  `tanggal_kegiatan` date DEFAULT NULL,
  `biaya_kegiatan` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kupon` varchar(255) DEFAULT NULL,
  `potongan_harga` float DEFAULT NULL,
  `bukti_pembayaran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_anggota`
--

CREATE TABLE `kategori_anggota` (
  `id_kategori_anggota` int(10) UNSIGNED NOT NULL,
  `nama_kategori_anggota` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_anggota`
--

INSERT INTO `kategori_anggota` (`id_kategori_anggota`, `nama_kategori_anggota`, `created_at`, `updated_at`) VALUES
(1, 'Group', '2024-01-27 20:20:00', '2024-01-27 20:20:00'),
(2, 'Personal', '2024-01-27 21:55:47', '2024-01-27 21:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kegiatan`
--

CREATE TABLE `kategori_kegiatan` (
  `id_kategori_kegiatan` int(10) UNSIGNED NOT NULL,
  `nama_kategori_kegiatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_kegiatan`
--

INSERT INTO `kategori_kegiatan` (`id_kategori_kegiatan`, `nama_kategori_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 'Seminar Kuliah', '2024-01-27 19:40:41', '2024-01-27 19:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(10) UNSIGNED NOT NULL,
  `id_kategori_kegiatan` int(11) NOT NULL,
  `id_sub_kategori_kegiatan` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_kupon` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `deskripsi_kegiatan` text NOT NULL,
  `gambar_kegiatan` varchar(255) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `jam_kegiatan` time NOT NULL,
  `biaya_kegiatan` float DEFAULT NULL,
  `kupon` varchar(255) DEFAULT NULL,
  `potongan_harga` float DEFAULT NULL,
  `id_status_kegiatan` int(11) NOT NULL,
  `id_publish_kegiatan` int(11) NOT NULL,
  `slug_kegiatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `id_kategori_kegiatan`, `id_sub_kategori_kegiatan`, `id_paket`, `id_kupon`, `nama_kegiatan`, `deskripsi_kegiatan`, `gambar_kegiatan`, `tanggal_kegiatan`, `jam_kegiatan`, `biaya_kegiatan`, `kupon`, `potongan_harga`, `id_status_kegiatan`, `id_publish_kegiatan`, `slug_kegiatan`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 9, 6, 'Event Biasa', 'Event Biasa biasa Saja', 'Kegiatan20240204113353.jpg', '2024-02-08', '08:37:00', NULL, NULL, NULL, 1, 1, 'event-biasa', '2024-02-04 14:33:53', '2024-02-04 14:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `kupon`
--

CREATE TABLE `kupon` (
  `id_kupon` int(10) UNSIGNED NOT NULL,
  `kode_kupon` varchar(255) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `potongan_harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kupon`
--

INSERT INTO `kupon` (`id_kupon`, `kode_kupon`, `id_paket`, `potongan_harga`, `created_at`, `updated_at`) VALUES
(8, 'ROBERTHCOLLN', 1, 15200, NULL, NULL),
(9, 'COLLNJUN', 2, 12000, NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_01_23_145719_create_sessions_table', 1),
(7, '2024_01_24_113714_create_pendaftarans_table', 2),
(8, '2024_01_24_162811_create_pendaftarans_table', 3),
(9, '2024_01_27_025929_create_orders_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_tlp` varchar(255) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `status` enum('Paid','Unpaid') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(10) UNSIGNED NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `deskripsi_paket` text NOT NULL,
  `harga_paket` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `deskripsi_paket`, `harga_paket`, `created_at`, `updated_at`) VALUES
(1, 'Paket Bocah', 'tes', 150000, '2024-02-07 12:48:09', '2024-02-07 12:48:09'),
(2, 'Paket Bocah2', 'tes', 100000, '2024-02-07 12:48:33', '2024-02-07 12:48:33');

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
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_daftar_kegiatan` int(10) UNSIGNED NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_kategori_anggota` int(11) NOT NULL,
  `tanggal_kegiatan` date DEFAULT NULL,
  `biaya_kegiatan` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kupon` varchar(255) DEFAULT NULL,
  `potongan_harga` float DEFAULT NULL,
  `bukti_pembayaran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presensi_pesertas`
--

CREATE TABLE `presensi_pesertas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` varchar(255) NOT NULL,
  `status_kehadiran` varchar(255) NOT NULL,
  `waktu_presensi` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publish_kegiatan`
--

CREATE TABLE `publish_kegiatan` (
  `id_publish_kegiatan` int(10) UNSIGNED NOT NULL,
  `nama_publish_kegiatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publish_kegiatan`
--

INSERT INTO `publish_kegiatan` (`id_publish_kegiatan`, `nama_publish_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 'Published', NULL, NULL),
(2, 'Draft', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(10) UNSIGNED NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_kategori_anggota` int(11) NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `harga_paket` float DEFAULT NULL,
  `kode_kupon` varchar(255) DEFAULT NULL,
  `potongan_harga` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `id_paket`, `id_kategori_anggota`, `id_kegiatan`, `nama`, `email`, `no_hp`, `harga_paket`, `kode_kupon`, `potongan_harga`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 2, 'Roberth Colln', 'pattroberth13@gmail.com', '082124944770', 150000, NULL, NULL, '2024-02-08 13:52:10', '2024-02-08 13:52:10'),
(5, 1, 1, 2, 'Roberth Colln', 'pattroberth13@gmail.com', '082124944770', 150000, NULL, NULL, '2024-02-08 13:52:30', '2024-02-08 13:52:30'),
(6, 1, 1, 2, 'Roberth Colln', 'pattroberth13@gmail.com', '082124944770', 150000, NULL, NULL, '2024-02-08 13:52:45', '2024-02-08 13:52:45'),
(7, 1, 1, 2, 'Roberth Colln', 'pattroberth13@gmail.com', '082124944770', 150000, NULL, NULL, '2024-02-08 13:53:46', '2024-02-08 13:53:46'),
(8, 1, 1, 2, 'Roberth Colln', 'pattroberth13@gmail.com', '082124944770', 150000, NULL, NULL, '2024-02-08 13:54:00', '2024-02-08 13:54:00');

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
('ludXFZ5BYpXumyXUeCY1xJ7ESWi4KdwZ7p55Yr6x', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibVNWZGtld2NRaVhkazM5TWdkaGFzMWVoODVQWFNrYXdYbm1iTTV3aCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJG8yTlFEd0ZQVzJSbi5QVFNXdy5LZmUuV21LZS96d3pMRWtlQzZEd3VMVy9tVktTOUlCc3g2Ijt9', 1707428371),
('tFTwKNcfKrkmcwLy8CiRyHeMJ1vK3nW9ijEpZcHP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZnFnWE5MbkR4MHFXRzM4aDNFM3lpYzVKNzdINHlwTkx5V081Mkw2YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkbzJOUUR3RlBXMlJuLlBUU1d3LktmZS5XbUtlL3p3ekxFa2VDNkR3dUxXL21WS1M5SUJzeDYiO30=', 1707432840);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(10) UNSIGNED NOT NULL,
  `instansi_setting` varchar(255) NOT NULL,
  `pimpinan_setting` varchar(255) NOT NULL,
  `logo_setting` varchar(255) NOT NULL,
  `favicon_setting` varchar(255) NOT NULL,
  `tentang_setting` text NOT NULL,
  `misi_setting` text DEFAULT NULL,
  `visi_setting` text DEFAULT NULL,
  `keyword_setting` varchar(255) NOT NULL,
  `alamat_setting` varchar(255) NOT NULL,
  `instagram_setting` varchar(255) NOT NULL,
  `youtube_setting` varchar(255) NOT NULL,
  `email_setting` varchar(255) NOT NULL,
  `no_hp_setting` varchar(255) NOT NULL,
  `maps_setting` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `instansi_setting`, `pimpinan_setting`, `logo_setting`, `favicon_setting`, `tentang_setting`, `misi_setting`, `visi_setting`, `keyword_setting`, `alamat_setting`, `instagram_setting`, `youtube_setting`, `email_setting`, `no_hp_setting`, `maps_setting`, `created_at`, `updated_at`) VALUES
(2, 'Pendaftaran Seminar', 'Bambang', 'Screenshot (80).png', 'Screenshot (80).png', 'Aplikasi Pendaftaran Seminar merupakan  aplikasi yang bergerak di bidang manajerial data, khususnya yang berkaitan dengan pendaftaran acara seminar online. Sistem informasi ini sangat canggih dan banyak menarik minat karena dapat digunakan dua arah, yaitu oleh panitia atau admin, dan calon peserta seminar online.', NULL, NULL, 'Pendaftaran Seminar', 'Jalan Jalan', 'roberth_colln', 'watch?v=o3waOUpRvEI', 'pattroberth13@gmail.com', '082124944770', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6052.310545613204!2d128.18891195941168!3d-3.695981435217559!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d6ce9997efd6c13%3A0x614773e8a7bb0edc!2sIstana%20Roberth_colln!5e0!3m2!1sid!2sid!4v1706847994859!5m2!1sid!2sid', NULL, '2024-02-01 19:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `status_kegiatan`
--

CREATE TABLE `status_kegiatan` (
  `id_status_kegiatan` int(10) UNSIGNED NOT NULL,
  `nama_status_kegiatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_kegiatan`
--

INSERT INTO `status_kegiatan` (`id_status_kegiatan`, `nama_status_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 'Open', NULL, NULL),
(2, 'Close', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategori_kegiatan`
--

CREATE TABLE `sub_kategori_kegiatan` (
  `id_sub_kategori_kegiatan` int(10) UNSIGNED NOT NULL,
  `id_kategori_kegiatan` int(11) NOT NULL,
  `nama_sub_kategori_kegiatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_kategori_kegiatan`
--

INSERT INTO `sub_kategori_kegiatan` (`id_sub_kategori_kegiatan`, `id_kategori_kegiatan`, `nama_sub_kategori_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mahasiswa', '2024-01-27 19:40:57', '2024-01-27 19:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$o2NQDwFPW2Rn.PTSWw.Kfe.WmKe/zwzLEkeC6DwuLW/mVKS9IBsx6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Roberth', 'pattroberth13@gmail.com', NULL, '$2y$12$upbzq3JxNqoPO6xuhb5YeugPDaJIrH2l4kMAg.6TFeNi0sg1Vdm6y', NULL, NULL, NULL, NULL, NULL, NULL, '2024-02-08 08:50:06', '2024-02-08 08:50:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti`
--
ALTER TABLE `bukti`
  ADD PRIMARY KEY (`id_bukti`);

--
-- Indexes for table `daftar_kegiatans`
--
ALTER TABLE `daftar_kegiatans`
  ADD PRIMARY KEY (`id_daftar_kegiatan`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori_anggota`
--
ALTER TABLE `kategori_anggota`
  ADD PRIMARY KEY (`id_kategori_anggota`);

--
-- Indexes for table `kategori_kegiatan`
--
ALTER TABLE `kategori_kegiatan`
  ADD PRIMARY KEY (`id_kategori_kegiatan`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `kupon`
--
ALTER TABLE `kupon`
  ADD PRIMARY KEY (`id_kupon`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_daftar_kegiatan`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `presensi_pesertas`
--
ALTER TABLE `presensi_pesertas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publish_kegiatan`
--
ALTER TABLE `publish_kegiatan`
  ADD PRIMARY KEY (`id_publish_kegiatan`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `status_kegiatan`
--
ALTER TABLE `status_kegiatan`
  ADD PRIMARY KEY (`id_status_kegiatan`);

--
-- Indexes for table `sub_kategori_kegiatan`
--
ALTER TABLE `sub_kategori_kegiatan`
  ADD PRIMARY KEY (`id_sub_kategori_kegiatan`);

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
-- AUTO_INCREMENT for table `bukti`
--
ALTER TABLE `bukti`
  MODIFY `id_bukti` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `daftar_kegiatans`
--
ALTER TABLE `daftar_kegiatans`
  MODIFY `id_daftar_kegiatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_anggota`
--
ALTER TABLE `kategori_anggota`
  MODIFY `id_kategori_anggota` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_kegiatan`
--
ALTER TABLE `kategori_kegiatan`
  MODIFY `id_kategori_kegiatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kupon`
--
ALTER TABLE `kupon`
  MODIFY `id_kupon` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_daftar_kegiatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presensi_pesertas`
--
ALTER TABLE `presensi_pesertas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `publish_kegiatan`
--
ALTER TABLE `publish_kegiatan`
  MODIFY `id_publish_kegiatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_kegiatan`
--
ALTER TABLE `status_kegiatan`
  MODIFY `id_status_kegiatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_kategori_kegiatan`
--
ALTER TABLE `sub_kategori_kegiatan`
  MODIFY `id_sub_kategori_kegiatan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
