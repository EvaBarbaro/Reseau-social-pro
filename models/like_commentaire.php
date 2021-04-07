<?php 

class like_commentaire {




/**
 * Attributes
 */ 
private $idcompte;
private $idcommentaire;
 

/**
 * Get the value of idcompte
 */ 
public function getIdcompte()
{
return $this->idcompte;
}

/**
 * Set the value of idcompte
 *
 * @return  self
 */ 
public function setIdcompte($idcompte)
{
$this->idcompte = $idcompte;

return $this;
}

/**
 * Get the value of idcommentaire
 */ 
public function getIdcommentaire()
{
return $this->idcommentaire;
}

/**
 * Set the value of idcommentaire
 *
 * @return  self
 */ 
public function setIdcommentaire($idcommentaire)
{
$this->idcommentaire = $idcommentaire;

return $this;
}




/**
 * Construct
 */ 
public function __construct($idcompte,$idcommentaire)
{
    $this->setIdcompte($idcompte);
    $this->setIdcommentaire($idcommentaire);
}

}