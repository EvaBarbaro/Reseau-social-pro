<?php 
include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/amis.php';

class amisDao  implements interfaceDao{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }
    
    // Obtention d'un couple d'amis spécifique (un seul tuple)
    public function get2($id1, $id2){
        $id1 = (string) $id1;
        $id2 = (string) $id2;
        $sql = "SELECT * FROM amis WHERE idcompte=".$id1." && idcompte_ami=".$id2;
			$result = $this->conn->query($sql);
            $amis = $result->fetch(PDO::FETCH_ASSOC);
            return $amis;   
    }

    // Obtention de la liste d'amis de l'id passé en paramètre
    public function get($id1){
        $sql = "SELECT idcompte_ami FROM amis WHERE idcompte=$id1 ";
			$result = $this->conn->query($sql);
            $amiss = $result->fetchAll(PDO::FETCH_ASSOC);
            return $amiss;   
    }

    // Obtention de la liste de tout les tuples d'amis de la table amis
    public function getAll(){
        $sql 	= "SELECT * FROM amis as a, utilisateur as u WHERE a.idcompte =".$_SESSION['idutilisateur']." AND u.idutilisateur = a.idcompte_ami";
        $result = $this->conn->query($sql); 
        $amis = $result->fetchAll(PDO::FETCH_ASSOC);

        return $amis;
    }
    
    public function createInvite($idutilisateur,$idami){
        $sql = $this->conn->prepare("INSERT INTO amis(idcompte, idcompte_ami) 
        VALUES(:idcompte, :idcompte_ami )");

        $sql->bindValue(':idcompte', $idutilisateur, PDO::PARAM_INT);
        $sql->bindValue(':idcompte_ami', $idami, PDO::PARAM_INT);
        $sql->execute();
    }

    public function createConfirm($idutilisateur,$idami){
        $sql = $this->conn->prepare("INSERT INTO amis(idcompte, idcompte_ami) 
        VALUES(:idcompte, :idcompte_ami ),(:idcompte_ami, :idcompte )");

        $sql->bindValue(':idcompte', $idutilisateur, PDO::PARAM_INT);
        $sql->bindValue(':idcompte_ami', $idami, PDO::PARAM_INT);
        $sql->execute();
    }

    // Efface la liste des amis de $id
    public function delete($id){     
        $this->conn->exec("DELETE FROM amis WHERE idcompte = $id");    
    }
    
    // Efface l'ami $id2 de la liste d'ami de $id1
    public function deleteAmis($id1, $id2){     
  $this->conn->exec("DELETE FROM amis WHERE ((idcompte = $id1 && idcompte_ami = $id2) or (idcompte = $id2 && idcompte_ami = $id1))");
 
    }
    
}