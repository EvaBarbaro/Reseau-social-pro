<?php

include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/utilisateur.php';

class loginDao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function loginUser($utilisateur, $entrepriseId) {
        $sql = $this->conn->prepare("SELECT * FROM utilisateur u , entreprise e WHERE u.nomutilisateur = :nomutilisateur and u.motdepasse = :motdepasse and u.identreprise = :identreprise and u.statut = " .true." AND u.identreprise =t.identreprise");

        $sql->bindValue('nomutilisateur', $utilisateur->getNomUtilisateur());
        $sql->bindValue('motdepasse', $utilisateur->getMotDePasse());
        $sql->bindValue('identreprise', $utilisateur->getIdEntreprise());

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
            $_SESSION['entrepriseLogo'] = $row['logo'];
            header('Location: '.pathUrl().'monReseau/'.$row['identreprise']);
        } else {
            session_start();
            $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe ou nom d'utilisateur est incorrect !</div>";
            header('Location: '.pathUrl().'monReseau/'.$entrepriseId.'/login');
        }
    }
}