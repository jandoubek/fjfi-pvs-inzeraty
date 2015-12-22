-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 22. pro 2015, 21:09
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
(1, 1, 19, 'Lednička', 'Ta lednička se mi líbí.', '2015-11-23 12:45:00'),
(2, 4, 19, 'Re: Lednička', 'Mně teda ne.', '2015-11-23 14:14:00'),
(3, 1, 19, 'Re:Lednička', 'Tak si ji nekupuj.', '2015-11-24 18:06:00');

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
  `popis` varchar(40) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_poster` (`id_poster`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=32 ;

--
-- Vypisuji data pro tabulku `image`
--

INSERT INTO `image` (`id`, `id_poster`, `name`, `extension`, `added`, `popis`) VALUES
(1, 5, 'burger', 'jpg', '2015-11-19 08:00:00', 'Takhle vypadají moje burgery.'),
(2, 11, 'fotbalek', 'jpg', '2015-12-20 05:14:37', ''),
(16, 16, 'ful1', 'jpg', '2015-12-20 15:38:38', 'Mňam'),
(17, 16, 'ful2', 'jpg', '2015-12-20 15:41:21', ''),
(18, 15, 'kabel1', 'jpg', '2015-12-21 06:20:14', ''),
(19, 15, 'kabel2', 'jpg', '2015-12-21 06:21:30', ''),
(20, 15, 'kabel3', 'jpg', '2015-12-21 06:21:43', ''),
(21, 17, 'Kelnoreem', 'jpg', '0000-00-00 00:00:00', 'Teal''C v akci'),
(22, 1, 'konik-bulik-plysovy', 'jpg', '0000-00-00 00:00:00', ''),
(23, 19, 'lednicka1', 'jpg', '0000-00-00 00:00:00', ''),
(24, 19, 'lednicka2', 'jpg', '0000-00-00 00:00:00', ''),
(25, 14, 'listky_hokej', 'jpg', '0000-00-00 00:00:00', ''),
(26, 18, 'polystyren', 'jpg', '0000-00-00 00:00:00', ''),
(27, 12, 'Samsung1', 'jpg', '0000-00-00 00:00:00', 'Pohled zepředu'),
(28, 12, 'Samsung2', 'jpg', '0000-00-00 00:00:00', 'Pohled zezadu'),
(29, 12, 'Samsung3', 'jpg', '0000-00-00 00:00:00', 'Pohled z boku'),
(30, 12, 'Samsung4', 'jpg', '0000-00-00 00:00:00', 'Perspektiva'),
(31, 19, 'lednicka3', 'jpg', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Zástupná struktura pro pohled `inzeraty`
--
CREATE TABLE IF NOT EXISTS `inzeraty` (
`id` int(11)
,`id_user` int(11)
,`id_kategorie` int(11)
,`title` varchar(120)
,`body` text
,`added` datetime
,`expire` datetime
,`value` varchar(20)
,`pocet_fotek` bigint(21)
);
-- --------------------------------------------------------

--
-- Struktura tabulky `kategorie`
--

CREATE TABLE IF NOT EXISTS `kategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(20) COLLATE utf8_bin NOT NULL,
  `barva` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Vypisuji data pro tabulku `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazev`, `barva`) VALUES
(1, 'Elektronika', 'e53e1b'),
(2, 'Akce', '2b5bb5'),
(3, 'Jídlo', 'f7da20'),
(4, 'Jiné', '9CCF31');

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
  `id_kategorie` int(11) NOT NULL,
  `title` varchar(120) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `added` datetime NOT NULL,
  `expire` datetime NOT NULL,
  `value` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_kategorie` (`id_kategorie`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=20 ;

--
-- Vypisuji data pro tabulku `poster`
--

INSERT INTO `poster` (`id`, `id_user`, `id_kategorie`, `title`, `body`, `added`, `expire`, `value`) VALUES
(1, 1, 4, 'Plyšový koník Toník', 'Vyroben z příjemného materiálu, při zmáčknutí levé packy hraje písničku.', '2015-11-11 09:22:00', '2016-01-20 00:00:00', '320 Kč'),
(5, 1, 3, 'Burger Night', 'Dělám burgery, pojďte se přidat.', '2015-11-11 09:22:00', '2016-01-20 00:00:00', '0'),
(11, 4, 2, 'Turnaj ve fotbálku', 'Turnaj ve stolním fotbalu v úterý 5. 1. 2016 na Desítce. Startovné 50 Kč/tým. Dvoučlenné týmy hlaste se na zapis@fotbaljefajn.cz', '2015-12-21 19:34:58', '2016-01-20 00:00:00', '50 Kč/tým'),
(12, 1, 1, 'Prodám Samsung GALAXY Grand Prime VE', 'Prodám mobil Samsung GALAXY Grand Prime VE. Je v originálním obalu, nerozbalený, nepoužitý. Byl to nevhodný dárek.', '2015-12-21 21:06:52', '2016-01-20 00:00:00', '4900 Kč'),
(13, 1, 4, 'Učení na MAB3', 'Kdo by si šel spočítat příklady a zopakovat teorii do analýzy před zkouškou? 4. ledna v 15:00 ve studovně na Trojance. Příklady mám vytištěné, stačí si vzít papíry na psaní.', '2015-12-21 21:15:04', '2016-01-21 00:00:00', ''),
(14, 1, 2, 'Lístky na MS: Česko - Švédsko', 'Prodám dva lístky na MS, zápas Česko - Švédsko. Hraje se 1. května 2015 ve 20:15 v O2 aréně. Skvělá místa za střídačkami, sektor 102, řada 3, sedadla 9 a 10.', '2015-12-21 21:33:34', '2016-01-20 00:00:00', '3380 Kč'),
(15, 6, 1, 'Prodám kabel na internet', 'Odcházím ze Strahova a už ho nebudu potřebovat. Délka 10 m.', '2015-12-21 21:40:16', '2016-12-20 00:00:00', '70 Kč'),
(16, 6, 3, 'Egyptské speciality - doručení až do pokoje', 'Fúl - vařené hnědé boby, částečně či úplně rozemleté na kaši, zakapané citrónem s přídavkem olivového oleje a občas i česneku. Fúl může mít mnoho variant přidáním zeleniny, uzeniny či zapečením do chlebové placky.\nDodávka až do domu.', '2015-12-21 21:48:19', '2016-12-20 00:00:00', '2 €'),
(17, 6, 4, 'Cesta k osvícení', 'Nabízím cestu k povzesení a nesmrtelnosti. Postupně si osvojíme meditační rituál Kelno''reem a budeme následovat učení Počátku, které nás povede až k povzesení.', '2015-12-21 22:00:36', '2016-12-20 00:00:00', ''),
(18, 4, 4, 'Prodám polystyren', 'Prodám polystyren. Zrovna mi přiletěl oknem. Vhodný na zateplení nebo jako nouzová postel pro návštěvu na koleji.', '2015-12-21 22:05:49', '2016-01-20 00:00:00', '10 Kč/m2'),
(19, 4, 1, 'Lednička Whirlpool BLF 8121 W', 'Prodám kombinovanou chladničku BLF 8121 W v bílé barvě s přímým chlazením v energetické třídě A+. Hlučnost 38  dB.\nDůvod prodeje: Je moc velká a nevejde se mi do pokoje.', '2015-12-21 22:41:55', '2016-12-20 00:00:00', '9999 Kč');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id`, `nickname`, `password`, `name`, `surname`, `email`, `phone`, `address`, `comment`) VALUES
(1, 'prcharom', '$2a$07$zkaywp36fdes3k5cv4oh7uUY1VMqeXc/KBqeP4Q88ln08DWjSsoam', 'Roman', 'Prchal', 'prcharom@gmail.com', '720 321 567', 'Koleje podolí, pokoj F415', 'Na koleji bývám obvykle až po 21 hodině.'),
(4, 'Petr', '$2a$07$z48uu1pvlwyxcf6dsvx1setQcDQDFJZGSqN/eP6l3hxCGBGKmEVje', 'Petr', 'Bohuslav', '', NULL, NULL, NULL),
(5, 'pribyto4', '$2a$07$luueq13jdbg709601j1i5ezwlCji3SjIOLyjB5rDNNBXES9cLeVcu', '', '', 'tomas.pribyl.89@gmail.com', '', '', ''),
(6, 'Tutanchamon', '$2a$07$cq4uvwc7no5xyhnxahn6we4hbfNPxyKC1xV2UOkdZttVvPHixpzmK', '', '', 'immortal@faraon.cz', '777123456', '', 'Upřednostňuji komunikaci po mailu.');

-- --------------------------------------------------------

--
-- Struktura pro pohled `inzeraty`
--
DROP TABLE IF EXISTS `inzeraty`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inzeraty` AS select `poster`.`id` AS `id`,`poster`.`id_user` AS `id_user`,`poster`.`id_kategorie` AS `id_kategorie`,`poster`.`title` AS `title`,`poster`.`body` AS `body`,`poster`.`added` AS `added`,`poster`.`expire` AS `expire`,`poster`.`value` AS `value`,count(`image`.`name`) AS `pocet_fotek` from (`poster` left join `image` on((`poster`.`id` = `image`.`id_poster`))) group by `poster`.`id`;

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
  ADD CONSTRAINT `kategorie_const` FOREIGN KEY (`id_kategorie`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `poster_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
