<div class="d-flex">
    <div id="logo">
        <img src=<?= pathUrl()."public/img/logo-social-connect.png" ?> alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>

        <div id="login">
            <?php

                if (!empty($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }

            ?>
            <h1 class="mt-4 mb-4 mx-auto" style="width:200px">Connexion</h1>
                <form action=<?= pathUrl()."superAdmin/loggedAdmin" ?> method="POST" class="col">
                    <div class="form-group row">
                        <label for="nomutilisateur" class="col-sm-4 col-form-label">Nom d'utilisateur</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" name="nomutilisateur" id="nomutilisateur" placeholder="Nom d'utilisateur" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="motdepasse" class="col-sm-4 col-form-label">Mot de passe</label>
                        <div class="col-sm-8">
                        <input type="password" class="form-control" name="motdepasse" id="motdepasse" placeholder="Mot de passe" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>