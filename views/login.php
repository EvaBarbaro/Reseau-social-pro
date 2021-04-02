<div class="d-flex">
    <div id="logo">
        <img src="http://localhost:8080/Reseau-social-pro/img/logo-social-connect.png" alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>

        <div id="login">
            <h1 class="mt-4 mb-4 mx-auto" style="width:200px">Connexion</h1>
                <form method="POST" class="col">
                    <div class="form-group row">
                        <label for="inputUsername" class="col-sm-4 col-form-label">Nom d'utilisateur</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" name="username" id="inputUsername" placeholder="Nom d'utilisateur" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Mot de passe</label>
                        <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Mot de passe" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-block">Confirmer</button>
                    <p class="mt-2 mx-auto" style="width:420px">Si vous n'avez pas de compte <a href="./inscription">Créer votre réseau</a> !</p>
                </form>
            </div>
        </div>
    </div>
</div>

</body>