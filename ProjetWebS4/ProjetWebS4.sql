
--
-- Base de données : `ProjetWebS4`
--
DROP DATABASE  IF EXISTS `ProjetWebS4`;
CREATE DATABASE IF NOT EXISTS `ProjetWebS4`;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `IdUtilisateur`int(10) NOT NULL AUTO_INCREMENT,
  `Pseudo` varchar(20) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `MotDePasse` varchar(96) NOT NULL,
  `EstOrganisateur` tinyint(1) DEFAULT NULL,
  `Sel` varchar(96) NULL,
  PRIMARY KEY (IdUtilisateur)
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

-- --------------------------------------------------------

--
-- Structure de la table `Destination`
--

CREATE TABLE `Destination` (
  `IdDestination` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) NOT NULL,
  `Pays` varchar(25) NOT NULL,
  `TempMoyenne` int(2) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Image` varchar(50) NOT NULL,
   PRIMARY KEY (IdDestination)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Destination`
--

INSERT INTO `Destination` (`IdDestination`, `Nom`, `Pays`, `TempMoyenne`, `Description`, `Image`) VALUES
  (1, 'Angkor Wat', 'Cambodia', 6, 'cool', '/ProjetWebS4/img/Angkorwat.jpg'),
  (2, 'Bagan', 'Myanmar', 6, 'cool', '/ProjetWebS4/img/Bagan.jpg'),
  (3, 'Bali', 'Indonesie', 4, 'cool', '/ProjetWebS4/img/Bali.jpg'),
  (4, 'Bangkok', 'Thaïlande', 5, 'cool', '/ProjetWebS4/img/Bangkok.jpg'),
  (5, 'Colmar', 'France', 6, 'cool', '/ProjetWebS4/img/Colmar.jpg'),
  (6, 'Édimbourg', 'Écosse', 6, 'cool', '/ProjetWebS4/img/Edimbourg.jpg'),
  (7, 'Hanoï', 'Vietnam', 6, 'cool', '/ProjetWebS4/img/Hanoi.jpg'),
  (8, 'Marrakech', 'Maroc', 5, 'cool', '/ProjetWebS4/img/Marrakech.jpg'),
  (9, 'Mont Blanc', 'France', 5, 'cool', '/ProjetWebS4/img/Montblanc.jpg'),
  (10, 'New York', 'États-Unis', 5, 'cool', '/ProjetWebS4/img/Newyork.jpg'),
  (11, 'Nice', 'France', 6, 'cool', '/ProjetWebS4/img/Nice.jpg'),
  (12, 'Sydney', 'Australie', 5, 'cool', '/ProjetWebS4/img/Sydney.jpg'),
  (13, 'Ushuaïa', 'Argentine', 8, 'cool', '/ProjetWebS4/img/Ushuaia.jpg'),
  (14, 'Val de Loire', 'France', 5, 'cool', '/ProjetWebS4/img/Valdeloire.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Election`
--

CREATE TABLE `Election` (
  `IdElection` int(10) NOT NULL AUTO_INCREMENT,
  `Intitule` varchar(50) NOT NULL,
  `estTerminee` tinyint(4) NOT NULL,
  `IdOrga` int(10) NOT NULL,
  PRIMARY KEY (IdElection),
  FOREIGN KEY (`IdOrga`) REFERENCES `Utilisateur` (`IdUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Election`
--

INSERT INTO `Election` (`IdElection`, `Intitule`, `estTerminee`, `IdOrga`) VALUES
(35, 'Villes du monde', 0, 1),
(61, 'Villes de France', 0, 1),
(64, 'test', 1, 1),
(65, 'Villes du monde.ji', 0, 2),
(66, 'iholhlhhléjl', 0, 3),
(67, 'ékjjlljléélnlkl', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Participation`
--

CREATE TABLE `Participation` (
  `IdElection` int(50) NOT NULL,
  `IdDestination` int(50) NOT NULL,
  `nbVotes` int(50) NOT NULL,
  PRIMARY KEY (`IdElection`,`IdDestination`),
  KEY `fk_destination` (`IdDestination`),
  FOREIGN KEY (`IdDestination`) REFERENCES `Destination` (`IdDestination`),
  FOREIGN KEY (`IdElection`) REFERENCES `Election` (`IdElection`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Participation`
--

INSERT INTO `Participation` (`IdElection`, `IdDestination`, `nbVotes`) VALUES
(35, 1, 0), (35, 2, 0), (35, 3, 0),   (35, 4, 0), 
(35, 6, 0), (35, 7, 0), (35, 8, 0),   (35, 10, 0), 
(35, 12, 0), (35, 13, 0), 
(61, 5, 0), (61, 9, 0), (61, 11, 0),  (35, 14, 0),
(64, 3, 1), (64, 5, 0),
(65, 3, 0), (65, 5, 0),
(66, 3, 3), (66, 4, 3), (66, 5, 0),
(67, 4, 0), (67, 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
-- 
CREATE TABLE `commentaires` ( 
  `IdCommentaire` INT(10) NOT NULL AUTO_INCREMENT, 
  `IdElection` INT(10) NOT NULL , 
  `pseudo` VARCHAR(20) NOT NULL , 
  `message` TEXT NOT NULL , 
  `dateMsg` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`IdCommentaire`)
  ); 

