<?php 

class commentaire {




/**
 * Attributes
 */ 
private $idcommentaire;
private $description;
private $like;
private $idcompte;
private $idpublication;



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
 * Get the value of description
 */ 
public function getDescription()
{
return $this->description;
}

/**
 * Set the value of description
 *
 * @return  self
 */ 
public function setDescription($description)
{
$this->description = $description;

return $this;
}

/**
 * Get the value of like
 */ 
public function getLike()
{
return $this->like;
}

/**
 * Set the value of like
 *
 * @return  self
 */ 
public function setLike($like)
{
$this->like = $like;

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
 * Get the value of idcompte
 *
 * @return int
 */
public function getIdcompte() : int 
{
return $this->idcompte;
}

/**
 * Set the value of idcompte
 *
 * @param int $idcompte
 *
 * @return self
 */
public function setIdcompte(int $idcompte) : self
{
$this->idcompte = $idcompte;

return $this;
}


/**
 * Construct
 */ 
public function construct($idcommentaire,$description,$idpublication,$like,$idcompte)
{
    $this->setIdcommentaire($idcommentaire);
    $this->setDescription($description);
    $this->setlike($like);
    $this->setIdpublication($idpublication);
    $this->setIdcompte($idcompte);
}



}