-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 28 apr 2021 om 12:09
-- Serverversie: 10.4.8-MariaDB
-- PHP-versie: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
) ;

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
(1, 'Testnaam', '', 'Testachternaam');

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
  `kinderen4_12` int(11) NOT NULL,
  `huisdier` tinyint(1) NOT NULL,
  `elektriciteit` tinyint(1) NOT NULL,
  `douche` int(11) NOT NULL,
  `wasmachine` tinyint(1) NOT NULL,
  `wasdroger` tinyint(1) NOT NULL,
  `caravan_klein` tinyint(1) NOT NULL,
  `caravan_groot` tinyint(1) NOT NULL,
  `tent_klein` tinyint(1) NOT NULL,
  `tent_groot` tinyint(1) NOT NULL,
  `auto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `reserveringen`
--

INSERT INTO `reserveringen` (`reservering_id`, `klant_id`, `plaatsnummer`, `begin_datum`, `eind_datum`, `kinderen4_12`, `huisdier`, `elektriciteit`, `douche`, `wasmachine`, `wasdroger`, `caravan_klein`, `caravan_groot`, `tent_klein`, `tent_groot`, `auto`) VALUES
(1, 1, 1, '2021-05-01 12:00:00', '2021-05-07 12:00:00', 2, 1, 1, 4, 1, 0, 1, 0, 0, 0, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klant_id`);

--
-- Indexen voor tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD PRIMARY KEY (`reservering_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accountgegevens`
--
ALTER TABLE `accountgegevens`
  MODIFY `gebruikers_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  MODIFY `reservering_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
