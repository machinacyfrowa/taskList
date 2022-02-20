-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Lut 2022, 13:02
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tasklist`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `ID` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `resolved` timestamp NULL DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`ID`, `code`, `created`, `resolved`, `title`, `content`, `priority`) VALUES
(1, 'DYH-OOA-NMN', '2022-02-20 10:05:00', '2022-02-20 10:51:09', 'zadanie testowe1', 'Treść zadania testowego1', 2),
(2, 'HVE-NOS-MNZ', '2022-02-20 10:05:00', '2022-02-20 10:51:44', 'zadanie testowe2', 'Treść zadania testowego2', 2),
(3, 'GRP-NCO-CDZ', '2022-02-20 10:05:00', '2022-02-20 10:51:47', 'zadanie testowe3', 'Treść zadania testowego3', 2),
(4, 'XWL-FVH-VNC', '2022-02-20 10:33:35', '2022-02-20 10:59:53', 'zgłoszenie 4', 'treść zgłoszenia 4', 2),
(5, 'NIG-OCP-DYM', '2022-02-20 10:34:29', '0000-00-00 00:00:00', 'zgłoszenie 5', 'treść zgłoszenia 5', 2),
(6, 'JKX-HDO-JBF', '2022-02-20 10:34:47', '0000-00-00 00:00:00', 'zgłoszenie 6', 'treść zgłoszenia 6', 2),
(7, 'ZNO-OQM-QQR', '2022-02-20 11:42:05', '0000-00-00 00:00:00', 'dfssdf', 'fsdfsdf', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
