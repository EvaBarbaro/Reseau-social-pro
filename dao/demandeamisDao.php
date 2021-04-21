<?php 
include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';


class demandeamisDao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }
    
    // Obtention d'un couple de demandeamis spécifique (un seul tuple)
    public function get2($id1, $id2){
        $sql = "SELECT * FROM demandeamis WHERE idcompte_demandeur=".$id1." && idcompte_solliciter=".$id2;
			$result = $this->conn->query($sql);
            $demandeamis = $result->fetch(PDO::FETCH_ASSOC);
            return $demandeamis;   
    }

    // Obtention de la liste des gens qui m'ont demandé en ami, id passé en paramètre est mon id
    public function getAll($id1){
        $id1 = (string) $id1;
        $sql = "SELECT idcompte_demandeur FROM demandeAmis WHERE idcompte_solliciter=$id1" ;
			$result = $this->conn->query($sql);
            $amiss = $result->fetch(PDO::FETCH_ASSOC);
            return $amiss;   
    }

    // Obtention de la liste des gens que j'ai demandé en ami, id passé en paramètre est mon id
    public function getAllDemandes($id1){
        $id1 = (string) $id1;
        $sql = "SELECT idcompte_solliciter FROM demandeAmis WHERE idcompte_demandeur=$id1" ;
			$result = $this->conn->query($sql);
            $amiss = $result->fetch(PDO::FETCH_ASSOC);
            return $amiss;   
    }

    public function createDemandeAmis($id1,$id2){
        $sql = $this->conn->prepare("INSERT INTO demandeAmis(idcompte_demandeur, idcompte_solliciter)VALUES($id1,$id2)"); 
        $sql->execute();
    }

    public function deleteDemandeAmis($id1,$id2){
        $this->conn->exec("DELETE FROM demandeAmis WHERE idcompte_demandeur = $id1 and idcompte_solliciter = $id2");

    }
   

//     SELECT a.idcompte_ami FROM amis as a, amis as b, utilisateur as u WHERE 
// a.idcompte ="1696278514562148" AND 
// u.idutilisateur = a.idcompte_ami AND  
// b.idcompte = a.idcompte_ami and 
//  b.idcompte_ami = "1696278514562148";

/* LISTE DEMANDE AMIS 
SELECT DISTINCT a.idcompte_ami FROM amis as a, amis as b, utilisateur as u WHERE 
a.idcompte ="1696278514562148" AND 
u.idutilisateur = a.idcompte_ami AND NOT( 
b.idcompte = a.idcompte_ami and 
b.idcompte_ami = "1696278514562148")
*/
    /*
    public function createInvite($idutilisateur,$idami){
        $sql = $this->conn->prepare("INSERT INTO amis(idcompte, idcompte_ami) 
        VALUES(:idcompte, :idcompte_ami )");

        $sql->bindValue(':idcompte', $idutilisateur, PDO::PARAM_INT);
        $sql->bindValue(':idcompte_ami', $idami, PDO::PARAM_INT);
        $sql->execute();
    }

    public function createConfirm($idutilisateur,$idami){
        $sql = $this->conn->prepare("INSERT INTO amis(idcompte, idcompte_ami) 
        VALUES(:idcompte, :idcompte_ami )");

        $sql->bindValue(':idcompte', $idutilisateur, PDO::PARAM_INT);
        $sql->bindValue(':idcompte_ami', $idami, PDO::PARAM_INT);
        $sql->execute();
    }
    */

    /* Efface la liste des amis de $id
    public function delete($id){     
        $this->conn->exec("DELETE FROM amis WHERE idcompte = $id");    
    }
    
    // Efface l'ami $id2 de la liste d'ami de $id1
    public function delete2($id1, $id2){     
        $this->conn->exec("DELETE FROM amis WHERE idcompte = $id1 && idcompte_ami = $id2");    
    }
    */

    

    
}