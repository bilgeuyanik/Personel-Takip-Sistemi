-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 May 2024, 20:56:40
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
-- Veritabanı: `mola_sistemi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mola`
--

CREATE TABLE `mola` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(50) NOT NULL,
  `saat_araligi` time NOT NULL,
  `mola_alindi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `mola`
--

INSERT INTO `mola` (`id`, `ad_soyad`, `saat_araligi`, `mola_alindi`) VALUES
(31, 'Yavuz Yıldıran', '00:00:00', '0'),
(32, 'Elif Elçi', '00:00:00', '0'),
(38, 'Ahmet Arıcı', '00:00:00', '0'),
(40, 'Ali Al', '00:00:00', '0'),
(63, 'Ela Türker', '09:00:00', '0'),
(66, 'Levent  Arslan', '09:00:00', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mola_saatleri`
--

CREATE TABLE `mola_saatleri` (
  `id` int(6) UNSIGNED NOT NULL,
  `saat_araligi` varchar(255) NOT NULL,
  `alindi_mi` tinyint(1) DEFAULT 0,
  `ad_soyad` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `mola_saatleri`
--

INSERT INTO `mola_saatleri` (`id`, `saat_araligi`, `alindi_mi`, `ad_soyad`) VALUES
(1, '09:00-10:00', 1, 'Levent  Arslan'),
(2, '10:00-11:00', 1, 'Ela Türker'),
(3, '11:00-12:00', 1, 'Yavuz Yıldıran'),
(4, '12:00-13:00', 1, 'Ahmet Arıcı'),
(5, '13:00-14:00', 1, 'elif elçi'),
(6, '14:00-15:00', 0, NULL),
(7, '15:00-16:00', 0, NULL),
(8, '16:00-17:00', 1, 'Ali Al');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `mola`
--
ALTER TABLE `mola`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mola_saatleri`
--
ALTER TABLE `mola_saatleri`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `mola`
--
ALTER TABLE `mola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Tablo için AUTO_INCREMENT değeri `mola_saatleri`
--
ALTER TABLE `mola_saatleri`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
