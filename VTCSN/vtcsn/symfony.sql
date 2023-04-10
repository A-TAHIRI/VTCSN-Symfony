-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 14 fév. 2023 à 14:23
-- Version du serveur : 8.0.27
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_order` int NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_497DD634727ACA70` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `parent_id`, `name`, `categorie_order`, `slug`) VALUES
(17, NULL, 'Bijoux', 1, 'bijoux'),
(18, 17, 'Collier ', 2, 'collier'),
(19, 17, 'B.d\'oreille', 3, 'b-d-oreille'),
(20, 17, 'Bracelet', 4, 'bracelet'),
(21, 17, 'Bague', 5, 'bague'),
(22, 17, 'B.cheville', 6, 'b-cheville'),
(23, NULL, 'Accessoires', 7, 'accessoires'),
(24, 23, 'Montre', 8, 'montre');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Actualité');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `firstname`, `email`, `subject`, `message`, `created_at`) VALUES
(11, 'Marcel Le Nicolas', 'jacqueline.boutin@laposte.net', 'Demande n°1', 'Tempora nulla et quo. Delectus atque consequatur corporis tenetur atque ipsum animi sed. Aut odit odit ea.', '2023-02-04 21:07:27'),
(12, 'Nicolas Maurice-Diaz', 'qfouquet@free.fr', 'Demande n°2', 'Aspernatur voluptas quis blanditiis aut consequatur aperiam saepe. Facere dolorem est animi voluptatem molestiae voluptatem et. Ut debitis id illo rerum voluptatibus.', '2023-02-04 21:07:27'),
(13, 'Antoinette-Odette Pereira', 'franck46@leclercq.fr', 'Demande n°3', 'Eum quae omnis quo et cumque commodi qui. Aut quis excepturi eius molestiae. Et aspernatur aut delectus molestias.', '2023-02-04 21:07:27'),
(14, 'Célina Becker', 'munoz.isaac@thomas.fr', 'Demande n°4', 'Quo qui distinctio ea blanditiis reiciendis fuga soluta. Non rem est hic accusamus at. Quasi a sed at voluptas ducimus commodi dicta.', '2023-02-04 21:07:27'),
(15, 'Grégoire Bonneau-Mendes', 'thibault.dasilva@moreno.fr', 'Demande n°5', 'Deleniti deleniti aut ex repellat repellendus nobis tempora cumque. Doloribus tenetur expedita explicabo consectetur debitis voluptates. Non enim modi modi ea architecto porro.', '2023-02-04 21:07:27'),
(16, 'add', 'test1@gmail.com', 'fgdf', 'fdfdf', '2023-02-05 13:35:53'),
(17, '<xdsdsqd', 'test1@gmail.com', 'sd<sd', 'dsdwdwfd', '2023-02-05 13:42:24');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230204154828', '2023-02-04 15:48:52', 1875),
('DoctrineMigrations\\Version20230204160623', '2023-02-04 16:06:30', 99),
('DoctrineMigrations\\Version20230204162630', '2023-02-04 16:26:36', 98),
('DoctrineMigrations\\Version20230209163259', '2023-02-09 16:33:23', 844),
('DoctrineMigrations\\Version20230210141608', '2023-02-10 14:17:44', 1064),
('DoctrineMigrations\\Version20230210142528', '2023-02-10 14:25:38', 881),
('DoctrineMigrations\\Version20230211134433', '2023-02-11 13:48:19', 1611),
('DoctrineMigrations\\Version20230211174347', '2023-02-11 17:43:58', 356),
('DoctrineMigrations\\Version20230211174547', '2023-02-11 17:45:59', 1309);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045F4584665A` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `product_id`, `name`) VALUES
(4, 12, '7f6e79314fd11aaa694970e797c2aeee.webp'),
(5, 12, '4a8f63ed814d86c3a3eb03b459dd5baf.webp'),
(6, 12, 'da703234c7e8f58a178f73db513d7021.webp');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE IF NOT EXISTS `newsletters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categories_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `is_sent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8ECF000CA21214B7` (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `newsletters`
--

INSERT INTO `newsletters` (`id`, `categories_id`, `name`, `content`, `created_at`, `is_sent`) VALUES
(1, 1, 'aaaaaaaaaaaaaa', '<p>aaaaaaaaaaaaaaa</p>', '2023-02-13 14:40:43', 0),
(2, 1, 'aaaaaaaaaaaaaa', '<p>aaaaaaaaaaaaaaa</p>', '2023-02-13 14:41:06', 0);

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `price` int NOT NULL,
  `reference` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  `stripe_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_stripe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last4_stripe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_charge_stripe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_stripe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F5299398AEA34913` (`reference`),
  KEY `IDX_F52993984584665A` (`product_id`),
  KEY `IDX_F5299398A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04ADBCF5E72D` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `categorie_id`, `name`, `description`, `price`, `stock`, `slug`, `created_at`) VALUES
(12, 18, 'aaaaaaaaa', 'aaaaaaaaal', 2299, 10, 'aaaaaaaaa', '2023-02-07 13:45:15');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `reset_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `lastname`, `firstname`, `address`, `zipcode`, `city`, `is_verified`, `reset_token`, `created_at`) VALUES
(1, 'abdelouafit85@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$cuSCHszRXM65xc4TOiJZ8eo0ha.Y/fZWEjC0lm66qnasqfM25sp9C', 'Tahiri', 'Abdelouafi', '23 rue de paris', '75000', 'Paris', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjpudWxsLCJpYXQiOjE2NzU1NDU0MjksImV4cCI6MTY3NTU1NjI', '2023-02-04 21:17:05'),
(2, 'test1@gmail.com', '[]', '$2y$13$MXtzp9lbw.kOgI6QOP7LOe4UMzDsH/cCP3wfBku7fNFKQrptzESZG', 'tahiri', 'add', '12 rue de nord', '75000', 'paris', 0, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjpudWxsLCJpYXQiOjE2NzU2MDM5NDMsImV4cCI6MTY3NTYxNDc', '2023-02-05 13:32:18');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `validation_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `created_at`, `validation_token`, `is_valid`) VALUES
(1, 'test2@gmail.com', '2023-02-13 14:10:39', 'c423436fb5f8090da7e9101f5faedfdade27ff8d4986e15486499a8572b40a85', 0),
(2, 'test3@gmail.com', '2023-02-13 14:11:32', '3f55162d3c5298532e9129504fb722657da1b3abf4c4b8a1a39a623080a12207', 0),
(3, 'test3@gmail.com', '2023-02-13 14:12:56', 'f519919286156e715e18439b27581c0f1630b04d8c859332498f8776c7a8c6e0', 0),
(4, 'test4@gmail.com', '2023-02-13 14:13:24', 'f02274c069e70545851bee41b2a490f9c716d7f5a6b3034c9f0ca27007e70fcf', 1),
(5, 'test5@gmail.com', '2023-02-13 14:16:47', '1e25c66773a277df58995d126a558cb9050d6a48d309fcca9b1de5f7d61165fd', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users_categories`
--

DROP TABLE IF EXISTS `users_categories`;
CREATE TABLE IF NOT EXISTS `users_categories` (
  `users_id` int NOT NULL,
  `categories_id` int NOT NULL,
  PRIMARY KEY (`users_id`,`categories_id`),
  KEY `IDX_ED98E9FC67B3B43D` (`users_id`),
  KEY `IDX_ED98E9FCA21214B7` (`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users_categories`
--

INSERT INTO `users_categories` (`users_id`, `categories_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `product`
--
ALTER TABLE `product` ADD FULLTEXT KEY `product` (`name`,`description`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_497DD634727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `newsletters`
--
ALTER TABLE `newsletters`
  ADD CONSTRAINT `FK_8ECF000CA21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F52993984584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04ADBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `users_categories`
--
ALTER TABLE `users_categories`
  ADD CONSTRAINT `FK_ED98E9FC67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ED98E9FCA21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
