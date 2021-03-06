<?php

include_once __DIR__.'/../interface/interfaceCompteDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/compte.php';

class compteDao implements interfaceCompteDao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function get($id) {
        $sql = "SELECT * FROM `compte` WHERE `idcompte` = $id";

        $pdoStatement = $this->conn->query($sql);

        $compte = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $compte;
    }

    public function getCompteInfos($id) {
     
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
         if(!empty($cmpt)){
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
         }
         return $compte;
    }
    
    public function getAll($identreprise) {
        $sql = "SELECT u.identreprise, u.nomutilisateur, c.photo, c.idcompte FROM compte AS c JOIN utilisateur AS u ON u.idutilisateur = c.idcompte WHERE u.identreprise = $identreprise EXCEPT SELECT u.identreprise, u.nomutilisateur, c.photo, c.idcompte FROM compte AS c JOIN utilisateur AS u ON u.idutilisateur = c.idcompte WHERE idutilisateur =". $_SESSION['idutilisateur'];

        $pdoStatement = $this->conn->query($sql);

        $compte = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $compte;
    }

    public function update($compte) {
        $sql = $this->conn->prepare("UPDATE compte SET nom = :nom, prenom = :prenom, photo = :photo, poste = :poste, grade = :grade, departement = :departement, date_embauche = :date_embauche WHERE idcompte = :idcompte");

        $sql->bindValue(':idcompte', $compte->getIdCompte(), PDO::PARAM_INT);
        $sql->bindValue(':nom', $compte->getNom());
        $sql->bindValue(':prenom', $compte->getPrenom());
        $sql->bindValue(':photo', $compte->getPhoto());
        $sql->bindValue(':poste', $compte->getPoste());
        $sql->bindValue(':grade', $compte->getGrade());
        $sql->bindValue(':departement', $compte->getDepartement());
        $sql->bindValue(':date_embauche', $compte->getDateEmbauche());
    
        $sql->execute();
    }

    public function create($compte) {
        $sql = $this->conn->prepare("INSERT INTO compte(idcompte, nom, prenom, photo, poste, grade, departement, date_embauche) VALUES(:idcompte, :nom, :prenom, :photo, :poste, :grade, :departement, :date_embauche)");

        $sql->bindValue(':idcompte', $compte->getIdCompte(), PDO::PARAM_INT);
        $sql->bindValue(':nom', $compte->getNom());
        $sql->bindValue(':prenom', $compte->getPrenom());
        $sql->bindValue(':photo', $compte->getPhoto());
        $sql->bindValue(':poste', $compte->getPoste());
        $sql->bindValue(':grade', $compte->getGrade());
        $sql->bindValue(':departement', $compte->getDepartement());
        $sql->bindValue(':date_embauche', $compte->getDateEmbauche());

        $sql->execute();
    }

    public function delete($id) {
        $this->conn->exec("DELETE FROM compte WHERE idcompte = $id");
    }
}