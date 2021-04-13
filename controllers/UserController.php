<?php

require_once __DIR__.'/../dao/utilisateurDao.php';
require_once __DIR__.'/../dao/compteDao.php';
require_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class UserController extends CoreController
{
    public function getAll($parameters)
    {
        $utilisateurId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateurList = $utilisateurDao->getAll($utilisateurId);

        $this->show('utilisateurs', [
            'title' => 'Social Connect - Réseau Back Office - Utilisateurs',
            'utilisateurList' => $utilisateurList
        ]);
    }

    public function get($parameters)
    {
        $utilisateurId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateur = $utilisateurDao->get($utilisateurId);

        $compteDao = new compteDao($db);
        $compte = $compteDao->get($utilisateurId);

        $this->show('singleUtilisateur', [
            'title' => 'Social Connect - Mon Compte',
            'utilisateur' => $utilisateur,
            'compte' => $compte
        ]);
    }

    public function getPass($parameters)
    {
        $utilisateurId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateur = $utilisateurDao->get($utilisateurId);

        $compteDao = new compteDao($db);
        $compte = $compteDao->get($utilisateurId);

        $this->show('singlePassword', [
            'title' => 'Social Connect - Mon Compte',
            'utilisateur' => $utilisateur,
            'compte' => $compte
        ]);
    }

    public function register($parameters)
    {
        $entrepriseId = $parameters['id'];

        $this->show('utilisateurRegister', [
            'title' => 'Social Connect - Inscription',
            'entrepriseId' => $entrepriseId
        ]);
    }

    public function create()
    {
        $entrepriseId = $_POST['identreprise'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $compteDao = new compteDao($db);

        $utilisateur = new utilisateur();

        $utilisateur->setIdUtilisateur($_POST['idutilisateur']);
        $utilisateur->setNomUtilisateur($_POST['nomutilisateur']);
        $utilisateur->setMotDePasse($_POST['motdepasse']);
        $utilisateur->setMail($_POST['mail']);
        $utilisateur->setRole($_POST['role']);
        $utilisateur->setStatut($_POST['statut']);
        $utilisateur->setIdEntreprise($_POST['identreprise']);

        $utilisateurDao->create($utilisateur);

        $compte = new compte
        (
            $_POST['idutilisateur'],
            NULL,
            NULL,
            NULL,
            NULL,
            NULL,
            NULL,
            NULL
        );

        $compteDao->create($compte);

        header('Location: '.pathUrl().'monReseau/'.$entrepriseId.'/inscription');
    }

    public function update()
    {
        $utilisateurId = $_POST['idutilisateur'];
        
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);

        $utilisateur = new utilisateur();

        $utilisateur->setIdutilisateur($_POST['idutilisateur']);
        $utilisateur->setNomUtilisateur($_POST['nomutilisateur']);
        $utilisateur->setMail($_POST['mail']);
        $utilisateur->setRole($_POST['role']);
        $utilisateur->setStatut($_POST['statut']);
        $utilisateur->setIdEntreprise($_POST['identreprise']);

        $utilisateurDao->update($utilisateur);

        header('Location: '.pathUrl().'monCompte/'.$utilisateurId);
    }

    public function updatePass()
    {
        $utilisateurId = $_POST['idutilisateur'];
        
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);

        $singleUtilisateur = $utilisateurDao->get($utilisateurId);

        $utilisateur = new utilisateur();

        $utilisateur->setIdutilisateur($_POST['idutilisateur']);

        if (empty($_POST['oldmotdepasse']) || empty($_POST['newmotdepasse'])) {
            session_start();
            $utilisateur->setMotDePasse($singleUtilisateur['motdepasse']);
            $_SESSION['message'] = "<div class='alert alert-danger'>Veuillez remplir tous les champs !</div>"; 
        } else if (hash('sha256', $_POST['oldmotdepasse']) !== $singleUtilisateur['motdepasse']) {
            session_start();
            $utilisateur->setMotDePasse($singleUtilisateur['motdepasse']);
            $_SESSION['message'] = "<div class='alert alert-danger'>Votre mot de passe ne correspond pas à l'ancien !</div>"; 
        } else {
            session_start();
            $utilisateur->setMotDePasse(hash('sha256',$_POST['newmotdepasse']));
            $_SESSION['message'] = "<div class='alert alert-success'>Votre mot de passe a bien été modifié !</div>"; 
        }
        
        $utilisateur->setIdEntreprise($_POST['identreprise']);

        $utilisateurDao->updatePassword($utilisateur);

        header('Location: '.pathUrl().'monCompte/'.$utilisateurId.'/monMotDePasse');
    }

    public function updateAdmin()
    {
        $entrepriseId = $_POST['identreprise'];
        
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);

        $utilisateur = new utilisateur();

        $utilisateur->setIdutilisateur($_POST['idutilisateur']);
        $utilisateur->setRole($_POST['role']);
        
        if ($_POST['statut'] == NULL) {
            $utilisateur->setStatut(0);
        } else {
            $utilisateur->setStatut($_POST['statut']);
        }
        
        $utilisateur->setIdEntreprise($_POST['identreprise']);

        $utilisateurDao->updateAdmin($utilisateur);

        header('Location: '.pathUrl().'monReseau/'.$entrepriseId.'/admin');
    }

    public function delete()
    {
        $utilisateurId = $_POST['idutilisateur'];
        $entrepriseId = $_POST['identreprise'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateurDao->delete($utilisateurId);

        header('Location: '.pathUrl().'monReseau/'.$entrepriseId.'/admin');
    }
}