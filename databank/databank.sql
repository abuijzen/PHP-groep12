# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.23)
# Database: eurben
# Generation Time: 2019-05-16 12:20:10 +0000
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
	(19,'school','2019-05-08 11:38:08',9,8),
	(20,'schoon','2019-05-08 11:38:15',9,8),
	(26,'Leuk','2019-05-15 16:59:27',8,8),
	(27,'Leuke Dora!','2019-05-15 21:15:28',8,51),
	(28,'Test','2019-05-16 11:10:28',12,55),
	(29,'Rv','2019-05-16 11:25:40',12,61),
	(30,'hell','2019-05-16 12:18:17',16,63);

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
	(196,16,61,'2019-05-16 12:14:49');

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
	(5,1,'2019-05-03 00:03:34',1,'Pink Woman','pinkWoman.jpg','','','','',''),
	(6,1,'2019-05-03 00:03:47',1,'Den John\r\n','lennon.jpg','','','','',''),
	(7,1,'2019-05-03 00:04:00',1,'Blauwe madam\r\n','blueWoman.jpg','','','','',''),
	(8,1,'2019-05-03 00:04:10',1,'Samen \r\n','together.jpg','','DD913B','833A17','1D1C24','FFF4D4'),
	(9,9,'2019-05-08 12:58:00',1,'qerty','wp1835235.jpg','','','','',''),
	(38,10,'2019-05-12 16:07:25',1,'Moss paint','moss-grow-anna-garforth-300x220_1400x.progressive.jpg','_1977','','','',''),
	(39,8,'2019-05-14 22:14:56',1,'Gekke Dora','dora.jpg','rise','FF0080','804000','E8C375','7F00FF'),
	(40,8,'2019-05-14 22:19:26',1,'','dora.jpg','rise','FF0080','804000','E8C375','7F00FF'),
	(41,8,'2019-05-15 16:08:15',1,'','dora.jpg','rise','FF0080','804000','E8C375','7F00FF'),
	(42,8,'2019-05-15 16:10:45',1,'','52651784_250088162566862_43683468122521600_n.jpg','rise','DD913B','833A17','1D1C24','FFF4D4'),
	(43,8,'2019-05-15 16:12:45',1,'','dora.jpg','rise','FF0080','804000','E8C375','7F00FF'),
	(44,8,'2019-05-15 16:17:33',1,'','dora.jpg','rise','FF0080','804000','E8C375','7F00FF'),
	(45,8,'2019-05-15 16:18:59',1,'','dora.jpg','rise','FF0080','804000','E8C375','7F00FF'),
	(46,8,'2019-05-15 16:19:05',1,'','52651784_250088162566862_43683468122521600_n.jpg','rise','DD913B','833A17','1D1C24','FFF4D4'),
	(47,8,'2019-05-15 16:21:11',1,'','dora.jpg','rise','FF0080','804000','E8C375','7F00FF'),
	(48,8,'2019-05-15 16:21:30',1,'','dora.jpg','rise','FF0080','804000','E8C375','7F00FF'),
	(49,8,'2019-05-15 16:22:05',1,'','52651784_250088162566862_43683468122521600_n.jpg','rise','DD913B','833A17','1D1C24','FFF4D4'),
	(50,8,'2019-05-15 16:55:05',1,'','dora.jpg','rise','FF0080','804000','E8C375','7F00FF'),
	(51,8,'2019-05-15 21:15:08',1,'dez','dora.jpg','rise','FF0080','804000','E8C375','7F00FF'),
	(52,8,'2019-05-15 21:15:48',1,'esrdxtcfgv','52651784_250088162566862_43683468122521600_n.jpg','rise','DD913B','833A17','1D1C24','FFF4D4'),
	(53,8,'2019-05-15 21:18:52',1,'Lekkere Bicky Burgers ','Bicky_IMG26.png','willow','005029','E30514','F59F13','004996'),
	(54,8,'2019-05-15 21:30:07',1,'','Bicky_IMG26.png','rise','005029','E30514','F59F13','004996'),
	(55,8,'2019-05-15 21:44:41',1,'','dora.jpg','','FF0080','804000','E8C375','7F00FF'),
	(61,12,'2019-05-16 11:25:21',1,'','cinema.jpg','rise','D8A42C','000000','8D5D09','000000'),
	(62,16,'2019-05-16 12:16:55',1,'haha','font_workshop2.jpg','rise',NULL,NULL,NULL,NULL),
	(63,16,'2019-05-16 12:18:03',1,'test','Schermafbeelding 2019-05-16 om 09.52.57.png','rise','4C9CFC','F4F5F5','707171','272727');

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
	(121,8,12,'2019-05-16 11:49:57'),
	(122,61,16,'2019-05-16 12:15:06'),
	(123,55,16,'2019-05-16 12:15:21'),
	(124,63,16,'2019-05-16 12:18:08'),
	(125,54,16,'2019-05-16 12:25:20');

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
	(11,'','','2019-05-16 10:37:26','Ruben@gmail.com','$2y$12$b3ERMNir30CIQRfgoaniA.lop50KGCOsIScW7p4hAN.QeiYe2SY7q'),
	(12,'','','2019-05-16 10:39:22','Ruben@a.com','$2y$12$jHSc9h/2rpF8GL.hNfwbt.0Aj9n.NAlFG1hi5tHIgi.1UTUwUvjBW'),
	(13,'','','2019-05-16 10:42:17','b@h.be','$2y$12$WmwsTXvJq/AjGnJowUv8WOM2sTIirwxitw.b4cxvyHkKygcH10iAS'),
	(14,'gh','ghj','2019-05-16 11:06:02','ghui','$2y$12$i0CIA7sB8s0OmXrSAqImS.zkgh6DvObeuMX9kwkTylY.bmT01w8oa'),
	(15,'fgh','fghj','2019-05-16 12:01:22','fgh@j.be','$2y$12$HDjcpK1L0gjHtqRjTalCWeLQqixYGdUpiJhsq41o0sk.Sgkl2Zl6m'),
	(16,'Ruben','Annaert','2019-05-16 12:03:10','Ruben@test.be','$2y$12$bhMtaRU5/4ePkBlClq4FVOLi9kFl6bC6e.vTnchz8difNvsb47DlK');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
