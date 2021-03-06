<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__.'/../dao/imageDao.php';
include_once __DIR__.'/../dao/amisDao.php';
include_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class ImageController extends CoreController
{
    public function getAll($parameters)
    {
        $imageId = $parameters['id'];
       
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $imageDao = new imageDao($db);
        $imageList = $imageDao->getAll($imageId);

        $compteDao = new compteDao($db);
        $compte = $compteDao->get($imageId);

        $amisDao = new amisDao($db);
        $amisList = $amisDao->get($_SESSION['idutilisateur']);

        $this->show('image', [
            'title' => 'Social Connect - Album',
            'imageList' => $imageList,
            'compte' => $compte,
            'amis' => $amisList
        ]);
    }

    public function get($parameters)
    {
        $imageId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $imageDao = new imageDao($db);
        $image = $imageDao->get($imageId);

        $this->show('singleImageM', [
            'title' => 'Social Connect - Back Office',
            'image' => $image
        ]);
    }

    public function getD($parameters)
    {
        $imageId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $imageDao = new imageDao($db);
        $image = $imageDao->get($imageId);

        $this->show('singleImageD', [
            'title' => 'Social Connect - Back Office',
            'image' => $image
        ]);
    }
    
    public function create()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $imageDao = new imageDao($db);
        $image = new image();

        $image->setIdimage($_POST['idimage']);
        $image->setTitre($_POST['titre']);

        if (isset($_FILES["imageurl"])) {

            // (uniqid() --> g??n??re un identifiant unique, bas?? sur la date et heure)
            $uniqueFileName = uniqid();

            $extension = end(explode(".", $_FILES["imageurl"]["name"]));
            $tempname = $_FILES["imageurl"]["tmp_name"];    
            $folder = __DIR__ . '/../public/albumImages/'.$uniqueFileName.'.'.$extension;
          
            if (move_uploaded_file($tempname, $folder))  {
                $image->setImageUrl($uniqueFileName.'.'.$extension);
            }
        }

        $image->setIdcompte($_POST['idcompte']);
        

        $imageDao->create($image);

        header('Location: '.pathUrl()."monCompte/".$_POST['idcompte']."/mesImages");
    }

    public function update()
    {
        $userId = $_POST['idcompte'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $imageDao = new imageDao($db);
        $image = new image();

        $image->setIdimage($_POST['idimage']);
        $image->setTitre($_POST['titre']);
        $image->setImageUrl($_POST['imageurl']);
        $image->setIdcompte($_POST['idcompte']);
       
        $imageDao->update($image);

        //header('Location: '.pathUrl().'monImage/'.$imageId);
        header('Location: '.pathUrl().'monCompte/'.$userId.'/mesImages');
    }

    public function delete()
    {
        $imageId = $_POST['idimage'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $imageDao = new imageDao($db);
        $imageDao->delete($imageId);

        header('Location: '.pathUrl()."monCompte/".$_POST['idcompte']."/mesImages");
    }
 
    public function preCreate()
    {
        $this->show('imageEnCreation', [
            'title' => 'Social Connect - Inscription'
        ]);
    }
}