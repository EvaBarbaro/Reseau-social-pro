# Table

**COMMENTAIRE** ( idCommentaire, description, like, #idPublication )
**PUBLICATION** ( idPublication, description, image, like, #idCompte )
**LIKE_PUBLICATION** ( #idCompte, #idPublication )
**LIKE_COMMENTAIRE** ( #idCompte, #idCommentaire )
**COMPTE** ( idCompte, nom, prenom, photo, poste, grade, departement, date embauche, #idUtilisateur )
**UTILISATEUR** ( idUtilisateur, nomUtilisateur, motDePasse, role, statut, #idEntreprise )
**IMAGE** ( idImage, titre, image, #idCompte )
**AMIS** ( #idCompte, #idCompte.ami )
**ENTREPRISE** ( idEntreprise, designation, logo, description, url, statut )
