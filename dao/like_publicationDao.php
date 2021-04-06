<?php 

include_once __DIR__.'/../interface/interfaceLikeDao.php';

class like_publicationDao implements interfaceLikeDao {
    private $conn;
    private $idUtilisateur;

    public function __construct($db,$idUtilisateur){
        $this->conn = $db;
        $this->idUtilisateur = $idUtilisateur;
    }
    private function AddLike($obj) {
     
        $sql = "INSERT INTO like_publication(idpublication,idcompte)  VALUES(:idPublication,:idCompte)";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':idPublication', $obj->getIdpublication(), PDO::PARAM_INT);
        $pdoStatement->bindValue(':idCompte',  $this->idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();

        $sqlPubLike = "SELECT PUBLICATION.like FROM PUBLICATION WHERE idpublication=:idPublication";

        $pdoStatementPubLike = $this->conn->prepare($sqlPubLike);
        $pdoStatementPubLike->bindValue(':idPublication', $obj->getIdpublication(), PDO::PARAM_INT);
        $pdoStatementPubLike->execute();
        $PubLikeFetch = $pdoStatementPubLike->fetch(PDO::FETCH_ASSOC);
        $PubLike=$PubLikeFetch['like']+1;
        $sqlPub = "UPDATE PUBLICATION SET PUBLICATION.like=:like WHERE idpublication=:idPublication";

        $pdoStatementPub = $this->conn->prepare($sqlPub);
        $pdoStatementPub->bindValue(':idPublication', $obj->getIdpublication(), PDO::PARAM_INT);
        $pdoStatementPub->bindValue(':like', $PubLike, PDO::PARAM_INT);
        $pdoStatementPub->execute();
     
    }
    private function DeleteLike($obj){
        
            $sql = "DELETE FROM like_publication WHERE idpublication = :idPublication AND idcompte= :idCompte";
    
            $pdoStatement = $this->conn->prepare($sql);
            $pdoStatement->bindValue(':idPublication', $obj->getIdpublication(), PDO::PARAM_INT);
            $pdoStatement->bindValue(':idCompte',  $this->idUtilisateur, PDO::PARAM_INT);
            $pdoStatement->execute();

            $sqlPubLike = "SELECT PUBLICATION.like FROM PUBLICATION WHERE idpublication=:idPublication";

            $pdoStatementPubLike = $this->conn->prepare($sqlPubLike);
            $pdoStatementPubLike->bindValue(':idPublication', $obj->getIdpublication(), PDO::PARAM_INT);
            $pdoStatementPubLike->execute();
            $PubLikeFetch = $pdoStatementPubLike->fetch(PDO::FETCH_ASSOC);
            if($PubLikeFetch['like']>0)
           { 
               $PubLike=$PubLikeFetch['like']-1;
           } else {
               $PubLike = 0;
           }
            $sqlPub = "UPDATE PUBLICATION SET PUBLICATION.like=:like WHERE idpublication=:idPublication";

            $pdoStatementPub = $this->conn->prepare($sqlPub);
            $pdoStatementPub->bindValue(':idPublication', $obj->getIdpublication(), PDO::PARAM_INT);
            $pdoStatementPub->bindValue(':like', $PubLike, PDO::PARAM_INT);
            $pdoStatementPub->execute();
        
    }
    public function Like_Unlike($obj){
        if(!$this->Liked($obj)){
            $this->AddLike($obj);
        }
        else {
            $this->DeleteLike($obj);
        }
    }
    public function Liked($obj) : bool {
        $liked=false;
        $sql = "SELECT * FROM like_publication WHERE idpublication = :idPublication AND idcompte= :idCompte";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':idPublication', $obj->getIdpublication(), PDO::PARAM_INT);
        $pdoStatement->bindValue(':idCompte',  $this->idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();
        $publicationLiked = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if($publicationLiked){
            $liked=true;
        }
        return $liked;
    }
}