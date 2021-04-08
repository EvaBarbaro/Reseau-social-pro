<?php

include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/utilisateur.php';

class loginDao {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function loginUser($utilisateur) {
        $sql = $this->conn->prepare("SELECT * FROM utilisateur WHERE nomutilisateur = :nomutilisateur and motdepasse = :motdepasse and identreprise = :identreprise and statut = " .true);

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

            header('Location: '.pathUrl().'monReseau/'.$row['identreprise']);
        } else {
            echo "Votre mot de passe ou votre nom d'utilisateur n'est pas valide";
        }
    }
}