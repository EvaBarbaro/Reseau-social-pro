# Dictionnaire de données

## PUBLICATION

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdPublication | Identifiant de la publication | Char | Clé primaire |
| Description | Description de la publication | Char |   |
| Image | Chemin de l'image | Char |   |
| Like | Nombre de like | Int |   |
| IdCompte | Identifiant du compte | Char | Clé étrangère |

## ENTREPRISE

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdEntreprise | Identifiant de l'entreprise(SIRET) | Int | Clé primaire |
| Designation | Nom de l'entreprise | Char | |
| Logo | Chemin du logo | Char | |
| Description | Description de l'entrerpise | Char | |
| Url | Url du réseau lié à l'entrerprise | Char | |

## COMMENTAIRE

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdCommentaire | Identifiant du commentaire | Char | Clé primaire |
| Description | Contenu du commentaire | Char |   |
| Like | Nombre de like | Int |   |
| IdPublication | Identifiant de la publication | Char | Clé étrangère |

## UTILISATEUR

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdUtilisateur | Identifiant de l'utilisateur | Char | Clé primaire |
| NomUtilisateur | Nom de l'utilisateur | Char |   |
| MotDePasse | Mot de passe utilisateur | Char |   |
| Role | Role de l'utilisateur | Char |   |
| IdEntreprise | Identifiant de l'entreprise | Char | Clé étrangère |

## AMIS

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdCompte | Identifiant du compte | Char | Clé primaire |
| IdCompte_ami | Identifiant du pilote | Char | Clé primaire |
| IdCompte | Identifiant du compte | Char | Clé étrangère |
| IdCompte_ami | Identifiant du pilote | Char | Clé étrangère |

## LIKE_PUBLICATION

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdPublication | Identifiant de la publication | Char | Clé primaire |
| IdCompte | Identifiant du compte | Char | Clé primaire |
| IdPublication | Identifiant de la publication | Char | Clé étrangère |
| IdCompte | Identifiant du compte | Char | Clé étrangère |

## LIKE_COMMENTAIRE

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdCommentaire | Identifiant du commentaire | Char | Clé primaire |
| IdCompte | Identifiant du compte | Char | Clé primaire |
| IdCommentaire | Identifiant du commentaire | Char | Clé étrangère |
| IdCompte | Identifiant du compte | Char | Clé étrangère |

## COMPTE

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdCompte | Identifiant du compte | Char | Clé primaire |
| Nom | Nom de l'utilisateur | Char |  |
| Prenom | Prenom de l'utilisateur | Char |  |
| Photo | Chemin de la photo de profil | Char |  |
| Poste | Intitulé du poste de l'utilisateur | Char |   |
| Grade | Grade de l'utilisateur(hiérarchie) | Char |  |
| Departement | Departement du poste de l'utilisateur | Char |  |
| Date_Embauche | Date d'embauche de l'utilisateur | Date |   |
| IdUtilisateur | Identifiant de l'utilisateur lié | Char | Clé étrangère |

## IMAGE

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdImage | Identifiant de l'image | Char | Clé primaire |
| Titre | Titre de l'image | Char |  |
| Image | Chemin de l'image | Char |  |
| IdCompte | Identifiant du compte lié | Char | Clé étrangère |
