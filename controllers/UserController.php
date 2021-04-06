<?php

include_once __DIR__.'/../dao/utilisateurDao.php';
include_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class UserController extends CoreController
{
    public function getAll()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);
        $utilisateurList = $utilisateurDao->getAll();
        $this->show('utilisateur', [
            'title' => 'Social Connect - Réseau Back Office',
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

        $utilisateurDao->create();

        header('Location: '.pathUrl().'monReseau/'.$entrepriseId.'/inscription');
    }

    public function update()
    {
        $utilisateurId = $_POST['idutilisateur'];
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $utilisateurDao = new utilisateurDao($db);

        $utilisateurDao->update();

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