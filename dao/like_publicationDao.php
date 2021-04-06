<?php 

include_once __DIR__.'/../interface/interfaceLikeDao.php';

class like_publicationDao implements interfaceLikeDao {
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
        $sql = "SELECT * FROM like_publication WHERE idpublication = :idPublication AND idcompte= :idCompte";

        $pdoStatement = $this->conn->prepare($sql);
        $pdoStatement->bindValue(':idPublication', $obj['idpublication'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':idCompte',  $this->idUtilisateur, PDO::PARAM_INT);
        $pdoStatement->execute();
        $publicationLiked = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if($publicationLiked){
            $liked=true;
        }
        return $liked;
    }
}