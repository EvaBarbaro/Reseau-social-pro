<?php 

class imageDao implements dao {
    create(%titre,$image,$idcompte){
        $sql = "INSERT INTO image(titre,image,idcpmpte) 
			VALUES ('$titre', '$image', '$idcompte');

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