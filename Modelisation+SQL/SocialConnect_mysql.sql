CREATE DATABASE IF NOT EXISTS `SOCIALCONNECT` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `SOCIALCONNECT`;

CREATE TABLE `PUBLICATION` (
  `idpublication` VARCHAR(42),
  `description` VARCHAR(100),
  `image` VARCHAR(42),
  `like` INTEGER NOT NULL,
  `idcompte` VARCHAR(42),
  PRIMARY KEY (`idpublication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ENTREPRISE` (
  `identreprise` VARCHAR(42),
  `designation` VARCHAR(42),
  `logo` VARCHAR(42),
  `description` VARCHAR(100),
  `url` VARCHAR(42),
  PRIMARY KEY (`identreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `COMMENTAIRE` (
  `idcommentaire` VARCHAR(42),
  `description` VARCHAR(100),
  `like` INTEGER NOT NULL,
  `idpublication` VARCHAR(42),
  PRIMARY KEY (`idcommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `UTILISATEUR` (
  `idutilisateur` VARCHAR(42),
  `nomutilisateur` VARCHAR(42),
  `motdepasse` VARCHAR(42),
  `role` VARCHAR(42),
  `identreprise` VARCHAR(42),
  PRIMARY KEY (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `AMIS` (
  `idcompte` VARCHAR(42),
  `idcompte_ami` VARCHAR(42),
  PRIMARY KEY (`idcompte`, `idcompte_ami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `COMPTE` (
  `idcompte` VARCHAR(42),
  `nom` VARCHAR(42),
  `prenom` VARCHAR(42),
  `photo` VARCHAR(42),
  `poste` VARCHAR(42),
  `grade` VARCHAR(42),
  `departement` VARCHAR(42),
  `date_embauche` VARCHAR(42),
  `idutilisateur` VARCHAR(42),
  PRIMARY KEY (`idcompte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `IMAGE` (
  `idimage` VARCHAR(42),
  `titre` VARCHAR(42),
  `image` VARCHAR(42),
  `idcompte` VARCHAR(42),
  PRIMARY KEY (`idimage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `PUBLICATION` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`);
ALTER TABLE `COMMENTAIRE` ADD FOREIGN KEY (`idpublication`) REFERENCES `PUBLICATION` (`idpublication`);
ALTER TABLE `UTILISATEUR` ADD FOREIGN KEY (`identreprise`) REFERENCES `ENTREPRISE` (`identreprise`);
ALTER TABLE `AMIS` ADD FOREIGN KEY (`idcompte_ami`) REFERENCES `COMPTE` (`idcompte`);
ALTER TABLE `AMIS` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`);
ALTER TABLE `COMPTE` ADD FOREIGN KEY (`idutilisateur`) REFERENCES `UTILISATEUR` (`idutilisateur`);
ALTER TABLE `IMAGE` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`);