-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 10 avr. 2022 à 17:04
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_facture`
--

-- --------------------------------------------------------

--
-- Structure de la table `destinataire`
--

DROP TABLE IF EXISTS `destinataire`;
CREATE TABLE IF NOT EXISTS `destinataire` (
  `id_destinataire` int(11) NOT NULL AUTO_INCREMENT,
  `raison_social` text COLLATE utf8_bin NOT NULL,
  `adresse_rue` text COLLATE utf8_bin NOT NULL,
  `adresse_code_ville` text COLLATE utf8_bin NOT NULL,
  `tva_intra` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_destinataire`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `destinataire`
--

INSERT INTO `destinataire` (`id_destinataire`, `raison_social`, `adresse_rue`, `adresse_code_ville`, `tva_intra`) VALUES
(1, 'Halogene', '74 rue des Faubourg Saint Denis', '75010 Paris', 'FR09383119153');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_facture` varchar(150) COLLATE utf8_bin NOT NULL,
  `num_destinataire` int(11) NOT NULL,
  `date_facture` date NOT NULL,
  `total_ttc` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `num_facture` (`num_facture`),
  KEY `num_destinataire` (`num_destinataire`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `num_facture`, `num_destinataire`, `date_facture`, `total_ttc`) VALUES
(7, '241125', 1, '2022-01-30', 287.82);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_facture`
--

DROP TABLE IF EXISTS `ligne_facture`;
CREATE TABLE IF NOT EXISTS `ligne_facture` (
  `id_ligne` int(11) NOT NULL AUTO_INCREMENT,
  `num_facture` varchar(150) COLLATE utf8_bin NOT NULL,
  `desc_code` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire_ht` double NOT NULL,
  PRIMARY KEY (`id_ligne`),
  KEY `num_facture` (`num_facture`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ligne_facture`
--

INSERT INTO `ligne_facture` (`id_ligne`, `num_facture`, `desc_code`, `description`, `quantite`, `prix_unitaire_ht`) VALUES
(11, '241125', 'JKVQK', 'Pontalon', 12, 2.3),
(12, '241125', '235426', 'Veste', 35, 4.35),
(13, '241125', '12532', 'short', 50, 1.2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` text COLLATE utf8_bin NOT NULL,
  `mdp` text COLLATE utf8_bin NOT NULL,
  `statut` varchar(40) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `identifiant`, `mdp`, `statut`) VALUES
(1, 'bivash', 'bivash15', 'vendeur'),
(2, 'naruto', 'naruto15', 'client');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`num_destinataire`) REFERENCES `destinataire` (`id_destinataire`);

--
-- Contraintes pour la table `ligne_facture`
--
ALTER TABLE `ligne_facture`
  ADD CONSTRAINT `ligne_facture_ibfk_1` FOREIGN KEY (`num_facture`) REFERENCES `facture` (`num_facture`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
