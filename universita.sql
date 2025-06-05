-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 05, 2025 alle 23:15
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universita`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `IDC` int(11) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Descrizione` varchar(50) NOT NULL,
  `AnnSem` varchar(20) NOT NULL CHECK (`AnnSem` in ('Annuale','Semestrale')),
  `MaxStu` int(11) NOT NULL,
  `IDD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `docente`
--

CREATE TABLE `docente` (
  `IDD` int(11) NOT NULL,
  `Cognome` varchar(20) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `bDate` date NOT NULL,
  `Email` varchar(100) NOT NULL,
  `pw` varchar(255) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Struttura della tabella `esame`
--

CREATE TABLE `esame` (
  `IDE` int(11) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Arg` varchar(50) NOT NULL,
  `Tipologia` varchar(20) NOT NULL CHECK (`Tipologia` in ('Orale','Scritto')),
  `IDC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `frequentazione`
--

CREATE TABLE `frequentazione` (
  `IDF` int(11) NOT NULL,
  `Mat` char(10) NOT NULL,
  `IDC` int(11) NOT NULL,
  `DataI` date NOT NULL,
  `DataF` date DEFAULT NULL CHECK (`DataF` >= `DataI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `studente`
--

CREATE TABLE `studente` (
  `Mat` char(10) NOT NULL,
  `Cognome` varchar(20) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `bDate` date NOT NULL,
  `Email` varchar(100) NOT NULL,
  `pw` varchar(255) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Struttura della tabella `valutazione`
--

CREATE TABLE `valutazione` (
  `IDV` int(11) NOT NULL,
  `Voto` int(11) NOT NULL CHECK (`Voto` >= 1 and `Voto` <= 30),
  `Data` date NOT NULL,
  `IDE` int(11) NOT NULL,
  `IDD` int(11) NOT NULL,
  `Mat` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`IDC`),
  ADD UNIQUE KEY `IDC` (`IDC`),
  ADD KEY `IDD` (`IDD`);

--
-- Indici per le tabelle `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`IDD`),
  ADD UNIQUE KEY `IDD` (`IDD`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indici per le tabelle `esame`
--
ALTER TABLE `esame`
  ADD PRIMARY KEY (`IDE`),
  ADD UNIQUE KEY `IDE` (`IDE`),
  ADD KEY `IDC` (`IDC`);

--
-- Indici per le tabelle `frequentazione`
--
ALTER TABLE `frequentazione`
  ADD PRIMARY KEY (`IDF`),
  ADD UNIQUE KEY `IDF` (`IDF`),
  ADD KEY `Mat` (`Mat`),
  ADD KEY `IDC` (`IDC`);

--
-- Indici per le tabelle `studente`
--
ALTER TABLE `studente`
  ADD PRIMARY KEY (`Mat`),
  ADD UNIQUE KEY `Mat` (`Mat`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indici per le tabelle `valutazione`
--
ALTER TABLE `valutazione`
  ADD PRIMARY KEY (`IDV`),
  ADD UNIQUE KEY `IDV` (`IDV`),
  ADD KEY `IDE` (`IDE`),
  ADD KEY `IDD` (`IDD`),
  ADD KEY `Mat` (`Mat`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `corso`
--
ALTER TABLE `corso`
  MODIFY `IDC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `docente`
--
ALTER TABLE `docente`
  MODIFY `IDD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `esame`
--
ALTER TABLE `esame`
  MODIFY `IDE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `frequentazione`
--
ALTER TABLE `frequentazione`
  MODIFY `IDF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `valutazione`
--
ALTER TABLE `valutazione`
  MODIFY `IDV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `corso`
--
ALTER TABLE `corso`
  ADD CONSTRAINT `corso_ibfk_1` FOREIGN KEY (`IDD`) REFERENCES `docente` (`IDD`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limiti per la tabella `esame`
--
ALTER TABLE `esame`
  ADD CONSTRAINT `esame_ibfk_1` FOREIGN KEY (`IDC`) REFERENCES `corso` (`IDC`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limiti per la tabella `frequentazione`
--
ALTER TABLE `frequentazione`
  ADD CONSTRAINT `frequentazione_ibfk_1` FOREIGN KEY (`Mat`) REFERENCES `studente` (`Mat`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `frequentazione_ibfk_2` FOREIGN KEY (`IDC`) REFERENCES `corso` (`IDC`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limiti per la tabella `valutazione`
--
ALTER TABLE `valutazione`
  ADD CONSTRAINT `valutazione_ibfk_1` FOREIGN KEY (`IDE`) REFERENCES `esame` (`IDE`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `valutazione_ibfk_2` FOREIGN KEY (`IDD`) REFERENCES `docente` (`IDD`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `valutazione_ibfk_3` FOREIGN KEY (`Mat`) REFERENCES `studente` (`Mat`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
