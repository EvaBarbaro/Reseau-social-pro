<?php

$uniqueID = hexdec(uniqid());

?>
<div class="d-flex">
    <div id="logo">
        <img src="http://localhost/apache/Reseau-social-pro/img/logo-social-connect.png" alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>

        <div id="register">
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Inscription</h1>

            <form action="http://localhost/apache/Reseau-social-pro/monReseau/create" method="POST" class="col">
                <input type="hidden" name="identreprise" value="<?= $uniqueID ?>">
                <div class="form-group row">
                    <label for="designation" class="col-sm-4 col-form-label">Nom de votre entreprise</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="designation" id="designation" placeholder="Nom de votre entreprise" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="logo" class="col-sm-4 col-form-label">Logo</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="logo" id="logoInput" placeholder="Logo">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-4 col-form-label">Description</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                    </div>
                </div>
                <input type="hidden" name="url" value="<?= "http://localhost" . $_SERVER['BASE_URI'] . "/monReseau/" . $uniqueID ?>">
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
                <p class="mt-2 mx-auto" style="width:350px">Si vous avez déjà un réseau <a class="text-info" href="./">Connectez-vous</a> !</p>
            </form>
        </div>
</div>
</body>