<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
        $this->idUtilisateur = $_SESSION['idutilisateur'];
        $this->entrepriseId = $entrepriseId;
        
    }
 
    // page d'acceuil du réseau social
    public function home($parameters)
    {
        
        $this->init($parameters['id']);

        $entrepriseId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();
       
        $filtre=array();
        $filtre['visibilite']="reseau";
        $filtre['order']="publications";
        $filtre['id']=$parameters['id'];
        $publicationList = $this->getPublications($filtre);

        $idutil = $_SESSION['idutilisateur'];

        $amisDao = new amisDao($db);
        $amisLList = $amisDao->get($_SESSION['idutilisateur']);

        $demandeamisDao = new demandeamisDao($db);
        $demandeamisList = $demandeamisDao->getAlls($_SESSION['idutilisateur']);

        $utilisateurDao = new utilisateurDao($this->db );
        $utilisateurList = $utilisateurDao->getAll($this->entrepriseId);

        $compteDao = new compteDao($db);
        $compteList = $compteDao->getAll($_SESSION['identreprise']);

        $this->show('singleEntreprise', [
            'title' => 'Social Connect - Home',
            'idutil'=> $idutil,
            'demandeamisList' => $demandeamisList,
            'amisLList'=> $amisLList,
            'publicationList' => $publicationList,
            'idUtilisateur' => $this->idUtilisateur,
            'utilisateurList' => $utilisateurList,
            'compteList' => $compteList
        ]);
    }

  public function filtre($parameters)
  {
      $this->init($parameters['id']);

      $entrepriseId = $parameters['id'];

      $DBData = new DBData();
      $db = $DBData->getConnection();
     
   
      $publicationList = $this->getPublications($parameters);

      $idutil = $_SESSION['idutilisateur'];

      $amisDao = new amisDao($db);
      $amisLList = $amisDao->get($_SESSION['idutilisateur']);

      $demandeamisDao = new demandeamisDao($db);
      $demandeamisList = $demandeamisDao->getAlls($_SESSION['idutilisateur']);

      $utilisateurDao = new utilisateurDao($this->db );
      $utilisateurList = $utilisateurDao->getAll($this->entrepriseId);

      $compteDao = new compteDao($db);
      $compteList = $compteDao->getAll($_SESSION['identreprise']);

      $this->show('singleEntreprise', [
          'title' => 'Social Connect - Home',
          'idutil'=> $idutil,
          'demandeamisList' => $demandeamisList,
          'amisLList'=> $amisLList,
          'publicationList' => $publicationList,
          'idUtilisateur' => $this->idUtilisateur,
          'utilisateurList' => $utilisateurList,
          'compteList' => $compteList
      ]);
  }
    // get toutes les publication(amis et public)
    public function getPublications($parameters) {
        $this->init($parameters['id']);
        $publicationDao = new publicationDao($this->db,$this->idUtilisateur,$this->entrepriseId);
        $publicationList = $publicationDao->getAllPublications($parameters);
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
       
    
        if (isset($_FILES["pubMedia"])) {

            $uniqueFileName = uniqid();
            $extension = end(explode(".", $_FILES["pubMedia"]["name"]));
            $tempname = $_FILES["pubMedia"]["tmp_name"];
            $fileSize = $_FILES['pubMedia']['size'];

            if($extension==="mp4"){
                
                 $folder = __DIR__ . '/../public/publicationVideos/'.$uniqueFileName.'.'.$extension;
                 if (move_uploaded_file($tempname, $folder))  {
                    $_SESSION['message']="";
                    $publication->setVideourl($uniqueFileName.'.'.$extension);

                 }
            }  
            else if($extension==="pdf"){
                $folder = __DIR__ . '/../public/publicationFichiers/'.$uniqueFileName.'.'.$extension;
                if (move_uploaded_file($tempname, $folder))  {
                    $_SESSION['message']="";
                    $publication->setFichierurl($uniqueFileName.'.'.$extension);
                }
            }
            else if(($extension==="png") || ($extension==="jpeg") || ($extension==="jpg") || ($extension==="gif")){
            $folder = __DIR__ . '/../public/publicationImages/'.$uniqueFileName.'.'.$extension;
          
            if (move_uploaded_file($tempname, $folder))  {
                $_SESSION['message']="";
                $publication->setImageurl($uniqueFileName.'.'.$extension);
            }
         }
        }

        if (empty($_POST['statut'])) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Fichier non supporté.</div>";
            return 0 ;
        } else if(empty($_POST['description']) && empty($_FILES["pubMedia"]["tmp_name"])) {
            $_SESSION['message'] = "<div class='alert alert-danger'>Veuillez entrer une description ou insérez un média.</div>";
            return 0 ;
        } else {
            $_SESSION['message']="";
            $publication->setDescription($_POST['description']);
            $publication->setStatut($_POST['statut']);
            $publicationDao = new publicationDao($this->db,$this->idUtilisateur,null);
            $res = $publicationDao->create($publication);
        }

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

    // supprimer une publication dans mon compte
    public function deletePublication($parameters) {
        $this->init($parameters['id']);

        $idCompte = $_POST['idcompte'];

        $publication = new publication();
        $publication->setIdpublication($_POST['idpublication']);

        $publicationDao = new publicationDao($this->db,$this->idUtilisateur,null);
        $publication = $publicationDao->delete($publication->getIdpublication());

        header('Location: '.pathUrl().'monCompte/'.$idCompte.'/mesPublications');

        return $publication;
    }

    // supprimer une publication dans home
    public function deletePublicationHome($parameters) {
        $this->init($parameters['id']);

        $idCompte = $_POST['idcompte'];

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
        $commentaire->setDescription($_POST['updateComInput']);
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