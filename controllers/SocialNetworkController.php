<?php

include_once __DIR__.'/../dao/publicationDao.php';
include_once __DIR__.'/../utils/DBData.php';

class SocialNetworkController extends CoreController
{
    public function home()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();
        //à remplacer par la variable idutilisateur de la session courante
        $idUtilisateur = 1696278514562148;
        $publicationDao = new publicationDao($db,$idUtilisateur);
        $publicationList = $publicationDao->getAll();
        $this->show('socialHome', [
            'title' => 'Social Connect - Home',
            'publicationList' => $publicationList
        ]);
    }

    
}