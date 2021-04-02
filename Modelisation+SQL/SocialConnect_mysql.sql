CREATE DATABASE IF NOT EXISTS `SOCIALCONNECT` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `SOCIALCONNECT`;

CREATE TABLE `COMMENTAIRE` (
  `idcommentaire` BIGINT NOT NULL,
  `description` VARCHAR(100),
  `like` INTEGER NOT NULL,
  `idpublication` BIGINT NOT NULL,
  PRIMARY KEY (`idcommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `PUBLICATION` (
  `idpublication` BIGINT NOT NULL,
  `description` VARCHAR(100),
  `imageurl` VARCHAR(100),
  `like` INTEGER NOT NULL,
  `statut` VARCHAR(42),
  `idcompte` BIGINT NOT NULL,
  PRIMARY KEY (`idpublication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `IMAGE` (
  `idimage` BIGINT NOT NULL,
  `titre` VARCHAR(42),
  `imageurl` VARCHAR(100),
  `idcompte` BIGINT NOT NULL,
  PRIMARY KEY (`idimage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `LIKE_COMMENTAIRE` (
  `idcompte` BIGINT NOT NULL,
  `idcommentaire` BIGINT NOT NULL,
  PRIMARY KEY (`idcompte`, `idcommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `UTILISATEUR` (
  `idutilisateur` BIGINT NOT NULL,
  `nomutilisateur` VARCHAR(42),
  `motdepasse` VARCHAR(100),
  `mail` VARCHAR(42),
  `role` VARCHAR(42),
  `statut` BOOLEAN,
  `identreprise` BIGINT NOT NULL,
  PRIMARY KEY (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `LIKE_PUBLICATION` (
  `idcompte` BIGINT NOT NULL,
  `idpublication` BIGINT NOT NULL,
  PRIMARY KEY (`idcompte`, `idpublication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `COMPTE` (
  `idcompte` BIGINT NOT NULL,
  `nom` VARCHAR(42),
  `prenom` VARCHAR(42),
  `photo` VARCHAR(42),
  `poste` VARCHAR(42),
  `grade` VARCHAR(42),
  `departement` VARCHAR(42),
  `date_embauche` DATE,
  `idutilisateur` BIGINT NOT NULL,
  PRIMARY KEY (`idcompte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ENTREPRISE` (
  `identreprise` BIGINT NOT NULL,
  `designation` VARCHAR(42),
  `logo` VARCHAR(42),
  `description` VARCHAR(42),
  `url` VARCHAR(100),
  `statut` BOOLEAN,
  PRIMARY KEY (`identreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `AMIS` (
  `idcompte` BIGINT NOT NULL,
  `idcompte_ami` BIGINT NOT NULL,
  PRIMARY KEY (`idcompte`, `idcompte_ami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `COMMENTAIRE` ADD FOREIGN KEY (`idpublication`) REFERENCES `PUBLICATION` (`idpublication`);
ALTER TABLE `PUBLICATION` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`);
ALTER TABLE `IMAGE` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`);
ALTER TABLE `LIKE_COMMENTAIRE` ADD FOREIGN KEY (`idcommentaire`) REFERENCES `COMMENTAIRE` (`idcommentaire`);
ALTER TABLE `LIKE_COMMENTAIRE` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`);
ALTER TABLE `UTILISATEUR` ADD FOREIGN KEY (`identreprise`) REFERENCES `ENTREPRISE` (`identreprise`);
ALTER TABLE `LIKE_PUBLICATION` ADD FOREIGN KEY (`idpublication`) REFERENCES `PUBLICATION` (`idpublication`);
ALTER TABLE `LIKE_PUBLICATION` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`);
ALTER TABLE `COMPTE` ADD FOREIGN KEY (`idutilisateur`) REFERENCES `UTILISATEUR` (`idutilisateur`);
ALTER TABLE `AMIS` ADD FOREIGN KEY (`idcompte_ami`) REFERENCES `COMPTE` (`idcompte`);
ALTER TABLE `AMIS` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`);