-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 03 Avril 2018 à 14:55
-- Version du serveur :  5.7.14-log
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `eshop`
--

--
-- Structure de la table `thi_caddie`
--

CREATE TABLE `thi_caddie` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `thi_caddie`
--

INSERT INTO `thi_caddie` (`id`, `product_id`, `user_id`, `quantity`, `total`) VALUES
(1, 5, 1, 7, '140.00');

-- --------------------------------------------------------

--
-- Structure de la table `thi_image`
--

CREATE TABLE `thi_image` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `thi_image`
--

INSERT INTO `thi_image` (`id`, `url`) VALUES
(3, 'product-12.jpg'),
(4, 'product-35.jpg'),
(5, 'product-3.jpg'),
(6, 'product-41.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `thi_newsletter`
--

CREATE TABLE `thi_newsletter` (
  `id` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_creation` int(11) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `use_modif` int(11) DEFAULT NULL,
  `date_modif` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `thi_product`
--

CREATE TABLE `thi_product` (
  `id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `oldprice` decimal(8,2) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `availability` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reduction` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `new` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `collection` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `genre` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_creation` int(11) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `use_modif` int(11) DEFAULT NULL,
  `date_modif` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `thi_product`
--

INSERT INTO `thi_product` (`id`, `image_id`, `stock_id`, `name`, `price`, `oldprice`, `description`, `color`, `size`, `brand`, `availability`, `category`, `reduction`, `new`, `collection`, `genre`, `user_creation`, `date_creation`, `user_deleted`, `date_deleted`, `deleted`, `use_modif`, `date_modif`) VALUES
(3, 3, 3, 'Basket Homme', '45.00', '120.00', 'Basket Homme Lorem Ipsum', 'Blue', '40', 'Vero Moda', 'instock', 'Shoes', '-30%', 'New', 'Hiver', 'men', NULL, '2018-04-03 14:15:15', NULL, NULL, 0, NULL, NULL),
(4, 4, 4, 'Sac Homme', '60.00', '120.00', 'Sac Homme Lorem Ipsum', 'Green', '42', 'Nike', 'instock', 'Bags', '-20%', 'New', 'Printemps', 'mixte', NULL, '2018-04-03 14:17:17', NULL, NULL, 0, NULL, NULL),
(5, 5, 5, 'T-Shirt', '20.00', '40.00', 'T-Shirt Lorem Ipsum', 'Black', 'S', 'SUPERDRY', 'instock', 'Clothing', '-20%', 'New', 'Eté', 'men', NULL, '2018-04-03 14:19:43', NULL, NULL, 0, NULL, NULL),
(6, 6, 6, 'Sac Femme', '60.00', '120.00', 'Sac Femme Lorem Ipsum', 'Blue - Orange', 'L', 'Vero Moda', 'instock', 'Bags', '-30%', 'New', 'Hiver', 'men', NULL, '2018-04-03 14:51:43', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `thi_review`
--

CREATE TABLE `thi_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `thi_stock`
--

CREATE TABLE `thi_stock` (
  `id` int(11) NOT NULL,
  `eshopquantity` int(11) NOT NULL,
  `storequantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `thi_stock`
--

INSERT INTO `thi_stock` (`id`, `eshopquantity`, `storequantity`) VALUES
(3, 40, 60),
(4, 20, 60),
(5, 2, 154),
(6, 60, 50);

-- --------------------------------------------------------

--
-- Structure de la table `thi_users`
--

CREATE TABLE `thi_users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `thi_users`
--

INSERT INTO `thi_users` (`id`, `username`, `password`, `email`, `is_active`, `roles`) VALUES
(1, 'admin', '$2y$13$QsFvI.PNKoTDMYjYPQO9fuvGawcfIlD5N4MHPM1ToEDfWfVCx8JXG', 'admin@gmail.com', 1, 'ROLE_ADMIN');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `thi_caddie`
--
ALTER TABLE `thi_caddie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B9E5297E4584665A` (`product_id`),
  ADD KEY `IDX_B9E5297EA76ED395` (`user_id`);

--
-- Index pour la table `thi_image`
--
ALTER TABLE `thi_image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `thi_newsletter`
--
ALTER TABLE `thi_newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B53ADE6FE7927C74` (`email`);

--
-- Index pour la table `thi_product`
--
ALTER TABLE `thi_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D5ACD95F3DA5256D` (`image_id`),
  ADD UNIQUE KEY `UNIQ_D5ACD95FDCD6110` (`stock_id`);

--
-- Index pour la table `thi_review`
--
ALTER TABLE `thi_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_292B6C834584665A` (`product_id`);

--
-- Index pour la table `thi_stock`
--
ALTER TABLE `thi_stock`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `thi_users`
--
ALTER TABLE `thi_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_791FDC99F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_791FDC99E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `thi_caddie`
--
ALTER TABLE `thi_caddie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `thi_image`
--
ALTER TABLE `thi_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `thi_newsletter`
--
ALTER TABLE `thi_newsletter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `thi_product`
--
ALTER TABLE `thi_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `thi_review`
--
ALTER TABLE `thi_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `thi_stock`
--
ALTER TABLE `thi_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `thi_users`
--
ALTER TABLE `thi_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `thi_caddie`
--
ALTER TABLE `thi_caddie`
  ADD CONSTRAINT `FK_B9E5297E4584665A` FOREIGN KEY (`product_id`) REFERENCES `thi_product` (`id`),
  ADD CONSTRAINT `FK_B9E5297EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `thi_users` (`id`);

--
-- Contraintes pour la table `thi_product`
--
ALTER TABLE `thi_product`
  ADD CONSTRAINT `FK_D5ACD95F3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `thi_image` (`id`),
  ADD CONSTRAINT `FK_D5ACD95FDCD6110` FOREIGN KEY (`stock_id`) REFERENCES `thi_stock` (`id`);

--
-- Contraintes pour la table `thi_review`
--
ALTER TABLE `thi_review`
  ADD CONSTRAINT `FK_292B6C834584665A` FOREIGN KEY (`product_id`) REFERENCES `thi_product` (`id`);
