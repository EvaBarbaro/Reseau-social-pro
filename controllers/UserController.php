<?php

require_once __DIR__.'/../dao/utilisateurDao.php';
require_once __DIR__.'/../dao/compteDao.php';
require_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class UserController extends CoreController
{
    public function getAll()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateurList = $utilisateurDao->getAll();
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

        $this->show('singleUtilisateur', [
            'title' => 'Social Connect - Mon Compte',
            'utilisateur' => $utilisateur
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
        $utilisateur->setMotDePasse($_POST['motdepasse']);
        $utilisateur->setMail($_POST['mail']);
        $utilisateur->setRole($_POST['role']);
        $utilisateur->setStatut($_POST['statut']);
        $utilisateur->setIdEntreprise($_POST['identreprise']);

        $utilisateurDao->update($utilisateur);

        header('Location: '.pathUrl().'monCompte/'.$utilisateurId);
    }

    public function delete()
    {
        $utilisateurId = $_POST['idutilisateur'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateurDao->delete($utilisateurId);

        header('Location: '.pathUrl().'monReseau/admin');
    }
}