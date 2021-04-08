<?php 
require_once __DIR__ . '/networkNav.php';
?>
<div class="d-flex">
    <div id="logo">
        <img src=<?= pathUrl()."img/logo-social-connect.png" ?> alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>

        <div id="register">
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Modification</h1>

            <form action=<?= pathUrl()."monCompte/update" ?> method="POST" class="col">
                <input type="hidden" name="idutilisateur" value="<?= $viewVars['utilisateur']['idutilisateur'] ?>">
                <div class="form-group row">
                    <label for="nomutilisateur" class="col-sm-4 col-form-label">Votre nom</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="nomutilisateur" id="nomutilisateur" value="<?= $viewVars['utilisateur']['nomutilisateur'] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="motdepasse" class="col-sm-4 col-form-label">Votre mot de passe</label>
                    <div class="col-sm-8">
                    <input type="password" class="form-control" name="motdepasse" id="motdepasse" value="<?= $viewVars['utilisateur']['motdepasse'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mail" class="col-sm-4 col-form-label">Votre email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" name="mail" id="mail" value="<?= $viewVars['utilisateur']['mail'] ?>">
                    </div>
                </div>
                <input type="hidden" name="role" value="<?= $viewVars['utilisateur']['role'] ?>">
                <input type="hidden" name="statut" value="<?= $viewVars['utilisateur']['statut'] ?>">
                <input type="hidden" name="identreprise" value="<?= $viewVars['utilisateur']['identreprise'] ?>">
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
            </form>
        </div>
</div>