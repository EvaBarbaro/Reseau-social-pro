<?php

require_once __DIR__.'/../dao/compteDao.php';
require_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class AccountController extends CoreController
{
    public function getAll()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $compteDao = new compteDao($db);
        $compteList = $compteDao->getAll();

        $this->show('comptes', [
            'title' => 'Social Connect - Réseau Back Office - Comptes',
            'compteList' => $compteList
        ]);
    }

    public function get($parameters)
    {
        $compteId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $compteDao = new compteDao($db);
        $compte = $compteDao->get($compteId);

        $this->show('singleCompte', [
            'title' => 'Social Connect - Mon Compte',
            'compte' => $compte
        ]);
    }

    public function create()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $compteDao = new compteDao($db);

        $compte = new compte();

        $compte->setIdCompte($_POST['idcompte']);
        $compte->setNom($_POST['nom']);
        $compte->setPrenom($_POST['prenom']);
        $compte->setPhoto($_POST['photo']);
        $compte->setPoste($_POST['poste']);
        $compte->setGrade($_POST['grade']);
        $compte->setDepartement($_POST['departement']);
        $compte->setDateEmbauche($_POST['date_embauche']);

        $compteDao->create($compte);

        // header('Location: '.pathUrl());
    }

    public function update()
    {
        $compteId = $_POST['idcompte'];
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $compteDao = new compteDao($db);

        $compte = new compte();

        $compte->setIdCompte($_POST['idcompte']);
        $compte->setNom($_POST['nom']);
        $compte->setPrenom($_POST['prenom']);
        $compte->setPhoto($_POST['photo']);
        $compte->setPoste($_POST['poste']);
        $compte->setGrade($_POST['grade']);
        $compte->setDepartement($_POST['departement']);
        $compte->setDateEmbauche($_POST['date_embauche']);

        $compteDao->update($compte);

        // header('Location: '.pathUrl().'monReseau/'.$compteId);
    }

    public function delete()
    {
        $compteId = $_POST['idcompte'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $comptedao = new comptedao($db);
        $comptedao->delete($compteId);

        // header('Location: '.pathUrl().'superAdmin');
    }
}