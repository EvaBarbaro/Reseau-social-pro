<div class="d-flex">
    <div id="logo">
        <img src=<?= pathUrl()."img/logo-social-connect.png" ?> alt="logo" id="logoImg" class="img-thumbnail mt-4">
    </div>

        <div id="register">
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Modification</h1>

            <form action=<?= pathUrl()."monImage/update" ?> method="POST" class="col">
                <input type="hidden" name="identreprise" value="<?= $viewVars['image']['idimage'] ?>">
                
                <div class="form-group row">
                    <label for="titre" class="col-sm-4 col-form-label">Titre de l'image</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="titre" id="titre" value="<?= $viewVars['image']['titre'] ?>" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="imageurl" class="col-sm-4 col-form-label">Url</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="imageurl" id="imageurl" value="<?= $viewVars['image']['imageurl'] ?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="description" class="col-sm-4 col-form-label">Compte propriétaire</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="description" id="description" value="<?= $viewVars['image']['idcompte'] ?>">
                    </div>
                </div>
                
                <!--<input type="hidden" name="url" value="<?= $viewVars['entreprise']['url'] ?>">-->
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
            </form>
        </div>
</div>






<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Image</h1>
</body>
</html>
-->