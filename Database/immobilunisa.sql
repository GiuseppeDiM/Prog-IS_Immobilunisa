-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Gen 27, 2016 alle 16:18
-- Versione del server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `immobilunisa`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `immobile`
--

CREATE TABLE IF NOT EXISTS `immobile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `approvato` tinyint(1) DEFAULT NULL,
  `agente` varchar(16) DEFAULT NULL,
  `tipoContratto` varchar(20) NOT NULL,
  `descrizione` longtext NOT NULL,
  `proprietario` varchar(16) NOT NULL,
  `immagine` varchar(500) NOT NULL,
  `metratura` double NOT NULL,
  `prezzo` double NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `Comune` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `proprietario` (`proprietario`),
  KEY `agente` (`agente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=412403633 ;

--
-- Dump dei dati per la tabella `immobile`
--

INSERT INTO `immobile` (`id`, `approvato`, `agente`, `tipoContratto`, `descrizione`, `proprietario`, `immagine`, `metratura`, `prezzo`, `tipo`, `Comune`) VALUES
(376924311, 0, 'PCRNTA12345', 'affitto', 'Fisciano (SA), nei pressi dell''autostrada e dell universita , proponiamo in locazione appartamento di 3 camere ed accessori all interno di una villetta.\r\nPosto auto chiuso.\r\nArredato........\r\nComposto da: ingresso , cucina abitabile , 2 bagni , 3 camere.\r\nAmpio balcone.', 'NPLFRN12345', 'immobili/376924311.jpg', 90, 450, 'Appartamento', 'Fisciano (SA)'),
(403248299, 0, 'SCLCRI12345', 'affitto', 'Quartiere orientale Pastena, centralissimo, appartamento in buone condizioni composto da ingresso con soggiorno ed angolo cottura, camera matrimoniale, cameretta e bagno padronale.', 'ZPLFDR12345', 'immobili/403248299.jpg', 70, 500, 'Appartamento', 'Salerno (SA)'),
(405768121, 1, 'SCLCRI12345', 'vendita', 'Salerno provincia: zona valle dell irno. In parco signorile di recente costruzione composto da sei piccole palazzine. Contesto molto riservato e silenzioso. Appartamento composto da ampio salone con camino, cucina abitabile ,3 camere da letto , 2 ampi w.c., e box auto di 30 mq,completamente balconato. L esposizione Ã¨ eccellente, sud est ovest, ed e panoramico ed e soleggiatissimo, con triplice esposizione. Il fabbricato e dotato di ascensore che scende anche al piano garage. La comodita  di un vialetto pedonale riservato permette di raggiungere facilmente la stazione ferroviaria ed il centro di Baronissi. \r\nFacilmente si raggiungono le principali direttrici autostradali.\r\nVICINO ALLE UNIVERSITA DI SALERNO', 'ZPLFDR12345', 'immobili/405768121.jpg', 125, 20000, 'Appartamento', 'Salerno (SA)'),
(407173243, 1, 'SCLCRI12345', 'vendita', 'Parco dei Pini, Via G. Pastore, si propone in vendita appartamento di 100 mq composto da: cucina abitabile con terrazzino a livello, salone doppio, due camere, due wc. In minicondominio, zona tranquilla e ben collegata, con box di proprietÃ  e posti auto a riempimento in area condominiale.', 'MNZGLI12345', 'immobili/407173243.jpg', 100, 175000, 'Appartamento', 'Salerno (SA)'),
(411604185, 1, 'PCRNTA12345', 'Affitto', 'Salerno(SA) lancusi, appartamento in ottimo stato in lancusi composto da ingresso salone con camino, cucina, 2 camere, 2 bagni, box e p. auto chiuso.', 'NPLFRN12345', 'immobili/411604185.jpg', 90, 195000, 'Appartamento', 'Fisciano (SA)'),
(412342801, 1, 'PCRNTA12345', 'vendita', 'Con una splendida vista su tutto il golfo di Salerno, appoggiato sulle colline immediatamente alle spalle della citta, UniCredit Subito Casa propone uno spazioso e luminoso villa su 2 livelli con annesso giardino e box auto. \r\n\r\nL appartamento e disposto su 2 livelli collegati da scala interna: al piano seminterrato, con ingresso di servizio dal giardino annesso, vi sono: ampio soggiorno cucina, disimpegno, bagno e studio; al piano terra, con ingresso da pianerottolo pertinenziale, si aprono l ingresso, il soggiorno, il disimpegno, 3 camere, 3 bagni, cabina armadio, ampio terrazzo. \r\n\r\nAnnesso box auto al piano seminterrato, con accesso carrabile da aera comune e collegato allappartamento a mezzo di porta interna.', 'CRNGSP12345', 'immobili/412342801.jpg', 200, 950, 'Appartamento', 'Salerno (SA)'),
(412403631, 1, 'SCLCRI12345', 'Vendita', 'Salerno(SA) Fisciano, a 2 Km dal centro commerciale Ikea, nel comune di Fisciano disponiamo di appartamento tenuto in ottime condizioni ubicato al primo piano ingresso ampio soggiorno con cucina a vista, 2 letto, bagno, lavanderia porzione sottotetto, box e posto auto. L immobile e munito di riscaldamento autonomo e caminetto in cucina soggiorno, 2 balconi con esposizione sud/ovest, libero al rogito.\r\nClasse energetica e indice prestazione energetica sono in attesa di certificazione', 'MNZGLI12345', 'immobili/412403631.jpg', 75, 136000, 'Appartamento', 'Fisciano (SA)'),
(412403632, 1, 'VNCNST12345', 'affitto', 'Via Speranzella affittiamo appartamento composto da: ingresso in disimpegno, soggiorno con angolo cottura, cameretta, camera da letto e servizio. Piano alto con ascensore, buono stato, luminoso.', 'GPPDMT12345', 'immobili/affitto01.jpg', 70, 600, 'Appartamento', 'Napoli (NA)');

-- --------------------------------------------------------

--
-- Struttura della tabella `trattativa`
--

CREATE TABLE IF NOT EXISTS `trattativa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acquirente` varchar(16) NOT NULL,
  `agente` varchar(16) DEFAULT NULL,
  `immobile` int(11) NOT NULL,
  `dataSottomissione` date DEFAULT NULL,
  `approvata` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agente` (`agente`),
  KEY `acquirente` (`acquirente`),
  KEY `immobile` (`immobile`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2719 ;

--
-- Dump dei dati per la tabella `trattativa`
--

INSERT INTO `trattativa` (`id`, `acquirente`, `agente`, `immobile`, `dataSottomissione`, `approvata`) VALUES
(2711, 'ZPLFDR12345', 'PCRNTA12345', 411604185, '2009-11-10', 1),
(2715, 'CRNGSP12345', 'PCRNTA12345', 411604185, '2015-02-06', 1),
(2716, 'ZPLFDR12345', NULL, 412403631, '2015-02-06', 0),
(2717, 'LNDMLA12345', NULL, 407173243, '2015-11-30', 0),
(2718, 'NPLFRN12345', 'VNCNST12345', 412403632, '2015-12-09', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `codiceFiscale` varchar(16) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `dataNascita` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `psswd` varchar(40) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`codiceFiscale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`codiceFiscale`, `nome`, `dataNascita`, `email`, `telefono`, `username`, `psswd`, `tipo`) VALUES
('CRNGSP12345', 'Giuseppe Corino', '1991-02-03', 'g.corino@studenti.unisa.it', '3247645343', 'gcorino', 'corino', 'agente'),
('GPPDMT12345', 'Giuseppe Di Martino', '1992-07-29', 'g.dimartino@libero.it', '3477465432', 'gdimartino', 'dimartino', 'cliente'),
('LNDMLA12345', 'Amalia Landi', '1989-08-04', 'a.landi@studenti.unisa.it', '3334545671', 'alandi', 'landi', 'cliente'),
('MNZGLI12345', 'Giulio Manzi', '1990-04-12', 'g.manzi@studenti.unisa.it', '3284803954', 'gmanzi', 'manzi', 'cliente'),
('NPLFRN12345', 'Francesco Napoli', '1991-02-12', 'f.napoli@studenti.unisa.it', '3430587176', 'fnapoli', 'napoli', 'cliente'),
('PCRNTA12345', 'Antonio Pecoraro', '1993-06-27', 'a.pecoraro@studenti.unisa.it', '3450304723', 'apecoraro', 'pecoraro', 'agente'),
('SCLCRI12345', 'Ciro Scala', '1993-09-01', 'c.scala@studenti.unisa.it', '3401275239', 'cscala', 'scala', 'agente'),
('VLIGTN1234', 'Gaetano Viola', '1992-03-28', 'g.viola@studenti.unisa.it', '3401450176', 'gviola', 'viola', 'amministratore'),
('VNCNST12345', 'Vincenzo Nastro', '1993-02-12', 'v.nastro@studenti.unisa.it', '0123456789', 'vnastro', 'nastro', 'agente'),
('ZPLFDR12345', 'Federica Zipoli', '1990-05-02', 'f.zipoli@studenti.unisa.it', '3460193285', 'fzipoli', 'zipoli', 'cliente');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `immobile`
--
ALTER TABLE `immobile`
  ADD CONSTRAINT `immobile_ibfk_1` FOREIGN KEY (`proprietario`) REFERENCES `utente` (`codiceFiscale`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `immobile_ibfk_2` FOREIGN KEY (`agente`) REFERENCES `utente` (`codiceFiscale`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `trattativa`
--
ALTER TABLE `trattativa`
  ADD CONSTRAINT `trattativa_ibfk_1` FOREIGN KEY (`agente`) REFERENCES `utente` (`codiceFiscale`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `trattativa_ibfk_2` FOREIGN KEY (`acquirente`) REFERENCES `utente` (`codiceFiscale`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trattativa_ibfk_3` FOREIGN KEY (`immobile`) REFERENCES `immobile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
