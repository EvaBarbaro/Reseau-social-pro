<?php

session_start();

require_once __DIR__.'/../dao/utilisateurDao.php';
include_once __DIR__.'/../dao/publicationDao.php';
require_once __DIR__.'/../dao/compteDao.php';
include_once __DIR__.'/../models/publication.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../dao/commentaireDao.php';
include_once __DIR__.'/../models/commentaire.php';
include_once __DIR__.'/../dao/like_publicationDao.php';
include_once __DIR__.'/../models/like_publication.php';
include_once __DIR__.'/../dao/like_commentaireDao.php';
include_once __DIR__.'/../models/like_commentaire.php';

class SocialNetworkController extends CoreController
{
   public $entrepriseId;
   public $db;
   public $idUtilisateur;
   
    public function init($entrepriseId){
        $DBData = new DBData();
        $this->db = $DBData->getConnection();
        //à remplacer par la variable idutilisateur de la session courante
        $this->idUtilisateur = $_SESSION['idutilisateur'];
        $this->entrepriseId = $entrepriseId;
        
    }
 
    // page d'acceuil du réseau social
    public function home($parameters)
    {
        $this->init($parameters['id']);
        
        session_start();

        $entrepriseId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();
        //à remplacer par la variable idutilisateur de la session courante
        $idUtilisateur = 1696278514562148;

        $publicationList = $this->getPublications($parameters);

        $utilisateurDao = new utilisateurDao($this->db );
        $utilisateurList = $utilisateurDao->getAll($this->entrepriseId);

        $compteDao = new compteDao($db);
        $compteList = $compteDao->getAll($_SESSION['identreprise']);

        $this->show('singleEntreprise', [
            'title' => 'Social Connect - Home',
            'publicationList' => $publicationList,
            'idUtilisateur' => $this->idUtilisateur,
            'utilisateurList' => $utilisateurList,
            'idUtilisateur' => $idUtilisateur,
            'utilisateurList' => $utilisateurList,
            'compteList' => $compteList
        ]);
    }

    // get toutes les publication(amis et public)
    public function getPublications($parameters) {
        $this->init($parameters['id']);
        $publicationDao = new publicationDao($this->db,$this->idUtilisateur,$this->entrepriseId);
        $publicationList = $publicationDao->getAll();
        return $publicationList;
    }
    
    // get une publication selon id
    public function getPublication($parameters) {
        $this->init($parameters['id']);
        $publication = new publication();
        $publication->setIdpublication($_POST['idpublication']);
        $publicationDao = new publicationDao($this->db,$this->idUtilisateur,null);
        $publication = $publicationDao->get($publication->getIdpublication());
        return $publication;
    }

        // get toutes les publications d'un idcompte
        public function getPublicationByUser($parameters) {

            $idCompte = $parameters['id'];

            $publication = new publication();
            $publication->setIdpublication($idCompte);

            $DBData = new DBData();
            $db = $DBData->getConnection();

            $publicationDao = new publicationDao($db,$idCompte,null);
            $publicationByUser = $publicationDao->getByUser($publication->getIdpublication());

            $compteDao = new compteDao($db);
            $compte = $compteDao->get($idCompte);

            $this->show('publicationsByUser', [
                'title' => 'Social Connect - Mes publications',
                'publicationByUser' => $publicationByUser,
                'compte' => $compte
            ]);
        }

    // créer une nouvelle publication
    public function createPublication($parameters) {
        $this->init($parameters['id']);
        $publication = new publication();
        $publication->setDescription($_POST['description']);
        $publication->setStatut($_POST['statut']);
    
        if (isset($_FILES["pubImage"])) {

            $uniqueFileName = uniqid();
            $extension = end(explode(".", $_FILES["pubImage"]["name"]));
            $tempname = $_FILES["pubImage"]["tmp_name"];    
            $folder = __DIR__ . '/../public/publicationImages/'.$uniqueFileName.'.'.$extension;
          
            if (move_uploaded_file($tempname, $folder))  {
                $publication->setImageurl($uniqueFileName.'.'.$extension);
            }
        }
        $publicationDao = new publicationDao($this->db,$this->idUtilisateur,null);
        $res = $publicationDao->create($publication);
        return $res;
    }

    // modifier une publication
    public function updatePublication($parameters) {
        $this->init($parameters['id']);
        $publication = new publication();

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $idCompte = $_POST['idcompte'];

        $publication->setIdpublication($_POST['idpublication']);
        $publication->setDescription($_POST['description']);
        $publication->setStatut($_POST['statut']);
      
        $publicationDao = new publicationDao($this->db,$this->idUtilisateur,null);
        $publication->setImageurl($_POST['imageurl']);

        $publicationDao = new publicationDao($db,$idCompte,null);
        $res = $publicationDao->update($publication);

        header('Location: '.pathUrl().'monCompte/'.$idCompte.'/mesPublications');
        
        return $res;
    }

    // supprimer une publication
    public function deletePublication($parameters) {
        $this->init($parameters['id']);
        $publication = new publication();
        $publication->setIdpublication($_POST['idpublication']);
        $publicationDao = new publicationDao($this->db,$this->idUtilisateur,null);
        $publication = $publicationDao->delete($publication->getIdpublication());
        return $publication;
    }

    // like/unlike une publication
    public function LikeUnlikePublication($parameters) {
        $this->init($parameters['id']);
        $like_publication = new like_publication($this->idUtilisateur,$_POST['idpublication']);
        //$like_publication->setIdpublication($_POST['idpublication']);
        //var_dump($_POST['idpublication']);
        $like_publicationDao = new like_publicationDao($this->db,$this->idUtilisateur);
        $like_publicationDao->Like_Unlike($like_publication);      
    }

    // get tous les commentaires dans la base de données
    public function getCommentaires($parameters) {
        $this->init($parameters['id']);
        $commentaireDao = new commentaireDao($this->db,$this->idUtilisateur);
        $commentaireList = $commentaireDao->getAll();
        return $commentaireList;
    }

    // get tous les commmentaires d'une publication(fonction incluse dans getPublications)
    public function getCommentairesPublication($parameters) {
        $this->init($parameters['id']);
        $commentaire = new commentaire();
        $commentaire->setIdpublication($_POST['idpublication']);
        $commentaireDao = new commentaireDao($this->db,$this->idUtilisateur);
        $commentaireList = $commentaireDao->getAllPostsComents($commentaire->getIdpublication());
        return $commentaireList;
    }

    // get un commentaire selon son id
    public function getCommentaire($parameters) {
        $this->init($parameters['id']);
        $commentaire = new commentaire();
        $commentaire->setIdcommentaire($_POST['idcommentaire']);
        $commentaireDao = new commentaireDao($this->db,$this->idUtilisateur);
        $commentaire = $commentaireDao->get($commentaire->getIdcommentaire());
        return $commentaire;
    }

    // créer un nouveau commentaire
    public function createCommentaire($parameters) {
        $this->init($parameters['id']);
        $commentaire = new commentaire();
        $commentaire->setDescription($_POST['description']);
        $commentaire->setIdpublication($_POST['idpublication']);
        $commentaireDao = new commentaireDao($this->db,$this->idUtilisateur);
        $res = $commentaireDao->create($commentaire);
        return $res;
    }

    // modifier un commentaire
    public function updateCommentaire($parameters) {
        $this->init($parameters['id']);
        $commentaire = new commentaire();
        $commentaire->setIdcommentaire($_POST['idcommentaire']);
        $commentaire->setDescription($_POST['description']);
        $commentaireDao = new commentaireDao($this->db,$this->idUtilisateur);
        $res = $commentaireDao->update($commentaire);
        return $res;
    }

    // supprimer un commentaire
    public function deleteCommentaire($parameters) {
        $this->init($parameters['id']);
        $commentaire = new commentaire();
        $commentaire->setIdcommentaire($_POST['idcommentaire']);
        $commentaireDao = new commentaireDao($this->db,$this->idUtilisateur);
        $commentaire = $commentaireDao->delete($commentaire->getIdcommentaire());
        return $commentaire;
    }

    // like/unlike un commentaire
    public function LikeUnlikeCommentaire($parameters) {
        $this->init($parameters['id']);
        $like_commentaire = new like_commentaire($this->idUtilisateur,$_POST['idcommentaire']);
        //$like_commentaire->setIdcommentaire($_POST['idcommentaire']);
        $like_commentaireDao = new like_commentaireDao($this->db,$this->idUtilisateur);
        $like_commentaireDao->Like_Unlike($like_commentaire);  
       /* $publication = new publication();
        $publication->setDescription($parameters['id']);
        $publication->setStatut("amis");
       
        $publicationDao = new publicationDao($this->db,$this->idUtilisateur,null);
        $res = $publicationDao->create($publication);
        return $res;*/
    }

}