-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Feb 06, 2024 alle 08:13
-- Versione del server: 8.0.18
-- Versione PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webchat`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bloccare`
--

CREATE TABLE `bloccare` (
  `ID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `IDBloccante` int(11) DEFAULT NULL,
  `IDBloccato` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `conoscere`
--

CREATE TABLE `conoscere` (
  `ID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `StatoRischiesta` char(1) DEFAULT NULL,
  `IDRichiedente` int(11) DEFAULT NULL,
  `IDConosciuto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `conversazioni`
--

CREATE TABLE `conversazioni` (
  `ID` int(11) NOT NULL,
  `Tipologia` char(1) DEFAULT NULL,
  `DataCreazione` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `gruppi`
--

CREATE TABLE `gruppi` (
  `ID` int(11) NOT NULL,
  `NomeGruppo` varchar(50) DEFAULT NULL,
  `Descrizione` varchar(150) DEFAULT NULL,
  `DataCreazione` datetime DEFAULT NULL,
  `Amministratore` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `ID` int(11) NOT NULL,
  `Contenuto` text,
  `DataCreazione` datetime DEFAULT NULL,
  `IDUtente` int(11) DEFAULT NULL,
  `IDConversazione` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipare`
--

CREATE TABLE `partecipare` (
  `ID` int(11) NOT NULL,
  `DataUnione` datetime DEFAULT NULL,
  `UltimaLettura` datetime DEFAULT NULL,
  `CFUtente` int(11) DEFAULT NULL,
  `IDConversazione` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `ID` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `Cognome` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` char(255) DEFAULT NULL,
  `Cell` varchar(100) DEFAULT NULL,
  `Bannato` tinyint(1) DEFAULT NULL,
  `DataFineBan` datetime DEFAULT NULL,
  `UltimaVoltaOnline` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bloccare`
--
ALTER TABLE `bloccare`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDBloccante` (`IDBloccante`),
  ADD KEY `IDBloccato` (`IDBloccato`);

--
-- Indici per le tabelle `conoscere`
--
ALTER TABLE `conoscere`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDRichiedente` (`IDRichiedente`),
  ADD KEY `IDConosciuto` (`IDConosciuto`);

--
-- Indici per le tabelle `conversazioni`
--
ALTER TABLE `conversazioni`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `gruppi`
--
ALTER TABLE `gruppi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Amministratore` (`Amministratore`);

--
-- Indici per le tabelle `messaggi`
--
ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDUtente` (`ID`),
  ADD KEY `IDConversazione` (`IDConversazione`);

--
-- Indici per le tabelle `partecipare`
--
ALTER TABLE `partecipare`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CFUtente` (`CFUtente`),
  ADD KEY `IDConversazione` (`IDConversazione`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `bloccare`
--
ALTER TABLE `bloccare`
  ADD CONSTRAINT `bloccare_ibfk_1` FOREIGN KEY (`IDBloccante`) REFERENCES `utenti` (`ID`),
  ADD CONSTRAINT `bloccare_ibfk_2` FOREIGN KEY (`IDBloccato`) REFERENCES `utenti` (`ID`);

--
-- Limiti per la tabella `conoscere`
--
ALTER TABLE `conoscere`
  ADD CONSTRAINT `conoscere_ibfk_1` FOREIGN KEY (`IDRichiedente`) REFERENCES `utenti` (`ID`),
  ADD CONSTRAINT `conoscere_ibfk_2` FOREIGN KEY (`IDConosciuto`) REFERENCES `utenti` (`ID`);

--
-- Limiti per la tabella `gruppi`
--
ALTER TABLE `gruppi`
  ADD CONSTRAINT `gruppi_ibfk_1` FOREIGN KEY (`Amministratore`) REFERENCES `utenti` (`ID`);

--
-- Limiti per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  ADD CONSTRAINT `messaggi_ibfk_1` FOREIGN KEY (`CFUtente`) REFERENCES `utenti` (`ID`),
  ADD CONSTRAINT `messaggi_ibfk_2` FOREIGN KEY (`IDConversazione`) REFERENCES `conversazioni` (`ID`);

--
-- Limiti per la tabella `partecipare`
--
ALTER TABLE `partecipare`
  ADD CONSTRAINT `partecipare_ibfk_1` FOREIGN KEY (`CFUtente`) REFERENCES `utenti` (`ID`),
  ADD CONSTRAINT `partecipare_ibfk_2` FOREIGN KEY (`IDConversazione`) REFERENCES `conversazioni` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
