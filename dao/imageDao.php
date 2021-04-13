<?php

include_once __DIR__.'/../interface/interfaceImageDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/image.php';
class imageDao implements interfaceImageDao {
    private $conn; 
    public function __construct($db){   $this->conn = $db;  }
        
    public function create($image){
        $sql = $this->conn->prepare("INSERT INTO image(idimage, titre, imageurl, idcompte) 
        VALUES(:idimage, :titre, :imageurl, :idcompte)");

        $sql->bindValue(':idimage', $image->getIdimage(), PDO::PARAM_INT);
        $sql->bindValue(':titre', $image->getTitre());
        $sql->bindValue(':imageurl', $image->getImageUrl());
        $sql->bindValue(':idcompte', $image->getIdcompte(),PDO::PARAM_INT);

        $sql->execute();
    }

    public function delete($id){     
        $this->conn->exec("DELETE FROM image WHERE idimage = $id");    
    }
    
    public function update($image){
        $sql = $this->conn->prepare("UPDATE image SET titre = :titre, 
        imageurl = :imageurl, idcompte = :idcompte  WHERE idimage = :idimage"); 

        $sql->bindValue(':idimage', $image->getIdimage(), PDO::PARAM_INT);
        $sql->bindValue(':titre', $image->getTitre());
        $sql->bindValue(':imageurl', $image->getImageUrl());
        $sql->bindValue(':idcompte', $image->getIdcompte(),PDO::PARAM_INT);

        $sql->execute();
    }
      
    public function get($id){
        $id = (string) $id;
        $sql = "SELECT * FROM image WHERE idimage=".$id;
			$result = $this->conn->query($sql);
            $image = $result->fetch(PDO::FETCH_ASSOC);

            return $image;   
    }
    

    public function getAll($id){
        $sql 	= "SELECT * FROM image WHERE idcompte =" .$id;
        $result = $this->conn->query($sql); 
        // (fetchAll-->) Transforme le bloc registrement de result en tableau de ligne
        $images = $result->fetchAll();
        return $images;
    }
    
    
    
}   

