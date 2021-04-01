<?php 

class imageDao implements dao {
    create(%titre,$image,$idcompte){
        $sql = "INSERT INTO image(titre,image,idcompte) 
			VALUES ('$titre', '$image', '$idcompte');
        $con->query($sql); 
    }
    image get($id){
    $sql = "SELECT * FROM image WHERE idimage={$id}";
			$result = $con->query($sql);
            return $result;
    }
    images getAll(){
        $sql 	= "SELECT * FROM image";
        $result = $con->query($sql); 
        return $result;
    }
    update($idimage,$titre,$image,$idcompte){
        $sql = "UPDATE image SET titre='$titre', image = '$image' , idcompte='$idcompte' WHERE id='$idimage';
        $con->query($sql);
    }
    delete($id){
        $sql = "DELETE FROM image WHERE idimage='$id';
        $con->query($sql);

    }


}
/* <?php
interface dao {
    function get();
    function getAll();
    function update();
    function create();
    function delete();
}

*/