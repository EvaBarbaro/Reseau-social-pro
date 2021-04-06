<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/commentaire.php';
include_once __DIR__.'/compteDao.php';
include_once __DIR__.'/like_commentaireDao.php';

class commentaireDao implements interfaceDao {
    private $conn;
    private $idUtilisateur;

   public function __construct($db,$idUtilisateur){
        $this->conn = $db;
        $this->idUtilisateur = $idUtilisateur;
    }


    

/**
 * Get infos of a commentaire
 */ 
    private function getInfoCommentaire($com) {
        $commentaire = array();
        $compteDao = new compteDao($this->conn);
        $like_commentaireDao= new like_commentaireDao($this->conn,$this->idUtilisateur);
       
        // les infos dans la table commentaire
        $commentaireInfo = array(
         "idcommentaire"=>$com->getIdcommentaire(),
         "description"=>$com->getDescription(),
         "Nombre Like"=>$com->getLike()
         );
        $commentaire["commentaireInfo"] = $commentaireInfo;
        // savoir si l'utilisteur de la session a liké le commentaire ou pas 
        $like = $like_commentaireDao->Liked($com);
        $commentaire["commentaire_Liked_Par_Utilisateur"] = $like;
        // les infos du créateur du commentaire
        $compte =  $compteDao->getCompteInfos($com->getIdcompte());
        $compteInfo = array(
        "idcompte"=>$compte['idcompte'],
        "nomutilisateur"=>$compte['nomutilisateur'],
        "photo"=>$compte['photo']
        );
        $commentaire["commentaire_compte"] =$compteInfo;
        return  $commentaire;
    }


/**
 * Get a single commentaire
 */ 
public function get($id){
    $sql = "SELECT * FROM commentaire WHERE idcommentaire = :id";

    $pdoStatement = $this->conn->prepare($sql);
    $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
    $pdoStatement->execute();
    $com = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    $commentaireModel = new commentaire($com['idcommentaire'],$com['description'],$com['idpublication'],$com['like'],$com['idcompte']);
    $commentaire = array();
    if($com){
        $commentaire = $this-> getInfoCommentaire($commentaireModel); 
    }
    return $commentaire;

}




/**
* Get all commentaire
*/ 
public function getAll(){
    $sql = "SELECT * FROM commentaire";

    $pdoStatement = $this->conn->query($sql);

    $com = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    $commentaireModel = new commentaire($com['idcommentaire'],$com['description'],$com['idpublication'],$com['like'],$com['idcompte']);
    $commentaire = array();
    if($com){
        $commentaire = $this-> getInfoCommentaire($commentaireModel); 
    }
    return $commentaire;
}




/**
 * Get all publication commentaire
 */ 
public function getAllPostsComents($id){
    $sql = "SELECT * FROM commentaire WHERE idpublication = :id";

    $pdoStatement = $this->conn->prepare($sql);
    $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
    $pdoStatement->execute();
    //$pdoStatement = $this->conn->query($sql);
    $commentaires = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    $commentaire = array();
    if($commentaires){
   
    
    foreach($commentaires as $com){
       $commentaireModel = new commentaire($com['idcommentaire'],$com['description'],$com['idpublication'],$com['like'],$com['idcompte']);
       $commentaireAjouter = $this-> getInfoCommentaire($commentaireModel);
       array_push($commentaire,$commentaireAjouter);
    }

}
    return $commentaire;

}




/**
* Update one commentaire
*/ 
public function update($commentaire){

}




/**
* Create one commentaire
*/ 
public function create($commentaire){

}
    



/**
* Delete one commentaire
*/ 
public function delete($id){

}
}