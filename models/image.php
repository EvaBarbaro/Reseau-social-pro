<?php 

class image 
{
private $idimage;
private $titre;
private $image;
private $idcompte;



/**
 * Get the value of idimage
 */ 
public function getIdimage()
{
return $this->idimage;
}

/**
 * Set the value of idimage
 *
 * @return  self
 */ 
public function setIdimage($idimage)
{
$this->idimage = $idimage;

return $this;
}

/**
 * Get the value of titre
 */ 
public function getTitre()
{
return $this->titre;
}

/**
 * Set the value of titre
 *
 * @return  self
 */ 
public function setTitre($titre)
{
$this->titre = $titre;

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
}