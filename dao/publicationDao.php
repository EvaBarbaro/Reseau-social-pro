<?php 

include_once __DIR__.'/../interface/interfaceDao.php';
include_once __DIR__.'/../utils/DBData.php';
include_once __DIR__.'/../models/publication.php';
include_once __DIR__.'/commentaireDao.php';
include_once __DIR__.'/compteDao.php';
include_once __DIR__.'/like_publicationDao.php';

class publicationDao implements interfaceDao {

    private $conn;
    private $idUtilisateur;

    public function __construct($db,$idUtilisateur){
        $this->conn = $db;
        $this->idUtilisateur = $idUtilisateur;
    }




/**
 * Get infos of a publication
 */ 
    private function getInfoPublication($pub) {
        $compteDao = new compteDao($this->conn);
        $commentaireDao = new commentaireDao($this->conn,$this->idUtilisateur);
        $like_publicationDao = new like_publicationDao($this->conn,$this->idUtilisateur);
        $publication = array();
         // les infos dans la table publication
         $pubInfo = array(
            "idpublication"=>$pub['idpublication'],
            "description"=>$pub['description'],
            "imageurl"=>$pub['imageurl'],
            "Nombre Like"=>$pub['like'],
            "statut"=>$pub['statut']
            );
        $publication["publicationInfos"] = $pubInfo;
        $like = $like_publicationDao->Liked($pub);
        $publication["publication_Liked_Par_Utilisateur"] = $like;
        $compte =  $compteDao->get($pub['idcompte']);
        // les infos du créateur de la publication
        $compteInfo = array(
        "idcompte"=>$compte['idcompte'],
        "nomutilisateur"=>$compte['nomutilisateur'],
        "photo"=>$compte['photo']
        );
        $publication["comptePublication"] = $compteInfo;
        // les commentaires de la publication
        $commentaires =  $commentaireDao->getAllPostsComents($pub['idpublication']);
        $publication["commentaires"] = $commentaires;
        return $publication;
    }




/**
 * Get a single publication
 */ 
    public function get($id){
        $sql = "SELECT * FROM publication WHERE idpublication = :id";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();
        $pub = $pdoStatement->fetch(PDO::FETCH_ASSOC);

        $coms = array();
        $publication = array();
        if($pub){
      
            // publication à retourner
            $publication = $this->getInfoPublication($pub);
 
         }
        return $publication;
    }



    
/**
 * Get all publication
 */ 
    public function getAll(){
        $sql = "SELECT * FROM publication p WHERE (statut='public') OR 
        (statut='amis' AND idcompte = 
        (SELECT amis.idcompte FROM amis WHERE 
        amis.idcompte=:id AND amis.idcompte_ami=p.idcompte)) OR (idcompte=:id)";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':id', $this->idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();
        $publications = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
  
        $coms = array();
        $publication = array();
        foreach($publications as $pub){
            // publication à ajouté
            $publicationAjouter = $this->getInfoPublication($pub);
            array_push($publication,$publicationAjouter);
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