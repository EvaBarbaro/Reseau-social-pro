<?php 

class utilisateur {
    private $idUtilisateur;
    private $nomUtilisateur;
    private $motDePasse;
    private $mail;
    private $role;
    private $statut;
    private $idEntreprise;

    /**
     * Get the value of idUtilisateur
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set the value of idUtilisateur
     *
     * @return self
     */
    public function setIdUtilisateur($idUtilisateur) : self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get the value of nomUtilisateur
     */
    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur;
    }

    /**
     * Set the value of nomUtilisateur
     *
     * @return self
     */
    public function setNomUtilisateur($nomUtilisateur) : self
    {
        $this->nomUtilisateur = $nomUtilisateur;

        return $this;
    }

    /**
     * Get the value of motDePasse
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * Set the value of motDePasse
     *
     * @return self
     */
    public function setMotDePasse($motDePasse) : self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get the value of mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return self
     */
    public function setMail($mail) : self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return self
     */
    public function setRole($role) : self
    {
        $this->role = $role;

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
}