-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 07. Dez 2022 um 14:04
-- Server-Version: 8.0.31-0ubuntu0.22.04.1
-- PHP-Version: 8.1.2-1ubuntu2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cv_sandbox`
--
CREATE DATABASE IF NOT EXISTS `cv_sandbox` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `cv_sandbox`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `content`
--

CREATE TABLE `content` (
  `ID` tinyint NOT NULL,
  `structure_id` varchar(3) NOT NULL DEFAULT '1',
  `page_deutsch` text NOT NULL,
  `page_english` text NOT NULL,
  `deutsch` text,
  `english` text,
  `lastchanged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `content`
--

INSERT INTO `content` (`ID`, `structure_id`, `page_deutsch`, `page_english`, `deutsch`, `english`, `lastchanged`) VALUES
(1, '1', 'startseite', 'homepage', '<div>Startseite</div>', '<div>Homepage</div>', '2022-12-07 09:53:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `motivation_content`
--

CREATE TABLE `motivation_content` (
  `ID` tinyint NOT NULL,
  `token` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1',
  `content_deutsch` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content_english` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deutsch` text,
  `english` text,
  `lastchanged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `structure`
--

CREATE TABLE `structure` (
  `ID` tinyint NOT NULL,
  `page_deutsch` text NOT NULL,
  `page_english` text NOT NULL,
  `target_deutsch` text,
  `target_english` text,
  `canonical_deutsch` text,
  `canonical_english` text,
  `lastchanged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `structure`
--

INSERT INTO `structure` (`ID`, `page_deutsch`, `page_english`, `target_deutsch`, `target_english`, `canonical_deutsch`, `canonical_english`, `lastchanged`) VALUES
(1, 'Startseite', 'Homepage', 'index.php?page=startseite&language=deutsch&token=0efa745f21eb127178899a6343a29242', 'index.php?page=homepage&language=english&token=0efa745f21eb127178899a6343a29242', 'startseite', 'homepage', '2022-12-07 09:53:47');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `motivation_content`
--
ALTER TABLE `motivation_content`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `structure`
--
ALTER TABLE `structure`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `content`
--
ALTER TABLE `content`
  MODIFY `ID` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `motivation_content`
--
ALTER TABLE `motivation_content`
  MODIFY `ID` tinyint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `structure`
--
ALTER TABLE `structure`
  MODIFY `ID` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
