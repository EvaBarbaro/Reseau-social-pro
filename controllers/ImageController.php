<?php
session_start(); 
include_once __DIR__.'/../dao/imageDao.php';
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

        $this->show('image', [
            'title' => 'Social Connect - Back Office',
            'imageList' => $imageList,
            'compte' => $compte
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

        ?>
        <pre>
        Variable SESSION
        <?php var_dump($_SESSION); ?> 
        Variable POST
        <?php var_dump($_POST); ?> 
        Variable FILES
        <?php var_dump($_FILES); ?> 
        </pre>
        <?php
        

       

        if (isset($_FILES["imageurl"])) {

            // (uniqid() --> génére un identifiant unique, basé sur la date et heure)
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

<<<<<<< HEAD
        //header('Location: '.pathUrl()."mesImages");
=======
        header('Location: '.pathUrl()."monCompte/".$_POST['idcompte']."/mesImages");
>>>>>>> 6f0ce064cd7ceea807f0c51fc07acd161b2f5e13
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
        $image->setImageUrl($_POST['imageurl']);
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

        header('Location: '.pathUrl()."monCompte/".$_POST['idcompte']."/mesImages");
    }
 
    public function preCreate()
    {
        $this->show('imageEnCreation', [
            'title' => 'Social Connect - Inscription'
        ]);
    }
}