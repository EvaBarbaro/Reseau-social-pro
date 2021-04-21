<?php

include_once __DIR__.'/../dao/amisDao.php';
include_once __DIR__.'/../dao/demandeamisDao.php';
include_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class AmisController extends CoreController
{
    public function getAll()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $amisDao = new amisDao($db);
        $amisList = $amisDao->getAll();

        $compteDao = new compteDao($db);
        $compte = $compteDao->get($_SESSION['idutilisateur']);

        $demandeamisDao = new demandeamisDao($db);
        $InviteList = $demandeamisDao->getAll($_SESSION['idutilisateur']);
        $RequestList = $demandeamisDao->getAllDemandes($_SESSION['idutilisateur']);

        $this->show('amis', [
            'title' => 'Social Connect - Mes Amis',
            'inviteList' => $InviteList,
            'amisList' => $amisList,
            'compte' => $compte,
            'requestList'=> $RequestList,
        ]);
    }

    // public function get($parameters)
    // {
    //     $imageId = $parameters['id'];

    //     $DBData = new DBData();
    //     $db = $DBData->getConnection();

    //     $imageDao = new imageDao($db);
    //     $image = $imageDao->get($imageId);

    //     $this->show('singleImage', [
    //         'title' => 'Social Connect - Back Office',
    //         'image' => $image
    //     ]);
    // }

    public function createOne()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

    }

    public function createTwo()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();
    }

    // public function update()
    // {
    //     $imageId = $_POST['idimage'];

    //     $DBData = new DBData();
    //     $db = $DBData->getConnection();

    //     $imageDao = new imageDao($db);
    //     $image = new image();

    //     $image->setIdimage($_POST['idimage']);
    //     $image->setTitre($_POST['titre']);

    //     if (isset($_FILES["imageurl"])) {
  
    //         $uniqueFileName = uniqid();
    //         $extension = end(explode(".", $_FILES["imageurl"]["name"]));
    //         $tempname = $_FILES["imageurl"]["tmp_name"];    
    //         $folder = __DIR__ . '/../public/albumImages/'.$uniqueFileName.'.'.$extension;
          
    //         if (move_uploaded_file($tempname, $folder))  {
    //             $image->setImageUrl($uniqueFileName.'.'.$extension);
    //         }
    //     }
        
    //     $image->setIdcompte($_POST['idcompte']);
       
    //     $imageDao->update($image);

    //     header('Location: '.pathUrl().'monImage/'.$imageId);
    // }

    // public function delete()
    // {
    //     $imageId = $_POST['idimage'];

    //     $DBData = new DBData();
    //     $db = $DBData->getConnection();

    //     $imageDao = new imageDao($db);
    //     $imageDao->delete($imageId);

    //     header('Location: '.pathUrl().'mesImages');
    // }

}