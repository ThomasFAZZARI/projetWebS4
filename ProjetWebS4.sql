-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 17 mars 2022 à 17:33
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

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `Pseudo` varchar(20) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `MotDePasse` varchar(20) NOT NULL,
  `EstOrganisateur` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`Pseudo`, `Mail`, `MotDePasse`, `EstOrganisateur`) VALUES
('testPseudo', 'testMail', 'testMDP', 1),
('pseudo', 'mail@m.com', 'kuhgiu', 0),
('kjbbk', 'noui@uiggiu.com', 'iubiuuih', 1),
('pseudo', 'mail@mail.fr', 'mdp', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
