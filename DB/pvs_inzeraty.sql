-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 19. lis 2015, 17:22
-- Verze serveru: 5.6.15-log
-- Verze PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `pvs_inzeraty`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_poster` int(11) NOT NULL,
  `title` varchar(120) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_poster` (`id_poster`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_poster` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `extension` varchar(4) COLLATE utf8_bin NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_poster` (`id_poster`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `poster`
--

CREATE TABLE IF NOT EXISTS `poster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(120) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `added` datetime NOT NULL,
  `expire` datetime NOT NULL,
  `value` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `poster`
--

INSERT INTO `poster` (`id`, `id_user`, `title`, `body`, `added`, `expire`, `value`) VALUES
(1, 1, 'Plyšový koník Toník', 'Vyroben z příjemného materiálu, při zmáčknutí levé packy hraje písničku.', '2015-11-11 09:22:00', '2015-12-24 22:00:00', 320);

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(60) COLLATE utf8_bin NOT NULL,
  `password` varchar(60) COLLATE utf8_bin NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `surname` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone` varchar(13) COLLATE utf8_bin NOT NULL,
  `bool_email` tinyint(1) NOT NULL DEFAULT '1',
  `bool_phone` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id`, `nickname`, `password`, `name`, `surname`, `email`, `phone`, `bool_email`, `bool_phone`) VALUES
(1, 'prcharom', '', 'Roman', 'Prchal', 'prcharom@gmail.com', '720 321 567', 1, 0);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_poster`) REFERENCES `poster` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_poster`) REFERENCES `poster` (`id`) ON DELETE CASCADE;

--
-- Omezení pro tabulku `poster`
--
ALTER TABLE `poster`
  ADD CONSTRAINT `poster_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
