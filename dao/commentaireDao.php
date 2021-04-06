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




    private function getInfoCommentaire($com) {
        $commentaire = array();
        $compteDao = new compteDao($this->conn);
        $like_commentaireDao= new like_commentaireDao($this->conn,$this->idUtilisateur);
        $commentaireInfo = array(
         "idcommentaire"=>$com['idcommentaire'],
         "description"=>$com['description'],
         "Nombre Like"=>$com['like']
         );
        $commentaire["commentaireInfo"] = $commentaireInfo;
        $like = $like_commentaireDao->Liked($com);
        $commentaire["commentaire_Liked_Par_Utilisateur"] = $like;
        $compte =  $compteDao->get($com['idcompte']);
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
    $commentaire = array();
    if($com){
        $commentaire = $this-> getInfoCommentaire($com); 
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
    $commentaire = array();
    if($com){
        $commentaire = $this-> getInfoCommentaire($com); 
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
       $commentaireAjouter = $this-> getInfoCommentaire($com);
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