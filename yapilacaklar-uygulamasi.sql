-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 May 2023, 08:45:30
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `yapilacaklar-uygulamasi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yapilacaklar`
--

CREATE TABLE `yapilacaklar` (
  `id` int(11) UNSIGNED NOT NULL,
  `gorevler` varchar(255) NOT NULL,
  `durum` enum('0','1') NOT NULL,
  `tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yapilacaklar`
--

INSERT INTO `yapilacaklar` (`id`, `gorevler`, `durum`, `tarih`) VALUES
(6, 'Ekleme İşlemi Yaptırılacak', '0', '2023-05-10'),
(7, 'Güncelleme İşlemi Yaptırılacak', '0', '2023-05-10'),
(8, 'Silme İşlemi Yaptırılacak', '0', '2023-05-10'),
(9, 'Bu projeyi Github&#039;a yükle', '0', '2023-05-11');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `yapilacaklar`
--
ALTER TABLE `yapilacaklar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `yapilacaklar`
--
ALTER TABLE `yapilacaklar`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
