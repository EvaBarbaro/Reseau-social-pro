<?php 
include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/amis.php';

class amisDao  implements interfaceDao{
    private $conn;
    public function __construct($db){   $this->conn = $db;  }

    public function get2($id1, $id2){
        $id1 = (string) $id1;
        $id2 = (string) $id2;
        $sql = "SELECT * FROM amis WHERE idcompte=".$id1." && idcompte_ami=".$id2;
			$result = $this->conn->query($sql);
            $amis = $result->fetch(PDO::FETCH_ASSOC);
            return $amis;   
    }
    public function get($id1){
        $id1 = (string) $id1;
        $sql = "SELECT * FROM amis WHERE idcompte=".$id1 ;
			$result = $this->conn->query($sql);
            $amiss = $result->fetch(PDO::FETCH_ASSOC);
            return $amiss;   
    }
    public function getAll(){
        $sql 	= "SELECT * FROM amis";
        $result = $this->conn->query($sql); 
        $amiss = $result->fetchAll();
        return $amiss;
    }
    public function create($amis){
        $sql = $this->conn->prepare("INSERT INTO amis(idcompte, idcompte_ami) 
        VALUES(:idcompte, :idcompte_ami )");

        $sql->bindValue(':idcompte', $amis->getIdcompte(), PDO::PARAM_INT);
        $sql->bindValue(':idcompte_ami', $amis->getIdcompte_ami(), PDO::PARAM_INT);
        $sql->execute();
    }
    public function delete($id){     
        $this->conn->exec("DELETE FROM amis WHERE idcompte = $id");    
    }
    public function delete2($id1, $id2){     
        $this->conn->exec("DELETE FROM amis WHERE idcompte = $id1 && idcompte_ami = $id2");    
    }
    public function update($amis){
        $sql = $this->conn->prepare("UPDATE amis SET idcompte_ami = :idcompte_ami WHERE idcompte = :idcompte");  

        $sql->bindValue(':idcompte_ami', $amis->getIdcompte_ami(), PDO::PARAM_INT);
        $sql->bindValue(':idcompte', $amis->getIdcompte(), PDO::PARAM_INT);

        $sql->execute();
    }

    
}