<?php

include_once __DIR__.'/../dao/ImageDao.php';
include_once __DIR__.'/../utils/DBData.php';

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
 

    public function register()
    {
        $this->show('register', [
            'title' => 'Social Connect - Inscription'
        ]);
    }

    
}