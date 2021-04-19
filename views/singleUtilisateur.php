<?php 

    require_once __DIR__ . '/networkNav.php';
    require_once __DIR__ . '/accountNav.php';

?>
<div class="d-flex">
<?php
    require_once __DIR__ . '/asideProfil.php';
?>

        <div id="register">
        <?php

        if (!empty($_SESSION['message'])) {
            echo $_SESSION['message'];
        }

        ?>
        <h1 class="mx-auto mt-4 mb-4" style="width:200px">Modification</h1>

            <form action=<?= pathUrl()."monCompte/update" ?> method="POST" class="col">
                <input type="hidden" name="idutilisateur" value="<?= $viewVars['utilisateur']['idutilisateur'] ?>">
                <div class="form-group row">
                    <label for="nomutilisateur" class="col-sm-4 col-form-label">Votre nom</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="nomutilisateur" id="nomutilisateur" value="<?= $viewVars['utilisateur']['nomutilisateur'] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mail" class="col-sm-4 col-form-label">Votre email</label>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" name="mail" id="mail" value="<?= $viewVars['utilisateur']['mail'] ?>">
                    </div>
                </div>
                <input type="hidden" name="identreprise" value="<?= $viewVars['utilisateur']['identreprise'] ?>">
                <button type="submit" class="btn btn-success btn-lg btn-block">Confirmer</button>
            </form>
                <!-- Button trigger modal -->
                <button id="deleteAccount" type="button" class="fakeTextInput text-danger mt-4" data-toggle="modal" data-target="#userDelModal">
                Supprimer mon compte
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="userDelModal" tabindex="-1" role="dialog" aria-labelledby="userDelModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userDelModalLabel">Comfirmez-vous la suppression de votre compte ?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <form action=<?= pathUrl()."monCompte/deleteUser" ?> method='POST'>
                        <div class="modal-footer">
                            <input type='hidden' value=<?= $viewVars['utilisateur']['idutilisateur'] ?> name='idutilisateur' />
                            <input type='hidden' value=<?= $viewVars['utilisateur']['identreprise'] ?> name='identreprise' />
                            <button type="submit" class="btn btn-primary">Confirmer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    </form>
        </div>
</div>