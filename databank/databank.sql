# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.23)
# Database: eurben
# Generation Time: 2019-05-09 22:58:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usersId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `postsId` (`postsId`),
  KEY `usersId` (`usersId`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postsId`) REFERENCES `posts` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `text`, `date`, `usersId`, `postsId`)
VALUES
	(5,'Mooi','2019-05-06 14:21:05',8,8),
	(7,'Beeldig','2019-05-06 15:51:54',8,8),
	(9,'Magnifiek','2019-05-06 15:53:27',8,8),
	(10,'ok','2019-05-06 16:00:08',8,8),
	(11,'ferm','2019-05-06 17:17:58',8,7),
	(12,'Leuk','2019-05-06 17:18:37',8,7),
	(13,'Cool','2019-05-06 17:20:24',8,7),
	(14,'Mooi','2019-05-06 17:20:50',8,7),
	(15,'Pretty','2019-05-06 17:21:37',8,7),
	(16,'Ganz toll','2019-05-06 17:25:25',8,7),
	(17,'Sehr schön','2019-05-06 17:27:01',8,7),
	(18,'Graaf','2019-05-06 17:28:45',8,6),
	(25,'nice man','2019-05-10 00:56:42',12,29);

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table friendships
# ------------------------------------------------------------

DROP TABLE IF EXISTS `friendships`;

CREATE TABLE `friendships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startdate` datetime NOT NULL,
  `personA` int(11) NOT NULL,
  `personB` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personA` (`personA`),
  KEY `personB` (`personB`),
  CONSTRAINT `friendships_ibfk_1` FOREIGN KEY (`personA`) REFERENCES `users` (`id`),
  CONSTRAINT `friendships_ibfk_2` FOREIGN KEY (`personB`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `postsId` (`postsId`),
  KEY `usersId` (`usersId`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`postsId`) REFERENCES `posts` (`id`),
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;

INSERT INTO `likes` (`id`, `usersId`, `postsId`, `date`)
VALUES
	(14,12,6,'2019-05-10 00:21:52'),
	(15,12,5,'2019-05-10 00:21:54'),
	(18,12,8,'2019-05-10 00:56:08'),
	(19,12,29,'2019-05-10 00:56:32');

/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pictures
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pictures`;

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `timePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(266) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usersId` (`usersId`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `usersId`, `timePost`, `visibility`, `message`, `image`, `filter`)
VALUES
	(5,1,'2019-05-03 00:03:34',1,'Pink Woman','pinkWoman.jpg',''),
	(6,1,'2019-05-03 00:03:47',1,'Den John\r\n','lennon.jpg',''),
	(7,1,'2019-05-03 00:04:00',1,'Blauwe madam\r\n','blueWoman.jpg',''),
	(8,1,'2019-05-03 00:04:10',1,'Samen \r\n','together.jpg',''),
	(29,12,'2019-05-10 00:56:29',1,'Nice building','nastaran-taghipour-1266551-unsplash.jpg','_1977');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DoB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `DoB`, `email`, `password`)
VALUES
	(1,'ghj','ghjk','2019-05-22 00:00:00','ghjklm','fghjk'),
	(2,'Ruben','Annaert','2019-05-03 00:35:16','rubenannaert@test.be','$2y$14$nW8BzAGkgrrjD0SpoNODTO4nDi5XQSnRm78yPbx1nCO1Gsv/wF/wy'),
	(3,'Ruben','Annaert','2019-05-03 00:35:51','Ruben@gmail.com','$2y$14$FZj5qxbRwcKXKwVOv2qSBOiWxKXAE5/U9CluYfa6V.7ICi1FGBfGa'),
	(4,'Ruben','Annaert','2019-05-03 00:37:55','Ruben@gmail.com','$2y$14$RhJKz.wO5bEIQJYTb4Z2T.jR1N2ses9AJ5Yn2sTR4wXn2FAuoHfpi'),
	(5,'Ruben','test','2019-05-03 00:38:19','test@123.be','$2y$14$bX9YLe.jOOyt1pT7r79uI.kf7g3.fLzd1qyETePiFdTYRwm6ggBei'),
	(6,'Ruben','testen','2019-05-03 00:39:42','ik@ben.ruben','$2y$14$178oUnbmJHrYzLBqfLyYL.R8L5q5N1mKAnMb.NUqOBSnhj3Abzwia'),
	(7,'test','testacc','2019-05-03 00:45:13','test@ww.com','$2y$12$oxKXW7Bs.HSOhTFH06h3N.7g2r0Pn.F/qeYFP/aQXY2kPf/SbN9E.'),
	(8,'Amelie','Mathijs','2019-05-03 13:18:01','ik@ben.amelie','$2y$12$Wosrs9qA6IYzceSH.wlRIupcLghcAJDOoG7kcUsV/tZDODGLRvtV6'),
	(9,'Angelique','Buijzen','2019-05-08 11:37:53','angeliquebuijzen@hotmail.com','$2y$12$bBL3r6m6SgBxBn10eiudvOMxpQ8WyHRSBi5ShYPG4gu79/0ETsq7W'),
	(10,'Angelique','Buijzen','2019-05-08 13:09:28','info@spam.be','$2y$12$JyNvY9sNOgj0hUPRfJ3h0ujzOmU/CM6iqXBb3vlYeuybpvV..FrIa'),
	(11,'Ruben','Annaert','2019-05-09 10:25:21','test@mail.be','$2y$12$DESLmxhhJVYkd4qgp0jeb.iE72oUly./P.rzLADxXTrs.qhEjTMQK'),
	(12,'het','werkt','2019-05-09 23:58:48','niet@test.be','$2y$12$GjZkKklARi7HufRxgzN7uuNZYrUdECmS8IJixkmVYUc8f6DNNwVne');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
