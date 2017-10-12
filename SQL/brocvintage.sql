-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 27 Septembre 2017 à 17:42
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `brocvintage`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_article` int(4) NOT NULL,
  `entry_date` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dispo`
--

CREATE TABLE `dispo` (
  `id_dispo` int(5) NOT NULL,
  `dispo_date` datetime NOT NULL,
  `meeting_date` datetime DEFAULT NULL,
  `id_user` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `id_picture` int(4) NOT NULL,
  `pic_name` varchar(50) NOT NULL,
  `pic_size` int(10) NOT NULL,
  `pic_alt` varchar(255) NOT NULL,
  `pic_final_name` varchar(50) NOT NULL,
  `pic_file_date` datetime NOT NULL,
  `id_product` int(4) DEFAULT NULL,
  `id_article` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id_product` int(4) NOT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `disponibility` enum('dis','res','ind') NOT NULL DEFAULT 'dis',
  `entry_date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `promotion` tinyint(1) DEFAULT '0',
  `id_product_type` int(2) NOT NULL,
  `id_sub_type` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `products_types`
--

CREATE TABLE `products_types` (
  `id_product_type` int(2) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id_reservation` int(5) NOT NULL,
  `id_user` int(4) NOT NULL,
  `id_dispo` int(4) DEFAULT NULL,
  `id_product` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sub_types`
--

CREATE TABLE `sub_types` (
  `id_sub_type` int(2) NOT NULL,
  `name` varchar(40) NOT NULL,
  `id_product_type` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(4) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` char(64) NOT NULL,
  `international_code` varchar(3) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `title` enum('H','F') NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `post_code` varchar(5) DEFAULT NULL,
  `address` text,
  `status` enum('user','admin') NOT NULL DEFAULT 'user',
  `subscription_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `surname`, `name`, `email`, `password`, `international_code`, `phone`, `title`, `city`, `post_code`, `address`, `status`, `subscription_date`) VALUES
(1, 'BROC', 'VINTAGE', 'brocvintageadmin@brocvintage.com', '6c09ac8dde193771d0726236c1f11c88fb73521cdc3289cd7b9c7cf8b3c3f398', '+41', '', 'H', '', '', '', 'user', '2017-06-04 17:23:26');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `dispo`
--
ALTER TABLE `dispo`
  ADD PRIMARY KEY (`id_dispo`),
  ADD UNIQUE KEY `meeting_date` (`meeting_date`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id_picture`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Index pour la table `products_types`
--
ALTER TABLE `products_types`
  ADD PRIMARY KEY (`id_product_type`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservation`),
  ADD UNIQUE KEY `id_product` (`id_product`);

--
-- Index pour la table `sub_types`
--
ALTER TABLE `sub_types`
  ADD PRIMARY KEY (`id_sub_type`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id` (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `dispo`
--
ALTER TABLE `dispo`
  MODIFY `id_dispo` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id_picture` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `products_types`
--
ALTER TABLE `products_types`
  MODIFY `id_product_type` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_reservation` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sub_types`
--
ALTER TABLE `sub_types`
  MODIFY `id_sub_type` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
