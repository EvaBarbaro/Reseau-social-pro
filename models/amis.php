<?php 

class amis {
    private $idcompte;
    private $idcompte_ami;

    public function getIdcompte(){return $this->idcompte;}
    // @return  self
    public function setIdcompte($idcompte){
        $this->idcompte = $idcompte;
        return $this;
    }

    public function getIdcompte_ami(){return $this->idcompte_ami;}
    // @return  self
    public function setIdcompte_ami($idcompte_ami){
        $this->idcompte_ami = $idcompte_ami;
        return $this;
    }
}