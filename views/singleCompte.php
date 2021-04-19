<?php 

    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php'; 
    
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<div class="d-flex">

<?php

    require_once __DIR__ . '/asideProfil.php';
?>
        <div id="register">
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Modification</h1>

            <form enctype="multipart/form-data" action=<?= pathUrl()."mesInformations/update" ?> method="POST" class="col">
                <input type="hidden" name="idcompte" value="<?= $viewVars['compte']['idcompte'] ?>">
                <div class="form-group row">
                    <label for="nom" class="col-sm-4 col-form-label">Votre nom</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="nom" id="nom" value="<?= $viewVars['compte']['nom'] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="prenom" class="col-sm-4 col-form-label">Votre prénom</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="prenom" id="prenom" value="<?= $viewVars['compte']['prenom'] ?>">
                    </div>
                </div>
                <input type="hidden" name="photo" value="<?= $viewVars['compte']['photo'] ?>">
                <div class="form-group row">
                    <label for="poste" class="col-sm-4 col-form-label">Votre poste</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="poste" id="poste" value="<?= $viewVars['compte']['poste'] ?>"> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="grade" class="col-sm-4 col-form-label">Votre grade</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="grade" id="grade" value="<?= $viewVars['compte']['grade'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="departement" class="col-sm-4 col-form-label">Votre departement</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="departement" id="departement" value="<?= $viewVars['compte']['departement'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date_embauche" class="col-sm-4 col-form-label">Votre date d'embauche</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" name="date_embauche" id="date_embauche" value="<?= $viewVars['compte']['date_embauche'] ?>">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer </button>
                
            </form>
            <br>
                
            <form action=<?= pathUrl()."views/attestationPdf.php" ?> method="POST" class="col">      
                <input type="hidden" name="nom" value="<?= $viewVars['compte']['nom'] ?>">
                <input type="hidden" name="prenom" value="<?= $viewVars['compte']['prenom'] ?>">
                <input type="hidden" name="poste" value="<?= $viewVars['compte']['poste'] ?>">
                <input type="hidden" name="grade" value="<?= $viewVars['compte']['grade'] ?>">
                <input type="hidden" name="departement" value="<?= $viewVars['compte']['departement'] ?>">
                <input type="hidden" name="date_embauche" value="<?= $viewVars['compte']['date_embauche'] ?>">
                <button type="submit" class="btn btn-info btn-lg btn-block">Obtenir une attestation de travaille</button>         
            </form>
            <br>
    <!-- <pre>
        <b><p style="color:red;" >Variable SESSION</p></b>    <?php  //var_dump($_SESSION); ?> 
        <b><p style="color:red;">Variable viewvars</p> </b>    <?php  //var_dump($viewVars); ?> 
        <b><p style="color:red;"> Variable POST</p></b>   <?php  //var_dump($_POST); ?> 
        <b><p style="color:red;">Variable getAll</p></b>   <?php  //var_dump($_GET); ?> 
        <b><p style="color:red;">Variable FILES</p> </b>    <?php  //var_dump($_FILES); ?> 
    </pre> -->

        </div>
</div>