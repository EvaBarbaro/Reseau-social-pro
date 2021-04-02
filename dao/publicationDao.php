<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/entreprise.php';

class publicationDao implements interfaceDao {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }


/**
 * Get a single publication
 */ 
    public function get($id){
        $sql = "SELECT * FROM publication WHERE idpublication = :id";

        $pdoStatement = $this->conn->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $publication = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $publication;
    }



    
/**
 * Get all publication
 */ 
    public function getAll(){
        $sql = "SELECT * FROM publication";

        $pdoStatement = $this->conn->query($sql);

        $publication = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $publication;
    }
    


    
/**
 * Update one publication
 */ 
    public function update($publication){

    }
    


    
/**
 * Create one publication
 */ 
    public function create($publication){

    }
        


    
/**
 * Delete one publication
 */ 
    public function delete($id){

    }
}