-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Sep 2018 um 17:00
-- Server-Version: 10.1.36-MariaDB
-- PHP-Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `resbes`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE `bestellung` (
  `id` int(11) NOT NULL,
  `tisch_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gericht`
--

CREATE TABLE `gericht` (
  `id` int(11) NOT NULL,
  `kategorie_id` int(2) NOT NULL,
  `preis` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `gericht`
--

INSERT INTO `gericht` (`id`, `kategorie_id`, `preis`) VALUES
(1, 1, 3.5),
(2, 1, 4.5),
(3, 1, 2.2),
(4, 2, 6),
(5, 2, 5.4),
(6, 2, 7.5),
(7, 3, 12.5),
(8, 3, 21),
(9, 3, 9.5),
(10, 4, 4),
(11, 4, 6.5),
(12, 4, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gericht_details`
--

CREATE TABLE `gericht_details` (
  `id` int(11) NOT NULL,
  `gericht_id` int(11) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `beschreibung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `gericht_details`
--

INSERT INTO `gericht_details` (`id`, `gericht_id`, `lang`, `name`, `beschreibung`) VALUES
(1, 1, 'de', 'Cola', '0,5L'),
(2, 1, 'en', 'Coke', '0,5L'),
(3, 2, 'de', 'Pils', 'Bier'),
(4, 2, 'en', 'Pils', 'Beer'),
(5, 3, 'de', 'Wasser', 'still'),
(6, 3, 'en', 'Water', 'Without Gas'),
(7, 4, 'de', 'Gegrillte Peperoni', 'Scharf'),
(8, 4, 'en', 'Grilled Pepperoni', 'Hot'),
(9, 5, 'de', 'Käseplatte', '3 verschiedene Sorten'),
(10, 5, 'en', 'Mixed Cheese ', '3 different Types'),
(11, 6, 'de', 'Antipasti', 'Frisch'),
(12, 6, 'en', 'Antipasti', 'Fresh'),
(13, 7, 'de', 'Schnitzel mit Pommes', 'Jäger- oder Wiener Art'),
(14, 7, 'en', 'Schnitzel with Fries', 'Jäger- oder Wiener Art'),
(15, 8, 'de', 'Rumpsteak mit Bratkartoffeln', 'Titanic - Medium - Well Done'),
(16, 8, 'en', 'Rumpsteak with fried potatoes', 'Titanic - Medium - Well Done'),
(17, 9, 'de', 'Spaghetti Bolognese', ''),
(18, 9, 'en', 'Spaghetti Bolognese', ''),
(19, 10, 'de', 'Tiramisu', ''),
(20, 10, 'en', 'Tiramisu', ''),
(21, 11, 'de', 'Crème brûlée', ''),
(22, 11, 'en', 'Crème brûlée', ''),
(23, 12, 'de', 'Titanic Dessert', ''),
(24, 12, 'en', 'Titanic Dessert', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kategorie`
--

INSERT INTO `kategorie` (`id`, `lang`, `name`) VALUES
(1, 'de', 'Getränk'),
(1, 'en', 'Drinks'),
(2, 'de', 'Vorspeise'),
(2, 'en', 'Starter'),
(3, 'de', 'Hauptgang'),
(3, 'en', 'Main Course'),
(4, 'de', 'Nachtisch'),
(4, 'en', 'Dessert');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `bestellung_id` int(11) NOT NULL,
  `gericht_id` int(11) NOT NULL,
  `platz_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tisch`
--

CREATE TABLE `tisch` (
  `id` int(11) NOT NULL,
  `plaetze` int(11) NOT NULL,
  `ausrichtung` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tisch`
--

INSERT INTO `tisch` (`id`, `plaetze`, `ausrichtung`) VALUES
(1, 2, 'ver'),
(2, 4, 'ver'),
(3, 2, 'hor'),
(4, 4, 'hor');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `name`, `password`) VALUES
(1, 'tfischer', '098f6bcd4621d373cade4e832627b4f6'),
(2, 'fvogel', 'cc03e747a6afbbcbf8be7668acfebee5');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_BestellungTisch` (`tisch_id`);

--
-- Indizes für die Tabelle `gericht`
--
ALTER TABLE `gericht`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_GerichtKategorie` (`kategorie_id`);

--
-- Indizes für die Tabelle `gericht_details`
--
ALTER TABLE `gericht_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_GerichtDetails` (`gericht_id`);

--
-- Indizes für die Tabelle `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`,`lang`);

--
-- Indizes für die Tabelle `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PositionBestellungGericht` (`bestellung_id`),
  ADD KEY `FK_PositionGericht` (`gericht_id`);

--
-- Indizes für die Tabelle `tisch`
--
ALTER TABLE `tisch`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gericht_details`
--
ALTER TABLE `gericht_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tisch`
--
ALTER TABLE `tisch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD CONSTRAINT `FK_BestellungTisch` FOREIGN KEY (`tisch_id`) REFERENCES `tisch` (`id`);

--
-- Constraints der Tabelle `gericht`
--
ALTER TABLE `gericht`
  ADD CONSTRAINT `FK_GerichtKategorie` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`);

--
-- Constraints der Tabelle `gericht_details`
--
ALTER TABLE `gericht_details`
  ADD CONSTRAINT `FK_GerichtDetails` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`);

--
-- Constraints der Tabelle `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `FK_PositionBestellungGericht` FOREIGN KEY (`bestellung_id`) REFERENCES `bestellung` (`id`),
  ADD CONSTRAINT `FK_PositionGericht` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
