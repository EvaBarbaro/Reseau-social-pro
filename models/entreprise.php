<?php 

class entreprise {
    public $idEntreprise;
    public $designation;
    public $logo;
    public $description;
    public $url;
    public $statut;

    /**
     * Get the value of idEntreprise
     */
    public function getIdEntreprise()
    {
        return $this->idEntreprise;
    }

    /**
     * Set the value of idEntreprise
     *
     * @return self
     */
    public function setIdEntreprise($idEntreprise) : self
    {
        $this->idEntreprise = $idEntreprise;

        return $this;
    }

    /**
     * Get the value of designation
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set the value of designation
     *
     * @return self
     */
    public function setDesignation($designation) : self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get the value of logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set the value of logo
     *
     * @return self
     */
    public function setLogo($logo) : self
    {
        $this->logo = $logo;

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
     * @return self
     */
    public function setDescription($description) : self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return self
     */
    public function setUrl($url) : self
    {
        $this->url = $url;

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
     * @return self
     */
    public function setStatut($statut) : self
    {
        $this->statut = $statut;

        return $this;
    }
}