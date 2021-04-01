<?php 

class like_publication {




/**
 * Attributes
 */ 
private string $idcompte;
private string $idpublication;
 

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
 * Get the value of idpublication
 */ 
public function getIdpublication()
{
return $this->idpublication;
}

/**
 * Set the value of idpublication
 *
 * @return  self
 */ 
public function setIdpublication($idpublication)
{
$this->idpublication = $idpublication;

return $this;
}




/**
 * Construct
 */ 
public function __construct($idcompte,$idpublication)
{
    $this->setIdcompte($idcompte);
    $this->setIdpublication($idpublication);
}

}