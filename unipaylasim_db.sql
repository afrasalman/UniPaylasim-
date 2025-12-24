-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2025 at 09:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unipaylasim_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `eposta` varchar(100) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `rol` enum('ogrenci','admin') DEFAULT 'ogrenci',
  `profil_foto` varchar(255) DEFAULT NULL,
  `kayit_tarihi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `ad`, `soyad`, `eposta`, `sifre`, `rol`, `profil_foto`, `kayit_tarihi`) VALUES
(3, 'Deneme', '', 'deneme@gmail.com', 'deneme1234', 'ogrenci', NULL, '2025-12-18 07:31:16'),
(4, 'yeni', 'ogrenci', 'ogrenci1@gmail.com', '$2y$10$tfvSBeST0tvQhIzMsvrsh.llQ44yCQOaQKic0Ye28XcY.8sXAuSU.', 'ogrenci', NULL, '2025-12-18 10:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `notlar`
--

CREATE TABLE `notlar` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `ders_adi` varchar(100) NOT NULL,
  `hoca_adi` varchar(100) NOT NULL,
  `bolum` varchar(100) NOT NULL,
  `sinif` int(2) NOT NULL,
  `donem` enum('Güz','Bahar') NOT NULL,
  `aciklama` text DEFAULT NULL,
  `dosya_yolu` varchar(255) NOT NULL,
  `yukleme_tarihi` timestamp NOT NULL DEFAULT current_timestamp(),
  `indir_sayisi` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notlar`
--

INSERT INTO `notlar` (`id`, `kullanici_id`, `ders_adi`, `hoca_adi`, `bolum`, `sinif`, `donem`, `aciklama`, `dosya_yolu`, `yukleme_tarihi`, `indir_sayisi`) VALUES
(1, 4, 'intermet tabanlı programlama', 'Serkan Aksu', 'Bilgisayar programcılığı', 2, 'Güz', NULL, '1766069627_2. dersi_PHP_Yazım_Kuralları.pdf', '2025-12-18 14:53:47', 0),
(2, 4, 'Nesne Tabanlı programlama', 'Utku Sobutay', 'Bilgisayar programcılığı', 2, 'Güz', NULL, '1766086548_4.dersi_ Java Veri Tipleri .pdf', '2025-12-18 19:35:48', 2),
(3, 4, 'Algoritma ve Programlama 2', 'Fatih Dinç', 'Bilgisayar programcılığı', 1, 'Bahar', NULL, '1766087167_5. dersi_Operatorler.pdf', '2025-12-18 19:46:07', 0),
(4, 4, 'intermet tabanlı programlama', 'Serkan Aksu', 'Bilgisayar programcılığı', 2, 'Güz', 'PHP programlama dilinin temel yazım kuralları (syntax), değişken tanımlama ve echo/print kullanımını içeren kısa ve öz çalışma notu', '1766090547_2. dersi_PHP_Yazım_Kuralları.pdf', '2025-12-18 20:42:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `not_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `yorum` text NOT NULL,
  `yorum_tarihi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eposta` (`eposta`);

--
-- Indexes for table `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Indexes for table `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `not_id` (`not_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notlar`
--
ALTER TABLE `notlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notlar`
--
ALTER TABLE `notlar`
  ADD CONSTRAINT `notlar_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`not_id`) REFERENCES `notlar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yorumlar_ibfk_2` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
