CREATE DATABASE IF NOT EXISTS `SOCIALCONNECT` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `SOCIALCONNECT`;

CREATE TABLE `COMMENTAIRE` (
  `idcommentaire` BIGINT NOT NULL,
  `description` VARCHAR(100),
  `like` INTEGER NOT NULL,
  `idpublication` BIGINT NOT NULL,
  `idcompte` BIGINT NOT NULL,
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

ALTER TABLE `COMMENTAIRE` ADD FOREIGN KEY (`idpublication`) REFERENCES `PUBLICATION` (`idpublication`) ON DELETE CASCADE;
ALTER TABLE `COMMENTAIRE` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`) ON DELETE CASCADE;

ALTER TABLE `PUBLICATION` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`) ON DELETE CASCADE;

ALTER TABLE `IMAGE` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`) ON DELETE CASCADE;

ALTER TABLE `LIKE_COMMENTAIRE` ADD FOREIGN KEY (`idcommentaire`) REFERENCES `COMMENTAIRE` (`idcommentaire`) ON DELETE CASCADE;
ALTER TABLE `LIKE_COMMENTAIRE` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`) ON DELETE CASCADE;

ALTER TABLE `UTILISATEUR` ADD FOREIGN KEY (`identreprise`) REFERENCES `ENTREPRISE` (`identreprise`) ON DELETE CASCADE;

ALTER TABLE `LIKE_PUBLICATION` ADD FOREIGN KEY (`idpublication`) REFERENCES `PUBLICATION` (`idpublication`) ON DELETE CASCADE;
ALTER TABLE `LIKE_PUBLICATION` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`) ON DELETE CASCADE;

ALTER TABLE `COMPTE` ADD FOREIGN KEY (`idcompte`) REFERENCES `UTILISATEUR` (`idutilisateur`) ON DELETE CASCADE;

ALTER TABLE `AMIS` ADD FOREIGN KEY (`idcompte_ami`) REFERENCES `COMPTE` (`idcompte`) ON DELETE CASCADE;
ALTER TABLE `AMIS` ADD FOREIGN KEY (`idcompte`) REFERENCES `COMPTE` (`idcompte`) ON DELETE CASCADE;

INSERT INTO ENTREPRISE VALUES 
(1696278527184852,'Google','Logo Google','Je suis Google', 'http://localhost/apache/Reseau-social-pro/monReseau/1696278527184852', true),
(1696278531096786,'Fnac', 'Logo Fnac', 'Je suis la Fnac', 'http://localhost/apache/Reseau-social-pro/monReseau/1696278531096786', true),
(1696278577788060,'Amazon', 'Logo Amazon', 'Je suis Amazon', 'http://localhost/apache/Reseau-social-pro/monReseau/1696278577788060', true)
;

INSERT INTO UTILISATEUR VALUES 
(1696278514562148,'GoogleAdmin', '123', 'google@admin.com', 'admin', true, 1696278527184852),
(1696278527895410,'FnacAdmin', '123', 'fnac@admin.com', 'admin', true, 1696278531096786),
(1696278537845651,'AmazonAdmin', '123', 'amazon@admin.com', 'admin', true, 1696278577788060),
(1696278547894512,'GoogleUser', '123', 'google@user.com', 'user', true, 1696278527184852),
(1696278547894513,'FnacUser', '123', 'fnac@user.com', 'user', true, 1696278531096786),
(1696278547894514,'AmazonUser', '123', 'amazon@user.com', 'user', true, 1696278577788060)
;

INSERT INTO COMPTE VALUES 
(1696278514562148,'Google', 'Jean', 'maPhotoGoogle.jpg', 'Superviseur', 'Manager', 'Developpement', '2019-02-15'),
(1696278527895410,'Fnac', 'Luiza', 'maPhotoFnac.jpg', 'Superviseur', 'Manager', 'Communication', '2017-05-17'),
(1696278537845651,'Amazon', 'Nathalie', 'maPhotoAmazon.jpg', 'Superviseur', 'Manager', 'Relation Presse', '2015-07-02'),
(1696278547894512,'Doe', 'Jane', 'maPhotoGoogle.jpg', 'Developpeur', 'Employe', 'Developpement', '2020-07-25'),
(1696278547894513,'Onyme', 'Anne', 'maPhotoFnac.jpg', 'Community manager', 'Employe', 'Communication', '2021-01-05'),
(1696278547894514,'Drake', 'Nathan', 'maPhotoAmazon.jpg', 'Assistant', 'Employe', 'Communication', '2019-11-01')
;

INSERT INTO IMAGE VALUES 
(1696278514568961,'MonImageGoogle','MonImageGoogle.jpg', 1696278514562148),
(1696278514567560,'MonImageFnac','MonImageFnac.jpg', 1696278527895410),
(1696278514565298,'MonImageDoe','MonImageDoe.jpg', 1696278547894512),
(1696278514561349,'MonImageDrake','MonImageDrake.jpg', 1696278547894514)
;

INSERT INTO PUBLICATION VALUES 
(1696278514567744,'descriptionGoogle','uneImageGoogle.jpg', 0, 'public', 1696278514562148),
(1696278514561268,'descriptionFnac','uneImageFnac.jpg', 0, 'public', 1696278527895410),
(1696278514568239,'descriptionAmazon','uneImageAmazon.jpg', 2, 'public', 1696278537845651),
(1696278514567029,'descriptionDoe','uneImageDoe.jpg', 0, 'public', 1696278547894512),
(1696278514560951,'descriptionOnyme','uneImageOnyme.jpg', 1, 'public', 1696278547894513),
(1696278514561638,'descriptionDrake','uneImageDrake.jpg', 0, 'public', 1696278547894514)
;

INSERT INTO COMMENTAIRE VALUES 
(1696278514565563,'descriptionGoogle', 0, 1696278514561268, 1696278514562148),
(1696278514567789,'descriptionFnac', 1, 1696278514567744, 1696278527895410),
(1696278514562205,'descriptionAmazon', 0, 1696278514561638, 1696278537845651),
(1696278514565607,'descriptionDoe', 2, 1696278514560951, 1696278547894512)
;

INSERT INTO AMIS VALUES 
(1696278514562148, 1696278547894512),
(1696278547894512, 1696278514562148),
(1696278527895410, 1696278547894513),
(1696278547894513, 1696278527895410),
(1696278537845651, 1696278547894514),
(1696278547894514, 1696278537845651)
;

INSERT INTO LIKE_PUBLICATION VALUES 
(1696278537845651, 1696278514568239),
(1696278547894514, 1696278514568239),
(1696278527895410, 1696278514560951)
;

INSERT INTO LIKE_COMMENTAIRE VALUES 
(1696278527895410, 1696278514567789),
(1696278514562148, 1696278514565607),
(1696278547894512, 1696278514565607)
;