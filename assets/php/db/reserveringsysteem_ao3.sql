-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 jun 2021 om 22:44
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reserveringsysteem_ao3`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accountgegevens`
--

CREATE TABLE `accountgegevens` (
  `gebruikers_id` int(255) NOT NULL,
  `gebruikersnaam` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `rechten` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `accountgegevens`
--

INSERT INTO `accountgegevens` (`gebruikers_id`, `gebruikersnaam`, `email`, `wachtwoord`, `rechten`) VALUES
(3, 'test', 'test@test.com', '$2y$10$Qr5.fP0WP5elKM/6g3CRZuo.nkQ6iY47mwWiZfDyxz8sQXxm6ExKC', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klant_id` int(11) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `tussenvoegsel` varchar(50) NOT NULL,
  `achternaam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klant_id`, `voornaam`, `tussenvoegsel`, `achternaam`) VALUES
(44, 'Jan', 'van', 'Gugten'),
(45, 'Maide', 'de ', 'Gouw'),
(46, 'Victor', '', 'Philippo'),
(47, 'test', '', 'test'),
(48, 'tat', '', 'tat'),
(49, 'Bob', '', 'Hendriks'),
(50, 'Henk', 'de', 'Water');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `plaatsen`
--

CREATE TABLE `plaatsen` (
  `plaatsnummer` int(11) NOT NULL,
  `grootte` tinyint(1) NOT NULL,
  `elektriciteit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `plaatsen`
--

INSERT INTO `plaatsen` (`plaatsnummer`, `grootte`, `elektriciteit`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 1),
(7, 1, 1),
(8, 1, 1),
(9, 1, 1),
(10, 1, 1),
(11, 1, 1),
(12, 1, 1),
(13, 1, 1),
(14, 1, 1),
(15, 1, 1),
(16, 0, 1),
(17, 0, 1),
(18, 0, 1),
(19, 0, 1),
(20, 0, 1),
(21, 0, 1),
(22, 0, 1),
(23, 0, 1),
(24, 0, 1),
(25, 0, 1),
(26, 1, 0),
(27, 1, 0),
(28, 1, 0),
(29, 1, 0),
(30, 1, 0),
(31, 1, 0),
(32, 1, 0),
(33, 1, 0),
(34, 1, 0),
(35, 1, 0),
(36, 1, 0),
(37, 1, 0),
(38, 1, 0),
(39, 1, 0),
(40, 1, 0),
(41, 0, 0),
(42, 0, 0),
(43, 0, 0),
(44, 0, 0),
(45, 0, 0),
(46, 0, 0),
(47, 0, 0),
(48, 0, 0),
(49, 0, 0),
(50, 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveringen`
--

CREATE TABLE `reserveringen` (
  `reservering_id` int(11) NOT NULL,
  `klant_id` int(11) NOT NULL,
  `plaatsnummer` int(11) NOT NULL,
  `begin_datum` datetime NOT NULL,
  `eind_datum` datetime NOT NULL,
  `volwassene` int(11) NOT NULL,
  `kinderen4_12` int(11) NOT NULL,
  `huisdier` tinyint(1) NOT NULL,
  `douche` int(11) NOT NULL,
  `wasmachine` tinyint(1) NOT NULL,
  `wasdroger` tinyint(1) NOT NULL,
  `verblijf` tinyint(1) NOT NULL,
  `auto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `reserveringen`
--

INSERT INTO `reserveringen` (`reservering_id`, `klant_id`, `plaatsnummer`, `begin_datum`, `eind_datum`, `volwassene`, `kinderen4_12`, `huisdier`, `douche`, `wasmachine`, `wasdroger`, `verblijf`, `auto`) VALUES
(31, 49, 2, '2021-06-10 21:55:00', '2021-06-16 21:55:00', 2, 2, 1, 2, 0, 1, 1, 0),
(32, 50, 22, '2021-06-04 22:09:00', '2021-06-11 22:09:00', 2, 4, 1, 7, 0, 1, 1, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klant_id`);

--
-- Indexen voor tabel `plaatsen`
--
ALTER TABLE `plaatsen`
  ADD PRIMARY KEY (`plaatsnummer`);

--
-- Indexen voor tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD PRIMARY KEY (`reservering_id`),
  ADD KEY `klant_id` (`klant_id`,`plaatsnummer`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT voor een tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  MODIFY `reservering_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
