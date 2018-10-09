-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 29, 2018 at 02:29 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `resbes`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestellung`
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
-- Table structure for table `gericht`
--

CREATE TABLE `gericht` (
  `id` int(11) NOT NULL,
  `kategorie_id` int(2) NOT NULL,
  `preis` double NOT NULL,
  `bild` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gericht`
--

INSERT INTO `gericht` (`id`, `kategorie_id`, `preis`, `bild`) VALUES
(1, 1, 3.5, ''),
(2, 1, 4.5, ''),
(3, 1, 2.2, ''),
(4, 2, 6, 'Gegrillte_Peperoni.jpg'),
(5, 2, 5.4, 'Kaeseplatte.jpg'),
(6, 2, 7.5, 'Antipasti.jpg'),
(7, 3, 12.5, 'Jaegerschnitzel.jpg'),
(8, 3, 21, 'Rumpsteak.jpg'),
(9, 3, 9.5, 'Spaghetti.jpg'),
(10, 4, 4, 'Tiramisu.jpg'),
(11, 4, 6.5, 'Creme_Brulee.jpg'),
(12, 4, 1, 'Titanic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gericht_details`
--

CREATE TABLE `gericht_details` (
  `id` int(11) NOT NULL,
  `gericht_id` int(11) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `beschreibung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gericht_details`
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
-- Table structure for table `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategorie`
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
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `bestellung_id` int(11) NOT NULL,
  `gericht_id` int(11) NOT NULL,
  `platz_id` int(11) NOT NULL,
  `kommentar` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tisch`
--

CREATE TABLE `tisch` (
  `id` int(11) NOT NULL,
  `plaetze` int(11) NOT NULL,
  `ausrichtung` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tisch`
--

INSERT INTO `tisch` (`id`, `plaetze`, `ausrichtung`) VALUES
(1, 4, 'ver'),
(2, 8, 'ver'),
(3, 4, 'hor'),
(4, 10, 'hor');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`) VALUES
(1, 'tfischer', '098f6bcd4621d373cade4e832627b4f6'),
(2, 'fvogel', 'cc03e747a6afbbcbf8be7668acfebee5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_BestellungTisch` (`tisch_id`);

--
-- Indexes for table `gericht`
--
ALTER TABLE `gericht`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_GerichtKategorie` (`kategorie_id`);

--
-- Indexes for table `gericht_details`
--
ALTER TABLE `gericht_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_GerichtDetails` (`gericht_id`);

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`,`lang`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PositionBestellungGericht` (`bestellung_id`),
  ADD KEY `FK_PositionGericht` (`gericht_id`);

--
-- Indexes for table `tisch`
--
ALTER TABLE `tisch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gericht_details`
--
ALTER TABLE `gericht_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tisch`
--
ALTER TABLE `tisch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bestellung`
--
ALTER TABLE `bestellung`
  ADD CONSTRAINT `FK_BestellungTisch` FOREIGN KEY (`tisch_id`) REFERENCES `tisch` (`id`);

--
-- Constraints for table `gericht`
--
ALTER TABLE `gericht`
  ADD CONSTRAINT `FK_GerichtKategorie` FOREIGN KEY (`kategorie_id`) REFERENCES `kategorie` (`id`);

--
-- Constraints for table `gericht_details`
--
ALTER TABLE `gericht_details`
  ADD CONSTRAINT `FK_GerichtDetails` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`);

--
-- Constraints for table `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `FK_PositionBestellungGericht` FOREIGN KEY (`bestellung_id`) REFERENCES `bestellung` (`id`),
  ADD CONSTRAINT `FK_PositionGericht` FOREIGN KEY (`gericht_id`) REFERENCES `gericht` (`id`);
