<?php

include_once __DIR__.'/../dao/ImageDao.php';
include_once __DIR__.'/../utils/DBData.php';
require_once __DIR__ . '/../pathUrl.php';

class ImageController extends CoreController
{
    public function getAll()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $imageDao = new imageDao($db);
        $imageList = $imageDao->getAll();
        $this->show('image', [
            'title' => 'Social Connect - Back Office',
            'imageList' => $imageList
        ]);
    }

    public function get($parameters)
    {
        $imageId = $parameters['id'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $imageDao = new imageDao($db);
        $image = $imageDao->get($imageId);

        $this->show('singleImage', [
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
  
            $uniqueFileName = uniqid();
            $extension = end(explode(".", $_FILES["imageurl"]["name"]));
            $tempname = $_FILES["imageurl"]["tmp_name"];    
            $folder = 'albumImages/'.$uniqueFileName.'.'.$extension;
          
            if (move_uploaded_file($tempname, $folder))  {
                $image->setImageUrl($uniqueFileName.'.'.$extension);
            }
        }

        $image->setIdcompte($_POST['idcompte']);
        

        $imageDao->create($image);

        header('Location: '.pathUrl());
    }

    public function update()
    {
        $imageId = $_POST['idimage'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $imageDao = new imageDao($db);
        $image = new image();

        $image->setIdimage($_POST['idimage']);
        $image->setTitre($_POST['titre']);

        if (isset($_FILES["imageurl"])) {
  
            $uniqueFileName = uniqid();
            $extension = end(explode(".", $_FILES["imageurl"]["name"]));
            $tempname = $_FILES["imageurl"]["tmp_name"];    
            $folder = 'albumImages/'.$uniqueFileName.'.'.$extension;
          
            if (move_uploaded_file($tempname, $folder))  {
                $image->setImageUrl($uniqueFileName.'.'.$extension);
            }
        }
        
        $image->setIdcompte($_POST['idcompte']);
       
        $imageDao->update($image);

        header('Location: '.pathUrl().'monImage/'.$imageId);
    }

    

    public function delete()
    {
        $imageId = $_POST['idimage'];

        $DBData = new DBData();
        $db = $DBData->getConnection();

        $imageDao = new imageDao($db);
        $imageDao->delete($imageId);

        header('Location: '.pathUrl().'mesImages');
    }
 

    public function register()
    {
        $this->show('register', [
            'title' => 'Social Connect - Inscription'
        ]);
    }

    
}