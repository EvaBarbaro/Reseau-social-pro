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
        $sql = "SELECT compte.idutilisateur , nomutilisateur , mail , role , statut,
         	identreprise , idcompte , nom , prenom , photo , poste
            grade , departement , date_embauche   
            FROM compte JOIN utilisateur
            ON compte.idutilisateur = utilisateur.idutilisateur
            WHERE compte.idutilisateur=$id";
        $pdoStatement = $this->conn->query($sql);

        /*$pdoStatement = $this->conn->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();*/
        $compte = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        return $compte;
    }
    public function getAll(){}
    public function update($obj){}
    public function create($obj){}
    public function delete($id){}
}