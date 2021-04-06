<?php 

include_once __DIR__.'/../interface/interfaceLikeDao.php';

class like_commentaireDao implements interfaceLikeDao {
    private $conn;
    private $idUtilisateur;

    public function __construct($db,$idUtilisateur){
        $this->conn = $db;
        $this->idUtilisateur = $idUtilisateur;
    }
    private function AddLike($obj) {
     
        $sql = "INSERT INTO like_commentaire(idcommentaire,idcompte)  VALUES(:idCommentaire,:idCompte)";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':idCommentaire', $obj->getIdcommentaire(), PDO::PARAM_INT);
        $pdoStatement->bindValue(':idCompte',  $this->idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();

        $sqlComLike = "SELECT COMMENTAIRE.like FROM COMMENTAIRE WHERE idcommentaire=:idCommentaire";

        $pdoStatementComLike = $this->conn->prepare($sqlComLike);
        $pdoStatementComLike->bindValue(':idCommentaire', $obj->getIdcommentaire(), PDO::PARAM_INT);
        $pdoStatementComLike->execute();
        $ComLikeFetch = $pdoStatementComLike->fetch(PDO::FETCH_ASSOC);
        $ComLike=$ComLikeFetch['like']+1;
        $sqlCom = "UPDATE COMMENTAIRE SET COMMENTAIRE.like=:like WHERE idcommentaire=:idCommentaire";

        $pdoStatementCom = $this->conn->prepare($sqlCom);
        $pdoStatementCom->bindValue(':idCommentaire', $obj->getIdcommentaire(), PDO::PARAM_INT);
        $pdoStatementCom->bindValue(':like', $ComLike, PDO::PARAM_INT);
        $pdoStatementCom->execute();
     
    }
    private function DeleteLike($obj){
        
            $sql = "DELETE FROM like_commentaire WHERE idcommentaire = :idCommentaire AND idcompte= :idCompte";
    
            $pdoStatement = $this->conn->prepare($sql);
            $pdoStatement->bindValue(':idCommentaire', $obj->getIdcommentaire(), PDO::PARAM_INT);
            $pdoStatement->bindValue(':idCompte',  $this->idUtilisateur, PDO::PARAM_INT);
            $pdoStatement->execute();

            $sqlComLike = "SELECT COMMENTAIRE.like FROM COMMENTAIRE WHERE idcommentaire=:idCommentaire";

            $pdoStatementComLike = $this->conn->prepare($sqlComLike);
            $pdoStatementComLike->bindValue(':idCommentaire', $obj->getIdcommentaire(), PDO::PARAM_INT);
            $pdoStatementComLike->execute();
            $ComLikeFetch = $pdoStatementComLike->fetch(PDO::FETCH_ASSOC);
            if($ComLikeFetch['like']>0)
           { 
               $ComLike=$ComLikeFetch['like']-1;
           } else {
               $ComLike = 0;
           }
            $sqlCom = "UPDATE COMMENTAIRE SET COMMENTAIRE.like=:like WHERE idcommentaire=:idCommentaire";

            $pdoStatementCom = $this->conn->prepare($sqlCom);
            $pdoStatementCom->bindValue(':idCommentaire', $obj->getIdcommentaire(), PDO::PARAM_INT);
            $pdoStatementCom->bindValue(':like', $ComLike, PDO::PARAM_INT);
            $pdoStatementCom->execute();
        
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
        $sql = "SELECT * FROM like_commentaire WHERE idcommentaire = :idCommentaire AND idcompte= :idCompte";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':idCommentaire', $obj->getIdcommentaire(), PDO::PARAM_INT);
        $pdoStatement->bindValue(':idCompte',  $this->idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();
        $commentaireLiked = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if($commentaireLiked){
            $liked=true;
        }
        return $liked;
    }
}