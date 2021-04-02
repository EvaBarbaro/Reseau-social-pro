<?php

include_once __DIR__.'/../dao/publicationDao.php';
include_once __DIR__.'/../utils/DBData.php';

class SocialNetworkController extends CoreController
{
    public function home()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $publicationDao = new publicationDao($db);
        $publicationList = $publicationDao->getAll();
        $this->show('socialHome', [
            'title' => 'Social Connect - Home',
            'publicationList' => $publicationList
        ]);
    }

    
}