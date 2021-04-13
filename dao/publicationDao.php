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
            "Nombre Like"=>$pub->getLike(),
            "statut"=>$pub->getStatut()
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
            $publicationModel->construct($pub['idpublication'],$pub['description'],$pub['statut'],$pub['idcompte'],$pub['like']);
            $publicationModel->setImageurl($pub['imageurl']);
            $publication = $this->getInfoPublication($publicationModel);
 
         }
        return $publication;
    }



    
/**
 * Get all publication
 */ 
    public function getAll(){
        $sql = "SELECT p.* FROM publication p , utilisateur t WHERE (t.identreprise=:identreprise AND P.idcompte = t.idutilisateur ) AND ( (p.statut='public') OR 
        (p.statut='amis' AND p.idcompte IN 
        (SELECT amis.idcompte FROM amis WHERE ((amis.idcompte=p.idcompte AND amis.idcompte_ami=:id)OR(
        amis.idcompte=:id AND amis.idcompte_ami=p.idcompte)))) OR (idcompte=:id) )";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':id', $this->idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->bindValue(':identreprise',$this->entrepriseId, PDO::PARAM_INT);
        $pdoStatement->execute();
        $publications = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        
        
        $publication = array();
        if(!empty($publications)){
            foreach($publications as $pub){
                $publicationModel = new publication();
                $publicationModel->construct($pub['idpublication'],$pub['description'],$pub['statut'],$pub['idcompte'],$pub['like']);
                $publicationModel->setImageurl($pub['imageurl']);
                // publication à ajouté
                $publicationAjouter = $this->getInfoPublication($publicationModel);
                array_push($publication,$publicationAjouter);
             }
        }

        return array_reverse($publication);
    }
    


    
   
/**
 * Create one publication
 */ 
    public function create($publication){
        do {
            $pubId = hexdec(uniqid());
        } while(!empty($this->get($pubId)));
        $sql = "INSERT INTO publication (idpublication,description,publication.like,statut,idcompte";
        if($publication->getImageurl()!==null){
            $sql=$sql.",imageurl";
        }
        $sql=$sql.") VALUES (:pubId,:description,:like,:statut,:idcompte";
         if($publication->getImageurl()!==null){
            $sql=$sql.",:imageurl";
        }
        $sql=$sql.")";
    
        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':pubId', $pubId, PDO::PARAM_INT);
        $pdoStatement->bindValue(':description',$publication->getDescription());
        if($publication->getImageurl()!==null){
        $pdoStatement->bindValue(':imageurl',$publication->getImageurl());
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