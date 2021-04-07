<?php

include_once __DIR__.'/../dao/publicationDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../dao/commentaireDao.php';
include_once __DIR__.'/../models/commentaire.php';

class SocialNetworkController extends CoreController
{
    public function home()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();
        //à remplacer par la variable idutilisateur de la session courante
        $idUtilisateur = 1696278514562148;
        $publicationDao = new publicationDao($db,$idUtilisateur);
        $commentaireDao = new commentaireDao($db,$idUtilisateur);
        $com = new commentaire (1696389711374957,"testttt",1696278514561638,5,$idUtilisateur);
       
        
        if($commentaireDao->delete(1696389711374957)==1){
            echo "true";
        }
      // echo "res = ".$commentaireDao->create($com);
        $publicationList = $publicationDao->getAll();
        $this->show('socialHome', [
            'title' => 'Social Connect - Home',
            'publicationList' => $publicationList
        ]);
    }

    
}