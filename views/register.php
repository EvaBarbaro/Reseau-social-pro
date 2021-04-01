<div class="d-flex">
    <div id="logo">
        <img src="http://localhost:8080/apache/Reseau-social-pro/img/logo-social-connect.png" alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>

        <div id="register">
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Inscription</h1>

            <form method="POST" class="col">
                <input type="hidden" name="user_id" value="<?= uniqid() ?>">
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
                <div class="form-group row">
                    <label for="mail" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" name="mail" id="mail" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nomutilisateur" class="col-sm-4 col-form-label">Nom d'utilisateur</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" name="nomutilisateur" id="nomutilisateur" placeholder="Nom d'utilisateur" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label mt-4">Mot de passe</label>
                    <div class="col-sm-8">
                    <label for="password"><small>Votre mot de passe doit contenir 8 caractères, un chiffre et un caractère spécial minimum</small></label>
                    <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Mot de passe" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-block">Confirmer</button>
                <p class="mt-2 mx-auto" style="width:350px">Si vous avez déjà un réseau <a class="text-info" href="./">Connectez-vous</a> !</p>
            </form>
        </div>
</div>
</body>