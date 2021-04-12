<?php 

    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php';

?>
<div class="form-group row">
    <label for="motdepasse" class="col-sm-4 col-form-label">Votre mot de passe</label>
    <div class="col-sm-8">
    <input type="password" class="form-control" name="motdepasse" id="motdepasse" value="<?= $viewVars['utilisateur']['motdepasse'] ?>">
    </div>
</div>