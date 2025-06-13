-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 08 juin 2025 à 12:29
-- Version du serveur : 8.0.30
-- Version de PHP : 8.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rollscape`
--
CREATE DATABASE IF NOT EXISTS `rollscape` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `rollscape`;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250506104714', '2025-05-06 10:49:52', 100),
('DoctrineMigrations\\Version20250506123737', '2025-05-06 12:38:54', 23),
('DoctrineMigrations\\Version20250514183615', '2025-05-14 18:36:39', 83),
('DoctrineMigrations\\Version20250514184113', '2025-05-14 18:41:19', 13),
('DoctrineMigrations\\Version20250514190207', '2025-05-14 19:02:14', 11),
('DoctrineMigrations\\Version20250514214338', '2025-05-14 21:43:49', 81),
('DoctrineMigrations\\Version20250515084718', '2025-05-15 08:47:45', 86),
('DoctrineMigrations\\Version20250515091852', '2025-05-15 09:19:39', 57),
('DoctrineMigrations\\Version20250515092407', '2025-05-15 09:24:13', 77),
('DoctrineMigrations\\Version20250515092646', '2025-05-15 09:26:53', 25),
('DoctrineMigrations\\Version20250515093229', '2025-05-15 09:32:40', 15),
('DoctrineMigrations\\Version20250515093454', '2025-05-15 09:34:59', 12),
('DoctrineMigrations\\Version20250515095459', '2025-05-15 09:55:05', 81),
('DoctrineMigrations\\Version20250515100135', '2025-05-15 10:01:41', 15),
('DoctrineMigrations\\Version20250515103642', '2025-05-15 10:37:00', 79),
('DoctrineMigrations\\Version20250515105049', '2025-05-15 10:51:02', 14),
('DoctrineMigrations\\Version20250515110552', '2025-05-15 11:06:02', 116),
('DoctrineMigrations\\Version20250521110615', '2025-05-21 11:07:39', 220),
('DoctrineMigrations\\Version20250602103823', '2025-06-02 10:38:38', 76),
('DoctrineMigrations\\Version20250605094218', '2025-06-05 09:42:29', 82),
('DoctrineMigrations\\Version20250605094256', '2025-06-05 09:43:01', 12),
('DoctrineMigrations\\Version20250606124102', '2025-06-06 12:41:18', 103);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE `ressource` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `type_id` int NOT NULL,
  `user_id` int NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ressource`
--

INSERT INTO `ressource` (`id`, `title`, `filename`, `description`, `created_at`, `updated_at`, `type_id`, `user_id`, `alt`) VALUES
(1, 'Carte de Aternia', 'fantasymap-6826462d183ee.jpg', NULL, '2025-05-15 13:22:30', '2025-06-01 16:25:35', 3, 1, NULL),
(10, 'Arrivée de la police', 'c244bf3c69d08afc12bfc8901eaa173a-6838334f1bb9c.jpg', 'gfeggfd', '2025-05-29 10:13:35', '2025-05-29 10:13:54', 5, 11, NULL),
(11, 'Vignoble de la vallée d\'Eldoria', 'created-by-theunchartedlands-on-tiktok-683c8859348b9.jpg', 'Illustration d\'un domaine viticole médiéval paisible', '2025-06-01 17:05:29', NULL, 5, 10, NULL),
(12, 'Tour oubliée de Kaer-Dhûn', '44a670d6-078b-499c-a487-b5fc04533e04-683c88cfd664f.jpg', 'Vieille tour', '2025-06-01 17:07:27', NULL, 5, 10, NULL),
(13, 'Forteresse d\'Azgraar', 'a-grand-medieval-fortress-adorned-with-red-683c895337e78.jpg', 'Sombre château aux bannières cramoisies', '2025-06-01 17:09:39', NULL, 5, 10, NULL),
(14, 'Cité elfique de Sylvaserre', '1ed174c9-d862-4bf6-8c54-6f825c262c4b-683c89c4864c6.jpg', 'Cité féerique aux milieux des arbres', '2025-06-01 17:11:32', '2025-06-01 17:11:46', 5, 10, NULL),
(15, 'Kael Dryven', '063326e8-c7f0-49ba-aa0c-8d17554b2f09-683c8aae7dd35.jpg', 'Mercenaire solitaire', '2025-06-01 17:15:26', NULL, 2, 10, NULL),
(16, 'Agent KropRage', 'd05d3de0-159e-46c7-83d4-69f65c3f4a01-683c8b2b7f009.jpg', NULL, '2025-06-01 17:17:31', NULL, 2, 10, NULL),
(17, 'Patrouille volante 078', 'a0d7d265-0fd4-44fa-8c7d-e309c3b7fe45-683c8b6ae4b4d.jpg', 'Voiture de police futuriste', '2025-06-01 17:18:34', NULL, 5, 10, NULL),
(18, 'Capitaine Robert Walker', 'cyberpunk-oldpeople-man-woman-683c8c2a78783.jpg', NULL, '2025-06-01 17:21:46', '2025-06-02 10:51:23', 2, 12, 'Policier futuriste'),
(19, 'District Rouge Neotokyo', '90bbbde6-cb8d-472e-b266-88d7f39832f5-683c8c6295839.jpg', NULL, '2025-06-01 17:22:42', NULL, 5, 12, NULL),
(20, 'Supermarché abandonné de Red Hollow', 'a-post-apocalyptic-supermarket-with-an-ominous-683c8cc710a10.jpg', 'Scène nocturne dans un lieu desert', '2025-06-01 17:24:23', NULL, 5, 12, 'Un supermarché américaine qui semble abandonné en pleine nuit'),
(21, 'Cinema dans la brume', 'a019dddf-696d-42ab-acf8-0e45aa365674-683c904b4f14c.jpg', NULL, '2025-06-01 17:39:23', NULL, 5, 14, NULL),
(22, 'Petite pause nocturne', '316c3b3e-0681-4e35-bd4c-488ef82b809d-683c909d6b6ea.jpg', NULL, '2025-06-01 17:40:45', NULL, 5, 14, NULL),
(23, 'Chapelle des âmes perdues', 'in-this-mysterious-place-innocuous-looking-683c90fa3fb5a.jpg', NULL, '2025-06-01 17:42:18', NULL, 5, 14, NULL),
(24, 'Cascade Urbaine de Novapolis', 'an-incredible-futuristic-city-with-waterfalls-683c91b9e3c9c.jpg', 'Incroyable cité futuriste avec cascades', '2025-06-01 17:45:29', NULL, 5, 14, NULL),
(25, 'Donjon Pixel - Fosse ardente', 'pixelart-8bitart-pixelartist-pixelartwork-683c92575beaf.jpg', NULL, '2025-06-01 17:48:07', NULL, 4, 18, NULL),
(26, 'Place de marché de Rosenheim', 'bienvenue-dans-une-collection-epique-de-12-cartes-683c92a12d829.jpg', NULL, '2025-06-01 17:49:21', NULL, 4, 18, NULL),
(27, 'Laboratoire - Projet Résurrection', 'resurrection-lab-33x24-miska-s-sci-fi-maps-on-683c9312a9f06.jpg', NULL, '2025-06-01 17:51:14', NULL, 4, 18, NULL),
(29, 'Quartier sombre de Night City', 'fdb8badf-9efb-48a9-a183-e1e4469875a0-6841ad2050917.jpg', 'blabla', '2025-06-05 14:43:44', NULL, 5, 22, 'ruelle sombre');

-- --------------------------------------------------------

--
-- Structure de la table `ressource_tag`
--

CREATE TABLE `ressource_tag` (
  `ressource_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ressource_tag`
--

INSERT INTO `ressource_tag` (`ressource_id`, `tag_id`) VALUES
(1, 2),
(1, 60),
(10, 3),
(10, 4),
(11, 2),
(11, 37),
(12, 2),
(12, 13),
(12, 37),
(13, 2),
(13, 59),
(14, 2),
(14, 8),
(14, 22),
(14, 32),
(14, 60),
(15, 3),
(16, 4),
(16, 5),
(17, 5),
(17, 52),
(17, 64),
(17, 73),
(18, 4),
(18, 5),
(19, 5),
(19, 47),
(20, 3),
(20, 23),
(20, 24),
(21, 3),
(21, 24),
(21, 66),
(22, 3),
(22, 23),
(22, 52),
(23, 24),
(23, 71),
(24, 8),
(24, 64),
(24, 73),
(25, 2),
(25, 7),
(26, 2),
(26, 58),
(27, 64),
(27, 72),
(27, 73),
(29, 5),
(29, 23),
(29, 73);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`, `slug`) VALUES
(1, 'dnd', 'dnd'),
(2, 'Fantasy', 'fantasy'),
(3, 'moderne', 'moderne'),
(4, 'Policier', 'policier'),
(5, 'Cyberpunk', 'cyberpunk'),
(6, 'Forêt', 'foret'),
(7, 'Donjon', 'donjon'),
(8, 'Cité', 'cite'),
(9, 'Taverne', 'taverne'),
(10, 'Campement', 'campement'),
(11, 'Cimetière', 'cimetiere'),
(12, 'Temple', 'temple'),
(13, 'Ruines', 'ruines'),
(14, 'Grottes', 'grottes'),
(15, 'Port / Quai', 'port-quai'),
(16, 'Désert', 'desert'),
(17, 'Neige', 'neige'),
(18, 'Hiver', 'hiver'),
(19, 'Jungle', 'jungle'),
(20, 'Volcan', 'volcan'),
(21, 'Marais', 'marais'),
(22, 'Féerique', 'feerique'),
(23, 'Nocturne', 'nocturne'),
(24, 'Horreur', 'horreur'),
(25, 'Guerrier', 'guerrier'),
(26, 'Mage', 'mage'),
(27, 'Voleur', 'voleur'),
(28, 'Archer', 'archer'),
(29, 'Orc', 'orc'),
(30, 'Gobelin', 'gobelin'),
(31, 'Dragon', 'dragon'),
(32, 'Elfe', 'elfe'),
(33, 'Nain', 'nain'),
(34, 'Humain', 'humain'),
(35, 'Monstre', 'monstre'),
(36, 'Intérieur', 'interieur'),
(37, 'Médiéval', 'medieval'),
(38, 'Vaisseau', 'vaisseau'),
(39, 'Android', 'android'),
(40, 'Alien', 'alien'),
(41, 'Base lunaire', 'base-lunaire'),
(42, 'Station orbitale', 'station-orbitale'),
(43, 'Manoir', 'manoir'),
(45, 'Catacombes', 'catacombes'),
(46, 'Enfer', 'enfer'),
(47, 'Ville', 'ville'),
(48, 'Commissariat', 'commissariat'),
(49, 'Hôpital', 'hopital'),
(50, 'Ruelle', 'ruelle'),
(52, 'Vehicule', 'vehicule'),
(53, 'Exploration', 'exploration'),
(54, 'Enquête', 'enquete'),
(55, 'Diplomatie', 'diplomatie'),
(56, 'Mystère', 'mystere'),
(57, 'Commerce', 'commerce'),
(58, 'Village', 'village'),
(59, 'Dark Fantasy', 'dark-fantasy'),
(60, 'Heroic Fantasy', 'heroic-fantasy'),
(61, 'Space opera', 'space-opera'),
(62, 'Post-apo', 'post-apo'),
(63, 'Steampunk', 'steampunk'),
(64, 'SF', 'sf'),
(65, 'Western', 'western'),
(66, 'Lovecraft', 'lovecraft'),
(67, 'Historique', 'historique'),
(68, 'Donjons & Dragons', 'donjons-dragons'),
(69, 'Appel de Cthulhu', 'appel-de-cthulhu'),
(70, 'OSR', 'osr'),
(71, 'Eglise', 'eglise'),
(72, 'Laboratoire', 'laboratoire'),
(73, 'Science fiction', 'science-fiction');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `name`, `slug`) VALUES
(2, 'Portrait', 'portrait'),
(3, 'Cartographie', 'cartographie'),
(4, 'Battlemap', 'battlemap'),
(5, 'Scène', 'scene');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `username`, `birthdate`, `description`, `picture`) VALUES
(1, 'okadus@gmail.com', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$KPWW37dn77tjzA1T42hoE.XNE1/PpXe/P2AQ1V4AXDMXY/FLxBlhy', 'Abdelkader', 'Ounadjela', 'Kadus', '1984-06-06 00:00:00', 'Pellentesque dictum viverra mattis. Proin quis mattis odio. Duis tristique tristique nulla, eget volutpat ante semper nec. Praesent tempus urna vitae diam lobortis dignissim. Duis hendrerit lacinia vestibulum. Vestibulum scelerisque vehicula ante, ac elementum dolor congue vel. In eget auctor ex. Nunc et egestas arcu. Pellentesque vel eleifend erat.', 'avatar-h-682f0f2e992c7.png'),
(9, 'john@doe.com', '[]', '$2y$13$207nbZDnV52Fmb0PgBgyV.tMqhSWWaddVIkNetXPdi4RhkRE3GDjq', 'John', 'Doe', 'JohnDoe', '1984-06-06 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor dui vitae orci aliquam, non bibendum mi fermentum. Duis pellentesque porttitor pellentesque. Donec erat nibh, feugiat sit amet urna vel, imperdiet ullamcorper magna. Quisque maximus libero nec lorem aliquet dictum.', 'logo-icon-68259f4354fb8.png'),
(10, 'badr.mohamadi@gmail.com', '[]', '$2y$13$A0a0aEO/zKyKvl2tNCujFemLHXYfCFOKGDQEjvgSlLiE0a9BzbrVm', 'Badr', 'Mohamadi', 'badrmohamadi2025', NULL, NULL, 'avatar-h-683c87e089b40.png'),
(11, 'ounamus@gmail.com', '[]', '$2y$13$BbFG/yPtbad3A/AyaamhweQ9P3XTGMyiXLz64PY6MG8gtdeWF8Nf6', 'Mustapha', 'Ounadjela', 'ounamus', '1981-04-26 00:00:00', 'gerferiuofjekgjegegdkfgjdfgdflùgjni*', 'cinema-683832d5914a0.png'),
(12, 'mamadou.amadou@gmail.com', '[]', '$2y$13$F/zJVlkSyPRa982ry7TsheEvFEP1G.WBlrsOHLTOf/1JQGx6lMGCS', 'Mamadou', 'Amadou', 'mamadouamadou2025', NULL, NULL, 'default.png'),
(13, 'islem.fourati@gmail.com', '[]', '$2y$13$X3wIADuR707WXUZzavHN8.su3Td7EtipSREw6WITDdci1KG1e8Pqi', 'Islem', 'Fourati', 'islemfourati2025', NULL, NULL, 'default.png'),
(14, 'alexandre.cavet@gmail.com', '[]', '$2y$13$DSGApgtTBbfM9pa.FpbJs.E0Mx0.B5lbbbhWJGytCcbUFl5Li1WeC', 'Alexandre', 'Cavet', 'alexandrecavet2025', NULL, NULL, 'default.png'),
(15, 'bashir.youcif@gmail.com', '[]', '$2y$13$8a.wjxuro6QMIm8ohtCTHux84VC7bCWS1XNQLTfHHXkvYaqKKNvzW', 'Bashir', 'Youcif', 'bashiryoucif2025', NULL, NULL, 'default.png'),
(16, 'ouarda.chied@gmail.com', '[]', '$2y$13$eXqSi.hzHfhLy/nLP0PlRuPOOj2ZxAxSrVLu6UF5VWv/Y9XcFvZje', 'Ouarda', 'Shied', 'ouardashied2025', NULL, NULL, 'default.png'),
(17, 'hawa.kone@gmail.com', '[]', '$2y$13$M2ZOfgUfVFEBWg.RT79iNOmHWv5wbMiZ87wiZgTlBh9kQGdwRZ1iq', 'Hawa', 'Kone', 'hawakone2025', NULL, NULL, 'default.png'),
(18, 'delma.leta@gmail.com', '[]', '$2y$13$qbBtUgbjD/E41dG1jCgXFe.tksrtTbQpzPkPEhcKS5y33l8qOIRPS', 'Delma', 'Leta', 'delmaleta2025', NULL, NULL, 'default.png'),
(19, 'okadus@gmail.fr', '[]', '$2y$13$dJMB/7XAEhm5YbykbQ18Iuo1idaUPrcvZMFrFatFyO2edhYPIphkW', 'test', 'test', 'testtest2025', NULL, NULL, 'default.png'),
(22, 'pat@gmail.com', '[]', '$2y$13$hRjvI2trWDzpudtBQ5J0s.V8ZFrvZ7zm3kLTfC0bZwEYw6IQ1YGPC', 'Patrick', 'Isola', 'patrick', NULL, NULL, '174881-6841ad9aeedbf.png'),
(23, 'andrea.leo@gmail.com', '[]', '$2y$13$roKiK4tWmzW5cvdvvbAZduLLq42RtOuwMjFPeTsdAPb1G2Qmt83Ke', 'Andrea', 'Leo', 'andrealeo2025', NULL, NULL, 'default.png'),
(24, 'alpha.oumar@gmail.com', '[]', '$2y$13$gw.jOxrojwLwo/wmUzMGaOYrp19K7x3QlWhbPh9mag6j4vVoD1L0q', 'Alpha Oumar', 'Barry', 'alpha-oumarbarry2025', NULL, NULL, 'default.png');

-- --------------------------------------------------------

--
-- Structure de la table `user_ressource`
--

CREATE TABLE `user_ressource` (
  `user_id` int NOT NULL,
  `ressource_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_ressource`
--

INSERT INTO `user_ressource` (`user_id`, `ressource_id`) VALUES
(1, 18),
(1, 20),
(1, 27),
(11, 1),
(12, 20),
(12, 23),
(18, 17),
(18, 24);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_939F4544C54C8C93` (`type_id`),
  ADD KEY `IDX_939F4544A76ED395` (`user_id`);

--
-- Index pour la table `ressource_tag`
--
ALTER TABLE `ressource_tag`
  ADD PRIMARY KEY (`ressource_id`,`tag_id`),
  ADD KEY `IDX_B31A7A13FC6CD52A` (`ressource_id`),
  ADD KEY `IDX_B31A7A13BAD26311` (`tag_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_389B7835E237E06` (`name`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Index pour la table `user_ressource`
--
ALTER TABLE `user_ressource`
  ADD PRIMARY KEY (`user_id`,`ressource_id`),
  ADD KEY `IDX_937FC8A0A76ED395` (`user_id`),
  ADD KEY `IDX_937FC8A0FC6CD52A` (`ressource_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ressource`
--
ALTER TABLE `ressource`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD CONSTRAINT `FK_939F4544A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_939F4544C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `ressource_tag`
--
ALTER TABLE `ressource_tag`
  ADD CONSTRAINT `FK_B31A7A13BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B31A7A13FC6CD52A` FOREIGN KEY (`ressource_id`) REFERENCES `ressource` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_ressource`
--
ALTER TABLE `user_ressource`
  ADD CONSTRAINT `FK_937FC8A0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_937FC8A0FC6CD52A` FOREIGN KEY (`ressource_id`) REFERENCES `ressource` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
