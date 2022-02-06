-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Feb 2022 pada 12.17
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transaksi_cafe`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `stok`, `gambar`, `created_at`, `updated_at`) VALUES
('BT-79574', 'Coffee Brown Sugar', 17000, 12, '1643675249-HAMFN.jpeg', '2022-02-01 00:27:29', '2022-02-01 00:28:58'),
('LL-79746', 'Americano', 14000, 18, '1643653619-3V5KK.jpeg', '2022-01-31 18:26:59', '2022-02-01 00:28:58'),
('MH-51772', 'Cappucino', 19000, 9, '1643671575-4URK8.jpeg', '2022-01-31 23:26:15', '2022-02-01 00:11:54'),
('NH-98571', 'Cafe Latte', 18000, 13, '1643652347-35GMM.jpeg', '2022-01-31 18:05:47', '2022-02-01 00:21:52'),
('PU-55404', 'Cinnamon Dolce Latte', 20000, 13, '1643659681-A3MX9.jpeg', '2022-01-31 20:08:01', '2022-02-01 00:18:56'),
('RB-43551', 'Moccacino', 18000, 7, '1643657153-EDGT1.jpeg', '2022-01-31 19:25:53', '2022-02-01 00:15:41'),
('TE-54114', 'Coffee Beer', 15000, 15, '1643659934-A764Y.jpeg', '2022-01-31 20:12:14', '2022-02-01 00:15:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` varchar(10) NOT NULL,
  `periode` date NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `periode`, `total`, `created_at`, `updated_at`) VALUES
('INV3058', '2022-02-01', 40000, '2022-02-01 00:18:56', '2022-02-01 00:18:56'),
('INV5071', '2022-02-01', 85000, '2022-02-01 00:14:19', '2022-02-01 00:14:19'),
('INV7046', '2022-02-01', 107000, '2022-02-01 00:28:58', '2022-02-01 00:28:58'),
('INV8573', '2022-02-01', 48000, '2022-02-01 00:15:41', '2022-02-01 00:15:41'),
('INV9937', '2022-02-01', 92000, '2022-02-01 00:11:54', '2022-02-01 00:11:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_produk`
--

CREATE TABLE `transaksi_produk` (
  `id` bigint(20) NOT NULL,
  `periode` date NOT NULL,
  `invoice` varchar(10) NOT NULL,
  `id_produk` varchar(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_produk`
--

INSERT INTO `transaksi_produk` (`id`, `periode`, `invoice`, `id_produk`, `nama`, `harga`, `jumlah`, `total`, `created_at`, `updated_at`) VALUES
(138, '2022-02-01', 'INV9937', 'NH-98571', 'Cafe Latte', 18000, 3, 54000, '2022-02-01 00:11:54', '2022-02-01 00:11:54'),
(139, '2022-02-01', 'INV9937', 'MH-51772', 'Cappucino', 19000, 2, 38000, '2022-02-01 00:11:54', '2022-02-01 00:11:54'),
(140, '2022-02-01', 'INV5071', 'PU-55404', 'Cinnamon Dolce Latte', 20000, 2, 40000, '2022-02-01 00:14:19', '2022-02-01 00:14:19'),
(141, '2022-02-01', 'INV5071', 'TE-54114', 'Coffee Beer', 15000, 3, 45000, '2022-02-01 00:14:19', '2022-02-01 00:14:19'),
(142, '2022-02-01', 'INV8573', 'RB-43551', 'Moccacino', 18000, 1, 18000, '2022-02-01 00:15:41', '2022-02-01 00:15:41'),
(143, '2022-02-01', 'INV8573', 'TE-54114', 'Coffee Beer', 15000, 2, 30000, '2022-02-01 00:15:41', '2022-02-01 00:15:41'),
(144, '2022-02-01', 'INV3058', 'PU-55404', 'Cinnamon Dolce Latte', 20000, 2, 40000, '2022-02-01 00:18:56', '2022-02-01 00:18:56'),
(145, '2022-02-01', 'INV7046', 'BT-79574', 'Coffee Brown Sugar', 17000, 3, 51000, '2022-02-01 00:28:58', '2022-02-01 00:28:58'),
(146, '2022-02-01', 'INV7046', 'LL-79746', 'Americano', 14000, 4, 56000, '2022-02-01 00:28:58', '2022-02-01 00:28:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, '$2y$10$f29B.udejauHtgT/l8LG2.ldDE9dmEaCZCLIuaKcEd7bUyVYMHfiG', 'admin', NULL, '2022-01-28 02:36:11', '2022-01-28 02:36:11'),
(2, 'Kasir', 'kasir', NULL, '$2y$10$PO8ms0YgAwqy9XXawBCjTOp3GAR2cskF5hGCciKL.YXihdwP1T.D.', 'kasir', NULL, '2022-01-31 23:16:06', '2022-01-31 23:16:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
