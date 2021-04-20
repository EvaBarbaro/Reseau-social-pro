<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/publication.php';
include_once __DIR__.'/commentaireDao.php';
include_once __DIR__.'/compteDao.php';
include_once __DIR__.'/like_publicationDao.php';

class publicationDao implements interfaceDao {

    private $conn;
    private $idUtilisateur;
    private $entrepriseId;
    public function __construct($db,$idUtilisateur,$entrepriseId){
        $this->conn = $db;
        $this->idUtilisateur = $idUtilisateur;
        $this->entrepriseId = $entrepriseId;
    }




/**
 * Get infos of a publication
 */ 
    private function getInfoPublication($pub) {
        $compteDao = new compteDao($this->conn);
        $commentaireDao = new commentaireDao($this->conn,$this->idUtilisateur);
        $like_publicationDao = new like_publicationDao($this->conn,$this->idUtilisateur);
        $publication = array();
         // les infos dans la table publication
         $pubInfo = array(
            "idpublication"=>$pub->getIdpublication(),
            "description"=>$pub->getDescription(),
            "imageurl"=>$pub->getImageurl(),
            "videourl"=>$pub->getVideourl(),
            "fichierurl"=>$pub->getFichierurl(),
            "Nombre Like"=>$pub->getLike(),
            "statut"=>$pub->getStatut(),
            "date" =>date("d/m/Y H:i",strtotime($pub->getDatePub()))
            );
        $publication["publicationInfos"] = $pubInfo;
        // savoir si l'utilisteur de la session a liké la publication ou pas 
        $like = $like_publicationDao->Liked($pub);
        $publication["publication_Liked_Par_Utilisateur"] = $like;
        // les infos du créateur de la publication
        $compte =  $compteDao->getCompteInfos($pub->getIdcompte());
        if(!empty($compte)){
        $compteInfo = array(
        "idcompte"=>$compte['idcompte'],
        "nomutilisateur"=>$compte['nomutilisateur'],
        "photo"=>$compte['photo']
        );
        $publication["comptePublication"] = $compteInfo;
        }
        // les commentaires de la publication
        $commentaires =  $commentaireDao->getAllPostsComents($pub->getIdpublication());
        $publication["commentaires"] = $commentaires;
        return $publication;
    }




/**
 * Get a single publication
 */ 
    public function get($id){
        $sql = "SELECT * FROM publication WHERE idpublication = :id";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();
        $pub = $pdoStatement->fetch(PDO::FETCH_ASSOC);
       
        $publication = array();
        if(!empty($pub)){
      
            // publication à retourner
            $publicationModel = new publication();
            $publicationModel->construct($pub['idpublication'],$pub['description'],$pub['statut'],$pub['idcompte'],$pub['like'],$pub['datePub']);
            $publicationModel->setImageurl($pub['imageurl']);
            $publication = $this->getInfoPublication($publicationModel);
 
         }
        return $publication;
    }


    /**
     * Get publication pour un utilisateur
     */ 
    public function getByUser($id){
        $idUtilisateur=$_SESSION['idutilisateur'];
        if($idUtilisateur===$id){
            $sql = "SELECT * FROM publication WHERE idcompte = $id"; 
        } else {
            $sql = "SELECT p.* FROM publication p WHERE (idcompte = $id) AND ((p.statut='public') OR ( (p.statut='amis') AND (p.idcompte  IN 
                (SELECT amis.idcompte FROM amis WHERE ( ( (amis.idcompte=p.idcompte) AND (amis.idcompte_ami=$idUtilisateur) ) OR (
                (amis.idcompte= $idUtilisateur) AND (amis.idcompte_ami=p.idcompte) ) ) ) ) ) )";
        }
        
        $pdoStatement = $this->conn->query($sql);

        $publication = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    
        return $publication;
    }

    public function getAll(){}
/**
 * Get all publication
 */ 
    public function getAllPublications($parameters){

        $sql = "SELECT p.* FROM publication p , utilisateur t WHERE (( (t.identreprise=:identreprise) AND (p.idcompte = t.idutilisateur) ) AND ( ";
        if($parameters['visibilite']==="public"){
            $sql=$sql."(p.statut='public')";
        }
        else if($parameters['visibilite']==="amis"){
            $sql=$sql."( (p.statut='amis') AND (p.idcompte  IN 
            (SELECT amis.idcompte FROM amis WHERE ( ( (amis.idcompte=p.idcompte) AND (amis.idcompte_ami=:id) ) OR (
            (amis.idcompte=:id) AND (amis.idcompte_ami=p.idcompte) ) ) ) OR (p.idcompte=:id) ) )";
        }
        else {
            $sql=$sql."(p.statut='public') OR (p.idcompte=:id) OR 
            ( (p.statut='amis') AND (p.idcompte  IN 
            (SELECT amis.idcompte FROM amis WHERE ( ( (amis.idcompte=p.idcompte) AND (amis.idcompte_ami=:id) ) OR (
            (amis.idcompte=:id) AND (amis.idcompte_ami=p.idcompte) ) ) ) ) )";
        }
        $sql=$sql.")) ";
        if($parameters['order']==="popularite"){
            $sql=$sql."ORDER BY p.like DESC";
        }
        else  {
            $sql=$sql."ORDER BY datePub DESC";
        }

        $pdoStatement = $this->conn->prepare($sql);
        if($parameters['visibilite']!=="public")  {
        $pdoStatement->bindValue(':id', $this->idUtilisateur, PDO::PARAM_INT);
        }
        $pdoStatement->bindValue(':identreprise',$this->entrepriseId, PDO::PARAM_INT);
        $pdoStatement->execute();
        $publications = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        
        
        $publication = array();
        if(!empty($publications)){
            foreach($publications as $pub){
                $publicationModel = new publication();
                $publicationModel->construct($pub['idpublication'],$pub['description'],$pub['statut'],$pub['idcompte'],$pub['like'],$pub['datePub']);
                $publicationModel->setImageurl($pub['imageurl']);
                $publicationModel->setVideourl($pub['videourl']);
                $publicationModel->setFichierurl($pub['fichierurl']);
                // publication à ajouté
                $publicationAjouter = $this->getInfoPublication($publicationModel);
                array_push($publication,$publicationAjouter);
             }
        }

        return $publication;
    }
    


    
   
/**
 * Create one publication
 */ 
    public function create($publication){
        do {
            $pubId = hexdec(uniqid());
        } while(!empty($this->get($pubId)));
        $sql = "INSERT INTO publication (idpublication,description,publication.like,statut,idcompte,datePub";
        if($publication->getImageurl()!==null){
            $sql=$sql.",imageurl";
        }
        else if($publication->getVideourl()!==null){
            $sql=$sql.",videourl";
        }
        else if($publication->getFichierurl()!==null){
            $sql=$sql.",fichierurl";
        }
        $sql=$sql.") VALUES (:pubId,:description,:like,:statut,:idcompte,:datePub";
         if($publication->getImageurl()!==null){
            $sql=$sql.",:imageurl";
        }  else if($publication->getVideourl()!==null){
            $sql=$sql.",:videourl";
        }
        else if($publication->getFichierurl()!==null){
            $sql=$sql.",:fichierurl";
        }
        $sql=$sql.")";
    
        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':pubId', $pubId, PDO::PARAM_INT);
        $pdoStatement->bindValue(':datePub',date("Y-m-d H:i:sa"));
        $pdoStatement->bindValue(':description',$publication->getDescription());
        if($publication->getImageurl()!==null){
        $pdoStatement->bindValue(':imageurl',$publication->getImageurl());
        }
        else if($publication->getVideourl()!==null){
        $pdoStatement->bindValue(':videourl',$publication->getVideourl());
        }
        else if($publication->getFichierurl()!==null){
        $pdoStatement->bindValue(':fichierurl',$publication->getFichierurl());
        }
        $pdoStatement->bindValue(':like', 0, PDO::PARAM_INT);
        $pdoStatement->bindValue(':statut',$publication->getStatut());
        $pdoStatement->bindValue(':idcompte', $this->idUtilisateur, PDO::PARAM_INT);
        $res = $pdoStatement->execute();
        //$res = 1 (true) if sucess
        return $res;
    }




/**
 * Update one publication
 */ 
public function update($publication){
    $sql = "UPDATE publication SET description=:description , statut=:statut";  
    if($publication->getImageurl()!==null){
        $sql=$sql.",imageurl=:imageurl";
    }
    $sql = $sql." WHERE idpublication=:pubId";
    $pdoStatement = $this->conn->prepare($sql);
    $pdoStatement->bindValue(':pubId', $publication->getIdpublication(), PDO::PARAM_INT);
    $pdoStatement->bindValue(':description', $publication->getDescription());
    if($publication->getImageurl()!==null){
    $pdoStatement->bindValue(':imageurl', $publication->getImageurl());
    }
    $pdoStatement->bindValue(':statut', $publication->getStatut());
    $res = $pdoStatement->execute();
    //$res = 1 (true) if sucess
    return $res;
}



      
/**
 * Delete one publication
 */ 
    public function delete($id){
        $sql = "DELETE FROM publication WHERE idpublication=:pubId";
        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':pubId', $id, PDO::PARAM_INT);
        $res = $pdoStatement->execute();
        //$res = 1 (true) if sucess
        return $res;
    }

   
}