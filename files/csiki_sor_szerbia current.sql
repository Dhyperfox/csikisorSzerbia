-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Ápr 25. 18:02
-- Kiszolgáló verziója: 10.1.37-MariaDB
-- PHP verzió: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `csiki sor szerbia current`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `id` int(8) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'uveges',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'csiki sor',
  `price` int(10) UNSIGNED NOT NULL DEFAULT '200',
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '\\projekt2020_II\\images\\csikisor_large.jpg',
  `availability` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `price`, `photo`, `availability`) VALUES
(1, 'uveges', 'csiki sor (barna)', 200, '\\projekt2020_II\\images\\barna_large.jpg', 1),
(2, 'uveges', 'csiki sor (vadmalna)', 250, '\\projekt2020_II\\images\\vadmalna_large.jpg', 1),
(3, 'dobozos', 'dobozos csiki', 250, '\\projekt2020_II\\images\\dobozoscsiki_large.jpg', 1),
(4, 'uveges', 'szekely sor', 250, '\\projekt2020_II\\images\\szekely_large.jpg', 0),
(5, 'uveges', 'csiki(krem)', 250, '\\projekt2020_II\\images\\krem_large.jpg', 0),
(6, 'uveges', 'csiki szuretlen sor', 500, '\\projekt2020_II\\images\\szuretlen_large.jpg', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(4) NOT NULL,
  `tipus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `tipus`) VALUES
(2, 'csalo', 'tapi', 'user'),
(3, 'hyperfox', '1', 'user');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `phone` smallint(10) NOT NULL,
  `zip` smallint(5) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `active` binary(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `hash`, `phone`, `zip`, `city`, `address`, `active`) VALUES
(57, '16219115', 'root@localhost.com', '$2y$10$4ZIOyodaAddHUbHvLAyEN.KFETOyu0Gzuv7fgh0.MUc3s9uR89r6K', '$2y$10$HGd7gIVZbLM3ax6CFexZzu05I05lCBaGRidgPkbzeVyQQ/K3YTiyG', 32767, 24000, 'Subotica', 'Marijina 14, Subotica, Serbia', 0x31);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
