-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 14 Kas 2025, 12:07:31
-- Sunucu sürümü: 8.0.41
-- PHP Sürümü: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `image_upload`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `banner_ads`
--

CREATE TABLE `banner_ads` (
  `id` int NOT NULL,
  `top1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `top2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `top4` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `top5` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `top1_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `top2_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `top4_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `top5_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `banner_ads`
--

INSERT INTO `banner_ads` (`id`, `top1`, `top2`, `top4`, `top5`, `top1_link`, `top2_link`, `top4_link`, `top5_link`) VALUES
(1, 'assets/img/301212008831343C (1).svg', 'assets/img/280542293931343C (1).svg', 'assets/img/315682087531343C (1).svg', 'assets/img/243682545031343C (1).svg', '#', '#', '#', '#');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `icon` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `title` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `content` text COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `contacts`
--

INSERT INTO `contacts` (`id`, `icon`, `title`, `content`) VALUES
(1, 'fa-solid fa-envelope', 'E-Mail Adresimiz', 'site@site.com'),
(2, 'fa-solid fa-envelope', 'Telegram Adresimiz', '@telegram');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `design`
--

CREATE TABLE `design` (
  `id` int NOT NULL,
  `logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `favicon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `metakeyword` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `metadesc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `home_title` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `home_content` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `home_footer` text COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `design`
--

INSERT INTO `design` (`id`, `logo`, `favicon`, `title`, `metakeyword`, `metadesc`, `home_title`, `home_content`, `home_footer`) VALUES
(1, 'assets/img/2382628220Ekran görüntüsü 2025-11-14 141530.png', 'assets/img/2290623872Ekran görüntüsü 2025-11-14 141530.png', 'Resim Upload Scripti', 'html, css, js', 'Resim Upload Scripti', 'Lorem Ipsum', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque cumque quos nam similique illum enim quibusdam ea atque beatae consequatur esse dolorum, praesentium consequuntur nesciunt suscipit quas voluptate, natus fugiat.\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Eaque cumque quos nam similique illum enim quibusdam ea atque beatae consequatur esse dolorum, praesentium consequuntur nesciunt suscipit quas voluptate, natus\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Eaque cumque quos nam similique illum enim quibusdam ea atque beatae consequatur esse dolorum, praesentium consequuntur nesciunt suscipit quas voluptate, natus fugiat.', '© 2025 Dori Bilişim');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `img` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `token` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `tarih` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` text COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `images`
--

INSERT INTO `images` (`id`, `img`, `token`, `tarih`, `ip`) VALUES
(3, 'assets/upload_images/3093028619banner-2-bg.jpg', '3b8d3a25ccc2aa8d3272b06f0b7e0f7f', '2025-10-13 09:01:58', '::1'),
(4, 'assets/upload_images/2519322647banner-2-bg.jpg', 'ef662da0a5ea181354f067be35ec4aa5', '2025-10-13 09:04:30', '::1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `name` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `surname` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `phone` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `message` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `tarih` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` text COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`id`, `name`, `surname`, `email`, `phone`, `message`, `tarih`, `ip`) VALUES
(1, 'Özgür', 'Daizy', 'admin@admin.com', '5449435919', 'asdasdsa', '2025-10-13 11:49:51', ''),
(2, 'Ahmet', 'Daizy', 'admin@admin.com', '5449435919', 'asdasdsa', '2025-10-13 11:51:56', '::1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `surname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `mail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `user_type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `mail`, `password`, `user_type`, `token`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 'P0T4P3L3L7K5A1N950G7');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `banner_ads`
--
ALTER TABLE `banner_ads`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `design`
--
ALTER TABLE `design`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `banner_ads`
--
ALTER TABLE `banner_ads`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `design`
--
ALTER TABLE `design`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
