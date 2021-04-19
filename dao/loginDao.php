<?php

include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/utilisateur.php';

class loginDao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function loginUser($utilisateur, $entrepriseId) {
        $sql = $this->conn->prepare("SELECT * FROM utilisateur WHERE nomutilisateur = :nomutilisateur and motdepasse = :motdepasse and statut = " .true);

        $sql->bindValue('nomutilisateur', $utilisateur->getNomUtilisateur());
        $sql->bindValue('motdepasse', $utilisateur->getMotDePasse());

        $sql->execute();

        $count = $sql->rowCount();

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        if($count == 1 && !empty($row)) {
            session_start();

            $_SESSION['idutilisateur']   = $row['idutilisateur'];
            $_SESSION['identreprise'] = $row['identreprise'];
            $_SESSION['nomutilisateur'] = $row['nomutilisateur'];
            $_SESSION['mail'] = $row['mail'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['message'] = "";

            $sqlCompany = $this->conn->prepare("SELECT logo, designation FROM entreprise WHERE identreprise= :identreprise");

            $sqlCompany->bindValue('identreprise', $row['identreprise']);
    
            $sqlCompany->execute();

            $rowCompany = $sqlCompany->fetch(PDO::FETCH_ASSOC);

            $_SESSION['logo'] = $rowCompany['logo'];
            $_SESSION['designation'] = $rowCompany['designation'];

            $sqlBoss = $this->conn->prepare("SELECT c.nom, c.prenom FROM compte AS c JOIN utilisateur as u ON u.idutilisateur = c.idcompte WHERE u.identreprise= :identreprise AND c.poste = 'Superviseur'");

            $sqlBoss->bindValue('identreprise', $row['identreprise']);
    
            $sqlBoss->execute();

            $rowBoss = $sqlBoss->fetch(PDO::FETCH_ASSOC);

            $_SESSION['bossNom'] = $rowBoss['nom'];
            $_SESSION['bossPrenom'] = $rowBoss['prenom'];

            header('Location: '.pathUrl().'monReseau/'.$row['identreprise']);
        } else {
            session_start();
            $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe ou nom d'utilisateur est incorrect !</div>";
            header('Location: '.pathUrl().'monReseau/'.$entrepriseId.'/login');
        }
    }

    public function loginAdmin($utilisateur) {
        $sql = $this->conn->prepare("SELECT * FROM utilisateur WHERE nomutilisateur = :nomutilisateur AND motdepasse = :motdepasse AND statut = true AND role = 'superAdmin'");

        $sql->bindValue('nomutilisateur', $utilisateur->getNomUtilisateur());
        $sql->bindValue('motdepasse', $utilisateur->getMotDePasse());

        $sql->execute();

        $count = $sql->rowCount();

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        if($count == 1 && !empty($row)) {
            session_start();

            $_SESSION['idutilisateur']   = $row['idutilisateur'];
            $_SESSION['identreprise'] = $row['identreprise'];
            $_SESSION['nomutilisateur'] = $row['nomutilisateur'];
            $_SESSION['mail'] = $row['mail'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['message'] = "";

            header('Location: '.pathUrl().'superAdmin');
        } else {
            session_start();
            $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe ou nom d'utilisateur est incorrect !</div>";
            header('Location: '.pathUrl().'superAdmin/login');
        }
    }
}