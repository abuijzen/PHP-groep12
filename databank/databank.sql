-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 23 mei 2019 om 00:36
-- Serverversie: 10.1.40-MariaDB
-- PHP-versie: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rubena1q_eurben`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usersId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `text`, `date`, `usersId`, `postsId`) VALUES
(40, 'At the offf festival?', '2019-05-22 23:56:39', 25, 87);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `followers`
--

CREATE TABLE `followers` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `follow_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follow_id`) VALUES
(36, 25, 22),
(37, 25, 21),
(39, 25, 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `likes`
--

INSERT INTO `likes` (`id`, `usersId`, `postsId`, `date`) VALUES
(283, 9, 84, '2019-05-22 21:50:21'),
(284, 25, 87, '2019-05-22 21:56:07'),
(285, 28, 87, '2019-05-22 22:02:52'),
(286, 29, 87, '2019-05-22 22:25:06'),
(288, 29, 86, '2019-05-22 22:25:08');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `timePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(266) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `usersId`, `timePost`, `visibility`, `message`, `image`, `filter`, `color1`, `color2`, `color3`, `color4`) VALUES
(66, 21, '2019-05-19 00:20:54', 1, 'Cool apple on the wall', 'apple.jpg', '_1977', '664325', '000000', '6A89A8', '0B4400'),
(67, 21, '2019-05-19 00:22:05', 1, 'Dude this is sick!', 'astro.jpg', 'willow', '85C6FE', '27415A', '5A2E15', '9BA640'),
(68, 21, '2019-05-19 00:22:23', 1, 'Just finished', 'bandits.jpg', '', '8595E2', '4AB0BF', '465163', 'DF496C'),
(69, 21, '2019-05-19 00:22:41', 1, 'peace', 'berlin_wall.jpg', 'toaster', 'AF9F7E', '000064', 'C10212', '695B3E'),
(70, 21, '2019-05-19 00:23:07', 1, 'they see me kissing, they rolling', 'car.jpg', 'rise', '4687E1', '576625', 'E5DBC2', 'AD423C'),
(72, 21, '2019-05-19 00:27:30', 1, 'Olifant', 'elephant.jpeg', 'rise', '343A52', '9FCAD1', 'FF9500', 'DF1100'),
(73, 21, '2019-05-19 00:27:46', 1, 'Toerke doen', 'kiss.jpg', '_1977', '80C9D8', '10192A', '652D36', 'C1BBC9'),
(74, 21, '2019-05-19 00:28:18', 1, 'lady lady', 'lady.jpg', 'toaster', '99966D', '525832', '090E12', '606277'),
(75, 21, '2019-05-19 00:28:40', 1, 'old building\r\n', 'old.jpg', '', 'F80000', '635645', '00308F', 'AB977C'),
(76, 21, '2019-05-19 00:28:55', 1, 'pink', 'red_pink.jpg', 'rise', 'CCE8FE', 'F82A68', '812371', '467388'),
(78, 22, '2019-05-19 03:57:52', 1, 'David C.', 'davidC.jpg', 'rise', '266632', 'E8E617', '87C39D', 'EC964D'),
(82, 25, '2019-05-22 22:47:29', 0, 'testen of het werkt', 'Schermafbeelding 2019-05-22 om 22.36.30.png', 'willow', '4648FB', 'BD9C46', '4482B3', 'FC625D'),
(83, 28, '2019-05-22 23:35:43', 1, 'Diep in de zee', 'streetart.jpeg', 'rise', '92E3E6', 'E61006', 'AF7E18', '5A0000'),
(84, 28, '2019-05-22 23:45:36', 1, 'gekke visjes hihi', 'visjes.jpg', 'rise', 'EF6F01', '124149', '008CA7', 'AF1900'),
(85, 9, '2019-05-22 23:46:27', 1, 'Moss paint #wow', 'moss-grow-anna-garforth-300x220_1400x.progressive (1).jpg', 'rise', '002700', '468628', '9B7129', 'B8D48A'),
(86, 9, '2019-05-22 23:55:16', 1, 'This is not street art mwuahaha', 'flower-3140492_960_720.jpg', 'rise', 'F32D8F', '9BE8F2', '600000', 'F6B5C9'),
(87, 25, '2019-05-22 23:56:00', 1, 'Musketon offf wall', 'musketon.jpg', '', '9F3B47', 'E4E4DC', '16191E', '6D6D63'),
(88, 9, '2019-05-23 00:21:28', 1, 'Black', '15585636672834123055771831525738.jpg', 'rise', '070508', '000000', '000000', '000000');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `post_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reports`
--

INSERT INTO `reports` (`id`, `post_Id`, `user_Id`, `date`) VALUES
(158, 82, 9, '2019-05-22 21:50:41'),
(159, 82, 28, '2019-05-22 21:50:45'),
(160, 82, 25, '2019-05-22 21:51:06'),
(161, 85, 27, '2019-05-22 21:52:07'),
(162, 86, 9, '2019-05-22 21:56:05'),
(163, 86, 28, '2019-05-22 21:56:08'),
(164, 78, 29, '2019-05-22 22:24:52');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DoB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profileText` text COLLATE utf8mb4_unicode_ci,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `DoB`, `email`, `password`, `profileText`, `avatar_url`) VALUES
(4, 'Ruben', 'Annaert', '2019-05-02 22:37:55', 'Ruben@gmail.com', '$2y$14$RhJKz.wO5bEIQJYTb4Z2T.jR1N2ses9AJ5Yn2sTR4wXn2FAuoHfpi', NULL, NULL),
(8, 'Amelie', 'Mathijs', '2019-05-03 11:18:01', 'ik@ben.amelie', '$2y$12$Wosrs9qA6IYzceSH.wlRIupcLghcAJDOoG7kcUsV/tZDODGLRvtV6', NULL, NULL),
(9, 'Angelique', 'Buijzen', '2019-05-08 09:37:53', 'angeliquebuijzen@hotmail.com', '$2y$12$bBL3r6m6SgBxBn10eiudvOMxpQ8WyHRSBi5ShYPG4gu79/0ETsq7W', 'designer | developer', './images/44e6ce72f0aff839212938d52cebb6b9_thmb.jpg'),
(21, 'Steve', 'Jobs', '2019-05-18 21:33:03', 'R@A.com', '$2y$12$V6UB8CLlYgdi1xugva07buZPHhrZJpukD3NtiYImBzDi7y4MYJqOi', NULL, NULL),
(22, 'Ruben', 'Annaert', '2019-05-19 01:45:07', 'Ruben@gmail.be', '$2y$12$L32KhotHAKz4MFRJsZQNg.5Swt7HIO/RCnNzFhqDg2V1NtUoQ/nJK', NULL, NULL),
(24, 'Ruben', 'A.', '2019-05-20 16:33:45', 'R@test.be', '$2y$12$qynUkDT9C4kbo5Y2tbU1w.vqbF3GQIZ7GqyH7LQmhg/CTBs7zxVqW', NULL, NULL),
(25, 'Test', 'Werk', '2019-05-21 11:19:45', 'Ruben@test.net', '$2y$12$1LG8U6kW/BCwfZCea2lRseqy7yI334CinSsLClr/dIMkAnafihjjm', NULL, './images/99342e67ef225fd739f94139e0e7ca9d_thmb.jpg'),
(26, 'Ruben', 'Nieuw', '2019-05-22 20:56:15', 'N@R.be', '$2y$12$qn17jHKlRhSaUEMJYAV6mOKftQwVL/aKCm0CqWb7qMSIz1c4aUKVK', NULL, NULL),
(27, 'Simon', 'Van Hove', '2019-05-22 21:33:43', 'simon.vanhove0@gmail.com', '$2y$12$yMncdXH4nrqTHoXkgNbCrOnw9lW1vj2dhLzeEbeEqDQ7yIwe7y1d.', 'dikzak', './images/2e829cfb5c9e2853790f3d07007a244b_thmb.jpg'),
(28, 'amelie', 'amelie', '2019-05-22 21:35:07', 'mathijske@lala.be', '$2y$12$x/.XmLEfUFYNO8m8Td4ROeZf6cUXFIfQkpjE0aBsyFdWNVF3d8piy', 'Check mijn foto\'s ', './images/c4f76424aca6371c7bb7aaae92e3b8f2_thmb.jpg'),
(29, 'Johan', 'De Meester', '2019-05-22 22:23:15', 'johandemeester@boer.be', '$2y$12$9B.aWqlKzGVDJ3vil1uHb.Ktcgz3XWAa12s4G93CfFIsyzGWh59fi', NULL, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postsId` (`postsId`),
  ADD KEY `usersId` (`usersId`);

--
-- Indexen voor tabel `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_link_follower` (`user_id`),
  ADD KEY `follower_link_user` (`follow_id`);

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postsId` (`postsId`),
  ADD KEY `usersId` (`usersId`);

--
-- Indexen voor tabel `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersId` (`usersId`);

--
-- Indexen voor tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_link_posts` (`post_Id`),
  ADD KEY `reports_link_users` (`user_Id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT voor een tabel `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT voor een tabel `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT voor een tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postsId`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `follower_link_user` FOREIGN KEY (`follow_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_link_follower` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`postsId`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_link_posts` FOREIGN KEY (`post_Id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `reports_link_users` FOREIGN KEY (`user_Id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
