<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/compte.php';

class compteDao implements interfaceDao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }
    public function get($id){
       // $id= (int)$id;
        $sql = "SELECT idcompte , nomutilisateur , mail , role , statut,
         	identreprise , nom , prenom , photo , poste
            grade , departement , date_embauche   
            FROM compte JOIN utilisateur
            ON compte.idcompte = utilisateur.idutilisateur
            WHERE compte.idcompte=:id";
        //$pdoStatement = $this->conn->query($sql);

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();
        $compte = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        return $compte;
    }
    public function getAll(){}
    public function update($obj){}
    public function create($obj){}
    public function delete($id){}
}