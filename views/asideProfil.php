<div id="logo">
    <div id="profilContent">
    <img src=<?= pathUrl()."public/profilImages/".$viewVars['compte']['photo'] ?> alt="logo" id="photoImg" class="rounded-circle mt-4">
        <form id="formPhotoFile" enctype="multipart/form-data" action=<?= pathUrl()."mesInformations/update" ?> method="POST">
            <input type="hidden" name="idcompte" value="<?= $viewVars['compte']['idcompte'] ?>">
            <img id="newPhotoFile" src=<?= pathUrl()."public/img/pencil.png" ?> alt="bouton modification">
            <input type="file" name="photo" id="photoFile">
            <input type="hidden" name="nom" value="<?= $viewVars['compte']['nom'] ?>">
            <input type="hidden" name="prenom" value="<?= $viewVars['compte']['prenom'] ?>">
            <input type="hidden" name="poste" value="<?= $viewVars['compte']['poste'] ?>">
            <input type="hidden" name="grade" value="<?= $viewVars['compte']['grade'] ?>">
            <input type="hidden" name="departement" value="<?= $viewVars['compte']['departement'] ?>">
            <input type="hidden" name="date_embauche" value="<?= $viewVars['compte']['date_embauche'] ?>">
        </form>
    </div>
        <h1 id="photoName" class="mt-2"><?= $viewVars['compte']['prenom']." ".$viewVars['compte']['nom'] ?></h1>
    </div>