<?php

include_once __DIR__.'/../dao/entrepriseDao.php';
include_once __DIR__.'/../utils/DBData.php';

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
            'title' => 'Social Connect - Back Office',
            'enrepriseId' => $entrepriseId,
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

        header('Location: http://localhost/apache/Reseau-social-pro/inscription');
    }
}