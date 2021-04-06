<?php 

class compte {
private int $idcompte;
private string $nom;
private string $prenom;
private string $photo;
private string $poste;
private string $grade;
private string $departement;
private string $date_embauche;


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
 * Get the value of nom
 *
 * @return string
 */
public function getNom() : string 
{
return $this->nom;
}

/**
 * Set the value of nom
 *
 * @param string $nom
 *
 * @return self
 */
public function setNom(string $nom) : self
{
$this->nom = $nom;

return $this;
}

/**
 * Get the value of prenom
 *
 * @return string
 */
public function getPrenom() : string 
{
return $this->prenom;
}

/**
 * Set the value of prenom
 *
 * @param string $prenom
 *
 * @return self
 */
public function setPrenom(string $prenom) : self
{
$this->prenom = $prenom;

return $this;
}

/**
 * Get the value of photo
 *
 * @return string
 */
public function getPhoto() : string 
{
return $this->photo;
}

/**
 * Set the value of photo
 *
 * @param string $photo
 *
 * @return self
 */
public function setPhoto(string $photo) : self
{
$this->photo = $photo;

return $this;
}

/**
 * Get the value of poste
 *
 * @return string
 */
public function getPoste() : string 
{
return $this->poste;
}

/**
 * Set the value of poste
 *
 * @param string $poste
 *
 * @return self
 */
public function setPoste(string $poste) : self
{
$this->poste = $poste;

return $this;
}

/**
 * Get the value of grade
 *
 * @return string
 */
public function getGrade() : string 
{
return $this->grade;
}

/**
 * Set the value of grade
 *
 * @param string $grade
 *
 * @return self
 */
public function setGrade(string $grade) : self
{
$this->grade = $grade;

return $this;
}

/**
 * Get the value of departement
 *
 * @return string
 */
public function getDepartement() : string 
{
return $this->departement;
}

/**
 * Set the value of departement
 *
 * @param string $departement
 *
 * @return self
 */
public function setDepartement(string $departement) : self
{
$this->departement = $departement;

return $this;
}

/**
 * Get the value of date_embauche
 *
 * @return string
 */
public function getDateEmbauche() : string
{
return $this->date_embauche;
}

/**
 * Set the value of date_embauche
 *
 * @param string $date_embauche
 *
 * @return self
 */
public function setDateEmbauche(String $date_embauche) : self
{
$this->date_embauche = $date_embauche;

return $this;
}
public function __construct($idcompte,$nom,$prenom,$photo,$poste,$grade,$departement,$date_embauche)
{
$this->setIdcompte($idcompte);
$this->setNom($nom);
$this->setPrenom($prenom);
$this->setPhoto($photo);
$this->setPoste($poste);
$this->setGrade($grade);
$this->setDepartement($departement);
$this->setDateEmbauche($date_embauche);
}
}
