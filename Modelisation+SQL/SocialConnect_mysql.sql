-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 15 avr. 2021 à 09:18
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `socialconnect`
--
CREATE DATABASE IF NOT EXISTS `SOCIALCONNECT` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `SOCIALCONNECT`;
-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `idcompte` bigint(20) NOT NULL,
  `idcompte_ami` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `amis`
--

INSERT INTO `amis` (`idcompte`, `idcompte_ami`) VALUES
(1696278514562148, 1696278547894512),
(1696278527895410, 1696278547894513),
(1696278537845651, 1696278547894514),
(1696278547894512, 1696278514562148),
(1696278547894513, 1696278527895410),
(1696278547894514, 1696278537845651);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `idcommentaire` bigint(20) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `like` int(11) NOT NULL,
  `idpublication` bigint(20) NOT NULL,
  `idcompte` bigint(20) NOT NULL,
  `dateCom` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`idcommentaire`, `description`, `like`, `idpublication`, `idcompte`, `dateCom`) VALUES
(1696278514562205, 'descriptionAmazon', 1, 1696278514561638, 1696278537845651, '2021-04-13 12:25:10'),
(1696278514565563, 'descriptionFnac', 2, 1696278514561268, 1696278547894513, '2021-04-14 13:20:14'),
(1696278514565607, 'comFnac', 1, 1696278514560951, 1696278527895410, '2021-04-14 19:01:17'),
(1696278514567789, 'comGoogle', 1, 1696278514567744, 1696278547894512, '2021-04-14 10:08:01');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `idcompte` bigint(20) NOT NULL,
  `nom` varchar(42) DEFAULT NULL,
  `prenom` varchar(42) DEFAULT NULL,
  `photo` varchar(42) DEFAULT NULL,
  `poste` varchar(42) DEFAULT NULL,
  `grade` varchar(42) DEFAULT NULL,
  `departement` varchar(42) DEFAULT NULL,
  `date_embauche` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`idcompte`, `nom`, `prenom`, `photo`, `poste`, `grade`, `departement`, `date_embauche`) VALUES
(1696278514562148, 'Google', 'Jean', 'maPhotoJean.jpg', 'Superviseur', 'Manager', 'Developpement', '2019-02-15'),
(1696278527895410, 'Fnac', 'Luiza', 'maPhotoLuiza.jpg', 'Superviseur', 'Manager', 'Communication', '2017-05-17'),
(1696278537845651, 'Amazon', 'Nathalie', 'maPhotoNath.jpg', 'Superviseur', 'Manager', 'Relation Presse', '2015-07-02'),
(1696278547894512, 'Doe', 'Jane', 'maPhotoJane.jpg', 'Developpeur', 'Employe', 'Developpement', '2020-07-25'),
(1696278547894513, 'Onyme', 'Anne', 'maPhotoAnne.jpg', 'Community manager', 'Employe', 'Communication', '2021-01-05'),
(1696278547894514, 'Drake', 'Nathan', 'maPhotoNate.jpg', 'Assistant', 'Employe', 'Communication', '2019-11-01');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `identreprise` bigint(20) NOT NULL,
  `designation` varchar(42) DEFAULT NULL,
  `logo` varchar(42) DEFAULT NULL,
  `description` varchar(42) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`identreprise`, `designation`, `logo`, `description`, `url`, `statut`) VALUES
(1696278527184852, 'Google', 'LogoGoogle.jpg', 'Je suis Google', 'monReseau/1696278527184852', 1),
(1696278531096786, 'Fnac', 'LogoFnac.png', 'Je suis la Fnac', 'monReseau/1696278531096786', 1),
(1696278577788060, 'Amazon', 'LogoAmazon.png', 'Je suis Amazon', 'monReseau/1696278577788060', 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `idimage` bigint(20) NOT NULL,
  `titre` varchar(42) DEFAULT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `idcompte` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`idimage`, `titre`, `imageurl`, `idcompte`) VALUES
(1696278514561349, 'MonImageDrake', 'MonImageDrake.jpg', 1696278547894514),
(1696278514565298, 'MonImageDoe', 'MonImageDoe.jpg', 1696278547894512),
(1696278514567560, 'MonImageFnac', 'MonImageFnac.jpg', 1696278527895410),
(1696278514568961, 'MonImageGoogle', 'MonImageGoogle.jpg', 1696278514562148);

-- --------------------------------------------------------

--
-- Structure de la table `like_commentaire`
--

CREATE TABLE `like_commentaire` (
  `idcompte` bigint(20) NOT NULL,
  `idcommentaire` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `like_commentaire`
--

INSERT INTO `like_commentaire` (`idcompte`, `idcommentaire`) VALUES
(1696278514562148, 1696278514567789),
(1696278527895410, 1696278514565563),
(1696278547894513, 1696278514565563),
(1696278547894513, 1696278514565607),
(1696278547894514, 1696278514562205);

-- --------------------------------------------------------

--
-- Structure de la table `like_publication`
--

CREATE TABLE `like_publication` (
  `idcompte` bigint(20) NOT NULL,
  `idpublication` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `like_publication`
--

INSERT INTO `like_publication` (`idcompte`, `idpublication`) VALUES
(1696278514562148, 1696278514567029),
(1696278514562148, 1696278514567744),
(1696278527895410, 1696278514560951),
(1696278537845651, 1696278514561638),
(1696278547894512, 1696278514567744),
(1696278547894514, 1696278514568239);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `idpublication` bigint(20) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `like` int(11) NOT NULL,
  `statut` varchar(42) DEFAULT NULL,
  `idcompte` bigint(20) NOT NULL,
  `datePub` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`idpublication`, `description`, `imageurl`, `like`, `statut`, `idcompte`, `datePub`) VALUES
(1696278514560951, 'descriptionOnyme', 'uneImageOnyme.jpg', 1, 'public', 1696278547894513, '2021-04-14 18:15:27'),
(1696278514561268, 'descriptionFnac', 'uneImageFnac.jpg', 0, 'public', 1696278527895410, '2021-04-13 10:15:27'),
(1696278514561638, 'descriptionDrake', 'uneImageDrake.jpg', 1, 'public', 1696278547894514, '2021-04-13 12:20:50'),
(1696278514567029, 'descriptionDoe', 'uneImageDoe.jpg', 1, 'amis', 1696278547894512, '2021-04-10 17:15:27'),
(1696278514567744, 'descriptionGoogle', 'uneImageGoogle.jpg', 2, 'public', 1696278514562148, '2021-04-14 09:09:15'),
(1696278514568239, 'descriptionAmazon', 'uneImageAmazon.jpg', 1, 'amis', 1696278537845651, '2021-03-14 17:02:13');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idutilisateur` bigint(20) NOT NULL,
  `nomutilisateur` varchar(42) DEFAULT NULL,
  `motdepasse` varchar(100) DEFAULT NULL,
  `mail` varchar(42) DEFAULT NULL,
  `role` varchar(42) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `identreprise` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `nomutilisateur`, `motdepasse`, `mail`, `role`, `statut`, `identreprise`) VALUES
(1696278514562148, 'GoogleAdmin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'google@admin.com', 'admin', 1, 1696278527184852),
(1696278527895410, 'FnacAdmin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'fnac@admin.com', 'admin', 1, 1696278531096786),
(1696278537845651, 'AmazonAdmin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'amazon@admin.com', 'admin', 1, 1696278577788060),
(1696278547894512, 'GoogleUser', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'google@user.com', 'user', 1, 1696278527184852),
(1696278547894513, 'FnacUser', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'fnac@user.com', 'user', 1, 1696278531096786),
(1696278547894514, 'AmazonUser', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'amazon@user.com', 'user', 1, 1696278577788060);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`idcompte`,`idcompte_ami`),
  ADD KEY `idcompte_ami` (`idcompte_ami`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`idcommentaire`),
  ADD KEY `idpublication` (`idpublication`),
  ADD KEY `idcompte` (`idcompte`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idcompte`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`identreprise`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`idimage`),
  ADD KEY `idcompte` (`idcompte`);

--
-- Index pour la table `like_commentaire`
--
ALTER TABLE `like_commentaire`
  ADD PRIMARY KEY (`idcompte`,`idcommentaire`),
  ADD KEY `idcommentaire` (`idcommentaire`);

--
-- Index pour la table `like_publication`
--
ALTER TABLE `like_publication`
  ADD PRIMARY KEY (`idcompte`,`idpublication`),
  ADD KEY `idpublication` (`idpublication`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`idpublication`),
  ADD KEY `idcompte` (`idcompte`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idutilisateur`),
  ADD KEY `identreprise` (`identreprise`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `amis_ibfk_1` FOREIGN KEY (`idcompte_ami`) REFERENCES `compte` (`idcompte`) ON DELETE CASCADE,
  ADD CONSTRAINT `amis_ibfk_2` FOREIGN KEY (`idcompte`) REFERENCES `compte` (`idcompte`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`idpublication`) REFERENCES `publication` (`idpublication`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`idcompte`) REFERENCES `compte` (`idcompte`) ON DELETE CASCADE;

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (`idcompte`) REFERENCES `utilisateur` (`idutilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`idcompte`) REFERENCES `compte` (`idcompte`) ON DELETE CASCADE;

--
-- Contraintes pour la table `like_commentaire`
--
ALTER TABLE `like_commentaire`
  ADD CONSTRAINT `like_commentaire_ibfk_1` FOREIGN KEY (`idcommentaire`) REFERENCES `commentaire` (`idcommentaire`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_commentaire_ibfk_2` FOREIGN KEY (`idcompte`) REFERENCES `compte` (`idcompte`) ON DELETE CASCADE;

--
-- Contraintes pour la table `like_publication`
--
ALTER TABLE `like_publication`
  ADD CONSTRAINT `like_publication_ibfk_1` FOREIGN KEY (`idpublication`) REFERENCES `publication` (`idpublication`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_publication_ibfk_2` FOREIGN KEY (`idcompte`) REFERENCES `compte` (`idcompte`) ON DELETE CASCADE;

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`idcompte`) REFERENCES `compte` (`idcompte`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`identreprise`) REFERENCES `entreprise` (`identreprise`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
