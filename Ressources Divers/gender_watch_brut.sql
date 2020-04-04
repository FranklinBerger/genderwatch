-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Sam 04 Avril 2020 à 19:41
-- Version du serveur :  10.3.22-MariaDB-0+deb10u1
-- Version de PHP :  7.3.14-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gender_watch`
--

-- --------------------------------------------------------

--
-- Structure de la table `authorized_user`
--

CREATE TABLE `authorized_user` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `authorized_user`
--

INSERT INTO `authorized_user` (`id`, `user`, `password`) VALUES
(1, 'root', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2');

-- --------------------------------------------------------

--
-- Structure de la table `personnes_watch`
--

CREATE TABLE `personnes_watch` (
  `id` int(11) NOT NULL,
  `watch` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `genre` varchar(10) NOT NULL,
  `temps_parlé` int(11) NOT NULL,
  `parole_longue` int(11) NOT NULL,
  `parole_courte` int(11) NOT NULL,
  `parle_depuis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnes_watch`
--

-- --------------------------------------------------------

--
-- Structure de la table `watch`
--

CREATE TABLE `watch` (
  `id` int(11) NOT NULL,
  `watch_name` varchar(255) NOT NULL,
  `watch_description` text NOT NULL,
  `watch_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_access` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `watch`
--

--
-- Index pour les tables exportées
--

--
-- Index pour la table `authorized_user`
--
ALTER TABLE `authorized_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personnes_watch`
--
ALTER TABLE `personnes_watch`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `watch`
--
ALTER TABLE `watch`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `authorized_user`
--
ALTER TABLE `authorized_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `personnes_watch`
--
ALTER TABLE `personnes_watch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `watch`
--
ALTER TABLE `watch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
