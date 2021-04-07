<?php 

class compte {

    private $idCompte;
    private $nom;
    private $prenom;
    private $photo;
    private $poste;
    private $grade;
    private $departement;
    private $date_embauche;

    /**
     * Get the value of idCompte
     */
    public function getIdCompte()
    {
        return $this->idCompte;
    }

    /**
     * Set the value of idCompte
     *
     * @return self
     */
    public function setIdCompte($idCompte) : self
    {
        $this->idCompte = $idCompte;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return self
     */
    public function setNom($nom) : self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return self
     */
    public function setPrenom($prenom) : self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return self
     */
    public function setPhoto($photo) : self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of poste
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set the value of poste
     *
     * @return self
     */
    public function setPoste($poste) : self
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get the value of grade
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set the value of grade
     *
     * @return self
     */
    public function setGrade($grade) : self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get the value of departement
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set the value of departement
     *
     * @return self
     */
    public function setDepartement($departement) : self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get the value of date_embauche
     */
    public function getDateEmbauche()
    {
        return $this->date_embauche;
    }

    /**
     * Set the value of date_embauche
     *
     * @return self
     */
    public function setDateEmbauche($date_embauche) : self
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
