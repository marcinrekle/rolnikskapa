-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 17 Sty 2013, 15:02
-- Wersja serwera: 5.1.53
-- Wersja PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `plc_memory`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opis` varchar(32) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Zrzut danych tabeli `events`
--

INSERT INTO `events` (`id`, `opis`, `value`) VALUES
(1, 'Spust SBR1', 1),
(2, 'Spust SBR2', 1),
(3, 'Poziom MAX RB', 1),
(4, 'Nape?nianie SBR1', 0),
(5, 'Koniec nape?niania SBR1 ', 0),
(6, 'Napelnianie SBR1', 0),
(7, 'Koniec napelniania SBR1 ', 0),
(8, 'Napelnianie SBR2', 0),
(9, 'Koniec napelniania SBR2 ', 0),
(10, 'Koniec spustu SBR1', 0),
(11, 'Koniec spustu SBR2', 0);
