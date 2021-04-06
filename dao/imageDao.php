<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/image.php';

//include_once __DIR__.'/../interface/interfaceDao.php';
//include_once __DIR__.'/../utils/DBData.php';
//include_once __DIR__.'/../models/entreprise.php';

class imageDao implements interfaceDao {
    private $conn;

    public function __construct($db){   $this->conn = $db;  }
    
    public function get($id){
        $id = (string) $id;
        $sql = "SELECT * FROM image WHERE idimage=".$id;
			$result = $this->conn->query($sql);
            $image = $result->fetch(PDO::FETCH_ASSOC);

            return $image;   
    }
    /*
    public function get($id) {
        $sql = "SELECT * FROM `entreprise` WHERE `identreprise` = $id";
        $pdoStatement = $this->conn->query($sql);
        $entreprise = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        return $entreprise;
    }
    */









    public function getAll(){
        $sql 	= "SELECT * FROM image";
        $result = $this->conn->query($sql); 
        $images = $result->fetchAll();
        return $images;
    }
    
    
    
    
}
