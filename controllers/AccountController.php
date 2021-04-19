<?php

require_once __DIR__.'/../dao/compteDao.php';
require_once __DIR__.'/../dao/entrepriseDao.php';
require_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class AccountController extends CoreController
{
    public function getAll()
    {
        session_start();

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $compteDao = new compteDao($db);
        $compteList = $compteDao->getAll($_SESSION['identreprise']);

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
 
        echo "je suis ici";
        echo $_SESSION["identreprise"];

        $entrepriseDao = new entrepriseDao($db);
        $entreprise = $entrepriseDao->get($_SESSION["identreprise"]);

        $compteDao = new compteDao($db);
        $compte = $compteDao->get($compteId);

        $this->show('singleCompte', [
            'title' => 'Social Connect - Mes informations',
            'compte' => $compte,
            'entreprise' => $entreprise
        ]);
    }

    public function update()
    {
        $compteId = $_POST['idcompte'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $compteDao = new compteDao($db);

        $comptePhoto = $_POST['photo'];

        if (isset($_FILES["photo"]) && !empty($_FILES["photo"])) {
  
            $uniqueFileName = uniqid();
            $extension = end(explode(".", $_FILES["photo"]["name"]));
            $tempname = $_FILES["photo"]["tmp_name"];    
            $folder = __DIR__ . '/../public/profilImages/'.$uniqueFileName.'.'.$extension;
          
            if (move_uploaded_file($tempname, $folder))  {
                $comptePhoto = $uniqueFileName.'.'.$extension;
            }
        }

        $compte = new compte
        (
            $_POST['idcompte'],
            $_POST['nom'],
            $_POST['prenom'],
            $comptePhoto,
            $_POST['poste'],
            $_POST['grade'],
            $_POST['departement'],
            $_POST['date_embauche']
        );

        $compteDao->update($compte);

        header('Location: '.pathUrl().'monCompte/'.$compteId.'/mesInformations');
    }
}