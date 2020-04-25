-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 17 avr. 2020 à 21:05
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Déchargement des données de la table `authorized_user`
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
  `user_access` text NOT NULL,
  `share_key` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `authorized_user`
--
ALTER TABLE `authorized_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personnes_watch`
--
ALTER TABLE `personnes_watch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `watch`
--
ALTER TABLE `watch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
