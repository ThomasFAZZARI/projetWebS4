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
  `NomImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Destination`
--

INSERT INTO `Destination` (`IdDestination`, `Nom`, `Pays`, `TempMoyenne`, `Description`, `NomImage`) VALUES  
  (1, 'Angkor Wat', 'Cambodia', 6, 'cool', 'angkorwat.jpg'),
  (2, 'Bagan', 'Myanmar', 6, 'cool', 'bagan.jpg'),
  (3, 'Bali', 'Indonesie', 4, 'cool', 'bali.jpg'),
  (4, 'Bangkok', 'Thaïlande', 5, 'cool', 'bangkok.jpg'),
  (5, 'Colmar', 'France', 6, 'cool', 'colmar.jpg'),
  (6, 'Édimbourg', 'Écosse', 6, 'cool', 'edimbourg.jpg'),
  (7, 'Hanoï', 'Vietnam', 6, 'cool', 'hanoi.jpg'),
  (8, 'Marrakech', 'Maroc', 5, 'cool', 'marrakech.jpg'),
  (9, 'Mont Blanc', 'France', 5, 'cool', 'montblanc.jpg'),
  (10, 'New York', 'États-Unis', 5, 'cool', 'newyork.jpg'),
  (11, 'Nice', 'France', 6, 'cool', 'nice.jpg'),
  (12, 'Sydney', 'Australie', 5, 'cool', 'sydney.jpg'),
  (13, 'Ushuaïa', 'Argentine', 8, 'cool', 'ushuaia.jpg'),
  (14, 'Val de Loire', 'France', 5, 'cool', 'valdeloire.jpg');


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
(35, 'Villes du monde', 0),
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
(35, 1, 0), (35, 2, 0), (35, 3, 0),   (35, 4, 0), 
(35, 6, 0), (35, 7, 0), (35, 8, 0),   (35, 10, 0), 
(35, 12, 0), (35, 13, 0), 
(61, 5, 0), (61, 9, 0), (61, 11, 0),  (35, 14, 0) ;

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
