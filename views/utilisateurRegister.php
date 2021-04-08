<?php

$uniqueID = hexdec(uniqid());

?>
<div class="d-flex">
    <div id="logo">
        <img src=<?= pathUrl()."public/img/logo-social-connect.png" ?> alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>

        <div id="register">
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Inscription</h1>

            <form action=<?= pathUrl()."monCompte/create" ?> method="POST" class="col">
                <input type="hidden" name="idutilisateur" value="<?= $uniqueID ?>">
                <div class="form-group row">
                    <label for="nomutilisateur" class="col-sm-4 col-form-label">Votre nom utilisateur</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="nomutilisateur" id="nomutilisateur" placeholder="Votre nom utilisateur" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="motdepasse" class="col-sm-4 col-form-label">Votre mot de passe</label>
                    <div class="col-sm-8">
                    <input type="password" class="form-control" name="motdepasse" id="motdepasse" placeholder="Votre mot de passe">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mail" class="col-sm-4 col-form-label">Votre email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" name="mail" id="mail" placeholder="Votre email">
                    </div>
                </div>
                <input type="hidden" name="role" value="user">
                <input type="hidden" name="statut" value=<?= false ?>>
                <input type="hidden" name="identreprise" value="<?= $viewVars['entrepriseId'] ?>">
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
                <p class="mt-2 mx-auto" style="width:420px">Si vous avez déjà un compte <a href=<?= pathUrl()."monReseau/".$viewVars['entrepriseId']."/login" ?>>Connectez-vous</a> !</p>
            </form>
        </div>
</div>
</body>