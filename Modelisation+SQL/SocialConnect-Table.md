# Table

**PUBLICATION** (idPublication, description, image, like, idCompte)  
**ENTREPRISE** (idEntreprise, designation, logo, description, url)  
**COMMENTAIRE** (idCommentaire, description, like, idPublication)  
**UTILISATEUR** (idUtilisateur, nomUtilisateur, motDePasse, role, idEntreprise)  
**AMIS** (idCompte, idCompte.1)  
**COMPTE** (idCompte, nom, prenom, photo, poste, grade, departement, date embauche, idUtilisateur)  
**IMAGE** (idImage, titre, image, idCompte)
