<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/commentaire.php';
include_once __DIR__.'/compteDao.php';
include_once __DIR__.'/compteDao.php';

class commentaireDao implements interfaceDao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }



/**
 * Get a single commentaire
 */ 
public function get($id){
    $sql = "SELECT * FROM commentaire WHERE idcommentaire = :id";

    $pdoStatement = $this->conn->prepare($sql);
    $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
    $pdoStatement->execute();
    $commentaire = $pdoStatement->fetch(PDO::FETCH_ASSOC);

    return $commentaire;

}




/**
* Get all commentaire
*/ 
public function getAll(){
    $sql = "SELECT * FROM commentaire";

    $pdoStatement = $this->conn->query($sql);

    $commentaire = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

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
    $commentaire = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    $compteDao = new compteDao($this->conn);
    if($commentaire){
    $comptes = array(); 
    foreach($commentaire as $com){
       $compte =  $compteDao->get($com['idcompte']);
       $compteInfo = array(
       "idcompte"=>$compte['idcompte'],
       "nomutilisateur"=>$compte['nomutilisateur'],
       "photo"=>$compte['photo']
       );
       array_push($comptes,$compteInfo);
       
    }
    $commentaire["compteCommentaires"]=$comptes;
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