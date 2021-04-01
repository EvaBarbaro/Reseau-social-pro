    <div class="container">
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Inscription</h1>
        <div class="row justify-content-md-center">

            <form method="POST" class="col-6">
                <input type="hidden" name="user_id" value="<?= uniqid() ?>">
                <div class="form-group row">
                    <label for="inputName" class="col-sm-4 col-form-label">Nom(s)</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" id="inputName" placeholder="Nom(s)" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputFirstname" class="col-sm-4 col-form-label">Prénom(s)</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="firstname" id="inputFirstname" placeholder="Prénom(s)" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputUsername" class="col-sm-4 col-form-label">Nom d'utilisateur</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" id="inputUsername" placeholder="Nom d'utilisateur" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputMail" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" name="mail" id="inputMail" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-form-label mt-4">Mot de passe</label>
                    <div class="col-sm-8">
                    <label for="password"><small>Votre mot de passe doit contenir 8 caractères, un chiffre et un caractère spécial minimum</small></label>
                    <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Mot de passe" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
                <p class="mt-2 mx-auto" style="width:350px">Si vous êtes déjà inscrit <a class="text-info" href="./">Connectez-vous</a> !</p>
            </form>
        </div>
    </div>
</body>