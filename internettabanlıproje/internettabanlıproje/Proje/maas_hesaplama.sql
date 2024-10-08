-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 May 2024, 20:56:14
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `maas_hesaplama`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayin_elemani`
--

CREATE TABLE `ayin_elemani` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(50) NOT NULL,
  `satis_sayisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ayin_elemani`
--

INSERT INTO `ayin_elemani` (`id`, `ad_soyad`, `satis_sayisi`) VALUES
(5, 'Ela Türker', 2000),
(8, 'Yavuz Yıldıran', 1008),
(9, 'Ali Al', 1232),
(10, 'elif elçi', 1456),
(11, 'Reyhan Ünlü', 1274),
(12, 'Ceren Kurhan', 1472),
(13, 'Bekir Atmaca', 1358),
(14, 'Bilge Güler', 1024),
(15, 'Ece Kurtar', 1013),
(16, 'Ahmet Arıcı', 1123),
(18, 'Ahmet Arıcı', 1123),
(19, 'Levent  Arslan', 2500),
(20, 'Ahmet Arıcı', 3000);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `maas`
--

CREATE TABLE `maas` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(25) NOT NULL,
  `hafta_ici_ucret` int(11) NOT NULL,
  `hafta_sonu_ucret` int(11) NOT NULL,
  `prim` int(11) NOT NULL,
  `yol_yemek_ucreti` int(11) NOT NULL,
  `Maas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `maas`
--

INSERT INTO `maas` (`id`, `ad_soyad`, `hafta_ici_ucret`, `hafta_sonu_ucret`, `prim`, `yol_yemek_ucreti`, `Maas`) VALUES
(30, 'Levent  Arslan', 7000, 3000, 2500, 8000, 20500),
(31, 'Ela Türker', 7000, 3000, 0, 8000, 18000),
(32, 'Ahmet Arıcı', 7000, 3000, 2500, 4500, 17000),
(33, 'Bekir Atmaca', 9000, 3750, 0, 500, 13250),
(34, 'Reyhan Ünlü', 3000, 2025, 2500, 2800, 10325),
(35, 'Ece Kurtar', 12000, 2400, 2500, 2460, 19360),
(36, 'Bilge Güler', 8880, 3240, 2500, 2000, 16620),
(37, 'Ceren Kurhan', 7500, 2250, 2500, 1200, 13450),
(38, 'Ceren Kurhan', 7500, 2250, 2500, 1200, 13450),
(39, 'Ceren Kurhan', 7500, 2250, 2500, 1200, 13450),
(40, 'Ceren Kurhan', 7500, 2250, 2500, 1200, 13450),
(41, 'Ceren Kurhan', 7500, 2250, 2500, 1200, 13450),
(42, 'Ceren Kurhan', 7500, 2250, 2500, 1200, 13450),
(43, 'Ceren Kurhan', 7500, 2250, 2500, 1200, 13450),
(44, 'Ceren Kurhan', 7500, 2250, 2500, 1200, 13450);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayin_elemani`
--
ALTER TABLE `ayin_elemani`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `maas`
--
ALTER TABLE `maas`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayin_elemani`
--
ALTER TABLE `ayin_elemani`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `maas`
--
ALTER TABLE `maas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
