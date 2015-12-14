-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 13, 2015 at 09:06 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pvs_inzeraty`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_poster` int(11) NOT NULL,
  `title` varchar(120) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_user`, `id_poster`, `title`, `body`, `datum`) VALUES
(1, 1, 1, 'Lednička', 'Ta lednička se mi líbí.', '2015-11-23 12:45:00'),
(2, 4, 1, 'Re: Lednička', 'Mně teda ne.', '2015-11-23 14:14:00'),
(3, 1, 1, 'Re:Lednička', 'Tak si ji nekupuj.', '2015-11-24 18:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `id_poster` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `extension` varchar(4) COLLATE utf8_bin NOT NULL,
  `added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazev` varchar(20) COLLATE utf8_bin NOT NULL,
  `barva` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazev`, `barva`) VALUES
(1, 'Elektronika', '#e53e1b'),
(2, 'Akce', '#2b5bc6'),
(3, 'Jído', '#f7e325'),
(4, 'Jiné', '#9CCF31');

-- --------------------------------------------------------

--
-- Stand-in structure for view `komenty`
--
CREATE TABLE `komenty` (
`id_poster` int(11)
,`jmeno` varchar(40)
,`prijm` varchar(30)
,`title` varchar(120)
,`body` text
,`datum` varchar(26)
);

-- --------------------------------------------------------

--
-- Table structure for table `poster`
--

CREATE TABLE `poster` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kategorie` int(11) NOT NULL,
  `title` varchar(120) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `added` datetime NOT NULL,
  `expire` datetime NOT NULL,
  `value` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `poster`
--

INSERT INTO `poster` (`id`, `id_user`, `id_kategorie`, `title`, `body`, `added`, `expire`, `value`) VALUES
(1, 1, 1, 'Plyšový koník Toník', 'Vyroben z příjemného materiálu, při zmáčknutí levé packy hraje písničku.', '2015-11-11 09:22:00', '2015-12-24 22:00:00', 320);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nickname` varchar(60) COLLATE utf8_bin NOT NULL,
  `password` varchar(60) COLLATE utf8_bin NOT NULL,
  `name` varchar(40) COLLATE utf8_bin NOT NULL,
  `surname` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone` varchar(13) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `comment` text COLLATE utf8_bin
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nickname`, `password`, `name`, `surname`, `email`, `phone`, `address`, `comment`) VALUES
(1, 'prcharom', '$2a$07$zkaywp36fdes3k5cv4oh7uUY1VMqeXc/KBqeP4Q88ln08DWjSsoam', 'Roman', 'Prchal', 'prcharom@gmail.com', '720 321 567', 'Koleje podolí, pokoj F415', 'Na koleji bývám obvykle až po 21 hodině.'),
(4, 'Petr', '$2a$07$z48uu1pvlwyxcf6dsvx1setQcDQDFJZGSqN/eP6l3hxCGBGKmEVje', 'Petr', 'Bohuslav', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure for view `komenty`
--
DROP TABLE IF EXISTS `komenty`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `komenty` AS select `comment`.`id_poster` AS `id_poster`,`user`.`name` AS `jmeno`,`user`.`surname` AS `prijm`,`comment`.`title` AS `title`,`comment`.`body` AS `body`,date_format(`comment`.`datum`,'%d. %c. %Y %H:%i:%s') AS `datum` from (`comment` join `user` on((`comment`.`id_user` = `user`.`id`))) order by `comment`.`datum`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_poster` (`id_poster`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_poster` (`id_poster`);

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kategorie` (`id_kategorie`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_poster`) REFERENCES `poster` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_poster`) REFERENCES `poster` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `poster`
--
ALTER TABLE `poster`
  ADD CONSTRAINT `kategorie_const` FOREIGN KEY (`id_kategorie`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `poster_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;
