<?php 

class publicationDao implements publication {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }


/**
 * Get a single publication
 */ 
    public function get(publication $publication){
     
    }



    
/**
 * Get all publication
 */ 
    public function getAll(publication $publication){
        $sql = "SELECT * FROM publication";

        $pdoStatement = $this->conn->query($sql);

        $publication = $pdoStatement->fetchAll();

        return $publication;
    }
    


    
/**
 * Update one publication
 */ 
    public function update(publication $publication){

    }
    


    
/**
 * Create one publication
 */ 
    public function create(publication $publication){

    }
        


    
/**
 * Delete one publication
 */ 
    public function delete(publication $publication){

    }
}