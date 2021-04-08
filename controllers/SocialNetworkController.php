<?php

include_once __DIR__.'/../dao/publicationDao.php';
include_once __DIR__.'/../models/publication.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../dao/commentaireDao.php';
include_once __DIR__.'/../models/commentaire.php';
include_once __DIR__.'/../dao/like_publicationDao.php';
include_once __DIR__.'/../models/like_publication.php';

class SocialNetworkController extends CoreController
{
    // page d'acceuil du réseau social
    public function home($parameters)
    {
        $entrepriseId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();
        //à remplacer par la variable idutilisateur de la session courante
        $idUtilisateur = 1696278514562148;

        $publicationList = $this->getPublications($db,$idUtilisateur,$entrepriseId);
        $this->show('singleEntreprise', [
            'title' => 'Social Connect - Home',
            'publicationList' => $publicationList,
            'idUtilisateur' => $idUtilisateur
        ]);
    }

    // get toutes les publication(amis et public)
    public function getPublications($db,$idUtilisateur,$entrepriseId) {
       
        $publicationDao = new publicationDao($db,$idUtilisateur,$entrepriseId);
        $publicationList = $publicationDao->getAll();
        return $publicationList;
    }
    
    // get une publication selon id
    public function getPublication($db,$idUtilisateur) {
        $publication = new publication();
        $publication->setIdpublication($_POST['idpublication']);
        $publicationDao = new publicationDao($db,$idUtilisateur,null);
        $publication = $publicationDao->get($publication->getIdpublication());
        return $publication;
    }

    // créer une nouvelle publication
    public function createPublication($db,$idUtilisateur) {
        $publication = new publication();
        $publication->setDescription($_POST['description']);
        $publication->setStatut($_POST['statut']);
        if(isset($_POST['imageurl'])) {
            $publication->setImageurl($_POST['imageurl']);
        }
        $publicationDao = new publicationDao($db,$idUtilisateur,null);
        $res = $publicationDao->create($publication);
        return $res;
    }

    // modifier une publication
    public function updatePublication($db,$idUtilisateur) {
        $publication = new publication();
        $publication->setIdpublication($_POST['idpublication']);
        $publication->setDescription($_POST['description']);
        $publication->setStatut($_POST['statut']);
        if(isset($_POST['imageurl'])) {
            $publication->setImageurl($_POST['imageurl']);
        }
        $publicationDao = new publicationDao($db,$idUtilisateur,null);
        $res = $publicationDao->update($publication);
        return $res;
    }

    // supprimer une publication
    public function deletePublication($db,$idUtilisateur) {
        $publication = new publication();
        $publication->setIdpublication($_POST['idpublication']);
        $publicationDao = new publicationDao($db,$idUtilisateur,null);
        $publication = $publicationDao->delete($publication->getIdpublication());
        return $publication;
    }

    // like/unlike une publication
    public function LikeUnlikePublication($db,$idUtilisateur) {
        $like_publication = new like_publication();
        $like_publication->setIdpublication($_POST['idpublication']);
        $like_publicationDao = new like_publicationDao($db,$idUtilisateur,null);
        $like_publicationDao->Like_Unlike($like_publication->getIdpublication());  
    }

    // get tous les commentaires dans la base de données
    public function getCommentaires($db,$idUtilisateur) {
       
        $commentaireDao = new commentaireDao($db,$idUtilisateur);
        $commentaireList = $commentaireDao->getAll();
        return $commentaireList;
    }

    // get tous les commmentaires d'une publication(fonction incluse dans getPublications)
    public function getCommentairesPublication($db,$idUtilisateur) {
        $commentaire = new commentaire();
        $commentaire->setIdpublication($_POST['idpublication']);
        $commentaireDao = new commentaireDao($db,$idUtilisateur);
        $commentaireList = $commentaireDao->getAllPostsComents($commentaire->getIdpublication());
        return $commentaireList;
    }

    // get un commentaire selon son id
    public function getCommentaire($db,$idUtilisateur) {
        $commentaire = new commentaire();
        $commentaire->setIdcommentaire($_POST['idcommentaire']);
        $commentaireDao = new commentaireDao($db,$idUtilisateur);
        $commentaire = $commentaireDao->get($commentaire->getIdcommentaire());
        return $commentaire;
    }

    // créer un nouveau commentaire
    public function createCommentaire($db,$idUtilisateur) {
        $commentaire = new commentaire();
        $commentaire->setDescription($_POST['description']);
        $commentaire->setIdpublication($_POST['idpublication']);
        $commentaireDao = new commentaireDao($db,$idUtilisateur);
        $res = $commentaireDao->create($commentaire);
        return $res;
    }

    // modifier un commentaire
    public function updateCommentaire($db,$idUtilisateur) {
        $commentaire = new commentaire();
        $commentaire->setIdcommentaire($_POST['idcommentaire']);
        $commentaire->setDescription($_POST['description']);
        $commentaireDao = new commentaireDao($db,$idUtilisateur);
        $res = $commentaireDao->update($commentaire);
        return $res;
    }

    // supprimer un commentaire
    public function deleteCommentaire($db,$idUtilisateur) {
        $commentaire = new commentaire();
        $commentaire->setIdcommentaire($_POST['idcommentaire']);
        $commentaireDao = new commentaireDao($db,$idUtilisateur);
        $commentaire = $commentaireDao->delete($commentaire->getIdcommentaire());
        return $commentaire;
    }

    // like/unlike un commentaire
    public function LikeUnlikeCommentaire($db,$idUtilisateur) {
        $like_commentaire = new like_commentaire();
        $like_commentaire->setIdcommentaire($_POST['idcommentaire']);
        $like_commentaireDao = new like_commentaireDao($db,$idUtilisateur);
        $like_commentaireDao->Like_Unlike($like_commentaire->getIdcommentaire());  
    }

}