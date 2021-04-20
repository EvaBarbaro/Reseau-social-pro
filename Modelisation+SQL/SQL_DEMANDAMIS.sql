CREATE TABLE `DemandeAmis` (
`idcompte_demandeur` bigint(20) NOT NULL,
`idcompte_solliciter` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `DemandeAmis` 
ADD PRIMARY KEY (`idcompte_demandeur`,`idcompte_solliciter`)/*,
ADD KEY `idcompte_solliciter` (`idcompte_solliciter`)*/;

ALTER TABLE `DemandeAmis`
ADD CONSTRAINT `DemandeAmis_ibfk_1` FOREIGN KEY (`idcompte_solliciter`) REFERENCES `compte` (`idcompte`) ON DELETE CASCADE,
ADD CONSTRAINT `DemandeAmis_ibfk_2` FOREIGN KEY (`idcompte_demandeur`) REFERENCES `compte` (`idcompte`) ON DELETE CASCADE;