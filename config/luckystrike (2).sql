-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 nov 2023 om 12:47
-- Serverversie: 10.4.20-MariaDB
-- PHP-versie: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luckystrike`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `food`
--

INSERT INTO `food` (`id`, `name`, `price`) VALUES
(1, 'koffie', '1.00'),
(2, 'Chocomelk', '1.50'),
(4, 'Slagroom', '0.50'),
(5, 'Cola', '2.00'),
(6, 'Cola zero', '2.00'),
(7, 'Cola light', '2.00'),
(8, 'thee', '1.00'),
(9, 'Cappuccino', '1.50'),
(10, 'Fanta	', '2.00'),
(11, 'Cassis', '2.00'),
(12, 'Ginger Ale', '2.25	'),
(13, 'Ranja	', '0.25'),
(14, 'Pitcher Ranja (1,5 L)', '1.00	'),
(15, 'Red Bull', '3.00	'),
(16, 'Bier (tap)', '2.00	'),
(17, 'Liefmans / Radler	', '2.30'),
(18, 'Corona / Weizener', '3.50	'),
(19, 'Hugo', '2.50	'),
(20, 'Wijn (Rosé)', '2.50	'),
(21, 'Wijn (droog)', '2.50	'),
(22, 'Wijn (zoet)', '2.50'),
(23, 'Wijn (Rood)', '3.00	'),
(24, 'zakje chips (naturel)', '0.75	'),
(25, 'zakje chips (paprika)', '0.75	'),
(26, 'Zakje snoep', '1.00	'),
(27, 'Friet zonder', '1.50	'),
(28, 'Friet zonder groot', '2.00	'),
(29, 'Supertje', '2.75	'),
(30, 'Sausje (Mayo, Ketchup, Curry)	', '0.25 p/st'),
(31, 'Sate saus', '0.75	'),
(32, 'Frikandel', '1.25	'),
(33, 'Kroket', '1.25	'),
(34, 'Bamiblok', '1.50	'),
(35, 'Kaassoufle', '1.50	'),
(48, 'Mexicano', '1.75	'),
(49, 'Kipcorn', '1.75	'),
(50, 'Gehaktbal (Jus)', '2.00	'),
(51, 'Sateetje', '4.00	'),
(52, 'Schaal snacks klein (15 stuks)', '6.00	'),
(53, 'Schaal snacks groot (24 stuks)', '9.00	'),
(54, 'Schaal vlammetjes (12 stuks)', '6.00	');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lane`
--

CREATE TABLE `lane` (
  `id` int(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `gates` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ordering`
--

CREATE TABLE `ordering` (
  `id` int(11) NOT NULL,
  `foodId` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservation`
--

CREATE TABLE `reservation` (
  `id` int(30) NOT NULL,
  `userId` int(30) NOT NULL,
  `baanId` int(30) NOT NULL,
  `orderingId` int(30) NOT NULL,
  `price` varchar(25) NOT NULL,
  `starttijd` datetime(6) NOT NULL,
  `stoptijd` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  `klasse` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `klasse`) VALUES
(1, 'admin@admin.com', 'admin', '123', 3);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `lane`
--
ALTER TABLE `lane`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT voor een tabel `lane`
--
ALTER TABLE `lane`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `ordering`
--
ALTER TABLE `ordering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
