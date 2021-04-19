ALTER TABLE `PUBLICATION` ADD `videourl` varchar(100) DEFAULT NULL;
ALTER TABLE `PUBLICATION` ADD `fichierurl` varchar(100) DEFAULT NULL;

INSERT INTO `publication` (`idpublication`, `description`, `imageurl`, `like`, `statut`, `idcompte`, `datePub`, `videourl`, `fichierurl`) VALUES

(1697475944022720, 'test pdf', NULL, 1, 'public', 1696278527895410, '2021-04-19 15:33:30', NULL, '607d86aa87ed8.pdf'),
(1697476033531564, 'test video', '', 1, 'public', 1696278527895410, '2021-04-19 15:34:55', '607d86ffe4ac3.mp4', NULL);
/*
ALTER TABLE `PUBLICATION` ADD `datePub` DATETIME;
ALTER TABLE `COMMENTAIRE` ADD `dateCom` DATETIME;

DELETE FROM `LIKE_COMMENTAIRE`;
DELETE FROM `LIKE_PUBLICATION`;

DELETE FROM `COMMENTAIRE`;
DELETE FROM `PUBLICATION`;

INSERT INTO `publication` (`idpublication`, `description`, `imageurl`, `like`, `statut`, `idcompte`, `datePub`) VALUES
(1696278514560951, 'descriptionOnyme', 'uneImageOnyme.jpg', 1, 'public', 1696278547894513, '2021-04-14 18:15:27'),
(1696278514561268, 'descriptionFnac', 'uneImageFnac.jpg', 0, 'public', 1696278527895410, '2021-04-13 10:15:27'),
(1696278514561638, 'descriptionDrake', 'uneImageDrake.jpg', 1, 'public', 1696278547894514, '2021-04-13 12:20:50'),
(1696278514567029, 'descriptionDoe', 'uneImageDoe.jpg', 1, 'amis', 1696278547894512, '2021-04-10 17:15:27'),
(1696278514567744, 'descriptionGoogle', 'uneImageGoogle.jpg', 2, 'public', 1696278514562148, '2021-04-14 09:09:15'),
(1696278514568239, 'descriptionAmazon', 'uneImageAmazon.jpg', 1, 'amis', 1696278537845651, '2021-03-14 17:02:13');

INSERT INTO `commentaire` (`idcommentaire`, `description`, `like`, `idpublication`, `idcompte`, `dateCom`) VALUES
(1696278514562205, 'descriptionAmazon', 1, 1696278514561638, 1696278537845651, '2021-04-13 12:25:10'),
(1696278514565563, 'descriptionFnac', 2, 1696278514561268, 1696278547894513, '2021-04-14 13:20:14'),
(1696278514565607, 'comFnac', 1, 1696278514560951, 1696278527895410, '2021-04-14 19:01:17'),
(1696278514567789, 'comGoogle', 1, 1696278514567744, 1696278547894512, '2021-04-14 10:08:01');

INSERT INTO `like_publication` (`idcompte`, `idpublication`) VALUES
(1696278514562148, 1696278514567029),
(1696278514562148, 1696278514567744),
(1696278527895410, 1696278514560951),
(1696278537845651, 1696278514561638),
(1696278547894512, 1696278514567744),
(1696278547894514, 1696278514568239);

INSERT INTO `like_commentaire` (`idcompte`, `idcommentaire`) VALUES
(1696278514562148, 1696278514567789),
(1696278527895410, 1696278514565563),
(1696278547894513, 1696278514565563),
(1696278547894513, 1696278514565607),
(1696278547894514, 1696278514562205);
*/