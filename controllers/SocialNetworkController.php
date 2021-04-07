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
    public function home()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();
        //à remplacer par la variable idutilisateur de la session courante
        $idUtilisateur = 1696278514562148;
       
        $publicationList = $this->getPublications($db,$idUtilisateur);
        $this->show('socialHome', [
            'title' => 'Social Connect - Home',
            'publicationList' => $publicationList
        ]);
    }

    public function getPublications($db,$idUtilisateur) {
       
        $publicationDao = new publicationDao($db,$idUtilisateur);
        $publicationList = $publicationDao->getAll();
        return $publicationList;
    }
    
    public function getPublication($db,$idUtilisateur) {
        $publication = new publication();
        $publication->setIdpublication($_POST['idpublication']);
        $publicationDao = new publicationDao($db,$idUtilisateur);
        $publication = $publicationDao->get($publication->getIdpublication());
        return $publication;
    }

    public function createPublication($db,$idUtilisateur) {
        $publication = new publication();
        $publication->setDescription($_POST['description']);
        $publication->setStatut($_POST['statut']);
        if(isset($_POST['imageurl'])) {
            $publication->setImageurl($_POST['imageurl']);
        }
        $publicationDao = new publicationDao($db,$idUtilisateur);
        $res = $publicationDao->create($publication);
        return $res;
    }

    public function updatePublication($db,$idUtilisateur) {
        $publication = new publication();
        $publication->setIdpublication($_POST['idpublication']);
        $publication->setDescription($_POST['description']);
        $publication->setStatut($_POST['statut']);
        if(isset($_POST['imageurl'])) {
            $publication->setImageurl($_POST['imageurl']);
        }
        $publicationDao = new publicationDao($db,$idUtilisateur);
        $res = $publicationDao->update($publication);
        return $res;
    }

    public function deletePublication($db,$idUtilisateur) {
        $publication = new publication();
        $publication->setIdpublication($_POST['idpublication']);
        $publicationDao = new publicationDao($db,$idUtilisateur);
        $publication = $publicationDao->delete($publication->getIdpublication());
        return $publication;
    }

    public function LikeUnlikePublication($db,$idUtilisateur) {
        $like_publication = new like_publication();
        $like_publication->setIdpublication($_POST['idpublication']);
        $like_publicationDao = new like_publicationDao($db,$idUtilisateur);
        $like_publicationDao->Like_Unlike($like_publication->getIdpublication());
        
    }
}