-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 21 avr. 2022 à 16:11
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ProjetWebS4`
--
DROP DATABASE  IF EXISTS `ProjetWebS4`;
CREATE DATABASE IF NOT EXISTS `ProjetWebS4`;

-- --------------------------------------------------------

--
-- Structure de la table `Destination`
--

CREATE TABLE `Destination` (
  `IdDestination` int(11) NOT NULL,
  `Nom` varchar(25) NOT NULL,
  `Pays` varchar(25) NOT NULL,
  `TempMoyenne` int(2) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Destination`
--

INSERT INTO `Destination` (`IdDestination`, `Nom`, `Pays`, `TempMoyenne`, `Description`, `Image`) VALUES
(3, 'Marseille', 'France', 24, 'tiuobrgewzouetveouobuz', 'image/TESTIMG.png'),
(4, 'Paris', 'France', 17, 'iuvthiovoirirw', 'image/TESTIMG.png'),
(5, 'Lyon', 'France', 13, 'urivueobveuhb', 'image/');

-- --------------------------------------------------------

--
-- Structure de la table `Election`
--

CREATE TABLE `Election` (
  `IdElection` int(10) NOT NULL,
  `Intitule` varchar(50) NOT NULL,
  `estTerminee` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Election`
--

INSERT INTO `Election` (`IdElection`, `Intitule`, `estTerminee`) VALUES
(61, 'Villes de France', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Participation`
--

CREATE TABLE `Participation` (
  `IdElection` int(50) NOT NULL,
  `IdDestination` int(50) NOT NULL,
  `nbVotes` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Participation`
--

INSERT INTO `Participation` (`IdElection`, `IdDestination`, `nbVotes`) VALUES
(61, 3, 0),
(61, 4, 0),
(61, 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `Pseudo` varchar(20) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `MotDePasse` varchar(96) NOT NULL,
  `EstOrganisateur` tinyint(1) DEFAULT NULL,
  `Sel` varchar(96) NULL,
  PRIMARY KEY (Pseudo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`Pseudo`, `Mail`, `MotDePasse`, `EstOrganisateur`, `Sel`) VALUES
('testPseudo', 'testMail', 'testMDP', 1, 'aa'),
('pseudo', 'mail@m.com', 'kuhgiu', 0, 'aa'),
('kjbbk', 'noui@uiggiu.com', 'iubiuuih', 1, 'aa'),
('pseudo2', 'mail@mail.fr', 'mdp', 0, 'aa'),
('thomas', 'thomas@mail.fr', 'thomas', 1, 'aa');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Destination`
--
ALTER TABLE `Destination`
  ADD PRIMARY KEY (`IdDestination`);

--
-- Index pour la table `Election`
--
ALTER TABLE `Election`
  ADD PRIMARY KEY (`IdElection`);

--
-- Index pour la table `Participation`
--
ALTER TABLE `Participation`
  ADD PRIMARY KEY (`IdElection`,`IdDestination`),
  ADD KEY `fk_destination` (`IdDestination`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Destination`
--
ALTER TABLE `Destination`
  MODIFY `IdDestination` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Election`
--
ALTER TABLE `Election`
  MODIFY `IdElection` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Participation`
--
ALTER TABLE `Participation`
  ADD CONSTRAINT `fk_destination` FOREIGN KEY (`IdDestination`) REFERENCES `Destination` (`IdDestination`),
  ADD CONSTRAINT `fk_election` FOREIGN KEY (`IdElection`) REFERENCES `Election` (`IdElection`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
