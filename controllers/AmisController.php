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

    public function delete()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $amisDao = new amisDao($db);
        $amisDao->deleteAmis($_SESSION['idutilisateur'],$_POST['idcompteAmis']);

        header('Location: '.pathUrl().'monCompte/'.$_SESSION['idutilisateur'].'/mesAmis');

    }

    public function deleteInvite()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $demandeamisDao = new demandeamisDao($db);
        $demandeamisDao->deleteDemandeAmis($_POST['iddemandeur'],$_POST['idsolliciter']);

        header('Location: '.pathUrl().'monCompte/'.$_SESSION['idutilisateur'].'/mesAmis');

    }
    public function ConfirmInvite()
    {
        $DBData = new DBData();
        $db = $DBData->getConnection();

        $demandeamisDao = new demandeamisDao($db);
        $demandeamisDao->AccepterDemandeAmis($_POST['iddemandeur'],$_POST['idsolliciter']);

        header('Location: '.pathUrl().'monCompte/'.$_SESSION['idutilisateur'].'/mesAmis');

    }

}