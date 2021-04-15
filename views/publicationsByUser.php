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
            <h1 class="mx-auto mt-4 mb-4" style="width:35%">Mes publications</h1>
            <?php
                $length = count($viewVars['publicationByUser']);

                for ($index=0; $index < $length; $index++) { 
                    $publication = $viewVars['publicationByUser'][$index];
            ?>
            <div class="card col-8 mb-4">
            <img class="card-img-top" src=<?= pathUrl()."public/publicationImages/".$publication["imageurl"] ?> alt="Card image cap">
            <div class="card-body">
            <form class="formUpdatePost" action="<?= pathUrl()."mesPublications/update" ?>" method="POST">
                <img id="<?='updateTitlePost'.$index?>" src="<?= pathUrl()."public/img/pencil.png" ?>" alt="bouton modifier description" width="5%" class="imagePostUser">
                <textarea type="text" name="description" id="<?='descriptionPost'.$index?>" class="fakeTextInput postDescUser" readonly><?= $publication["description"]?></textarea>
                <button type='submit' class='btn btn-info row float-right'>Modifier</button>
            </div>
            </div>
                <input type="hidden" name="idpublication" value=<?= $publication["idpublication"]?>>
                <input type="hidden" name="imageurl" value=<?= $publication["imageurl"]?>>
                <input type="hidden" name="like" value=<?= $publication["like"]?>>
                <input type="hidden" name="statut" value=<?= $publication["statut"]?>>
                <input type="hidden" name="idcompte" value=<?= $publication["idcompte"]?>>
            </form>
            <?php
                }
            ?>
            </div>
        </div>
    </div>