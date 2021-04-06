<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/compte.php';

class compteDao implements interfaceDao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }



/**
 * Get single compte
 */ 
    public function get($id){
     
       $compte = array();
       $sql = "SELECT idcompte , nomutilisateur , mail , role , statut,
                identreprise , nom , prenom , photo , poste ,
                grade , departement , date_embauche   
                FROM compte JOIN utilisateur
                ON compte.idcompte = utilisateur.idutilisateur
                WHERE compte.idcompte=:id";
        
        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();
        $cmpt = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        $compteModel = new compte($cmpt['idcompte'],$cmpt['nom'],$cmpt['prenom'],$cmpt['photo'],$cmpt['poste'],
        $cmpt['grade'],$cmpt['departement'],$cmpt['date_embauche']);

        $compte['idcompte']=$compteModel->getIdcompte();
        $compte['nom']=$compteModel->getNom();
        $compte['prenom']=$compteModel->getPrenom();
        $compte['photo']=$compteModel->getPhoto();
        $compte['poste']=$compteModel->getPoste();
        $compte['grade']=$compteModel->getGrade();
        $compte['departement']=$compteModel->getDepartement();
        $compte['date_embauche']=$compteModel->getDateEmbauche();
        $compte['nomutilisateur']=$cmpt['nomutilisateur'];
        return $compte;
    }
    public function getAll(){}
    public function update($obj){}
    public function create($obj){}
    public function delete($id){}
}