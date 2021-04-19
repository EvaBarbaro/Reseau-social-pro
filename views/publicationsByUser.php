<?php

require_once __DIR__ . '/networkNav.php';
require_once __DIR__ . '/accountNav.php';

?>
<div class="d-flex">

<?php
require_once __DIR__ . '/asideProfil.php';
?>
    <div id="register">
        <div class="container">
            <div class="row justify-content-md-center">
            <h1 class="mx-auto mt-4 mb-4" style="width:45%">Mes publications</h1>
            <?php
                $length = count($viewVars['publicationByUser']);

                for ($index=0; $index < $length; $index++) { 
                    $publication = $viewVars['publicationByUser'][$index];
            ?>
            <div class="card col-8 mb-4">
                <?php 
                if(!empty($publication["imageurl"])){
                ?>
                <img class="card-img-top" src=<?= pathUrl()."public/publicationImages/".$publication["imageurl"] ?> alt="Card image cap">
                <?php }  else if(!empty($publication["videourl"])){
                ?>
                <div>
                <video class="card-img-top" width="520" height="440" controls>
                <source src=<?=pathUrl().'public/publicationVideos/'.$publication['videourl']?> type="video/mp4">

                Your browser does not support the video tag.
                </video> 
                </div>
                <?php }  else if(!empty($publication["fichierurl"])){
                ?>
               
                <object class="card-img-top" data="<?=pathUrl().'public/publicationFichiers/'.$publication['fichierurl']?>" type="application/pdf" width="520" height="440">

                </object>
               
                <?php } ?> 
            <div class="card-body">
                <?php
                    if ($publication['idcompte'] === $_SESSION['idutilisateur']) {
                ?>
            <form class="formUpdatePost" action="<?= pathUrl()."mesPublications/update" ?>" method="POST">
                <img id="<?='updateTitlePost'.$index?>" src="<?= pathUrl()."public/img/pencil.png" ?>" alt="bouton modifier description" width="5%" class="imagePostUser">
                <textarea type="text" name="description" id="<?='descriptionPost'.$index?>" class="fakeTextInput postDescUser" readonly><?= $publication["description"]?></textarea>
                <button type='submit' class='btn btn-info row float-right postButton'>Modifier</button>
                <input type="hidden" name="idpublication" value=<?= $publication["idpublication"]?>>
                <input type="hidden" name="imageurl" value=<?= $publication["imageurl"]?>>
                <input type="hidden" name="like" value=<?= $publication["like"]?>>
                <input type="hidden" name="statut" value=<?= $publication["statut"]?>>
                <input type="hidden" name="idcompte" value=<?= $publication["idcompte"]?>>
            </form>
             <!-- Button trigger modal -->
             <button id="pubModalDel" type="button" class="btn btn-danger float-right mt-2 postButton" data-toggle="modal" data-target="<?='#postModal'.$publication["idpublication"] ?>">
                Supprimer
                </button>

                <!-- Modal -->
                <div class="modal fade" id="<?='postModal'.$publication["idpublication"] ?>" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postModalLabel">Comfirmez-vous la suppression de la publication <?= $publication["description"] ?> ?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <form action="<?= pathUrl()."mesPublications/delete" ?>" method="POST">
                    <div class="modal-footer">
                        <input type="hidden" name="idcompte" value=<?= $publication["idcompte"]?>>
                        <input type="hidden" name="idpublication" value=<?= $publication["idpublication"]?>>
                        <button type="submit" class="btn btn-primary">Confirmer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                    </div>
                </div>
                </div>
            </form>
            </div>
            </div>
            <?php
                    } else {
                        ?>
                        <p><?= $publication["description"]?></p> </div>
        </div>
                        <?php
                    }
                }
            ?>
            </div>
        </div>
    </div>