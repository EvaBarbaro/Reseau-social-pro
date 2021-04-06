<?php 

class like_publicationDao implements interfaceLikeDao {
    public function Like_Unlike($obj){
        
    }
    public bool function Liked($obj){
        $liked=false;
        $sql = "SELECT * FROM like_publication WHERE idpublication = :idPublication AND idcompte= :idCompte";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':idPublication', $obj['idpublication'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':idCompte', $obj['idcompte'], PDO::PARAM_INT);
        $pdoStatement->execute();
        $publicationLiked = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if($publicationLiked){
            $liked=true;
        }
        return $liked;
    }
}