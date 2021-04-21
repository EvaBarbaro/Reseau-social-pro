<?php 

    require_once __DIR__ . '/networkNav.php';
?>
<div style="margin-top:7rem;">
<?php
    require_once __DIR__ . '/accountNav.php';
?>
<div class="d-flex">
<?php
    require_once __DIR__ . '/asideProfil.php';
?>

        <div id="register">
        <?= $_SESSION['message'] ?>
        <h1 class="mx-auto mt-4 mb-4" style="width:600px">Modifier mon mot de passe</h1>

        <form action=<?= pathUrl()."monCompte/updatePassword" ?> method="POST" class="col">
        <input type="hidden" name="idutilisateur" value="<?= $viewVars['utilisateur']['idutilisateur'] ?>">
            <div class="form-group row">
                <label for="motdepasse" class="col-sm-4 col-form-label">Votre ancien mot de passe</label>
                <div class="col-sm-8">
                <input type="password" class="form-control" name="oldmotdepasse" id="oldmotdepasse" placeholder="Votre ancien mot de passe">
                </div>
            </div>
            <div class="form-group row">
                <label for="motdepasse" class="col-sm-4 col-form-label">Votre nouveau mot de passe</label>
                <div class="col-sm-8">
                <input type="password" class="form-control" name="newmotdepasse" id="newmotdepasse" placeholder="Votre nouveau mot de passe">
                </div>
            </div>
            <input type="hidden" name="identreprise" value="<?= $viewVars['utilisateur']['identreprise'] ?>">
            <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
        </form>
    </div>
</div>
</div>