<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/utilisateur.php';

class utilisateurDao implements interfaceDao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function get($id) {
        $sql = "SELECT * FROM `urilisateur` WHERE `idutilisateur` = $id";

        $pdoStatement = $this->conn->query($sql);

        $utilisateur = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $utilisateur;
    }

    public function getAll() {
        $sql = "SELECT * FROM utilisateur";

        $pdoStatement = $this->conn->query($sql);

        $utilisateur = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $utilisateur;
    }

    public function update() {
        $sql = $this->conn->prepare("UPDATE utilisateur SET nomutilisateur = :nomutilisateur, motdepasse = :motdepasse, mail = :mail, role = :role, statut = :statut, identreprise = :identreprise WHERE idutilisateur = :idutilisateur");

        $utilisateur = new utilisateur();

        $utilisateur->setIdUtilisateur($_POST['idutilisateur']);
        $utilisateur->setNomUtilisateur($_POST['nomutilisateur']);
        $utilisateur->setMotDePasse($_POST['motdepasse']);
        $utilisateur->setMail($_POST['mail']);
        $utilisateur->setRole($_POST['role']);
        $utilisateur->setStatut($_POST['statut']);
        $utilisateur->setIdEntreprise($_POST['identreprise']);

        $sql->bindValue(':idutilisateur', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
        $sql->bindValue(':nomutilisateur', $utilisateur->getNomUtilisateur());
        $sql->bindValue(':motdepasse', $utilisateur->getMotDePasse());
        $sql->bindValue(':mail', $utilisateur->getMail());
        $sql->bindValue(':role', $utilisateur->getRole());
        $sql->bindValue(':statut', $utilisateur->getStatut(), PDO::PARAM_INT);
        $sql->bindValue(':identreprise', $utilisateur->getIdEntreprise(), PDO::PARAM_INT);
    
        $sql->execute();
    }

    public function create() {
        $sql = $this->conn->prepare("INSERT INTO utilisateur(idutilisateur, nomutilisateur, motdepasse, mail, role, statut, identreprise) VALUES(:idutilisateur, :nomutilisateur, :motdepasse, :mail, :role, :statut, :identreprise)");

        $utilisateur = new utilisateur();

        $utilisateur->setIdutilisateur($_POST['idutilisateur']);
        $utilisateur->setNomUtilisateur($_POST['nomutilisateur']);
        $utilisateur->setMotDePasse($_POST['motdepasse']);
        $utilisateur->setMail($_POST['mail']);
        $utilisateur->setRole($_POST['role']);
        $utilisateur->setStatut($_POST['statut']);
        $utilisateur->setIdEntreprise($_POST['identreprise']);

        $sql->bindValue(':idutilisateur', $utilisateur->getIdUtilisateur(), PDO::PARAM_INT);
        $sql->bindValue(':nomutilisateur', $utilisateur->getNomUtilisateur());
        $sql->bindValue(':motdepasse', $utilisateur->getMotDePasse());
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