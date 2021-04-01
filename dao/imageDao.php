<?php 

include_once __DIR__.'/../interface/dao.php';
include_once __DIR__.'/../utils/DBData.php';

class imageDao implements dao {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(image $image){
        $sql = "INSERT INTO image(titre,image,idcompte) 
			VALUES (:titre, :image, :idcompte)";
        $q=$this->conn->prepare($sql); 

        $q->bindValue(':titre',$image->getTitre(), PDO::PARAM_STR);
        $q->bindValue(':image',$image->getImage(), PDO::PARAM_STR);
        $q->bindValue(':idcompte',$image->getIdcompte(), PDO::PARAM_STR);
        
        $q->execute();
    }
    public function get($id){
        $id = (string) $id;
        $sql = "SELECT * FROM image WHERE idimage=".$id;
			$result = $conn->query($sql);
            return new image($result);
    }
    public function getAll(){
        $sql 	= "SELECT * FROM image";
        $result = $this->conn->query($sql); 
        $images = $result->fetchAll();
        return $images;
    }

    










    update($idimage,$titre,$image,$idcompte){
        $sql = "UPDATE image SET titre='$titre', image = '$image' , idcompte='$idcompte' WHERE id='$idimage';
        $con->query($sql);
    }
    delete($id){
        $sql = "DELETE FROM image WHERE idimage='$id';
        $con->query($sql);

    }


}
/* <?php
interface dao {
    function get();
    function getAll();
    function update();
    function create();
    function delete();
}

*/