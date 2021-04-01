<?php 

include_once __DIR__.'/../interface/entrepriseInterface.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/entreprise.php';

class entrepriseDao implements entrepriseInterface {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function get($id) {
        $sql = "SELECT * FROM `entreprise` WHERE `identreprise` = $id";

        $pdoStatement = $this->conn->query($sql);

        $entreprise = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $entreprise;
    }

    public function getAll() {
        $sql = "SELECT * FROM entreprise";

        $pdoStatement = $this->conn->query($sql);

        $entreprise = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $entreprise;
    }

    public function update(entreprise $entreprise) {
        $sql = $this->conn->prepare("UPDATE entreprise SET identreprise = :identreprise, designation = :designation, logo = :logo, description = :description, url = :url, statut = :statut");

        $sql->bindValue(':identreprise', $entreprise->getIdEntreprise(), PDO::PARAM_INT);
        $sql->bindValue(':designation', $entreprise->getDesignation());
        $sql->bindValue(':logo', $entreprise->getLogo());
        $sql->bindValue(':description', $entreprise->getDescription());
        $sql->bindValue(':url', $entreprise->getUrl());
        $sql->bindValue(':statut', $entreprise->getStatut(), PDO::PARAM_INT);
    
        $sql->execute();
    }

    public function create(entreprise $entreprise) {
        $sql = $this->conn->prepare("INSERT INTO entreprise(identreprise, designation, logo, description, url, statut) VALUES(:identreprise, :designation, :logo, :description, :url, statut)");

        $sql->bindValue(':identreprise', $entreprise->getIdEntreprise(), PDO::PARAM_INT);
        $sql->bindValue(':designation', $entreprise->getDesignation());
        $sql->bindValue(':logo', $entreprise->getLogo());
        $sql->bindValue(':description', $entreprise->getDescription());
        $sql->bindValue(':url', $entreprise->getUrl());
        $sql->bindValue(':statut', $entreprise->getStatut(), PDO::PARAM_INT);
    
        $sql->execute();
    }

    public function delete($id) {
        $this->conn->execute("DELETE FROM personnages WHERE id = $id");
    }
}