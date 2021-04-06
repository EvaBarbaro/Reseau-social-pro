<?php 

class like_commentaireDao implements interfaceLikeDao {
    public function Like_Unlike($obj){
        
    }
    public bool function Liked($obj){
        $liked=false;
        $sql = "SELECT * FROM like_commentaire WHERE idcommentaire = :idCommentaire AND idcompte= :idCompte";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':idCommentaire', $obj['idcommentaire'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':idCompte', $obj['idcompte'], PDO::PARAM_INT);
        $pdoStatement->execute();
        $commentaireLiked = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if($commentaireLiked){
            $liked=true;
        }
        return $liked;
    }
}