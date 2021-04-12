<?php 

    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php';

?>
<div class="d-flex">
    <div id="logo">
        <img src=<?= pathUrl()."public/img/logo-social-connect.png" ?> alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>

        <div id="register">
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Modification</h1>

            <form enctype="multipart/form-data" action=<?= pathUrl()."mesInformations/update" ?> method="POST" class="col">
                <input type="hidden" name="idcompte" value="<?= $viewVars['compte']['idcompte'] ?>">
                <div class="form-group row">
                    <label for="nom" class="col-sm-4 col-form-label">Votre nom</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="nom" id="nom" value="<?= $viewVars['compte']['nom'] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="prenom" class="col-sm-4 col-form-label">Votre prénom</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $viewVars['compte']['prenom'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="poste" class="col-sm-4 col-form-label">Votre poste</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="poste" id="poste" value="<?= $viewVars['compte']['poste'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="grade" class="col-sm-4 col-form-label">Votre grade</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="grade" id="grade" value="<?= $viewVars['compte']['grade'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="departement" class="col-sm-4 col-form-label">Votre departement</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="departement" id="departement" value="<?= $viewVars['compte']['departement'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date_embauche" class="col-sm-4 col-form-label">Votre date d'embauche</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" name="date_embauche" id="date_embauche" value="<?= $viewVars['compte']['date_embauche'] ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
            </form>
        </div>
</div>