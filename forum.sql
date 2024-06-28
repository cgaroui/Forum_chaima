-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum_chaima
CREATE DATABASE IF NOT EXISTS `forum_chaima` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_chaima`;

-- Listage de la structure de table forum_chaima. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_chaima.category : ~3 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(4, 'developpement web '),
	(5, 'cuisine '),
	(6, 'sport ');

-- Listage de la structure de table forum_chaima. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `user_id` (`user_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `topic_id1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `user_id1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_chaima.post : ~18 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `creationDate`, `user_id`, `topic_id`) VALUES
	(1, 'blabla blablaalalalalallal', '2024-06-17 14:36:29', 4, 6),
	(2, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit ad ipsum, explicabo voluptatum earum a sequi accusamus rem, totam dolore, minus illo tenetur culpa quidem eaque ipsa quo? Impedit, mollitia?', '2024-06-17 14:38:47', 5, 6),
	(3, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit ad ipsum, explicabo voluptatum earum a sequi accusamus rem, totam dolore, minus illo tenetur culpa quidem eaque ipsa quo? Impedit, mollitia?', '2024-06-18 13:57:18', 3, 6),
	(7, 'blabla blablaalalalalallal', '2024-06-18 13:58:55', 3, 8),
	(8, 'aaa', '2024-06-27 13:49:51', 5, 14),
	(9, 'zzz', '2024-06-27 16:24:16', 7, 15),
	(10, 'adds', '2024-06-27 16:37:55', 6, 16),
	(12, 'dfsgbr', '2024-06-27 16:43:04', 8, 18),
	(14, 'sdgraz', '2024-06-28 08:49:13', 8, 20),
	(15, 'gdesgt', '2024-06-28 10:52:37', 6, 17),
	(20, 'blabla bla \r\n', '2024-06-28 13:26:23', 8, 7),
	(21, 'COUCOUC c&#039;est moi \r\n', '2024-06-28 13:26:49', 8, 7),
	(23, 'rnzntttttttttttttts', '2024-06-28 13:49:04', 8, 19),
	(24, 'aaaaaaaaaaaaaaaaaaaaaaaa', '2024-06-28 13:49:09', 8, 19),
	(25, 'zzzzzzzzzzzzzzzzzzzzzzz', '2024-06-28 13:49:14', 8, 19),
	(30, 'QSRTJSJS', '2024-06-28 14:01:59', 6, 21),
	(32, 'djetjz', '2024-06-28 14:24:08', 6, 7),
	(34, 'jnjujbiu', '2024-06-28 15:28:24', 8, 19);

-- Listage de la structure de table forum_chaima. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `closed` bit(1) NOT NULL DEFAULT b'0',
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `creationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_topic`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE SET NULL,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_chaima.topic : ~16 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `closed`, `user_id`, `category_id`, `creationDate`) VALUES
	(6, 'comment faire un fondant au chocolat ', b'1', 3, 5, '2024-06-17 14:34:34'),
	(7, ' RGPD ', b'0', 5, 4, '2024-06-17 14:35:24'),
	(8, 'exercices fitness', b'1', 3, 6, '2024-06-17 14:36:03'),
	(9, 'comment faire un fraisier ', b'1', 4, 5, '2024-06-18 14:41:00'),
	(10, 'tarte aux pommes ', b'0', 3, 5, '2024-06-18 14:41:18'),
	(11, 'couses de chevaux ', b'0', 5, 6, '2024-06-18 14:42:08'),
	(12, 'waterpolo', b'1', 3, 6, '2024-06-18 14:42:07'),
	(13, 'comment faire des macarons', b'1', 4, 5, '2024-06-18 14:42:38'),
	(14, 'Mon topic', b'0', 5, 5, '2024-06-27 13:49:51'),
	(15, 'zzz', b'1', 5, 5, '2024-06-27 16:24:16'),
	(16, 'aaa', b'1', 5, 5, '2024-06-27 16:37:55'),
	(17, 'tartelettes aux framboises ', b'1', 5, 5, '2024-06-27 16:41:44'),
	(18, 'foot', b'1', 8, 6, '2024-06-27 16:43:04'),
	(19, 'macarons', b'0', 6, 5, '2024-06-27 16:47:11'),
	(20, 'football', b'1', 8, 6, '2024-06-28 08:49:13'),
	(21, 'SJQJZS', b'0', 6, 6, '2024-06-28 14:01:41');

-- Listage de la structure de table forum_chaima. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickName` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `creationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_chaima.user : ~6 rows (environ)
INSERT INTO `user` (`id_user`, `nickName`, `password`, `role`, `creationDate`, `email`) VALUES
	(3, 'chaima', '11111', 'user', '2024-06-27 08:59:07', 'chaima@exemple.fr'),
	(4, 'asma ', 'aaaaa', 'user', '2024-06-27 08:59:07', 'asma@exemple.fr'),
	(5, 'idriss', 'aaaaa', 'user', '2024-06-27 08:59:12', 'idriss@exemple.fr'),
	(6, 'micka', '$2y$10$69G5EBCZQWOorxEvgFXSG.2IXB1VDDktT19NuvPO18vYddVetfTd.', 'user', '2024-06-27 10:35:33', 'mickael2@exemple.com'),
	(7, 'ikram', '$2y$10$P13Puz9mzBmPJJTTRseID.nvF.yXHnMqcPnJy4cDKaFqKcwKMvdxO', 'user', '2024-06-27 10:39:50', 'ikram@exemple.com'),
	(8, 'yas', '$2y$10$DX2zd0oWy05tjP4z2L6cUuX4tLq0fi09cjbaflF7lLGOJLOos9crW', 'admin', '2024-06-27 16:40:45', 'yass@exemple.fr');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
