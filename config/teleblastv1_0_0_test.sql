-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Agu 2024 pada 02.14
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teleblastv1.0.0_test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `broadcast_messages`
--

CREATE TABLE `broadcast_messages` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` varchar(9999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` time NOT NULL,
  `status` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `broadcast_messages`
--

INSERT INTO `broadcast_messages` (`id`, `id_pesan`, `id_group`, `days`, `waktu`, `status`, `created_at`, `updated_at`) VALUES
('66bb0941bc330', '66b6d51edb0d4', '{\"@group_sepuluh27\":\"-100820241027\",\"@group_sepuluh26\":\"-100820241026\",\"@group_sepuluh23\":\"-102209082024\"}', '{\"minggu\":\"0\",\"senin\":\"1\",\"selasa\":\"2\",\"rabu\":\"3\"}', '14:17:00', 'on', '2024-08-13 07:20:33', NULL),
('66bb09e8a8a4b', '66b6d51edb0d4', '{\"@group_sepuluh27\":\"-100820241027\",\"@group_sepuluh26\":\"-100820241026\",\"@group_sepuluh25\":\"-100820241025\",\"@group_sepuluh23\":\"-102209082024\"}', '{\"minggu\":\"0\",\"senin\":\"1\",\"selasa\":\"2\",\"rabu\":\"3\",\"kamis\":\"4\",\"jumat\":\"5\"}', '16:25:00', 'on', '2024-08-13 07:23:20', NULL),
('66bb0a6d7a25c', '66b6d51edb0d4', '{\"@group_sepuluh27\":\"-100820241027\",\"@group_sepuluh23\":\"-102209082024\"}', '{\"minggu\":\"0\",\"senin\":\"1\",\"selasa\":\"2\"}', '15:26:00', 'off', '2024-08-13 07:25:33', NULL),
('66c16630e9610', '66b6d51edb0d4', '{\"@group_sepuluh23\":\"-102209082024\"}', '{\"senin\":\"1\",\"selasa\":\"2\",\"sabtu\":\"6\"}', '16:11:00', 'on', '2024-08-18 03:10:40', NULL),
('66c42294c1dda', '66a9e4125a100', '{\"@group_sepuluh27\":\"-100820241027\",\"@group_sembilan46\":\"-102409082024\"}', '{\"kamis\":\"4\",\"jumat\":\"5\",\"sabtu\":\"6\"}', '14:02:00', 'off', '2024-08-20 04:59:00', NULL),
('66c424d3321f1', '66a9e4125a100', '{\"@group_sepuluh27\":\"-100820241027\",\"@group_sembilan46\":\"-102409082024\",\"@group_sepuluh23\":\"-102209082024\"}', '{\"minggu\":\"0\",\"senin\":\"1\"}', '12:10:00', 'off', '2024-08-20 05:08:35', NULL),
('66c8466f45ce8', '66c842ce98a61', '{\"@group_sepuluh27\":\"-100820241027\",\"@group_sepuluh23\":\"-102209082024\"}', '{\"senin\":\"1\",\"rabu\":\"3\",\"jumat\":\"5\"}', '16:21:00', 'on', '2024-08-23 08:21:03', NULL),
('66c846e9b5ea6', '66c840998526c', '{\"@group_sepuluh27\":\"-100820241027\",\"@group_sepuluh26\":\"-100820241026\"}', '{\"jumat\":\"5\",\"sabtu\":\"6\"}', '17:25:00', 'on', '2024-08-23 08:23:05', NULL),
('66c84747d5bb4', '66c83c461b9f4', '{\"@group_sepuluh27\":\"-100820241027\",\"@group_sembilan46\":\"-102409082024\"}', '{\"jumat\":\"5\",\"sabtu\":\"6\"}', '20:29:00', 'on', '2024-08-23 08:24:39', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `nama`, `username`, `created_at`, `updated_at`) VALUES
('-100820241010', 'Group Sepuluh 10', '@group_sepuluh10', '2024-08-23 08:52:44', NULL),
('-100820241011', 'Group Sepuluh 11', '@group_sepuluh11', '2024-08-10 03:11:43', NULL),
('-100820241024', 'Group Sepuluh 24', '@group_sepuluh24', '2024-08-10 03:24:31', NULL),
('-100820241025', 'Group Sepuluh 25', '@group_sepuluh25', '2024-08-10 03:25:20', NULL),
('-100820241026', 'Group Sepuluh 26', '@group_sepuluh26', '2024-08-10 03:26:07', NULL),
('-100820241027', 'Group Sepuluh 27', '@group_sepuluh27', '2024-08-10 03:27:15', NULL),
('-102409082024', 'Group Sembilan 46', '@group_sembilan46', '2024-08-09 03:24:03', NULL),
('-230820241542', 'Group Limabelas 42', '@group_limabelas42', '2024-08-23 08:43:04', NULL),
('-230820241548', 'Group Limbelas 48', '@group_limabelas48', '2024-08-23 08:48:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`id`, `judul`, `pesan`, `created_at`, `updated_at`) VALUES
('66a9e4125a100', 'Apa itu Pesan ?', 'Pesan adalah salah satu bentuk komunikasi yang paling mendasar dan penting dalam kehidupan kita sehari-hari. Dengan mengirim pesan, kita bisa menyampaikan informasi, perasaan, dan pikiran kita kepada orang lain dengan cepat dan efisien. Di era digital ini, pesan dapat dikirim melalui berbagai platform seperti SMS, email, dan aplikasi chatting, yang memungkinkan kita tetap terhubung meskipun berada jauh satu sama lain.', '2024-07-31 07:13:22', '2024-08-23 07:57:48'),
('66b6d51edb0d4', 'Apa itu jQuery ?', 'jQuery adalah pustaka JavaScript yang dirancang untuk memudahkan penulisan kode JavaScript, terutama dalam hal manipulasi HTML, penanganan peristiwa (events), animasi, dan AJAX. Diperkenalkan pada tahun 2006 oleh John Resig, jQuery menjadi sangat populer karena sintaksnya yang sederhana dan kemampuannya untuk mengatasi berbagai masalah kompatibilitas antar browser.', '2024-08-10 02:49:02', '2024-08-10 03:17:57'),
('66c83c461b9f4', 'Pengertian JSON', 'JSON, singkatan dari JavaScript Object Notation, adalah suatu format ringkas pertukaran data komputer. Formatnya berbasis teks dan terbaca-manusia serta digunakan untuk merepresentasikan struktur data sederhana dan larik asosiatif.', '2024-08-23 07:37:42', '2024-08-23 07:37:42'),
('66c83d0218779', 'Pengertian XML', 'XML (Extensible Markup Language) adalah bahasa markup yang menyediakan aturan untuk mendefinisikan data apa pun. XML dapat digunakan untuk mendeskripsikan data dalam format yang dapat dibaca oleh manusia maupun mesin. XML mendukung pertukaran informasi antara sistem komputer, seperti situs web, basis data, dan aplikasi pihak ketiga. ', '2024-08-23 07:40:50', '2024-08-23 07:40:50'),
('66c83e499d9cc', 'pengertian HTML', 'HTML (Hypertext Markup Language) adalah bahasa pemrograman yang digunakan untuk membuat halaman web yang ditampilkan di browser. HTML mengatur struktur halaman web dengan menggunakan tag yang memiliki fungsi dan peran masing-masing. Misalnya, tag <html> menandai awal dokumen HTML, tag <head> dan <body> menentukan bagian kepala dan isi dokumen, dan simbol garis miring digunakan untuk mengakhiri tag dan dokumen HTML.', '2024-08-23 07:46:17', '2024-08-23 07:56:44'),
('66c840998526c', 'Pengertian CSS', 'CSS (Cascading Style Sheets) adalah bahasa pemrograman style sheet yang digunakan untuk menata dan menyusun halaman web (HTML atau XML). CSS membantu mengkonfigurasi dan mengelola tampilan serta pemformatan dokumen yang dibuat dalam bahasa markup. CSS dapat digunakan untuk menentukan gaya dari tampilan website, seperti tata letak halaman, warna, dan font. CSS juga dapat digunakan untuk memisahkan konten dari visual representation pada website.', '2024-08-23 07:56:09', '2024-08-23 07:56:09'),
('66c842ce98a61', 'Pengertian Function', 'Function (fungsi) adalah bagian dari program yang memiliki nama tertentu dan digunakan untuk mengerjakan suatu pekerjaan tertentu. Function biasanya memiliki algoritma pemrograman di dalamnya dan dapat dipanggil berkali-kali dalam program. ', '2024-08-23 08:05:34', '2024-08-23 08:05:34'),
('66c84c051dadc', 'Apa itu Telegram ?', 'Telegram adalah aplikasi pesan instan gratis, berbasis cloud, dan lintas platform. Aplikasi ini fokus pada keamanan dan kecepatan, dan dapat digunakan untuk mengirim pesan teks, audio, video, gambar, stiker, dan jenis file lainnya. Telegram tersedia untuk berbagai perangkat dan sistem operasi, seperti Android, iOS, Windows Phone, Ubuntu Touch, serta Windows, MacOS X, dan Linux untuk komputer.', '2024-08-23 08:44:53', '2024-08-23 08:44:53'),
('66c84c775c94b', 'Apa itu HTTP ?', 'Hypertext Transfer Protocol (HTTP) adalah protokol lapisan aplikasi yang digunakan untuk mentransfer data antar perangkat jaringan, seperti antara komputer dan server. HTTP adalah dasar dari World Wide Web (WWW) dan digunakan untuk memuat halaman web menggunakan link hypertext. HTTP juga menyediakan kumpulan perintah untuk komunikasi antar jaringan antara web server dan komputer client.', '2024-08-23 08:46:47', '2024-08-23 08:46:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_email`) VALUES
('66695372e34a6', '82'),
('666953baeae0f', '82'),
('666954319df50', '82'),
('66692021cf430', 'blqs2103@mail.com'),
('66c1b0aeabfbf', 'irfan_em@gmail.com'),
('6684c729bc720', 'progamerxml@gmail.com'),
('66c3ee7e5cc7b', 'progamerxml@gmail.com'),
('66c421c192c97', 'progamerxml@gmail.com'),
('66c83c1637960', 'progamerxml@gmail.com'),
('66c84e715f19b', 'progamerxml@gmail.com'),
('666954805972c', 'test_person1@user.com'),
('666a5e64c8c0f', 'test_person1@user.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `level`, `created_at`, `updated_at`) VALUES
(101, 'Test Person 1', 'person1@user.com', 'rahasia', 0, '2024-07-08 07:36:21', NULL),
(102, 'Progammer Anyaran', 'progamerxml@gmail.com', '$2y$10$8.TS92FFwZvddhF0ldayQuDg0laVSyNlQTNt7z9hZ.kDrCGgeIL6O', 0, '2024-07-08 07:36:45', NULL),
(103, 'Irfan M', 'irfan_em@gmail.com', '$2y$10$HQHukp3hRCz6RwPOOcTknOOY5bMgr3dp4nyuIp.ISYTE15ZFMl6qe', 0, '2024-08-01 02:12:41', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `broadcast_messages`
--
ALTER TABLE `broadcast_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `broadcast_messages_id_pesan_foreign` (`id_pesan`),
  ADD KEY `broadcast_messages_id_group_foreign` (`id_group`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sessions_user` (`user_email`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
