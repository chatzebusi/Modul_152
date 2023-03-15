-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Mrz 2023 um 21:13
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `modul152`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `storage_path` varchar(250) NOT NULL,
  `thumbnail_storage_path` varchar(250) NOT NULL,
  `licence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `licence`
--

CREATE TABLE `licence` (
  `licence_id` int(11) NOT NULL,
  `licence_txt` varchar(250) NOT NULL,
  `licence_link` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `licence`
--

INSERT INTO `licence` (`licence_id`, `licence_txt`, `licence_link`) VALUES
(1, 'all rights reserved', ''),
(2, 'No edits 4.0 International', 'https://creativecommons.org/licenses/by-nd/4.0/'),
(3, 'Sharing under the same conditions 4.0 International', 'https://creativecommons.org/licenses/by-sa/4.0/'),
(4, 'Non-commercial 4.0 International', 'https://creativecommons.org/licenses/by-nc/4.0/'),
(5, 'Non-commercial - No edits 4.0 International', 'https://creativecommons.org/licenses/by-nc-nd/4.0/'),
(6, 'Non-commercial - Sharing under the same conditions 4.0 International', 'https://creativecommons.org/licenses/by-nc-sa/4.0/'),
(7, '4.0 International', 'https://creativecommons.org/licenses/by/4.0/');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `votes` tinyint(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `licence_id` (`licence_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `licence`
--
ALTER TABLE `licence`
  ADD PRIMARY KEY (`licence_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indizes für die Tabelle `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `image_id_foreign_key` (`image_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT für Tabelle `licence`
--
ALTER TABLE `licence`
  MODIFY `licence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_2` FOREIGN KEY (`licence_id`) REFERENCES `licence` (`licence_id`),
  ADD CONSTRAINT `image_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints der Tabelle `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `image_id_foreign_key` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`),
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
