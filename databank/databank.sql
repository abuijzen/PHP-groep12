-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 12, 2019 at 02:07 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `eurben`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usersId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text`, `date`, `usersId`, `postsId`) VALUES
(5, 'Mooi', '2019-05-06 14:21:05', 8, 8),
(7, 'Beeldig', '2019-05-06 15:51:54', 8, 8),
(9, 'Magnifiek', '2019-05-06 15:53:27', 8, 8),
(10, 'ok', '2019-05-06 16:00:08', 8, 8),
(11, 'ferm', '2019-05-06 17:17:58', 8, 7),
(12, 'Leuk', '2019-05-06 17:18:37', 8, 7),
(13, 'Cool', '2019-05-06 17:20:24', 8, 7),
(14, 'Mooi', '2019-05-06 17:20:50', 8, 7),
(15, 'Pretty', '2019-05-06 17:21:37', 8, 7),
(16, 'Ganz toll', '2019-05-06 17:25:25', 8, 7),
(17, 'Sehr schön', '2019-05-06 17:27:01', 8, 7),
(18, 'Graaf', '2019-05-06 17:28:45', 8, 6),
(19, 'school', '2019-05-08 11:38:08', 9, 8),
(20, 'schoon', '2019-05-08 11:38:15', 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `personA` int(11) NOT NULL,
  `personB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `usersId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `timePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(266) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `usersId`, `timePost`, `visibility`, `message`, `image`, `filter`) VALUES
(5, 1, '2019-05-03 00:03:34', 1, 'Pink Woman', 'pinkWoman.jpg', ''),
(6, 1, '2019-05-03 00:03:47', 1, 'Den John\r\n', 'lennon.jpg', ''),
(7, 1, '2019-05-03 00:04:00', 1, 'Blauwe madam\r\n', 'blueWoman.jpg', ''),
(8, 1, '2019-05-03 00:04:10', 1, 'Samen \r\n', 'together.jpg', ''),
(9, 9, '2019-05-08 12:58:00', 1, 'qerty', 'wp1835235.jpg', ''),
(38, 10, '2019-05-12 16:07:25', 1, 'Moss paint', 'moss-grow-anna-garforth-300x220_1400x.progressive.jpg', '_1977');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DoB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `DoB`, `email`, `password`) VALUES
(1, 'ghj', 'ghjk', '2019-05-21 22:00:00', 'ghjklm', 'fghjk'),
(2, 'Ruben', 'Annaert', '2019-05-02 22:35:16', 'rubenannaert@test.be', '$2y$14$nW8BzAGkgrrjD0SpoNODTO4nDi5XQSnRm78yPbx1nCO1Gsv/wF/wy'),
(3, 'Ruben', 'Annaert', '2019-05-02 22:35:51', 'Ruben@gmail.com', '$2y$14$FZj5qxbRwcKXKwVOv2qSBOiWxKXAE5/U9CluYfa6V.7ICi1FGBfGa'),
(4, 'Ruben', 'Annaert', '2019-05-02 22:37:55', 'Ruben@gmail.com', '$2y$14$RhJKz.wO5bEIQJYTb4Z2T.jR1N2ses9AJ5Yn2sTR4wXn2FAuoHfpi'),
(5, 'Ruben', 'test', '2019-05-02 22:38:19', 'test@123.be', '$2y$14$bX9YLe.jOOyt1pT7r79uI.kf7g3.fLzd1qyETePiFdTYRwm6ggBei'),
(6, 'Ruben', 'testen', '2019-05-02 22:39:42', 'ik@ben.ruben', '$2y$14$178oUnbmJHrYzLBqfLyYL.R8L5q5N1mKAnMb.NUqOBSnhj3Abzwia'),
(7, 'test', 'testacc', '2019-05-02 22:45:13', 'test@ww.com', '$2y$12$oxKXW7Bs.HSOhTFH06h3N.7g2r0Pn.F/qeYFP/aQXY2kPf/SbN9E.'),
(8, 'Amelie', 'Mathijs', '2019-05-03 11:18:01', 'ik@ben.amelie', '$2y$12$Wosrs9qA6IYzceSH.wlRIupcLghcAJDOoG7kcUsV/tZDODGLRvtV6'),
(9, 'Angelique', 'Buijzen', '2019-05-08 09:37:53', 'angeliquebuijzen@hotmail.com', '$2y$12$bBL3r6m6SgBxBn10eiudvOMxpQ8WyHRSBi5ShYPG4gu79/0ETsq7W'),
(10, 'Angelique', 'Buijzen', '2019-05-08 11:09:28', 'info@spam.be', '$2y$12$JyNvY9sNOgj0hUPRfJ3h0ujzOmU/CM6iqXBb3vlYeuybpvV..FrIa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postsId` (`postsId`),
  ADD KEY `usersId` (`usersId`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personA` (`personA`),
  ADD KEY `personB` (`personB`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postsId` (`postsId`),
  ADD KEY `usersId` (`usersId`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersId` (`usersId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postsId`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`);

--
-- Constraints for table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `friendships_ibfk_1` FOREIGN KEY (`personA`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friendships_ibfk_2` FOREIGN KEY (`personB`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`postsId`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`);
