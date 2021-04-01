<?php 

class publication {




/**
 * Attributes
 */ 
private string $idpublication;
private string $description;
private string $image;
private int $like;
private string $statut;
private string $idcompte; 




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
 * Get the value of image
 */ 
public function getImage()
{
return $this->image;
}

/**
 * Set the value of image
 *
 * @return  self
 */ 
public function setImage($image)
{
$this->image = $image;

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
public function __construct($idpublication,$description,$statut,$idcompte)
{
    $this->setIdpublication($idpublication);
    $this->setDescription($description);
    $this->setlike(0);
    $this->setStatut($statut);
    $this->setIdcompte($idcompte);
}

}