-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2018 at 03:28 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectkai`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendapatan` bigint(20) UNSIGNED DEFAULT NULL,
  `volume` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `user_id`, `jenis`, `pendapatan`, `volume`, `created_at`, `updated_at`) VALUES
(1, 1, 'Petikemas', 1500000, 150, '2018-04-22 17:00:00', '2018-04-23 01:05:05'),
(2, 1, 'Semen', 2000000, 200, '2018-04-22 17:00:00', '2018-04-23 01:05:06'),
(3, 1, 'BBM', 3000000, 300, '2018-04-22 17:00:00', '2018-04-23 01:05:06'),
(4, 1, 'Cargo', 4000000, 400, '2018-04-22 17:00:00', '2018-04-23 01:05:06'),
(5, 1, 'Sharing', 5000000, NULL, '2018-04-22 17:00:00', '2018-04-23 01:05:06'),
(6, 1, 'KA Lain', NULL, 500, '2018-04-22 17:00:00', '2018-04-23 01:05:06'),
(7, 1, 'Petikemas', 5000000, 500, '2018-04-23 17:00:00', NULL),
(8, 1, 'Semen', 6000000, 600, '2018-04-23 17:00:00', NULL),
(9, 1, 'BBM', 7000000, 700, '2018-04-23 17:00:00', NULL),
(10, 1, 'Cargo', 1000000, 100, '2018-04-23 17:00:00', NULL),
(11, 1, 'Sharing', 2000000, NULL, '2018-04-23 17:00:00', NULL),
(12, 1, 'KA Lain', NULL, 200, '2018-04-23 17:00:00', NULL),
(13, 1, 'Petikemas', 4000000, 400, '2018-04-24 17:00:00', NULL),
(14, 1, 'Semen', 5000000, 500, '2018-04-24 17:00:00', NULL),
(15, 1, 'BBM', 6000000, 600, '2018-04-24 17:00:00', NULL),
(16, 1, 'Cargo', 7000000, 700, '2018-04-24 17:00:00', NULL),
(17, 1, 'Sharing', 1000000, NULL, '2018-04-24 17:00:00', NULL),
(18, 1, 'KA Lain', NULL, 100, '2018-04-24 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bhp`
--

CREATE TABLE `bhp` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `stasiun_id` int(10) UNSIGNED NOT NULL,
  `value` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komulatif_barang`
--

CREATE TABLE `komulatif_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendapatan` bigint(20) UNSIGNED DEFAULT NULL,
  `volume` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komulatif_barang`
--

INSERT INTO `komulatif_barang` (`id`, `jenis`, `pendapatan`, `volume`, `created_at`, `updated_at`) VALUES
(1, 'Petikemas', 1500000, 150, '2018-04-22 17:00:00', '2018-04-23 01:05:06'),
(2, 'Semen', 2000000, 200, '2018-04-22 17:00:00', NULL),
(3, 'BBM', 3000000, 300, '2018-04-22 17:00:00', NULL),
(4, 'Cargo', 4000000, 400, '2018-04-22 17:00:00', NULL),
(5, 'Sharing', 5000000, NULL, '2018-04-22 17:00:00', NULL),
(6, 'Ka_lain', NULL, 500, '2018-04-22 17:00:00', NULL),
(7, 'Petikemas', 6500000, 650, '2018-04-23 17:00:00', '2018-04-23 01:05:06'),
(8, 'Semen', 8000000, 800, '2018-04-23 17:00:00', NULL),
(9, 'BBM', 10000000, 1000, '2018-04-23 17:00:00', NULL),
(10, 'Cargo', 5000000, 500, '2018-04-23 17:00:00', NULL),
(11, 'Sharing', 7000000, NULL, '2018-04-23 17:00:00', NULL),
(12, 'Ka_lain', NULL, 700, '2018-04-23 17:00:00', NULL),
(13, 'Petikemas', 10500000, 1050, '2018-04-24 17:00:00', '2018-04-23 01:05:06'),
(14, 'Semen', 13000000, 1300, '2018-04-24 17:00:00', NULL),
(15, 'BBM', 16000000, 1600, '2018-04-24 17:00:00', NULL),
(16, 'Cargo', 12000000, 1200, '2018-04-24 17:00:00', NULL),
(17, 'Sharing', 8000000, NULL, '2018-04-24 17:00:00', NULL),
(18, 'Ka_lain', NULL, 800, '2018-04-24 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `komulatif_bhp`
--

CREATE TABLE `komulatif_bhp` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komulatif_non_angkutan`
--

CREATE TABLE `komulatif_non_angkutan` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendapatan` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komulatif_non_angkutan`
--

INSERT INTO `komulatif_non_angkutan` (`id`, `jenis`, `pendapatan`, `created_at`, `updated_at`) VALUES
(1, 'PDDM', 1500000, '2018-04-22 17:00:00', '2018-04-23 01:24:06'),
(2, 'PDDM', 3500000, '2018-04-23 17:00:00', '2018-04-23 01:24:06'),
(3, 'PDDM', 6500000, '2018-04-24 17:00:00', '2018-04-23 01:24:07'),
(4, 'UUK', 1500000, '2018-04-22 17:00:00', '2018-04-23 01:27:26'),
(5, 'UUK', 3500000, '2018-04-23 17:00:00', '2018-04-23 01:27:26'),
(6, 'UUK', 6500000, '2018-04-24 17:00:00', '2018-04-23 01:27:26'),
(7, 'Ambarawa', 1770000, '2018-04-22 17:00:00', '2018-04-23 01:27:04'),
(8, 'Ambarawa', 3605000, '2018-04-23 17:00:00', '2018-04-23 01:27:04'),
(9, 'Ambarawa', 5390000, '2018-04-24 17:00:00', '2018-04-23 01:27:04'),
(10, 'Lawang', 830000, '2018-04-22 17:00:00', '2018-04-23 01:25:36'),
(11, 'Lawang', 1575000, '2018-04-23 17:00:00', '2018-04-23 01:25:36'),
(12, 'Lawang', 2380000, '2018-04-24 17:00:00', '2018-04-23 01:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `komulatif_penumpang`
--

CREATE TABLE `komulatif_penumpang` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendapatan` bigint(20) UNSIGNED NOT NULL,
  `volume` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komulatif_penumpang`
--

INSERT INTO `komulatif_penumpang` (`id`, `jenis`, `pendapatan`, `volume`, `created_at`, `updated_at`) VALUES
(1, 'Eksekutif', 1500000, 150, '2018-04-22 17:00:00', '2018-04-23 01:20:16'),
(2, 'Bisnis', 2000000, 200, '2018-04-22 17:00:00', NULL),
(3, 'Ekonomi', 3000000, 300, '2018-04-22 17:00:00', NULL),
(4, 'Lokal', 4000000, 400, '2018-04-22 17:00:00', NULL),
(5, 'Eksekutif', 6500000, 650, '2018-04-23 17:00:00', '2018-04-23 01:20:16'),
(6, 'Bisnis', 8000000, 800, '2018-04-23 17:00:00', NULL),
(7, 'Ekonomi', 10000000, 1000, '2018-04-23 17:00:00', NULL),
(8, 'Lokal', 5000000, 500, '2018-04-23 17:00:00', NULL),
(9, 'Eksekutif', 8500000, 850, '2018-04-24 17:00:00', '2018-04-23 01:20:16'),
(10, 'Bisnis', 11000000, 1100, '2018-04-24 17:00:00', NULL),
(11, 'Ekonomi', 14000000, 1400, '2018-04-24 17:00:00', NULL),
(12, 'Lokal', 10000000, 1000, '2018-04-24 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan_ambarawa`
--

CREATE TABLE `pendapatan_ambarawa` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` int(10) UNSIGNED NOT NULL,
  `satuan` int(10) UNSIGNED NOT NULL,
  `total` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendapatan_ambarawa`
--

INSERT INTO `pendapatan_ambarawa` (`id`, `user_id`, `kategori`, `jenis`, `volume`, `satuan`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lokal', 'Dewasa', 27, 10000, 270000, '2018-04-22 17:00:00', '2018-04-23 01:27:04'),
(2, 1, 'Lokal', 'Anak', 25, 5000, 125000, '2018-04-22 17:00:00', '2018-04-23 01:27:04'),
(3, 1, 'Asing', 'Dewasa', 28, 10000, 280000, '2018-04-22 17:00:00', '2018-04-23 01:27:04'),
(4, 1, 'Asing', 'anak', 22, 5000, 110000, '2018-04-22 17:00:00', '2018-04-23 01:27:04'),
(5, 1, 'rts', 'rts', 27, 15000, 405000, '2018-04-22 17:00:00', '2018-04-23 01:27:04'),
(6, 1, 'sewa', 'sewa_ka', 29, 20000, 580000, '2018-04-22 17:00:00', '2018-04-23 01:27:04'),
(7, 1, 'Lokal', 'Dewasa', 26, 10000, 260000, '2018-04-23 17:00:00', NULL),
(8, 1, 'Lokal', 'Anak', 24, 5000, 120000, '2018-04-23 17:00:00', NULL),
(9, 1, 'Asing', 'Dewasa', 25, 10000, 250000, '2018-04-23 17:00:00', NULL),
(10, 1, 'Asing', 'anak', 23, 5000, 115000, '2018-04-23 17:00:00', NULL),
(11, 1, 'rts', 'rts', 30, 15000, 450000, '2018-04-23 17:00:00', NULL),
(12, 1, 'sewa', 'sewa_ka', 32, 20000, 640000, '2018-04-23 17:00:00', NULL),
(13, 1, 'Lokal', 'Dewasa', 27, 10000, 270000, '2018-04-24 17:00:00', NULL),
(14, 1, 'Lokal', 'Anak', 25, 5000, 125000, '2018-04-24 17:00:00', NULL),
(15, 1, 'Asing', 'Dewasa', 26, 10000, 260000, '2018-04-24 17:00:00', NULL),
(16, 1, 'Asing', 'anak', 24, 5000, 120000, '2018-04-24 17:00:00', NULL),
(17, 1, 'rts', 'rts', 30, 15000, 450000, '2018-04-24 17:00:00', NULL),
(18, 1, 'sewa', 'sewa_ka', 28, 20000, 560000, '2018-04-24 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan_lawang`
--

CREATE TABLE `pendapatan_lawang` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` int(10) UNSIGNED NOT NULL,
  `satuan` int(10) UNSIGNED NOT NULL,
  `total` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendapatan_lawang`
--

INSERT INTO `pendapatan_lawang` (`id`, `user_id`, `kategori`, `jenis`, `volume`, `satuan`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lokal', 'Dewasa', 30, 10000, 300000, '2018-04-22 17:00:00', '2018-04-23 01:25:36'),
(2, 1, 'Lokal', 'Anak', 25, 5000, 125000, '2018-04-22 17:00:00', '2018-04-23 01:25:36'),
(3, 1, 'Asing', 'Dewasa', 28, 10000, 280000, '2018-04-22 17:00:00', '2018-04-23 01:25:36'),
(4, 1, 'Asing', 'anak', 25, 5000, 125000, '2018-04-22 17:00:00', '2018-04-23 01:25:36'),
(5, 1, 'Lokal', 'Dewasa', 26, 10000, 260000, '2018-04-23 17:00:00', NULL),
(6, 1, 'Lokal', 'Anak', 24, 5000, 120000, '2018-04-23 17:00:00', NULL),
(7, 1, 'Asing', 'Dewasa', 25, 10000, 250000, '2018-04-23 17:00:00', NULL),
(8, 1, 'Asing', 'anak', 23, 5000, 115000, '2018-04-23 17:00:00', NULL),
(9, 1, 'Lokal', 'Dewasa', 28, 10000, 280000, '2018-04-24 17:00:00', NULL),
(10, 1, 'Lokal', 'Anak', 26, 5000, 130000, '2018-04-24 17:00:00', NULL),
(11, 1, 'Asing', 'Dewasa', 27, 10000, 270000, '2018-04-24 17:00:00', NULL),
(12, 1, 'Asing', 'anak', 25, 5000, 125000, '2018-04-24 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan_pa`
--

CREATE TABLE `pendapatan_pa` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `value` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendapatan_pa`
--

INSERT INTO `pendapatan_pa` (`id`, `user_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1500000, '2018-04-22 17:00:00', '2018-04-23 01:24:06'),
(2, 1, 2000000, '2018-04-23 17:00:00', '2018-04-23 01:07:16'),
(3, 1, 3000000, '2018-04-24 17:00:00', '2018-04-23 01:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `pendapatan_uuk`
--

CREATE TABLE `pendapatan_uuk` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `value` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendapatan_uuk`
--

INSERT INTO `pendapatan_uuk` (`id`, `user_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1500000, '2018-04-22 17:00:00', '2018-04-23 01:27:26'),
(2, 1, 2000000, '2018-04-23 17:00:00', '2018-04-23 01:08:30'),
(3, 1, 3000000, '2018-04-24 17:00:00', '2018-04-23 01:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `stasiun_id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` bigint(20) DEFAULT NULL,
  `pendapatan` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`id`, `user_id`, `stasiun_id`, `jenis`, `volume`, `pendapatan`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Eksekutif', 150, 1500000, '2018-04-22 17:00:00', '2018-04-23 01:20:16'),
(2, 1, 0, 'Bisnis', 200, 2000000, '2018-04-22 17:00:00', '2018-04-23 01:20:16'),
(3, 1, 0, 'Ekonomi', 300, 3000000, '2018-04-22 17:00:00', '2018-04-23 01:20:16'),
(4, 1, 0, 'Lokal', 400, 4000000, '2018-04-22 17:00:00', '2018-04-23 01:20:16'),
(5, 1, 0, 'Eksekutif', 500, 5000000, '2018-04-23 17:00:00', NULL),
(6, 1, 0, 'Bisnis', 600, 6000000, '2018-04-23 17:00:00', NULL),
(7, 1, 0, 'Ekonomi', 700, 7000000, '2018-04-23 17:00:00', NULL),
(8, 1, 0, 'Lokal', 100, 1000000, '2018-04-23 17:00:00', NULL),
(9, 1, 0, 'Eksekutif', 200, 2000000, '2018-04-24 17:00:00', NULL),
(10, 1, 0, 'Bisnis', 300, 3000000, '2018-04-24 17:00:00', NULL),
(11, 1, 0, 'Ekonomi', 400, 4000000, '2018-04-24 17:00:00', NULL),
(12, 1, 0, 'Lokal', 500, 5000000, '2018-04-24 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stasiun`
--

CREATE TABLE `stasiun` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_stasiun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stasiun_barang` tinyint(1) NOT NULL,
  `stasiun_penumpang` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stasiun`
--

INSERT INTO `stasiun` (`id`, `nama_stasiun`, `stasiun_barang`, `stasiun_penumpang`, `created_at`, `updated_at`) VALUES
(0, 'DAOP 4', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE `target` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` bigint(20) UNSIGNED NOT NULL,
  `pendapatan` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`id`, `user_id`, `kategori`, `jenis`, `volume`, `pendapatan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Penumpang', 'Eksekutif', 1000000, 100000000, '2018-04-20 12:07:03', '2018-04-20 12:26:17'),
(2, 1, 'Penumpang', 'Bisnis', 2000000, 200000000, '2018-04-20 12:07:03', '2018-04-20 12:26:17'),
(3, 1, 'Penumpang', 'Ekonomi', 3000000, 300000000, '2018-04-20 12:07:03', '2018-04-20 12:26:17'),
(4, 1, 'Penumpang', 'Lokal', 4000000, 400000000, '2018-04-20 12:07:03', '2018-04-20 12:26:17'),
(5, 1, 'Barang', 'Barang', 0, 290000000, '2018-04-20 12:07:03', '2018-04-20 12:26:17'),
(6, 1, 'NonAngkutan', 'NonAngkutan', 0, 300000000, '2018-04-20 12:07:03', '2018-04-20 12:26:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'admin@ptkai.co.id', '$2y$10$ridaRSOpLcqr8lyCWsvhVuY7JdHoHH539p3NGe94uIXm3p2z.XViC', 1, '0clsL6FpOThW5SMeWBFAJmpWPBy27j7qRZn4vBa8o8TC18rbEnE9QXimFmIR', NULL, NULL),
(2, 'muraga', 'muraga12', 'nanthan12muraga@gmail.com', '$2y$10$Gpz2klnUkNmIFruOC1YMZungjj3Y4oAYxJU5JSw7/yXW14ytTevJW', 8, 'Fks7lXqvXeDKUUTgKYa8zELbKj75PTerPhZqsLP9SMuzaJDiKHWQ3jmYoLJE', '2018-04-20 12:02:25', '2018-04-21 10:54:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_user_id_foreign` (`user_id`);

--
-- Indexes for table `bhp`
--
ALTER TABLE `bhp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bhp_user_id_foreign` (`user_id`),
  ADD KEY `bhp_stasiun_id_foreign` (`stasiun_id`);

--
-- Indexes for table `komulatif_barang`
--
ALTER TABLE `komulatif_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komulatif_bhp`
--
ALTER TABLE `komulatif_bhp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komulatif_non_angkutan`
--
ALTER TABLE `komulatif_non_angkutan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komulatif_penumpang`
--
ALTER TABLE `komulatif_penumpang`
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
-- Indexes for table `pendapatan_ambarawa`
--
ALTER TABLE `pendapatan_ambarawa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendapatan_ambarawa_user_id_foreign` (`user_id`);

--
-- Indexes for table `pendapatan_lawang`
--
ALTER TABLE `pendapatan_lawang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendapatan_lawang_user_id_foreign` (`user_id`);

--
-- Indexes for table `pendapatan_pa`
--
ALTER TABLE `pendapatan_pa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendapatan_pa_user_id_foreign` (`user_id`);

--
-- Indexes for table `pendapatan_uuk`
--
ALTER TABLE `pendapatan_uuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendapatan_uuk_user_id_foreign` (`user_id`);

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penumpang_user_id_foreign` (`user_id`),
  ADD KEY `penumpang_stasiun_id_foreign` (`stasiun_id`);

--
-- Indexes for table `stasiun`
--
ALTER TABLE `stasiun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`id`),
  ADD KEY `target_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bhp`
--
ALTER TABLE `bhp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komulatif_barang`
--
ALTER TABLE `komulatif_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `komulatif_bhp`
--
ALTER TABLE `komulatif_bhp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komulatif_non_angkutan`
--
ALTER TABLE `komulatif_non_angkutan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `komulatif_penumpang`
--
ALTER TABLE `komulatif_penumpang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendapatan_ambarawa`
--
ALTER TABLE `pendapatan_ambarawa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pendapatan_lawang`
--
ALTER TABLE `pendapatan_lawang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pendapatan_pa`
--
ALTER TABLE `pendapatan_pa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pendapatan_uuk`
--
ALTER TABLE `pendapatan_uuk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stasiun`
--
ALTER TABLE `stasiun`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `target`
--
ALTER TABLE `target`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `bhp`
--
ALTER TABLE `bhp`
  ADD CONSTRAINT `bhp_stasiun_id_foreign` FOREIGN KEY (`stasiun_id`) REFERENCES `stasiun` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bhp_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pendapatan_ambarawa`
--
ALTER TABLE `pendapatan_ambarawa`
  ADD CONSTRAINT `pendapatan_ambarawa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pendapatan_lawang`
--
ALTER TABLE `pendapatan_lawang`
  ADD CONSTRAINT `pendapatan_lawang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pendapatan_pa`
--
ALTER TABLE `pendapatan_pa`
  ADD CONSTRAINT `pendapatan_pa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pendapatan_uuk`
--
ALTER TABLE `pendapatan_uuk`
  ADD CONSTRAINT `pendapatan_uuk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD CONSTRAINT `penumpang_stasiun_id_foreign` FOREIGN KEY (`stasiun_id`) REFERENCES `stasiun` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penumpang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `target`
--
ALTER TABLE `target`
  ADD CONSTRAINT `target_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
