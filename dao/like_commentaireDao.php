<?php 

include_once __DIR__.'/../interface/interfaceLikeDao.php';

class like_commentaireDao implements interfaceLikeDao {
    private $conn;
    private $idUtilisateur;

    public function __construct($db,$idUtilisateur){
        $this->conn = $db;
        $this->idUtilisateur = $idUtilisateur;
    }

    public function Like_Unlike($obj){
        
    }
    public function Liked($obj) : bool {
        $liked=false;
        $sql = "SELECT * FROM like_commentaire WHERE idcommentaire = :idCommentaire AND idcompte= :idCompte";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':idCommentaire', $obj['idcommentaire'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':idCompte',  $this->idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();
        $commentaireLiked = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if($commentaireLiked){
            $liked=true;
        }
        return $liked;
    }
}