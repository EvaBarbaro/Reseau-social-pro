<?php

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/compte.php';

class compteDao implements interfaceDao {
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

    public function getAll() {
        $sql = "SELECT * FROM compte";

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

        $sql->bindValue(':idCompte', $compte->getIdCompte(), PDO::PARAM_INT);
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