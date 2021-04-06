<div class="d-flex">
    <div id="logo">
        <img src=<?= pathUrl()."img/logo-social-connect.png" ?> alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>

        <div id="register">
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Modification</h1>

            <form action=<?= pathUrl()."monReseau/update" ?> method="POST" class="col">
                <input type="hidden" name="identreprise" value="<?= $viewVars['entreprise']['identreprise'] ?>">
                <div class="form-group row">
                    <label for="designation" class="col-sm-4 col-form-label">Nom de votre entreprise</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="designation" id="designation" value="<?= $viewVars['entreprise']['designation'] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="logo" class="col-sm-4 col-form-label">Logo</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="logo" id="logoInput" value="<?= $viewVars['entreprise']['logo'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-4 col-form-label">Description</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="description" id="description" value="<?= $viewVars['entreprise']['description'] ?>">
                    </div>
                </div>
                <input type="hidden" name="url" value="<?= $viewVars['entreprise']['url'] ?>">
                <input type="hidden" name="statut" value="<?= $viewVars['entreprise']['statut'] ?>">
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
            </form>
        </div>
</div>