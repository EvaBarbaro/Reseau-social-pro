<?php 
class image 
{
private $idimage;
private $titre;
private $image;
private $idcompte;

public function getIdimage(){return $this->idimage;}
// @return  self 
public function setIdimage($idimage){
$this->idimage = $idimage;
return $this;
}
public function getTitre(){return $this->titre;}
// @return  self
public function setTitre($titre){
$this->titre = $titre;
return $this;
}
public function getImageUrl(){return $this->image;}
// @return  self
public function setImageUrl($image){
$this->image = $image;
return $this;
}
public function getIdcompte(){return $this->idcompte;}
// @return  self
public function setIdcompte($idcompte){
$this->idcompte = $idcompte;
return $this;
}
}