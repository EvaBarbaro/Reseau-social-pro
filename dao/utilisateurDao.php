<?php 

include_once __DIR__.'/../interface/interfaceUtilisateurDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/utilisateur.php';

class utilisateurDao implements interfaceUtilisateurDao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function get($id) {
        $sql = "SELECT * FROM `utilisateur` WHERE `idutilisateur` = $id";

        $pdoStatement = $this->conn->query($sql);

        $utilisateur = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $utilisateur;
    }

    public function getAll($id) {
        $sql = "SELECT * FROM utilisateur WHERE `identreprise` = $id";

        $pdoStatement = $this->conn->query($sql);

        $utilisateur = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $utilisateur;
    }

    public function getUsername($utilisateur) {
        $sql = $this->conn->prepare("SELECT idutilisateur FROM `utilisateur` WHERE `nomutilisateur` = :nomutilisateur");

        $sql->bindValue(':nomutilisateur', $utilisateur->getNomUtilisateur());

        $sql->execute();

        $count = $sql->rowCount();

        return $count;
    }

    public function getMail($utilisateur) {
        $sql = $this->conn->prepare("SELECT idutilisateur FROM `utilisateur` WHERE `mail` = :mail");

        $sql->bindValue(':mail', $utilisateur->getMail());

        $sql->execute();

        $count = $sql->rowCount();

        return $count;
    }

    public function update($utilisateur) {
        $sql = $this->conn->prepare("UPDATE utilisateur SET nomutilisateur = :nomutilisateur, mail = :mail, identreprise = :identreprise WHERE idutilisateur = :idutilisateur");

        $sql->bindValue(':idutilisateur', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
        $sql->bindValue(':nomutilisateur', $utilisateur->getNomUtilisateur());
        $sql->bindValue(':mail', $utilisateur->getMail());
        $sql->bindValue(':identreprise', $utilisateur->getIdEntreprise(), PDO::PARAM_INT);
    
        $sql->execute();
    }

    public function updatePassword($utilisateur) {
        $sql = $this->conn->prepare("UPDATE utilisateur SET motdepasse = :motdepasse, identreprise = :identreprise WHERE idutilisateur = :idutilisateur");

        $sql->bindValue(':idutilisateur', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
        $sql->bindValue(':motdepasse', $utilisateur->getMotDePasse());
        $sql->bindValue(':identreprise', $utilisateur->getIdEntreprise(), PDO::PARAM_INT);
    
        $sql->execute();
    }

    public function updateAdmin($utilisateur) {
        $sql = $this->conn->prepare("UPDATE utilisateur SET role = :role, statut = :statut, identreprise = :identreprise WHERE idutilisateur = :idutilisateur");

        $sql->bindValue(':idutilisateur', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
        $sql->bindValue(':role', $utilisateur->getRole());
        $sql->bindValue(':statut', $utilisateur->getStatut(), PDO::PARAM_INT);
        $sql->bindValue(':identreprise', $utilisateur->getIdEntreprise(), PDO::PARAM_INT);
    
        $sql->execute();
    }

    public function create($utilisateur) {
        $sql = $this->conn->prepare("INSERT INTO utilisateur(idutilisateur, nomutilisateur, motdepasse, mail, role, statut, identreprise) VALUES(:idutilisateur, :nomutilisateur, :motdepasse, :mail, :role, :statut, :identreprise)");

        $sql->bindValue(':idutilisateur', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
        $sql->bindValue(':nomutilisateur', $utilisateur->getNomUtilisateur());
        $sql->bindValue(':motdepasse', hash('sha256', $utilisateur->getMotDePasse()));
        $sql->bindValue(':mail', $utilisateur->getMail());
        $sql->bindValue(':role', $utilisateur->getRole());
        $sql->bindValue(':statut', $utilisateur->getStatut(), PDO::PARAM_INT);
        $sql->bindValue(':identreprise', $utilisateur->getIdEntreprise(), PDO::PARAM_INT);

        $sql->execute();
    }

    public function delete($id) {
        $this->conn->exec("DELETE FROM utilisateur WHERE idutilisateur = $id");
    }
}