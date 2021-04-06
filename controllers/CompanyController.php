<?php

require_once __DIR__.'/../dao/entrepriseDao.php';
require_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class CompanyController extends CoreController
{
    public function getAll()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);
        $entrepriseList = $entrepriseDao->getAll();
        $this->show('entreprise', [
            'title' => 'Social Connect - Back Office',
            'entrepriseList' => $entrepriseList
        ]);
    }

    public function get($parameters)
    {
        $entrepriseId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);
        $entreprise = $entrepriseDao->get($entrepriseId);

        $this->show('singleEntreprise', [
            'title' => 'Social Connect - Mon Réseau',
            'entreprise' => $entreprise
        ]);
    }

    public function register()
    {
        $this->show('register', [
            'title' => 'Social Connect - Inscription'
        ]);
    }

    public function create()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);

        $entrepriseDao->create();

        header('Location: '.pathUrl());
    }

    public function update()
    {
        $entrepriseId = $_POST['identreprise'];
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);

        $entrepriseDao->update();

        header('Location: '.pathUrl().'monReseau/'.$entrepriseId);
    }

    public function delete()
    {
        $entrepriseId = $_POST['identreprise'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);
        $entrepriseDao->delete($entrepriseId);

        header('Location: '.pathUrl().'superAdmin');
    }
}