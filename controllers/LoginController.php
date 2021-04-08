<?php

require_once __DIR__.'/../dao/utilisateurDao.php';
require_once __DIR__.'/../dao/loginDao.php';
require_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class LoginController extends CoreController
{
    public function login($parameters)
    {
        $entrepriseId = $parameters['id'];

        $this->show('login', [
            'title' => 'Social Connect - Connexion',
            'entrepriseId' => $entrepriseId
        ]);
    }

    public function logged($parameters)
    {
        $entrepriseId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $loginDao = new loginDao($db);

        $utilisateur = new utilisateur();

        $utilisateur->setNomUtilisateur($_POST['nomutilisateur']);
        $utilisateur->setMotDePasse(hash('sha256' ,$_POST['motdepasse']));
        $utilisateur->setIdEntreprise($entrepriseId);


        $loginDao->loginUser($utilisateur);
    }
}