<?php 

class publication {




/**
 * Attributes
 */ 
private $idpublication;
private $description;
private $imageurl;
private $like;
private $statut;
private $idcompte; 




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
 * Get the value of imageurl
 */ 
public function getImageurl()
{
return $this->imageurl;
}

/**
 * Set the value of imageurl
 *
 * @return  self
 */ 
public function setImageurl($imageurl)
{
$this->imageurl = $imageurl;

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
 * Get the value of statut
 */ 
public function getStatut()
{
return $this->statut;
}

/**
 * Set the value of statut
 *
 * @return  self
 */ 
public function setStatut($statut)
{
$this->statut = $statut;

return $this;
}

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
 * Construct
 */ 
public function construct($idpublication,$description,$statut,$idcompte)
{
    $this->setIdpublication($idpublication);
    $this->setDescription($description);
    $this->setlike(0);
    $this->setStatut($statut);
    $this->setIdcompte($idcompte);
}

}