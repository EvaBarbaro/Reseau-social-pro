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
        $this->show('entreprises', [
            'title' => 'Social Connect - Back Office',
            'entrepriseList' => $entrepriseList
        ]);
    }

    // public function get($parameters)
    // {
    //     $entrepriseId = $parameters['id'];

    //     $DBData = new DBData();
    //     $db = $DBData->getConnection();

    //     $entrepriseDao = new entrepriseDao($db);
    //     $entreprise = $entrepriseDao->get($entrepriseId);

    //     $this->show('singleEntreprise', [
    //         'title' => 'Social Connect - Mon Réseau',
    //         'entreprise' => $entreprise
    //     ]);
    // }

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
        $utilisateurDao = new utilisateurDao($db);
        $compteDao = new compteDao($db);

        $entreprise = new entreprise();

        $entreprise->setIdEntreprise($_POST['identreprise']);
        $entreprise->setDesignation($_POST['designation']);

        if (isset($_FILES["logo"])) {
  
            $uniqueFileName = uniqid();
            $extension = end(explode(".", $_FILES["logo"]["name"]));
            $tempname = $_FILES["logo"]["tmp_name"];    
            $folder =  __DIR__ . '/../public/logoImages/'.$uniqueFileName.'.'.$extension;
          
            if (move_uploaded_file($tempname, $folder))  {
                $entreprise->setLogo($uniqueFileName.'.'.$extension);
            }
        }

        $entreprise->setDescription($_POST['description']);
        $entreprise->setUrl($_POST['url']);
        $entreprise->setStatut($_POST['statut']);

        $entrepriseDao->create($entreprise);

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

        header('Location: '.pathUrl().'monReseau/'.$_POST['identreprise'].'/login');
    }

    public function update()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $entrepriseDao = new entrepriseDao($db);

        $entreprise = new entreprise();

        $entreprise->setIdEntreprise($_POST['identreprise']);
        $entreprise->setDesignation($_POST['designation']);

        if (isset($_FILES["logo"])) {
  
            $uniqueFileName = uniqid();
            $extension = end(explode(".", $_FILES["logo"]["name"]));
            $tempname = $_FILES["logo"]["tmp_name"];    
            $folder = __DIR__ . '/../public/logoImages/'.$uniqueFileName.'.'.$extension;
          
            if (move_uploaded_file($tempname, $folder))  {
                $entreprise->setLogo($uniqueFileName.'.'.$extension);
            }
        } else {
            $entreprise->setLogo($_POST['logo']);
        }

        $entreprise->setDescription($_POST['description']);
        $entreprise->setUrl($_POST['url']);

        if ($_POST['statut'] == NULL) {
            $entreprise->setStatut(0);
        } else {
            $entreprise->setStatut($_POST['statut']);
        }

        $entrepriseDao->update($entreprise);

        header('Location: '.pathUrl().'superAdmin');
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