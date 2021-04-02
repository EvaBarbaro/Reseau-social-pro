# Dictionnaire de données

## PUBLICATION

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdPublication | Identifiant de la publication | Int | Clé primaire |
| Description | Description de la publication | Char |   |
| ImageUrl | Chemin de l'image | Char |   |
| Like | Nombre de like | Int |   |
| Statut | Statut de la publication (public ou privée) | Char |   |
| IdCompte | Identifiant du compte | int | Clé étrangère |

## ENTREPRISE

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdEntreprise | Identifiant de l'entreprise(SIRET) | Int | Clé primaire |
| Designation | Nom de l'entreprise | Char | |
| Logo | Chemin du logo | Char | |
| Description | Description de l'entrerpise | Char | |
| Url | Url du réseau lié à l'entrerprise | Char | |
| Statut | Actif ou Désactif | Bool |  |

## COMMENTAIRE

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdCommentaire | Identifiant du commentaire | Int | Clé primaire |
| Description | Contenu du commentaire | Char |   |
| Like | Nombre de like | Int |   |
| IdPublication | Identifiant de la publication | Int | Clé étrangère |

## UTILISATEUR

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdUtilisateur | Identifiant de l'utilisateur | Int | Clé primaire |
| NomUtilisateur | Nom de l'utilisateur | Char |   |
| MotDePasse | Mot de passe utilisateur | Char |   |
| Mail | Email de l'utilisateur | Char |   |
| Role | Role de l'utilisateur | Char |   |
| Statut | Actif ou Désactif | Bool |   |
| IdEntreprise | Identifiant de l'entreprise | Int | Clé étrangère |

## AMIS

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdCompte | Identifiant du compte | Int | Clé primaire |
| IdCompte_ami | Identifiant du pilote | Int | Clé primaire |
| IdCompte | Identifiant du compte | Int | Clé étrangère |
| IdCompte_ami | Identifiant du pilote | Int | Clé étrangère |

## LIKE_PUBLICATION

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdPublication | Identifiant de la publication | Int | Clé primaire |
| IdCompte | Identifiant du compte | Int | Clé primaire |
| IdPublication | Identifiant de la publication | Int | Clé étrangère |
| IdCompte | Identifiant du compte | Int | Clé étrangère |

## LIKE_COMMENTAIRE

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdCommentaire | Identifiant du commentaire | Int | Clé primaire |
| IdCompte | Identifiant du compte | Int | Clé primaire |
| IdCommentaire | Identifiant du commentaire | Int | Clé étrangère |
| IdCompte | Identifiant du compte | Int | Clé étrangère |

## COMPTE

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdCompte | Identifiant du compte | Int | Clé primaire |
| Nom | Nom de l'utilisateur | Char |  |
| Prenom | Prenom de l'utilisateur | Char |  |
| Photo | Chemin de la photo de profil | Char |  |
| Poste | Intitulé du poste de l'utilisateur | Char |   |
| Grade | Grade de l'utilisateur(hiérarchie) | Char |  |
| Departement | Departement du poste de l'utilisateur | Char |  |
| Date_Embauche | Date d'embauche de l'utilisateur | Date |   |
| IdUtilisateur | Identifiant de l'utilisateur lié | Int | Clé étrangère |

## IMAGE

| Nom | Description | Type | Commentaire |
| :--------------- |:---------------:|:---------------:| -----:|
| IdImage | Identifiant de l'image | Int | Clé primaire |
| Titre | Titre de l'image | Char |  |
| ImageURL | Chemin de l'image | Char |  |
| IdCompte | Identifiant du compte lié | Int | Clé étrangère |
