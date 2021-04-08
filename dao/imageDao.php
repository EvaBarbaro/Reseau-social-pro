<?php 
include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/image.php';
class imageDao implements interfaceDao {
    private $conn;

    
        
        
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
        /*public function delete($id) {
        $this->conn->exec("DELETE FROM entreprise WHERE identreprise = $id");
        }*/
    
    
    public function update($image){
        $sql = $this->conn->prepare("UPDATE image SET titre = :titre, 
        imageurl = :imageurl, idcompte = :idcompte  WHERE idimage = :idimage"); 
        $image = new image();   

        $image->setIdimage($_POST['idimage']);
        $image->setTitre($_POST['tire']);
        $image->setImageUrl($_POST['imageurl']);
        $image->setIdcompte($_POST['idcompte']);

        $sql->bindValue(':idimage', $image->getIdimage(), PDO::PARAM_INT);
        $sql->bindValue(':titre', $image->getTitre());
        $sql->bindValue(':imageurl', $image->getImageUrl());
        $sql->bindValue(':idcompte', $image->getIdcompte(),PDO::PARAM_INT);

        $sql->execute();
    }
    
    public function __construct($db){   $this->conn = $db;  }
    
    public function get($id){
        $id = (string) $id;
        $sql = "SELECT * FROM image WHERE idimage=".$id;
			$result = $this->conn->query($sql);
            $image = $result->fetch(PDO::FETCH_ASSOC);

            return $image;   
    }
    

    public function getAll(){
        $sql 	= "SELECT * FROM image";
        $result = $this->conn->query($sql); 
        $images = $result->fetchAll();
        return $images;
    }
    
    
    
}   

