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
  `creationDate` datetime NOT NULL,
  `user_id` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `user_id` (`user_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `topic_id1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `user_id1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_chaima.post : ~7 rows (environ)
INSERT INTO `post` (`id_post`, `text`, `creationDate`, `user_id`, `topic_id`) VALUES
	(1, 'blabla blablaalalalalallal', '2024-06-17 14:36:29', 4, 6),
	(2, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit ad ipsum, explicabo voluptatum earum a sequi accusamus rem, totam dolore, minus illo tenetur culpa quidem eaque ipsa quo? Impedit, mollitia?', '2024-06-17 14:38:47', 5, 6),
	(3, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit ad ipsum, explicabo voluptatum earum a sequi accusamus rem, totam dolore, minus illo tenetur culpa quidem eaque ipsa quo? Impedit, mollitia?', '2024-06-18 13:57:18', 3, 6),
	(4, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit ad ipsum, explicabo voluptatum earum a sequi accusamus rem, totam dolore, minus illo tenetur culpa quidem eaque ipsa quo? Impedit, mollitia?', '2024-06-18 13:57:45', 4, 7),
	(5, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit ad ipsum, explicabo voluptatum earum a sequi accusamus rem, totam dolore, minus illo tenetur culpa quidem eaque ipsa quo? Impedit, mollitia?', '2024-06-18 13:58:02', 3, 7),
	(6, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit ad ipsum, explicabo voluptatum earum a sequi accusamus rem, totam dolore, minus illo tenetur culpa quidem eaque ipsa quo? Impedit, mollitia?', '2024-06-18 13:58:19', 5, 7),
	(7, 'blabla blablaalalalalallal', '2024-06-18 13:58:55', 3, 8);

-- Listage de la structure de table forum_chaima. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `closed` bit(1) NOT NULL DEFAULT b'0',
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE SET NULL,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_chaima.topic : ~8 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `closed`, `user_id`, `category_id`, `creationDate`) VALUES
	(6, 'comment faire un fondant au chocolat ', b'0', 3, 5, '2024-06-17 14:34:34'),
	(7, ' RGPD ', b'0', 5, 4, '2024-06-17 14:35:24'),
	(8, 'exercices fitness', b'0', 3, 6, '2024-06-17 14:36:03'),
	(9, 'comment faire un fraisier ', b'0', 4, 5, '2024-06-18 14:41:00'),
	(10, 'tarte aux pommes ', b'0', 3, 5, '2024-06-18 14:41:18'),
	(11, 'couses de chevaux ', b'0', 5, 6, '2024-06-18 14:42:08'),
	(12, 'waterpolo', b'0', 3, 6, '2024-06-18 14:42:07'),
	(13, 'comment faire des macarons', b'0', 4, 5, '2024-06-18 14:42:38');

-- Listage de la structure de table forum_chaima. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickName` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum_chaima.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `nickName`, `password`, `role`, `creationDate`, `email`) VALUES
	(3, 'chaima', NULL, NULL, NULL, NULL),
	(4, 'asma ', NULL, NULL, NULL, NULL),
	(5, 'idriss', NULL, NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
