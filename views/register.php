<?php

$uniqueID = hexdec(uniqid());
$uniqueUserID = hexdec(uniqid());

?>
<div class="d-flex">
    <div id="logo">
        <img src=<?= pathUrl()."public/img/logo-social-connect.png" ?> alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>

        <div id="register">
        <?php

        if (!empty($_SESSION['message'])) {
            echo $_SESSION['message'];
        }

        ?>
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Inscription</h1>

            <form enctype="multipart/form-data" action=<?= pathUrl()."monReseau/create" ?> method="POST" class="col">
                <input type="hidden" name="identreprise" value="<?= $uniqueID ?>">
                <div class="form-group row">
                    <label for="designation" class="col-sm-4 col-form-label">Nom de votre entreprise</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="designation" id="designation" placeholder="Nom de votre entreprise" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="logoInput" class="col-sm-4 col-form-label">Logo</label>
                    <div class="col-sm-8">
                    <input type="file" name="logo" id="logoInput" placeholder="Logo">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-4 col-form-label">Description</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                    </div>
                </div>
                <input type="hidden" name="url" value=<?= pathUrl(). "monReseau/" . $uniqueID ."/login" ?>>
                <input type="hidden" name="idutilisateur" value="<?= $uniqueUserID ?>">
                <div class="form-group row">
                    <label for="nomutilisateur" class="col-sm-4 col-form-label">Votre nom utilisateur</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="nomutilisateur" id="nomutilisateur" placeholder="Votre nom utilisateur" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="motdepasse" class="col-sm-4 col-form-label mt-4">Votre mot de passe</label>
                    <div class="col-sm-8">
                    <label for="motdepasse"><small>Votre mot de passe doit contenir 8 caract??res, un chiffre et un caract??re sp??cial minimum</small></label>
                    <input type="password" class="form-control" name="motdepasse" id="motdepasse" placeholder="Votre mot de passe">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mail" class="col-sm-4 col-form-label">Votre email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" name="mail" id="mail" placeholder="Votre email">
                    </div>
                </div>
                <input type="hidden" name="role" value="admin">
                <input type="hidden" name="statut" value=<?= true ?>>
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
            </form>
        </div>
</div>
</body>