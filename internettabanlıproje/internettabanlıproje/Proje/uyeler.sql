-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 May 2024, 20:44:11
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
-- Veritabanı: `uyeler`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hareket_kontrol`
--

CREATE TABLE `hareket_kontrol` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `is_baslama_saati` datetime NOT NULL,
  `is_bitis_saati` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hareket_kontrol`
--

INSERT INTO `hareket_kontrol` (`id`, `ad`, `soyad`, `is_baslama_saati`, `is_bitis_saati`) VALUES
(13, 'elif', 'öz', '2024-05-07 17:02:57', '2024-05-07 17:03:06');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hedefler`
--

CREATE TABLE `hedefler` (
  `id` int(6) UNSIGNED NOT NULL,
  `hedef_satis` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `hedefler`
--

INSERT INTO `hedefler` (`id`, `hedef_satis`) VALUES
(1, 20),
(2, 9000),
(3, 9000),
(4, 9000),
(5, 9000),
(6, 9000),
(7, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `id` int(11) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `kayit_tarihi` datetime NOT NULL,
  `kullanici_tc` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `sifre`, `kayit_tarihi`, `kullanici_tc`) VALUES
(9, '485648484', '0000-00-00 00:00:00', '92895589345'),
(10, '123456', '0000-00-00 00:00:00', '92895589345'),
(11, '4854184', '0000-00-00 00:00:00', '92895589345'),
(12, '4854184', '0000-00-00 00:00:00', '92895589345'),
(13, '4657146571', '0000-00-00 00:00:00', '92895589345'),
(14, '46548484', '0000-00-00 00:00:00', '92895589345'),
(15, '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `molalar`
--

CREATE TABLE `molalar` (
  `id` int(11) NOT NULL,
  `mola_saati` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `molalar`
--

INSERT INTO `molalar` (`id`, `mola_saati`) VALUES
(1, '12:00:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personel`
--

CREATE TABLE `personel` (
  `id` int(11) NOT NULL,
  `isim` varchar(50) DEFAULT NULL,
  `soyisim` varchar(50) DEFAULT NULL,
  `calisma_saati` float DEFAULT NULL,
  `musteri_sayisi` int(11) DEFAULT NULL,
  `hafta_ici_saatlik_ucret` float DEFAULT NULL,
  `hafta_sonu_saatlik_ucret` float DEFAULT NULL,
  `yemek_ucreti` float DEFAULT NULL,
  `yol_ucreti` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `saglik_durumu`
--

CREATE TABLE `saglik_durumu` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) DEFAULT NULL,
  `soyad` varchar(50) DEFAULT NULL,
  `saglik_bilgisi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `saglik_durumu`
--

INSERT INTO `saglik_durumu` (`id`, `ad`, `soyad`, `saglik_bilgisi`) VALUES
(39, 'ali', 'öz', 'proje yönetimi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satislar`
--

CREATE TABLE `satislar` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) DEFAULT NULL,
  `soyad` varchar(50) DEFAULT NULL,
  `satis_miktari` decimal(10,2) DEFAULT NULL,
  `hedef` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `satislar`
--

INSERT INTO `satislar` (`id`, `ad`, `soyad`, `satis_miktari`, `hedef`) VALUES
(25, 'Elif', 'Öz', 2000.00, 0),
(26, 'Hakan', 'Fidan', 1236.00, 0),
(27, 'Ece', 'Kurt', 1532.00, 0),
(28, 'Sibel', 'Can', 2120.00, 0),
(29, 'Özcan', 'Su', 2178.00, 0),
(30, 'Melisa', 'Selinay', 1298.00, 0),
(31, 'Aynur', 'Allar', 1324.00, 0),
(32, 'Beyza', 'Kocaman', 1324.00, 0),
(40, 'elif', 'fidan', 1324.00, 0),
(44, '', '', 0.00, 0),
(45, '', '', 0.00, 0),
(46, '', '', 0.00, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hareket_kontrol`
--
ALTER TABLE `hareket_kontrol`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hedefler`
--
ALTER TABLE `hedefler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `molalar`
--
ALTER TABLE `molalar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `personel`
--
ALTER TABLE `personel`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `saglik_durumu`
--
ALTER TABLE `saglik_durumu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `satislar`
--
ALTER TABLE `satislar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `hareket_kontrol`
--
ALTER TABLE `hareket_kontrol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `hedefler`
--
ALTER TABLE `hedefler`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `molalar`
--
ALTER TABLE `molalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `personel`
--
ALTER TABLE `personel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `saglik_durumu`
--
ALTER TABLE `saglik_durumu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Tablo için AUTO_INCREMENT değeri `satislar`
--
ALTER TABLE `satislar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
