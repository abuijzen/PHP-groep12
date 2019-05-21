# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.23)
# Database: eurben
# Generation Time: 2019-05-21 12:08:05 +0000
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
	(33,'Wooow dit is vet','2019-05-19 00:36:32',21,76),
	(34,'Eww','2019-05-19 00:36:42',21,70),
	(35,'test','2019-05-20 13:39:02',22,76);

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table followers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `followers`;

CREATE TABLE `followers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `follow_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_link_follower` (`user_id`),
  KEY `follower_link_user` (`follow_id`),
  CONSTRAINT `follower_link_user` FOREIGN KEY (`follow_id`) REFERENCES `users` (`id`),
  CONSTRAINT `user_link_follower` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `followers` WRITE;
/*!40000 ALTER TABLE `followers` DISABLE KEYS */;

INSERT INTO `followers` (`id`, `user_id`, `follow_id`)
VALUES
	(31,24,22);

/*!40000 ALTER TABLE `followers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
	(217,21,69,'2019-05-19 00:27:08'),
	(218,21,75,'2019-05-19 00:30:06'),
	(219,21,74,'2019-05-19 00:30:07'),
	(220,21,76,'2019-05-19 00:31:48'),
	(239,24,76,'2019-05-20 18:34:08'),
	(240,24,78,'2019-05-20 18:49:34');

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
  `color1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usersId` (`usersId`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `usersId`, `timePost`, `visibility`, `message`, `image`, `filter`, `color1`, `color2`, `color3`, `color4`)
VALUES
	(66,21,'2019-05-19 00:20:54',1,'Cool apple on the wall','apple.jpg','_1977','664325','000000','6A89A8','0B4400'),
	(67,21,'2019-05-19 00:22:05',1,'Dude this is sick!','astro.jpg','willow','85C6FE','27415A','5A2E15','9BA640'),
	(68,21,'2019-05-19 00:22:23',1,'Just finished','bandits.jpg','','8595E2','4AB0BF','465163','DF496C'),
	(69,21,'2019-05-19 00:22:41',1,'peace','berlin_wall.jpg','toaster','AF9F7E','000064','C10212','695B3E'),
	(70,21,'2019-05-19 00:23:07',1,'they see me kissing, they rolling','car.jpg','rise','4687E1','576625','E5DBC2','AD423C'),
	(72,21,'2019-05-19 00:27:30',1,'Olifant','elephant.jpeg','rise','343A52','9FCAD1','FF9500','DF1100'),
	(73,21,'2019-05-19 00:27:46',1,'Toerke doen','kiss.jpg','_1977','80C9D8','10192A','652D36','C1BBC9'),
	(74,21,'2019-05-19 00:28:18',1,'lady lady','lady.jpg','toaster','99966D','525832','090E12','606277'),
	(75,21,'2019-05-19 00:28:40',1,'old building\r\n','old.jpg','','F80000','635645','00308F','AB977C'),
	(76,21,'2019-05-19 00:28:55',1,'pink','red_pink.jpg','rise','CCE8FE','F82A68','812371','467388'),
	(78,22,'2019-05-19 03:57:52',1,'David C.','davidC.jpg','rise','266632','E8E617','87C39D','EC964D');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reports
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reports`;

CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reports_link_posts` (`post_Id`),
  KEY `reports_link_users` (`user_Id`),
  CONSTRAINT `reports_link_posts` FOREIGN KEY (`post_Id`) REFERENCES `posts` (`id`),
  CONSTRAINT `reports_link_users` FOREIGN KEY (`user_Id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;

INSERT INTO `reports` (`id`, `post_Id`, `user_Id`, `date`)
VALUES
	(138,76,21,'2019-05-19 00:31:30'),
	(139,74,21,'2019-05-19 02:15:17'),
	(142,78,24,'2019-05-20 18:33:54'),
	(143,76,24,'2019-05-20 18:33:58'),
	(144,75,24,'2019-05-20 18:49:07'),
	(145,73,24,'2019-05-20 21:38:55');

/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
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
  `profileText` text COLLATE utf8mb4_unicode_ci,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `DoB`, `email`, `password`, `profileText`, `avatar_url`)
VALUES
	(4,'Ruben','Annaert','2019-05-03 00:37:55','Ruben@gmail.com','$2y$14$RhJKz.wO5bEIQJYTb4Z2T.jR1N2ses9AJ5Yn2sTR4wXn2FAuoHfpi',NULL,NULL),
	(8,'Amelie','Mathijs','2019-05-03 13:18:01','ik@ben.amelie','$2y$12$Wosrs9qA6IYzceSH.wlRIupcLghcAJDOoG7kcUsV/tZDODGLRvtV6',NULL,NULL),
	(9,'Angelique','Buijzen','2019-05-08 11:37:53','angeliquebuijzen@hotmail.com','$2y$12$bBL3r6m6SgBxBn10eiudvOMxpQ8WyHRSBi5ShYPG4gu79/0ETsq7W',NULL,NULL),
	(21,'Steve','Jobs','2019-05-18 23:33:03','R@A.com','$2y$12$V6UB8CLlYgdi1xugva07buZPHhrZJpukD3NtiYImBzDi7y4MYJqOi',NULL,NULL),
	(22,'Ruben','Annaert','2019-05-19 03:45:07','Ruben@gmail.be','$2y$12$L32KhotHAKz4MFRJsZQNg.5Swt7HIO/RCnNzFhqDg2V1NtUoQ/nJK',NULL,NULL),
	(24,'Ruben','A.','2019-05-20 18:33:45','R@test.be','$2y$12$qynUkDT9C4kbo5Y2tbU1w.vqbF3GQIZ7GqyH7LQmhg/CTBs7zxVqW',NULL,NULL),
	(25,'Test','Werk','2019-05-21 13:19:45','Ruben@test.net','$2y$12$1LG8U6kW/BCwfZCea2lRseqy7yI334CinSsLClr/dIMkAnafihjjm',NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
