<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/image.php';

class imageDao implements interfaceDao {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }
 
    public function get($id){
        $id = (string) $id;
        $sql = "SELECT * FROM image WHERE idimage=".$id;
			$result = $this->conn->query($sql);
            return new image($result);
    }

 /*   public function get($id) {
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


    public function update($image){
        $sql = $this->conn->prepare("UPDATE image SET titre = :titre, image = :image, idcompte = :idcompte");
        $sql->bindValue(':titre',$image->getTitre(), PDO::PARAM_STR);
        $sql->bindValue(':image',$image->getImage(), PDO::PARAM_STR);
        $sql->bindValue(':idcompte',$image->getIdcompte(), PDO::PARAM_STR);      
        $sql->execute();
    }
    public function create($image){
        $sql = "INSERT INTO image(titre,image,idcompte) VALUES (:titre, :image, :idcompte)";
        $q=$this->conn->prepare($sql); 
        $q->bindValue(':titre',$image->getTitre(), PDO::PARAM_STR);
        $q->bindValue(':image',$image->getImage(), PDO::PARAM_STR);
        $q->bindValue(':idcompte',$image->getIdcompte(), PDO::PARAM_STR);     
        $q->execute();
    }

    public function delete($id){
        $sql = "DELETE FROM image WHERE idimage=".$id;
        $this->conn->execute($sql);
    }
    /*
    public function delete($id) {
        $this->conn->execute("DELETE FROM personnages WHERE id = $id");
    }
    */

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