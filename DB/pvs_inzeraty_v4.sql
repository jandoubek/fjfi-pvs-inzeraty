-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 09. pro 2015, 16:18
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
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_poster` (`id_poster`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `comment`
--

INSERT INTO `comment` (`id`, `id_user`, `id_poster`, `title`, `body`, `datum`) VALUES
(1, 1, 1, 'Lednička', 'Ta lednička se mi líbí.', '2015-11-23 12:45:00'),
(2, 4, 1, 'Re: Lednička', 'Mně teda ne.', '2015-11-23 14:14:00'),
(3, 1, 1, 'Re:Lednička', 'Tak si ji nekupuj.', '2015-11-24 18:06:00');

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
-- Zástupná struktura pro pohled `komenty`
--
CREATE TABLE IF NOT EXISTS `komenty` (
`id_poster` int(11)
,`jmeno` varchar(40)
,`prijm` varchar(30)
,`title` varchar(120)
,`body` text
,`datum` varchar(26)
);
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
  `name` varchar(40) COLLATE utf8_bin NOT NULL,
  `surname` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone` varchar(13) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id`, `nickname`, `password`, `name`, `surname`, `email`, `phone`, `address`, `comment`) VALUES
(1, 'prcharom', '$2a$07$zkaywp36fdes3k5cv4oh7uUY1VMqeXc/KBqeP4Q88ln08DWjSsoam', 'Roman', 'Prchal', 'prcharom@gmail.com', '720 321 567', 'Koleje podolí, pokoj F415', 'Na koleji bývám obvykle až po 20 hodině.'),
(4, 'Petr', '$2a$07$z48uu1pvlwyxcf6dsvx1setQcDQDFJZGSqN/eP6l3hxCGBGKmEVje', 'Petr', 'Bohuslav', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura pro pohled `komenty`
--
DROP TABLE IF EXISTS `komenty`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `komenty` AS select `comment`.`id_poster` AS `id_poster`,`user`.`name` AS `jmeno`,`user`.`surname` AS `prijm`,`comment`.`title` AS `title`,`comment`.`body` AS `body`,date_format(`comment`.`datum`,'%d. %c. %Y %H:%i:%s') AS `datum` from (`comment` join `user` on((`comment`.`id_user` = `user`.`id`))) order by `comment`.`datum`;

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
