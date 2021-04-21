<?php 

class demandeamis {
    private $idcompte_demandeur;
    private $idcompte_solliciter;

    public function getIdcompte_demandeur(){return $this->idcompte_demandeur;}
    // @return  self
    public function setIdcompte_demandeur($idcompte_demandeur){
        $this->idcompte_demandeur = $idcompte_demandeur;
        return $this;
    }

    public function getIdcompte_solliciter(){return $this->idcompte_solliciter;}
    // @return  self
    public function setIdcompte_solliciter($idcompte_solliciter){
        $this->idcompte_solliciter = $idcompte_solliciter;
        return $this;
    }
}