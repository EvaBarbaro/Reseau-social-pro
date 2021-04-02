<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/commentaire.php';

class commentaireDao implements interfaceDao {




/**
 * Get a single commentaire
 */ 
public function get($id){
    $sql = "SELECT * FROM commentaire WHERE idcommentaire = :id";

    $pdoStatement = $this->conn->prepare($sql);
    $sql->bindValue(':id', $id, PDO::PARAM_INT);
    $sql->execute();
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
    $sql->bindValue(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $commentaire = $pdoStatement->fetch(PDO::FETCH_ASSOC);

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