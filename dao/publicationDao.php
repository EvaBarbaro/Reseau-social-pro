<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/publication.php';
include_once __DIR__.'/commentaireDao.php';
include_once __DIR__.'/compteDao.php';

class publicationDao implements interfaceDao {

    private $conn;
    private $idUtilisateur;

    public function __construct($db){
        $this->conn = $db;
        $this->idUtilisateur = 1;
    }


/**
 * Get a single publication
 */ 
    public function get($id){
        $sql = "SELECT * FROM publication WHERE idpublication = :id";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();
        $publication = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        return $publication;
    }



    
/**
 * Get all publication
 */ 
    public function getAll(){
        $sql = "SELECT * FROM publication p WHERE (statut='public') OR 
        (statut='amis' AND idcompte = 
        (SELECT amis.idcompte FROM amis WHERE 
        amis.idcompte=:id AND amis.idcompte_ami=p.idcompte)) OR (idpublication=:id)";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':id', $this->idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();
        $publication = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        $compteDao = new compteDao($this->conn);
        $commentaireDao = new commentaireDao($this->conn);
        foreach($publication as $pub){
            $compte =  $compteDao->get($pub['idcompte']);
            $compteInfo = array(
            "idcompte"=>$compte['idcompte'],
            "nomutilisateur"=>$compte['nomutilisateur'],
            "photo"=>$compte['photo']
            );
            $publication["comptePublication"] = $compteInfo;

            $commentaires =  $commentaireDao->getAllPostsComents($pub['idcompte']);
            $publication["commentaires"] = $commentaires;
         }
        return $publication;
    }
    


    
/**
 * Update one publication
 */ 
    public function update($publication){

    }
    


    
/**
 * Create one publication
 */ 
    public function create($publication){

    }
        


    
/**
 * Delete one publication
 */ 
    public function delete($id){

    }

    /**
     * Get the value of idUtilisateur
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
}