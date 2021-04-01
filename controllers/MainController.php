<?php

include_once __DIR__.'/../dao/entrepriseDao.php';
include_once __DIR__.'/../utils/DBData.php';

class MainController extends CoreController
{
    public function login()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);
        $entrepriseList = $entrepriseDao->getAll();
        $this->show('login', [
            'title' => 'Social Connect - Connexion',
            'entrepriseList' => $entrepriseList
        ]);
    }

    public function register()
    {
        $this->show('register', [
            'title' => 'Social Connect - Inscription'
        ]);
    }
}