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

            $sqlLogo = $this->conn->prepare("SELECT logo FROM entreprise WHERE identreprise= :identreprise");

            $sqlLogo->bindValue('identreprise', $row['identreprise']);
    
            $sqlLogo->execute();

            $rowLogo = $sqlLogo->fetch(PDO::FETCH_ASSOC);

            $_SESSION['logo'] = $rowLogo['logo'];

            header('Location: '.pathUrl().'monReseau/'.$row['identreprise'].'/reseau/publications');
        } else {
            session_start();
            $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe ou nom d'utilisateur est incorrect !</div>";
            header('Location: '.pathUrl().'monReseau/'.$entrepriseId.'/login');
        }
    }
}