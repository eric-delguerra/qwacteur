-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 31 juil. 2019 à 13:40
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `canard`
--

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `author_id` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FEC530A9F675F31B` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `content`
--

INSERT INTO `content` (`id`, `content`, `created_at`, `author_id`, `picture`, `tag`, `parent`) VALUES
(6, 'bfkrbferivrvmo', '2019-07-26 14:20:05', 2, NULL, NULL, 0),
(8, 'jheifru trocskberz ', '2019-07-26 14:39:37', 3, NULL, NULL, 6),
(9, 'Une image publique', '2019-07-26 14:47:36', 4, NULL, NULL, 0),
(12, 'Moi j\'ai envie de coincoin !', '2019-07-26 16:28:20', 1, NULL, NULL, 0),
(13, 'J\'ai rien compris', '2019-07-26 16:31:54', 1, NULL, NULL, 6),
(14, 'On peut se voir au bord du lac ce soir si tu veux', '2019-07-26 16:44:32', 5, NULL, NULL, 12);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duckname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `picture`, `duckname`, `mail`, `password`, `roles`) VALUES
(1, 'Le fou furieu', 'Le fou furieu', 'https://miro.medium.com/max/1313/1*eFjpoz8lhNKyd8XcSWv2OA.jpeg', 'Le fou furieu', 'lo', 'lo', 'a:0:{}'),
(2, 'Donald', 'Dodo', 'https://cdn.pixabay.com/photo/2019/03/18/06/52/mallard-duck-4062460_960_720.jpg', 'Mother of the Canards', 'fr', 'fr', 'a:0:{}'),
(3, 'Jean', 'Jean', NULL, 'Le canard farouche', 'jean', 'jean', 'a:0:{}'),
(4, 'Bastien', 'Bastien', 'dist/imgs/balthazardAuNaturel.png', 'Balthazar le Canard', 'bastien', 'bastien', 'a:0:{}'),
(5, 'Dominique', 'Ique', 'https://www.pressandjournal.co.uk/wp-content/uploads/sites/2/2015/01/Duck-pic.jpg', 'Ras les pumes', 'ra', 'ra', 'a:0:{}');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `FK_FEC530A9F675F31B` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
